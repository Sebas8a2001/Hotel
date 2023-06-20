<?php
require_once("class/class.php");

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
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="msj_contact")
{
$reg = $tra->EnviarContact();
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

<body id="page-2" itemscope itemtype="http://schema.org/WebPage">

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
                    <li class="nav-item dropdown"> <a class=" nav-link  dropdown-toggle" href="hotel" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Hotel</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link  dropdown-toggle" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Habitaciones<i class="ti-angle-down"></i></a>
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
                    
                    <li class="nav-item"><a class="nav-link " href="gastronomy">Restaurante</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="booking" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Reservaciones</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link active dropdown-toggle" href="contact" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Contacto</i></a>
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
         
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="fotos/slides/slide1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5>Get in touch</h5>
                    <h1>Contact Us</h1>
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
                                <input type="hidden" name="formulario" id="formulario" value="contact"/>
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
                                  <input type="hidden" name="formulario" id="formulario" value="contact"/>
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

          
            

<script type="text/javascript">
    //var locations = [['Big Ben', 'London SW1A 0AA', '51.500729', '-0.124625']];
</script>

<section class="contact section-padding">
        <div class="container">
            <div class="row mb-90">
                <div class="col-md-6 mb-60">
                    <h3>The Cappa Luxury Hotel</h3>
                    <p>Hotel ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque penatibus et magnis dis parturient monte nascete ridiculus mus nellentesque habitant morbine.</p>
                    <div class="reservations mb-30">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:855-100-4444">855 100 4444</a>
                        </div>
                    </div>
                    <div class="reservations mb-30">
                        <div class="icon"><span class="flaticon-envelope"></span></div>
                        <div class="text">
                            <p>Email Info</p> <a href="mailto:info@luxuryhotel.com">info@luxuryhotel.com</a>
                        </div>
                    </div>
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-location-pin"></span></div>
                        <div class="text">
                            <p>Address</p> 1616 Broadway NY, New York 10001
                            <br>United States of America
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-30 offset-md-1">
                    <h3>Get in touch</h3>
                    <form class="form" action="#" method="post" name="formcontact" id="formcontact">
                        <!-- form message -->
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                            </div>
                        </div>
                        <!-- form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="name" type="text" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="email" type="email" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="phone" type="text" placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="subject" type="text" placeholder="Subject *" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="butn-dark2"><span>Send Message</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Map Section -->
            <div class="row">
                <div class="col-md-12 map animate-box" data-animate-effect="fadeInUp">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7979.487961044656!2d-78.1201194!3d0.3497619!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e2a3cb7cc59d285%3A0x5db2e44a714ed945!2sPedro+Moncayo+%26+Jos%C3%A9+Joaqu%C3%ADn+Olmedo%2C+Ibarra%2C+Ecuador!5e0!3m2!1ses!2s!4v1482219030193" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
<!-- Reservation & Booking Form -->
<section class="testimonials">
<?php
$perfil = new Login();
$reg = $perfil->ListarPerfil();

?>
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/2.jpg" data-overlay-dark="2">
            <div class="container">
                <div class="row">
                    <!-- Reservation -->
                    <div class="col-md-5 mb-30 mt-30">
                        <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></p>
                        <h5><?php echo $reg[13]['descperfil']?></h5>
                        <div class="reservations mb-30">
                            <div class="icon color-1"><span class="flaticon-call"></span></div>
                            <div class="text">
                                <p class="color-1">Reservation</p> <a class="color-1" href="tel:855-100-4444">855 100 4444</a>
                            </div>
                        </div>
                        <p><i class="ti-check"></i><small>Call us, it's toll-free.</small></p>
                    </div>
                    <!-- Booking From -->
                    <div class="col-md-5 offset-md-2">
                        <div class="booking-box">
                            <div class="head-box">
                                <h6>Rooms & Suites</h6>
                                <h4>Hotel Booking Form</h4>
                            </div>
                            <div class="booking-inner clearfix">
                                <form action="booking.php" class="form1 clearfix">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Entrada</label>
                                                <div class="input1_inner">
                                                    <input type="text" class="form-control input datepicker" placeholder="Entrada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Salida</label>
                                                <div class="input1_inner">
                                                    <input type="text" class="form-control input datepicker" placeholder="Salida">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="select1_wrapper">
                                                <label>Adultos</label>
                                                <div class="select1_inner">
                                                    <select class="select2 select" style="width: 100%">
                                                        <option value="0">Adultos</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="select1_wrapper">
                                                <label>Niños</label>
                                                <div class="select1_inner">
                                                    <select class="select2 select" style="width: 100%">
                                                        <option value="0">Niños</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn-form1-submit mt-15">Consultar disponibilidad</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        



<!-- INICIO DE FOOTER -->
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