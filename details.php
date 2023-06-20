<?php
require_once("class/class.php");

$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = "<strong>".$con[0]['simbolo']."</strong>";

$tra = new Login();
$hab = $tra->HabitacionesPorId();

$tra = new Login();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="login")
{
  $log = $tra->Logueo();
  exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="recuperar")
{
  $reg = $tra->RecuperarPassword();
  exit;
}

?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Yoni Belito Sedano">
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
<title></title>

    <link rel="stylesheet" href="assets/hotel/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/hotel/js/pluginss/jquery.event.calendar/css/jquery.event.calendar.css" media="all">
    <link rel="stylesheet" href="assets/hotel/js/pluginss/royalslider/royalslider.css" media="all">
    <link rel="stylesheet" href="assets/hotel/js/pluginss/royalslider/skins/minimal-white/rs-minimal-white.css" media="all">
    <link rel="stylesheet" href="assets/hotel/js/pluginss/isotope/css/style.css" media="all">

    <link rel="stylesheet" href="assets/hotel/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/hotel/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/hotel/common/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/hotel/common/css/shortcodes.css">
    <link rel="stylesheet" href="assets/hotel/css/layout.css">
    <link rel="stylesheet" href="assets/hotel/css/colors.css" id="colors">
    <link rel="stylesheet" href="assets/hotel/css/custom.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/hotel/css/style.css">
    <!-- Calendario CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="assets/css/calendario.css">

    <script src="assets/hotel/js/jquery-1.10.2.min.js"></script>
    <script src="assets/hotel/js/bootstrap-select.min.js"></script>
    <script src="assets/hotel/common/js/modernizr-2.6.1.min.js"></script>

    <script>
      Modernizr.load({
        load : [
        'assets/hotel/common/bootstrap/js/bootstrap.min.js',
        'assets/hotel/js/pluginss/respond/respond.min.js',
        'assets/hotel/js/jquery-ui.js',
        'assets/hotel/js/pluginss/jquery-cookie/jquery-cookie.js',
        'assets/hotel/js/pluginss/easing/jquery.easing.1.3.min.js',
        'assets/hotel/common/js/plugins/magnific-popup/jquery.magnific-popup.min.js',
        //Javascripts required by the current model
        'assets/hotel/js/pluginss/royalslider/jquery.royalslider.min.js',
        'assets/hotel/js/pluginss/isotope/jquery.isotope.min.js',
        'assets/hotel/js/pluginss/isotope/jquery.isotope.sloppy-masonry.min.js',
        'assets/hotel/js/jquery.imagesloaded.min.js',
        'assets/hotel/js/pluginss/imagefill/js/jquery-imagefill.js',
        'assets/hotel/js/pluginss/toucheeffect/toucheffects.js',
                ],
        complete : function(){
        Modernizr.load('assets/hotel/common/js/custom.js');
        Modernizr.load('assets/hotel/js/custom.js');
                }
            });
      $(function(){});
        /* ==============================================
         * PLACE ANALYTICS CODE HERE
         * ==============================================
         */
         var _gaq = _gaq || [];
        
      </script>

    <!-- script jquery -->
    <script src="assets/script/jquery.min.js"></script> 
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <!-- script jquery -->

</head>

<body id="page-9" itemscope itemtype="http://schema.org/WebPage">
   
