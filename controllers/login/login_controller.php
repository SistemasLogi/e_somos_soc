<?php

/* iniciar la sesión */
session_start();

require './../../config.php';

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
                

                if ($array[$i]->rol_id == 1) {
                    $_SESSION["tecnico"] = $array[$i]->rol_id;
                    echo 1;
                }elseif ($array[$i]->rol_id == 2) {
                    $_SESSION["admon"] = $array[$i]->rol_id;
                    echo 2;
                }

                
            } else {
                echo 3; //contraseña no es valida
            }
        }
    } else {
        echo 4; //usuario no es valido
    }
} else {
    header("location: ../");
}