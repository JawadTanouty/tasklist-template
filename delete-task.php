<?php
session_start();
require_once "bdd-crud.php";

if(isset($_GET["id"])){
    if(function_exists('delete_task')) {
        $isSuccess = delete_task($_GET["id"]);
    }
    header("Location: index.php");
    exit();
}



?>