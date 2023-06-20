<?php
require_once("class/class.php");

$con = new Login();
$con = $con->ConfiguracionPorId();

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
   
    <link rel="stylesheet" href="assets/hotel/css/colors.css" id="colors">
    
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow&family=Barlow+Condensed&family=Gilda+Display&display=swap">

    <link rel="stylesheet" href="assets/hotel/css/plugins.css">
    <link rel="stylesheet" href="assets/hotel/css/style.css">
    <link rel="stylesheet" href="assets/hotel/css/edit.css">
    <!-- Sweet-Alert -->
    <link rel="stylesheet" href="assets/css/sweetalert.css">

    <script src="assets/hotel/js/jquery-1.10.2.min.js"></script>
    <script src="assets/hotel/js/bootstrap-select.min.js"></script>
    <script src="assets/hotel/common/js/modernizr-2.6.1.min.js"></script>

    <script>
      Modernizr.load({
        load : [
        'assets/hotel/common/bootstrap/js/bootstrap.min.js',
        'assets/hotel/js/pluginss/respond/respond.min.js',
        //'assets/hotel/js/jquery-ui.js',
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
    <!-- Sweet-Alert -->
    <script src="assets/js/sweetalert-dev.js"></script>
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/jquery.mask.js"></script>
    <script type="text/javascript" src="assets/script/mask.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/ajax.js"></script>
    <script type="text/javascript" src="assets/script/validation.min.js"></script>
    <script type="text/javascript" src="assets/script/script.js"></script>
    <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>

</head>

<body id="page-5" itemscope="" itemtype="http://schema.org/WebPage">
<div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>

    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="index.html"> <img src="img/logo.png" class="logo-img" alt=""> </a>
                <!-- <a class="logo" href="index.html"> <h2>THE CAPPA <span>Luxury Hotel</span></h2> </a> -->
            </div>
            <!-- Button -->
            <!-- Menu -->
        
            
            
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"> <a class="nav-link " href="index" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Inicio</a></li>
                    <li class="nav-item dropdown"> <a class=" nav-link active dropdown-toggle" href="hotel" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Hotel</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Habitaciones<i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">

                        <?php
                        $hab = new Login();
                        $hab = $hab->ListarHabitacionesxTipos();
                
                        for($i=0;$i<sizeof($hab);$i++){
                            echo '<li><a href="rooms.php?habitacion='.$hab[$i]['nomtipo'].' " class="dropdown-item"><span  style="font-size:12px">'.$hab[$i]['nomtipo'].'</span></a></li>';
                        }
                        
                        ?>
                        
                        </ul>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link" href="gastronomy">Restaurante</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="booking" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Reservaciones</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="contact" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Contacto</i></a>
                    <li class="nav-item dropdown">
                    <li class="nav-item dropdown"> <a class=" nav-link  dropdown-toggle popup-modal firstLevel nav-item dropdown" href="#user-popup" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">LOGIN<i class="ti-angle-down"></i></a>
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
                          <h2 style='color: black; margin-top: 20px'>LOGIN DE ACCESO</h2><hr>
                          <form method="post" name="loginform" id="loginform" action="" class="ajax-form">

                          <div id="login">
                            <!-- error will be shown here ! -->
                          </div>

                          <div class="row">
                            <div class="col-md-12 m-t-10">
                              <div class="form-group has-feedback">
                                <label style='color: black;' class="control-label">Seleccione Acceso: <span class="symbol required"></span></label>
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
                                <label style='color: black;' class="control-label">Ingrese su Usuario: <span class="symbol required"></span></label>
                                <input type="hidden" name="proceso" value="login"/>
                                <input type="hidden" name="formulario" id="formulario" value="index"/>
                                <input type="text" class="form-control" placeholder="Ingrese su Usuario" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" required="" aria-required="true"> 
                                <i class="fa fa-user form-control-feedback"></i>                
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group has-feedback">
                                <label style='color: black;' class="control-label">Ingrese su Password: <span class="symbol required"></span></label>
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
                                  <input type="hidden" name="formulario" id="formulario" value="index"/>
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
        </div>
    </nav>

    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption mt-90">
                    <h5><?php echo $con[0]['nomhotel']; ?></h5>
                    <h1>Sobre Nosotros</h1>
                </div>
            </div>
        </div>
    </div>
    
              


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
                                <input type="hidden" name="formulario" id="formulario" value="hotel"/>
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
                                  <input type="hidden" name="formulario" id="formulario" value="hotel"/>
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

              
           


<section id="page">


<?php
$perfil = new Login();
$reg = $perfil->ListarPerfil();
   

for($i=0;$i<sizeof($reg);$i++){
    
  if($i%2==0){
    $backgroud='bg-darkblack';
  }else{
    $backgroud='';
  }

    echo '
    <section class="about section-padding '.$backgroud.'">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp"> 
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <div class="section-subtitle">'.$con[0]['nomhotel'].'</div>
                    <div class="section-title">'.$reg[$i]['nomperfil'].'</div>
                    <?php



if($reg==""){
    
    echo "";    

} else {
 
$a=1;
$descripcion = str_replace("<br> '.$reg[$i]['descperfil'].'
?>
                                
<section class="col-sm-13"><h3 style="font-size:13px;"itemprop="name"><?php echo '.$reg[$i]['nomperfil'].'; ?></h3> <p style="text-align: justify;font-size:13px;">
  <?php echo nl2br ('.$reg[$i]['descperfil'].'); ?></p></section>

<?php } ?>                    <!-- reservation -->
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:855-100-4444">855 100 4444</a>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp"> <img src="img/rooms/8.jpg" alt="" class="mt-90 mb-30"> </div>
                <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp"> <img src="img/rooms/2.jpg" alt=""> </div>
            </div>
        </div>
</section>
    ';
   }
?>
    
            

  


<!-- INICIO DE FOOTER -->
<!-- Footer -->
<footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-column footer-about">
                            <h3 class="footer-title">About Hotel</h3>
                            <p class="footer-about-text">Welcome to the best five-star deluxe hotel in New York. Hotel elementum sesue the aucan vestibulum aliquam justo in sapien rutrum volutpat.</p>

                        
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1">
                        <div class="footer-column footer-explore clearfix">
                            <h3 class="footer-title">Explore</h3>
                            <ul class="footer-explore-list list-unstyled">
                                <li><a href="index.php">Inicio</a></li>
                                <li><a href="hotel.php">Hotel</a></li>
                                <li><a href="restaurant.html">Habitaciones</a></li>
                                <li><a href="spa-wellness.html">Restaurante</a></li>
                                <li><a href="about.html">Reservaciones</a></li>
                                <li><a href="contact.html">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-column footer-contact">
                            <h3 class="footer-title">Contact</h3>
                            <p class="footer-contact-text">1616 Broadway NY, New York 10001<br>United States of America</p>
                            <div class="footer-contact-info">
                                <p class="footer-contact-phone"><span class="flaticon-call"></span> 855 100 4444</p>
                                <p class="footer-contact-mail">info@luxuryhotel.com</p>
                            </div>
                            <div class="footer-about-social-list">
                                <a href="#"><i class="ti-instagram"></i></a>
                                <a href="#"><i class="ti-twitter"></i></a>
                                <a href="#"><i class="ti-youtube"></i></a>
                                <a href="#"><i class="ti-facebook"></i></a>
                                <a href="#"><i class="ti-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-bottom-inner">
                            <p class="footer-bottom-copy-right">© Copyright 2023 by <a href="#">DuruThemes.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- FIN DE FOOTER -->
<script src="assets/js/modernizr-2.6.2.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.isotope.v3.0.2.js"></script>
    <script src="assets/js/pace.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scrollIt.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.stellar.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.js"></script>
    <script src="assets/js/YouTubePopUp.js"></script>
    <script src="assets/js/select2.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/smooth-scroll.min.js"></script>
    <script src="assets/hotel/js/index.js"></script>
</body>
</html>
