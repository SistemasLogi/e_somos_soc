<?php

/* iniciar la sesión */
session_start();

require '../../config.php';

if ($_POST) {

    $usuario_pass_dao = new Usuario_DAO();

    $usuario = $_POST["inpUsername"];
    $password = $_POST["inpPassword"];

    if (!empty($datos_acceso = json_encode($usuario_pass_dao->consultaUsuario_login($_SESSION["empresa"], $usuario)))) {

        $array = json_decode($datos_acceso);
        for ($i = 0; $i < count($array); $i++) {

            if (password_verify($password, $array[$i]->us_password) == TRUE) {

                $_SESSION["us_id"] = $array[$i]->us_id;
                $_SESSION["us_cedula"] = $array[$i]->us_cedula;
                $_SESSION["us_nombre"] = $array[$i]->us_nombre;

                echo 1;
            } else {
                echo 2;//contraseña no es valida
            }
        }
    } else {
        echo 3;//usuario no es valido
    }
} else {
    header("location: ../");
}