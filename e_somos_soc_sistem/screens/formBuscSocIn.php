<?php
session_start();
?>
<form id="formBuscMovil" class="form-inline  my-2 my-lg-0 form-group-sm" data-parsley-validate="" novalidate="">
    <div class="input-group my-2 my-lg-12 input-group-sm">
        <span class="input-group-text" id="lbSigMovil"><?php if ($_SESSION["empresa"] == 1) { ?>Z91-<?php } else { ?>Z66-<?php } ?></span>
        <input id="inpNumMovil" name="inpNumMovil" type="number" placeholder="Buscar N° Movil" class="form-control  form-control-sm">
        <div class="input-group-append">
            <button type="submit" id="btnBuscMovIn" name="btnBuscMovIn" class="btn btn-dark">Buscar</button>
        </div>
    </div>
</form>