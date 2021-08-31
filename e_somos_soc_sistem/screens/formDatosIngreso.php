<div class="card">
    <h5 class="card-header">Datos de Ingreso</h5>
    <div class="card-body">
        <form id="form" data-parsley-validate="" novalidate="">
            <div class="form-group row">
                <label for="inpKmIn" class="col-3 col-lg-4 col-form-label text-right">KM ODO</label>
                <div class="col-9 col-lg-8">
                    <input id="inpKmIn" name="inpKmIn" type="number" required="" placeholder="Km" class="form-control form-control-sm" autocomplete="off" disabled="">
                </div>
            </div>
            <div class="form-group row">
                <label for="inpSocIn" class="col-3 col-lg-4 col-form-label text-right">SOC In</label>
                <div class="input-group input-group-sm col-9 col-lg-8 mb-3">
                    <input id="inpSocIn" name="inpSocIn" type="number" required="" placeholder="Soc" class="form-control form-control-sm" autocomplete="off" disabled="">
                    <div class="input-group-append input-group-sm"><span class="input-group-text input-group-sm">%</span></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inpElectLineIn" class="col-3 col-lg-4 col-form-label text-right">N° Electrolinea</label>
                <div class="col-9 col-lg-8">
                    <input id="inpElectLineIn" name="inpElectLineIn" type="number" required="" placeholder="N° Electrolinea" class="form-control form-control-sm" autocomplete="off" disabled="">
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-space btn-primary">Guardar</button>
                <button class="btn btn-space btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>