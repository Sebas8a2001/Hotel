<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
    if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista" || $_SESSION["acceso"]=="cliente") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarNoticias();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarNoticias();
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
     
<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-align-justify"></i> Detalle de Noticia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
                </div>
                <div class="modal-body">

                <div id="muestranoticiamodal"></div> 

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
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
                <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Noticias</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Administración</li>
                                <li class="breadcrumb-item active" aria-current="page">Noticias</li>
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
 
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") { ?>

<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white"><i class="fa fa-save"></i> Gestión de Noticias</h4>
            </div>
            <form class="form form-material" method="post" action="#" name="savenoticias" id="savenoticias">

                <div id="save">
                 <!-- error will be shown here ! -->
                </div>

             <div class="form-body">

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">Titulo de Noticia: <span class="symbol required"></span></label>
                                <input type="hidden" name="proceso" id="proceso" value="save"/>
                                <input type="hidden" name="codnoticia" id="codnoticia">
                                <input type="text" class="form-control" name="titulonoticia" id="titulonoticia" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Titulo de Noticia" autocomplete="off" required="" aria-required="true"/>  
                                <i class="fa fa-pencil form-control-feedback"></i> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label class="control-label">Status de Noticia: <span class="symbol required"></span></label>
                                <i class="fa fa-bars form-control-feedback"></i>
                                <select style="color:#000;font-weight:bold;" name="statusnoticia" id="statusnoticia" class="form-control" required="" aria-required="true">
                                <option value=""> -- SELECCIONE -- </option>
                                    <option value="PUBLICADA">PUBLICAR</option>
                                    <option value="NO PUBLICADA">NO PUBLICAR</option>
                                </select> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback2">
                                <label class="control-label">Descripción de Noticia: <span class="symbol required"></span></label>
                                <textarea class="form-control" name="descripcnoticia" id="descripcnoticia" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Descripción de Noticia" rows="2" autocomplete="off" required="" aria-required="true"></textarea>
                                <i class="fa fa-pencil form-control-feedback2"></i>
                            </div>
                        </div>
                    </div>

            <div class="text-right">
            <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-save"></span> Guardar</button>
            <button class="btn btn-dark" type="button" onclick="
                document.getElementById('proceso').value = 'save',
                document.getElementById('codnoticia').value = '',
                document.getElementById('titulonoticia').value = '',
                document.getElementById('statusnoticia').value = '',
                document.getElementById('descripcnoticia').value = ''
                "><span class="fa fa-trash-o"></span> Limpiar</button>
            </div>
        </div>
    </div>
</form>
</div>
</div>
</div>
<!--End Row -->

<?php } ?>

<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Noticias</h4>
            </div>

            <div class="form-body">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                          <div class="btn-group m-b-20">
                            <a class="btn waves-effect waves-light btn-light" href="reportepdf?tipo=<?php echo encrypt("NOTICIAS") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

                            <a class="btn waves-effect waves-light btn-light" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("NOTICIAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

                            <a class="btn waves-effect waves-light btn-light" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("NOTICIAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
                        </div>

                    </div>
                </div>

                <div id="noticias"></div>

            </div>
        </div>
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
    <script type="text/javascript" src="assets/calendario/jquery-ui.js"></script>
    <script type="text/javascript" src="assets/script/jscalendario.js"></script>
    <script type="text/javascript" src="assets/script/autocompleto.js"></script>
    <!-- Calendario -->

    <!-- jQuery -->
    <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/jscript">
    $('#noticias').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
    setTimeout(function() {
    $('#noticias').load("consultas?CargaNoticias=si");
     }, 200);
    </script>
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