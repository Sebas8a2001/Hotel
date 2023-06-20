<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarHabitaciones();
exit;
} 
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarHabitaciones();
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
    <!--Magnific-popup-->
    <link rel="stylesheet" href="assets/plugins/magnific-popup/dist/magnific-popup.css">
    <!-- Sweet-Alert -->
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <!-- animation CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- needed css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="assets/css/default.css" id="theme" rel="stylesheet">
    <script type="text/javascript" src="assets/script/agrega-filas.js"></script>

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
        <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Gestión de Habitaciones</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Habitaciones</li>
                                <li class="breadcrumb-item active" aria-current="page">Habitaciones</li>
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
    

<?php  if (isset($_GET['h'])) { ?>

<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Fotos de la Habitación N° <?php echo decrypt($_GET["numhabitacion"]) ?></h4>
            </div>

            <div class="form-body">

                <div class="card-body">

                <div id="cargaimg"> 
                    
                    <div class="row">

                    <?php
                    $directory="fotos/habitaciones/".decrypt($_GET["h"]);
                    if (is_dir($directory)) {
                        $dirint = dir($directory);
                        while (($archivo = $dirint->read()) !== false){

                if ($archivo != "." && $archivo != ".." && substr_count($archivo , ".jpg")==1 || substr_count($archivo , ".JPG")==1 ){ ?>

                        <div class="col-md-3">
                            <div class="gal-detail thumb">
                                <a href="<?php echo $directory."/".$archivo; ?>" title="<?php echo "Foto N° #".$archivo; ?>" class="image-popup" title="Screenshot-1">
                                <img src="<?php echo $directory."/".$archivo; ?>" class="thumb-img" height="140" width="240"></a>
                            </div>
                        </div>
                    <?php }
                        }
                    $dirint->close();
                    } else { } ?>

                    </div>

                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->

<?php } ?>

<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title text-white"><i class="fa fa-save"></i> Gestión de Habitaciones</h4>
            </div>