<header class="navbar-fixed-top" role="banner">
    <div id="mainHeader">
        <div class="container">
            <div id="mainMenu" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="primary nav-1">
                  <a class="firstLevel" href="index" title="Panel Principal"><i class="fa fa-tasks"></i> Inicio</a>                  
                </li>

                <li class="primary nav-5">
                  <a class="dropdown-toggle disabled firstLevel" href="hotel" title="Información de Hotel"><i class="fa fa-building"></i> Hotel</a>                  
                </li>

                <li class="primary nav-9">
                  <a class="dropdown-toggle disabled firstLevel active" href="rooms" title="Habitaciones"><i class="fa fa-cubes"></i> Habitaciones</a>                  
                </li>

                <li class="primary nav-7">
                  <a class="dropdown-toggle disabled firstLevel" href="gastronomy" title="Gastronomía"><i class="fa fa-cutlery"></i> Gastronomía</a>      
                </li>

                <li class="primary nav-7">
                  <a class="dropdown-toggle disabled firstLevel" href="tourism" title="Sitios Turísticos"><i class="fa fa-globe"></i> Sitios Turísticos</a>      
                </li>

                <li class="primary nav-10">
                  <a class="dropdown-toggle disabled firstLevel" href="booking" title="Reservaciones"><i class="fa fa-calendar"></i> Reservaciones</a>                  
                </li>

                <li class="primary nav-2">
                  <a class="dropdown-toggle disabled firstLevel" href="contact" title="Formulario de Contacto"><i class="fa fa-envelope-o"></i> Contacto</a>                 
                </li>

                <li class="primary">
                  <a class="popup-modal firstLevel" data-backdrop="static" data-keyboard="false" href="#user-popup"><i class="fa fa-power-off"></i> Login</a>
                </li>
              </ul>


            <!--FORMULARIOS-->   
            <div id="user-popup" class="white-popup-block mfp-hide">
                  <div class="fluid-container">
                        <!--<div class="row">
                            <div class="col-xs-12 mb20 text-center">
                                <a class="btn fblogin" href="#"><i class="fa fa-facebook"></i> Log in with Facebook</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 mb20 text-center">
                                - Or -
                            </div>
                        </div>-->
                        
                  <div class="row">
                      <div class="col-xs-12">
                            
                        <!--FORMULARIO DE ACCESO-->
                        <div class="login-form">
                          <h2>LOGIN DE ACCESO</h2><hr>
                          <form method="post" name="loginform" id="loginform" action="" class="ajax-form">

                          <div id="login">
                            <!-- error will be shown here ! -->
                          </div>

                          <div class="row">
                            <div class="col-md-12 m-t-10">
                              <div class="form-group has-feedback">
                                <label class="control-label">Seleccione Acceso: <span class="symbol required"></span></label>
                                <i class="fa fa-bars form-control-feedback"></i>  
                                <select style="color:#000;font-weight:bold;" name="select" id="select" class='form-control' required="" aria-required="true">
                                  <option value="">SELECCIONE</option>
                                  <option value="ADMINISTRADOR(A)">ADMINISTRADOR(A)</option>
                                  <option value="SECRETARIA">SECRETARIA</option>
                                  <option value="RECEPCIONISTA">RECEPCIONISTA</option>
                                  <option value="CLIENTE">CLIENTES</option>
                                </select>                 
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group has-feedback">
                                <label class="control-label">Ingrese su Usuario: <span class="symbol required"></span></label>
                                <input type="hidden" name="proceso" value="login"/>
                                <input type="hidden" name="formulario" id="formulario" value="details"/>
                                <input type="text" class="form-control" placeholder="Ingrese su Usuario" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true"> 
                                <i class="fa fa-user form-control-feedback"></i>                
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group has-feedback">
                                <label class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
                                <input class="form-control" type="password" placeholder="Ingrese su Password" name="password" id="password" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true">
                                <i class="fa fa-key form-control-feedback"></i>               
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <a href="javascript:void(0)" class="tips text-dark pull-left" data-placement="left" title="El Cliente deberá de ingresar su N° de Documento como usuario, y si es nuevo ingreso la misma deberá de ir como Clave de Acceso, una vez que ingrese al sistema podrá actualizarla"><i class="fa fa-comment"></i> Mensaje de Ayuda</a>
                              <a href="javascript:void(0)" class="open-pass-form text-dark pull-right"><i class="fa fa-lock"></i> Olvidaste tu Contraseña?</a>          
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-sm-12 text-right">
                                <button class="btn btn-default" name="btn-login" id="btn-login" type="submit"><i class="fa fa-sign-out"></i> Acceder</button>
                               </div>
                          </div>
                          </form>
                        </div>
                        <!--FORMULARIO DE ACCESO-->
                                                                
                        <!--FORMULARIO DE RECUPERAR PASSWORD-->
                         <div class="pass-form" style="display: none;">
                           <h2>RECUPERAR PASSWORD</h2><hr>
                           <form method="post" name="recoverform" id="recoverform" action="" class="ajax-form">

                             <div id="recover">
                               <!-- error will be shown here ! -->
                             </div>

                             <p style="text-align: justify;">Introduzca su dirección de correo electrónico correspondiente a su cuenta. Una nueva contraseña le será enviada por e-mail.</p>

                             <div class="row">
                              <div class="col-md-12 m-t-10">
                                <div class="form-group has-feedback">
                                  <label class="control-label">Seleccione Acceso: <span class="symbol required"></span></label>
                                  <i class="fa fa-bars form-control-feedback"></i>  
                                  <select style="color:#000;font-weight:bold;" name="select" id="select" class='form-control' required="" aria-required="true">
                                    <option value="">SELECCIONE</option>
                                    <option value="ADMINISTRADOR(A)">ADMINISTRADOR(A)</option>
                                    <option value="SECRETARIA">SECRETARIA</option>
                                    <option value="RECEPCIONISTA">RECEPCIONISTA</option>
                                    <option value="CLIENTE">CLIENTES</option>
                                  </select>                 
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group has-feedback">
                                  <label class="control-label">Correo Electrónico: <span class="symbol required"></span></label>
                                  <input type="hidden" name="proceso" value="recuperar"/>
                                  <input type="hidden" name="formulario" id="formulario" value="details"/>
                                  <input type="text" class="form-control" name="email" id="email" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese su Correo Electronico" autocomplete="off" required="" aria-required="true"/> 
                                  <i class="fa fa-envelope-o form-control-feedback"></i>                            
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <a class="open-login-form" href="#"><i class="fa fa-arrow-circle-left"></i> Iniciar Sesión</a>          
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-12 text-right">
                                <button class="btn btn-default" name="btn-recuperar" id="btn-recuperar" type="submit"><span class="fa fa-check-square-o"></span> Recuperar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!--FORMULARIO DE RECUPERAR PASSWORD-->

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                    
                    </button>
                <a class="navbar-brand" href="#"><?php if (file_exists("fotos/logo-principal.png")){
                        echo "<img src='fotos/logo-principal.png' alt='Logo Principal'>"; 
                                    } else {
                        echo "<img src='' alt='Logo Principal'>"; 
                                    } 
                    ?></a>                
                </div>
            </div>
        </div>
    </div>
