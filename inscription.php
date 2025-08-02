<?php
require_once "bdd-crud.php";

session_start();

if(isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit();
}
if(isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
    if(function_exists('create_user')) {
        $user_id = create_user("", $_POST["email"], $_POST["password"]);
        if ($user_id !== null) {
            header("Location: login.php?registered=1");
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
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
    <form action="" method="post">
        <input type="email" name="email" placeholder="votre email...">
</body>
        <input type="password" name="password" placeholder="votre mot de passe...">
        <button>S'inscrire</button>
    </form>
</body>
</body>
</html>