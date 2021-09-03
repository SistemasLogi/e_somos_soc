<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Soc_out_DAO
 *
 * @author TECNOLOGIA-LOGI
 */
class Soc_out_DAO {
    //put your code here

    /**
     * Funcion que inserta un registro en tabla soc_out
     * @param type $soc_out_vo
     */
    function guardarSocOut($soc_out_vo) {
        $sql = "INSERT INTO soc_out VALUES ('" . $soc_out_vo->getSout_fecha() . "', " . $soc_out_vo->getBus_em_id() . ", '" . $soc_out_vo->getBus_num_movil() . "', "
                . "" . $soc_out_vo->getSout_km() . ", " . $soc_out_vo->getSout_out() . ", '" . $soc_out_vo->getSout_observ() . "', " . $soc_out_vo->getUs_id() . ", "
                . "'" . $soc_out_vo->getSout_lavado() . "', " . $soc_out_vo->getSout_num_electrolinea() . ");";
        $BD = new MySQL();
//        return $sql;
        return $BD->execute_query($sql);
    }

    /**
     * Funcion que actualiza lavado de bus en tabla soc_out
     * @param type $lavado
     * @param type $fecha
     * @param type $empresa
     * @param type $num_movil
     * @return type
     */
    function actualizarLavOut($lavado, $fecha, $empresa, $num_movil) {
        $sql = "UPDATE soc_out SET sout_lavado = '" . $lavado . "' "
                . "WHERE sout_fecha = '" . $fecha . "' "
                . "AND bus_em_id = " . $empresa . " "
                . "AND bus_num_movil = '" . $num_movil . "';";
        $BD = new MySQL();
//        return $sql;
        return $BD->execute_query($sql);
    }

}
