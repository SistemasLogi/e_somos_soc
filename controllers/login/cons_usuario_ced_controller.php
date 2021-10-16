<?php

session_start();

if ($_POST) {
    require './../../config.php';
    $user_dao = new Usuario_DAO();
    
    
    $num_cedula = $_POST["inpNumCed"];
    
    echo json_encode($user_dao->consultaUsuario_x_cedula($_SESSION["empresa"], $num_cedula));
} else {
    header("location: ../");
}