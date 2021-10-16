<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($_POST) {
    require './../../config.php';
    $upass_dao = new Usuario_DAO();
    $upass_vo = new Usuario_VO();

    $upass_vo->setUs_id($_POST["inpUserId"]);
    $upass_vo->setUs_usuario($_POST["inpUserReset"]);
    $upass_vo->setUs_password(password_hash($_POST["inpPasswordReset"], PASSWORD_DEFAULT));
   
    if ($upass_dao->actualizar_us_pass($upass_vo) == 1) {
        echo 1;
    } else {
        echo 2;
    }
} else {
    header("location../");
}
