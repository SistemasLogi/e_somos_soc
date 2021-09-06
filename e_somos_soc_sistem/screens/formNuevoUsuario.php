<div class="row">
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-4 col-12" id="sectionFormUsuario">
        <div class="card">
            <h5 class="card-header" id="titleFormUser"></h5>
            <div class="card-body">
                <form id="formNuevoUsuario">
                    <div class="form-row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 " style="display: none;">
                            <input type="number" class="form-control form-control-sm" autocomplete="off" id="inpIdUser" name="inpIdUser">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="inpNameUser">Nombre Completo</label>
                            <input type="text" class="form-control form-control-sm" autocomplete="off" id="inpNameUser" name="inpNameUser" placeholder="Nombre Apellidos">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-3">
                            <label for="inpCedula">N° Cedula</label>
                            <input type="number" class="form-control form-control-sm" autocomplete="off" id="inpCedula" name="inpCedula" placeholder="N° Cedula">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mt-3">
                            <label for="selRole">Tipo Usuario</label>
                            <select class="form-control form-control-sm" id="selRole" name="selRole">
                                <option value="1">Técnico</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                            <button class="btn btn-primary" id="guardaUser" name="guardaUser" type="submit">Guardar Usuario</button>
                            <button class="btn btn-dark" id="cancelUser" name="cancelUser" type="button">Cancelar/ Nuevo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-lg-7 col-md-5 col-sm-4 col-12" id="sectionTableAllUser">

    </div>
</div>