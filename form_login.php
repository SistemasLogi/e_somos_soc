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
        <title>Login</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="e_somos_soc_sistem/assets/vendor/bootstrap/css/bootstrap.min.css">
        <link href="e_somos_soc_sistem/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="e_somos_soc_sistem/assets/libs/css/style.css">
        <link rel="stylesheet" href="e_somos_soc_sistem/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
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
                <div class="card-header text-center"><a href="../index.html"><img class="logo-img img-fluid" src="e_somos_soc_sistem/assets/images/<?php echo $_SESSION["empresa"]; ?>.png" alt="logo"></a>
                    <span class="splash-description">Por favor ingrese usuario y contraseña.</span>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="username" type="text" placeholder="Usuario" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" id="password" type="password" placeholder="Contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnIniciar" name="btnIniciar">iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end login page  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <script src="e_somos_soc_sistem/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="e_somos_soc_sistem/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    </body>

</html>