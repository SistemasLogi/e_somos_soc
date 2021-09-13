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
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha > T3.sout_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.bus_num_movil = '" . $movil . "' AND bus.tip_id = tip.tip_id)AS T1 "
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
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T3.sout_fecha > T2.sin_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.bus_num_movil = '" . $movil . "' AND bus.tip_id = tip.tip_id)AS T1 "
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
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha > T3.sout_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.tip_id = tip.tip_id)AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M WHERE (M.fecha = 0 && M.out_fecha <> 0);";
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
                . "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T3.sout_fecha, T3.sout_kwh, T3.sout_out, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T3.sout_fecha > T2.sin_fecha, 1, 0)AS fecha "
                . "FROM "
                . "(SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.tip_id = tip.tip_id)AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M WHERE (M.fecha = 0 && M.in_fecha <> 0);";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna el total de los buses por proceso
     * @param type $empresa
     * @return type
     */
    function consultaGeneralAllBus($empresa) {
        $sql = "SELECT M.* FROM (SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T2.rol_id AS in_rol, T2.us_cedula AS in_cedula, T2.us_nombre AS in_nombre, T3.sout_lavado, "
                . "T3.sout_fecha, T3.sout_kwh, T3.sout_out, T3.rol_id AS out_rol, T3.us_cedula AS out_cedula, T3.us_nombre AS out_nombre, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T3.sout_fecha > T2.sin_fecha, 1, 0)AS fecha "
                . "FROM (SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.tip_id = tip.tip_id)AS T1 "
                . "LEFT JOIN (SELECT b.*, u.rol_id, u.us_cedula, u.us_nombre FROM soc_in AS b, usuario AS u WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil) AND b.us_id = u.us_id)AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil LEFT JOIN (SELECT TP.*, TU.rol_id, TU.us_cedula, TU.us_nombre FROM soc_out AS TP, usuario AS TU WHERE TP.bus_em_id = " . $empresa . " "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil) AND TP.us_id = TU.us_id)AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M WHERE (M.fecha = 0 && M.in_fecha <> 0) "
                . "UNION SELECT M.* FROM (SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T2.rol_id AS in_rol, T2.us_cedula AS in_cedula, T2.us_nombre AS in_nombre, T3.sout_lavado, "
                . "T3.sout_fecha, T3.sout_kwh, T3.sout_out, T3.rol_id AS out_rol, T3.us_cedula AS out_cedula, T3.us_nombre AS out_nombre, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha > T3.sout_fecha, 0, 1)AS fecha "
                . "FROM (SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.tip_id = tip.tip_id)AS T1 "
                . "LEFT JOIN (SELECT b.*, u.rol_id, u.us_cedula, u.us_nombre FROM soc_in AS b, usuario AS u WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil) AND b.us_id = u.us_id)AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil LEFT JOIN (SELECT TP.*, TU.rol_id, TU.us_cedula, TU.us_nombre FROM soc_out AS TP, usuario AS TU WHERE TP.bus_em_id = " . $empresa . " "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil) AND TP.us_id = TU.us_id)AS T3 "
                . "ON T1.bus_num_movil = T3.bus_num_movil)AS M WHERE (M.fecha = 1 && M.out_fecha <> 0);";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna el total de los buses por proceso y el calculo de km y rendimiento
     * @param type $empresa
     * @return type
     */
    function consultaGeneralAllBusRendimiento($empresa) {
        $sql = "SELECT M.* FROM (SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T2.rol_id AS in_rol, T2.us_cedula AS in_cedula, T2.us_nombre AS in_nombre, T3.sout_lavado, T3.sout_fecha, T3.sout_kwh, T3.sout_out, T3.rol_id AS out_rol, "
                . "T3.us_cedula AS out_cedula, T3.us_nombre AS out_nombre, IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T3.sout_fecha > T2.sin_fecha, 1, 0)AS fecha, T4.sin_fecha AS prev_fec_in, T4.sin_km AS prev_km_in, T4.sin_in AS prev_soc_in, "
                . "IFNULL(T4.sin_km - T5.sin_km, T4.sin_km) AS ult_km_rec, ((T2.sin_km - T4.sin_km)/T3.sout_kwh) AS rendimiento FROM (SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.tip_id = tip.tip_id)AS T1 "
                . "LEFT JOIN (SELECT b.*, u.rol_id, u.us_cedula, u.us_nombre FROM soc_in AS b, usuario AS u WHERE b.bus_em_id = " . $empresa . " AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil) AND b.us_id = u.us_id)AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil LEFT JOIN (SELECT TP.*, TU.rol_id, TU.us_cedula, TU.us_nombre FROM soc_out AS TP, usuario AS TU WHERE TP.bus_em_id = " . $empresa . " AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil) "
                . "AND TP.us_id = TU.us_id)AS T3 ON T1.bus_num_movil = T3.bus_num_movil LEFT JOIN (SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " AND b.sin_fecha = (SELECT MAX(bs.sin_fecha) FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil "
                . "AND bs.sin_fecha < (SELECT MAX(bu.sin_fecha) FROM soc_in AS bu WHERE bu.bus_num_movil = bs.bus_num_movil)))AS T4 ON T3.bus_num_movil = T4.bus_num_movil LEFT JOIN (SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " AND b.sin_fecha = (SELECT MAX(bs.sin_fecha) "
                . "FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil AND bs.sin_fecha < (SELECT MAX(bu.sin_fecha) FROM soc_in AS bu WHERE bu.bus_num_movil = bs.bus_num_movil AND bu.sin_fecha = (SELECT MAX(bss.sin_fecha) FROM soc_in AS bss WHERE bu.bus_num_movil = bss.bus_num_movil "
                . "AND bss.sin_fecha < (SELECT MAX(bus.sin_fecha) FROM soc_in AS bus WHERE bus.bus_num_movil = bss.bus_num_movil)))))AS T5 ON T4.bus_num_movil = T5.bus_num_movil)AS M WHERE (M.fecha = 0 && M.in_fecha <> 0) "
                . "UNION "
                . "SELECT M.* FROM (SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in, T2.sin_num_electrolinea, T2.rol_id AS in_rol, T2.us_cedula AS in_cedula, T2.us_nombre AS in_nombre, T3.sout_lavado, T3.sout_fecha, T3.sout_kwh, T3.sout_out, T3.rol_id AS out_rol, T3.us_cedula AS out_cedula, T3.us_nombre AS out_nombre, "
                . "IFNULL(T2.sin_fecha,0)AS in_fecha, IFNULL(T3.sout_fecha,0)AS out_fecha, IF(T2.sin_fecha > T3.sout_fecha, 0, 1)AS fecha, T4.sin_fecha AS prev_fec_in, T4.sin_km AS prev_km_in, T4.sin_in AS prev_soc_in, (T2.sin_km - T4.sin_km) AS ult_km_rec, ((T2.sin_km - T4.sin_km)/T3.sout_kwh) "
                . "AS rendimiento FROM (SELECT bus.*, tip.tip_tipo FROM bus AS bus, tipologia AS tip WHERE bus.em_id = " . $empresa . " AND bus.tip_id = tip.tip_id)AS T1 LEFT JOIN (SELECT b.*, u.rol_id, u.us_cedula, u.us_nombre FROM soc_in AS b, usuario AS u "
                . "WHERE b.bus_em_id = " . $empresa . " AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil) AND b.us_id = u.us_id)AS T2 ON T1.bus_num_movil = T2.bus_num_movil LEFT JOIN (SELECT TP.*, TU.rol_id, TU.us_cedula, TU.us_nombre "
                . "FROM soc_out AS TP, usuario AS TU WHERE TP.bus_em_id = " . $empresa . " AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil) AND TP.us_id = TU.us_id)AS T3 ON T1.bus_num_movil = T3.bus_num_movil LEFT JOIN (SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha) FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil AND bs.sin_fecha < (SELECT MAX(bu.sin_fecha) FROM soc_in AS bu WHERE bu.bus_num_movil = bs.bus_num_movil)))AS T4 ON T2.bus_num_movil = T4.bus_num_movil "
                . "LEFT JOIN (SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " AND b.sin_fecha = (SELECT MAX(bs.sin_fecha) FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil AND bs.sin_fecha < (SELECT MAX(bu.sin_fecha) FROM soc_in AS bu WHERE bu.bus_num_movil = bs.bus_num_movil "
                . "AND bu.sin_fecha = (SELECT MAX(bss.sin_fecha) FROM soc_in AS bss WHERE bu.bus_num_movil = bss.bus_num_movil AND bss.sin_fecha < (SELECT MAX(bus.sin_fecha) FROM soc_in AS bus WHERE bus.bus_num_movil = bss.bus_num_movil)))))AS T5 ON T4.bus_num_movil = T5.bus_num_movil)AS M WHERE (M.fecha = 1 && M.out_fecha <> 0);";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna el historico de los buses por proceso
     * @param type $empresa
     * @param type $param_out
     * @param type $param_in
     * @return type
     */
    function consultaGeneralAllBusRendimientoParam($empresa, $param_out, $param_in) {
        $sql = "SELECT M.* FROM ("
                . "SELECT O.sout_fecha AS fecha, O.bus_em_id AS empresa, O.bus_num_movil AS movil, O.sout_kwh AS kwh, O.sout_out AS soc_out, O.us_id AS us_id, O.sout_lavado AS lavado, O.sout_num_electrolinea AS elct, "
                . "0 AS km, 0 AS soc_in, 0 AS estado, B.bus_placa AS placa "
                . "FROM soc_out AS O, bus AS B "
                . "WHERE O.bus_num_movil = B.bus_num_movil AND O.bus_em_id = " . $empresa . "" . $param_out . ""
                . "UNION "
                . "SELECT I.sin_fecha AS fecha, I.bus_em_id AS empresa, I.bus_num_movil AS movil, 0 AS kwh, 0 AS soc_out, I.us_id AS us_id, '' AS lavado, I.sin_num_electrolinea AS elct, "
                . "I.sin_km AS km, I.sin_in AS soc_in, 1 AS estado, B.bus_placa AS placa "
                . "FROM soc_in AS I, bus AS B "
                . "WHERE I.bus_num_movil = B.bus_num_movil AND I.bus_em_id = " . $empresa . "" . $param_in . ""
                . ") AS M "
                . "ORDER BY M.movil DESC, M.fecha DESC;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

}
