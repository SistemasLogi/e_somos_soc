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

    $datosCarga = json_encode($bus_dao->consultaGeneralAllBusRendimiento($_SESSION["empresa"]));
    $datosDecode = json_decode($datosCarga);

    $fila = 3;

    if (!empty($datosCarga)) {

        $empresa = $_SESSION["empresa"];

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

        $objPhpexcel = new Spreadsheet();
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

            $fecha = $datosDecode[$i]->sout_fecha;
            $movil = $datosDecode[$i]->bus_num_movil;
            if ($datosDecode[$i]->fecha == 1) {
                $ult_km_odo = $datosDecode[$i]->prev_km_in;
                $soc_in = $datosDecode[$i]->sin_in;
            } else {
                $ult_km_odo = $datosDecode[$i]->sin_km;
                $soc_in = $datosDecode[$i]->prev_soc_in;
            }
            $km_rec = $datosDecode[$i]->ult_km_rec;
            $soc_out = $datosDecode[$i]->sout_out;
            $kwh = $datosDecode[$i]->sout_kwh;
            $rendimiento = $datosDecode[$i]->rendimiento;
            $lavado = $datosDecode[$i]->sout_lavado;

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
        $writer->save('../../files/reporte_carga/' . $empresa . '/Reporte_Carga_' . $empresa . '_' . $fech_solo . '.xlsx');
        echo 'reporte_carga/' . $empresa . '/Reporte_Carga_' . $empresa . '_' . $fech_solo;
    } else {
        echo 1;
    }
} else {
    header("location../");
}    