<?php

session_start();

require './../../config.php';

if ($_POST) {

    $bus_dao = new Bus_DAO();

    $fecha_inicio = $_POST["inpFecIni"];
    $fecha_fin = $_POST["inpFecFin"];
    $num_movil = $_POST["inpNumMovilReport"];

    $hora_desde = '00:00:00';
    $hora_hasta = '23:59:00';

    $empresa = $_SESSION["empresa"];

    if (empty($fecha_inicio) || empty($fecha_fin)) {
        echo json_encode($bus_dao->consultaGeneralAllBusRendimiento($empresa));
    } else {
        $fec_ini = $fecha_inicio . " " . $hora_desde;
        $fec_fin = $fecha_fin . " " . $hora_hasta;
        if (empty($num_movil)) {
            $param_out = " AND O.sout_fecha BETWEEN DATE_ADD('" . $fec_ini . "', INTERVAL -2 DAY) AND '" . $fec_fin . "' ";
            $param_in = " AND I.sin_fecha BETWEEN DATE_ADD('" . $fec_ini . "', INTERVAL -2 DAY) AND '" . $fec_fin . "' ";
            $datos_encode = json_encode($bus_dao->consultaGeneralAllBusRendimientoParam($empresa, $param_out, $param_in));
//            echo json_encode($bus_dao->consultaGeneralAllBusRendimientoParam($_SESSION["empresa"], " AND O.sout_fecha BETWEEN DATE_ADD('" . $fec_ini . "', INTERVAL -2 DAY) AND '" . $fec_fin . "' ", " AND I.sin_fecha BETWEEN DATE_ADD('" . $fec_ini . "', INTERVAL -2 DAY) AND '" . $fec_fin . "' "));

            $datos_decode = json_decode($datos_encode);

            $validos = 0;

            for ($i = 0; $i < count($datos_decode) - 3; $i++) {
                if ($datos_decode[$i]->estado == 0) {

                    $bus = $datos_decode[$i]->movil;

                    if ($datos_decode[$i + 3]->movil === $bus) {
                        $fecha_out = $datos_decode[$i]->fecha;
                        $movil_num = $datos_decode[$i]->movil;
                        $placa_num = $datos_decode[$i]->placa;
                        $ultimo_km_odo = $datos_decode[$i + 1]->km;
                        $ultimo_km_rec = ($datos_decode[$i + 1]->km - $datos_decode[$i + 3]->km);
                        $soc_in = $datos_decode[$i + 1]->soc_in;
                        $soc_out = $datos_decode[$i]->soc_out;
                        $kwh = $datos_decode[$i]->kwh;
                        $rendimiento = ($ultimo_km_rec / $kwh);
                        $lavado_out = $datos_decode[$i]->lavado;

                        $datos_validos[$validos] = array("fecha" => $fecha_out, "movil" => $movil_num, "placa" => $placa_num, "ult_km_odo" => $ultimo_km_odo, "ult_km_rec" => $ultimo_km_rec, "soc_in" => $soc_in, "soc_out" => $soc_out, "kwh" => $kwh, "rendimiento" => $rendimiento, "lavado" => $lavado_out);

                        $validos++;
                    }
                }
            }
            echo json_encode($datos_validos);
        } else {
            if ($_SESSION["empresa"] == 1) {
                $movil = "Z91-" . $num_movil; //serial e_somos alimentacion
            } else {
                $movil = "Z66-" . $num_movil; //serial e_somos fontibon
            }

            $param_out = " AND O.sout_fecha BETWEEN DATE_ADD('" . $fec_ini . "', INTERVAL -2 DAY) AND '" . $fec_fin . "' AND O.bus_num_movil = '" . $movil . "' ";
            $param_in = " AND I.sin_fecha BETWEEN DATE_ADD('" . $fec_ini . "', INTERVAL -2 DAY) AND '" . $fec_fin . "' AND I.bus_num_movil = '" . $movil . "' ";
            $datos_encode = json_encode($bus_dao->consultaGeneralAllBusRendimientoParam($empresa, $param_out, $param_in));
//            echo json_encode($bus_dao->consultaGeneralAllBusRendimientoParam($empresa, $param_out, $param_in));

            $datos_decode = json_decode($datos_encode);

            $validos = 0;

            for ($i = 0; $i < count($datos_decode) - 3; $i++) {
                if ($datos_decode[$i]->estado == 0) {

                    $bus = $datos_decode[$i]->movil;

                    if ($datos_decode[$i + 3]->movil === $bus) {
                        $fecha_out = $datos_decode[$i]->fecha;
                        $movil_num = $datos_decode[$i]->movil;
                        $placa_num = $datos_decode[$i]->placa;
                        $ultimo_km_odo = $datos_decode[$i + 1]->km;
                        $ultimo_km_rec = ($datos_decode[$i + 1]->km - $datos_decode[$i + 3]->km);
                        $soc_in = $datos_decode[$i + 1]->soc_in;
                        $soc_out = $datos_decode[$i]->soc_out;
                        $kwh = $datos_decode[$i]->kwh;
                        $rendimiento = ($ultimo_km_rec / $kwh);
                        $lavado_out = $datos_decode[$i]->lavado;

                        $datos_validos[$validos] = array("fecha" => $fecha_out, "movil" => $movil_num, "placa" => $placa_num, "ult_km_odo" => $ultimo_km_odo, "ult_km_rec" => $ultimo_km_rec, "soc_in" => $soc_in, "soc_out" => $soc_out, "kwh" => $kwh, "rendimiento" => $rendimiento, "lavado" => $lavado_out);

                        $validos++;
                    }
                }
            }
            echo json_encode($datos_validos);
        }
    }
} else {
    header("location: ../");
}