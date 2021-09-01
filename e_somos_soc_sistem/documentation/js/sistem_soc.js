/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("#enlSocIn").click(function () {
        formBuscarIn();
        $("#sectionDataMovil").html("");
        tablaGeneralBusOut();
    });
    $("#enlSocOut").click(function () {
        formBuscarOut();
        $("#sectionDataMovil").html("");
        tablaGeneralBusIn();
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

        $("#btnGuardarSocIn").click(function () {
            km = 330 + temp_bus_in.sin_km;
            validarGuardarSocIn(km);
        });
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
 * Metodo de validacion formsoc in
 * @param {type} km
 * @returns {undefined}
 */
function validarGuardarSocIn(km) {
    $("#formSocIn").validate({
        rules: {
            inpKmIn: {
                required: true,
                max: km
            },
            inpSocIn: {
                required: true,
                max: 100
            },
            inpElectLineIn: {
                required: true,
                max: 117,
                min: 1
            }
        },
        submitHandler: function (form) {
            guardar_soc_in();
        }
    });
}

var temp_bus_in;
/**
 * Metodo que retorna los datos del movil consultado
 * @returns {undefined}
 */
function datos_movil() {
    request = "../controllers/soc_in/consulta_bus_x_mov_controller.php";
    cadena = $("#formBuscMovil").serialize();//envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);    

        if (datos == 1) {
            alertify.alert('Último registro del bus soc_in no cumple con la paridad, debe registrar un soc_out antes de realizar este proceso').setHeader('<em> WARNING! </em> ');
            resetFormSocOut();
        } else if (datos == 2) {
            alertify.alert('Error 2 llamada inesperada, comuniquese con sistemas').setHeader('<em> ERROR! </em> ');
            resetFormSocOut();
        } else if (datos == 3) {
            alertify.alert('No existe un Bus con este numero en la Base de Datos').setHeader('<em> WARNING! </em> ');
            resetFormSocOut();
        } else {
            arreglo_mov = $.parseJSON(datos);


            if (arreglo_mov !== 0) {
                temp_bus_in = arreglo_mov[0];

                if (temp_bus_in.em_id == 1) {
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
                                            <h2 class="mb-1">' + temp_bus_in.bus_placa + '</h2>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <h3 class="card-title border-bottom pb-2">MOVIL ' + temp_bus_in.bus_num_movil + '</h3>\n\
                            <i class="m-r-10 mdi mdi-36px mdi-bus" style="color: ' + color + '"></i>\n\
                            <p class="card-text">Datos Ultimo SOC_Out Registrado</p>\n\
                            <div class="table-responsive text-nowrap">\n\
                                <table class="table table-bordered table-sm">\n\
                                    <thead class="table-' + teme + '">\n\
                                        <tr>\n\
                                            <th scope="col">FECHA</th>\n\
                                            <th scope="col">KWh</th>\n\
                                            <th scope="col">SOC Out</th>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody>\n\
                                        <tr>';
                if (temp_bus_in.sout_fecha == null) {
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
                    movil_data += '<td>' + temp_bus_in.sout_fecha + '</td>\n\
                                            <td>' + temp_bus_in.sout_kwh + '</td>\n\
                                            <td>' + temp_bus_in.sout_out + '%</td>\n\
                                        </tr>\n\
                                    </tbody>\n\
                                </table>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
                }
                $("#inpKmIn").removeAttr('readonly');
                $("#inpSocIn").removeAttr('readonly');
                $("#inpElectLineIn").removeAttr('readonly');
                $("#inpNumBusIn").val(temp_bus_in.bus_num_movil);
                $("#sectionDataMovil").html(movil_data);
            } else {
                alertify.alert('No existe un Bus con este numero en la Base de Datos').setHeader('<em> WARNING! </em> ');
                resetFormSocIn();
            }
        }

    };
    f_ajax(request, cadena, metodo);
}
/**
 * metodo de reset para formularioi soc in
 * @returns {undefined}
 */
function resetFormSocIn() {
    $("#inpKmIn").val('');
    $("#inpSocIn").val('');
    $("#inpElectLineIn").val('');

    $("#inpKmIn").attr('readonly', 'readonly');
    $("#inpSocIn").attr('readonly', 'readonly');
    $("#inpElectLineIn").attr('readonly', 'readonly');
    $("#sectionDataMovil").html("");
}

/**
 * Metodo que retorna el listado de buses en ultimo proceso soc_out
 * disponibles por paridad para soc_in
 * @returns {undefined}
 */
function tablaGeneralBusOut() {
    request = "../controllers/soc_in/consulta_all_bus_out_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        arregloBusout = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloBusout !== 0) {
            datosBusOut = '<div class="card">\n\
                            <h5 class="card-header">Tabla Buses Out</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableIn">\n\
                                        <thead class="table-success">\n\
                                            <tr>\n\
                                                <th>IN</th>\n\
                                                <th>FECHA</th>\n\
                                                <th>MOVIL</th>\n\
                                                <th>PLACA</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusout.length; i++) {
                tmp = arregloBusout[i];
                datosBusOut += '<tr id="fila' + i + '"><td><i class="m-r-10 mdi mdi-bus" style="color: #28a745"></i></td>';
                datosBusOut += '<td>' + tmp.out_fecha + '</td>';
                datosBusOut += '<td>' + tmp.bus_num_movil + '</td>';
                datosBusOut += '<td>' + tmp.bus_placa + '</td></tr>';
            }
            datosBusOut += "</tbody></table>";
            $("#sectionTable").html(datosBusOut);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableIn').DataTable();
        } else {
            $("#sectionTable").html('<div class="card">\n\
                                    <h5 class="card-header">Tabla Buses Out</h5>\n\
                                    <div class="card-body">\n\
                                        <div class="table-responsive">\n\
                                            <span>Sin Datos Recientes</span>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>');
        }
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo que guarda registro en tabla soc_in
 * @returns {undefined}
 */
function guardar_soc_in() {
    request = "../controllers/soc_in/guardar_soc_in_controller.php";
    cadena = $("#formSocIn").serialize(); //envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
        if (datos == 1) {
            alertify.warning('Guardado OK!!');
            resetFormSocIn();
        } else {
//            alert(datos);
            alertify.alert('Error al guardar, el registro No se Guardo en la base de datos').setHeader('<em> ERROR!! </em> ');
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

        $("#btnGuardarSocOut").click(function () {
            validarGuardarSocOut();
        });
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
 * Metodo de validacion formsoc out
 * @returns {undefined}
 */
function validarGuardarSocOut() {
    $("#formSocOut").validate({
        rules: {
            inpKWhOut: {
                required: true
            },
            inpSocOut: {
                required: true,
                max: 100
            },
            inpElectLineOut: {
                required: true,
                max: 117,
                min: 1
            }
        },
        submitHandler: function (form) {
            guardar_soc_out();
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

        if (datos == 1) {
            alertify.alert('Último registro del bus soc_out no cumple con la paridad, debe registrar un soc_in antes de realizar este proceso').setHeader('<em> WARNING! </em> ');
            resetFormSocOut();
        } else if (datos == 2) {
            alertify.alert('Error 2 llamada inesperada, comuniquese con sistemas').setHeader('<em> ERROR! </em> ');
            resetFormSocOut();
        } else if (datos == 3) {
            alertify.alert('No existe un Bus con este numero en la Base de Datos').setHeader('<em> WARNING! </em> ');
            resetFormSocOut();
        } else {
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
                            <div class="table-responsive text-nowrap">\n\
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
                $("#inpKWhOut").removeAttr('readonly');
                $("#inpSocOut").removeAttr('readonly');
                $("#inpLavSi").removeAttr('readonly');
                $("#inpLavNo").removeAttr('readonly');
                $("#inpElectLineOut").removeAttr('readonly');
//                $("#inpElectLineOut").attr('readonly', 'readonly');
                $("#inpElectLineOut").val(temp.sin_num_electrolinea);
                $("#inpNumBusOut").val(temp.bus_num_movil);
                $("#inpObservOut").removeAttr('readonly');
                $("#sectionDataMovil").html(movil_data);
            } else {
                alertify.alert('No existe un Bus con este numero en la Base de Datos').setHeader('<em> WARNING! </em> ');
                resetFormSocOut();
            }
        }
    };
    f_ajax(request, cadena, metodo);
}
/**
 * metodo de reset para formularioi soc out
 * @returns {undefined}
 */
function resetFormSocOut() {
    $("#inpKWhOut").val('');
    $("#inpSocOut").val('');
    $("#inpElectLineOut").val('');
    $("#inpObservOut").val('');
    $("#inpNumBusOut").val('');

    $("#inpKWhOut").attr('readonly', 'readonly');
    $("#inpSocOut").attr('readonly', 'readonly');
    $("#inpLavSi").attr('readonly', 'readonly');
    $("#inpLavNo").attr('readonly', 'readonly');
    $("#inpElectLineOut").attr('readonly', 'readonly');
    $("#inpObservOut").attr('readonly', 'readonly');
    $("#sectionDataMovil").html("");
}
/**
 * Metodo que retorna el listado de buses en ultimo proceso soc_in
 * disponibles por paridad para soc_out
 * @returns {undefined}
 */
function tablaGeneralBusIn() {
    request = "../controllers/soc_out/consulta_all_bus_in_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        arregloBusIn = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloBusIn !== 0) {
            datosBusIn = '<div class="card">\n\
                            <h5 class="card-header">Tabla Buses In</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableIn">\n\
                                        <thead class="table-success">\n\
                                            <tr>\n\
                                                <th>IN</th>\n\
                                                <th>FECHA</th>\n\
                                                <th>MOVIL</th>\n\
                                                <th>PLACA</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusIn.length; i++) {
                tmp = arregloBusIn[i];
                datosBusIn += '<tr id="fila' + i + '"><td><i class="m-r-10 mdi mdi-bus" style="color: #deaa00"></i></td>';
                datosBusIn += '<td>' + tmp.in_fecha + '</td>';
                datosBusIn += '<td>' + tmp.bus_num_movil + '</td>';
                datosBusIn += '<td>' + tmp.bus_placa + '</td></tr>';
            }
            datosBusIn += "</tbody></table>";
            $("#sectionTable").html(datosBusIn);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableIn').DataTable();
        } else {
            $("#sectionTable").html('<div class="card">\n\
                                    <h5 class="card-header">Tabla Buses Out</h5>\n\
                                    <div class="card-body">\n\
                                        <div class="table-responsive">\n\
                                            <span>Sin Datos Recientes</span>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>');
        }
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo que guarda registro en tabla soc_out
 * @returns {undefined}
 */
function guardar_soc_out() {
    request = "../controllers/soc_out/guardar_soc_out_controller.php";
    cadena = $("#formSocOut").serialize(); //envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
        if (datos == 1) {
            alertify.warning('Guardado OK!!');
            resetFormSocOut();
        } else {
//            alert(datos);
            alertify.alert('Error al guardar, el registro No se Guardo en la base de datos').setHeader('<em> ERROR!! </em> ');
        }
    };
    f_ajax(request, cadena, metodo);
}
