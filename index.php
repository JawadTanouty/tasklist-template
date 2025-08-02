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
    <div class="tasks"> 
        <!-- TODO Afficher la liste des tâches de l'utilisateur connecté -->
        <form action="add-task.php" method="get" style="margin-bottom:2em; text-align:center;">
            <button type="submit">Ajouter une tâche</button>
        </form>

    <?php foreach($tasks as $task):?>
        <div class="task">
            <p class="task_title">
                <?= htmlspecialchars($task["title"]) ?>
                <a href="delete-task.php?id=<?= urlencode($task["id"]) ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette tâche ?');" style="color:red; margin-left:10px;">Supprimer</a>
            </p>
        </div>
    <?php endforeach; ?>

    </div>
</body>
</html>