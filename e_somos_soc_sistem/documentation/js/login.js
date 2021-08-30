/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("#btnIniciar").click(function () {
        validarLogin();
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
 * Metodo de validacion de loging
 * @returns {undefined}
 */
function validarLogin() {
    $("#formLogin").validate({
        rules: {
            inpUsername: {
                required: true
            },
            inpPassword: {
                required: true
            }
        },
        submitHandler: function (form) {
            ejecutar_log();
        }
    });
}

/**
 * Metodo de comprobacion usuario
 * @returns {undefined}
 */
function ejecutar_log() {
    request = "controllers/login/login_controller.php";
    cadena = $("#formLogin").serialize();
    metodo = function (datos) {
//        alert(datos);
        comprobarUsuario(datos);
    };
    f_ajax(request, cadena, metodo);
}
/**
 * Metodo de inicio de sesion
 * @param {type} respuesta
 * @returns {undefined}
 */
function comprobarUsuario(respuesta) {
//    alert("Usuario o Contraseña incorrectos" + respuesta);
    if (respuesta == 1) {
        $(location).attr('href', 'e_somos_soc_sistem/principal.php');
    } else if (respuesta == 2) {
        alertify.alert('contraseña no es valida').setHeader('<em> Cuidado! </em> ');
    } else if (respuesta == 3) {
        alertify.alert('usuario no es valido').setHeader('<em> Cuidado! </em> ');
    } else {
        alertify.alert('Usuario o Contraseña Incorrectos').setHeader('<em> ERROR! </em> ');
    }
}
///**
// * Metodo para cerrar sesion
// * @returns {undefined}
// */
//function cerrarSesion() {
//    request = "controllers/login/logout_controller.php";
//    cadena = "a=1";
//    metodo = function (datos) {
////        alertify.success('Sesión finalizada');
//        location.href = "index.php";
//    };
//    f_ajax(request, cadena, metodo);
//}
//

/**
 * Metodo general que limpia campos de un formulario
 * @param {type: form} formulario
 * @returns {undefined}
 */
function limpiarFormulario(formulario) {
    /* Se encarga de leer todas las etiquetas input del formulario*/
    $(formulario).find('input').each(function () {
        switch (this.type) {
            case 'password':
            case 'text':
            case 'hidden':
            case 'date':
            case 'file':
            case 'time':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
    /* Se encarga de leer todas las etiquetas select del formulario */
    $(formulario).find('select').each(function () {
        $("#" + this.id + " option[value=0]").attr("selected", true);
    });
    /* Se encarga de leer todas las etiquetas textarea del formulario */
    $(formulario).find('textarea').each(function () {
        $(this).val('');
    });
}