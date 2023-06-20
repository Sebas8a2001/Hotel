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
<link rel="shortcut icon" href="img/favicon.png" />
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
    <!-- script jquery -->


</head>

<body id="page-1" itemscope="" itemtype="http://schema.org/WebPage">
<div id='alert' style='display: none'class="alert alert-danger" role="alert">
  This is a danger alert—check it out!
</div>

   <!-- Preloader -->
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
<!-- end Preloader -->


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
        
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"> <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Inicio</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link  dropdown-toggle" href="hotel" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Hotel</a></li>
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
                                <input type="hidden" name="formulario" id="formulario" value="index"/>
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

    
<!-- end nav -->

 <!-- Slider -->
 <header class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
            <div class="text-center item bg-img" data-overlay-dark="2" data-background="fotos/slides/slide1.jpg">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <span>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                </span>
                                <h4>Rápido, fácil y potente</h4>
                                <h1 style="font-size: 45px">Reserve sus vacaciones en <?php echo $con[0]['nomhotel']; ?></h1>
                                <div class="butn-light mt-30 mb-30"> <a href="#" data-scroll-nav="1"><span>Habitaciones</span></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center item bg-img" data-overlay-dark="2" data-background="fotos/slides/slide2.jpg">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <span>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                </span>
                                <h4>Garantía del mejor precio</h4>
                                <h1 style="font-size: 45px">Una estancia de sueño al mejor precio</h1>
                                <div class="butn-light mt-30 mb-30"> <a href="#" data-scroll-nav="1"><span>Habitaciones</span></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center item bg-img" data-overlay-dark="3" data-background="fotos/slides/slide3.jpg" >
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <span>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                    <i class="star-rating"></i>
                                </span>
                                <h4>Lo que gana el partido es el servicio</h4>
                                <h1 style="font-size: 45px">Estar a la altura en cuanto a precio y calidad  </h1>
                                <div class="butn-light mt-30 mb-30"> <a href="#" data-scroll-nav="1"><span>Rooms & Suites</span></a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider reservation -->
        <div class="reservation">
            <a href="tel:8551004444">
                <div class="icon d-flex justify-content-center align-items-center">
                    <i class="flaticon-call"></i>
                </div>
                <div class="call"><span>855 100 4444</span> <br>Reservation</div>
            </a>
        </div>
    </header>
<!-- end Slider -->








<!-- Booking Search -->
<div class="booking-wrapper">
            <div class="container">
                <div class="booking-inner clearfix">
                    <form  class="form1 clearfix">
                        <div class="col1 c1">
                            <div class="input1_wrapper">
                                <label>Check in</label>
                                <div class="input1_inner">
                                    <input id= "entrada" type="text" class="form-control input datepicker" placeholder="Entrada"  autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col1 c2">
                            <div class="input1_wrapper">
                                <label>Check out</label>
                                <div class="input1_inner">
                                    <input id="salida" type="text" class="form-control input datepicker" placeholder="Salida"autocomplete="off" >
                                </div>
                            </div>
                        </div>
                        <div class="col2 c3">
                            <div class="select1_wrapper">
                                <label>Adultos</label>
                                <div class="select1_inner">
                                    <select id='adultos' class="select2 select" style="width: 100%">
                                        <option value="0">Adultos</option>
                                        <option value="1">1 Adulto</option>
                                        <option value="2">2 Adultos</option>
                                        <option value="3">3 Adultos</option>
                                        <option value="4">4 Adultos</option>
                                        <option value="5">5 Adultos</option>
                                        <option value="6">6 Adultos</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col2 c4">
                            <div class="select1_wrapper">
                                <label>Niños</label>
                                <div class="select1_inner">
                                    <select id='ninos' class="select2 select" style="width: 100%">
                                        <option value="0">Niños</option>
                                        <option value="1">1 Niño</option>
                                        <option value="2">2 Niños</option>
                                        <option value="3">3 Niños</option>
                                        <option value="4">4 Niños</option>
                                        <option value="5">5 Niños</option>
                                        <option value="6">6 Niños</option>


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col2 c5">
                            <div class="select1_wrapper">
                                <label>Habitacion</label>
                                <div class="select1_inner">
                                    <select id='habitaciones'class="select2 select" style="width: 120%" required>
                                        <option value="0">Habitaciones</option>
                                        <option value="1">1 Habitacion</option>
                                        <option value="2">2 Habitaciones</option>
                                        <option value="3">3 Habitaciones</option>
                                        <option value="4">4 Habitaciones</option>
                                        <option value="5">5 Habitaciones</option>
                                        <option value="6">6 Habitaciones</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        

                        
                        <div class="col3 c5">
                        <a id="continuar-link" class="btn-form1-submit">Continuar</a>
                        </div>
                    </form>
                </div>
            </div>
    </div>
