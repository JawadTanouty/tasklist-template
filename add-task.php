<?php
require_once "bdd-crud.php";

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}

if(isset($_POST["title"]) && !empty(trim($_POST["title"]))) {
    $desc = isset($_POST["description"]) ? $_POST["description"] : "";
    if(function_exists('add_task')) {
        $result = add_task($_POST["title"], $desc);
        if ($result !== null) {
            header("Location: index.php?success=1");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter une tâche</h1>
    <a href="index.php" class="add-task-link">&larr; Retour à la liste des tâches</a>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="Titre de la tâche" required>
        <textarea name="description" placeholder="Description de la tâche" rows="4" class="edit-task-textarea"></textarea>
        <button>Ajouter</button>
    </form>
    
</body>
</html>

