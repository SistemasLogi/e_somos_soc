<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="headerfooter">
            <h3 class="section-title">Carga Masiva de Flota a Base de Datos</h3>
            <h5><p><u><a href="../files/plantilla_guardar_buses/Plantilla_registro_Buses.xlsx">Descargue AQUI la plantilla xlsx</a></u></p></h5>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="sectionFormBus">
        <div class="card">
            <h5 class="card-header" id="titleFormBus"></h5>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="formBusesMasivo" name="formBusesMasivo" class="form-inline  my-2 my-lg-0 form-group-sm">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="lbSigMovil">Upload</span>
                        </div>
                        <div class="custom-file input-group-sm">
                            <input type="file" id="inpMasBuses" name="inpMasBuses" class="custom-file-input form-control  form-control-sm">
                            <label class="custom-file-label input-group-sm" id="lbNameFileBus" for="inputFileBuses">Cargar archivo xlsx</label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" id="guardaBusesXlsx" name="guardaBusesXlsx" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                    <div class="margen_top" id="errorTxt" style="color: #761c19;"></div>
                </form>                
            </div>
            <p class="text-primary"><b>Para evitar problemas en la carga del archivo debe tener en cuenta lo siguiente:</b><br>
                1-Las cabeceras de la plantilla excel no se deben modificar<br>
                2-Despues de la última fila con datos se debe eliminar al menos las 5 siguientes vacias.</p>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3" id="SectionTableXlsxBusNew">

    </div>    
</div>