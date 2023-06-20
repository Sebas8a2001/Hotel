<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
     if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {

$tra = new Login();
$ses = $tra->ExpiraSession(); 

$imp = new Login();
$imp = $imp->ImpuestosPorId();
$impuesto = ($imp == "" ? "Impuesto" : $imp[0]['nomimpuesto']);
$valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

$con = new Login();
$con = $con->ConfiguracionPorId();
$desc_ventas = ($con == "" ? "0.00" : number_format($con[0]['dsctov'], 2, '.', ','));
$simbolo = ($con == "" ? "" : "<strong>".$con[0]['simbolo']."</strong>");

$arqueo = new Login();
$arqueo = $arqueo->ArqueoCajaPorUsuario();

if(isset($_POST["proceso"]) and $_POST["proceso"]=="save")
{
$reg = $tra->RegistrarVentas();
exit;
}
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="update")
{
$reg = $tra->ActualizarVentas();
exit;
}  
elseif(isset($_POST["proceso"]) and $_POST["proceso"]=="agregar") 
{
$reg = $tra->AgregarDetallesVentas();
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
    <!-- This Page CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
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
    <!--Bootstrap Horizontal CSS -->
    <link href="assets/css/bootstrap-horizon.css" rel="stylesheet">

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

<!--#################### MODAL PARA BUSQUEDA DE PRODUCTOS #########################-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-align-justify"></i> Búsqueda de Productos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
                </div>
                <div class="modal-body">

                <!-- .div load -->
                <div id="loadproductos"></div>
                <!-- /.div load -->

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--#################### MODAL PARA BUSQUEDA DE PRODUCTOS #########################-->


<!--############################## MODAL PARA REGISTRO DE NUEVO CLIENTE ######################################-->
<!-- sample modal content -->
<div id="myModalCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-save"></i> Gestión de Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
            </div>
            
        <form class="form form-material" method="post" action="#" name="clienteventa" id="clienteventa">                
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
                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-save"></span> Guardar</button>
                <button class="btn btn-dark" type="button" onclick="
                document.getElementById('proceso').value = 'save',
                document.getElementById('codcliente').value = '',
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


<!--############################## MODAL PARA BUSQUEDA DE PRODUCTOS ######################################-->
<!-- sample modal content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
            <h4 class="modal-title" id="myLargeModalLabel"><font color="white"><i class="fa fa-tasks"></i> Búsqueda de Productos</font></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
            </div>
            <div class="modal-body">

        <!-- .div load -->
        <div id="loadproductos"></div>
        <!-- /.div load -->

            </div>

            <div class="modal-footer">
                <button class="btn btn-dark" type="reset" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-trash-o"></span> Cerrar</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--############################## MODAL PARA BUSQUEDA DE PRODUCTOS ######################################-->
 

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
     <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Gestión de Ventas</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Ventas</li>
                                <li class="breadcrumb-item active" aria-current="page">Ventas</li>
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
            <h4 class="card-title text-white"><i class="fa fa-save"></i> Gestión de Ventas</h4>
            </div>

<?php if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="U") {
      
$reg = $tra->VentasPorId(); ?>
      
<form class="form form-material" method="post" action="#" name="updateventas" id="updateventas" data-id="<?php echo $reg[0]["codventa"] ?>">

<?php } else if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="A") {
      
$reg = $tra->VentasPorId(); ?>
      
<form class="form form-material" method="post" action="#" name="agregaventas" id="agregaventas" data-id="<?php echo $reg[0]["codventa"] ?>">
        
<?php } else { ?>
        
 <form class="form form-material" method="post" action="#" name="saveventas" id="saveventas">

<?php } ?>
           
               <div class="form-body">

                <div id="save">
                   <!-- error will be shown here ! -->
                </div>

            <div class="card-body">



