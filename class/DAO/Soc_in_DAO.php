<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Soc_in_DAO
 *
 * @author ANDRES
 */
class Soc_in_DAO {
    //put your code here

    /**
     * Funcion que inserta un registro en tabla soc_in
     * @param type $soc_out_in
     */
    function guardarSocIn($soc_out_in) {
        $sql = "INSERT INTO soc_in VALUES ('" . $soc_out_in->getSin_fecha() . "', " . $soc_out_in->getBus_em_id() . ", '" . $soc_out_in->getBus_num_movil() . "', "
                . "" . $soc_out_in->getSin_km() . ", " . $soc_out_in->getSin_in() . ", '" . $soc_out_in->getSin_observ() . "', " . $soc_out_in->getUs_id() . ", "
                . "" . $soc_out_in->getSin_num_electrolinea() . ");";
        $BD = new MySQL();
//        return $sql;
        return $BD->execute_query($sql);
    }

}
