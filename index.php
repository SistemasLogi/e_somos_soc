<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION["us_id"])) {
    header("location:e_somos_soc_sistem/principal.php");
}
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <title>E_Somos_SOC</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <!-- Bootstrap CSS -->
        <link href="e_somos_soc_sistem/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="e_somos_soc_sistem/assets/vendor/fonts/circular-std/style.css" rel="stylesheet" type="text/css"/>
        <link href="e_somos_soc_sistem/assets/libs/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="e_somos_soc_sistem/assets/vendor/fonts/fontawesome/css/fontawesome-all.css" rel="stylesheet" type="text/css"/>
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

    <body>
        <!-- ============================================================== -->
        <!-- forgot password  -->
        <!-- ============================================================== -->
        <div class="container">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0 text-center">
                            <p>Seleccione empresa para poder ingresar..</p>
                            <div class="row">
                                <div class="col-lg-6 p-3">                                    
                                    <button type="button" class="btn btn-block btn-light btn-xl img-responsive" id="btnAlimentacion" name="btnAlimentacion"><img class="img-fluid" src="e_somos_soc_sistem/assets/images/E-Somos Alimentación.png" alt=""/></button>
                                </div>
                                <div class="col-lg-6 p-3">
                                    <button type="button" class="btn btn-block btn-light btn-xl img-responsive" id="btnFontibon" name="btnFontibon"><img class="img-fluid" src="e_somos_soc_sistem/assets/images/E-Somos Fontibón.png" alt=""/></button>
                                </div>
                            </div>

                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end forgot password  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <script src="e_somos_soc_sistem/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <script src="e_somos_soc_sistem/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="e_somos_soc_sistem/documentation/js/initial.js" type="text/javascript"></script>
    </body>


</html>
