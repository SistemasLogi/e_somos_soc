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

    /**
     * Funcion que retorna los datos de un usuario segun username ingresado
     * @param type $empresa
     * @param type $usuario
     * @return type
     */
    function consultaUsuario_login($empresa, $usuario) {
        $sql = "SELECT * FROM usuario WHERE em_id = " . $empresa . " AND us_usuario = '" . $usuario . "';";
        $BD = new MySQL();
        return $BD->query($sql);
    }

    /**
     * Funcion que guarda un usurio
     * @param type $user_vo
     * @return type
     */
    function guardar_us_new($user_vo) {
        $sql = "INSERT INTO usuario VALUES (" . $user_vo->getUs_id() . ", " . $user_vo->getRol_id() . ", " . $user_vo->getUs_cedula() . ", "
                . "'" . $user_vo->getUs_nombre() . "', " . $user_vo->getEm_id() . ", "
                . "'" . $user_vo->getUs_usuario() . "', '" . $user_vo->getUs_password() . "')"
                . "ON DUPLICATE KEY UPDATE rol_id = " . $user_vo->getRol_id() . ", us_cedula = " . $user_vo->getUs_cedula() . ", "
                . "us_nombre = '" . $user_vo->getUs_nombre() . "';";
        $BD = new MySQL();
        return $BD->execute_query($sql);
    }

    /**
     * Funcion que retorna los datos de todos los usuarios vinculados a una empresa
     * @param type $empresa
     * @return type
     */
    function consultaUsuarios_empresa($empresa) {
        $sql = "SELECT u.us_id, u.rol_id, u.us_cedula, u.us_nombre, r.rol_desc "
                . "FROM usuario AS u, roles AS r "
                . "WHERE u.rol_id = r.rol_id AND u.em_id = " . $empresa . ";";
        $BD = new MySQL();
        return $BD->query($sql);
    }

}
