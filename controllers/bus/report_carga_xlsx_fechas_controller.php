<?php

session_start();

require './../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$objPhpexcel = new Spreadsheet();

date_default_timezone_set('America/Bogota');
$fecha_hora_now = date("Y-m-d H:i:s");
$fech_solo = date('Y-m-d');
if ($_POST) {

    require './../../config.php';
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
            $datosCarga = json_encode($datos_validos);
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
            $datosCarga = json_encode($datos_validos);
        }
    }

    $datosDecode = json_decode($datosCarga);

    $fila = 3;

    if (!empty($datosCarga)) {

        //Crear carpeta por usuario
        $directorioReport = '../../files/reporte_carga/' . $empresa . '/';
        if (!file_exists($directorioReport)) {
            mkdir($directorioReport, 0777, true);
        }
//elimina el contenido en carpeta 
        $filesReport = glob($directorioReport . '*'); //obtenemos todos los nombres de los ficheros
        foreach ($filesReport as $file) {
            if (is_file($file)) {
                unlink($file); //elimino el fichero
            }
        }

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath('../../e_somos_soc_sistem/assets/images/' . $empresa . '.png');
        $drawing->setCoordinates('A1');
        $drawing->setHeight(80);
        
        $objPhpexcel->getProperties()->setCreator("e_somos")->setDescription("Reporte Carga ");
        $objPhpexcel->setActiveSheetIndex(0);
        $objPhpexcel->getActiveSheet()->setTitle("Control Carga");
        $objPhpexcel->getActiveSheet()->mergeCells('A1:B1');
        $objPhpexcel->getActiveSheet()->getRowDimension('1')->setRowHeight(80);
        $drawing->setWorksheet($objPhpexcel->getActiveSheet());
        $objPhpexcel->getActiveSheet()->getStyle('A1:I1')
                ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPhpexcel->getActiveSheet()->getStyle('A1:I1')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $objPhpexcel->getActiveSheet()->getCell('C1')->setValue("REPORTE CONTROL CARGA FLOTA");
        $objPhpexcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
        $objPhpexcel->getActiveSheet()->mergeCells('C1:I1');

        $objPhpexcel->getActiveSheet()->setCellValue('A2', 'Fecha Soc_Out');
        $objPhpexcel->getActiveSheet()->setCellValue('B2', 'Movil');
        $objPhpexcel->getActiveSheet()->setCellValue('C2', 'Ultimo Km_ODO');
        $objPhpexcel->getActiveSheet()->setCellValue('D2', 'Km Recorrido');
        $objPhpexcel->getActiveSheet()->setCellValue('E2', 'SOC IN');
        $objPhpexcel->getActiveSheet()->setCellValue('F2', 'SOC OUT');
        $objPhpexcel->getActiveSheet()->setCellValue('G2', 'KWh');
        $objPhpexcel->getActiveSheet()->setCellValue('H2', 'Rendimiento');
        $objPhpexcel->getActiveSheet()->setCellValue('I2', 'Lavado');
        $objPhpexcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
        $objPhpexcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(TRUE);
        $objPhpexcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(TRUE)
                ->setName('Calibri')->setSize(16);

        for ($i = 0; $i < count($datosDecode); $i++) {

            $fecha = $datosDecode[$i]->fecha;
            $movil = $datosDecode[$i]->movil;
            $ult_km_odo = $datosDecode[$i]->ult_km_odo;
            $soc_in = $datosDecode[$i]->soc_in;
            $km_rec = $datosDecode[$i]->ult_km_rec;
            $soc_out = $datosDecode[$i]->soc_out;
            $kwh = $datosDecode[$i]->kwh;
            $rendimiento = $datosDecode[$i]->rendimiento;
            $lavado = $datosDecode[$i]->lavado;

            $objPhpexcel->getActiveSheet()->setCellValue('A' . $fila, $fecha);
            $objPhpexcel->getActiveSheet()->setCellValue('B' . $fila, $movil);
            $objPhpexcel->getActiveSheet()->setCellValue('C' . $fila, $ult_km_odo);
            $objPhpexcel->getActiveSheet()->setCellValue('D' . $fila, $km_rec);
            $objPhpexcel->getActiveSheet()->setCellValue('E' . $fila, $soc_in);
            $objPhpexcel->getActiveSheet()->setCellValue('F' . $fila, $soc_out);
            $objPhpexcel->getActiveSheet()->setCellValue('G' . $fila, $kwh);
            $objPhpexcel->getActiveSheet()->setCellValue('H' . $fila, $rendimiento);
            $objPhpexcel->getActiveSheet()->setCellValue('I' . $fila, $lavado);

            if ($lavado === 'SI') {
                $objPhpexcel->getActiveSheet()->getStyle('I' . $fila)
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $objPhpexcel->getActiveSheet()->getStyle('I' . $fila)
                        ->getFill()->getStartColor()->setRGB('C3EAFF');
            } elseif ($lavado === 'NO') {
                $objPhpexcel->getActiveSheet()->getStyle('I' . $fila)
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $objPhpexcel->getActiveSheet()->getStyle('I' . $fila)
                        ->getFill()->getStartColor()->setRGB('FFC3C3');
            } else {
                
            }

            $fila++;
        }

        $objPhpexcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
        $objPhpexcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $objPhpexcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $objPhpexcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
        $objPhpexcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPhpexcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPhpexcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $objPhpexcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
        $objPhpexcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);

        $writer = new Xlsx($objPhpexcel);
        $writer->save('../../files/reporte_carga/' . $empresa . '/Reporte_Carga_' . $empresa . '_' . $fecha_inicio . '_al_' . $fecha_fin . '.xlsx');
        echo 'reporte_carga/' . $empresa . '/Reporte_Carga_' . $empresa . '_' . $fecha_inicio . '_al_' . $fecha_fin;
    } else {
        echo 1;
    }
} else {
    header("location../");
}    