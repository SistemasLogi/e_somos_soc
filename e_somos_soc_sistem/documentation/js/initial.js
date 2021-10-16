/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("#btnAlimentacion").click(function () {
        //alimentacion empresa 1
        ingreso_empresa(1);
    });

    $("#btnFontibon").click(function () {
        //fontibon empresa 2
        ingreso_empresa(2);
    });

});

/**
 * Variable global de ajax
 * @type type
 */
var efe_aja;
/**
 * Metodo general de ajax para formularios sin ficheros
 * @param {type} request
 * @param {type} cadena
 * @param {type} metodo
 * @returns {f_ajax}
 */
function f_ajax(request, cadena, metodo) {
    this.efe_aja = $.ajax({
        url: request,
        cache: false,
        beforeSend: function () { /*httpR es la variable global donde guardamos la conexion*/
            $(document).ajaxStop();
            $(document).ajaxStart();
        },
        type: "POST",
        dataType: "html",
        contentType: 'application/x-www-form-urlencoded; charset=utf-8;',
        data: cadena,
        timeout: 15000,
        success: function (datos) {
            metodo(datos);
        },
        error: function () {
            alert("No hay conexión");
        }
    });
}

/**
 * Metodo de iniciacion empresa
 * @param {type} id_emp
 * @returns {undefined}
 */
function ingreso_empresa(id_emp) {
    request = "controllers/login/empresa_log_controller.php";
    cadena = {"empresa": id_emp};
    metodo = function (datos) {
        form_iniciar_sesion();
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo de carga de formulario
 * @param {type} respuesta
 * @returns {undefined}
 */
function form_iniciar_sesion() {
//    alert("Usuario o Contraseña incorrectos" + respuesta);
    $(location).attr('href', 'form_login.php'); 
}