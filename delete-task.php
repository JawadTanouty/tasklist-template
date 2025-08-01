<?php
require_once "bdd-crud.php";

// TODO Suppréssion d'une tâche en fonction de son ID passé en $_GET


//var_dump($_GET);
if(isset($_GET["id"])){
    if(function_exists('delete_task')) {
        $isSuccess = delete_task($_GET["id"]);
    }
    header("Location: index.php");
    exit();
}