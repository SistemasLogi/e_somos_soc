/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("#enlSocIn").click(function () {
        formBuscarIn();
        $("#sectionDataMovil").html("");
    });
    $("#enlSocOut").click(function () {
        formBuscarOut();
        $("#sectionDataMovil").html("");
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
/************************/
/**funciones soc_in**/
/************************/
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
        $("#btnBuscMovIn").click(function () {
            validarBuscarMovil();
        });
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

/**
 * Metodo de validacion form buscar movil
 * @returns {undefined}
 */
function validarBuscarMovil() {
    $("#formBuscMovil").validate({
        rules: {
            inpNumMovil: {
                required: true
            }
        },
        submitHandler: function (form) {
            datos_movil();

        }
    });
}

/**
 * Metodo que retorna los datos del movil consultado
 * @returns {undefined}
 */
function datos_movil() {
    request = "../controllers/soc_in/consulta_bus_x_mov_controller.php";
    cadena = $("#formBuscMovil").serialize();//envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);        
        arreglo_mov = $.parseJSON(datos);


        if (arreglo_mov !== 0) {
            temp = arreglo_mov[0];

            if (temp.em_id == 1) {
                color = '#2ec551';
                teme = 'success';
            } else {
                color = '#5969ff';
                teme = 'primary';
            }
            movil_data = '<div class="card">\n\
                        <div class="card-body text-center">\n\
                            <div class="col-lg-12">\n\
                                <div class="card border-3 border-top border-top-dark">\n\
                                    <div class="card-body">\n\
                                        <div class="metric-value d-inline-block text-center">\n\
                                            <h2 class="mb-1">' + temp.bus_placa + '</h2>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <h3 class="card-title border-bottom pb-2">MOVIL ' + temp.bus_num_movil + '</h3>\n\
                            <i class="m-r-10 mdi mdi-36px mdi-bus" style="color: ' + color + '"></i>\n\
                            <p class="card-text">Datos Ultimo SOC_Out Registrado</p>\n\
                            <div class="table-responsive">\n\
                                <table class="table table-bordered table-sm">\n\
                                    <thead class="table-' + teme + '">\n\
                                        <tr>\n\
                                            <th scope="col">FECHA</th>\n\
                                            <th scope="col">Km</th>\n\
                                            <th scope="col">SOC Out</th>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody>\n\
                                        <tr>';
            if (temp.sout_fecha == null) {
                movil_data += '<td>sin datos recientes</td>\n\
                                            <td>-</td>\n\
                                            <td>-</td>\n\
                                        </tr>\n\
                                    </tbody>\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
            } else {
                movil_data += '<td>' + temp.sout_fecha + '</td>\n\
                                            <td>' + temp.sout_kwh + '</td>\n\
                                            <td>' + temp.sout_out + '%</td>\n\
                                        </tr>\n\
                                    </tbody>\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
            }
            $("#inpKmIn").removeAttr('disabled');
            $("#inpSocIn").removeAttr('disabled');
            $("#inpElectLineIn").removeAttr('disabled');
            $("#sectionDataMovil").html(movil_data);
        } else {
            alertify.alert('No existe un Bus con este numero en la Base de Datos').setHeader('<em> WARNING! </em> ');
            $("#inpKmIn").val('');
            $("#inpSocIn").val('');

            $("#inpKmIn").attr('disabled', 'disabled');
            $("#inpSocIn").attr('disabled', 'disabled');
            $("#inpElectLineIn").attr('disabled', 'disabled');
            $("#sectionDataMovil").html("");
        }
    };
    f_ajax(request, cadena, metodo);
}


/************************/
/**funciones soc_out**/
/************************/
/**
 * Metodo que trae el formulario buscar movil out
 * @returns {undefined}
 */
function formBuscarOut() {
    request = "screens/formBuscSocOut.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#sectionFormBuscarMovil").html(datos);
        $("#titleDash").html("FORMULARIO SOC OUT");
        $("#lbfolder").html("SOC OUT");
        formDatosSalida();
        $("#btnBuscMovOut").click(function () {
            validarBuscarMovilOut();
        });
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo que trae el formulario soc_out
 * @returns {undefined}
 */
function formDatosSalida() {
    request = "screens/formDatosSalida.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#sectionFormDatIngreso").html(datos);
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo de validacion form buscar movil out
 * @returns {undefined}
 */
function validarBuscarMovilOut() {
    $("#formBuscMovilOut").validate({
        rules: {
            inpNumMovilOut: {
                required: true
            }
        },
        submitHandler: function (form) {
            datos_movilOut();

        }
    });
}

/**
 * Metodo que retorna los datos del movil consultado en proceso out
 * @returns {undefined}
 */
function datos_movilOut() {
    request = "../controllers/soc_out/consulta_bus_x_mov_in_controller.php";
    cadena = $("#formBuscMovilOut").serialize();//envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);        
        arreglo_mov = $.parseJSON(datos);


        if (arreglo_mov !== 0) {
            temp = arreglo_mov[0];

            if (temp.em_id == 1) {
                color = '#2ec551';
                teme = 'success';
            } else {
                color = '#5969ff';
                teme = 'primary';
            }
            movil_data = '<div class="card">\n\
                        <div class="card-body text-center">\n\
                            <div class="col-lg-12">\n\
                                <div class="card border-3 border-top border-top-dark">\n\
                                    <div class="card-body">\n\
                                        <div class="metric-value d-inline-block text-center">\n\
                                            <h2 class="mb-1">' + temp.bus_placa + '</h2>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <h3 class="card-title border-bottom pb-2">MOVIL ' + temp.bus_num_movil + '</h3>\n\
                            <i class="m-r-10 mdi mdi-36px mdi-bus" style="color: ' + color + '"></i>\n\
                            <p class="card-text">Datos Ultimo SOC_In Registrado</p>\n\
                            <div class="table-responsive">\n\
                                <table class="table table-bordered table-sm">\n\
                                    <thead class="table-' + teme + '">\n\
                                        <tr>\n\
                                            <th scope="col">FECHA</th>\n\
                                            <th scope="col">Km</th>\n\
                                            <th scope="col">SOC Out</th>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody>\n\
                                        <tr>';
            if (temp.sin_fecha == null) {
                movil_data += '<td>sin datos recientes</td>\n\
                                            <td>-</td>\n\
                                            <td>-</td>\n\
                                        </tr>\n\
                                    </tbody>\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
            } else {
                movil_data += '<td>' + temp.sin_fecha + '</td>\n\
                                            <td>' + temp.sin_km + '</td>\n\
                                            <td>' + temp.sin_in + '%</td>\n\
                                        </tr>\n\
                                    </tbody>\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
            }
            $("#inpKWhOut").removeAttr('disabled');
            $("#inpSocOut").removeAttr('disabled');
            $("#inpLavSi").removeAttr('disabled');
            $("#inpLavNo").removeAttr('disabled');
            $("#inpElectLineOut").removeAttr('disabled');
            $("#inpElectLineOut").attr('readonly', 'readonly');
            $("#inpObservOut").removeAttr('disabled');
            $("#sectionDataMovil").html(movil_data);
        } else {
            alertify.alert('No existe un Bus con este numero en la Base de Datos').setHeader('<em> WARNING! </em> ');
            $("#inpKWhOut").val('');
            $("#inpSocOut").val('');
            $("#inpLavSi").val('');
            $("#inpLavNo").val('');

            $("#inpKWhOut").attr('disabled', 'disabled');
            $("#inpSocOut").attr('disabled', 'disabled');
            $("#inpLavSi").attr('disabled', 'disabled');
            $("#inpLavNo").attr('disabled', 'disabled');
            $("#inpElectLineOut").attr('disabled', 'disabled');
            $("#inpObservOut").attr('disabled', 'disabled');
            $("#sectionDataMovil").html("");
        }
    };
    f_ajax(request, cadena, metodo);
}
