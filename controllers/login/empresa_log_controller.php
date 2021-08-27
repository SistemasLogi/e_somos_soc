<?php

session_start();

if ($_POST) {
    $emp = $_POST["empresa"];

    $_SESSION["empresa"] = $emp;
    
    echo 'la empresa es '.$_SESSION["empresa"];
} else {
    header("location: ../");
}