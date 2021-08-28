<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Soc_in_VO
 *
 * @author TECNOLOGIA-LOGI
 */
class Soc_in_VO {

    //put your code here

    private $sin_fecha;
    private $bus_em_id;
    private $bus_num_movil;
    private $sin_km;
    private $sin_in;
    private $sin_observ;
    private $us_id;

    public function getSin_fecha() {
        return $this->sin_fecha;
    }

    public function getBus_em_id() {
        return $this->bus_em_id;
    }

    public function getBus_num_movil() {
        return $this->bus_num_movil;
    }

    public function getSin_km() {
        return $this->sin_km;
    }

    public function getSin_in() {
        return $this->sin_in;
    }

    public function getSin_observ() {
        return $this->sin_observ;
    }

    public function getUs_id() {
        return $this->us_id;
    }

    public function setSin_fecha($sin_fecha) {
        $this->sin_fecha = $sin_fecha;
    }

    public function setBus_em_id($bus_em_id) {
        $this->bus_em_id = $bus_em_id;
    }

    public function setBus_num_movil($bus_num_movil) {
        $this->bus_num_movil = $bus_num_movil;
    }

    public function setSin_km($sin_km) {
        $this->sin_km = $sin_km;
    }

    public function setSin_in($sin_in) {
        $this->sin_in = $sin_in;
    }

    public function setSin_observ($sin_observ) {
        $this->sin_observ = $sin_observ;
    }

    public function setUs_id($us_id) {
        $this->us_id = $us_id;
    }

}
