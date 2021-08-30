/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("#enlSocIn").click(function () {
        formBuscarIn();
    });
    $("#enlSocIn").click(function () {
        formBuscarIn();
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
 * Metodo que trae el formulario buscar movil
 * @returns {undefined}
 */
function formBuscarIn() {
    request = "screens/formBuscSocIn.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#sectionFormBuscarMovil").html(datos);
        $("#titleDash").html("FORMULARIO SOC IN");
        $("#lbfolder").html("SOC IN");
        formDatosIngreso();
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo que trae el formulario soc_in
 * @returns {undefined}
 */
function formDatosIngreso() {
    request = "screens/formDatosIngreso.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#sectionFormDatIngreso").html(datos);
    };
    f_ajax(request, cadena, metodo);
}
