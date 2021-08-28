<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Soc_out_VO
 *
 * @author TECNOLOGIA-LOGI
 */
class Soc_out_VO {

    //put your code here

    private $sout_fecha;
    private $bus_em_id;
    private $bus_num_movil;
    private $sout_km;
    private $sout_out;
    private $sout_observ;
    private $us_id;
    private $sout_lavado;
    private $sout_num_electrolinea;

    public function getSout_fecha() {
        return $this->sout_fecha;
    }

    public function getBus_em_id() {
        return $this->bus_em_id;
    }

    public function getBus_num_movil() {
        return $this->bus_num_movil;
    }

    public function getSout_km() {
        return $this->sout_km;
    }

    public function getSout_out() {
        return $this->sout_out;
    }

    public function getSout_observ() {
        return $this->sout_observ;
    }

    public function getUs_id() {
        return $this->us_id;
    }

    public function getSout_lavado() {
        return $this->sout_lavado;
    }

    public function getSout_num_electrolinea() {
        return $this->sout_num_electrolinea;
    }

    public function setSout_fecha($sout_fecha) {
        $this->sout_fecha = $sout_fecha;
    }

    public function setBus_em_id($bus_em_id) {
        $this->bus_em_id = $bus_em_id;
    }

    public function setBus_num_movil($bus_num_movil) {
        $this->bus_num_movil = $bus_num_movil;
    }

    public function setSout_km($sout_km) {
        $this->sout_km = $sout_km;
    }

    public function setSout_out($sout_out) {
        $this->sout_out = $sout_out;
    }

    public function setSout_observ($sout_observ) {
        $this->sout_observ = $sout_observ;
    }

    public function setUs_id($us_id) {
        $this->us_id = $us_id;
    }

    public function setSout_lavado($sout_lavado) {
        $this->sout_lavado = $sout_lavado;
    }

    public function setSout_num_electrolinea($sout_num_electrolinea) {
        $this->sout_num_electrolinea = $sout_num_electrolinea;
    }

}
