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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="text-align:center; margin-top:2.2em; margin-bottom:0.5em;">
        <img src="organitasking.png" alt="Organitasking" style="max-width: 350px; width: 100%; height: auto; display: inline-block;" />
        <div class="subtitle">Arrête de <span class="pr">pr</span>ocrastiner et sois <span class="pr">pr</span>agmatique.<br>
        <span style="font-weight: bold; font-size:1.08em;"><span class="pr">PR</span>OJÈTE-TOI, <span class="pr">PR</span>ÉVOIS, <span class="pr">PR</span>OGRAMME, <span class="pr">PR</span>OCÈDE !</span><br>
        <span class="pr">Affiche</span> tes tâches, <span class="pr">modifie</span>-les à la demande, et <span class="pr">supprime</span>-les une fois que t'es passé à l'<span class="action-green">ACTION</span>.
        </div>
    </div>
    <?php if(isset($_GET['registered'])): ?>
        <p class="success">Inscription réussie ! Vous pouvez vous connecter.</p>
    <?php endif; ?>
    <h1>Connexion</h1>
    <form action="" method="post">
        <input type="email" name="email" placeholder="votre email...">
        <input type="password" name="password" placeholder="votre mot de passe...">
        <button>Se connecter</button>
    </form>

    <?php if($isError): ?>
    <p style="color:red;">Identifiants incorrects.</p>
<?php endif; ?>

        <a href="inscription.php" class="signup-link">Pas de compte ? S'inscrire</a>

</body>
</html>