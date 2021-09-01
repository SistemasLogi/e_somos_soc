<!doctype html>
<?php
session_start();
if (!isset($_SESSION["tecnico"])) {
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
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" id="sectionDataMovil">

                            </div>
                            <!-- ============================================================== -->
                            <!-- end basic card -->
                            <!-- ============================================================== -->

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" id="sectionTable">
                                
                            </div>
                            <!-- ============================================================== -->
                            <!-- end basic table  -->
                            <!-- ============================================================== -->

                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">

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