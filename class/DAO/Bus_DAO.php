<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bus_DAO
 *
 * @author TECNOLOGIA-LOGI
 */
class Bus_DAO {
    //put your code here

    /**
     * Funcion que retorna los datos de un bus segun numero de movil en tabla soc in
     * la consulta se realiza para el registro en soc out para comprobar si existe el par
     * @param type $empresa
     * @param type $movil
     * @return type
     */
    function consultaBus_x_movil_in($empresa, $movil) {
        $sql = "SELECT M.* FROM ("
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha < T3.sout_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT * FROM bus WHERE em_id = " . $empresa . " AND bus_num_movil = '" . $movil . "')AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " AND b.bus_num_movil = '" . $movil . "' "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " AND TP.bus_num_movil = '" . $movil . "' "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna los datos de un bus segun numero de movil en tabla soc out
     * la consulta se realiza para el registro en soc in para comprobar si existe el par
     * @param type $empresa
     * @param type $movil
     * @return type
     */
    function consultaBus_x_movil_out($empresa, $movil) {
        $sql = "SELECT M.* FROM ("
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha > T3.sout_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT * FROM bus WHERE em_id = " . $empresa . " AND bus_num_movil = '" . $movil . "')AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " AND b.bus_num_movil = '" . $movil . "' "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " AND TP.bus_num_movil = '" . $movil . "' "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna el total de los buses en proceso de soc_in
     * buses disponibles para registrar en proceso de soc_out
     * @param type $empresa
     * @return type
     */
    function consultaGeneral_in($empresa) {
        $sql = "SELECT M.* FROM ("
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha < T3.sout_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT * FROM bus WHERE em_id = " . $empresa . ")AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M WHERE  (M.fecha = 0 || M.out_fecha = 0) AND M.in_fecha <> 0;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna el total de los buses en proceso de soc_out
     * buses disponibles para registrar en proceso de soc_in
     * @param type $empresa
     * @return type
     */
    function consultaGeneral_out($empresa) {
        $sql = "SELECT M.* FROM ("
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha > T3.sout_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT * FROM bus WHERE em_id = " . $empresa . ")AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M WHERE  (M.fecha = 0 || M.in_fecha = 0) AND M.out_fecha <> 0;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

}
