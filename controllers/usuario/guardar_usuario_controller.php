<?php

session_start();

if ($_POST) {
    require './../../config.php';
    $usuario_dao = new Usuario_DAO();
    $usuario_vo = new Usuario_VO();

    $usuario_id = $_POST["inpIdUser"];

    if (empty($usuario_id)) {
        $usuario_vo->setUs_id("null");
    } else {
        $usuario_vo->setUs_id($usuario_id);
    }

    $usuario_vo->setRol_id($_POST["selRole"]);
    $usuario_vo->setUs_cedula($_POST["inpCedula"]);
    $usuario_vo->setUs_nombre($_POST["inpNameUser"]);
    $usuario_vo->setEm_id($_SESSION["empresa"]);
    $usuario_vo->setUs_usuario($_POST["inpCedula"]);
    $usuario_vo->setUs_password($_POST["inpCedula"]);

    echo $usuario_dao->guardar_us_new($usuario_vo);
} else {
    header("location../");
}