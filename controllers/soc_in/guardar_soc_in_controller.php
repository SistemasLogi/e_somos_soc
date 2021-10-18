<?php

session_start();

if ($_POST) {
    require '../../config.php';
    date_default_timezone_set('America/Bogota');
    $fecha_hora = date("Y-m-d H:i:s");
    $soc_in_dao = new Soc_in_DAO();
    $soc_in_vo = new Soc_in_VO();
    $bus_dao = new Bus_DAO();

    $soc_in_vo->setSin_fecha($fecha_hora);
    $soc_in_vo->setBus_em_id($_SESSION["empresa"]);
    $soc_in_vo->setBus_num_movil($_POST["inpNumBusIn"]);
    $soc_in_vo->setSin_km($_POST["inpKmIn"]);
    $soc_in_vo->setSin_in($_POST["inpSocIn"]);
    $soc_in_vo->setSin_observ("");
    $soc_in_vo->setUs_id($_SESSION["us_id"]);
    $soc_in_vo->setSin_num_electrolinea($_POST["inpElectLineIn"]);
    $elect_input = $_POST["inpElectLineIn"];

    $array_all_bus = json_encode($bus_dao->consultaGeneral_out($_SESSION["empresa"]));

    $array_decode = json_decode($array_all_bus);

    if (!empty($array_all_bus)) {

        $ocupado = false;
        $movil_in = "";

        for ($i = 0; $i < count($array_decode); $i++) {

            if ($array_decode[$i]->sin_num_electrolinea == $elect_input) {
                $movil_in = $array_decode[$i]->bus_num_movil; //la electrolinea se encuentra ocupada
                $ocupado = true;
                break;
            }
        }

        if ($ocupado == true) {
            echo $movil_in;
        } else {
            echo $soc_in_dao->guardarSocIn($soc_in_vo);
        }
    } else {
        echo $soc_in_dao->guardarSocIn($soc_in_vo);
    }
} else {
    header("location: ../");
}