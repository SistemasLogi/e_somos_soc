<!doctype html>
<?php
session_start();
if (!isset($_SESSION["empresa"])) {
    header("location:index.php");
}
?>
<html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>E_Somos_SOC Login</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="e_somos_soc_sistem/assets/vendor/bootstrap/css/bootstrap.min.css">
        <link href="e_somos_soc_sistem/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="e_somos_soc_sistem/assets/libs/css/style.css">
        <link rel="stylesheet" href="e_somos_soc_sistem/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
        <link href="e_somos_soc_sistem/documentation/css/alertify.css" rel="stylesheet" type="text/css"/>
        <style>
            html,
            body {
                height: 100%;
            }

            body {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
            }
        </style>
    </head>
    <body <?php if ($_SESSION["empresa"] == 1) { ?>style="background-color: #f0ffff"<?php } else { ?>style="background-color: #f8ffe6"<?php } ?>>
        <!-- ============================================================== -->
        <!-- login page  -->
        <!-- ============================================================== -->
        <div class="splash-container">
            <div class="card ">
                <div class="card-header text-center"><img class="logo-img img-fluid" src="e_somos_soc_sistem/assets/images/<?php echo $_SESSION["empresa"]; ?>.png" alt="logo">
                    <span class="splash-description">Por favor ingrese usuario y contraseña.</span>
                </div>
                <div class="card-body">
                    <form id="formLogin">
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="inpUsername" name="inpUsername" type="text" placeholder="Usuario" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="inpPassword" name="inpPassword" type="password" placeholder="Contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnIniciar" name="btnIniciar">iniciar sesión</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <span>No tienes cuenta o no recuerdas usuario y contraseña? <a href="form_reset_password.php">Ingresa aqui!!</a></span>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end login page  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <script src="e_somos_soc_sistem/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="e_somos_soc_sistem/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="e_somos_soc_sistem/documentation/js/jquery.validate.js" type="text/javascript"></script>
        <script src="e_somos_soc_sistem/documentation/js/additional-methods.js" type="text/javascript"></script>
        <script src="e_somos_soc_sistem/documentation/js/localization/messages_es.js" type="text/javascript"></script>       
        <script src="e_somos_soc_sistem/documentation/js/alertify.js" type="text/javascript"></script>
        <script src="e_somos_soc_sistem/documentation/js/login.js" type="text/javascript"></script>
    </body>

</html>