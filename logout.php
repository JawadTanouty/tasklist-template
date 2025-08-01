<?php
// TODO Destruction de la session pour déconnecter l'utilisateur et redirection vers la page de connexion
session_start();
session_destroy(); // Vider $_SESSION
header("Location: login.php");
exit(); // Redirection vers la page de connexion

//finally done
?>
