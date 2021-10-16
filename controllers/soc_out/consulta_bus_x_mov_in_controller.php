<?php

session_start();

require './../../config.php';

if ($_POST) {

    $bus_dao = new Bus_DAO();

    $num_movil = $_POST["inpNumMovilOut"];

    if ($_SESSION["empresa"] == 1) {
        $movil = "Z91-" . $num_movil; //serial e_somos alimentacion
        $datos_bus = json_encode($bus_dao->consultaBus_x_movil_in($_SESSION["empresa"], $movil));
        $datosDecode = json_decode($datos_bus);
        if (!empty($datos_bus)) {
            if ($datosDecode[0]->fecha == 0) {
                if ($datosDecode[0]->out_fecha == 0) {
                    echo $datos_bus; //primer registro del bus valido
                } else {
                    echo 1; //ultimo registro del bus soc_out no cumple con la paridad
                }
            } elseif ($datosDecode[0]->fecha == 1) {
                echo $datos_bus; //proceso normal de paridad            
            } else {
                echo 2; //error inesperado
            }
        } else {
            echo 3; //bus no existe en la base de datos
        }
    } else {
        $movil = "Z66-" . $num_movil; //serial e_somos fontibon
        $datos_bus = json_encode($bus_dao->consultaBus_x_movil_in($_SESSION["empresa"], $movil));
        $datosDecode = json_decode($datos_bus);
        if (!empty($datos_bus)) {
            if ($datosDecode[0]->fecha == 0) {
                if ($datosDecode[0]->out_fecha == 0) {
                    echo $datos_bus; //primer registro del bus valido
                } else {
                    echo 1; //ultimo registro del bus soc_out no cumple con la paridad
                }
            } elseif ($datosDecode[0]->fecha == 1) {
                echo $datos_bus; //proceso normal de paridad            
            } else {
                echo 2; //error inesperado
            }
        } else {
            echo 3; //bus no existe en la base de datos
        }
    }
} else {
    header("location: ../");
}