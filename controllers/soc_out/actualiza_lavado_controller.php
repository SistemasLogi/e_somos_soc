<?php

session_start();

if ($_POST) {
    require '../../config.php';
    $soc_out_dao = new Soc_out_DAO();

    $lavado = $_POST["radioLavado"];
    $fecha = $_POST["inpFechaOut"];
    $empresa = $_SESSION["empresa"];
    $num_movil = $_POST["inpNumBusOut"];

    echo $soc_out_dao->actualizarLavOut($lavado, $fecha, $empresa, $num_movil);
} else {
    header("location../");
}