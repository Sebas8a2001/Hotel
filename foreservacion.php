<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
  if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista"){

$fngccvalidator = new fngccvalidator();

$tra = new Login();
$ses = $tra->ExpiraSession(); 

$imp = new Login();
$imp = $imp->ImpuestosPorId();
$impuesto = ($imp == "" ? "Impuesto" : $imp[0]['nomimpuesto']);
$valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = ($con == "" ? "" : "<strong>".$con[0]['simbolo']."</strong>");

$arqueo = new Login();
$arqueo = $arqueo->ArqueoCajaPorUsuario();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarReservaciones();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarReservaciones();
exit;
}   
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="nuevocliente")
{
$reg = $tra->RegistrarClientes();
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
    <!-- Sweet-Alert -->
    <link rel="stylesheet" href="assets/css/sweetalert.css">
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

<body onLoad="muestraReloj(); getTime();" class="fix-header">
    
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
          
 
<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-align-justify"></i> Detalle de Habitación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
            </div>
            <div class="modal-body">

                <div id="muestrahabitacionmodal"></div> 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--############################## MODAL PARA REGISTRO DE NUEVO CLIENTE ######################################-->
<!-- sample modal content -->
<div id="myModalCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-save"></i> Gestión de Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
            </div>
            
        <form class="form form-material" method="post" action="#" name="clientereservacion" id="clientereservacion">                
        <div class="modal-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Tipo de Documento: </label>
                    <i class="fa fa-bars form-control-feedback"></i> 
                    <select style="color:#000;font-weight:bold;" name="documcliente" id="documcliente" class='form-control' required="" aria-required="true">
                    <option value="0"> -- SELECCIONE -- </option>
                    <?php
                    $doc = new Login();
                    $doc = $doc->ListarDocumentos();
                    if($doc==""){ 
                         echo "";
                    } else {
                    for($i=0;$i<sizeof($doc);$i++){ ?>
                    <option value="<?php echo $doc[$i]['coddocumento'] ?>"><?php echo $doc[$i]['documento'] ?></option>
                    <?php } } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label class="control-label">Nº de Documento: </label>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button id="buscar" type="button" class="btn btn-success waves-effect waves-light" data-placement="left" title="Buscar Cliente" data-original-title="" data-href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="fa fa-search"></i></button>
                    </div>
                    <input type="hidden" name="proceso" id="proceso" value="save"/>
                    <input type="hidden" name="codcliente" id="codcliente">
                    <input type="text" class="form-control" name="dnicliente" id="dnicliente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Documento" autocomplete="off" required="" aria-required="true"/> 
                    <i class="fa fa-search form-control-feedback"></i> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Nombre de Cliente: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="nomcliente" id="nomcliente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Cliente" autocomplete="off" required="" aria-required="true"/>  
                    <i class="fa fa-pencil form-control-feedback"></i> 
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Nº de Teléfono: <span class="symbol required"></span></label>
                    <input type="text" class="form-control phone-inputmask" name="telefcliente" id="telefcliente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Teléfono" autocomplete="off" required="" aria-required="true"/>  
                    <i class="fa fa-phone form-control-feedback"></i> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Correo de Cliente: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="correocliente" id="correocliente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Correo Electronico" autocomplete="off" required="" aria-required="true"/> 
                    <i class="fa fa-envelope-o form-control-feedback"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Limite de Crédito: <span class="symbol required"></span></label>
                    <input type="text" class="form-control" name="limitecredito" id="limitecredito" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" placeholder="Ingrese Limite de Crédito" autocomplete="off" required="" aria-required="true"/>  
                    <i class="fa fa-usd form-control-feedback"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group has-feedback">
                    <label class="control-label">Pais: <span class="symbol required"></span></label>
                    <i class="fa fa-bars form-control-feedback"></i>
                    <select style="color:#000;font-weight:bold;" name="paiscliente" id="paiscliente" class='form-control' required="" aria-required="true">
                       <option value=""> -- SELECCIONE -- </option> 
                       <option value="AF">AFGANISTAN</option>
                       <option value="AL">ALBANIA</option>
                       <option value="DE">ALEMANIA</option>
                       <option value="AD">ANDORRA</option>
                       <option value="AO">ANGOLA</option>
                       <option value="AI">ANGUILLA</option>
                       <option value="AQ">ANTARTIDA</option>
                       <option value="AG">ANTIGUA Y BARBUDA</option>
                       <option value="AN">ANTILLAS HOLANDESAS</option>
                       <option value="SA">ARABAIA SAUDI</option>
                       <option value="DZ">ARGELIA</option>
                       <option value="AR">ARGENTINA</option>
                       <option value="AM">ARMENIA</option>
                       <option value="AW">ArRUBA</option>
                       <option value="AU">AUSTRALIA</option>
                       <option value="AT">AUSTRIA</option>
                       <option value="AZ">AZERBAIYAN</option>
                       <option value="BS">BAHAMAS</option>
                       <option value="BH">BAHREIN</option>
                       <option value="BD">BANGLADESH</option>
                       <option value="BB">BARBADOS</option>
                       <option value="BE">BELGICA</option>
                       <option value="BZ">BELICE</option>
                       <option value="BJ">BENIN</option>
                       <option value="BM">BERMUDAS</option>
                       <option value="BY">BIELORRUSIA</option>
                       <option value="MM">BIRMANIA</option>
                       <option value="BO">BOLIVIA</option>
                       <option value="BA">BOSNIA Y HERZEGOVINA</option>
                       <option value="BW">BOTSWANA</option>
                       <option value="BR">BRASIL</option>
                       <option value="BN">BRUNEI</option>
                       <option value="BG">BULGARIA</option>
                       <option value="BF">BURKINA FASO</option>
                       <option value="BI">BURUNDI</option>
                       <option value="BT">BUTAN</option>
                       <option value="CV">CABO VERDE</option>
                       <option value="KH">CAMBOYA</option>
                       <option value="CM">CAMERUN</option>
                       <option value="CA">CANADA</option>
                       <option value="TD">CHAD</option>
                       <option value="CL">CHILE</option>
                       <option value="CN">CHINA</option>
                       <option value="CY">CHIPRE</option>
                       <option value="VA">CIUDAD DEL VATICANO (SANTA SEDE)</option>
                       <option value="CO">COLOMBIA</option>
                       <option value="KM">COMORES</option>
                       <option value="CG">CONGO</option>
                       <option value="CD">REPUBLICA DEMOCRATICA DEL CONGO</option>
                       <option value="KR">COREA</option>
                       <option value="KP">COREA DEL NORTE</option>
                       <option value="CI">COSTA DE MARFIL</option>
                       <option value="CR">COSTA RICA</option>
                       <option value="HR">CROACIA</option>
                       <option value="CU">CUBA</option>
                       <option value="DK">DINAMARCA</option>
                       <option value="DJ">DJIBOUTI</option>
                       <option value="DM">DOMINICA</option>
                       <option value="EC">ECUADOR</option>
                       <option value="EG">EGIPTO</option>
                       <option value="SV">EL SALVADOR</option>
                       <option value="AE">EMIRATOS ARABES UNIDOS</option>
                       <option value="ER">ERITREA</option>
                       <option value="SI">ESLOVENIA</option>
                       <option value="ES">ESPAÑA</option>
                       <option value="US">ESTADOS UNIDOS</option>
                       <option value="EE">ESTONIA</option>
                       <option value="ET">ETIOPIA</option>
                       <option value="FJ">FIJI</option>
                       <option value="PH">FILIPINAS</option>
                       <option value="FI">FINLANDIA</option>
                       <option value="FR">FRANCIA</option>
                       <option value="GA">GABON</option>
                       <option value="GM">GAMBIA</option>
                       <option value="GE">GEORGIA</option>
                       <option value="GH">GHANA</option>
                       <option value="GI">GIBRALTAR</option>
                       <option value="GD">GRANADA</option>
                       <option value="GR">GRECIA</option>
                       <option value="GL">GROENLANDIA</option>
                       <option value="GP">GUADALUPE</option>
                       <option value="GU">GUAM</option>
                       <option value="GT">GUATEMALA</option>
                       <option value="GY">GUAYANA</option>
                       <option value="GF">GUAYANA FRANCESA</option>
                       <option value="GN">GUINEA</option>
                       <option value="GQ">GUINEA ECUATORIAL</option>
                       <option value="GW">GUINEA-BISSAU</option>
                       <option value="HT">HAITI</option>
                       <option value="HN">HONDURAS</option>
                       <option value="HU">HUNGRIA</option>
                       <option value="IN">INDIA</option>
                       <option value="ID">INDONSEIA</option>
                       <option value="IQ">IRAK</option>
                       <option value="IR">IRAN</option>
                       <option value="IE">IRLANDA</option>
                       <option value="BV">ISLA Bouvet</option>
                       <option value="CX">ISLA DE CHRISTMAS</option>
                       <option value="IS">ISLANDIA</option>
                       <option value="KY">ISLAS CAIMAN</option>
                       <option value="CK">ISLAS COOK</option>
                       <option value="CC">ISLAS DE COCOS O KEELING</option>
                       <option value="FO">ISLAS FAROE</option>
                       <option value="HM">ISLAS HEARD Y MCDONALD</option>
                       <option value="FK">ISLAS MALVINAS</option>
                       <option value="MP">ISLAS MARIANAS DEL NORTE</option>
                       <option value="MH">ISLAS Marshall</option>
                       <option value="UM">ISLAS MENORES DE EE.UU.</option>
                       <option value="PW">ISLAS PALAU</option>
                       <option value="SB">ISLAS SALOMON</option>
                       <option value="SJ">ISLAS SVALBARD Y JAN MAYEN</option>
                       <option value="TK">ISLAS TOKELAU</option>
                       <option value="TC">ISLAS TURKS Y CAICOS</option>
                       <option value="VI">ISLAS VIRGENES (EE.UU.)</option>
                       <option value="VG">ISLAS VIRGENES (REINO UNIDO)</option>
                       <option value="WF">ISLAS WALLSI Y FUTUNA</option>
                       <option value="IL">ISRAEL</option>
                       <option value="IT">ITALIA</option>
                       <option value="JM">JAMAICA</option>
                       <option value="JP">JAPON</option>
                       <option value="JO">JORDANIA</option>
                       <option value="KZ">KAZAJISTAN</option>
                       <option value="KE">KENIA</option>
                       <option value="KG">KIRGUIZISTAN</option>
                       <option value="KI">KIRIBATI</option>
                       <option value="KW">KUWAIT</option>
                       <option value="LA">LAOS</option>
                       <option value="LS">LESOTHO</option>
                       <option value="LV">LETONIA</option>
                       <option value="LB">LIBANO</option>
                       <option value="LR">LIBERIA</option>
                       <option value="LY">LIBIA</option>
                       <option value="LI">LIECHTENSTEIN</option>
                       <option value="LT">LITUANIA</option>
                       <option value="LU">LUXEMBURGO</option>
                       <option value="MK">EX REPUBLICA YUGOSLAVA DE MACEDONIA</option>
                       <option value="MG">MADAGASCAR</option>
                       <option value="MY">MALASIA</option>
                       <option value="MW">MALAWI</option>
                       <option value="MV">MALDIVAS</option>
                       <option value="ML">MALI</option>
                       <option value="MT">MALTA</option>
                       <option value="MA">MARRUECOS</option>
                       <option value="MQ">MARTINICA</option>
                       <option value="MU">MAURICIO</option>
                       <option value="MR">MAURITANIA</option>
                       <option value="YT">MAYOTTE</option>
                       <option value="MX">MEXICO</option>
                       <option value="FM">MICRONESIA</option>
                       <option value="MD">MOLDAVIA</option>
                       <option value="MC">MONACO</option>
                       <option value="MN">MONGOLIA</option>
                       <option value="MS">MONTSERRAT</option>
                       <option value="MZ">MOZAMBIQUE</option>
                       <option value="NA">NAMIBIA</option>
                       <option value="NR">NAURU</option>
                       <option value="NP">NEPAL</option>
                       <option value="NI">NICARAGUA</option>
                       <option value="NE">NIGER</option>
                       <option value="NG">NIGERIA</option>
                       <option value="NU">NIUE</option>
                       <option value="NF">NORFOLK</option>
                       <option value="NO">NORUEGA</option>
                       <option value="NC">NUEVA CALEDONIA</option>
                       <option value="NZ">NUEVA ZELANDA</option>
                       <option value="OM">OMAN</option>
                       <option value="NL">PAISES BAJOS</option>
                       <option value="PA">PANAMA</option>
                       <option value="PG">PAPUA NUEVA GUINEA</option>
                       <option value="PK">PAQUISTAN</option>
                       <option value="PY">PARAGUAY</option>
                       <option value="PE">PERU</option>
                       <option value="PN">PITCAIRN</option>
                       <option value="PF">POLINESIA FRANCESA</option>
                       <option value="PL">POLONIA</option>
                       <option value="PT">PORTUGAL</option>
                       <option value="PR">PUERTO RICO</option>
                       <option value="QA">QATAR</option>
                       <option value="UK">REINI UNIDO</option>
                       <option value="CF">REPUBLICA CENTROAFRICANA</option>
                       <option value="CZ">REPUBLICA CHECA</option>
                       <option value="ZA">REPUBLICA DE SUDAFRICA</option>
                       <option value="DO">REPUBLICA DMINICANA</option>
                       <option value="SK">REPUBLICA ESLOVACA</option>
                       <option value="RE">REUNION</option>
                       <option value="RW">RUANDA</option>
                       <option value="RO">RUMANIA</option>
                       <option value="RU">RUSIA</option>
                       <option value="EH">SAHARA OCCIDENTAL</option>
                       <option value="KN">SAINT KITTS Y NEVIS</option>
                       <option value="WS">SAMOA</option>
                       <option value="AS">SAMOA AMERICANA</option>
                       <option value="SM">SAN MARINO</option>
                       <option value="VC">SAN VICENTE Y GRANADINAS</option>
                       <option value="SH">SANTA HELENA</option>
                       <option value="LC">SANTA LUCIA</option>
                       <option value="ST">SANTO TOME Y PRINCIPE</option>
                       <option value="SN">SENEGAL</option>
                       <option value="SC">SEYCHELLES</option>
                       <option value="SL">SIERRA LEONA</option>
                       <option value="SG">SINGAPUR</option>
                       <option value="SY">SIRIA</option>
                       <option value="SO">SOMALIA</option>
                       <option value="LK">SRI LANKA</option>
                       <option value="PM">ST. PIERRE Y MIQUELON</option>
                       <option value="SZ">SUAZILANDIA</option>
                       <option value="SD">SUDAN</option>
                       <option value="SE">SUECIA</option>
                       <option value="CH">SUIZA</option>
                       <option value="SR">SURINAM</option>
                       <option value="TH">TAILANDIA</option>
                       <option value="TW">TAIWAN</option>
                       <option value="TZ">TANZANIA</option>
                       <option value="TJ">TAYIKISTAN</option>
                       <option value="TF">TERRITORIOS FRANCESES DEL SUR</option>
                       <option value="TP">TIMOR ORIENTAL</option>
                       <option value="TG">TOGO</option>
                       <option value="TO">TONGA</option>
                       <option value="TT">TRINIDAD Y TOBAGO</option>
                       <option value="TN">TUNEZ</option>
                       <option value="TM">TURKMENISTAN</option>
                       <option value="TR">TURQUIA</option>
                       <option value="TV">TUVALU</option>
                       <option value="UA">UCRANIA</option>
                       <option value="UG">UGANDA</option>
                       <option value="UY">URUGUAY</option>
                       <option value="UZ">UZBEKISTAN</option>
                       <option value="VU">VANUATU</option>
                       <option value="VE">VENEZUELA</option>
                       <option value="VN">VIETNAM</option>
                       <option value="YE">YEMEN</option>
                       <option value="YU">YUGOSLAVIA</option>
                       <option value="ZM">ZAMBIA</option>
                       <option value="ZW">ZIMBABUE</option> 
                   </select> 
               </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Ciudad: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="ciudadcliente" id="ciudadcliente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Ciudad" autocomplete="off" required="" aria-required="true"/> 
                <i class="fa fa-pencil form-control-feedback"></i>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group has-feedback2">
                <label class="control-label">Dirección Domiciliaria: <span class="symbol required"></span></label>
                <textarea class="form-control" name="direccliente" id="direccliente" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Dirección Domiciliaria" rows="2" autocomplete="off" required="" aria-required="true"></textarea>
                <i class="fa fa-map-marker form-control-feedback2"></i>
            </div>
          </div>
        </div>
    </div>

            <div class="modal-footer">
                <button type="submit" name="btn-cliente" id="btn-cliente" class="btn btn-info"><span class="fa fa-save"></span> Guardar</button>
                <button class="btn btn-dark" type="button" onclick="
                document.getElementById('proceso').value = 'save',
                document.getElementById('documcliente').value = '',
                document.getElementById('dnicliente').value = '',
                document.getElementById('nomcliente').value = '',
                document.getElementById('telefcliente').value = '',
                document.getElementById('correocliente').value = '',
                document.getElementById('limitecredito').value = '',
                document.getElementById('paiscliente').value = '',
                document.getElementById('ciudadcliente').value = '',
                document.getElementById('direccliente').value = ''
                " data-dismiss="modal" aria-hidden="true"><span class="fa fa-trash-o"></span> Cerrar</button>
            </div>
        </form>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal --> 
<!--############################## MODAL PARA REGISTRO DE NUEVO CLIENTE ######################################-->                  
                  
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
    <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Gestión de Reservación</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Reservaciones</li>
                                <li class="breadcrumb-item active" aria-current="page">Gestión de Reservación</li>
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
            
<form class="form form-material" method="post" action="#" name="savereservaciones" id="savereservaciones" enctype="multipart/form-data">
               
<!-- Row -->
<div class="row">
    <div class="col-lg-12">

                <div id="save">
                 <!-- error will be shown here ! -->
                </div>

    <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title text-white"><i class="fa fa-save"></i> Gestión de Reservación</h4>
        </div>

        <div class="form-body">

        <div class="card-body">

        <div class="row">
            <div class="col-md-9">
                <label class="control-label">Búsqueda de Cliente: </label>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-placement="left" title="Nuevo Cliente" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalCliente" data-backdrop="static" data-keyboard="false"><i class="fa fa-user-plus"></i></button>
                    </div>
                    <input type="hidden" name="proceso" id="proceso" value="save">
                    <input type="hidden" name="codcliente" id="codcliente">
                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="busqueda" id="busqueda" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para Búsqueda de Cliente" autocomplete="off"/>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                   <label class="control-label">Limite de Crédito: <span class="symbol required"></span></label>
                   <input type="hidden" name="creditoinicial" id="creditoinicial" value="0.00">
                   <input type="hidden" name="creditodisponible" id="creditodisponible" value="0.00">
                   <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="montocredito" id="montocredito" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Limite de Crédito"autocomplete="off" disabled="" required="" aria-required="true"/>
                   <i class="fa fa-usd form-control-feedback"></i> 
                </div>
            </div>  
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group has-feedback">
                   <label class="control-label">Ingrese Fecha de Entrada: <span class="symbol required"></span></label>
                   <input type="hidden" name="tipo" id="tipo" value="<?php echo encrypt("1"); ?>">
                   <input type="text" class="form-control" name="desde_r" id="desde_r" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Entrada" autocomplete="off" required="" aria-required="true"/>
                   <i class="fa fa-calendar form-control-feedback"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback">
                   <label class="control-label">Ingrese Fecha de Salida: <span class="symbol required"></span></label>
                   <input type="text" class="form-control" name="hasta_r" id="hasta_r" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Fecha de Salida" autocomplete="off" required="" aria-required="true"/>  
                   <i class="fa fa-calendar form-control-feedback"></i>
                </div>
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Cantidad N° Adultos: <span class="symbol required"></span></label> 
                    <select style="color:#000;font-weight:bold;" name="adultos" id="adultos" class='form-control' required="" aria-required="true">
                    <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    </select>
                </div> 
            </div>

            <div class="col-md-3"> 
                <div class="form-group has-feedback"> 
                   <label class="control-label">Cantidad N° Niños: <span class="symbol required"></span></label> 
                   <select style="color:#000;font-weight:bold;" name="children" id="children" class='form-control' required="" aria-required="true">
                   <option value="0" selected="selected">0</option>
                   <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                   <option value="4">4</option>
                   <option value="5">5</option>
                   </select>
                </div> 
            </div>
        </div>
           
           <div class="text-right">
    <button type="button" onClick="BuscarHabitaciones()" class="btn btn-info"><span class="fa fa-search"></span> Realizar Búsqueda</button>
            </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Row -->

            <div id="muestrahabitaciones"></div>
            <div id="muestradetallesreservacion"></div>

    </form>

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

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/jquery.mask.js"></script>
    <script type="text/javascript" src="assets/script/mask.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/ajax.js"></script>
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

<script>
    $('#buscar').click(function(){
        dni=$('#dnicliente').val();
        $.ajax({
           url:'consultaDni.php',
           type:'post',
           data: 'dni='+dni,
           dataType:'json',
           success:function(r){
            if(r.numeroDocumento==dni){
                $('#nomcliente').val(r.nombres +' '+ r.apellidoPaterno +' '+ r.apellidoMaterno);
            }else{
                alert(r.error);
            }
            console.log(r)
           }
        });
    });
</script>

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