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
        activeMenu("#enlSocIn");
        $("#sectionDashAllBus").html("");
    });
    $("#enlSocOut").click(function () {
        formBuscarOut();
        $("#sectionDataMovil").html("");
        tablaGeneralBusIn();
        activeMenu("#enlSocOut");
        $("#sectionDashAllBus").html("");
    });
    $("#enlAllBus").click(function () {
        $("#sectionFormBuscarMovil").html("");
        $("#sectionFormDatIngreso").html("");
        $("#sectionDataMovil").html("");
        $("#sectionTable").html("");
        activeMenu("#enlAllBus");
        dashTodosBus();
        setTimeout(tablaGeneralAllBus, 250);
    });
    $("#enlAdmon").click(function () {
        $("#subEnlNewUser").click(function () {
            formNuevoUsuario();
            $("#sectionFormBuscarMovil").html("");
            $("#sectionFormDatIngreso").html("");
            $("#sectionDataMovil").html("");
            $("#sectionTable").html("");
        });
        $("#subEnlUpdUser").click(function () {
            formSubidaMasivaBuses();
            $("#sectionFormBuscarMovil").html("");
            $("#sectionFormDatIngreso").html("");
            $("#sectionDataMovil").html("");
            $("#sectionTable").html("");
        });
        activeMenu("#enlAdmon");
    });
    $("#enlReport").click(function () {
        $("#subEnlCargaFlota").click(function () {
            reporte_control_carga();
            $("#sectionFormBuscarMovil").html("");
            $("#sectionFormDatIngreso").html("");
            $("#sectionDataMovil").html("");
            $("#sectionTable").html("");
        });
        activeMenu("#enlReport");

//        setTimeout(tablaGeneralAllBus, 250);
    });
    setInterval(sessio_refresh, 165000);
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
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect: Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (textStatus === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (textStatus === 'timeout') {
                alert('Time out error.');
            } else if (textStatus === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error: ' + jqXHR.responseText);
            }
//            alert("No hay conexi??n");
        }
    });
}
/**
 * Metodo Ajax para subida de ficheros
 * @param {type} request
 * @param {type} cadena
 * @param {type} metodo
 * @returns {f_ajax_files}
 */
function f_ajax_files(request, cadena, metodo) {
    this.efe_aja = $.ajax({
        url: request,
        cache: false,
        beforeSend: function () { /*httpR es la variable global donde guardamos la conexion*/
            $(document).ajaxStop();
            $(document).ajaxStart();
        },
        type: "POST",
        dataType: "html", /*se cambia el tipo "html" por "json"*/
        processData: false,
        contentType: false,
        data: cadena,
        timeout: 20000,
        success: function (datos) {
            metodo(datos);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
                alert('Not connect: Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (textStatus === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (textStatus === 'timeout') {
                alert('Time out error.');
            } else if (textStatus === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error: ' + jqXHR.responseText);
            }
//            alert("No hay conexi??n");
        }
    });
}
function activeMenu(id) {
    $("#elmMenu a").removeClass('active');
    $(id).addClass('active');
}
/**
 * Metodo que mantiene la session activa
 * @returns {undefined}
 */
