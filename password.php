<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista" || $_SESSION["acceso"]=="cliente") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarPassword();
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
                    <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Password</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Administración</li>
                                <li class="breadcrumb-item active" aria-current="page">Password</li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
               
<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white"><i class="fa fa-save"></i> Actualizar Password</h4>
            </div>
            <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {  ?>
            <form class="form form-material" method="post" data-id="<?php echo $_SESSION["codigo"]; ?>" action="#" name="updatepassword" id="updatepassword">
            <?php } else { ?>
            <form class="form form-material" method="post" data-id="<?php echo $_SESSION["codcliente"]; ?>" action="#" name="updatepassword" id="updatepassword">
            <?php } ?>

                <div id="error">
                   <!-- error will be shown here ! -->
               </div>

               <div class="form-body">

            <div class="card-body">

                <div class="row">

            <?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {  ?>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                    <input type="hidden" name="codigo" id="codigo" value="<?php echo $_SESSION['codigo']; ?>" />
                    <input type="hidden" name="clave" id="clave" value="<?php echo $_SESSION['password']; ?>" />
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="dni" id="dni" value="<?php echo $_SESSION['dni']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Documento" autocomplete="off" readonly required="" aria-required="true"/> 
                    <i class="fa fa-bolt form-control-feedback"></i> 
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Usuario de Acceso: <span class="symbol required"></span></label>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Usuario de Acceso" autocomplete="off" value="<?php echo $_SESSION['usuario']; ?>" required="" aria-required="true"/>  
                    <i class="fa fa-user form-control-feedback"></i> 
                </div>
            </div>

            <?php } else { ?>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nº de Documento: <span class="symbol required"></span></label>
                    <input type="hidden" name="codigo" id="codigo" value="<?php echo $_SESSION['codcliente']; ?>" />
                    <input type="hidden" name="clave" id="clave" value="<?php echo $_SESSION['password']; ?>" />
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="dni" id="dni" value="<?php echo $_SESSION['dnicliente']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Documento" autocomplete="off" readonly required="" aria-required="true"/> 
                    <i class="fa fa-bolt form-control-feedback"></i> 
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Usuario de Acceso: <span class="symbol required"></span></label>
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Usuario de Acceso" autocomplete="off" value="<?php echo $_SESSION['dnicliente']; ?>" readonly="" required="" aria-required="true"/>  
                    <i class="fa fa-user form-control-feedback"></i> 
                </div>
            </div>

            <?php } ?>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Nuevo Password de Acceso: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nuevo Password " autocomplete="off" required="" aria-required="true"/> 
                    <i class="fa fa-key form-control-feedback"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                    <label class="control-label">Repita Nuevo Password: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="password2" id="password2" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Repita Nuevo Password" autocomplete="off" required="" aria-required="true"/> 
                    <i class="fa fa-key form-control-feedback"></i>
                </div>
            </div>
      </div>

              <div class="text-right">
                <button type="submit" name="btn-update" id="btn-update" class="btn btn-info"><span class="fa fa-save"></span> Actualizar</button>
                <button class="btn btn-dark" type="reset"><span class="fa fa-trash-o"></span> Limpiar</button>
             </div>
          </div>
      </div>
    </form>
   </div>
  </div>
</div>
<!-- End Row -->

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
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
    <!-- script jquery -->

    <!-- Calendario -->
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/jscalendario.js"></script>
    <script src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

    <!-- jQuery -->
    <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!-- jQuery -->
    

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