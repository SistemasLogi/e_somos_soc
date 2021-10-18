<?php

session_start();

require '../../config.php';

if ($_POST) {
    $nombre_fichero = $_FILES["inpMasBuses"]["name"];

    $name_xlsx = $_SESSION["empresa"] . '_flota_nueva';
    $_SESSION["name_xlsx"] = $name_xlsx;

    $name_directorio = $_SESSION["empresa"];

//    $tipo_fichero = $_FILES["inpFileMasInventario"]["type"];
    $extension = pathinfo($nombre_fichero, PATHINFO_EXTENSION);

    //Crear carpeta por cliente para temporal de xlsx alistamiento
    $directorioAlist = '../../files/temp_flota_nueva/' . $name_directorio . '/';
    if (!file_exists($directorioAlist)) {
        mkdir($directorioAlist, 0777, true);
    }

    if (move_uploaded_file($_FILES["inpMasBuses"]["tmp_name"], "../../files/temp_flota_nueva/" . $name_directorio . "/" . $nombre_fichero)) {

        $exist_xlsx = "../../files/temp_flota_nueva/" . $name_directorio . "/" . $name_xlsx . ".xlsx";

        if (file_exists($exist_xlsx)) {
            unlink("../../files/temp_flota_nueva/" . $name_directorio . "/" . $name_xlsx . ".xlsx");
        }

        rename("../../files/temp_flota_nueva/" . $name_directorio . "/" . $nombre_fichero, "../../files/temp_flota_nueva/" . $name_directorio . "/" . $name_xlsx . "." . $extension);
        if ($extension == "xlsx") {
//            echo 1;
            require 'leer_xlsx_new_bus_controller.php';
        } else {
            echo "ARCHIVO NO COMPATIBLE";
        }
    } else {
        echo "No se pudo cargar el archivo en carpeta temp";
    }
} else {
    header("location: ../");
}