function sessio_refresh() {
    request = "../controllers/login/refresh_sesion_controller.php";
    cadena = "a=1";
    metodo = function (datos) {

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
            formDatosIngreso();
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
            validarGuardarSocIn(maxkm, minkm);
        });
        $("#btnResetFormIn").click(function () {
            resetFormSocIn();
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
 * Metodo de validacion form soc in
 * @param {type} maxkm
 * @param {type} minkm
 * @returns {undefined}
 */
function validarGuardarSocIn(maxkm, minkm) {
    $("#formSocIn").validate({
        rules: {
            inpKmIn: {
                required: true,
                max: maxkm,
                min: minkm
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
        messages: {
            inpKmIn: {
                max: "Maximo Km permitido " + maxkm,
                min: "Km no debe ser menor a " + minkm
            }
        },

        submitHandler: function (form) {
            guardar_soc_in();
        }
    });
}

var maxkm;
var minkm;
/**
 * Metodo que retorna los datos del movil consultado
 * @returns {undefined}
 */
function datos_movil() {
    request = "../controllers/soc_in/consulta_bus_x_mov_controller.php";
    cadena = $("#formBuscMovil").serialize();//envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
//        $("#sectionDataMovil").html(datos);
        if (datos == 1) {
            alertify.alert('??ltimo registro del bus soc_in no cumple con la paridad, debe registrar un soc_out antes de realizar este proceso').setHeader('<em> WARNING! </em> ');
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

                if (temp_bus_in.sin_km == "" || temp_bus_in.sin_km == null) {
                    maxkm = parseInt(999999);
                    minkm = parseInt(1);
                } else {
                    maxkm = parseInt(330) + parseInt(temp_bus_in.sin_km);
                    minkm = parseInt(temp_bus_in.sin_km);
                }

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
                            <h4 class="card-title border-bottom pb-2">' + temp_bus_in.tip_tipo + '</h4>\n\
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
                $("#btnGuardarSocIn").removeAttr('disabled');
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
    request = "../controllers/soc_out/consulta_all_bus_in_controller.php";
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
                                                <th>OUT</th>\n\
                                                <th>FECHA</th>\n\
                                                <th>MOVIL</th>\n\
                                                <th>PLACA</th>\n\
                                                <th>TIPO</th>\n\
                                                <th>Km</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusout.length; i++) {
                tmp = arregloBusout[i];
                datosBusOut += '<tr id="fila' + i + '"><td><i class="m-r-10 mdi mdi-bus" style="color: #28a745"></i></td>';
                datosBusOut += '<td>' + tmp.out_fecha + '</td>';
                datosBusOut += '<td>' + tmp.bus_num_movil + '</td>';
                datosBusOut += '<td>' + tmp.bus_placa + '</td>';
                datosBusOut += '<td>' + tmp.tip_tipo + '</td>';
                datosBusOut += '<td>' + tmp.sin_km + '</td></tr>';
            }
            datosBusOut += "</tbody></table></div></div></div>";
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
            $("#inpNumMovil").val("");
            $("#sectionDataMovil").html("");
            $("#sectionTable").html('<p>Actualizando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
            setTimeout(tablaGeneralBusOut, 50);
            formDatosIngreso();
        } else {
//            alert(datos);
            $("#sectionTable").html('<p>Actualizando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
            setTimeout(tablaGeneralBusOut, 50);
            alertify.alert('La Electrolinea se encuentra ocupada por el Movil ' + datos).setHeader('<em> ERROR!! </em> ');
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
            formDatosSalida();
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
            validarGuardarSocOut(ult_soc_in);
        });
        $("#btnResetOut").click(function () {
            resetFormSocOut();
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
 * @param {type} ult_soc_in
 * @returns {undefined}
 */
function validarGuardarSocOut(ult_soc_in) {
    $("#formSocOut").validate({
        rules: {
            inpKWhOut: {
                required: true,
                max: 340,
                min: 0
            },
            inpSocOut: {
                required: true,
                max: 100,
                min: ult_soc_in
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
var ult_soc_in;
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
            alertify.alert('??ltimo registro del bus soc_out no cumple con la paridad, debe registrar un soc_in antes de realizar este proceso').setHeader('<em> WARNING! </em> ');
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

                if (temp.sin_in == "" || temp.sin_in == null) {
                    ult_soc_in = parseFloat(1);
                } else {
                    ult_soc_in = parseFloat(temp.sin_in);
                }

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
                            <h4 class="card-title border-bottom pb-2">' + temp.tip_tipo + '</h4>\n\
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
                $("#inpElectLineOut").val(temp.sin_num_electrolinea);
//                if (temp.sin_num_electrolinea == "" || temp.sin_num_electrolinea == null) {
//
//                } else {
//                    $("#inpElectLineOut").attr('readonly', 'readonly');
//                }
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
    request = "../controllers/soc_in/consulta_all_bus_out_controller.php";
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
                                        <thead class="table-warning">\n\
                                            <tr>\n\
                                                <th>IN</th>\n\
                                                <th>FECHA</th>\n\
                                                <th>MOVIL</th>\n\
                                                <th>PLACA</th>\n\
                                                <th>TIPO</th>\n\
                                                <th>ELECT.</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusIn.length; i++) {
                tmp = arregloBusIn[i];
                datosBusIn += '<tr id="fila' + i + '"><td><i class="m-r-10 mdi mdi-bus" style="color: #deaa00"></i></td>';
                datosBusIn += '<td>' + tmp.in_fecha + '</td>';
                datosBusIn += '<td>' + tmp.bus_num_movil + '</td>';
                datosBusIn += '<td>' + tmp.bus_placa + '</td>';
                datosBusIn += '<td>' + tmp.tip_tipo + '</td>';
                datosBusIn += '<td>' + tmp.sin_num_electrolinea + '</td></tr>';
            }
            datosBusIn += "</tbody></table></div></div></div>";
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
            formDatosSalida();
            $("#inpNumMovilOut").val("");
            $("#sectionDataMovil").html("");
            $("#sectionTable").html('<p>Actualizando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
            setTimeout(tablaGeneralBusIn, 50);
        } else {
//            alert(datos);
            alertify.alert('Error al guardar, el registro No se Guardo en la base de datos').setHeader('<em> ERROR!! </em> ');
        }
    };
    f_ajax(request, cadena, metodo);
}
/************************/
/**funciones all_bus**/
/************************/
/**
 * Metodo que carga el dash con la informacion de todos los buses
 * @returns {undefined}
 */
function dashTodosBus() {
    request = "screens/dashAllBus.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#titleDash").html("DashsBoard All Bus");
        $("#lbfolder").html("ALL BUS");
        $("#sectionDashAllBus").html(datos);
    };
    f_ajax(request, cadena, metodo);
}

var arregloBusAll;
/**
 * Metodo que retorna el listado de ultimo proceso para todos los buses
 * @returns {undefined}
 */
function tablaGeneralAllBus() {
    request = "../controllers/bus/consulta_all_bus_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        arregloBusAll = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloBusAll !== 0) {
            busesIn = 0;
            busesOut = 0;
            busesLavSi = 0;
            busesLavNo = 0;
            datosBusAll = '<div class="card">\n\
                            <h5 class="card-header">Tabla Buses</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap" id="contenTable">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableAll">\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th>In/Out</th>\n\
                                                <th>FECHA</th>\n\
                                                <th class="table-info">MOVIL</th>\n\
                                                <th class="table-info">PLACA</th>\n\
                                                <th class="table-info">TIPO</th>\n\
                                                <th class="table-warning">ELECT.</th>\n\
                                                <th class="table-warning">SOC In</th>\n\
                                                <th class="table-warning">KM</th>\n\
                                                <th class="table-warning">USUARIO In</th>\n\
                                                <th class="table-success">LAVADO</th>\n\
                                                <th class="table-success">SOC Out</th>\n\
                                                <th class="table-success">KWh</th>\n\
                                                <th class="table-success">USUARIO Out</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusAll.length; i++) {
                tmp = arregloBusAll[i];
                datosBusAll += '<tr id="fila' + i + '">';
                if (tmp.fecha == 1) {
                    datosBusAll += '<td><i class="m-r-10 mdi mdi-bus" style="color: #2ec551;"></i></td>';
                    datosBusAll += '<td>' + tmp.out_fecha + '</td>';
                    busesOut++;
                } else {
                    datosBusAll += '<td><i class="m-r-10 mdi mdi-bus" style="color: #deaa00;"></i></td>';
                    datosBusAll += '<td>' + tmp.in_fecha + '</td>';
                    busesIn++;
                }
                datosBusAll += '<td>' + tmp.bus_num_movil + '</td>';
                datosBusAll += '<td>' + tmp.bus_placa + '</td>';
                datosBusAll += '<td>' + tmp.tip_tipo + '</td>';
                datosBusAll += '<td>' + tmp.sin_num_electrolinea + '</td>';
                datosBusAll += '<td>' + tmp.sin_in + '</td>';
                datosBusAll += '<td>' + tmp.sin_km + '</td>';
                datosBusAll += '<td>' + tmp.in_nombre + '</td>';
                if (tmp.sout_lavado == 'SI') {
                    datosBusAll += '<td><i class="m-r-10 mdi mdi-cup-water" style="color: #5969ff;"></i></td>';
                    busesLavSi++;
                } else if (tmp.sout_lavado == 'NO') {
                    if (tmp.fecha == 1) {
                        datosBusAll += '<td class="link_icon actulav" lav="' + i + '"><i class="m-r-10 mdi mdi-cup-off" style="color: #ff407b;"></i></td>';
                        busesLavNo++;
                    } else {
                        datosBusAll += '<td><i class="m-r-10 mdi mdi-cup-off" style="color: #ff407b;"></i></td>';
                        busesLavNo++;
                    }

                } else {
                    datosBusAll += '<td>Sin datos</td>';
                }
                datosBusAll += '<td>' + tmp.sout_out + '</td>';
                datosBusAll += '<td>' + tmp.sout_kwh + '</td>';
                datosBusAll += '<td>' + tmp.out_nombre + '</td></tr>';
            }
            datosBusAll += '</tbody><tfoot>\n\
                            <tr>\n\
                                <th>In/Out</th>\n\
                                <th>FECHA</th>\n\
                                <th class="table-info">MOVIL</th>\n\
                                <th class="table-info">PLACA</th>\n\
                                <th class="table-info">TIPO</th>\n\
                                <th class="table-warning">ELECT.</th>\n\
                                <th class="table-warning">SOC In</th>\n\
                                <th class="table-warning">KM</th>\n\
                                <th class="table-warning">USUARIO In</th>\n\
                                <th class="table-success">LAVADO</th>\n\
                                <th class="table-success">SOC Out</th>\n\
                                <th class="table-success">KWh</th>\n\
                                <th class="table-success">USUARIO Out</th>\n\
                            </tr>\n\
                        </tfoot></table></div></div></div>';
            $("#SectionTableAllBus").html(datosBusAll);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableAll').DataTable();


            $("#unIn").html(busesIn);
            $("#unOut").html(busesOut);
            $("#unLavSi").html(busesLavSi);
            $("#unLavNo").html(busesLavNo);

            clickActulizarLavado();

        } else {
            $("#SectionTableAllBus").html('<div class="card">\n\
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
 * Metodo que devuelve el formulario para actualizar el estado
 * formulario ciudad
 * @returns {undefined}
 */
function clickActulizarLavado() {
    $("#contenTable").on("click", ".actulav", function () {
//    $(".actuestos").click(function () {
        actu_lavado = $(this).attr("lav");
        $('#ModalGeneral').modal('toggle');

        form_act_lavado(arregloBusAll, actu_lavado);
    });
}
/**
 * Metodo que llama la ventana emergente con el formulario
 * @param {type} array
 * @param {type} position
 * @returns {undefined}
 */
function form_act_lavado(array, position) {
    tm = array[position];

    $('#ModalGeneralTitle').html('ACTUALIZAR LAVADO');
    $('#body_modal').html('<div class="card">\n\
    <h5 class="card-header">MOVIL N?? <em>' + tm.bus_num_movil + '</em></h5>\n\
    <h5 class="card-header">Fecha Registro <em>' + tm.out_fecha + '</em></h5>\n\
    <div class="card-body">\n\
        <form id="formActLavado">\n\
            <div class="form-group row">\n\
                <div class="col-9 col-lg-8" style="display: none;">\n\
                    <input id="inpNumBusOut" name="inpNumBusOut" value="' + tm.bus_num_movil + '" type="text">\n\
                </div>\n\
                <div class="col-9 col-lg-8" style="display: none;">\n\
                    <input id="inpFechaOut" name="inpFechaOut" value="' + tm.out_fecha + '" type="text">\n\
                </div>\n\
            </div>\n\
            <div class="form-group row">\n\
                <label for="inpLavSi" class="col-3 col-lg-4 col-form-label text-right">Lavado</label>\n\
                <label class="custom-control custom-radio custom-control-inline">\n\
                    <input type="radio" id="inpLavSi" name="radioLavado" value="SI" checked="" class="custom-control-input is-valid" readonly=""><span class="custom-control-label">SI</span>\n\
                </label>\n\
                <label class="custom-control custom-radio custom-control-inline">\n\
                    <input type="radio" id="inpLavNo" name="radioLavado" value="NO" class="custom-control-input is-invalid" readonly=""><span class="custom-control-label">NO</span>\n\
                </label>\n\
            </div>\n\
            <div class="row justify-content-center">\n\
                <button type="submit" id="btnGuardarLav" name="btnGuardarLav" class="btn btn-space btn-brand">Guardar</button>\n\
                <button type="button" id="btnCancelLav" class="btn btn-space btn-secondary">Cancel</button>\n\
            </div>\n\
        </form>\n\
    </div>\n\
</div>');
    $("#btnGuardarLav").click(function () {
        validarGuardarLavado();
    });
    $("#btnCancelLav").click(function () {
        $("#btnCloseModal").trigger("click");
    });
}
/**
 * Metodo de validacion form actualizar lavado
 * @returns {undefined}
 */
function validarGuardarLavado() {
    $("#formActLavado").validate({
        rules: {
            radioLavado: {
                required: true
            }
        },
        submitHandler: function (form) {
            guardar_lavado();
        }
    });
}
/**
 * Metodo que guarda registro en tabla soc_out actualizar lavado
 * @returns {undefined}
 */
function guardar_lavado() {
    request = "../controllers/soc_out/actualiza_lavado_controller.php";
    cadena = $("#formActLavado").serialize(); //envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
        if (datos == 1) {
            $("#btnCloseModal").trigger("click");
            alertify.warning('Guardado OK!!');
            $("#SectionTableAllBus").html('<p>Actualizando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
            setTimeout(tablaGeneralAllBus, 50);
        } else {
//            alert(datos);
            alertify.alert('Error al guardar, el registro No se Guardo en la base de datos').setHeader('<em> ERROR!! </em> ');
        }
    };
    f_ajax(request, cadena, metodo);
}
/**********************************/
/**funciones Administrar Usuarios**/
/**********************************/
/**
 * Metodo que carga el formulario de registro de nuevo usuario
 * @returns {undefined}
 */
function formNuevoUsuario() {
    request = "screens/formNuevoUsuario.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#titleDash").html("Registrar Nuevo Usuario");
        $("#lbfolder").html("ADMINISTRAR");
        $("#sectionDashAllBus").html(datos);
        $("#titleFormUser").html('Nuevo Usuario');
        $("#guardaUser").click(function () {
            validarGuardarUsuario();
        });
        $("#cancelUser").click(function () {
            resetFormUser();
        });
        $("#sectionTableAllUser").html('<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
        setTimeout(tablaGeneralAllUser, 50);
    };
    f_ajax(request, cadena, metodo);
}
/**
 * Metodo de validacion form nuevo usuario
 * @returns {undefined}
 */
function validarGuardarUsuario() {
    $("#formNuevoUsuario").validate({
        rules: {
            inpNameUser: {
                required: true
            },
            inpCedula: {
                required: true
            }
        },
        submitHandler: function (form) {
            guardar_usuario();
        }
    });
}
/**
 * Metodo que guarda registro en tabla usuario
 * @returns {undefined}
 */
function guardar_usuario() {
    request = "../controllers/usuario/guardar_usuario_controller.php";
    cadena = $("#formNuevoUsuario").serialize(); //envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
        if (datos == 1) {
            alertify.warning('Guardado OK!!');
            resetFormUser();
            $("#sectionTableAllUser").html('<p>Actualizando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
            setTimeout(tablaGeneralAllUser, 50);
        } else {
//            alert(datos);
            alertify.alert('Error al guardar, el registro No se Guardo en la base de datos').setHeader('<em> ERROR!! </em> ');
        }
    };
    f_ajax(request, cadena, metodo);
}

var arregloUserAll;
/**
 * Metodo que retorna el listado de todos los usuarios
 * @returns {undefined}
 */
function tablaGeneralAllUser() {
    request = "../controllers/usuario/consultar_all_user_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        arregloUserAll = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloUserAll !== 0) {
            datosUserAll = '<div class="card">\n\
                            <h5 class="card-header">Tabla Usuarios</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap" id="contenTableUser">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableAllUser">\n\
                                        <thead>\n\
                                            <tr class="bg-info">\n\
                                                <th>Ed</th>\n\
                                                <th>NOMBRE</th>\n\
                                                <th>CEDULA</th>\n\
                                                <th>T. USUARIO</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloUserAll.length; i++) {
                tmp = arregloUserAll[i];
                datosUserAll += '<tr id="fila' + i + '">';
                datosUserAll += '<td class="link_icon actu_usu" usu="' + i + '"><i class="m-r-10 mdi mdi-account-edit" style="color: #007bff;"></i></td>';
                datosUserAll += '<td>' + tmp.us_nombre + '</td>';
                datosUserAll += '<td>' + tmp.us_cedula + '</td>';
                datosUserAll += '<td>' + tmp.rol_desc + '</td></tr>';
            }
            datosUserAll += '</tbody></table></div></div></div>';
            $("#sectionTableAllUser").html(datosUserAll);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableAllUser').DataTable();

            clickActulizarUsuario();

        } else {
            $("#sectionTableAllUser").html('<div class="card">\n\
                                    <h5 class="card-header">Tabla Usuarios</h5>\n\
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
 * Metodo que devuelve el formulario para actualizar el estado
 * formulario ciudad
 * @returns {undefined}
 */
function clickActulizarUsuario() {
    $("#contenTableUser").on("click", ".actu_usu", function () {
//    $(".actu_usu").click(function () {
        actu_usuario = $(this).attr("usu");

        tm = arregloUserAll[actu_usuario];

        $("#titleDash").html("Actualizar Datos de Usuario");
        $("#titleFormUser").html('Editar Usuario');
        $("#inpIdUser").val(tm.us_id);
        $("#inpNameUser").val(tm.us_nombre);
        $("#inpCedula").val(tm.us_cedula);
        $("#guardaUser").html('Actualizar');
        $("#guardaUser").removeClass('btn-primary');
        $("#guardaUser").addClass('btn-warning');
        $("#selRole option").removeAttr('selected');
        $('#selRole option[value="' + tm.rol_id + '"]').attr('selected', 'selected');

    });
}
/**
 * Metodo que resetea el formulario de usuarios
 * @returns {undefined}
 */
function resetFormUser() {
    $("#titleDash").html("Registrar Nuevo Usuario");
    $("#titleFormUser").html('Nuevo Usuario');
    $("#inpIdUser").val("");
    $("#inpNameUser").val("");
    $("#inpCedula").val("");
    $("#guardaUser").html('Guardar Usuario');
    $("#guardaUser").removeClass('btn-warning');
    $("#guardaUser").addClass('btn-primary');
    $("#selRole option").removeAttr('selected');
}
/**********************************/
/**funciones Reportes**/
/**********************************/
/**
 * Metodo que carga la vista del reporte de control de carga
 * @returns {undefined}
 */
function reporte_control_carga() {
    request = "screens/reportControlCarga.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#titleDash").html("Reporte Control de Carga");
        $("#lbfolder").html("REPORTES");
        $("#sectionDashAllBus").html(datos);
        $("#btnReportCargaXlsx").click(function () {
//            reporte_carga_Xlsx();
            reporte_carga_Xlsx_fechas(null, null, null);
        });


        /**evento enter desde elemento input**/
        $("#inpNumMovilReport").keypress(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
                $("#btnVerReport").focus();
                return false;
            }
        });


        $("#btnVerReport").click(function () {

            ini_fecha = $("#inpFecIni").val();
            fin_fecha = $("#inpFecFin").val();
            num_movil = $("#inpNumMovilReport").val();

            if (ini_fecha !== "" && fin_fecha !== "") {
                if (ini_fecha > fin_fecha) {
                    alertify.alert("La fecha de inicio no debe ser mayor que la fecha final, la  consulta generada no es acorde a el tiempo.").setHeader('<em> Cuidado! </em> ');
                    $("#SectionTableXlsx").html('<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
//                    setTimeout(tablaReporteControlCarga, 50);
                    setTimeout(tablaReporteControlCargaFechas(ini_fecha, fin_fecha, num_movil), 50);
                    $("#btnReportCargaXlsxFech").click(function () {
//                        reporte_carga_Xlsx();
                        reporte_carga_Xlsx_fechas(ini_fecha, fin_fecha, num_movil);
                    });

                } else {
                    $("#SectionTableXlsx").html('<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
                    setTimeout(tablaReporteControlCargaFechas(ini_fecha, fin_fecha, num_movil), 50);

                    $("#btnReportCargaXlsxFech").click(function () {
                        reporte_carga_Xlsx_fechas(ini_fecha, fin_fecha, num_movil);
                    });
                }
            } else {
                $("#SectionTableXlsx").html('<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
//                setTimeout(tablaReporteControlCarga, 50);
                setTimeout(tablaReporteControlCargaFechas(ini_fecha, fin_fecha, num_movil), 50);

                $("#btnReportCargaXlsxFech").click(function () {
                    reporte_carga_Xlsx_fechas(ini_fecha, fin_fecha, num_movil);
                });
            }

        });
        $("#SectionTableXlsx").html('<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
//        setTimeout(tablaReporteControlCarga, 50);
        setTimeout(tablaReporteControlCargaFechas(null, null, null), 50);
    };
    f_ajax(request, cadena, metodo);
}
/**
 * Metodo que retorna el listado de control de carga
 * @returns {undefined}
 */
function tablaReporteControlCarga() {
    request = "../controllers/bus/consulta_control_carga_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        $("#SectionTableXlsx").html(datos);
        arregloBusCarga = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloBusCarga !== 0) {
            datosBusCarga = '<div class="card">\n\
                            <h5 class="card-header">Tabla Carga-Rendimiento Hoy</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap" id="contenTable">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableAllCarga">\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th>FECHA SOC_Out</th>\n\
                                                <th class="table-info">MOVIL</th>\n\
                                                <th class="table-info">PLACA</th>\n\
                                                <th class="table-info">TIPO</th>\n\
                                                <th class="table-warning">??LTIMO Km_ODO</th>\n\
                                                <th class="table-warning">Km RECORRIDO</th>\n\
                                                <th class="table-warning">SOC_In</th>\n\
                                                <th class="table-success">SOC Out</th>\n\
                                                <th class="table-success">KWh</th>\n\
                                                <th class="table-success">RENDIMIENTO</th>\n\
                                                <th class="table-success">LAVADO</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusCarga.length; i++) {
                tmp = arregloBusCarga[i];
                datosBusCarga += '<tr id="fila' + i + '">';
                datosBusCarga += '<td>' + tmp.out_fecha + '</td>';
                datosBusCarga += '<td>' + tmp.bus_num_movil + '</td>';
                datosBusCarga += '<td>' + tmp.bus_placa + '</td>';
                datosBusCarga += '<td>' + tmp.tip_tipo + '</td>';
                if (tmp.fecha == 1) {
                    datosBusCarga += '<td>' + tmp.prev_km_in + '</td>';
                } else {
                    datosBusCarga += '<td>' + tmp.sin_km + '</td>';
                }
                datosBusCarga += '<td>' + tmp.ult_km_rec + '</td>';
                if (tmp.fecha == 1) {
                    datosBusCarga += '<td>' + tmp.sin_in + '</td>';
                } else {
                    datosBusCarga += '<td>' + tmp.prev_soc_in + '</td>';
                }
                datosBusCarga += '<td>' + tmp.sout_out + '</td>';
                datosBusCarga += '<td>' + tmp.sout_kwh + '</td>';
                datosBusCarga += '<td>' + tmp.rendimiento + '</td>';
                if (tmp.sout_lavado == 'SI') {
                    datosBusCarga += '<td class="table-info">' + tmp.sout_lavado + '</td></tr>';
                } else if (tmp.sout_lavado == 'NO') {
                    datosBusCarga += '<td class="table-danger">' + tmp.sout_lavado + '</td></tr>';
                } else {
                    datosBusCarga += '<td>' + tmp.sout_lavado + '</td></tr>';
                }


            }
            datosBusCarga += '</tbody><tfoot>\n\
                            <tr>\n\
                                <th>FECHA SOC_Out</th>\n\
                                <th class="table-info">MOVIL</th>\n\
                                <th class="table-info">PLACA</th>\n\
                                <th class="table-info">TIPO</th>\n\
                                <th class="table-warning">??LTIMO Km_ODO</th>\n\
                                <th class="table-warning">Km RECORRIDO</th>\n\
                                <th class="table-warning">SOC_In</th>\n\
                                <th class="table-success">SOC Out</th>\n\
                                <th class="table-success">KWh</th>\n\
                                <th class="table-success">RENDIMIENTO</th>\n\
                                <th class="table-success">LAVADO</th>\n\
                            </tr>\n\
                        </tfoot></table></div></div></div>';
//            $("#SectionTableXlsx").html(datosBusCarga);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableAllCarga').DataTable();

        } else {
            $("#SectionTableXlsx").html('<div class="card">\n\
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
 * Metodo que retorna el listado de control de carga por rango de fechas
 * @param {type} fecha_inicio
 * @param {type} fecha_final
 * @param {type} movil_num
 * @returns {undefined}
 */
function tablaReporteControlCargaFechas(fecha_inicio, fecha_final, movil_num) {
    request = "../controllers/bus/consulta_control_carga_param_controller.php";
    cadena = {"inpFecIni": fecha_inicio, "inpFecFin": fecha_final, "inpNumMovilReport": movil_num}; //envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
//        $("#SectionTableXlsx").html(datos);
        arregloBusCarga = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloBusCarga !== 0) {
            datosBusCarga = '<div class="card">\n\
                            <h5 class="card-header">Tabla Carga-Rendimiento del ' + $("#inpFecIni").val() + ' al ' + $("#inpFecFin").val() + '</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap" id="contenTable">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableAllCarga">\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th>FECHA SOC_Out</th>\n\
                                                <th class="table-info">MOVIL</th>\n\
                                                <th class="table-info">PLACA</th>\n\
                                                <th class="table-warning">??LTIMO Km_ODO</th>\n\
                                                <th class="table-warning">Km RECORRIDO</th>\n\
                                                <th class="table-warning">SOC_In</th>\n\
                                                <th class="table-success">SOC Out</th>\n\
                                                <th class="table-success">KWh</th>\n\
                                                <th class="table-success">RENDIMIENTO</th>\n\
                                                <th class="table-success">LAVADO</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBusCarga.length; i++) {
                tmp = arregloBusCarga[i];
                datosBusCarga += '<tr id="fila' + i + '">';
                datosBusCarga += '<td>' + tmp.fecha + '</td>';
                datosBusCarga += '<td>' + tmp.movil + '</td>';
                datosBusCarga += '<td>' + tmp.placa + '</td>';
                datosBusCarga += '<td>' + tmp.ult_km_odo + '</td>';
                datosBusCarga += '<td>' + tmp.ult_km_rec + '</td>';
                datosBusCarga += '<td>' + tmp.soc_in + '</td>';
                datosBusCarga += '<td>' + tmp.soc_out + '</td>';
                datosBusCarga += '<td>' + tmp.kwh + '</td>';
                datosBusCarga += '<td>' + tmp.rendimiento + '</td>';
                if (tmp.lavado == 'SI') {
                    datosBusCarga += '<td class="table-info">' + tmp.lavado + '</td></tr>';
                } else if (tmp.lavado == 'NO') {
                    datosBusCarga += '<td class="table-danger">' + tmp.lavado + '</td></tr>';
                } else {
                    datosBusCarga += '<td>' + tmp.lavado + '</td></tr>';
                }


            }
            datosBusCarga += '</tbody><tfoot>\n\
                            <tr>\n\
                                <th>FECHA SOC_Out</th>\n\
                                <th class="table-info">MOVIL</th>\n\
                                <th class="table-info">PLACA</th>\n\
                                <th class="table-warning">??LTIMO Km_ODO</th>\n\
                                <th class="table-warning">Km RECORRIDO</th>\n\
                                <th class="table-warning">SOC_In</th>\n\
                                <th class="table-success">SOC Out</th>\n\
                                <th class="table-success">KWh</th>\n\
                                <th class="table-success">RENDIMIENTO</th>\n\
                                <th class="table-success">LAVADO</th>\n\
                            </tr>\n\
                        </tfoot></table></div></div></div>';
            $("#SectionTableXlsx").html(datosBusCarga);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableAllCarga').DataTable({
                'order': [[1, 'desc'], [0, 'desc']]
            });

        } else {
            $("#SectionTableXlsx").html('<div class="card">\n\
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
 * Metodo que genera un reporte en excel .xlsx de carga y rendimiento
 * @returns {reporte_sock_Xls}
 */
function reporte_carga_Xlsx() {
//    alert(num_suc);
    request = "../controllers/bus/report_carga_xlsx_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        rutaXLS_guardado(datos);
    };
    f_ajax(request, cadena, metodo);
}

/**
 * Metodo que proporciona la ruta y el nombre del archivo xls para descargar
 * @param {type} clienteReport
 * @returns {undefined}
 */
function rutaXLS_guardado(clienteReport) {
    if (clienteReport == 1) {
        alertify.alert('Reporte no generado, error al generar el reporte').setHeader('<em> Cuidado! </em> ');
    } else {
        $(location).attr('href', '../files/' + $.trim(clienteReport) + '.xlsx');

        alertify.warning('Reporte Generado!!!');
    }

}
/**
 * Metodo que genera un reporte en excel .xlsx de carga y rendimiento
 * segun fechas y movil
 * @param {type} fecha_inicio
 * @param {type} fecha_final
 * @param {type} movil_num
 * @returns {reporte_sock_Xls}
 */
function reporte_carga_Xlsx_fechas(fecha_inicio, fecha_final, movil_num) {
    $("#loadingXlsx").html('<p><b>Generando Archivo...</b></p>');
//    alert(num_suc);
    request = "../controllers/bus/report_carga_xlsx_fechas_controller.php";
    cadena = {"inpFecIni": fecha_inicio, "inpFecFin": fecha_final, "inpNumMovilReport": movil_num}; //envio de parametros por POST
    metodo = function (datos) {
//        alert(datos);
        rutaXLS_guardado(datos);
        $("#loadingXlsx").html('<button type="button" class="btn btn-success btn-sm" id="btnReportCargaXlsxFech" name="btnReportCargaXlsxFech"><i class="fa fa-fw fa-file-excel"></i>Descargar excel fechas</button>');
//        $("#btnReportCargaXlsxFech").removeClass("disabled");
    };
    f_ajax(request, cadena, metodo);
}

/**********************************/
/**funciones Administrar Buses**/
/**********************************/
/**
 * Metodo que carga el formulario de registro de buses
 * @returns {undefined}
 */
function formSubidaMasivaBuses() {
    request = "screens/formNuevoBus.php";
    cadena = "a=1";
    metodo = function (datos) {
//        alert(datos);
        $("#titleDash").html("Registrar Buses");
        $("#lbfolder").html("ADMINISTRAR");
        $("#sectionDashAllBus").html(datos);
        $("#titleFormBus").html('Nuevo Bus');
        $("#guardaBusesXlsx").click(function () {
            validarMasivoBuses();
        });
        nameFileCargaMasBuses();
        $("#SectionTableXlsxBusNew").html('<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>');
        setTimeout(tablaTotalFlota, 50);
    };
    f_ajax(request, cadena, metodo);
}
/**
 * Metodo que plasma nombre archivo en carga masiva Buses
 * @returns {undefined}
 */
function nameFileCargaMasBuses() {
    $("#inpMasBuses").change(function () {
        nombre = $("#inpMasBuses").val();
        $("#lbNameFileBus").text(nombre);
    });
}
/**
 * Metodo de validacion Carga masiva de buses xlsx
 * @returns {undefined}
 */
function validarMasivoBuses() {
    $("#formBusesMasivo").validate({
        errorLabelContainer: '#errorTxt',
        rules: {
            inpMasBuses: {
                required: true,
                extension: "xlsx"
            }
        },
        messages: {
            inpMasBuses: {
                extension: "Extensi??n no valida, debe ser xlsx",
                required: "El campo Excel es obligatorio"
            }
        }, submitHandler: function (form) {
            cargaArchivo_xlsx_alist();
        }
    });
}
/**
 * Metodo que se encarga de guardar un fichero en la carpeta temporal de alistamiento
 * @returns {undefined}
 */
function cargaArchivo_xlsx_alist() {
    var creando = '<p>Cargando...</p><img class="img-fluid" src="../e_somos_soc_sistem/assets/gif/loading.gif" alt=""/>';
    $("#SectionTableXlsxBusNew").html(creando);
    request = "../controllers/bus/cargar_xlsx_new_bus_controller.php";
    cadena = new FormData($("#formBusesMasivo")[0]);
    metodo = function (datos) {
        limpiarFormulario("#formBusesMasivo");
        $("#lbNameFileBus").text("");
        if (datos == 1) {
            tablaTotalFlota();
            alertify.warning('Buses Creados en BD OK!!!');
        } else {
            $("#errorTxt").html(datos);
            tablaTotalFlota();
        }



    };
    f_ajax_files(request, cadena, metodo);
}

/**
 * Metodo que retorna el listado total de la flota para una empresa
 * @returns {undefined}
 */
function tablaTotalFlota() {
    request = "../controllers/bus/consulta_flota_emp_controller.php";
    cadena = "a=1"; //envio de parametros por POST
    metodo = function (datos) {
        arregloBus = $.parseJSON(datos);
        /*Aqui se determina si la consulta retorna datos, de ser asi se genera vista de tabla, de lo contrario no*/
        if (arregloBus !== 0) {
            datosBus = '<div class="card">\n\
                            <h5 class="card-header">Tabla Total Buses</h5>\n\
                            <div class="card-body">\n\
                                <div class="table-responsive text-nowrap" id="contenTable">\n\
                                    <table class="table table-sm table-striped table-bordered" id="tableAllBusEmp">\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th class="table-info">MOVIL</th>\n\
                                                <th class="table-info">PLACA</th>\n\
                                                <th class="table-info">TIPO</th>\n\
                                                <th class="table-info">MODELO</th>\n\
                                                <th class="table-info">REFERENCIA</th>\n\
                                                <th class="table-info">NUM VIN</th>\n\
                                                <th class="table-info">MOTOR</th>\n\
                                                <th class="table-info">VOLTAJE</th>\n\
                                                <th class="table-info">POTENCIA</th>\n\
                                                <th class="table-info">TORQUE</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                        <tbody>';
            for (i = 0; i < arregloBus.length; i++) {
                tmp = arregloBus[i];
                datosBus += '<tr id="fila' + i + '">';
                datosBus += '<td>' + tmp.bus_num_movil + '</td>';
                datosBus += '<td>' + tmp.bus_placa + '</td>';
                datosBus += '<td>' + tmp.tip_tipo + '</td>';
                datosBus += '<td>' + tmp.bus_modelo + '</td>';
                datosBus += '<td>' + tmp.bus_ref + '</td>';
                datosBus += '<td>' + tmp.bus_num_vin + '</td>';
                datosBus += '<td>' + tmp.bus_motor + '</td>';
                datosBus += '<td>' + tmp.bus_voltaje + '</td>';
                datosBus += '<td>' + tmp.bus_potencia + '</td>';
                datosBus += '<td>' + tmp.bus_torque + '</td></tr>';

            }
            datosBus += '</tbody><tfoot>\n\
                            <tr>\n\
                                <th class="table-info">MOVIL</th>\n\
                                    <th class="table-info">PLACA</th>\n\
                                    <th class="table-info">TIPO</th>\n\
                                    <th class="table-info">MODELO</th>\n\
                                    <th class="table-info">REFERENCIA</th>\n\
                                    <th class="table-info">NUM VIN</th>\n\
                                    <th class="table-info">MOTOR</th>\n\
                                    <th class="table-info">VOLTAJE</th>\n\
                                    <th class="table-info">POTENCIA</th>\n\
                                    <th class="table-info">TORQUE</th>\n\
                            </tr>\n\
                        </tfoot></table></div></div></div>';
            $("#SectionTableXlsxBusNew").html(datosBus);
            /**
             * Evento que pagina una tabla 
             */

            $('#tableAllBusEmp').DataTable();

        } else {
            $("#SectionTableXlsxBusNew").html('<div class="card">\n\
                                    <h5 class="card-header">Tabla Total Buses</h5>\n\
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