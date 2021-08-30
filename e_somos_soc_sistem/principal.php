<!doctype html>
<?php
session_start();
if (!isset($_SESSION["us_id"])) {
    header("location:../index.php");
}
?>
<html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/libs/css/style.css">
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
        <link href="documentation/css/alertify.css" rel="stylesheet" type="text/css"/>
        <title>E_Somos_SOC Dashboard</title>

        <link href="../assets/img/Logos/Icono_ico.ico" rel="icon" type="imagen/ico">
        <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    </head>

    <body <?php if ($_SESSION["empresa"] == 1) { ?>style="background-color: #f0ffff"<?php } else { ?>style="background-color: #f8ffe6"<?php } ?>>
        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">
            <!-- ============================================================== -->
            <!-- navbar -->
            <!-- ============================================================== -->
            <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand logo mr-auto" href="principal.php"><img class="img-fluid" src="assets/images/img_menu/<?php echo $_SESSION["empresa"]; ?>.png" alt=""/></a>


                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <h5><?php echo $_SESSION["us_nombre"] ?></h5>
                                </div>
                            </li>                            
                            <li class="nav-item dropdown connection">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                    <li class="connection-list">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <a href="#" class="connection-item"><img src="assets/images/github.png" alt="" > <span>SOC In</span></a>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                                                <a href="#" class="connection-item"><img src="assets/images/dribbble.png" alt="" > <span>SOC Out</span></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown nav-user">
                                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION["us_nombre"] ?></h5>
                                        <span class="status"></span><span class="ml-2">Técnico</span>
                                    </div>
                                    <!--<a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Ajustes</a>-->
                                    <a class="dropdown-item" href="../controllers/login/logout_controller.php"><i class="fas fa-power-off mr-2"></i>Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- ============================================================== -->
            <!-- end navbar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- left sidebar -->
            <!-- ============================================================== -->
            <div class="nav-left-sidebar sidebar-dark" <?php if ($_SESSION["empresa"] == 1) { ?>style="background-color: #defffa"<?php } else { ?>style="background-color: #edfff1"<?php } ?>>
                <div class="menu-list">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <h3 class="d-xl-none d-lg-none"><?php echo $_SESSION["us_nombre"] ?></h3>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column">
                                <li class="nav-divider">
                                    Menu
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="#" id="enlSocIn"><i class="fas fa-battery-quarter"></i>SOC IN<span class="badge badge-success"></span></a>
                                    <a class="nav-link" href="#" id="enlSocOut"><i class="fas fa-battery-full"></i>SOC OUT<span class="badge badge-success"></span></a>                                    
                                    <a class="nav-link" href="#" id="enlAllBus"><i class="fas fa-bus"></i>ALL BUS<span class="badge badge-success"></span></a>                                    
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end left sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- wrapper  -->
            <!-- ============================================================== -->
            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">
                        <!-- ============================================================== -->
                        <!-- pageheader  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                    <h2 class="pageheader-title" id="titleDash"></h2>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link" id="lbfolder"></a></li>
                                                <li class="breadcrumb-item active" aria-current="page">FORMULARIO</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- horizontal form -->
                            <!-- ============================================================== -->
                            <div class="col-lg-12" id="sectionFormBuscarMovil">                                

                            </div>
                            <!-- ============================================================== -->
                            <!-- end horizontal form -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- horizontal form -->
                            <!-- ============================================================== -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" id="sectionFormDatIngreso">
                                
                            </div>
                            <!-- ============================================================== -->
                            <!-- end horizontal form -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- basic card -->
                            <!-- ============================================================== -->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <!-- ============================================================== -->
                                        <!-- new customer  -->
                                        <!-- ============================================================== -->
                                        <div class="col-lg-12">
                                            <div class="card border-3 border-top border-top-dark">
                                                <div class="card-body">
                                                    <div class="metric-value d-inline-block text-center">
                                                        <h2 class="mb-1">JTP147</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ============================================================== -->
                                        <!-- end new customer  -->
                                        <!-- ============================================================== -->
                                        <h3 class="card-title border-bottom pb-2">MOVIL Z66-7001</h3>
                                        <i class="m-r-10 mdi mdi-36px mdi-bus" style="color: #5969ff"></i>
                                        <p class="card-text">Datos Ultimo SOC_Out Registrado</p>
                                        <div class="table-responsive">                                        
                                            <table class="table table-bordered table-sm">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">FECHA</th>
                                                        <th scope="col">Km</th>
                                                        <th scope="col">SOC Out</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>28-08-2021 23:46:02</td>
                                                        <td>210</td>
                                                        <td>99.12%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end basic card -->
                            <!-- ============================================================== -->

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Basic Table</h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>OUT</th>
                                                        <th>MOVIL</th>
                                                        <th>PLACA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #deaa00"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #deaa00"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #5969ff"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #5969ff"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #2ec551"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #2ec551"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #5969ff"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="m-r-10 mdi mdi-bus" style="color: #5969ff"></i></td>
                                                        <td>Z66-7001</td>
                                                        <td>JTP147</td>
                                                    </tr>                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end basic table  -->
                            <!-- ============================================================== -->

                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card">
                                    <h5 class="card-header">Datos de Salida</h5>
                                    <div class="card-body">
                                        <form id="form" data-parsley-validate="" novalidate="">
                                            <div class="form-group row">
                                                <label for="inputEmail2" class="col-3 col-lg-4 col-form-label text-right">KM ODO</label>
                                                <div class="col-9 col-lg-8">
                                                    <input id="inputEmail2" type="number" required="" placeholder="Km" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword2" class="col-3 col-lg-4 col-form-label text-right">SOC In</label>
                                                <div class="col-9 col-lg-8">
                                                    <input id="inputPassword2" type="number" required="" placeholder="Soc" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword2" class="col-3 col-lg-4 col-form-label text-right">Lavado</label>
                                                <label class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" name="radio-inline" checked="" class="custom-control-input is-valid"><span class="custom-control-label">SI</span>
                                                </label>
                                                <label class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" name="radio-inline" class="custom-control-input is-invalid"><span class="custom-control-label">NO</span>
                                                </label>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword2" class="col-3 col-lg-4 col-form-label text-right">N° Electrolinea</label>
                                                <div class="col-9 col-lg-8">
                                                    <input id="inputPassword2" type="number" required="" placeholder="Soc" class="form-control  form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword2" class="col-3 col-lg-4 col-form-label text-right">Observaciones</label>
                                                <div class="col-9 col-lg-8">
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                </div>                                                
                                            </div>
                                            <div class="row justify-content-center">
                                                <button type="submit" class="btn btn-space btn-brand">Guardar</button>
                                                <button class="btn btn-space btn-secondary">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end pageheader  -->
                            <!-- ============================================================== -->
                            <div class="ecommerce-widget">

                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- footer -->
                    <!-- ============================================================== -->
                    <div class="footer">
                        <div class="container-fluid">
                            <div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">                                
                                    <img src="assets/images/img_menu/<?php echo $_SESSION["empresa"]; ?>.png" alt=""/>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">                                
                                    Copyright © 2021 Concept. All rights reserved.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end footer -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- end wrapper  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- end main wrapper  -->
            <!-- ============================================================== -->
            <!-- Optional JavaScript -->
            <!-- jquery 3.3.1 -->
            <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <!-- bootstap bundle js -->
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="documentation/js/jquery.validate.js" type="text/javascript"></script>
            <script src="documentation/js/additional-methods.js" type="text/javascript"></script>
            <script src="documentation/js/localization/messages_es.js" type="text/javascript"></script>       
            <script src="documentation/js/alertify.js" type="text/javascript"></script>
            <script src="documentation/js/sistem_soc.js" type="text/javascript"></script>
            <!-- slimscroll js -->
            <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
            <!-- main js -->
            <script src="assets/libs/js/main-js.js"></script>
            <!-- sparkline js -->
            <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    </body>

</html>