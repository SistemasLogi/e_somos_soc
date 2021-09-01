<?php

session_start();

if ($_POST) {
    require '../../config.php';
    date_default_timezone_set('America/Bogota');
    $fecha_hora = date("Y-m-d H:i:s");
    $soc_in_dao = new Soc_in_DAO();
    $soc_in_vo = new Soc_in_VO();

    $soc_in_vo->setSin_fecha($fecha_hora);
    $soc_in_vo->setBus_em_id($_SESSION["empresa"]);
    $soc_in_vo->setBus_num_movil($_POST["inpNumBusIn"]);
    $soc_in_vo->setSin_km($_POST["inpKmIn"]);
    $soc_in_vo->setSin_in($_POST["inpSocIn"]);
    $soc_in_vo->setSin_observ("");
    $soc_in_vo->setUs_id($_SESSION["us_id"]);
    $soc_in_vo->setSin_num_electrolinea($_POST["inpElectLineIn"]);

    echo $soc_in_dao->guardarSocIn($soc_in_vo);
} else {
    header("location../");
}