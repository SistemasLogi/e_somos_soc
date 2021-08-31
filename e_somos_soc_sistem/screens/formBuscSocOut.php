<?php
session_start();
?>
<form id="formBuscMovilOut" class="form-inline  my-2 my-lg-0 form-group-sm" data-parsley-validate="" novalidate="">
    <div class="input-group my-2 my-lg-12 input-group-sm">
        <span class="input-group-text" id="lbSigMovil"><?php if ($_SESSION["empresa"] == 1) { ?>Z91-<?php } else { ?>Z66-<?php } ?></span>
        <input id="inpNumMovilOut" name="inpNumMovilOut" type="number" placeholder="Buscar N° Movil" class="form-control  form-control-sm" autocomplete="off">
        <div class="input-group-append">
            <button type="submit" id="btnBuscMovOut" name="btnBuscMovOut" class="btn btn-brand">Buscar</button>
        </div>
    </div>
</form>