<!-- end Booking Search -->

 <!-- About -->
<?php
$perfil = new Login();
$reg = $perfil->ListarPerfilIndex();


?>
 
 <section class="about section-padding">
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
                    <div class="section-subtitle"><?php echo $con[0]['nomhotel']; ?></div>
                    <div class="section-title">Disfruta de una experiencia de lujo</div>
                   
                    <p><?php echo $reg[0]['descperfil'];?></p>
                    <!-- call -->
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:855-100-4444">855 100 4444</a>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp">
                    <img src="img/rooms/8.jpg" alt="" class="mt-90 mb-30">
                </div>
                <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp">
                    <img src="img/rooms/2.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
 <!-- About -->
 <?php  ?>
 <!-- Rooms -->
 <section class="rooms1 section-padding bg-darkblack" data-scroll-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="section-subtitle"><?php echo $con[0]['nomhotel']; ?></div>
                <div class="section-title">Habitaciones</div>
            </div>
        </div>
        <div class="row">
            <?php 
            $hab = new Login();
            $hab = $hab->ListarHabitacionesxTipos();
            
            
    
            for($i=0;$i<sizeof($hab);$i++){
              if (file_exists("fotos/habitaciones2/".$hab[$i]["codhabitacion"]."/1.JPG")){ 
                $comodidades = new Login();
                $comodidades = $comodidades->ListarComodidades($hab[$i]['nomtipo']);

               

                echo '<div class="col-md-4">
                <div class="item">
                <div class="position-re o-hidden"> <img src="fotos/habitaciones2/' . $hab[$i]["codhabitacion"] . '/1.JPG"></div><div class="con">
               
                
                <h5><a href="rooms.php?habitacion='.$hab[$i]['nomtipo'].' ">'.$hab[$i]['nomtipo'].'</a></h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-7">
                                <ul>';

                             
                                for($j=0;$j<sizeof($comodidades);$j++){
                                    
                                    echo '<li><i class="'.$comodidades[$j]['icono'].'"></i></li>';

                                }
                               
                                
                                   
                                echo '         </ul>
                            </div>
                            <div class="col col-md-5 text-end">
                                <div class="permalink"><a href="rooms.php?habitacion='.$hab[$i]['nomtipo'].' ">Details <i class="ti-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
              }else{
                echo '<div class="col-md-4">
                <div class="item">
                <div class="position-re o-hidden"> <img src="fotos/ninguna.png"></div> 
               <div class="con">
                <h5><a href="rooms.php?habitacion='.$hab[$i]['nomtipo'].' ">'.$hab[$i]['nomtipo'].'</a></h5>
                        <div class="line"></div>
                        <div class="row facilities">
                            <div class="col col-md-7">
                                <ul>';

                             
                                for($j=0;$j<sizeof($comodidades);$j++){
                                    
                                    echo '<li><i class="'.$comodidades[$j]['icono'].'"></i></li>';

                                }
                               
                                
                                   
                            echo '         </ul>
                            </div>
                            <div class="col col-md-5 text-end">
                                <div class="permalink"><a href="rooms.php?habitacion='.$hab[$i]['nomtipo'].' ">Details <i class="ti-arrow-right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

              }   
          
          }
             ?>
        </div>
    </div>
