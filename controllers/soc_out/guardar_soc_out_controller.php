<?php

session_start();

if ($_POST) {
    require '../../config.php';
    date_default_timezone_set('America/Bogota');
    $fecha_hora = date("Y-m-d H:i:s");
    $soc_out_dao = new Soc_out_DAO();
    $soc_out_vo = new Soc_out_VO();

    $soc_out_vo->setSout_fecha($fecha_hora);
    $soc_out_vo->setBus_em_id($_SESSION["empresa"]);
    $soc_out_vo->setBus_num_movil($_POST["inpNumBusOut"]);
    $soc_out_vo->setSout_km($_POST["inpKWhOut"]);
    $soc_out_vo->setSout_out($_POST["inpSocOut"]);
    $soc_out_vo->setSout_observ($_POST["inpObservOut"]);
    $soc_out_vo->setUs_id($_SESSION["us_id"]);
    $soc_out_vo->setSout_lavado($_POST["radioLavado"]);
    $soc_out_vo->setSout_num_electrolinea($_POST["inpElectLineOut"]);

    echo $soc_out_dao->guardarSocOut($soc_out_vo);
} else {
    header("location../");
}