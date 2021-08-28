/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $("#btnBuscarUs").click(function () {
        validarNumCedula();
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
 * Metodo de validacion buscar cedula
 * @returns {undefined}
 */
function validarNumCedula() {
    $("#formBuscarCedula").validate({
        rules: {
            inpNumCed: {
                required: true
            }
        },
        submitHandler: function (form) {
            buscar_cedula();
        }
    });
}
var id_user;
/**
 * Metodo de comprobacion usuario por cedula
 * @returns {undefined}
 */
function buscar_cedula() {
    request = "controllers/login/cons_usuario_ced_controller.php";
    cadena = $("#formBuscarCedula").serialize();
    metodo = function (datos) {
//        alert(datos);
//        comprobarUsuario(datos);

        arregloUser = $.parseJSON(datos);

        if (arregloUser !== 0) {
            temp = arregloUser[0];
            id_user = temp.us_id;
            $("#response_datos").html('<form id="formResetPass">\n\
                            <div class="card-header text-center">\n\
                                <h4 id="lbNomUser">' + temp.us_nombre + '</h4>\n\
                                <p>Por favor diligencie el formulario y de click en CONFIRMAR</p>\n\
                            </div>\n\
                            <div class="form-group">\n\
                                <input class="form-control form-control-lg" value="' + id_user + '" type="number" id="inpUserId" name="inpUserId" style="display: none;">\n\
                                <input class="form-control form-control-lg" type="text" id="inpUserReset" name="inpUserReset" placeholder="Ingrese nuevo Usuario" autocomplete="off">\n\
                            </div>\n\
                            <div class="form-group">\n\
                                <input class="form-control form-control-lg" type="password" id="inpPasswordReset" name="inpPasswordReset" placeholder="Ingrese nueva Contraseña" autocomplete="off">\n\
                            </div>\n\
                            <div class="form-group">\n\
                                <input class="form-control form-control-lg" type="password" id="inpConfirmPass" name="inpConfirmPass" placeholder="Confirme Contraseña" autocomplete="off">\n\
                            </div>\n\
                            <button type="submit" class="btn btn-success btn-lg btn-block" id="btnConfirmarUs" name="btnConfirmarUs">CONFIRMAR</button>\n\
                        </form><div id="dataInfo"></div>');
            $("#btnConfirmarUs").click(function () {
                validarFormResetPass();
            });
        } else {
            $("#response_datos").html('<h3 class="mt-2">Usuario no existe en Base de Datos.</h3>\n\
                        <p>Verifique que esta ingresando por la Empresa correcta y que el número digitado este bien, en caso de no poder continuar debe ser creado en la Base de Datos.</p>');
        }
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo de validacion form reset password
 * @returns {undefined}
 */
function validarFormResetPass() {
    $("#formResetPass").validate({
        rules: {
            inpUserReset: {
                required: true
            },
            inpPasswordReset: {
                required: true
            },
            inpConfirmPass: {
                required: true,
                equalTo: "#inpPasswordReset"
            }
        },
        submitHandler: function (form) {
            reset_passw_user();

        }
    });
}
/**
 * Metodo que actualiza usuario y contraseña
 * @returns {undefined}
 */
function reset_passw_user() {
    request = "controllers/login/reset_us_pass_controller.php";
    cadena = $("#formResetPass").serialize();
    metodo = function (datos) {
        if (datos == 1) {
            alertify.warning('Usuario Actualizado OK!!');
            $("#response_datos").html('<p>Actualizando...</p><img class="img-fluid" src="e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
            setTimeout(redireccionar, 2021);
        } else {
            alertify.alert('error al actualizar usuario').setHeader('<em> ERROR! </em> ');
            $("#dataInfo").html("error al actualizar usuario");
        }
    };
    f_ajax(request, cadena, metodo);
}

function redireccionar(){
    $(location).attr('href', 'form_login.php');
}
/**
 * Metodo de inicio de sesion
 * @param {type} respuesta
 * @returns {undefined}
 */
function comprobarUsuario(respuesta) {
//    alert("Usuario o Contraseña incorrectos" + respuesta);
    if (respuesta == 1) {
        $(location).attr('href', 'admin_logi.php');
    } else if (respuesta == 2) {
        $(location).attr('href', 'cliente_logi.php');
    } else if (respuesta == 3) {
        $(location).attr('href', 'cliente.php');
    } else if (respuesta == 4) {
        $(location).attr('href', 'area_control_clientes.php');
    } else if (respuesta == 5) {
        $(location).attr('href', 'mensajero_logi.php');
    } else {
        alert("Usuario o Contraseña Incorrectos");
    }
}
/**
 * Metodo para cerrar sesion
 * @returns {undefined}
 */
function cerrarSesion() {
    request = "Control/Login_General/log_aut_control.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alertify.success('Sesión finalizada');
        location.href = "index.php";
    };
    f_ajax(request, cadena, metodo);
}


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