</section>


    <header class="navbar-fixed-top fixed" role="banner">
    <div id="mainHeader">
        <div class="container">
            <div id="mainMenu" class="collapse navbar-collapse">
              


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
                                <input type="hidden" name="formulario" id="formulario" value="index"/>
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
    </div>
</header>
<!-- Reservation & Booking Form -->
<section class="testimonials">
<?php
$perfil = new Login();
$reg = $perfil->ListarPerfil();

?>
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/1.jpg" data-overlay-dark="2">
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
                                <form class="form1 clearfix">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Entrada</label>
                                                <div class="input1_inner">
                                                    <input id='entradaTarjeta'type="text" class="form-control input datepicker" placeholder="Entrada" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Salida</label>
                                                <div class="input1_inner">
                                                    <input id='salidaTarjeta'type="text" class="form-control input datepicker" placeholder="Salida" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="select1_wrapper">
                                                <label>Adultos</label>
                                                <div class="select1_inner">
                                                    <select id='adultosTarjeta'class="select2 select" style="width: 100%">
                                                        <option value="0">Adultos</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="error-message" style="color: red; display: none;">¡Por favor, elija una opción!</p>

                                        <div class="col-md-6">
                                            <div class="select1_wrapper">
                                                <label>Niños</label>
                                                <div class="select1_inner">
                                                    <select id='ninosTarjeta'class="select2 select" style="width: 100%">
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
                                            <div class="select1_wrapper">
                                                <label>Habitaciones</label>
                                                <div class="select1_inner">
                                                    <select id='habitacionesTarjeta'class="select2 select" style="width: 100%">
                                                        <option value="0">habitaciones</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <button id='continuarLinkTarjeta'  class="btn-form1-submit mt-15">Consultar disponibilidad</button>
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
    <script>

const continuarLinkTarjeta= document.getElementById('continuarLinkTarjeta');
const continuarLink = document.getElementById('continuar-link');
let entradaTarjeta=document.getElementById('entradaTarjeta').value;
let ninosTarjeta=document.getElementById('ninosTarjeta').value 
let adultosTarjeta=  document.getElementById('adultosTarjeta').value 
let salidaTarjeta=  document.getElementById('salidaTarjeta').value 
let habitacionesTarjeta=document.getElementById('habitacionesTarjeta').value
const errorMessage = document.getElementById('error-message');



continuarLinkTarjeta.addEventListener('click', function(e) {
e.preventDefault(); 
continuarLinkTarjeta.setAttribute('href', 'booking.php' + '?adultos=' +adultosTarjeta
                                        + '&ninos='+ninosTarjeta
                                        +'&entrada='+entradaTarjeta
                                        +'&salida='+salidaTarjeta
                                        +'&habitaciones='+habitacionesTarjeta)
window.location.href = continuarLinkTarjeta.getAttribute('href');
});

continuarLink.addEventListener('click', function(e) {
alert= document.getElementById('alert')
    if(ninosTarjeta === '0'){
       alert.style.display="block"
}else{
    e.preventDefault(); // Evita la acción predeterminada del enlace
continuarLink.setAttribute('href','booking.php'+ '?adultos=' + document.getElementById('adultos').value 
                                                + '&ninos='+document.getElementById('ninos').value 
                                                +'&entrada='+document.getElementById('entrada').value 
                                                +'&salida='+document.getElementById('salida').value 
                                                +'&habitaciones='+document.getElementById('habitaciones').value);
        window.location.href = continuarLink.getAttribute('href');
}


    });
</script>
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
<script src="assets/js/jquery-3.6.3.min.js"></script>
<script src="jquery-migrate-3.0.0.min.js"></script>
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
