<?php
require_once("class/class.php");

$footer = new Login();
$footer = $footer->ConfiguracionPorId();
?>
    <footer>
      <section id="mainFooter">
        <div class="container" id="footer">
          <div class="row">
            <div class="widget-footer">

             <div id="widget-1" class="widget">
               <div class="widget-title">Acerca de nosotros</div>
               <div class="widget-content"><p style="text-align: justify;"><?php echo $footer[0]['acerca']; ?></p>

                <div id="searchWrapper" class="pull-left">
                  <form method="post" action="#" role="form" class="form-inline">
                    <input class="form-control" name="global-search" placeholder="Búsqueda" type="text">
                    <input name="csrf_token" type="hidden">
                    <button type="submit" class="btn btn-primary" name="send"><i class="fa fa-search"></i></button>
                  </form>
                </div>
              </div>
            </div>

            <div id="widget-2" class="widget">
              <div class="widget-title">Métodos de Pago</div>
              <div class="widget-content"><p style="text-align: justify;"><?php echo $footer[0]['metodopago']; ?></p>
                <ul class="nostyle">

                  <li>
                    <a href="#" title="Tarjeta de Crédito American Express" class="xs pull-left tips">
                      <img src="assets/hotel/img/american.png" alt="">                     
                    </a>              
                  </li>

                  <li>
                    <a href="#" title="Tarjeta de Crédito Visa" class="xs pull-left tips">
                      <img src="assets/hotel/img/visa.png" alt="">
                    </a>
                  </li>

                  <li>
                    <a href="#" title="Tarjeta de Crédito MasterCard" class="xs pull-left tips">
                      <img src="assets/hotel/img/mastercard.png" alt="">
                    </a>
                  </li>

                  <li>
                    <a href="#" title="Tarjeta de Crédito Diners Club" class="xs pull-left tips">
                      <img src="assets/hotel/img/diner.png" alt="">
                    </a>
                  </li>
                </ul>
              </div>
            </div>


            <div id="widget-3" class="widget"><div itemscope="" itemtype="http://schema.org/Corporation">
              <h3 itemprop="name">Información sobre nosotros</h3>
              <address>
                <p>
                 <i class="fa fa-map-marker"></i> <span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress"><?php echo $footer[0]['direchotel']; ?></span><br>       <i class="fa fa-phone"></i> <span itemprop="telephone" dir="ltr">+<?php echo $footer[0]['tlfhotel']; ?></span><br>            
                 <i class="fa fa-envelope"></i> <a itemprop="email" dir="ltr" href="mailto:<?php echo strtolower($footer[0]['emailhotel']); ?>"><?php echo $footer[0]['emailhotel']; ?></a><br>
                 <?php switch($footer[0]['categoriahotel']){ case 1: ?>
                   <i class="fa fa-star"></i>
                   <?php
                   break;
                   case 2:
                   ?>
                   <i class="fa fa-star"></i><i class="fa fa-star"></i>
                   <?php
                   break;
                   case 3:
                   ?>
                   <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                   <?php
                   break;
                   case 4:
                   ?>
                   <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                   <?php
                   break;
                   case 5:
                   ?>
                   <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                   <?php
                   break;  
                 } ?>        
               </p>
             </address></div>
             <p class="lead">
              <a href="https://www.facebook.com/" target="_blank">
                <i class="fa fa-facebook"></i>
              </a>
              <a href="https://twitter.com/" target="_blank">
                <i class="fa fa-twitter"></i>
              </a>
              <a href="https://www.instagram.com/" target="_blank">
                <i class="fa fa-instagram"></i>
              </a>
            </p>
          </div>
        </div>            
      </div>
    </div>
  </section>
  
  <div id="footerRights">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>  <i class="fa fa-copyright"></i> <span class="current-year"></span>  </p>
        </div>
        <div class="col-md-6">
          <p class="text-right">
            <a href="#" target="_blank" class="tips" title="RSS feed"><i class="fa fa-rss"></i></a>
            <a href="contact" class="tips" title="Contacto">Contacto</a>
            &nbsp;&nbsp;
            <!--<a href="news" class="tips" title="Noticias">Noticias</a>
            &nbsp;&nbsp;-->
            <a href="sitemap" class="tips" title="Mapa del Sitio">Mapa del Sitio</a>
            &nbsp;&nbsp;                  
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<a href="#" id="toTop" style="bottom: 30px;"><i class="fa-angle-up"></i></a>
