<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista" || $_SESSION["acceso"]=="cliente") {

$tra = new Login();
$ses = $tra->ExpiraSession();  

if(isset($_POST['btn-submit']))
{
$reg = $tra->RegistrarMensaje();
exit;
}
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
    <!-- Sweet-Alert -->
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <!-- animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- needed css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="assets/css/default.css" id="theme" rel="stylesheet">

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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-boxed-layout="full" data-boxed-layout="boxed" data-header-position="fixed" data-sidebar-position="fixed" class="mini-sidebar"> 

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
                <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Chat Messages</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Chat Messages</li>
                                <li class="breadcrumb-item active" aria-current="page">Chat Messages</li>
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


            
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Chat Messages</h4>
                </div>

                <form class="form form-material" method="post" action="#" name="inbox" id="inbox">

                    <div id="save">
                        <!-- error will be shown here ! -->
                    </div>

                    <div class="form-body">

                        <div class="card-body">

                            <div class="chat-box scrollable ps-container ps-theme-default ps-active-y" style="height:calc(100vh - 300px);" data-ps-id="1da86807-4414-0944-5983-5df1c368ff48">
                                <!--chat Row -->
                                <ul class="chat-list"></ul>
                            </div>

                            <hr>

                            <?php if($_SESSION['acceso'] == "cliente") { ?>

                            <input type="hidden" name="respuesta" id="respuesta" value="<?php echo $_SESSION["codcliente"]; ?>">

                            <?php } else { ?>

                            <!--chat --><div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="control-label">&nbsp;</label>
                                        <i class="fa fa-bars form-control-feedback"></i>
                                        <select style="color:#000;font-weight:bold;" name="respuesta" id="respuesta" class='form-control' required="" aria-required="true">
                                        <option value=""> -- SELECCIONE -- </option>
                                        <?php
                                        $activos = new Login();
                                        $activos = $activos->ListarClientesActivos();
                                        if($activos==""){
                                            echo "";    
                                        } else {
                                        for($i=0;$i<sizeof($activos);$i++){ ?>
                                        <option value="<?php echo $activos[$i]['codcliente'] ?>"><?php echo $activos[$i]['nomcliente']."".$status = ($activos[$i]['reservacion'] == "ACTIVA" ? " (ACTIVO)" : " (INACTIVO)"); ?></option>        
                                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group has-feedback">
                                        <label class="control-label">&nbsp;</label>
                                        <input type="text" class="form-control border-0" name="mensaje" id="mensaje" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Mensaje" autocomplete="off" required="" aria-required="true">
                                        <i class="fa fa-pencil form-control-feedback"></i>
                                    </div>
                                </div>

                                <div class="col-md-1"><br>
                                    <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-circle btn-lg btn-info"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>     

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
   
    <div class="chat-windows"></div>
    
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
    <!-- jQuery -->

    <script type="text/javascript">
        $('document').ready(function() {
            setTimeout(function run() {        
                $(".chat-list").load("funciones.php?CargaChat=si");
                //$('.chat-box').animate({ scrollTop: $(document).height() }, "fast");
                $(".chat-box").animate({ scrollTop: $('.chat-box').prop("scrollHeight")}, "fast");
                setTimeout(run, 4000);
            }, 4000);
        });
    </script>
</body>
</html>

<?php } else { ?>   
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='panel'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>