<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="headerfooter">
            <h3 class="section-title">Carga Masiva de Flota a Base de Datos</h3>
            <p><a href="../files/plantilla_guardar_buses/Plantilla_registro_Buses.xlsx">Descargue Aqui la plantilla xlsx</a></p>
        </div>
    </div>

    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-4 col-12" id="sectionFormUsuario">
        <div class="card">
            <h5 class="card-header" id="titleFormBus"></h5>
            <div class="card-body">
                <form id="formBusesMasivo" class="form-inline  my-2 my-lg-0 form-group-sm" data-parsley-validate="" novalidate="">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="lbSigMovil">Upload</span>
                        </div>
                        <div class="custom-file input-group-sm">
                            <input type="file" id="inpMasBuses" name="inpMasBuses" class="custom-file-input form-control  form-control-sm">
                            <label class="custom-file-label input-group-sm" id="lbNameFileBus" for="inputFileBuses">Cargar archivo xlsx</label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" id="guardaBusesXlsx" name="guardaBusesXlsx" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                    <div class="margen_top" id="errorTxt" style="color: #761c19;"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3" id="SectionTableXlsx">

    </div>    
</div>