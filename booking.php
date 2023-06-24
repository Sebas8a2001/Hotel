<?php
require_once("class/class.php");
require_once("class/Disponibilidad.php");

$disponibilidad = new Disponibilidad();
$disponibilidad->hasta_r = isset($_GET['entrada']) ? $_GET['entrada'] : '';
$disponibilidad->desde_r = isset($_GET['salida']) ? $_GET['salida'] : '';
$disponibilidad->adultos = isset($_GET['adultos']) ? $_GET['adultos'] : '';
$disponibilidad->children = isset($_GET['ninos']) ? $_GET['ninos'] : '';
$disponibilidad->habitaciones = isset($_GET['habitaciones']) ? $_GET['habitaciones'] : '';

$con = new Login();
$con = $con->ConfiguracionPorId();

$tra = new Login();

if (isset($_POST["proceso"]) and $_POST["proceso"] == "login") {
    $log = $tra->Logueo();
    exit;
} elseif (isset($_POST["proceso"]) and $_POST["proceso"] == "recuperar") {
    $reg = $tra->RecuperarPassword();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Yoni Belito Sedano">
    <link rel="shortcut icon" href="img/favicon.png" />
    <title></title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Barlow&family=Barlow+Condensed&family=Gilda+Display&display=swap">
    <link rel="stylesheet" href="assets/hotel/css/plugins.css">
    <link rel="stylesheet" href="assets/hotel/css/style.css">
    <link rel="stylesheet" href="assets/hotel/css/edit.css">
</head>


<body>

    <!-- precargador -->
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
    <!-- fin precargador -->


    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <div class="logo-wrapper">
                <a class="logo" href="index.html"> <img src="img/logo.png" class="logo-img" alt=""> </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span
                    class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"> <a class="nav-link" href="index" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Inicio</a></li>
                    <li class="nav-item dropdown"> <a class=" nav-link dropdown-toggle" href="hotel" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Hotel</a></li>
                    <li class="nav-item dropdown"> <a id='hab' class="nav-link dropdown-toggle" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Habitaciones<i
                                class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php
                            $hab = new Login();
                            $hab = $hab->ListarHabitacionesxTipos();
                            for ($i = 0; $i < sizeof($hab); $i++) {
                                echo '<li><a href="rooms.php?habitacion=' . $hab[$i]['nomtipo'] . ' " class="dropdown-item"><span  style="font-size:12px">' . $hab[$i]['nomtipo'] . '</span></a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="gastronomy">Restaurante</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link active dropdown-toggle" href="booking"
                            role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">Reservaciones</a></li>
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="contact" role="button"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">Contacto</i></a>
                    <li class="nav-item dropdown">
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fin Barra de navegacion -->




    <!-- Banner de encabezado -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="2"
        data-background="img/slider/1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption mt-90">
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <h5>
                        <?php echo $con[0]['nomhotel']; ?>
                    </h5>
                    <h1>Habitaciones</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Banner de encabezado -->



    <!-- Habitaciones disponibles -->
    <?php
    if (empty($disponibilidad->hasta_r) || empty($disponibilidad->desde_r) || empty($disponibilidad->adultos) || empty($disponibilidad->children) || empty($disponibilidad->habitaciones)) {
    } else {
        echo '
          <section class="section-padding">
            <div class="container">
               <div class="row">
                <div class="col-md-12">';
        $habitaciones = $disponibilidad->BuscarHabitaciones();
        for ($i = 0; $i < sizeof($habitaciones); $i++) {
            $comodidades = new Login();
            $comodidades = $comodidades->ListarComodidades($habitaciones[$i][0]['nomtipo']);
            echo '
          <div class="rooms2 mb-90 animate-box" data-animate-effect="fadeInUp">
             <figure><img src="img/slider/' . rand(1, 4) . '.jpg" alt="" class="img-fluid"></figure>
                <div class="caption">
                   <h3>150$ <span>/ Night</span></h3>
                      <h4><a href="rooms.php?habitacion=' . $habitaciones[$i][0]['nomtipo'] . ' ">' . $habitaciones[$i][0]['nomtipo'] . '</a></h4>
                          <p>' . $habitaciones[$i][0]['descriphabitacion'] . '</p>
                             <div class="row room-facilities">';
            for ($j = 0; $j < sizeof($comodidades); $j++) {
                echo '<div class="col-md-4">
                                          <ul>
                                             <li><i class="' . $comodidades[$j]['icono'] . '"></i> ' . $comodidades[$j]['nombre'] . '</li>
                                         </ul>
                                       </div>';
            }
            echo '</div>
                            <hr class="border-2">
                               <div class="info-wrapper">
                                  <div class="more"><a href="rooms.php?habitacion=' . $habitaciones[$i][0]['nomtipo'] . '" class="link-btn" tabindex="0">Details <i class="ti-arrow-right"></i></a></div>
                                     <div class="butn-dark"> <a href="#" data-scroll-nav="1"><span>Book Now</span></a> </div>
                                 </div>
                              </div>
                          </div>';
        }
    }
    echo '</div>
               </div>
           </div>
       </section>';
    ?>
    <!-- Fin Habitaciones disponibles -->


    <!-- Reservacion -->
    <section class="testimonials">
        <?php
        $perfil = new Login();
        $reg = $perfil->ListarPerfil();
        ?>
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/1.jpg"
            data-overlay-dark="2">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 mb-30 mt-30">
                        <p><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i
                                class="star-rating"></i><i class="star-rating"></i></p>
                        <h5>
                            <?php echo $reg[13]['descperfil'] ?>
                        </h5>
                        <div class="reservations mb-30">
                            <div class="icon color-1"><span class="flaticon-call"></span></div>
                            <div class="text">
                                <p class="color-1">Reservation</p> <a class="color-1" href="tel:855-100-4444">855 100
                                    4444</a>
                            </div>
                        </div>
                        <p><i class="ti-check"></i><small>Call us, it's toll-free.</small></p>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="booking-box">
                            <div class="head-box">
                                <h6><?php echo $con[0]['nomhotel']; ?></h6>
                                <h4>Formulario de reserva</h4>
                            </div>
                            <div class="booking-inner clearfix">
                                <form class="form1 clearfix">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Entrada</label>
                                                <div class="input1_inner">
                                                    <input id='entradaTarjeta' type="text"
                                                        class="form-control input datepicker" placeholder="Entrada"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Salida</label>
                                                <div class="input1_inner">
                                                    <input id='salidaTarjeta' type="text"
                                                        class="form-control input datepicker" placeholder="Salida"
                                                        autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="select1_wrapper">
                                                <label>Adultos</label>
                                                <div class="select1_inner">
                                                    <select id='adultosTarjeta' class="select2 select"
                                                        style="width: 100%">
                                                        <option value="0">Adultos</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="error-message" style="color: red; display: none;">¡Por favor, elija una
                                            opción!</p>

                                        <div class="col-md-6">
                                            <div class="select1_wrapper">
                                                <label>Niños</label>
                                                <div class="select1_inner">
                                                    <select id='ninosTarjeta' class="select2 select"
                                                        style="width: 100%">
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
                                                    <select id='habitacionesTarjeta' class="select2 select"
                                                        style="width: 100%">
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
                                            <button id='continuar' class="btn-form1-submit mt-15">Consultar
                                                disponibilidad</button>
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
    <!-- Reservacion -->


    <!-- Pie de pagina -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-column footer-about">
                            <h3 class="footer-title">About Hotel</h3>
                            <p class="footer-about-text">Welcome to the best five-star deluxe hotel in New York. Hotel
                                elementum sesue the aucan vestibulum aliquam justo in sapien rutrum volutpat.</p>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-1">
                        <div class="footer-column footer-explore clearfix">
                            <h3 class="footer-title">Explore</h3>
                            <ul class="footer-explore-list list-unstyled">
                                <li><a href="index.php">Inicio</a></li>
                                <li><a href="hotel.php">Hotel</a></li>
                                <li><a href="gastronomy.php">Restaurante</a></li>
                                <li><a href="booking.php">Reservaciones</a></li>
                                <li><a href="contact.php">Contacto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-column footer-contact">
                            <h3 class="footer-title">Contact</h3>
                            <p class="footer-contact-text">1616 Broadway NY, New York 10001<br>United States of America
                            </p>
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
    <!-- Fin Pie de pagina -->


    <script>
        const continuarLinkTarjeta = document.getElementById('continuar');

        continuarLinkTarjeta.addEventListener('click', function (e) {
            e.preventDefault(); // Evita la acción predeterminada del enlace
            continuarLinkTarjeta.setAttribute('href', 'booking.php' + '?adultos=' + document.getElementById('adultosTarjeta').value
                + '&ninos=' + document.getElementById('ninosTarjeta').value
                + '&entrada=' + document.getElementById('entradaTarjeta').value
                + '&salida=' + document.getElementById('salidaTarjeta').value
                + '&habitaciones=' + document.getElementById('habitacionesTarjeta').value);
            window.location.href = continuarLinkTarjeta.getAttribute('href');
        });


    </script>


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