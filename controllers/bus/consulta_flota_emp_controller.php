<?php

session_start();

require './../../config.php';

if ($_POST) {

    $bus_dao = new Bus_DAO();

    echo json_encode($bus_dao->consultaGeneralAllBusEmpresa($_SESSION["empresa"]));
} else {
    header("location: ../");
}