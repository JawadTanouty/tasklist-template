<?php
require_once "bdd-crud.php";

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}
$isSuccess = false;
if(isset($_POST["title"]) && !empty(trim($_POST["title"]))) {
    if(function_exists('add_task')) {
        $result = add_task($_POST["title"], "");
        $isSuccess = $result !== null;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
</head>
<body>
    <h1>Ajouter une tâche</h1>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="Titre de la tâche">
        <button>Ajouter</button>
    </form>
    <?php if($isSuccess): ?>
        <p>Tâche ajoutée avec succès !</p>
    <?php endif; ?>
</body>
</html>