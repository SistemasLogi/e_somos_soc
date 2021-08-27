<?php

/**
 * Archivo que controla las rutas requeridas para un correcto 
 * funcionemiento de la aplicacion
 */
ob_start();
//session_start();
//ini_set(display_errors,1);
$r_r = "";
while (!file_exists($r_r . 'class/Mysql/Datos.php')) {
    $r_r .= '../';
}
/* * Clases de conexion a BD* */
require $r_r . 'Class/Mysql/Datos.php';
require $r_r . 'Class/Mysql/MySQL.php';

/* * Clases de tipo VO* */
require $r_r . 'class/VO/Cliente_VO.php';

/* * Clases de tipo DAO* */
require $r_r . 'class/DAO/Cliente_DAO.php';

/* * Clase PDF * */

/* * Clase Email* */

/* * Clase QR* */

?>