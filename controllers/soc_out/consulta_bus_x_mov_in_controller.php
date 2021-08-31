<?php

session_start();

require '../../config.php';

if ($_POST) {

    $bus_dao = new Bus_DAO();

    $num_movil = $_POST["inpNumMovilOut"];

    if ($_SESSION["empresa"] == 1) {
        $movil = "Z91-" . $num_movil; //serial e_somos alimentacion
        echo json_encode($bus_dao->consultaBus_x_movil_in($_SESSION["empresa"], $movil));
    } else {
        $movil = "Z66-" . $num_movil; //serial e_somos fontibon
        echo json_encode($bus_dao->consultaBus_x_movil_in($_SESSION["empresa"], $movil));
    }
} else {
    header("location: ../");
}
