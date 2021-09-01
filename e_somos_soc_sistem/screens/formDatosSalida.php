<div class="card">
    <h5 class="card-header">Datos de Salida</h5>
    <div class="card-body">
        <form id="formSocOut">
            <div class="form-group row">
                <label for="inpKWhOut" class="col-3 col-lg-4 col-form-label text-right">KWh</label>
                <div class="col-9 col-lg-8">
                    <input id="inpKWhOut" name="inpKWhOut" type="number" placeholder="KWh" class="form-control form-control-sm" autocomplete="off" step=".01" readonly="">
                </div>
                <div class="col-9 col-lg-8"  style="display: none;">
                    <input id="inpNumBusOut" name="inpNumBusOut" type="text">
                </div>
            </div>
            <div class="form-group row">
                <label for="inpSocOut" class="col-3 col-lg-4 col-form-label text-right">SOC Out</label>
                <div class="input-group input-group-sm col-9 col-lg-8 mb-3">
                    <input id="inpSocOut" name="inpSocOut" type="number" placeholder="Soc" class="form-control form-control-sm" autocomplete="off" step=".01" readonly="">
                    <div class="input-group-append input-group-sm"><span class="input-group-text input-group-sm">%</span></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inpLavSi" class="col-3 col-lg-4 col-form-label text-right">Lavado</label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="inpLavSi" name="radioLavado" value="SI" checked="" class="custom-control-input is-valid" readonly=""><span class="custom-control-label">SI</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="inpLavNo" name="radioLavado" value="NO" class="custom-control-input is-invalid" readonly=""><span class="custom-control-label">NO</span>
                </label>
            </div>
            <div class="form-group row">
                <label for="inpElectLineOut" class="col-3 col-lg-4 col-form-label text-right">N° Electrolinea</label>
                <div class="col-9 col-lg-8">
                    <input id="inpElectLineOut" name="inpElectLineOut" type="number" placeholder="N° Electrolinea" class="form-control  form-control-sm" readonly="">
                </div>
            </div>
            <div class="form-group row">
                <label for="inpObservOut" class="col-3 col-lg-4 col-form-label text-right">Observaciones</label>
                <div class="col-9 col-lg-8">
                    <textarea class="form-control" id="inpObservOut" name="inpObservOut" rows="2" readonly=""></textarea>
                </div>                                                
            </div>
            <div class="row justify-content-center">
                <button type="submit" id="btnGuardarSocOut" name="btnGuardarSocOut" class="btn btn-space btn-brand">Guardar</button>
                <button class="btn btn-space btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>