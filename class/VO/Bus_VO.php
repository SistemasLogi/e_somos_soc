<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bus_VO
 *
 * @author TECNOLOGIA-LOGI
 */
class Bus_VO {

    //put your code here

    private $em_id;
    private $bus_num_movil;
    private $bus_placa;
    private $bus_modelo;
    private $bus_ref;
    private $tip_id;
    private $bus_num_vin;
    private $bus_motor;
    private $bus_voltaje;
    private $bus_potencia;
    private $bus_torque;

    public function getEm_id() {
        return $this->em_id;
    }

    public function getBus_num_movil() {
        return $this->bus_num_movil;
    }

    public function getBus_placa() {
        return $this->bus_placa;
    }

    public function getBus_modelo() {
        return $this->bus_modelo;
    }

    public function getBus_ref() {
        return $this->bus_ref;
    }

    public function getTip_id() {
        return $this->tip_id;
    }

    public function getBus_num_vin() {
        return $this->bus_num_vin;
    }

    public function getBus_motor() {
        return $this->bus_motor;
    }

    public function getBus_voltaje() {
        return $this->bus_voltaje;
    }

    public function getBus_potencia() {
        return $this->bus_potencia;
    }

    public function getBus_torque() {
        return $this->bus_torque;
    }

    public function setEm_id($em_id) {
        $this->em_id = $em_id;
    }

    public function setBus_num_movil($bus_num_movil) {
        $this->bus_num_movil = $bus_num_movil;
    }

    public function setBus_placa($bus_placa) {
        $this->bus_placa = $bus_placa;
    }

    public function setBus_modelo($bus_modelo) {
        $this->bus_modelo = $bus_modelo;
    }

    public function setBus_ref($bus_ref) {
        $this->bus_ref = $bus_ref;
    }

    public function setTip_id($tip_id) {
        $this->tip_id = $tip_id;
    }

    public function setBus_num_vin($bus_num_vin) {
        $this->bus_num_vin = $bus_num_vin;
    }

    public function setBus_motor($bus_motor) {
        $this->bus_motor = $bus_motor;
    }

    public function setBus_voltaje($bus_voltaje) {
        $this->bus_voltaje = $bus_voltaje;
    }

    public function setBus_potencia($bus_potencia) {
        $this->bus_potencia = $bus_potencia;
    }

    public function setBus_torque($bus_torque) {
        $this->bus_torque = $bus_torque;
    }

}
