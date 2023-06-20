<?php 
if(isset($_SESSION['acceso'])) { 
  if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista" || $_SESSION["acceso"]=="cliente") {

$count = new Login();
$p = $count->ContarRegistros();
?>

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss +502 45118800 #64BBDB; azul #2cabe3 GRIS #313131-->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="fa fa-navicon"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="javascript:void(0)">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->

                    <?php if (file_exists("fotos/logo-admin.png")){
                        echo "<img src='fotos/logo-admin.png' width='160' height='40' alt='Logo Principal' class='dark-logo'>"; 
                                    } else {
                        echo "<img src='' width='160' height='40' alt='Logo Principal' class='dark-logo'>"; 
                                    } 
                    ?>
                           <!-- <img src="assets/images/logo.png" width="185" height="40" alt="Logo Principal" class="dark-logo">
                             Light Logo icon -->
                            <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="" alt="" class="dark-logo">
                             <!-- Light Logo text -->    
                             <img src="assets/images/logo-icon.png" class="light-logo" alt="homepage">
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="mdi mdi-dots-horizontal"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->

                <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                        <!-- ============================================================== -->
                        <!-- Iconos de Productos -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-cube font-24 text-info"></i>
                                <div class="notify">
                <span class="<?php if($p[0]['minimo']==0 && $p[0]['vencidos']==0) { } else { ?>heartbit<?php } ?>"></span>
                <span class="<?php if($p[0]['minimo']==0 && $p[0]['vencidos']==0) { } else { ?>point<?php } ?>"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title border-bottom">Notificaciones</div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-cube fa-2x text-info"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Productos Stock Minimo</h5> 
                                                    <span><?php echo $p[0]['minimo'] ?></span> 
                                                </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-calendar fa-2x text-success"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Productos Vencidos</h5> 
                                                    <span class="time"><?php echo $p[0]['vencidos'] ?></span> 
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Iconos de Productos -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Iconos de Creditos -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-credit-card font-24 text-success"></i>
                                <div class="notify">
                    <span class="<?php if($p[0]['creditoscomprasvencidos']==0 && $p[0]['creditosventasvencidos']==0) { } else { ?>heartbit<?php } ?>"></span>
                    <span class="<?php if($p[0]['creditoscomprasvencidos']==0 && $p[0]['creditosventasvencidos']==0) { } else { ?>point<?php } ?>"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title border-bottom">Créditos Vencidos</div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-cart fa-2x text-info"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Créditos en Compras</h5> 
                                                    <span class="time"><?php echo $p[0]['creditoscomprasvencidos'] ?></span> 
                                                </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-calendar-remove fa-2x text-success"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Créditos en Reservaciones</h5> 
                                                    <span class="mail-desc"><?php echo $p[0]['creditosreservacionesvencidos'] ?></span>
                                                </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-cart-plus fa-2x text-warning"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Créditos en Ventas</h5> 
                                                    <span class="mail-desc"><?php echo $p[0]['creditosventasvencidos'] ?></span>
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Iconos de Creditos -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Iconos de Reservaciones -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-calendar-multiple-check font-24 text-warning"></i>
                                <div class="notify">
                    <span class="<?php if($p[0]['creditoscomprasvencidos']==0 && $p[0]['creditosventasvencidos']==0) { } else { ?>heartbit<?php } ?>"></span>
                    <span class="<?php if($p[0]['creditoscomprasvencidos']==0 && $p[0]['creditosventasvencidos']==0) { } else { ?>point<?php } ?>"></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title border-bottom">Control de Reservaciones</div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-calendar-check fa-2x text-info"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Reservaciones Activas</h5> 
                                                    <span class="time"><?php echo $p[0]['activas'] ?></span> 
                                                </span>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-calendar-multiple fa-2x text-success"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Reservaciones Pendientes</h5> 
                                                    <span class="time"><?php echo $p[0]['pendientes'] ?></span> 
                                                </span>
                                            </a>
                                            <!-- Message 
                                            <a href="javascript:void(0)" class="message-item">
                                                <i class="mdi mdi-calendar-remove fa-2x text-warning"></i>
                                                <span class="mail-contnet">
                                                    <h5 class="message-title">Reservaciones Vencidas</h5> 
                                                    <span class="mail-desc"><?php echo $p[0]['vencidas'] ?></span>
                                                </span>
                                            </a>-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Iconos de Reservaciones -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Iconos de Reservaciones -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="chat" title="Chat Online"> <i class="mdi mdi-wechat font-24 text-danger"></i>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Iconos de Reservaciones -->
                        <!-- ============================================================== -->

                        <!-- Reloj start-->
                        <li class="nav-item dropdown mega-dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark hour text-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-xs"><span id="spanreloj"></span></span>
                        </a>
                        </li>
                        <!-- Reloj end -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> 
                            <form class="app-search d-none d-lg-block order-lg-2">
                                <input type="text" class="form-control" placeholder="Búsqueda...">
                                <a href="" class="active"><i class="fa fa-search"></i></a>
                            </form>
                        </li>

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle waves-effect waves-dark pro-pic d-flex mt-2 pr-0 leading-none simple" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") { 

                        if (isset($_SESSION['dni'])) {
                                if (file_exists("fotos/".$_SESSION['dni'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['dni'].".jpg?' width='40' height='40' class='rounded-circle'>"; 
                                } else {
                                    echo "<img src='fotos/avatar.jpg' width='40' height='40' class='rounded-circle'>"; 
                                } } else {
                                    echo "<img src='fotos/avatar.jpg' width='40' height='40' class='rounded-circle'>"; 
                                }

} else {

                        if (isset($_SESSION['dnicliente'])) {
                                if (file_exists("fotos/".$_SESSION['dnicliente'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['dnicliente'].".jpg?' width='40' height='40' class='rounded-circle'>"; 
                                } else {
                                    echo "<img src='fotos/cliente.jpg' width='40' height='40' class='rounded-circle'>"; 
                                } } else {
                                    echo "<img src='fotos/cliente.jpg' width='40' height='40' class='rounded-circle'>"; 
                                }
} ?>

                                    <span class="ml-2 d-lg-block">
        <h5 class="text-dark mb-0"><?php echo $_SESSION['nombres'] == '' ? $_SESSION['nomdoc'] : $_SESSION['nombres']; ?></h5>
                                        <small class="text-info mb-0"><?php echo estado($_SESSION['acceso']); ?></small>
                                    </span>
                           
                         </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class="">

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {

                                if (isset($_SESSION['dni'])) {
                                    if (file_exists("fotos/".$_SESSION['dni'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['dni'].".jpg?' class='rounded-circle' width='80'>"; 
                                    } else {
                                    echo "<img src='fotos/avatar.jpg' class='rounded-circle' width='80'>"; 
                                    } } else {
                                    echo "<img src='fotos/avatar.jpg' class='rounded-circle' width='80'>"; 
                                    }
    } else {

                        if (isset($_SESSION['dnicliente'])) {
                                if (file_exists("fotos/".$_SESSION['dnicliente'].".jpg")){
                                    echo "<img src='fotos/".$_SESSION['dnicliente'].".jpg?' width='40' height='40' class='rounded-circle'>"; 
                                } else {
                                    echo "<img src='fotos/cliente.jpg' class='rounded-circle' width='80'>"; 
                                } } else {
                                    echo "<img src='fotos/cliente.jpg' class='rounded-circle' width='80'>"; 
                                }
    } ?>
                                    

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") { ?>

                                </div>
                                    <div class="ml-2">
                                    <h5 class="mb-0"><abbr title="Nombres y Apellidos"><?php echo $_SESSION['nombres']; ?></abbr></h5>
                                     <p class="mb-0 text-muted"><abbr title="Correo Electrónico"><?php echo $_SESSION['email']; ?></abbr></p>
                                    <p class="mb-0 text-muted"><abbr title="Nº de Teléfono"><?php echo $_SESSION['telefono']; ?></abbr></p>
                                    </div>
                                </div>
<?php } else { ?>

                                </div>
                                     <div class="ml-2">
                                    <h5 class="mb-0"><abbr title="Nombres y Apellidos"><?php echo $_SESSION['nomcliente']; ?></abbr></h5>
                                    <p class="mb-0 text-muted"><abbr title="Correo Electrónico"><?php echo $_SESSION['correocliente']; ?></abbr></p>
                                    <p class="mb-0 text-muted"><abbr title="Nº de Teléfono"><?php echo $_SESSION['telefcliente']; ?></abbr></p>
                                    </div>
                                </div>
<?php } ?>
                                <a class="dropdown-item" href="perfil"><i class="fa fa-user"></i> Ver Perfil</a>
                                <a class="dropdown-item" href="password"><i class="fa fa-edit"></i> Actualizar Password</a>
                                <a class="dropdown-item" href="logout"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->



<?php 
switch($_SESSION['acceso'])  {

case 'administrador':  ?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">MENU</span></li>

                <li class="sidebar-item waves-effect active"><a href="panel" class="sidebar-link"><i class="mdi mdi-home"></i><span class="hide-menu"> Dashboard</span></a></li>

                <li class="sidebar-item waves-effect"><a href="pos" class="sidebar-link"><i class="mdi mdi-desktop-mac"></i><span class="hide-menu"> POS</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Administración</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Configuración</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="configuracion" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Configuración</span></a></li>

                                <li class="sidebar-item"><a href="categorias" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Categorias</span></a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="documentos" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Docum. Tributarios</a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="monedas" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Tipos de Moneda</a></li>
                                
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="cambios" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Tipos de Cambio</a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="medios" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Medios de Pagos</a></li>
                                
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="impuestos" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Impuestos</a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Perfil de Hotel</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="acerca" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Descripción</span></a></li>

                                <li class="sidebar-item"><a href="temporadas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Temporadas</span></a></li>

                                <li class="sidebar-item"><a href="noticias" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Noticias</span></a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Habitaciones</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="tipos" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Tipos de Habitación</a></li>

                                <li class="sidebar-item"><a href="tarifas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Tarifas de Habitación</span></a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="mensajes" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Mensajes</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Usuarios</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="usuarios" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Usuarios</span></a></li>

                                <li class="sidebar-item"><a href="logs" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Historial de Acceso</span></a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Base de Datos</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="backup" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Backup</span></a></li>

                                <li class="sidebar-item"><a href="restore" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Restore</span></a></li>

                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-multiple"></i><span class="hide-menu">Mantenimiento</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Habitaciones</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="forhabitacion" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Nueva Habitación</a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="habitaciones" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Consulta General</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="clientes" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Clientes</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="proveedores" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Proveedores</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Insumos</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="insumos" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Consulta General</span></a></li>

                                <li class="sidebar-item"><a href="salida_insumos" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Salida de Insumos</span></a></li>

                                <li class="sidebar-item"><a href="kardex_insumos" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Kardex de Insumos</span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Productos</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="forproducto" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Nuevo Producto</span></a></li>

                                <li class="sidebar-item"><a href="productos" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Consulta General</span></a></li>

                                <li class="sidebar-item"><a href="kardex_productos" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Kardex de Productos</span></a></li>

                                <li class="sidebar-item"><a href="productosvendidos" class="sidebar-link"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Productos Vendidos </span></a></li>

                                <li class="sidebar-item"><a href="productosxmoneda" class="sidebar-link"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Productos por Moneda </span></a></li>                                      
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Compras </span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"><a href="forcompra" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Nueva Compra </span></a></li>

                        <li class="sidebar-item"><a href="compras" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Consulta Compras </span></a></li>

                        <li class="sidebar-item"><a href="cuentasxpagar" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Cuentas por Pagar </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="comprasxproveedor" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Compras x Proveedor</span></a></li>

                                <li class="sidebar-item"><a href="comprasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Compras x Fechas</span></a></li>                                     
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-monitor-multiple"></i><span class="hide-menu">Cajas </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="cajas" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Control de Cajas</a></li>

                         <li class="sidebar-item"><a href="arqueos" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Arqueos de Caja </span></a></li>

                        <li class="sidebar-item"><a href="movimientos" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Movimientos en Caja </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="arqueosxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Arqueos x Fechas</span></a></li> 

                                <li class="sidebar-item"><a href="movimientosxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Movimientos x Fechas</span></a></li> 
                                    
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-calendar-multiple-check"></i><span class="hide-menu">Reservaciones</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="foreservacion" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Nueva Reservación</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="reservaciones" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Consulta General</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="reservacionesxcajas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Reservación x Cajas</span></a></li>  

                                <li class="sidebar-item"><a href="reservacionesxfechas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Reservación x Fechas</span></a></li> 

                                <li class="sidebar-item"><a href="reservacionesxclientes" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> <align> Reservación x Clientes</span></a></li> 

                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-plus"></i><span class="hide-menu">Ventas </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"><a href="forventa" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Nueva Venta </span></a></li>

                        <li class="sidebar-item"><a href="ventas" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Consulta General </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="ventasxcajas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Ventas x Cajas</span></a></li>

                                <li class="sidebar-item"><a href="ventasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Ventas x Fechas</span></a></li>

                                <li class="sidebar-item"><a href="gananciasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Ganancias x Fechas</span></a></li>                                    
                            </ul>
                        </li>
                    </ul>
                </li>

               <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card"></i><span class="hide-menu">Créditos </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"><a href="creditosxreservaciones" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Pago de Reservación</span></a></li>

                        <li class="sidebar-item"><a href="creditosxventas" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Pago de Ventas </span></a></li>

                        <li class="sidebar-item"><a href="creditosxclientes" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Créditos x Clientes </span></a></li>

                        <li class="sidebar-item"><a href="creditosxfechas" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Créditos x Fechas </span></a></li>

                    </ul>
                </li>

            <!--<li class="sidebar-item waves-effect"><a href="chat" class="sidebar-link"><i class="mdi mdi-wechat"></i><span class="hide-menu"> Chat</span></a></li>-->

            <li class="sidebar-item waves-effect"><a href="logout" class="sidebar-link"><i class="mdi mdi-power"></i><span class="hide-menu"> Cerrar Sesión</span></a></li>

        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->


<?php
break;
case 'secretaria': ?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">MENU</span></li>

                <li class="sidebar-item waves-effect active"><a href="panel" class="sidebar-link"><i class="mdi mdi-home"></i><span class="hide-menu"> Dashboard</span></a></li>

                <li class="sidebar-item waves-effect"><a href="pos" class="sidebar-link"><i class="mdi mdi-desktop-mac"></i><span class="hide-menu"> POS</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Administración</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Configuración</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="categorias" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Categorias</span></a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="documentos" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Docum. Tributarios</a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="monedas" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Tipos de Moneda</a></li>
                                
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="cambios" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Tipos de Cambio</a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="medios" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Medios de Pagos</a></li>
                                
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="impuestos" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Impuestos</a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Perfil de Hotel</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="acerca" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Descripción</span></a></li>

                                <li class="sidebar-item"><a href="temporadas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Temporadas</span></a></li>

                                <li class="sidebar-item"><a href="noticias" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Noticias</span></a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Habitaciones</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="tipos" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Tipos de Habitación</a></li>

                                <li class="sidebar-item"><a href="tarifas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Tarifas de Habitación</span></a></li>

                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="mensajes" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Mensajes</a></li>

                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-multiple"></i><span class="hide-menu">Mantenimiento</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Habitaciones</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="forhabitacion" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Nueva Habitación</a></li>

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="habitaciones" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Consulta General</a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="clientes" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Clientes</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="proveedores" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Proveedores</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Insumos</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="insumos" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Consulta General</span></a></li>

                                <li class="sidebar-item"><a href="salida_insumos" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Salida de Insumos</span></a></li>

                                <li class="sidebar-item"><a href="kardex_insumos" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Kardex de Insumos</span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Productos</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="forproducto" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Nuevo Producto</span></a></li>

                                <li class="sidebar-item"><a href="productos" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Consulta General</span></a></li>

                                <li class="sidebar-item"><a href="kardex_productos" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Kardex de Productos</span></a></li>

                                <li class="sidebar-item"><a href="productosvendidos" class="sidebar-link"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Productos Vendidos </span></a></li>

                                <li class="sidebar-item"><a href="productosxmoneda" class="sidebar-link"><i class="mdi mdi-cart-plus"></i><span class="hide-menu"> Productos por Moneda </span></a></li>                                      
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Compras </span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"><a href="forcompra" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Nueva Compra </span></a></li>

                        <li class="sidebar-item"><a href="compras" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Consulta Compras </span></a></li>

                        <li class="sidebar-item"><a href="cuentasxpagar" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Cuentas por Pagar </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="comprasxproveedor" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Compras x Proveedor</span></a></li>

                                <li class="sidebar-item"><a href="comprasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Compras x Fechas</span></a></li>                                     
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-monitor-multiple"></i><span class="hide-menu">Cajas </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="cajas" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Control de Cajas</a></li>

                         <li class="sidebar-item"><a href="arqueos" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Arqueos de Caja </span></a></li>

                        <li class="sidebar-item"><a href="movimientos" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Movimientos en Caja </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="arqueosxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Arqueos x Fechas</span></a></li> 

                                <li class="sidebar-item"><a href="movimientosxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Movimientos x Fechas</span></a></li> 
                                    
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-calendar-multiple-check"></i><span class="hide-menu">Reservaciones</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="foreservacion" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Nueva Reservación</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="reservaciones" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Consulta General</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="reservacionesxcajas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Reservación x Cajas</span></a></li>  

                                <li class="sidebar-item"><a href="reservacionesxfechas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Reservación x Fechas</span></a></li> 

                                <li class="sidebar-item"><a href="reservacionesxclientes" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> <align> Reservación x Clientes</span></a></li> 

                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-plus"></i><span class="hide-menu">Ventas </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"><a href="forventa" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Nueva Venta </span></a></li>

                        <li class="sidebar-item"><a href="ventas" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Consulta General </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="ventasxcajas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Ventas x Cajas</span></a></li>

                                <li class="sidebar-item"><a href="ventasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Ventas x Fechas</span></a></li>

                                <li class="sidebar-item"><a href="gananciasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Ganancias x Fechas</span></a></li>                                    
                            </ul>
                        </li>
                    </ul>
                </li>

               <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card"></i><span class="hide-menu">Créditos </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"><a href="creditosxreservaciones" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Pago de Reservación</span></a></li>

                        <li class="sidebar-item"><a href="creditosxventas" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Pago de Ventas </span></a></li>

                        <li class="sidebar-item"><a href="creditosxclientes" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Créditos x Clientes </span></a></li>

                        <li class="sidebar-item"><a href="creditosxfechas" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Créditos x Fechas </span></a></li>

                    </ul>
                </li>

            <!--<li class="sidebar-item waves-effect"><a href="chat" class="sidebar-link"><i class="mdi mdi-wechat"></i><span class="hide-menu"> Chat</span></a></li>-->

            <li class="sidebar-item waves-effect"><a href="logout" class="sidebar-link"><i class="mdi mdi-power"></i><span class="hide-menu"> Cerrar Sesión</span></a></li>

        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->


<?php
break;
case 'recepcionista': ?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">MENU</span></li>

                <li class="sidebar-item waves-effect active"><a href="panel" class="sidebar-link"><i class="mdi mdi-home"></i><span class="hide-menu"> Dashboard</span></a></li>

                <li class="sidebar-item waves-effect"><a href="pos" class="sidebar-link"><i class="mdi mdi-desktop-mac"></i><span class="hide-menu"> POS</span></a></li>

                <li class="sidebar-item waves-effect"><a href="productos" class="sidebar-link"><i class="mdi mdi-cube"></i><span class="hide-menu"> Productos</span></a></li>

                <li class="sidebar-item waves-effect"><a href="habitaciones" class="sidebar-link"><i class="mdi mdi-hotel"></i><span class="hide-menu"> Habitaciones</span></a></li>

                <li class="sidebar-item waves-effect"><a href="clientes" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> Clientes</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-monitor-multiple"></i><span class="hide-menu">Cajas</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                         <li class="sidebar-item"><a href="arqueos" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Arqueos de Caja </span></a></li>

                        <li class="sidebar-item"><a href="movimientos" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Movimientos en Caja </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="arqueosxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Arqueos x Fechas</span></a></li> 

                                <li class="sidebar-item"><a href="movimientosxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Movimientos x Fechas</span></a></li> 
                                    
                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-calendar-multiple-check"></i><span class="hide-menu">Reservaciones</span></a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="foreservacion" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Nueva Reservación</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="reservaciones" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i>Consulta General</a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="reservacionesxcajas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Reservación x Cajas</span></a></li>  

                                <li class="sidebar-item"><a href="reservacionesxfechas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Reservación x Fechas</span></a></li> 

                                <li class="sidebar-item"><a href="reservacionesxclientes" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> <align> Reservación x Clientes</span></a></li> 

                            </ul>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-plus"></i><span class="hide-menu">Ventas </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"><a href="forventa" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Nueva Venta </span></a></li>

                        <li class="sidebar-item"><a href="ventas" class="sidebar-link"><i class="mdi mdi-cart"></i><span class="hide-menu"> Consulta General </span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Reportes</span></a>
                            <ul aria-expanded="false" class="collapse second-level">

                                <li class="sidebar-item"><a href="ventasxcajas" class="sidebar-link"><i class="mdi mdi-priority-low"></i><span class="hide-menu"> Ventas x Cajas</span></a></li>

                                <li class="sidebar-item"><a href="ventasxfechas" class="sidebar-link"><i class="mdi mdi-rounded-corner"></i><span class="hide-menu"> Ventas x Fechas</span></a></li>                                    
                            </ul>
                        </li>
                    </ul>
                </li>

               <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card"></i><span class="hide-menu">Créditos </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item"><a href="creditosxreservaciones" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Pago de Reservación</span></a></li>

                        <li class="sidebar-item"><a href="creditosxventas" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Pago de Ventas </span></a></li>

                        <li class="sidebar-item"><a href="creditosxclientes" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Créditos x Clientes </span></a></li>

                        <li class="sidebar-item"><a href="creditosxfechas" class="sidebar-link"><i class="mdi mdi-cards-variant"></i><span class="hide-menu"> Créditos x Fechas </span></a></li>

                    </ul>
                </li>

            <!--<li class="sidebar-item waves-effect"><a href="chat" class="sidebar-link"><i class="mdi mdi-wechat"></i><span class="hide-menu"> Chat</span></a></li>-->

            <li class="sidebar-item waves-effect"><a href="logout" class="sidebar-link"><i class="mdi mdi-power"></i><span class="hide-menu"> Cerrar Sesión</span></a></li>

        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

            
<?php
break;
case 'cliente': ?>

<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">MENU</span></li>

                <li class="sidebar-item waves-effect active"><a href="panel" class="sidebar-link"><i class="mdi mdi-lan-pending"></i><span class="hide-menu"> Mis Reservaciones</span></a></li>

                <li class="sidebar-item waves-effect"><a href="temporadas" class="sidebar-link"><i class="mdi mdi-calendar-multiple"></i><span class="hide-menu"> Control de Temporadas</span></a></li>

                <li class="sidebar-item waves-effect"><a href="productos" class="sidebar-link"><i class="mdi mdi-cube"></i><span class="hide-menu"> Control de Productos</span></a></li>

                <li class="sidebar-item waves-effect"><a href="habitaciones" class="sidebar-link"><i class="mdi mdi-hotel"></i><span class="hide-menu"> Control de Habitaciones</span></a></li>

                <li class="sidebar-item waves-effect"><a href="chat" class="sidebar-link"><i class="mdi mdi-wechat"></i><span class="hide-menu"> Chat</span></a></li>

                <li class="sidebar-item waves-effect"><a href="logout" class="sidebar-link"><i class="mdi mdi-power"></i><span class="hide-menu"> Cerrar Sesión</span></a></li>

        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->


<?php
break; } ?>



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