</header>

<article id="page">
    <header class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                                    
                    <p itemprop="name" class="main-title">Detalle de Habitación</p>
          </div>
            <div class="col-sm-5 hidden-xs">
                <div itemprop="breadcrumb" class="breadcrumb clearfix">
                    
                    <a href="index" title="Inicio">Inicio</a>
                    <a href="rooms" title="Rooms">Habitaciones</a>
                                            
                    <span><?php echo $hab[0]['nomtipo']; ?></span>
                </div>
               <a href="rooms" class="btn btn-sm btn-primary pull-right" title="Habitaciones"><i class="fa fa-angle-double-left"></i>Atras</a>
          </div>
        </div>
    </div>
</header>

<div id="content" class="pt20 pb30">
  <div class="container">
    <div class="row">
      <div class="col-md-8 boxed mb20">
        <div class="row mb10">
          <div class="col-sm-7">
            <h1 class="mb0"><?php echo $hab[0]['nomtipo']." #".$hab[0]["numhabitacion"] ?></h1>
            <div class="clearfix"></div>
            <h4>Descripción de la Habitación</h4>
            <h6><?php echo $hab[0]['descriphabitacion']; ?></h6>
          </div>
          
          <div class="col-sm-5 text-right">
           
      <span class="price text-primary">Temporada Baja:</span> <?php echo $simbolo.$hab[0]['baja']; ?> / Noche<br>       
      <span class="price text-primary">Temporada Media:</span> <?php echo $simbolo.$hab[0]['media']; ?> / Noche<br>
      <span class="price text-primary">Temporada Alta:</span> <?php echo $simbolo.$hab[0]['alta']; ?> / Noche<br>
        
      <span class="price text-primary">Piso:</span> <?php echo $hab[0]['piso']; ?><br> 
      <span class="price text-primary">Vista:</span> <?php echo $hab[0]['vista']; ?><br>
      <span class="price text-primary">Capacidad Adultos:</span> <i class="fa fa-male"></i>x<?php echo $hab[0]['maxadultos']; ?><br>
      <span class="price text-primary">Capacidad Niños:</span> <i class="fa fa-child"></i> x<?php echo $hab[0]['maxninos']; ?>
       </div>
     </div>
     
     <div class="row mb10">
      <div class="col-sm-12">
        
       <span class="facility-icon">
        <img alt="No se aceptan animales" title="No se aceptan animales" src="assets/hotel/common/big/3/pet-not-allowed.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Canales de satélite" title="Canales de satélite" src="assets/hotel/common/big/8/satellite.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Aire Acondicionado" title="Aire Acondicionado" src="assets/hotel/common/big/9/air-conditioning.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Seguro" title="Seguro" src="assets/hotel/common/big/10/safe.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Sala de estar" title="Sala de estar" src="assets/hotel/common/big/11/lounge.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Cuna" title="Cuna" src="assets/hotel/common/big/15/baby-cot.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Lavadora" title="Lavadora" src="assets/hotel/common/big/16/washing-machine.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Mini-bar" title="Mini-bar" src="assets/hotel/common/big/18/mini-bar.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="De no fumadores" title="De no fumadores" src="assets/hotel/common/big/19/non-smoking.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Estacionamiento gratis" title="Estacionamiento gratis" src="assets/hotel/common/big/20/free-parking.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Ducha" title="Ducha" src="assets/hotel/common/big/25/shower.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Baño" title="Baño" src="assets/hotel/common/big/26/bath.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Secador de pelo" title="Secador de pelo" src="assets/hotel/common/big/27/hairdryer.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Telefono" title="Telefono" src="assets/hotel/common/big/28/phone.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Televisión" title="Televisión" src="assets/hotel/common/big/29/tv.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Internet WiFi" title="Internet WiFi" src="assets/hotel/common/big/32/wifi.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Ascensores" title="Ascensores" src="assets/hotel/common/big/35/elevator.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Restaurante" title="Restaurante" src="assets/hotel/common/big/37/restaurant.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Servicio de Habitacion" title="Servicio de Habitacion" src="assets/hotel/common/big/38/room-service.png" class="tips">
      </span>
      
      <span class="facility-icon">
        <img alt="Guardaropa" title="Guardaropa" src="assets/hotel/common/big/39/cloakroom.png" class="tips">
      </span>
      
      
    </div>
  </div>
  
  <div class="row mb10">
    <div class="col-md-12">
     
     <?php
     $directory="fotos/habitaciones/".$hab[0]["codhabitacion"];
     if (is_dir($directory)) {
      $dirint = dir($directory);
      while (($archivo = $dirint->read()) !== false)
      {
       
        if ($archivo != "." && $archivo != ".." && substr_count($archivo , ".jpg")==1 || substr_count($archivo , ".JPG")==1 ){  ?>
          
          <div class="col-lg-4 graphicdesign photography"><img src="<?php echo $directory."/".$archivo?>" class="img-rounded thumbnail" alt="work-thumbnail" title="<?php echo $archivo; ?>" height="180" width="240">
          </div>
          
          
          <?php
          
        }
      }
      $dirint->close();
    } else {
     
    }
    ?>  
    
  </div>
