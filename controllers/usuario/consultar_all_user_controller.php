<?php

session_start();

require '../../config.php';

if ($_POST) {

    $usuario_dao = new Usuario_DAO();

    echo json_encode($usuario_dao->consultaUsuarios_empresa($_SESSION["empresa"]));
} else {
    header("location: ../");
}