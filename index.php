<?php
require_once "bdd-crud.php";
// TODO Redirection vers la page de connexion si l'utilisateur n'est pas connecté

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

//finally done

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les taches</title>
</head>
<body>
    <header>
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
        <a href="inscription.php">Se créer un compte</a>
    </header>
    <h1>Liste des tâches</h1>
    <div class="tasks"> 
        <!-- TODO Afficher la liste des tâches de l'utilisateur connecté -->
         <a href="add-task.php">Ajouter une tache</a>

    <?php foreach($tasks as $task):?>
        <div class="task">
            <p class="task_title"><?= $task["title"] ?></p>
        </div>
    <?php endforeach; ?>

    </div>
</body>
</html>