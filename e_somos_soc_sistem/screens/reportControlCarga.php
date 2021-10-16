<?php
session_start();
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="headerfooter">
            <h3 class="section-title">Reporte de Carga</h3>
            <p>El cálculo se realiza a partir del último SOC_OUT registrado, 
                El dato de lavado esta sujeto al último SOC_OUT registrado.</p>
        </div>
    </div>
    <div class="col col-sm-4 col-lg-3 offset-sm-1 offset-lg-0">
        <button type="button" class="btn btn-success btn-sm" id="btnReportCargaXlsx" name="btnReportCargaXlsx"><i class="fa fa-fw fa-file-excel"></i>Descargar excel HOY</button>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
        <div class="card">
            <h5 class="card-header">Buscar Rango Fechas</h5>
            <div class="card-body">
                <form id="validationform">
                    <div class="form-group row">                        
                        <div class="col-lg-3">
                            <label>Fecha Inicial</label>
                            <input type="date" class="form-control form-control-sm" id="inpFecIni" name="inpFecIni">
                        </div>                        
                        <div class="col-lg-3">
                            <label>Fecha Final</label>
                            <input type="date" class="form-control form-control-sm" id="inpFecFin" name="inpFecFin">
                        </div>
                        <div class="col-lg-3">
                            <label>N° Movil</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text form-group-sm" id="inputGroupPrepend"><?php if ($_SESSION["empresa"] == 1) { ?>Z91-<?php } else { ?>Z66-<?php } ?></span>
                                </div>
                                <input type="number" class="form-control" id="inpNumMovilReport" name="inpNumMovilReport" placeholder="N° Movil">                                
                            </div>
                        </div>
                        <div class="row text-center mt-4">
                            <div class="col col-sm-4 col-lg-3 offset-sm-1 offset-lg-0">
                                <button type="button" id="btnVerReport" name="btnVerReport" class="btn btn-sm btn-space btn-primary">Ver</button>
                            </div>
                        </div>
                        <div class="row text-center mt-4">
                            <div class="col col-sm-4 col-lg-3 offset-sm-1 offset-lg-0">
                                <button type="button" class="btn btn-success btn-sm" id="btnReportCargaXlsxFech" name="btnReportCargaXlsxFech"><i class="fa fa-fw fa-file-excel"></i>Descargar excel fechas</button>
                            </div>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3" id="SectionTableXlsx">

    </div>    
</div>