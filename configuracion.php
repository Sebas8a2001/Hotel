<?php
require_once("class/class.php");
if (isset($_SESSION['acceso'])) {
    if ($_SESSION['acceso'] == "administrador") {

$tra = new Login();
$ses = $tra->ExpiraSession();

$reg = $tra->ConfiguracionPorId();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarConfiguracion();
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
            <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Configuración</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Administración</li>
                                <li class="breadcrumb-item active" aria-current="page">Configuración</li>
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
                <h4 class="card-title text-white"><i class="fa fa-save"></i> Configuración</h4>
            </div>
            <form class="form-material" method="post" data-id="<?php echo $reg[0]["id"] ?>" action="#" name="configuracion" id="configuracion" enctype="multipart/form-data">

                <div id="error">
                 <!-- error will be shown here ! -->
                </div>

        <div class="form-body">

            <div class="card-body">


            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#perfil" role="tab"><span class="hidden-sm-up"><i class="fa fa-bank"></i></span> <span class="hidden-xs-down"> Datos de Configuración</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#institucion" role="tab"><span class="hidden-sm-up"><i class="fa fa-file-image-o"></i></span> <span class="hidden-xs-down"> Datos de Página y Logos</span></a> </li>
            </ul>
            <!-- Tab panes -->
            
            <div class="tab-content">

                <div class="tab-pane active" id="perfil" role="tabpanel">
                    <div class="p-4">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Tipo de Documento: </label>
                        <i class="fa fa-bars form-control-feedback"></i> 
                        <select style="color:#000;font-weight:bold;" name="documgerente" id="documgerente" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $doc = new Login();
                        $doc = $doc->ListarDocumentos();
                        if($doc==""){ 
                            echo "";
                        } else {
                        for($i=0;$i<sizeof($doc);$i++){ ?>
                        <option value="<?php echo $doc[$i]['coddocumento'] ?>"<?php if (!(strcmp($reg[0]['documgerente'], htmlentities($doc[$i]['coddocumento'])))) { echo "selected=\"selected\""; } ?>><?php echo $doc[$i]['documento'] ?></option>
                        <?php } } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Documento de Gerente: <span class="symbol required"></span></label>
                        <input type="hidden" name="proceso" id="proceso" value="update"/>
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $reg[0]['id']; ?>"/>
                        <input type="text" class="form-control" name="cedgerente" id="cedgerente" value="<?php echo $reg[0]['cedgerente']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Documento" autocomplete="off" required="" aria-required="true"/> 
                        <i class="fa fa-bolt form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre de Gerente: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nomgerente" id="nomgerente" value="<?php echo $reg[0]['nomgerente']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Gerente" autocomplete="off" required="" aria-required="true"/>  
                        <i class="fa fa-pencil form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono de Gerente: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="tlfgerente" id="tlfgerente" value="<?php echo $reg[0]['tlfgerente']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                        <i class="fa fa-phone form-control-feedback"></i> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                     <div class="form-group has-feedback">
                        <label class="control-label">Dirección de Gerente: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="direcgerente" id="direcgerente" value="<?php echo $reg[0]['direcgerente']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" autocomplete="off" required="" aria-required="true"/>  
                        <i class="fa fa-map-marker form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Tipo de Documento: </label>
                        <i class="fa fa-bars form-control-feedback"></i> 
                        <select style="color:#000;font-weight:bold;" name="documenhotel" id="documenhotel" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $doc = new Login();
                        $doc = $doc->ListarDocumentos();
                        if($doc==""){ 
                            echo "";
                        } else {
                        for($i=0;$i<sizeof($doc);$i++){ ?>
                        <option value="<?php echo $doc[$i]['coddocumento'] ?>"<?php if (!(strcmp($reg[0]['documenhotel'], htmlentities($doc[$i]['coddocumento'])))) { echo "selected=\"selected\""; } ?>><?php echo $doc[$i]['documento'] ?></option>
                        <?php } } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Registro de Hotel: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nrohotel" id="nrohotel" value="<?php echo $reg[0]['nrohotel']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Registro" autocomplete="off" required="" aria-required="true"/> 
                        <i class="fa fa-bolt form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nombre de Hotel: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="nomhotel" id="nomhotel" value="<?php echo $reg[0]['nomhotel']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Hotel" autocomplete="off" required="" aria-required="true"/>  
                        <i class="fa fa-pencil form-control-feedback"></i> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Nº de Teléfono de Hotel: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="tlfhotel" id="tlfhotel" value="<?php echo $reg[0]['tlfhotel']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                        <i class="fa fa-phone form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                   <div class="form-group has-feedback">
                        <label class="control-label">Dirección de Hotel: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="direchotel" id="direchotel" value="<?php echo $reg[0]['direchotel']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección de Hotel" autocomplete="off" required="" aria-required="true"/>  
                        <i class="fa fa-map-marker form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Correo Electronico: <span class="symbol required"></span></label>
                        <input type="text" class="form-control" name="emailhotel" id="emailhotel" value="<?php echo $reg[0]['emailhotel']; ?>" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Correo Electronico" autocomplete="off" required="" aria-required="true"/> 
                        <i class="fa fa-envelope-o form-control-feedback"></i> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Categoria de Hotel: <span class="symbol required"></span></label>
                        <i class="fa fa-bars form-control-feedback"></i>
                        <select style="color:#000;font-weight:bold;" name="categoriahotel" id="categoriahotel" class='form-control' required="" aria-required="true">
                        <option value="">-- SELECCIONE --</option>
<option value="1"<?php if (!(strcmp('1', $reg[0]['categoriahotel']))) {echo "selected=\"selected\"";} ?>>1 ESTRELLA</option>
<option value="2"<?php if (!(strcmp('2', $reg[0]['categoriahotel']))) {echo "selected=\"selected\"";} ?>>2 ESTRELLA</option>
<option value="3"<?php if (!(strcmp('3', $reg[0]['categoriahotel']))) {echo "selected=\"selected\"";} ?>>3 ESTRELLA</option>
<option value="4"<?php if (!(strcmp('4', $reg[0]['categoriahotel']))) {echo "selected=\"selected\"";} ?>>4 ESTRELLA</option>
<option value="5"<?php if (!(strcmp('5', $reg[0]['categoriahotel']))) {echo "selected=\"selected\"";} ?>>5 ESTRELLA</option>
                        </select>
                    </div>
                </div>
            </div>




                <div class="row"> 
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Nº de Actividad: <span class="symbol required"></span></label>
                            <input type="text" class="form-control" name="nroactividad" id="nroactividad" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['nroactividad']; ?>" autocomplete="off" placeholder="Ingrese Nº de Actividad" required="" aria-required="true">
                            <i class="fa fa-pencil form-control-feedback"></i> 
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Nº Inicio de Factura: <span class="symbol required"></span></label>
                                <input type="text" class="form-control" name="iniciofactura" id="iniciofactura" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['iniciofactura']; ?>" placeholder="Ingrese Nº Inicio de Factura" autocomplete="off" required="" aria-required="true"/> 
                                <i class="fa fa-bolt form-control-feedback"></i>  
                        </div>
                    </div> 

                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label class="control-label">Fecha de Autorización: <span class="symbol required"></span></label>
                            <input type="text" class="form-control calendario" name="fechaautorizacion" id="fechaautorizacion" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $reg[0]['fechaautorizacion'] == '0000-00-00' ? "0000-00-00" : date("d-m-Y",strtotime($reg[0]['fechaautorizacion'])); ?>"  autocomplete="off" placeholder="Ingrese Fecha de Autorización" required="" aria-required="true">
                            <i class="fa fa-calendar form-control-feedback"></i> 
                        </div>
                    </div> 

                    <div class="col-md-3"> 
                      <div class="form-group has-feedback"> 
                        <label class="control-label">Lleva Contabilidad: <span class="symbol required"></span></label>
                        <i class="fa fa-bars form-control-feedback"></i>
                        <select style="color:#000;font-weight:bold;" name="llevacontabilidad" id="llevacontabilidad" class="form-control" required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <option value="SI"<?php if (!(strcmp('SI', $reg[0]['llevacontabilidad']))) {echo "selected=\"selected\"";} ?>>SI</option>
                        <option value="NO"<?php if (!(strcmp('NO', $reg[0]['llevacontabilidad']))) {echo "selected=\"selected\"";} ?>>NO</option>
                        </select>
                    </div> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"> 
                    <div class="form-group has-feedback"> 
                    <label class="control-label">Descto Global para Reservaciones: <span class="symbol required"></span></label> 
                        <input type="text" class="form-control" name="dsctor" id="dsctor" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Descto Global para Reservaciones" value="<?php echo $reg[0]['dsctor']; ?>" required="" aria-required="true">
                        <i class="fa fa-usd form-control-feedback"></i>  
                    </div> 
                </div>

                <div class="col-md-3"> 
                    <div class="form-group has-feedback"> 
                        <label class="control-label">Descto Global para Ventas: <span class="symbol required"></span></label> 
                        <input type="text" class="form-control" name="dsctov" id="dsctov" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Descto Global para Ventas" value="<?php echo $reg[0]['dsctov']; ?>" required="" aria-required="true">
                        <i class="fa fa-usd form-control-feedback"></i>  
                    </div> 
                </div>
                
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Seleccione Moneda Nacional: <span class="symbol required"></span></label>
                        <i class="fa fa-bars form-control-feedback"></i>
                        <select style="color:#000;font-weight:bold;" name="codmoneda" id="codmoneda" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $moneda = new Login();
                        $moneda = $moneda->ListarTipoMoneda();
                        if($moneda==""){ 
                            echo "";
                        } else {
                        for($i=0;$i<sizeof($moneda);$i++){ ?>
                        <option value="<?php echo $moneda[$i]['codmoneda'] ?>"<?php if (!(strcmp($reg[0]['codmoneda'], htmlentities($moneda[$i]['codmoneda'])))) { echo "selected=\"selected\""; } ?>><?php echo $moneda[$i]['moneda'] ?></option>        
                        <?php } } ?>
                        </select> 
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group has-feedback">
                        <label class="control-label">Seleccione Moneda para Cambio: <span class="symbol required"></span></label>
                        <i class="fa fa-bars form-control-feedback"></i>
                        <select style="color:#000;font-weight:bold;" name="codmoneda2" id="codmoneda2" class='form-control' required="" aria-required="true">
                        <option value=""> -- SELECCIONE -- </option>
                        <?php
                        $moneda = new Login();
                        $moneda = $moneda->ListarTipoMoneda();
                        if($moneda==""){ 
                            echo "";
                        } else {
                        for($i=0;$i<sizeof($moneda);$i++){ ?>
                        <option value="<?php echo $moneda[$i]['codmoneda'] ?>"<?php if (!(strcmp($reg[0]['codmoneda2'], htmlentities($moneda[$i]['codmoneda'])))) { echo "selected=\"selected\""; } ?>><?php echo $moneda[$i]['moneda']; ?></option>        
                        <?php } } ?>
                        </select> 
                    </div>
                </div>
            </div>


                    </div>
                </div>


                <div class="tab-pane p-4" id="institucion" role="tabpanel">

            <div class="row">
                <div class="col-md-6">
                   <div class="form-group has-feedback2">
                        <label class="control-label">Acerca de Nosotros: <span class="symbol required"></span></label>
                        <textarea class="form-control" name="acerca" id="acerca" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Acerca de Hotel" rows="2" autocomplete="off" required="" aria-required="true"><?php echo $reg[0]['acerca']; ?></textarea>
                        <i class="fa fa-pencil form-control-feedback2"></i> 
                    </div>
                </div>

                <div class="col-md-6">
                   <div class="form-group has-feedback2">
                        <label class="control-label">Metodos de Pago: <span class="symbol required"></span></label>
                        <textarea class="form-control" name="metodopago" id="metodopago" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Metodos de Pagos" rows="2" autocomplete="off" required="" aria-required="true"><?php echo $reg[0]['metodopago']; ?></textarea>
                        <i class="fa fa-pencil form-control-feedback2"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100px; height: 120px;">
                            <?php if (file_exists("fotos/logo-principal.png")){
                                echo "<img src='fotos/logo-principal.png' class='img-rounded' border='0' width='100' height='120' title='Logo' data-rel='tooltip'>"; 
                            } else {
                                echo "<img src='fotos/ninguna.png' class='img-rounded' border='0' width='100' height='120' title='Sin Logo' data-rel='tooltip'>"; 
                            } ?>
                        </div>
                        <div>
                          <span class="btn btn-success btn-file">
                            <span class="fileinput-new"><i class="fa fa-file-image-o"></i> Logo Principal</span>
                            <span class="fileinput-exists"><i class="fa fa-paint-brush"></i> Logo Principal</span>
                            <input type="file" size="10" data-original-title="Subir Logo" data-rel="tooltip" placeholder="Suba su Logo" name="imagen" id="imagen"/>
                        </span>
                        <a href="#" class="btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times-circle"></i> Remover</a><small><p>Para Subir el Logo de Página Principal de Hotel debe tener en cuenta:<br> * La Imagen debe ser extension.png<br> * La imagen no debe ser mayor de 200 KB</p></small>                             
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100px; height: 120px;">
                            <?php if (file_exists("fotos/logo-admin.png")){
                                echo "<img src='fotos/logo-admin.png' class='img-rounded' border='0' width='100' height='120' title='Logo' data-rel='tooltip'>"; 
                            } else {
                                echo "<img src='fotos/ninguna.png' class='img-rounded' border='0' width='100' height='120' title='Sin Logo' data-rel='tooltip'>"; 
                            } ?>
                        </div>
                        <div>
                          <span class="btn btn-success btn-file">
                            <span class="fileinput-new"><i class="fa fa-file-image-o"></i> Logo Administración</span>
                            <span class="fileinput-exists"><i class="fa fa-paint-brush"></i> Logo Administración</span>
                            <input type="file" size="10" data-original-title="Subir Logo" data-rel="tooltip" placeholder="Suba su Logo" name="imagen2" id="imagen2"/>
                        </span>
                        <a href="#" class="btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times-circle"></i> Remover</a><small><p>Para Subir el Logo de Administración debe tener en cuenta:<br> * La Imagen debe ser extension.png<br> * La imagen no debe ser mayor de 200 KB</p></small>                             
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100px; height: 120px;">
                            <?php if (file_exists("fotos/logo-pdf.png")){
                                echo "<img src='fotos/logo-pdf.png' class='img-rounded' border='0' width='100' height='120' title='Logo' data-rel='tooltip'>"; 
                            } else {
                                echo "<img src='fotos/ninguna.png' class='img-rounded' border='0' width='100' height='120' title='Sin Logo' data-rel='tooltip'>"; 
                            } ?>
                        </div>
                        <div>
                          <span class="btn btn-success btn-file">
                            <span class="fileinput-new"><i class="fa fa-file-image-o"></i> Logo Reporte</span>
                            <span class="fileinput-exists"><i class="fa fa-paint-brush"></i> Logo Reporte</span>
                            <input type="file" size="10" data-original-title="Subir Logo" data-rel="tooltip" placeholder="Suba su Logo" name="imagen3" id="imagen3"/>
                        </span>
                        <a href="#" class="btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times-circle"></i> Remover</a><small><p>Para Subir el Logo para Reportes PDF debe tener en cuenta:<br> * La Imagen debe ser extension.png<br> * La imagen no debe ser mayor de 200 KB</p></small>                             
                        </div>
                    </div>
                </div>
            </div>

                </div>

                <div class="text-right">
                    <button type="submit" name="btn-update" id="btn-update" class="btn btn-info"><span class="fa fa-save"></span> Actualizar</button>
                    <button class="btn btn-dark" type="reset"><span class="fa fa-trash-o"></span> Cancelar</button>
                </div>

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
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.js"></script>

    <!-- Custom file upload -->
    <script src="assets/plugins/fileupload/bootstrap-fileupload.min.js"></script>

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/jquery.mask.js"></script>
    <script type="text/javascript" src="assets/script/mask.js"></script>
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