<!-- sample modal content -->
<div id="myModalPago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
             
            <div id="loadcampos">

        <?php if($arqueo==""){ ?>
              <h4 class="modal-title text-center text-white" id="myModalLabel">POR FAVOR DEBE DE REALIZAR EL ARQUEO DE CAJA ASIGNADA PARA COBRO DE VENTAS</h4>
        <?php } else { ?>
               <h4 class="modal-title text-white" id="myModalLabel"><i class="mdi mdi-desktop-mac"></i> Caja Nº: <?php echo $arqueo[0]["nrocaja"].":".$arqueo[0]["nomcaja"]; ?></h4>
                <input type="hidden" name="codcaja" id="codcaja" value="<?php echo $arqueo[0]["codcaja"]; ?>">
        <?php } ?>

            </div>

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button>
            </div>

            <div class="modal-body">
            <input type="hidden" name="pagado" id="pagado" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo number_format($reg[0]['montopagado'], 2, '.', ''); ?>" <?php } else { ?> value="0.00" <?php } ?>>
            <input type="hidden" name="montodevuelto" id="montodevuelto" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo number_format($reg[0]['montodevuelto'], 2, '.', ''); ?>" <?php } else { ?> value="0.00" <?php } ?>>
            <input type="hidden" name="creditoinicial" id="creditoinicial" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo $reg[0]['limitecredito'] == '' ? "0.00" : number_format($reg[0]['limitecredito'], 2, '.', ''); ?>" <?php } else { ?> value="0.00" <?php } ?>>
            <input type="hidden" name="creditodisponible" id="creditodisponible" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo $reg[0]['creditodisponible'] == '' ? "0.00" : number_format($reg[0]['creditodisponible'], 2, '.', ''); ?>" <?php } else { ?> value="0.00" <?php } ?>>
            <input type="hidden" name="abonototal" id="abonototal" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo $reg[0]['abonototal'] == '' ? "0.00" : number_format($reg[0]['abonototal'], 2, '.', ''); ?>" <?php } else { ?> value="0.00" <?php } ?>>

                <div class="row">
                    <div class="col-md-4">
                       <h4 class="mb-0 font-light">Total a Pagar</h4>
                       <h3 class="mb-0 font-medium"><?php echo $simbolo; ?><label id="TextImporte" name="TextImporte">0.00</label></h3>
                    </div>

                    <div class="col-md-4">
                       <h4 class="mb-0 font-light">Total Recibido</h4>
                       <h3 class="mb-0 font-medium"><?php echo $simbolo; ?><label id="TextPagado" name="TextPagado">0.00</label></h3>
                    </div>

                    <div class="col-md-4">
                       <h4 class="mb-0 font-light">Total Cambio</h4>
                       <h3 class="mb-0 font-medium"><?php echo $simbolo; ?><label id="TextCambio" name="TextCambio">0.00</label></h3>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-8">
                       <h4 class="mb-0 font-light">Nombre del Cliente</h4>
                       <h4 class="mb-0 font-medium"> <label id="TextCliente" name="TextCliente">Consumidor Final</label></h4>
                    </div>

                    <div class="col-md-4">
                       <h4 class="mb-0 font-light">Limite de Crédito</h4>
                       <h4 class="mb-0 font-medium"><?php echo $simbolo; ?><label id="TextCredito" name="TextCredito">0.00</label></h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
                                
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKET" <?php if (isset($reg[0]['tipodocumento'])) { ?> <?php if($reg[0]['tipodocumento'] == "TICKET") { ?> value="TICKET" checked="checked" <?php } } else { ?> checked="checked" <?php } ?>>
                                <label class="custom-control-label" for="ticket">TICKET</label>
                                </div>
                            </div>

                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURA" <?php if (isset($reg[0]['tipodocumento']) && $reg[0]['tipodocumento'] == "FACTURA") { ?> checked="checked" <?php } ?>>
                                <label class="custom-control-label" for="factura">FACTURA</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Condición de Pago: <span class="symbol required"></span></label>
                            <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="contado" name="tipopago" value="CONTADO" onClick="CargaCondicionesPagos()" 
                            <?php if (isset($reg[0]['tipopago'])) { ?> <?php if($reg[0]['tipopago'] == "CONTADO") { ?> value="CONTADO" checked="checked" <?php } } else { ?> checked="checked"  <?php } ?>>
                            <label class="custom-control-label" for="contado">CONTADO</label>
                            </div>

                            <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="credito" name="tipopago" value="CREDITO" onClick="CargaCondicionesPagos()" <?php if (isset($reg[0]['tipopago']) && $reg[0]['tipopago'] == "CREDITO") { ?> checked="checked" <?php } ?>>
                            <label class="custom-control-label" for="credito">CRÉDITO</label>
                            </div>
                        </div>
                    </div>
                </div>

            <div id="condiciones">

              <?php
              if (isset($reg[0]['codventa']) && $reg[0]['tipopago'] == "CONTADO") { 
              ?>
              <input type="hidden" name="pagado" id="pagado" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo number_format($reg[0]['montopagado'], 2, '.', ''); ?>" <?php } ?>>
              <input type="hidden" name="montodevuelto" id="montodevuelto" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo number_format($reg[0]['montodevuelto'], 2, '.', ''); ?>" <?php } else { ?> value="0.00" <?php } ?>>
              } else { ?>

                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group has-feedback"> 
                            <label class="control-label">Forma de Pago: <span class="symbol required"></span></label>
                            <i class="fa fa-bars form-control-feedback"></i>
                            <select style="color:#000;font-weight:bold;" name="codmediopago" id="codmediopago" class="form-control" required="" aria-required="true">
                            <option value=""> -- SELECCIONE -- </option>
                            <?php
                            $pago = new Login();
                            $pago = $pago->ListarMediosPagos();
                            if($pago==""){
                                echo "";    
                            } else {
                            for($i=0;$i<sizeof($pago);$i++){ ?>
                            <option value="<?php echo encrypt($pago[$i]['codmediopago']); ?>"><?php echo $pago[$i]['mediopago'] ?></option>       
                            <?php } } ?>
                            </select>
                        </div> 
                    </div>

                    <div class="col-md-6"> 
                        <div class="form-group has-feedback"> 
                           <label class="control-label">Monto Recibido: <span class="symbol required"></span></label>
                           <input type="hidden" name="montodevuelto" id="montodevuelto" value="0.00"/>
                           <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="montopagado" id="montopagado" autocomplete="off" placeholder="Monto Recibido" onKeyUp="CalculoDevolucion();" value="0" required="" aria-required="true"> 
                           <i class="fa fa-tint form-control-feedback"></i>
                        </div> 
                    </div>
                </div>

                <?php } ?>

            </div>

             <div id="condiciones">

                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group has-feedback"> 
                            <label class="control-label">Forma de Pago: <span class="symbol required"></span></label>
                            <i class="fa fa-bars form-control-feedback"></i>
                            <select style="color:#000;font-weight:bold;" name="codmediopago" id="codmediopago" class="form-control" required="" aria-required="true">
                            <option value=""> -- SELECCIONE -- </option>
                            <?php
                            $pago = new Login();
                            $pago = $pago->ListarMediosPagos();
                            if($pago==""){ 
                                echo "";
                            } else {
                            for($i=0;$i<sizeof($pago);$i++){ ?>
                            <option value="<?php echo encrypt($pago[$i]['codmediopago']); ?>"<?php if (!(strcmp('1', $pago[$i]['codmediopago']))) {echo "selected=\"selected\"";} ?>><?php echo $pago[$i]['mediopago'] ?></option>
                            <?php } } ?>
                            </select>
                        </div> 
                    </div>

                    <div class="col-md-6"> 
                        <div class="form-group has-feedback"> 
                           <label class="control-label">Monto Recibido: <span class="symbol required"></span></label>
                           <input type="hidden" name="montodevuelto" id="montodevuelto" value="0.00"/>
                           <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="montopagado" id="montopagado" autocomplete="off" placeholder="Monto Recibido" onKeyUp="CalculoDevolucion();" value="0" required="" aria-required="true"><i class="fa fa-tint form-control-feedback"></i>
                        </div> 
                    </div>
                </div>
            </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label class="control-label">Observaciones: </label>
                            <input type="text" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones en Venta" autocomplete="off" required="" aria-required="true"/> 
                            <i class="fa fa-comments form-control-feedback"></i>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="modal-footer">
                <span id="submit_guardar"><button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-print"></span> Facturar e Imprimir</button></span>
                <button class="btn btn-dark" type="reset" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-trash-o"></span> Cancelar</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 

 
        
    <h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-file-send"></i> Datos de Factura</h2><hr>

        <div class="row">
            <div class="col-md-9">
                <label class="control-label">Búsqueda de Cliente: </label>
                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-placement="left" title="Nuevo Cliente" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalCliente" data-backdrop="static" data-keyboard="false"><i class="fa fa-user-plus"></i></button>
                    </div>

                    <input type="hidden" name="proceso" id="proceso" <?php if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="U") { ?> value="update" <?php } elseif (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="A") { ?> value="agregar" <?php } else { ?> value="save" <?php } ?>>

                    <input type="hidden" name="codventa" id="codventa" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo $reg[0]['codventa']; ?>"<?php } ?>>
                    <input type="hidden" name="venta" id="venta" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo encrypt($reg[0]['codventa']); ?>"<?php } ?>>
                  
                    <input type="hidden" name="arqueoxventa" id="arqueoxventa" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo encrypt($reg[0]['codarqueo']); ?>" <?php } ?>>
                    <input type="hidden" name="codcliente" id="codcliente" <?php if (isset($reg[0]['codcliente'])) { ?> value="<?php echo $reg[0]['codcliente'] == '' ? "0" : $reg[0]['codcliente']; ?>" <?php } else { ?> value="0" <?php } ?>>

                    <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="busqueda" id="busqueda" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Criterio para Búsqueda de Cliente" autocomplete="off" <?php if (isset($reg[0]['codcliente'])) { ?> value="<?php echo $reg[0]['codcliente'] == "" || $reg[0]['codcliente'] == "0" ? "CONSUMIDOR FINAL" : $reg[0]['documento'].": ".$reg[0]['dnicliente'].": ".$reg[0]['nomcliente']; ?>" <?php } else { ?> value="CONSUMIDOR FINAL" <?php } ?>/>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group has-feedback">
                   <label class="control-label">Limite de Crédito: <span class="symbol required"></span></label>
                   <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="montocredito" id="montocredito" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Limite de Crédito" <?php if (isset($reg[0]['codventa'])) { ?> value="<?php echo $reg[0]['codcliente'] == '' ? "0.00" : $reg[0]['creditodisponible']; ?>" <?php } ?> autocomplete="off" disabled="" required="" aria-required="true"/>
                   <i class="fa fa-usd form-control-feedback"></i> 
                </div>
            </div>  
        </div>

