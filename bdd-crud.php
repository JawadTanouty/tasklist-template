<?php
function connect_database() {
    return new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
}
/**
 * Ce fichier contient les fonctions de CRUD pour les utilisateurs et les tâches.
 * Il est utilisé pour interagir avec la base de données.
 * Presque toutes les pages de l'application utilisent ce fichier.
 * 
 * A vous de remplir ces fonction pour qu'elles fonctionnent correctement.
 * 
 * Vous pourrez ainsi facilment les utiliser dans les autres fichiers et construire votre site sans plus vous soucis du SQL.
 */

function create_user(string $nom, string $email, string $password): int | null
{
    $database = connect_database();

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // ajout user
    $stmt = $database->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $password_hash]);
    // Récupération du dernier id
    $user_id = $database->lastInsertId();

    return $user_id;
}

function get_user(int $id): array | null
{
    $database = connect_database();

    $stmt = $database->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function get_user_by_login(string $email, string $password): array | null
{
    $database = connect_database();

    $stmt = $database->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $user["password"])) {
        return $user;
    } else {
        return null;
    }
}

// CRUD Task
// Create
function add_task(string $name, string $description): int | null
{
    $database = connect_database();

    $stmt = $database->prepare("INSERT INTO task (title, description, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $_SESSION['user_id']]);
    $task_id = $database->lastInsertId();

    return $task_id;
}

//Read
function get_task(int $id): array | null | false
{
    $database = connect_database();

    $stmt = $database->prepare("SELECT * FROM task WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    return $task;
}

function get_all_task_for_user(): array | null
{
    $database = connect_database();

    $stmt = $database->prepare("SELECT * FROM task WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $tasks;
}

// Delete
function delete_task(int $id): bool
{
    $database = connect_database();
    $stmt = $database->prepare("DELETE FROM task WHERE id = ? AND user_id = ?");
    return $stmt->execute([$id, $_SESSION['user_id']]);
}


?>
    
