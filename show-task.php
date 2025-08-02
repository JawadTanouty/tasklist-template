<?php
require_once "bdd-crud.php";
session_start();

$task = null;
$isError = false;
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET["id"])) {
    if (function_exists('get_task')) {
        $task = get_task((int)$_GET["id"]);
        if (!$task) {
            $isError = true;
        }
    }
} else {
    $isError = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php">&larr; Retour à la liste</a>
    <h1>Détail de la tâche</h1>
    <?php if($isError): ?>
        <p style="color:red;">Tâche introuvable ou accès non autorisé.</p>
    <?php else: ?>
        <ul>
            <li><strong>Titre :</strong> <?= htmlspecialchars($task["title"]) ?></li>
            <li><strong>Description :</strong> <?= nl2br(htmlspecialchars($task["description"])) ?></li>
            <li><strong>Date de création :</strong> <?= htmlspecialchars($task["created_at"]) ?></li>
            <!-- Ajoutez d'autres champs si besoin -->
        </ul>
    <?php endif; ?>
</body>
</html>