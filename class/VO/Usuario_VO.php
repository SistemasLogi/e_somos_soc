<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_VO
 *
 * @author TECNOLOGIA-LOGI
 */
class Usuario_VO {

    //put your code here

    private $us_id;
    private $rol_id;
    private $us_cedula;
    private $us_nombre;
    private $em_id;
    private $us_usuario;
    private $us_password;

    public function getUs_id() {
        return $this->us_id;
    }

    public function getRol_id() {
        return $this->rol_id;
    }

    public function getUs_cedula() {
        return $this->us_cedula;
    }

    public function getUs_nombre() {
        return $this->us_nombre;
    }

    public function getEm_id() {
        return $this->em_id;
    }

    public function getUs_usuario() {
        return $this->us_usuario;
    }

    public function getUs_password() {
        return $this->us_password;
    }

    public function setUs_id($us_id) {
        $this->us_id = $us_id;
    }

    public function setRol_id($rol_id) {
        $this->rol_id = $rol_id;
    }

    public function setUs_cedula($us_cedula) {
        $this->us_cedula = $us_cedula;
    }

    public function setUs_nombre($us_nombre) {
        $this->us_nombre = $us_nombre;
    }

    public function setEm_id($em_id) {
        $this->em_id = $em_id;
    }

    public function setUs_usuario($us_usuario) {
        $this->us_usuario = $us_usuario;
    }

    public function setUs_password($us_password) {
        $this->us_password = $us_password;
    }

}
