<?php

require './../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

require './../../config.php';

date_default_timezone_set('America/Bogota');
$fecha_hora_now = date("Y-m-d H:i:s");

if ($_POST) {

    $xls_name = '../../files/temp_flota_nueva/' . $_SESSION["empresa"] . '/' . $_SESSION["empresa"] . '_flota_nueva' . '.xlsx';

    $spreadsheet = IOFactory::load($xls_name);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    if ($sheetData[1]['A'] == "MOVIL" && $sheetData[1]['B'] == "PLACA" && $sheetData[1]['E'] == "TIPOLOGIA" && $sheetData[1]['H'] == "Voltaje" && $sheetData[1]['I'] == "Potencia") {

        $obj_bus_vo = new Bus_VO();

        $sql = "INSERT INTO bus VALUES "; //cabecera del insert

        $reg_buenos = 0;
        $reg_error = 0;

        for ($i = 2; $i <= count($sheetData); $i++) {

            $obj_bus_vo->setEm_id($_SESSION["empresa"]);
            $obj_bus_vo->setBus_num_movil($sheetData[$i]['A']);
            $obj_bus_vo->setBus_placa($sheetData[$i]['B']);
            $obj_bus_vo->setBus_modelo($sheetData[$i]['C']);
            $obj_bus_vo->setBus_ref($sheetData[$i]['D']);
            if (is_numeric($sheetData[$i]['E'])) {
                $obj_bus_vo->setTip_id($sheetData[$i]['E']);
            } else {
                $obj_bus_vo->setTip_id("");
            }
            $obj_bus_vo->setBus_num_vin($sheetData[$i]['F']);
            $obj_bus_vo->setBus_motor($sheetData[$i]['G']);
            $obj_bus_vo->setBus_voltaje($sheetData[$i]['H']);
            $obj_bus_vo->setBus_potencia($sheetData[$i]['I']);
            $obj_bus_vo->setBus_torque($sheetData[$i]['J']);

            if (empty($obj_bus_vo->getBus_num_movil()) || empty($obj_bus_vo->getBus_placa()) || empty($obj_bus_vo->getTip_id()) || empty($obj_bus_vo->getBus_voltaje()) || empty($obj_bus_vo->getBus_potencia())) {
                if (empty($obj_env_vo->getBus_num_movil())) {
                    $datos_errados[$reg_error] = "Error en la linea " . $i . " columna A numero de movil";
                }
                if (empty($obj_bus_vo->getBus_placa())) {
                    $datos_errados[$reg_error] = "Error en la linea " . $i . " columna B placa";
                }
                if (empty($obj_bus_vo->getTip_id())) {
                    $datos_errados[$reg_error] = "Error en la linea " . $i . " columna E tipologia, el campo debe ser numero sin espacios";
                }
                if (empty($obj_bus_vo->getBus_voltaje())) {
                    $datos_errados[$reg_error] = "Error en la linea " . $i . " columna H voltaje";
                }
                if (empty($obj_bus_vo->getBus_potencia())) {
                    $datos_errados[$reg_error] = "Error en la linea " . $i . " columna I potencia";
                }
                $reg_error++;
            } else {
                $datos_insert[$reg_buenos] = "(" . $obj_bus_vo->getEm_id() . ",'" . $obj_bus_vo->getBus_num_movil() . "','" . $obj_bus_vo->getBus_placa() . "',"
                        . "'" . $obj_bus_vo->getBus_modelo() . "','" . $obj_bus_vo->getBus_ref() . "'," . $obj_bus_vo->getTip_id() . ",'" . $obj_bus_vo->getBus_num_vin() . "',"
                        . "'" . $obj_bus_vo->getBus_motor() . "','" . $obj_bus_vo->getBus_voltaje() . "','" . $obj_bus_vo->getBus_potencia() . "','" . $obj_bus_vo->getBus_torque() . "')";

                $reg_buenos++;
            }
        }

        if (empty($datos_errados)) {

            $sentencia = "";
            $miniarray = array_chunk($datos_insert, 200);
            $num_fracciones = count($miniarray);
//            $num_registros = count($miniarray[3]);
//            echo $num_registros - 1;
//            $array_num = count($datos_insert);
            $contador = 0;

            for ($i = 0; $i < $num_fracciones; $i++) {
                $sentencia = $sql;
                $num_registros = count($miniarray[$i]);
                for ($j = 0; $j < $num_registros; $j++) {
                    $contador++;
                    if ($j == ($num_registros - 1)) {
                        $sentencia .= $miniarray[$i][$j] . ";";
//                        echo $miniarray[$i][$j] . ";";
//                        echo '<br>';
                    } else {
                        $sentencia .= $miniarray[$i][$j] . ",";
                    }
                }
                $BDP = new MySQL();
                $in = $BDP->execute_query($sentencia);
//            echo $sentencia;
                if ($in == 1) {
//            echo "OK" . " " . $contador;
//            echo '<br>';
                } else {
                    echo "<div class='text-center' style='color: #990000;'>Error entre las lineas " . ($contador - $num_registros) . " y " . $contador . "</div>";
                    echo '<br>';
                }
            }

            echo 1;
           
        } else {

            echo "<div class='col-lg-12' id='tablaEnv'><table class='table table-responsive-sm table-sm table-hover table-bordered table-fixed' id='tableErrores'><thead>"
            . "<tr class='table-light'>"
            . "<th scope='col'>ERROR ARCHIVO</th>"
            . "</tr></thead><tbody>";

            foreach ($datos_errados as &$valor) {
                echo '<tr class="table-danger table-sm">';
                echo '<td>' . $valor . '</td></tr>';
            }
            echo "</tbody></table></div>";
            echo "<strong>&nbsp;&nbsp;NO SE GUARDARON LOS DATOS, por favor corrija las lineas erradas y suba nuevamente el archivo.</strong>";
        }



        //****************************************///***************///*************************///*************
    } else {
        //***Accion si plantilla no coincide**//
        echo "<div class='alert alert-dismissible alert-danger'>"
        . "<strong>Error 5, La plantilla xlsx no es la correcta!</strong>"
        . "</div>";
    }

//    
} else {
    header("location../");
}