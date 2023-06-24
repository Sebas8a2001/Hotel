<?php
require_once("class/class.php");

$tra = new Login();
$con = new Login();
$con = $con->ConfiguracionPorId();

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
          <li class="nav-item dropdown"> <a class="nav-link " href="index" role="button" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" aria-expanded="false">Inicio</a></li>
          <li class="nav-item dropdown"> <a class=" nav-link dropdown-toggle" href="hotel" role="button"
              data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Hotel</a></li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
              data-bs-auto-close="outside" aria-expanded="false">Habitaciones<i class="ti-angle-down"></i></a>
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
          <li class="nav-item"><a class="nav-link active  " href="gastronomy">Restaurante</a></li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="booking" role="button"
              data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Reservaciones</a></li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="contact" role="button"
              data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Contacto</i></a>
          <li class="nav-item dropdown">
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Fin Barra de navegacion -->


  <!-- Deslizador imagenes aleatorias -->
  <header class="header slider">
    <div class="owl-carousel owl-theme">
    <?php
            $rutaSliders = "img/restaurant/";
            $sliders = scandir($rutaSliders);
            $cantidadSliders = count($sliders) - 2;
            for ($i = 0; $i < $cantidadSliders; $i++) {
                echo '
                <div class="text-center item bg-img" data-overlay-dark="3" data-background="img/restaurant/'.($i + 1) .'.jpg"></div>
                ';
            }
            ?>
    </div>
    <div class="arrow bounce text-center">
      <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
  </header>
  <!-- Fin Deslizador imagenes aleatorias -->


  <!-- Descripcion -->
  <?php
  $perfil = new Login();
  $reg = $perfil->ListarPerfilR();
  $categorias = $perfil->ListarCategoriasCarta();
  if ($reg == "") {
    echo "";
  } else {
    ?>
    <section id="page">
      <section class="rooms-page section-padding" data-scroll-index="1">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-left">
              <span>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
              </span>
              <div class="section-subtitle">Una experiencia para los sentidos</div>
              <div class="section-title">
                <?php echo $reg[0]['nombre']; ?>
              </div>
            </div>
            <div style="margin-top:20px" class="container">
              <section class="col-sm-12">
                <p style="text-align: justify;">
                  <?php echo $reg[0]['descripcion']; ?>
                </p>
              </section>
            <?php } ?>
          </div>
        </div>
    </section>
    <!-- Descripcion -->

    <!--Menu -->
    <section id="menu" class="restaurant-menu menu section-padding bg-darkblack">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="section-subtitle"><span>
                <?php echo $con[0]['nomhotel']; ?>
              </span></div>
            <div class="section-title"><span>Menu</span></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="tabs-icon col-md-10 offset-md-1 text-center">
                <div class="owl-carousel owl-theme">
                  <?php
                  $categorias = new Login();
                  $categorias = $categorias->ListarCategoriasCarta();
                  for ($i = 0; $i < sizeof($categorias); $i++) {
                    if ($i == 0) {
                      echo '<div id="tab-' . ($i + 1) . '" class="active item">
                                  <h6>' . $categorias[$i]["nombre"] . '</h6>
                                  </div>';
                    } else {
                      echo '<div id="tab-' . ($i + 1) . '" class="item">
                                  <h6>' . $categorias[$i]["nombre"] . '</h6>
                                  </div>';
                    }
                  }
                  ?>
                </div>
              </div>
              <div class="restaurant-menu-content col-md-12">
                <?php
                $productos = new Login();
                $productos = $productos->ListarProductosCarta();
                for ($i = 0; $i < sizeof($categorias); $i++) {
                  if ($i == 0) {
                    echo '<div id="tab-' . ($i + 1) . '-content" class="cont active">
                                  <div class="row">
                                  <div class="col-md-5">';
                  } else {
                    echo '<div id="tab-' . ($i + 1) . '-content" class="cont">
                                  <div class="row">
                                  <div class="col-md-5">';
                  }
                  $productoCategoria = array();
                  for ($j = 0; $j < sizeof($productos); $j++) {
                    if ($productos[$j]['carta_categoria_id'] == ($i + 1)) {
                      array_push($productoCategoria, $productos[$j]);
                    }
                  }
                  if (count($productoCategoria) % 2 == 0) {
                    $mitad = count($productoCategoria) / 2;
                    $primerMitad = array_slice($productoCategoria, 0, $mitad);
                    $segundaMitad = array_slice($productoCategoria, $mitad);
                  } else {
                    $cantidadElementos = count($productoCategoria);
                    $tamanoMitad = ceil($cantidadElementos / 2);
                    $primerMitad = array_slice($productoCategoria, 0, $tamanoMitad);
                    $segundaMitad = array_slice($productoCategoria, $tamanoMitad);
                  }
                  for ($k = 0; $k < sizeof($primerMitad); $k++) {
                    echo ' <div class="menu-info">
                                      <h5>' . $primerMitad[$k]['nombre'] . '<span class="price">$' . $primerMitad[$k]["precio"] . '</span></h5>
                                      <p>' . $primerMitad[$k]['descripcion'] . '</p>
                                      </div>';
                  }
                  echo '</div>
                                    <div class="col-md-5 offset-md-2">';
                  for ($j = 0; $j < sizeof($segundaMitad); $j++) {
                    echo ' <div class="menu-info">
                                        <h5>' . $segundaMitad[$j]['nombre'] . '<span class="price">$' . $segundaMitad[$j]["precio"] . '</span></h5>
                                        <p>' . $segundaMitad[$j]['descripcion'] . '</p>
                                        </div>';
                  }
                  echo ' </div>
                       </div>
                  </div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Fin Menu -->

    
    <!-- Pie de pagina -->
    <footer class="footer">
     <div class="footer-top">
       <div class="container">
         <div class="row">
           <div class="col-md-4">
             <div class="footer-column footer-about">
              <h3 class="footer-title">About Hotel</h3>
              <p class="footer-about-text">Welcome to the best five-star deluxe hotel in New York. Hotel elementum sesue
                the aucan vestibulum aliquam justo in sapien rutrum volutpat.</p>
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
  <!-- Fin Pie de pagina -->

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