<?php if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="U") { ?>

<h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-cart-plus"></i> Detalles de Factura</h2><hr>

<div id="detallesventasupdate">

        <div class="table-responsive m-t-20">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Cantidad</th>
                        <th>Código</th>
                        <th>Descripción de Producto</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><th>Acción</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesVentas();
$a=1;
for($i=0;$i<sizeof($detalle);$i++){  
    ?>
                                 <tr class="text-center">
      <td>
      <input type="text" class="form-control" name="cantventa[]" id="cantventa_<?php echo $a; ?>" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad" value="<?php echo $detalle[$i]["cantventa"]; ?>" style="width: 80px;" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#e4e7ea')" title="Ingrese Cantidad" required="" aria-required="true">
      <input type="hidden" name="cantidadventabd[]" id="cantidadventabd" value="<?php echo $detalle[$i]["cantventa"]; ?>">
      </td>
      
      <td>
      <input type="hidden" name="coddetalleventa[]" id="coddetalleventa" value="<?php echo $detalle[$i]["coddetalleventa"]; ?>">
      <input type="hidden" name="codproducto[]" id="codproducto" value="<?php echo $detalle[$i]["codproducto"]; ?>">
      <?php echo $detalle[$i]['codproducto']; ?>
      </td>
      
      <td><input type="hidden" name="preciocompra[]" id="preciocompra" value="<?php echo $detalle[$i]["preciocompra"]; ?>"><h5><?php echo $detalle[$i]['producto']; ?></h5><small>CATEGORIA (<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      
      <td><input type="hidden" name="precioventa[]" id="precioventa" value="<?php echo $detalle[$i]["precioventa"]; ?>"><?php echo $simbolo.$detalle[$i]['precioventa']; ?></td>

       <td><input type="hidden" name="valortotal[]" id="valortotal" value="<?php echo $detalle[$i]["valortotal"]; ?>"><?php echo $simbolo.$detalle[$i]['valortotal']; ?></td>
      
      <td><input type="hidden" name="descproducto[]" id="descproducto" value="<?php echo $detalle[$i]["descproducto"]; ?>"><?php echo $simbolo.$detalle[$i]['totaldescuentov']; ?><sup><?php echo $detalle[$i]['descproducto']; ?>%</sup></td>

      <td><input type="hidden" name="ivaproducto[]" id="ivaproducto" value="<?php echo $detalle[$i]["ivaproducto"]; ?>"><?php echo $detalle[$i]['ivaproducto'] == 'SI' ? $reg[0]['iva']."%" : "(E)"; ?></td>

      <td><?php echo $simbolo.$detalle[$i]['valorneto']; ?></td>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleVentaUpdate('<?php echo encrypt($detalle[$i]["coddetalleventa"]); ?>','<?php echo encrypt($detalle[$i]["codventa"]); ?>','<?php echo encrypt($reg[0]["codcliente"]); ?>','<?php echo encrypt("DETALLESVENTAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td><?php } ?>
                                 </tr>
                     <?php } ?>
                </tbody>
            </table><hr>

             <table id="carritototal" class="table-responsive">
                <tr>
    <td width="50">&nbsp;</td>
    <td width="250">
    <h5><label>Total Gravado <?php echo $reg[0]['iva'] ?>%:</label></h5>
    </td>
                  
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal" name="lblsubtotal"><?php echo $reg[0]['subtotalivasi'] ?></label></h5>
    <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="<?php echo $reg[0]['subtotalivasi'] ?>"/>
    </td>

    <td width="250">
    <h5><label>Total Exento 0%:</label></h5>
    </td>
    
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal2" name="lblsubtotal2"><?php echo $reg[0]['subtotalivano'] ?></label></h5>
    <input type="hidden" name="txtsubtotal2" id="txtsubtotal2" value="<?php echo $reg[0]['subtotalivano'] ?>"/>
    </td>

    <td class="text-center" width="250">
    <h2><b>Importe Total</b></h2>
    </td>
                </tr>
                <tr>
    <td>&nbsp;</td>
    <td>
    <h5><label><?php echo $impuesto; ?> <?php echo $reg[0]['iva'] ?>%:<input type="hidden" name="iva" id="iva" autocomplete="off" value="<?php echo $reg[0]['iva'] ?>"></label></h5>
    </td>
    
    <td>
    <h5><?php echo $simbolo; ?><label id="lbliva" name="lbliva"><?php echo $reg[0]['totaliva'] ?></label></h5>
    <input type="hidden" name="txtIva" id="txtIva" value="<?php echo $reg[0]['totaliva'] ?>"/>
    </td>

    <td>
    <h5><label>Desc. Global <input class="number" type="text" name="descuento" id="descuento" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:70px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $reg[0]['descuento'] ?>">%:</label></h5>
    </td>

    <td>
    <h5><?php echo $simbolo; ?><label id="lbldescuento" name="lbldescuento"><?php echo $reg[0]['totaldescuento'] ?></label></h5>
    <input type="hidden" name="txtDescuento" id="txtDescuento" value="<?php echo $reg[0]['totaldescuento'] ?>"/>
    </td>

    <td class="text-center">
    <h2><?php echo $simbolo; ?><label id="lbltotal" name="lbltotal"><?php echo $reg[0]['totalpago'] ?></label></h2>
    <input type="hidden" name="txtTotal" id="txtTotal" value="<?php echo $reg[0]['totalpago'] ?>"/>
    <input type="hidden" name="txtTotalCompra" id="txtTotalCompra" value="0.00"/>
    </td>
                    </tr>
                  </table>
        </div>
</div>


<?php } else if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="A") { ?>

<h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-cart-plus"></i> Detalles Agregados</h2><hr>

<div id="detallesventasagregar">

        <div class="table-responsive m-t-20">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Nº</th>
                        <th>Código</th>
                        <th>Descripción de Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><th>Acción</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesVentas();
$a=1;
for($i=0;$i<sizeof($detalle);$i++){  
    ?>
                                 <tr class="text-center">
      <td><?php echo $a++; ?></td>
      
      <td><?php echo $detalle[$i]['codproducto']; ?></td>

    <td><h5><?php echo $detalle[$i]['producto']; ?></h5><small>CATEGORIA (<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>

      <td><?php echo $detalle[$i]['cantventa']; ?></td>
      
      <td><?php echo $simbolo.$detalle[$i]['precioventa']; ?></td>

       <td><?php echo $simbolo.$detalle[$i]['valortotal']; ?></td>
      
      <td><?php echo $simbolo.$detalle[$i]['totaldescuentov']; ?><sup><?php echo $detalle[$i]['descproducto']; ?>%</sup></td>

      <td><?php echo $detalle[$i]['ivaproducto'] == 'SI' ? $reg[0]['iva']."%" : "(E)"; ?></td>

      <td><?php echo $simbolo.$detalle[$i]['valorneto']; ?></td>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><td><button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleVentaAgregar('<?php echo encrypt($detalle[$i]["coddetalleventa"]); ?>','<?php echo encrypt($detalle[$i]["codventa"]); ?>','<?php echo encrypt($reg[0]["codcliente"]); ?>','<?php echo encrypt("DETALLESVENTAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td><?php } ?>
                                 </tr>
                     <?php } ?>
                </tbody>
            </table>

            <table class="table-responsive">
                <tr>
    <td width="50">&nbsp;</td>
    <td width="250">
    <h5><label>Total Gravado <?php echo $reg[0]['iva'] ?>%:</label></h5>
    </td>
                  
    <td width="250">
    <h5><?php echo $simbolo; ?><label><?php echo number_format($reg[0]['subtotalivasi'], 2, '.', ','); ?></label></h5>
    </td>

    <td width="250">
    <h5><label>Total Exento 0%:</label></h5>
    </td>
    
    <td width="250">
    <h5><?php echo $simbolo; ?><label><?php echo number_format($reg[0]['subtotalivano'], 2, '.', ','); ?></label></h5>
    </td>

    <td class="text-center" width="250">
    <h2><b>Importe Total</b></h2>
    </td>
                </tr>
                <tr>
    <td>&nbsp;</td>
    <td>
    <h5><label><?php echo $impuesto; ?> <?php echo $reg[0]['iva']; ?>%:</label></h5>
    </td>
    
    <td>
    <h5><?php echo $simbolo; ?><label><?php echo number_format($reg[0]['totaliva'], 2, '.', ','); ?></label></h5>
    </td>

    <td>
    <h5><label>Desc. Global (<?php echo $reg[0]['descuento']; ?>%):</label></h5>
    </td>

    <td>
    <h5><?php echo $simbolo; ?><label><?php echo number_format($reg[0]['totaldescuento'], 2, '.', ','); ?></label></h5>
    </td>

    <td class="text-center">
    <h2><b><?php echo $simbolo; ?><label><?php echo number_format($reg[0]['totalpago'], 2, '.', ','); ?></label></b></h2>
    </td>
                    </tr>
                  </table>

            </div>
      </div>

            <hr>

        <input type="hidden" name="codproducto" id="codproducto">
        <input type="hidden" name="producto" id="producto">
        <input type="hidden" name="categorias" id="categorias">
        <input type="hidden" name="preciocompra" id="preciocompra"> 
        <input type="hidden" name="precioconiva" id="precioconiva">
        <input type="hidden" name="ivaproducto" id="ivaproducto">

        <h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-cart-plus"></i> Detalles de Factura</h2><hr>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Realice la Búsqueda de Producto: <span class="symbol required"></span></label>
                  <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="busquedaproductov" id="busquedaproductov" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Realice la Búsqueda por Código, Descripción o Nº de Barra">
                  <i class="fa fa-search form-control-feedback"></i> 
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                 <label class="control-label">Precio Unitario: <span class="symbol required"></span></label>
                 <input class="form-control" type="text" name="precioventa" id="precioventa" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Precio Unitario" disabled="disabled" readonly="readonly">
                 <i class="fa fa-tint form-control-feedback"></i> 
               </div> 
            </div> 

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                 <label class="control-label">Stock Actual: <span class="symbol required"></span></label>
                 <input type="text" class="form-control" name="existencia" id="existencia" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Existencia" disabled="disabled" readonly="readonly">
                 <i class="fa fa-bolt form-control-feedback"></i> 
              </div> 
            </div>  

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Descuento: <span class="symbol required"></span></label>
                    <input class="form-control agregaventa" type="text" name="descproducto" id="descproducto" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Descuento">
                    <i class="fa fa-tint form-control-feedback"></i> 
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                 <label class="control-label">Cantidad: <span class="symbol required"></span></label>
                 <input type="text" class="form-control agregaventa" name="cantidad" id="cantidad" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cantidad">
                 <i class="fa fa-bolt form-control-feedback"></i> 
                </div> 
            </div>
        </div>

        <div class="pull-right">
     <div class="pull-right">
    <button type="button" class="btn btn-success" data-placement="left" title="Buscar Productos" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="CargaProductos()"><i class="fa fa-search"></i> Productos</button>
    <button type="button" id="AgregaVenta" class="btn btn-info"><span class="fa fa-cart-plus"></span> Agregar</button>
        </div>
        </div></br>

        <div class="table-responsive m-t-40">
            <table id="carrito" class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Cantidad</th>
                        <th>Código</th>
                        <th>Descripción de Producto</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" colspan=9><h4>NO HAY DETALLES AGREGADOS</h4></td>
                    </tr>
                </tbody>
              </table><hr>

             <table id="carritototal" class="table-responsive">
                <tr>
    <td width="50">&nbsp;</td>
    <td width="250">
    <h5><label>Total Gravado <?php echo $valor; ?>%:</label></h5>
    </td>
                  
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal" name="lblsubtotal">0.00</label></h5>
    <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0.00"/>
    </td>

    <td width="250">
    <h5><label>Total Exento 0%:</label></h5>
    </td>
    
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal2" name="lblsubtotal2">0.00</label></h5>
    <input type="hidden" name="txtsubtotal2" id="txtsubtotal2" value="0.00"/>
    </td>

    <td class="text-center" width="250">
    <h2><b>Importe Total</b></h2>
    </td>
                </tr>
                <tr>
    <td>&nbsp;</td>
    <td>
    <h5><label><?php echo $impuesto; ?> <?php echo $valor; ?>%:<input type="hidden" name="iva" id="iva" autocomplete="off" value="<?php echo $valor; ?>"></label></h5>
    </td>
    
    <td>
    <h5><?php echo $simbolo; ?><label id="lbliva" name="lbliva">0.00</label></h5>
    <input type="hidden" name="txtIva" id="txtIva" value="0.00"/>
    </td>

    <td>
    <h5><label>Desc. Global <input class="number" type="text" name="descuento" id="descuento" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:60px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $desc_ventas; ?>">%:</label></h5>
    </td>

    <td>
    <h5><?php echo $simbolo; ?><label id="lbldescuento" name="lbldescuento">0.00</label></h5>
    <input type="hidden" name="txtDescuento" id="txtDescuento" value="0.00"/>
    </td>

    <td class="text-center">
    <h2><b><?php echo $simbolo; ?><label id="lbltotal" name="lbltotal">0.00</label></b></h2>
    <input type="hidden" name="txtTotal" id="txtTotal" value="0.00"/>
    <input type="hidden" name="txtTotalCompra" id="txtTotalCompra" value="0.00"/>
    </td>
                    </tr>
                  </table>
        </div>


<?php } else { ?>

    <div id="loadcampos">

        <input type="hidden" name="codproducto" id="codproducto">
        <input type="hidden" name="producto" id="producto">
        <input type="hidden" name="categorias" id="categorias">
        <input type="hidden" name="preciocompra" id="preciocompra"> 
        <input type="hidden" name="precioconiva" id="precioconiva">
        <input type="hidden" name="ivaproducto" id="ivaproducto">

        <h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-cart-plus"></i> Detalles de Factura</h2><hr>

        <div class="row">
            <div class="col-md-4"> 
                <div class="form-group has-feedback"> 
                  <label class="control-label">Realice la Búsqueda de Producto: <span class="symbol required"></span></label>
                  <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="busquedaproductov" id="busquedaproductov" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Realice la Búsqueda por Código, Descripción o Nº de Barra">
                  <i class="fa fa-search form-control-feedback"></i> 
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                 <label class="control-label">Precio Unitario: <span class="symbol required"></span></label>
                 <input class="form-control" type="text" name="precioventa" id="precioventa" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Precio Unitario" disabled="disabled" readonly="readonly">
                 <i class="fa fa-tint form-control-feedback"></i> 
               </div> 
            </div> 

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                 <label class="control-label">Stock Actual: <span class="symbol required"></span></label>
                 <input type="text" class="form-control" name="existencia" id="existencia" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Existencia" disabled="disabled" readonly="readonly">
                 <i class="fa fa-bolt form-control-feedback"></i> 
              </div> 
            </div>  

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                    <label class="control-label">Descuento: <span class="symbol required"></span></label>
                    <input class="form-control agregaventa" type="text" name="descproducto" id="descproducto" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Descuento">
                    <i class="fa fa-tint form-control-feedback"></i> 
                </div> 
            </div>

            <div class="col-md-2"> 
                <div class="form-group has-feedback"> 
                 <label class="control-label">Cantidad: <span class="symbol required"></span></label>
                 <input type="text" class="form-control agregaventa" name="cantidad" id="cantidad" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cantidad">
                 <i class="fa fa-bolt form-control-feedback"></i> 
                </div> 
            </div>
        </div>

       <div class="pull-right">
    <button type="button" class="btn btn-success" data-placement="left" title="Buscar Productos" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="CargaProductos()"><i class="fa fa-search"></i> Productos</button>
    <button type="button" id="AgregaVenta" class="btn btn-info"><span class="fa fa-cart-plus"></span> Agregar</button>
        </div>
    
    </div></br>

        <div class="table-responsive m-t-40">
            <table id="carrito" class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Cantidad</th>
                        <th>Código</th>
                        <th>Descripción de Producto</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" colspan=9><h4>NO HAY DETALLES AGREGADOS</h4></td>
                    </tr>
                </tbody>
              </table><hr>

             <table id="carritototal" class="table-responsive">
                <tr>
    <td width="50">&nbsp;</td>
    <td width="250">
    <h5><label>Total Gravado <?php echo $valor; ?>%:</label></h5>
    </td>
                  
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal" name="lblsubtotal">0.00</label></h5>
    <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0.00"/>
    </td>

    <td width="250">
    <h5><label>Total Exento 0%:</label></h5>
    </td>
    
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal2" name="lblsubtotal2">0.00</label></h5>
    <input type="hidden" name="txtsubtotal2" id="txtsubtotal2" value="0.00"/>
    </td>

    <td class="text-center" width="250">
    <h2><b>Importe Total</b></h2>
    </td>
                </tr>
                <tr>
    <td>&nbsp;</td>
    <td>
    <h5><label><?php echo $impuesto; ?> <?php echo $valor; ?>%:<input type="hidden" name="iva" id="iva" autocomplete="off" value="<?php echo $valor; ?>"></label></h5>
    </td>
    
    <td>
    <h5><?php echo $simbolo; ?><label id="lbliva" name="lbliva">0.00</label></h5>
    <input type="hidden" name="txtIva" id="txtIva" value="0.00"/>
    </td>

    <td>
    <h5><label>Desc. Global <input class="number" type="text" name="descuento" id="descuento" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:60px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $desc_ventas; ?>">%:</label></h5>
    </td>

    <td>
    <h5><?php echo $simbolo; ?><label id="lbldescuento" name="lbldescuento">0.00</label></h5>
    <input type="hidden" name="txtDescuento" id="txtDescuento" value="0.00"/>
    </td>

    <td class="text-center">
    <h2><b><?php echo $simbolo; ?><label id="lbltotal" name="lbltotal">0.00</label></b></h2>
    <input type="hidden" name="txtTotal" id="txtTotal" value="0.00"/>
    <input type="hidden" name="txtTotalCompra" id="txtTotalCompra" value="0.00"/>
    </td>
                    </tr>
                  </table>
        </div>


<?php } ?> 


<div class="clearfix"></div>
<hr>
              <div class="text-right">
<?php  if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="U") { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-info"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-dark" type="reset"><span class="fa fa-trash-o"></span> Cancelar</button> 
<?php } else if (isset($_GET['codventa']) && decrypt($_GET["proceso"])=="A") { ?>  
<button type="submit" name="btn-agregar" id="btn-agregar" class="btn btn-info"><span class="fa fa-plus"></span> Agregar</button>
<button class="btn btn-dark" type="button" id="vaciar2"><span class="fa fa-trash-o"></span> Cancelar</button>
<?php } else { ?>  

<button type="button" id="buttonpago" class="btn btn-info waves-effect waves-light" data-placement="left" title="Cobrar Venta" data-original-title="" data-href="#" disabled="" data-toggle="modal" data-target="#myModalPago" data-backdrop="static" data-keyboard="false"><span class="fa fa-calculator"></span> Pagar</button>
<button class="btn btn-dark" type="button" id="vaciar"><i class="fa fa-trash-o"></i> Limpiar</button>
<?php } ?>
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
    <!-- Sweet-Alert -->
    <script src="assets/js/sweetalert-dev.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.js"></script>

    <!-- script jquery -->
    <script type="text/javascript" src="assets/script/titulos.js"></script>
    <script type="text/javascript" src="assets/script/jquery.mask.js"></script>
    <script type="text/javascript" src="assets/script/mask.js"></script>
    <script type="text/javascript" src="assets/script/script2.js"></script>
    <script type="text/javascript" src="assets/script/jsventas.js"></script>
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