<?php
require_once "bdd-crud.php";

session_start();
$isSuccess = false;
if(isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit();
}
if(isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
    if(function_exists('create_user')) {
        $user_id = create_user("", $_POST["email"], $_POST["password"]);
        $isSuccess = $user_id !== null;
    }
}

//finally done

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
       <!-- TODO Formulaire pour s'inscrire (créer un utilisateur) -->

    <h1>Inscription</h1>
    <form action="" method="post">
        <input type="email" name="email" placeholder="votre email...">
        <input type="password" name="password" placeholder="votre mot de passe...">
        <button>S'inscrire</button>
    </form>
    <?php if($isSuccess == true): ?>
        <p>Utilisateur ajouté !</p>
    <?php endif; ?>
</body>
</html>