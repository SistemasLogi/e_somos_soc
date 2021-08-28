<?php

session_start();

if ($_POST) {
    $emp = $_POST["empresa"];

    $_SESSION["empresa"] = $emp;
    
    echo $_SESSION["empresa"];
} else {
    header("location: ../");
}