</div>
</div>

<aside class="col-md-4 mb20">
  <div class="boxed">
    <p class="widget-title">Fechas Reservadas</p>
    <div class="row">
      <div class="col-xs-9">
        <div class="calendario_ajax">
          <div id="cal"></div>
          <div id="mask"></div>
        </div>
      <script>
      function generar_calendario(mes,anio) {
        
        var codigo = "<?php echo encrypt($hab[0]["codhabitacion"]); ?>";

        $.ajax({
        type: "GET",
        url: "ajax_calendario.php",
        cache: false,
        data: { codigo:codigo,mes:mes,anio:anio,accion:"generar_calendario" }
          }).done(function( respuesta ) {
            //agenda.html(respuesta);
            $('#cal').html(respuesta);
          });
        }

      function formatDate (input) {
        var datePart = input.match(/\d+/g),
        year = datePart[0].substring(2),
        month = datePart[1], day = datePart[2];
        return day+'-'+month+'-'+year;
      }

      $(document).ready(function() {
      /* GENERAMOS CALENDARIO CON FECHA DE HOY */
        generar_calendario("<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>","<?php if (isset($_GET["anio"])) echo $_GET["anio"]; ?>");

        $(document).on("click",".anterior,.siguiente",function(e) {
          e.preventDefault();
          var datos=$(this).attr("rel");
          var nueva_fecha=datos.split("-");
          generar_calendario(nueva_fecha[1],nueva_fecha[0]);
        });
      });
</script>				
      </div>

    </div>
  </div>
</aside>

</div>
</div>
</div>
</article>


<!-- INICIO DE FOOTER -->
<?php include('footer.php'); ?>
<!-- FIN DE FOOTER -->

</body>
</html>