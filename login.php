<?php
require_once "bdd-crud.php";
session_start();

$isError = false;
if(isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit();
}
if(isset($_POST["email"]) && isset($_POST["password"])){
    if(function_exists('get_user_by_login')) {
        $user = get_user_by_login($_POST["email"], $_POST["password"]);
        if($user !== null) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit();
        } else {
            $isError = true;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="post">
        <input type="email" name="email" placeholder="votre email...">
        <input type="password" name="password" placeholder="votre mot de passe...">
        <button>Se connecter</button>
    </form>

    <?php if($isError): ?>
    <p style="color:red;">Identifiants incorrects.</p>
<?php endif; ?>

        <a href="inscription.php">Pas de compte ? S'inscrire</a>

</body>
</html>