<?php  if (isset($_GET['h'])) {
      
      $reg = $tra->HabitacionesPorId(); ?>
      
<form class="form form-material" method="post" action="#" name="updatehabitacion" id="updatehabitacion" data-id="<?php echo $reg[0]["codhabitacion"] ?>" enctype="multipart/form-data">
        
    <?php } else { ?>
        
<form class="form form-material" method="post" action="#" name="savehabitacion" id="savehabitacion" enctype="multipart/form-data">
      
    <?php } ?>

                <div id="save">
                   <!-- error will be shown here ! -->
                </div>

               <div class="form-body">

            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">N° de Habitación: <span class="symbol required"></span></label>
                            <input type="hidden" name="idhabitacion" id="idhabitacion" <?php if (isset($reg[0]['idhabitacion'])) { ?> value="<?php echo $reg[0]['idhabitacion']; ?>"<?php } ?>>
                            <input type="hidden" name="proceso" id="proceso" <?php if (isset($reg[0]['idhabitacion'])) { ?> value="update" <?php } else { ?> value="save" <?php } ?>/>
                            <input type="hidden" name="codhabitacion" id="codhabitacion" <?php if (isset($reg[0]['codhabitacion'])) { ?> value="<?php echo $reg[0]['codhabitacion']; ?>"<?php } ?>>
                            <input type="text" class="form-control" name="numhabitacion" id="numhabitacion" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese N° de Habitación" autocomplete="off" <?php if (isset($reg[0]['numhabitacion'])) { ?> value="<?php echo $reg[0]['numhabitacion']; ?>" <?php } ?> required="" aria-required="true"/>  
                            <i class="fa fa-pencil form-control-feedback"></i> 
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Descripción: <span class="symbol required"></span></label>
                            <input type="text" class="form-control" name="descriphabitacion" id="descriphabitacion" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Descripción de Habitación" autocomplete="off" <?php if (isset($reg[0]['descriphabitacion'])) { ?> value="<?php echo $reg[0]['descriphabitacion']; ?>" <?php } ?> required="" aria-required="true"/>  
                            <i class="fa fa-pencil form-control-feedback"></i> 
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">N° de Piso: <span class="symbol required"></span></label>
                            <input type="text" class="form-control" name="piso" id="piso" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese N° de Piso" autocomplete="off" <?php if (isset($reg[0]['piso'])) { ?> value="<?php echo $reg[0]['piso']; ?>" <?php } ?> required="" aria-required="true"/>  
                            <i class="fa fa-pencil form-control-feedback"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Vista: <span class="symbol required"></span></label>
                            <input type="text" class="form-control" name="vista" id="vista" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Vista de Habitación" autocomplete="off" <?php if (isset($reg[0]['vista'])) { ?> value="<?php echo $reg[0]['vista']; ?>" <?php } ?> required="" aria-required="true"/>  
                            <i class="fa fa-pencil form-control-feedback"></i>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Costo: <span class="symbol required"></span></label>
                            <i class="fa fa-bars form-control-feedback"></i>
                            <?php if (isset($reg[0]['codtarifa'])) { ?>
                            <select style="color:#000;font-weight:bold;" name="codtarifa" id="codtarifa" class='form-control' required="" aria-required="true">
                            <option value=""> -- SELECCIONE -- </option>
                            <?php
                            $tarifa = new Login();
                            $tarifa = $tarifa->ListarTarifas();
                            if($tarifa==""){
                              echo "";    
                            } else {
                            for($i=0;$i<sizeof($tarifa);$i++){ ?>
                            <option value="<?php echo $tarifa[$i]['codtarifa'] ?>"<?php if (!(strcmp($reg[0]['codtarifa'], htmlentities($tarifa[$i]['codtarifa'])))) { echo "selected=\"selected\"";} ?>><?php echo $tarifa[$i]['nomtipo'].": - (TEMPORADA BAJA: ".$tarifa[$i]['baja'].") - (TEMPORADA MEDIA: ".$tarifa[$i]['media'].") - (TEMPORADA ALTA: ".$tarifa[$i]['alta'].")"; ?></option>        
                              <?php } } ?>
                            </select>  
                             <?php } else { ?>
                            <select style="color:#000;font-weight:bold;" name="codtarifa" id="codtarifa" class='form-control' required="" aria-required="true">
                            <option value=""> -- SELECCIONE -- </option>
                            <?php
                            $tarifa = new Login();
                            $tarifa = $tarifa->ListarTarifas();
                            if($tarifa==""){
                              echo "";    
                            } else {
                            for($i=0;$i<sizeof($tarifa);$i++){ ?>
                            <option value="<?php echo $tarifa[$i]['codtarifa'] ?>"><?php echo $tarifa[$i]['nomtipo'].": - (TEMPORADA BAJA: ".$tarifa[$i]['baja'].") - (TEMPORADA MEDIA: ".$tarifa[$i]['media'].") - (TEMPORADA ALTA: ".$tarifa[$i]['alta'].")"; ?></option>
                             <?php } } ?>
                            </select>
                             <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">N° Máximo de Adultos: <span class="symbol required"></span></label>
                            <i class="fa fa-bars form-control-feedback"></i>
                               <?php if (isset($reg[0]['maxadultos'])) { ?>
                               <select style="color:#000;font-weight:bold;" name="maxadultos" id="maxadultos" class='form-control' required="" aria-required="true">
                                <option value=""> -- SELECCIONE -- </option>
<option value="1"<?php if (!(strcmp('1', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>1</option>
<option value="2"<?php if (!(strcmp('2', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>2</option>
<option value="3"<?php if (!(strcmp('3', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>3</option>
<option value="4"<?php if (!(strcmp('4', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>4</option>
<option value="5"<?php if (!(strcmp('5', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>5</option>
<option value="6"<?php if (!(strcmp('6', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>6</option>
<option value="7"<?php if (!(strcmp('7', $reg[0]['maxadultos']))) {echo "selected=\"selected\"";} ?>>7</option>
                                        </select>
                            <?php } else { ?>
                            <select style="color:#000;font-weight:bold;" name="maxadultos" id="maxadultos" class='form-control' required="" aria-required="true">
                                <option value=""> -- SELECCIONE -- </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                        </select>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">N° Máximo de Niños: <span class="symbol required"></span></label>
                            <i class="fa fa-bars form-control-feedback"></i>
                               <?php if (isset($reg[0]['maxninos'])) { ?>
                               <select style="color:#000;font-weight:bold;" name="maxninos" id="maxninos" class='form-control' required="" aria-required="true">
                                <option value=""> -- SELECCIONE -- </option>
<option value="0"<?php if (!(strcmp('0', $reg[0]['maxninos']))) {echo "selected=\"selected\"";} ?>>0</option>
<option value="1"<?php if (!(strcmp('1', $reg[0]['maxninos']))) {echo "selected=\"selected\"";} ?>>1</option>
<option value="2"<?php if (!(strcmp('2', $reg[0]['maxninos']))) {echo "selected=\"selected\"";} ?>>2</option>
<option value="3"<?php if (!(strcmp('3', $reg[0]['maxninos']))) {echo "selected=\"selected\"";} ?>>3</option>
<option value="4"<?php if (!(strcmp('4', $reg[0]['maxninos']))) {echo "selected=\"selected\"";} ?>>4</option>
<option value="5"<?php if (!(strcmp('5', $reg[0]['maxninos']))) {echo "selected=\"selected\"";} ?>>5</option>
                                        </select>
                            <?php } else { ?>
                            <select style="color:#000;font-weight:bold;" name="maxninos" id="maxninos" class='form-control' required="" aria-required="true">
                                <option value=""> -- SELECCIONE -- </option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                        </select>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Descuento: <span class="symbol required"></span></label>
                            <input type="text" class="form-control" name="deschabitacion" id="deschabitacion" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" placeholder="Ingrese Descuento de Habitación" autocomplete="off" <?php if (isset($reg[0]['deschabitacion'])) { ?> value="<?php echo $reg[0]['deschabitacion']; ?>" <?php } else { ?> value="0.00" <?php } ?> required="" aria-required="true"/>  
                            <i class="fa fa-tint form-control-feedback"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">En Mantenimiento: <span class="symbol required"></span></label> 
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="name1" name="statushab" value="1" <?php if (isset($reg[0]['statushab']) && $reg[0]['statushab'] == "1") { ?> checked="checked" <?php } ?> class="custom-control-input">
                            <label class="custom-control-label" for="name1">SI</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="name2" name="statushab" value="0" <?php if (isset($reg[0]['statushab'])) { ?> <?php if($reg[0]['statushab'] == "0") { ?> value="0" checked="checked" <?php } } else { ?> checked="checked" <?php } ?> class="custom-control-input">
                            <label class="custom-control-label" for="name2">NO</label>
                            </div>
                        </div>
                    </div>

                <div class="col-md-9"> 
                  <div class="form-group has-feedback">
                    <table width="100%" id="tabla"><tr> 

    <a class="btn btn-info btn-rounded" onClick="Add()"><font color="white"><i class="fa fa-plus-circle"></i></font></a>&nbsp;
    <a class="btn btn-dark btn-rounded" onClick="Delete()"><font color="white"><i class="fa fa-trash-o"></i></font></a><br></br>

                    <td><div class="col-md-12">  
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="form-group has-feedback"> 
            <label class="control-label">Foto de Habitación: <span class="symbol required"></span></label>
            <div class="input-group">
                <div class="form-control" data-trigger="fileinput"><i class="fa fa-file-photo-o fileinput-exists"></i>
                 <span class="fileinput-filename"></span>
                </div>
                <span class="input-group-addon btn btn-info btn-file">
                <span class="fileinput-new"><i class="fa fa-cloud-upload"></i> Selecciona Archivo</span>
                <span class="fileinput-exists"><i class="fa fa-file-photo-o"></i> Cambiar</span>
  <input type="file" class="btn btn-default" data-original-title="Subir Imagen" data-rel="tooltip" placeholder="Suba su Imagen" name="file[]" id="file">
                </span>
                <a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Quitar</a>
            </div> <small><p>Para Subir la Foto debe tener en cuenta:<br> * La Imagen debe ser extension.jpeg,jpg<br> * La imagen no debe ser mayor de 200 KB</p></small>                                            
        </div>
    </div>
</div></td></tr><input type="hidden" name="var_cont">
                 </table>
               </div> 
             </div>
           </div>

             <div class="text-right">
    <?php  if (isset($_GET['h'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-info"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-dark" type="reset"><span class="fa fa-trash-o"></span> Cancelar</button> 
    <?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-save"></span> Guardar</button>
<button class="btn btn-dark" type="reset"><span class="fa fa-trash-o"></span> Limpiar</button>
    <?php } ?>  
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

    <!-- Custom file upload -->
    <script src="assets/plugins/fileupload/bootstrap-fileupload.min.js"></script>
        
    <!--popup-->
    <script type="text/javascript" src="assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
        });
    </script>

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
        document.location.href='habitaciones'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?>