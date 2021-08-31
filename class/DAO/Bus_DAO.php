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
     * Funcion que retorna los datos de un bus segun numero de movil
     * @param type $empresa
     * @param type $movil
     * @return type
     */
    function consultaBus_x_movil($empresa, $movil) {
        $sql = "SELECT T1.*, T2.sout_fecha, T2.sout_kwh, T2.sout_out FROM "
                . "(SELECT * FROM bus WHERE em_id = " . $empresa . " AND bus_num_movil = '" . $movil . "')AS T1 "
                . "LEFT JOIN "
                . "(SELECT TP.* FROM soc_out AS TP WHERE TP.bus_em_id = " . $empresa . " AND TP.bus_num_movil = '" . $movil . "' "
                . "AND TP.sout_fecha = (SELECT MAX(TS.sout_fecha)FROM soc_out AS TS WHERE TP.bus_num_movil = TS.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

    /**
     * Funcion que retorna los datos de un bus segun numero de movil en tabla soc in
     * @param type $empresa
     * @param type $movil
     * @return type
     */
    function consultaBus_x_movil_in($empresa, $movil) {
        $sql = "SELECT T1.*, T2.sin_fecha, T2.sin_km, T2.sin_in FROM "
                . "(SELECT * FROM bus WHERE em_id = " . $empresa . " AND bus_num_movil = '" . $movil . "')AS T1 "
                . "LEFT JOIN "
                . "(SELECT b.* FROM soc_in AS b WHERE b.bus_em_id = " . $empresa . " AND b.bus_num_movil = '" . $movil . "' "
                . "AND b.sin_fecha = (SELECT MAX(bs.sin_fecha)FROM soc_in AS bs WHERE b.bus_num_movil = bs.bus_num_movil))AS T2 "
                . "ON T1.bus_num_movil = T2.bus_num_movil;";
        $BD = new MySQL();
        return $BD->query($sql);
//        return $sql;
    }

}
