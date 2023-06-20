<?php
require_once("class/class.php");
if (isset($_SESSION['acceso'])) {
   if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista" || $_SESSION["acceso"]=="cliente") {

$tra = new Login();
$ses = $tra->ExpiraSession();
$con = $tra->ContarRegistros();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Yoni Belito Sedano">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title></title>

    <!-- Menu CSS -->
    <link href="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Datatables CSS -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- needed css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="assets/css/default.css" id="theme" rel="stylesheet">

    <!-- script jquery -->
    <script src="assets/script/jquery.min.js"></script> 
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/plugins/chart.js/chart.min.js"></script>
    <script type="text/javascript" src="assets/script/graficos.js"></script>
    <!-- script jquery -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body onLoad="muestraReloj()" class="fix-header">
    
   <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <!--<div id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="mini-sidebar" data-boxed-layout="boxed" data-header-position="fixed" data-sidebar-position="fixed" class="mini-sidebar">-->

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-boxed-layout="full" data-boxed-layout="boxed" data-header-position="fixed" data-sidebar-position="fixed" class="mini-sidebar">   


        <!-- sample modal content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="myLargeModalLabel"><font color="white"><i class="fa fa-tasks"></i> Detalle de Reservación</font></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
            </div>
            <div class="modal-body">
                <p><div id="muestrareservacionmodal"></div></p>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

        <!-- INICIO DE MENU -->
        <?php include('menu.php'); ?>
        <!-- FIN DE MENU -->

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb border-bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                    <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> <?php echo $_SESSION["acceso"]=="cliente" ? "Panel" : "Dashboard"; ?></h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="panel">Principal</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION["acceso"]=="cliente" ? "Panel" : "Dashboard"; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="page-content container-fluid">
                <!-- ============================================================== -->
                <!-- First Cards Row  -->
                <!-- ============================================================== -->

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?> 

<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Habitaciones</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="fa fa-bank text-primary"></i></h2>
                    <div class="ml-auto">
                    <h2 class="mb-0 display-6"><span class="font-normal"><?php echo $con[0]['habitaciones'] ?></span></h2>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Usuarios</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="fa fa-user text-info"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal"><?php echo $con[0]['usuarios'] ?></span></h2>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Clientes</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="fa fa-users text-danger"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal"><?php echo $con[0]['clientes'] ?></span></h2>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Reservaciones</h5>
                <div class="d-flex align-items-center mb-2 mt-4">
                    <h2 class="mb-0 display-5"><i class="fa fa-calendar text-success"></i></h2>
                    <div class="ml-auto">
                        <h2 class="mb-0 display-6"><span class="font-normal"><?php echo $con[0]['reservaciones'] ?></span></h2>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- Graficos Individual por Sucursal -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-uppercase mb-0">
                Gráfico de Registros
            </h5>
            <div id="chart-container">
                <canvas id="bar-chart" width="800" height="500"></canvas>
            </div>
            <script>
                    // Bar chart
                    new Chart(document.getElementById("bar-chart"), {
                        type: 'bar',
                        data: {
                            labels: ["Clientes", "Proveedores", "Productos", "Reservaciones", "Ventas"],
                            datasets: [
                            {
                                label: "Cantidad Nº",
                                backgroundColor: ["rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)","rgba(153, 102, 255, 0.5)","rgba(255, 159, 64, 0.5)"],
                                borderColor: ["rgba(255,99,132,1)", "rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)","rgba(255, 159, 64, 1)"],
                                data: [<?php echo $con[0]['clientes'] ?>,<?php echo $con[0]['proveedores'] ?>,<?php echo $con[0]['productos'] ?>,<?php echo $con[0]['reservaciones'] ?>,<?php echo $con[0]['ventas'] ?>]
                            }
                            ]
                        },
                        options: {
                            legend: { display: false },
                            title: {
                                display: true,
                                text: 'Cantidad de Registros'
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

<?php  
$venta = new Login();
$venta = $venta->SumaVentas();

$reserva = new Login();
$reserva = $reserva->SumaReservaciones();

?>   

    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">
                    Ventas del Año <?php echo date("Y"); ?>
                </h5>
                       <div id="chart-container">
                       <canvas id="bar-chartv" width="800" height="500"></canvas>
                       </div>
                       <script>
                            // Bar chart
                            new Chart(document.getElementById("bar-chartv"), {
                                type: 'bar',
                                data: {
                                    labels: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],
                                    datasets: [
                                    {
                                        label: "Monto Mensual",
                                        backgroundColor: ["rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)","rgba(153, 102, 255, 0.5)","rgba(255, 159, 64, 0.5)","rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)","rgba(153, 102, 255, 0.5)","rgba(255, 159, 64, 0.5)"],
                                        borderColor: ["rgba(255,99,132,1)", "rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)","rgba(255, 159, 64, 1)","rgba(255,99,132,1)", "rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)","rgba(255, 159, 64, 1)"],
                                        data: [<?php 

                            if($venta == "") { echo 0; } else {

                                  $meses = array(1 => 0, 2=> 0, 3=> 0, 4=> 0, 5=> 0, 6=> 0, 7=> 0, 8=> 0, 9=> 0, 10=> 0, 11=> 0, 12 => 0);
                                  foreach($venta as $row) {
                                    $mes = $row['mes'];
                                    $meses[$mes] = $row['totalmes'];
                                }
                                foreach($meses as $mes) {
                                    echo "{$mes},"; } } ?>]
                                }]
                            },
                            options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Suma de Monto Mensual'
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
</div>


<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">
                    Reservaciones del Año <?php echo date("Y"); ?>
                </h5>
                       <div id="chart-container">
                       <canvas id="bar-chartr" width="800" height="500"></canvas>
                       </div>
                       <script>
                            // Bar chart
                            new Chart(document.getElementById("bar-chartr"), {
                                type: 'bar',
                                data: {
                                    labels: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],
                                    datasets: [
                                    {
                                        label: "Monto Mensual",
                                        backgroundColor: ["rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)","rgba(153, 102, 255, 0.5)","rgba(255, 159, 64, 0.5)","rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)","rgba(255, 206, 86, 0.5)","rgba(75, 192, 192, 0.5)","rgba(153, 102, 255, 0.5)","rgba(255, 159, 64, 0.5)"],
                                        borderColor: ["rgba(255,99,132,1)", "rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)","rgba(255, 159, 64, 1)","rgba(255,99,132,1)", "rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(153, 102, 255, 1)","rgba(255, 159, 64, 1)"],
                                        data: [<?php 

                              if($reserva == 0) { echo 0; } else {

                                  $meses = array(1 => 0, 2=> 0, 3=> 0, 4=> 0, 5=> 0, 6=> 0, 7=> 0, 8=> 0, 9=> 0, 10=> 0, 11=> 0, 12 => 0);
                                  foreach($reserva as $row) {
                                    $mes = $row['mes'];
                                    $meses[$mes] = $row['totalmes'];
                                }
                                foreach($meses as $mes) {
                                    echo "{$mes},"; } } ?>]
                                }]
                            },
                            options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Suma de Monto Mensual'
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase mb-0">
                    8 Habitaciones Mas Reservadas del Año <?php echo date("Y"); ?>
                </h5>
                    <div id="chart-container">
                    <canvas id="DoughnutChart" width="250" height="150"></canvas>
                    </div>
                    <script>
                    $(document).ready(function () {
                        showGraphDoughnut();
                    });
                    </script>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>


<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Reservaciones</h4>
            </div>

            <div class="form-body">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">
                        <div class="btn-group m-b-20">
                        <a class="btn waves-effect waves-light btn-light" href="reportepdf?tipo=<?php echo encrypt("RESERVACIONES") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

                        <a class="btn waves-effect waves-light btn-light" href="reportepdf?tipo=<?php echo encrypt("RESERVACIONESXTARJETAS") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-credit-card text-dark"></span> Pdf</a>

                        <a class="btn waves-effect waves-light btn-light" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RESERVACIONES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

                        <a class="btn waves-effect waves-light btn-light" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RESERVACIONES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>

                        </div>
                    </div>
                </div>

                <div id="reservaciones"></div>

            </div>
        </div>
     </div>
  </div>
</div>
<!-- End Row -->

<?php } ?> 

            
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                <i class="fa fa-copyright"></i> <span class="current-year"></span>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/script/jquery.min.js"></script> 
    <script src="assets/js/bootstrap.js"></script>
    <!-- apps -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/app.init.horizontal-fullwidth.js"></script>
    <script src="assets/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/js/perfect-scrollbar.js"></script>
    <script src="assets/js/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!-- Sweet-Alert -->
    <script src="assets/js/sweetalert-dev.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.js"></script>

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <script src="assets/calendario/jquery-ui.js"></script>
    <!-- script jquery -->

    <!-- jQuery -->
    <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/jscript">
    $('#reservaciones').append('<center><p><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</p></center>').fadeIn("slow");
    setTimeout(function() {
    $('#reservaciones').load("consultas?CargaReservaciones=si");
     }, 3000);
    </script>
    <!-- jQuery -->


</body>
</html>

<?php } else { ?>   
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='logout'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>