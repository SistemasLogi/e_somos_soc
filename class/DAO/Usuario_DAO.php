<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_DAO
 *
 * @author TECNOLOGIA-LOGI
 */
class Usuario_DAO {
    //put your code here

    /**
     * Funcion que retorna los datos de un usuario segun la cedula
     * @param type $empresa
     * @param type $num_cedula
     * @return type
     */
    function consultaUsuario_x_cedula($empresa, $num_cedula) {
        $sql = "SELECT * FROM usuario WHERE em_id = " . $empresa . " AND us_cedula = " . $num_cedula . ";";
        $BD = new MySQL();
        return $BD->query($sql);
    }

    /**
     * Funcion que actualiza usurio y password
     * @param type $user_vo
     * @return type
     */
    function actualizar_us_pass($user_vo) {
        $sql = "UPDATE usuario SET us_usuario = '" . $user_vo->getUs_usuario() . "', us_password = '" . $user_vo->getUs_password() . "' WHERE us_id = " . $user_vo->getUs_id() . ";";
        $BD = new MySQL();
        return $BD->execute_query($sql);
    }

}
