<?php
require_once "bdd-crud.php";

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}
$tasks = [];
if(function_exists('get_all_task_for_user')) {
    $tasks = get_all_task_for_user();
} else {
    $database = new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
    $request = $database->prepare("SELECT * FROM task WHERE user_id=?");
    $request->execute([
        $_SESSION["user_id"]
    ]);
    $tasks = $request->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les taches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php if(!isset($_SESSION["user_id"])): ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
        <?php if(!isset($_SESSION["user_id"])): ?>
            <a href="inscription.php">Se créer un compte</a>
        <?php endif; ?>
    </header>
    <h1>Liste des tâches</h1>
    <?php if(isset($_GET['success'])): ?>
        <p class="success">Tâche ajoutée avec succès !</p>
    <?php endif; ?>

    <header class="add-task-header">
        <form action="add-task.php" method="get" style="text-align:center;">
            <button type="submit">Ajouter une tâche</button>
        </form>
    </header>

    <div class="tasks">
        <!-- TODO Afficher la liste des tâches de l'utilisateur connecté -->
        <!-- Bouton déplacé dans le header, suppression ici pour éviter le doublon -->

    <?php foreach($tasks as $task):?>
        <div class="task">
            <div class="task_title"><?= htmlspecialchars($task["title"]) ?></div>
            <?php if(!empty($task["description"])): ?>
                <div class="task_description"><?= nl2br(htmlspecialchars($task["description"])) ?></div>
            <?php endif; ?>
            <div style="display:flex; gap:0.5em;">
                <a href="edit-task.php?id=<?= urlencode($task["id"]) ?>" style="color:#1976d2;">Modifier</a>
                <a href="delete-task.php?id=<?= urlencode($task["id"]) ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette tâche ?');">Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>

    </div>
</body>
</html>