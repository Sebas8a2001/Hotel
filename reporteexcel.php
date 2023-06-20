<?php
require_once("class/class.php");
    if (isset($_SESSION['acceso'])) {
       if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista" || $_SESSION["acceso"]=="cliente") {

$imp = new Login();
$imp = $imp->ImpuestosPorId();
$impuesto = ($imp == "" ? "Impuesto" : $imp[0]['nomimpuesto']);
$valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = ($con == "" ? "" : "<strong>".$con[0]['simbolo']."</strong>");

$tipo = decrypt($_GET['tipo']);
$documento = decrypt($_GET['documento']);
$extension = $documento == 'EXCEL' ? '.xls' : '.doc';

switch($tipo)
  {

############################# MODULO DE CONFIGURACIONES #############################
case 'MENSAJES': 

$archivo = str_replace(" ", "_","LISTADO MENSAJES DE CONTACTO");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRES Y APELLIDOS</th>
           <th>Nº DE TELEFONO</th>
           <th>EMAIL</th>
           <th>ASUNTO</th>
           <th>MENSAJE</th>
           <th>FECHA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarContact();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['name']; ?></td>
           <td><?php echo $reg[$i]['phone'] == '' ? "*********" : $reg[$i]['phone']; ?></td>
           <td><?php echo $reg[$i]['email']; ?></td>
           <td><?php echo $reg[$i]['subject']; ?></td>
           <td><?php echo $reg[$i]['message']; ?></td>
           <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]["fecha"])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;


case 'CATEGORIAS': 

$archivo = str_replace(" ", "_","LISTADO DE CATEGORIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE CATEGORIA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarCategorias();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $reg[$i]['codcategoria']; ?></td>
           <td><?php echo $reg[$i]['nomcategoria']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'DOCUMENTOS': 

$archivo = str_replace(" ", "_","LISTADO DE DOCUMENTOS TRIBUTARIOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE DOCUMENTO</th>
           <th>DESCRIPCIÓN DE DOCUMENTO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarDocumentos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documento']; ?></td>
           <td><?php echo $reg[$i]['descripcion']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'TIPOMONEDA': 

$archivo = str_replace(" ", "_","LISTADO DE TIPOS DE MONEDA");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MONEDA</th>
           <th>SIGLAS</th>
           <th>SIMBOLO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarTipoMoneda();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['moneda']; ?></td>
           <td><?php echo $reg[$i]['siglas']; ?></td>
           <td><?php echo $reg[$i]['simbolo']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'TIPOCAMBIO': 

$archivo = str_replace(" ", "_","LISTADO DE TIPO DE CAMBIO");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>DESCRIPCIÓN DE CAMBIO</th>
           <th>MONTO DE CAMBIO</th>
           <th>TIPO DE MONEDA</th>
           <th>FECHA DE INGRESO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarTipoCambio();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['descripcioncambio']; ?></td>
           <td><?php echo $reg[$i]['montocambio']; ?></td>
           <td><?php echo $reg[$i]['moneda']."/".$reg[$i]['siglas']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacambio'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'MEDIOSPAGOS': 

$archivo = str_replace(" ", "_","LISTADO DE MEDIOS DE PAGOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE MEDIO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarMediosPagos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['mediopago']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'IMPUESTOS': 

$archivo = str_replace(" ", "_","LISTADO DE IMPUESTOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE IMPUESTO</th>
           <th>VALOR(%)</th>
           <th>STATUS</th>
           <th>REGISTRO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarImpuestos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nomimpuesto']; ?></td>
           <td><?php echo $reg[$i]['valorimpuesto']; ?></td>
           <td><?php echo $reg[$i]['statusimpuesto']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaimpuesto'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'PERFIL': 

$archivo = str_replace(" ", "_","LISTADO DE PERFIL DE HOTEL");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE PERFIL</th>
           <th>DESCRIPCIÓN DE PERFIL</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarPerfil();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nomperfil']; ?></td>
           <td><?php echo $reg[$i]['descperfil']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'TEMPORADAS': 

$archivo = str_replace(" ", "_","LISTADO DE TEMPORADAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE TEMPORADA</th>
           <th>FECHA DESDE</th>
           <th>FECHGA HASTA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarTemporadas();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['temporada']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'NOTICIAS': 

$archivo = str_replace(" ", "_","LISTADO DE NOTICIAS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TITULO DE NOTICIA</th>
           <th>DESCRIPCIÓN DE NOTICIA</th>
           <th>PUBLICADO</th>
           <th>STATUS DE NOTICIA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarNoticias();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['titulonoticia']; ?></td>
           <td><?php echo $reg[$i]['descripcnoticia']; ?></td>
           <td><?php echo $reg[$i]['statusnoticia'] == 'NO PUBLICADA' ? "**********" : date("d-m-Y h:i:s",strtotime($reg[$i]['publicado'])); ?></td>
           <td><?php echo $status = ( $reg[$i]['statusnoticia'] == 'PUBLICADA' ? $reg[$i]['statusnoticia'] : $reg[$i]['statusnoticia']); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'TIPOS': 

$archivo = str_replace(" ", "_","LISTADO DE TIPO DE HABITACIONES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE TIPO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarTipos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nomtipo']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'TARIFAS': 

$archivo = str_replace(" ", "_","LISTADO DE TARIFAS DE HABITACIONES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE TIPO</th>
           <th>TEMPORADA BAJA</th>
           <th>TEMPORADA MEDIA</th>
           <th>TEMPORADA ALTA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarTarifas();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nomtipo']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['baja'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['media'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['alta'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;


############################# MODULO DE CONFIGURACIONES #############################









############################# MODULO DE USUARIOS #############################

case 'USUARIOS': 

$tra = new Login();
$reg = $tra->ListarUsuarios();

$archivo = str_replace(" ", "_","LISTADO DE USUARIOS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES Y APELLIDOS</th>
<?php if ($documento == "EXCEL") { ?>
           <th>SEXO</th>
           <th>DIRECCIÓN</th>
           <th>N° DE TELÉFONO</th>
           <th>CORREO ELECTRONICO</th>
<?php } ?>
           <th>USUARIO</th>
           <th>NIVEL</th>
           <th>STATUS</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['dni']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['sexo']; ?></td>
           <td><?php echo $reg[$i]['direccion']; ?></td>
           <td><?php echo $reg[$i]['telefono']; ?></td>
           <td><?php echo $reg[$i]['email']; ?></td>
<?php } ?>
           <td><?php echo $reg[$i]['usuario']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $status = ( $reg[$i]['status'] == 1 ? "ACTIVO" : "INACTIVO"); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'LOGS': 

$archivo = str_replace(" ", "_","LISTADO LOGS DE ACCESO");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>IP EQUIPO</th>
           <th>TIEMPO DE ENTRADA</th>
           <th>NAVEGADOR DE ACCESO</th>
           <th>PÁGINAS DE ACCESO</th>
           <th>USUARIOS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarLogs();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['ip']; ?></td>
           <td><?php echo $reg[$i]['tiempo']; ?></td>
           <td><?php echo $reg[$i]['detalles']; ?></td>
           <td><?php echo $reg[$i]['paginas']; ?></td>
           <td><?php echo $reg[$i]['usuario']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

############################# MODULO DE USUARIOS #############################














############################# MODULO DE HABITACIONES #############################

case 'HABITACIONES': 

$archivo = str_replace(" ", "_","LISTADO DE HABITACIONES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE HABITACIÓN</th>
           <th>TIPO DE HABITACIÓN</th>
           <th>DESCRIPCIÓN DE HABITACIÓN</th>
           <th>PISO</th>
           <th>VISTA</th>
           <th>MÁX. ADULTOS</th>
           <th>MÁX. NIÑOS</th>
           <th>TARIFA(TEMPORADA BAJA)</th>
           <th>TARIFA(TEMPORADA MEDIA)</th>
           <th>TARIFA(TEMPORADA ALTA)</th>
           <th>DESCUENTO</th>
           <th>STATUS DE HABITACIÓN</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarHabitaciones();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['numhabitacion']; ?></td>
           <td><?php echo $reg[$i]['nomtipo']; ?></td>
           <td><?php echo $reg[$i]['descriphabitacion']; ?></td>
           <td><?php echo $reg[$i]['piso']; ?></td>
           <td><?php echo $reg[$i]['vista']; ?></td>
           <td><?php echo $reg[$i]['maxadultos']; ?></td>
           <td><?php echo $reg[$i]['maxninos']; ?></td>
           <td><?php echo $simbolo.$reg[$i]['baja']; ?></td>
           <td><?php echo $simbolo.$reg[$i]['media']; ?></td>
           <td><?php echo $simbolo.$reg[$i]['alta']; ?></td>
           <td><?php echo $reg[$i]['deschabitacion']; ?></td>
           <td><?php echo $habitacion = ( $reg[$i]['statushab'] == 0 ? "DISPONIBLE" : "EN MANTENIMIENTO"); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

############################# MODULO DE HABITACIONES #############################















############################# MODULO DE CLIENTES #############################

case 'CLIENTES': 

$archivo = str_replace(" ", "_","LISTADO DE CLIENTES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRES Y APELLIDOS</th>
           <th>PAIS</th>
<?php if ($documento == "EXCEL") { ?>
           <th>CIUDAD</th>
           <th>DIRECCIÓN DOMICILIARIA</th>
           <th>CORREO ELECTRONICO</th>
<?php } ?>
           <th>Nº DE TELÉFONO</th>
           <th>LIMITE DE CRÉDITO</th>
           <th>FECHA INGRESO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarClientes();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documcliente'] == '0' ? "*********" : $reg[$i]['documento']; ?></td>
           <td><?php echo $reg[$i]['dnicliente']; ?></td>
           <td><?php echo $reg[$i]['nomcliente']; ?></td>
           <td><?php echo paises($reg[$i]['paiscliente']); ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['ciudadcliente']; ?></td>
           <td><?php echo $reg[$i]['direccliente']; ?></td>
           <td><?php echo $reg[$i]['correocliente'] == '' ? "*********" : $reg[$i]['correocliente']; ?></td>
<?php } ?>
           <td><?php echo $reg[$i]['telefcliente'] == '' ? "*********" : $reg[$i]['telefcliente']; ?></td>
           <td><?php echo $reg[$i]['limitecredito']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaingreso'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

############################# MODULO DE CLIENTES #############################










############################# MODULO DE PROVEEDORES #############################

case 'PROVEDORES': 

$archivo = str_replace(" ", "_","LISTADO DE PROVEDORES");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>TIPO DE DOCUMENTO</th>
           <th>Nº DE DOCUMENTO</th>
           <th>NOMBRE DE PROVEEDOR</th>
           <th>Nº DE TELÉFONO</th>
           <th>DIRECCIÓN DOMICILIARIA</th>
           <th>CORREO ELECTRONICO</th>
           <th>VENDEDOR</th>
           <th>Nº DE TELÉFONO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarProveedores();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['documproveedor'] == '0' ? "*********" : $reg[$i]['documento']; ?></td>
           <td><?php echo $reg[$i]['cuitproveedor']; ?></td>
           <td><?php echo $reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['tlfproveedor'] == '' ? "*********" : $reg[$i]['tlfproveedor']; ?></td>
           <td><?php echo $reg[$i]['direcproveedor']; ?></td>
           <td><?php echo $reg[$i]['emailproveedor'] == '' ? "*********" : $reg[$i]['emailproveedor']; ?></td>
           <td><?php echo $reg[$i]['vendedor']; ?></td>
           <td><?php echo $reg[$i]['tlfvendedor']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;
############################# MODULO DE PROVEEDORES #############################











############################# MODULO DE INSUMOS #############################

case 'INSUMOS': 

$archivo = str_replace(" ", "_","LISTADO DE INSUMOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>N° DE INSUMO</th>
           <th>DESCRIPCIÓN DE INSUMO</th>
           <th>CATEGORIA</th>
           <th>EXISTENCIA</th>
           <th>PRECIO COMPRA</th>
           <th>PRECIO VENTA</th>
           <th>STOCK MINIMO</th>
           <th><?php echo $impuesto; ?></th>
           <th>DESC</th>
           <th>FECHA EXPIRACIÓN</th>
           <th>PROVEEDOR</th>
           <th>LOTE</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarInsumos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codinsumo']; ?></td>
           <td><?php echo $reg[$i]['insumo']; ?></td>
           <td><?php echo $reg[$i]['nomcategoria']; ?></td>
           <td><?php echo $reg[$i]['existencia']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['preciocompra'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['stockminimo'] == '0' ? "*********" : $reg[$i]['stockminimo']; ?></td>
          <td><?php echo $reg[$i]['ivainsumo'] == 'SI' ? $valor."%" : "(E)"; ?></td>
          <td><?php echo $reg[$i]['descinsumo']; ?></td>
           <td><?php echo $reg[$i]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechaexpiracion'])); ?></td>
           <td><?php echo $reg[$i]['codproveedor'] == '0' ? "*********" : $reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['lote'] == '' || $reg[$i]['lote'] == '0' ? "*********" : $reg[$i]['lote']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'SALIDAINSUMOS': 

$archivo = str_replace(" ", "_","LISTADO SALIDA DE INSUMOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>N° DE INSUMO</th>
           <th>RESPONSABLE SALIDA</th>
           <th>DESCRIPCIÓN DE INSUMO</th>
           <th>CATEGORIA</th>
           <th>SALIDA</th>
           <th>PRECIO VENTA</th>
           <th><?php echo $impuesto; ?></th>
           <th>DESC</th>
           <th>FECHA SALIDA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarSalidaInsumos();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codinsumo']; ?></td>
           <td><?php echo $reg[$i]['responsable'] == '' ? "*********" : $reg[$i]['responsable']; ?></td>
           <td><?php echo $reg[$i]['insumo']; ?></td>
           <td><?php echo $reg[$i]['nomcategoria']; ?></td>
           <td><?php echo $reg[$i]['cantsalida']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['preciosalida'], 2, '.', ','); ?></td>
          <td><?php echo $reg[$i]['ivasalida'] == 'SI' ? $valor."%" : "(E)"; ?></td>
          <td><?php echo $reg[$i]['descsalida']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechasalida'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;


case 'KARDEXINSUMOS':

$kardex = new Login();
$kardex = $kardex->BuscarKardexInsumo(); 

$archivo = str_replace(" ", "_","KARDEX DEL INSUMO (".$kardex[0]['insumo'].")");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>RESPONSABLE</th>
           <th>MOVIMIENTO</th>
           <th>ENTRADAS</th>
           <th>SALIDAS</th>
           <th>DEVOLUCIÓN</th>
           <th>EXISTENCIA</th>
           <th>EXISTENCIA</th>
           <th><?php echo $impuesto; ?></th>
           <th>DESCUENTO</th>
           <th>PRECIO</th>
           <th>DOCUMENTO</th>
           <th>FECHA KARDEX</th>
         </tr>
      <?php 

if($kardex==""){
echo "";      
} else {

$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
$a=1;
for($i=0;$i<sizeof($kardex);$i++){ 
$TotalEntradas+=$kardex[$i]['entradas'];
$TotalSalidas+=$kardex[$i]['salidas'];
$TotalDevolucion+=$kardex[$i]['devolucion'];
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $kardex[$i]['codresponsable'] == '0' ? "*********" : $kardex[$i]['codresponsable']; ?></td>
          <td><?php echo $kardex[$i]['movimiento']; ?></td>
          <td><?php echo $kardex[$i]['entradas']; ?></td>
          <td><?php echo $kardex[$i]['salidas']; ?></td>
          <td><?php echo $kardex[$i]['devolucion']; ?></td>
          <td><?php echo $kardex[$i]['stockactual']; ?></td>
           <td><?php echo $kardex[$i]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
           <td><?php echo $kardex[$i]['descproducto']; ?></td>
           <td><?php echo $simbolo.number_format($kardex[$i]["precio"], 2, '.', ','); ?></td>
          <td><?php echo $kardex[$i]['documento']; ?></td>
          <td><?php echo date("d-m-Y",strtotime($kardex[$i]['fechakardex'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<strong>DETALLE DE INSUMO</strong><br>
<strong>CÓDIGO:</strong> <?php echo $kardex[0]['codinsumo']; ?><br>
<strong>DESCRIPCIÓN:</strong> <?php echo $kardex[0]['insumo']; ?></strong><br>
<strong>CATEGORIA:</strong> <?php echo $kardex[0]['nomcategoria']; ?><br>
<strong>TOTAL ENTRADAS:</strong> <?php echo $TotalEntradas; ?><br>
<strong>TOTAL SALIDAS:</strong> <?php echo $TotalSalidas; ?><br>
<strong>TOTAL DEVOLUCIÓN:</strong> <?php echo $TotalDevolucion; ?><br>
<strong>EXISTENCIA:</strong> <?php echo $kardex[0]['existencia']; ?><br>
<strong>PRECIO COMPRA:</strong> <?php echo $simbolo." ".$kardex[0]['preciocompra']; ?>

<?php
break;
############################# MODULO DE INSUMOS #############################











############################# MODULO DE PRODUCTOS #############################
case 'PRODUCTOS':

$tra = new Login();
$reg = $tra->ListarProductos();

$monedap = new Login();
$cambio = $monedap->MonedaProductoId(); 

$archivo = str_replace(" ", "_","LISTADO DE PRODUCTOS");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE PRODUCTO</th>
           <th>CATEGORIA</th>
           <th>PRECIO COMPRA</th>
           <th>PRECIO VENTA</th>
           <th>EXISTENCIA</th>
<?php if ($documento == "EXCEL") { ?>
           <th>STOCK MINIMO</th>
           <th>STOCK MÁXIMO</th>
<?php } ?>
           <th><?php echo $impuesto; ?></th>
           <th>DESC</th>
<?php if ($documento == "EXCEL") { ?>
           <th>CÓDIGO DE BARRA</th>
           <th>FECHA DE ELABORACIÓN</th>
           <th>FECHA DE EXPIRACIÓN</th>
           <th>PROVEEDOR</th>
           <th>LOTE</th>
<?php } ?>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalCompra=0;
$TotalVenta=0;
$TotalArticulos=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalCompra+=$reg[$i]['preciocompra'];
$TotalVenta+=$reg[$i]['precioventa']-$reg[$i]['descproducto']/100;
$TotalArticulos+=$reg[$i]['existencia'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codproducto']; ?></td>
           <td><?php echo $reg[$i]['producto']; ?></td>
           <td><?php echo $reg[$i]['nomcategoria']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['preciocompra'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['existencia']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['stockminimo'] == '0' ? "*********" : $reg[$i]['stockminimo']; ?></td>
           <td><?php echo $reg[$i]['stockmaximo'] == '0' ? "*********" : $reg[$i]['stockmaximo']; ?></td>
<?php } ?>
          <td><?php echo $reg[$i]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
          <td><?php echo $reg[$i]['descproducto']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['codigobarra'] == '' ? "*********" : $reg[$i]['codigobarra']; ?></td>
  <td><?php echo $reg[$i]['fechaelaboracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechaelaboracion'])); ?></td>
  <td><?php echo $reg[$i]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechaexpiracion'])); ?></td>
           <td><?php echo $reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['lote'] == '' || $reg[$i]['lote'] == '0' ? "*********" : $reg[$i]['lote']; ?></td>
<?php } ?>
         </tr>
        <?php } ?>
         <tr>
  <?php if ($documento == "EXCEL") { ?>
           <td colspan="4"></td>
  <?php } else { ?>
           <td colspan="4"></td>
  <?php } ?>
<td><?php echo $simbolo.number_format($TotalCompra, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalVenta, 2, '.', ','); ?></td>
<td><?php echo $TotalArticulos; ?></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } else { ?>
<td></td>
<td></td>
<?php } ?>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'KARDEXPRODUCTOS':

$kardex = new Login();
$kardex = $kardex->BuscarKardexProducto();  

$archivo = str_replace(" ", "_","KARDEX DEL PRODUCTO (".$kardex[0]['producto'].")");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>MOVIMIENTO</th>
           <th>ENTRADAS</th>
           <th>SALIDAS</th>
           <th>DEVOLUCIÓN</th>
           <th>EXISTENCIA</th>
           <th><?php echo $impuesto; ?></th>
           <th>DESCUENTO</th>
           <th>PRECIO</th>
           <th>DOCUMENTO</th>
           <th>FECHA KARDEX</th>
         </tr>
      <?php 

if($kardex==""){
echo "";      
} else {

$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
$a=1;
for($i=0;$i<sizeof($kardex);$i++){ 
$TotalEntradas+=$kardex[$i]['entradas'];
$TotalSalidas+=$kardex[$i]['salidas'];
$TotalDevolucion+=$kardex[$i]['devolucion'];
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $kardex[$i]['movimiento']; ?></td>
          <td><?php echo $kardex[$i]['entradas']; ?></td>
          <td><?php echo $kardex[$i]['salidas']; ?></td>
          <td><?php echo $kardex[$i]['devolucion']; ?></td>
          <td><?php echo $kardex[$i]['stockactual']; ?></td>
           <td><?php echo $kardex[$i]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
           <td><?php echo $kardex[$i]['descproducto']; ?></td>
           <td><?php echo $simbolo.number_format($kardex[$i]["precio"], 2, '.', ','); ?></td>
          <td><?php echo $kardex[$i]['documento']; ?></td>
          <td><?php echo date("d-m-Y",strtotime($kardex[$i]['fechakardex'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<strong>DETALLE DE PRODUCTO</strong><br>
<strong>CÓDIGO:</strong> <?php echo $kardex[0]['codproducto']; ?><br>
<strong>DESCRIPCIÓN:</strong> <?php echo $kardex[0]['producto']; ?></strong><br>
<strong>CATEGORIA:</strong> <?php echo $kardex[0]['nomcategoria']; ?><br>
<strong>TOTAL ENTRADAS:</strong> <?php echo $TotalEntradas; ?><br>
<strong>TOTAL SALIDAS:</strong> <?php echo $TotalSalidas; ?><br>
<strong>TOTAL DEVOLUCIÓN:</strong> <?php echo $TotalDevolucion; ?><br>
<strong>EXISTENCIA:</strong> <?php echo $kardex[0]['existencia']; ?><br>
<strong>PRECIO COMPRA:</strong> <?php echo $simbolo." ".$kardex[0]['preciocompra']; ?><br>
<strong>PRECIO VENTA:</strong> <?php echo $simbolo." ".$kardex[0]['precioventa']; ?>
<?php
break;


case 'PRODUCTOSVENDIDOS':

$tra = new Login();
$reg = $tra->BuscarProductosVendidos(); 

$archivo = str_replace(" ", "_","PRODUCTOS VENDIDOS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE PRODUCTO</th>
           <th>CATEGORIA</th>
           <th>DESC.</th>
           <th>PRECIO VENTA</th>
           <th>EXISTENCIA</th>
           <th>VENDIDO</th>
           <th>MONTO TOTAL</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$precioTotal=0;
$existeTotal=0;
$vendidosTotal=0;
$pagoTotal=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){
$precioTotal+=$reg[$i]['precioventa'];
$existeTotal+=$reg[$i]['existencia'];
$vendidosTotal+=$reg[$i]['cantidad']; 

$Descuento = $reg[$i]['descproducto']/100;
$PrecioDescuento = $reg[$i]['precioventa']*$Descuento;
$PrecioFinal = $reg[$i]['precioventa']-$PrecioDescuento;
$pagoTotal+=$PrecioFinal*$reg[$i]['cantidad'];
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['codproducto']; ?></td>
          <td><?php echo $reg[$i]['producto']; ?></td>
          <td><?php echo $reg[$i]['nomcategoria']; ?></td>
          <td><?php echo $reg[$i]['descproducto']; ?>%</td>
          <td><?php echo $simbolo.number_format($reg[$i]["precioventa"], 2, '.', ','); ?></td>
          <td><?php echo $reg[$i]['existencia']; ?></td>
          <td><?php echo $reg[$i]['cantidad']; ?></td>
          <td><?php echo $simbolo.number_format($PrecioFinal*$reg[$i]['cantidad'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="5"></td>
<td><?php echo $simbolo.number_format($precioTotal, 2, '.', ','); ?></td>
<td><?php echo $existeTotal; ?></strong></td>
<td><?php echo $vendidosTotal; ?></strong></td>
<td><?php echo $simbolo.number_format($pagoTotal, 2, '.', ','); ?></td>
         </tr>
</table>
<?php
break;

case 'PRODUCTOSXMONEDA':

$cambio = new Login();
$cambio = $cambio->BuscarTiposCambios();

$tra = new Login();
$reg = $tra->ListarProductos(); 

$archivo = str_replace(" ", "_","LISTADO DE PRODUCTOS POR (MONEDA ".$cambio[0]['moneda'].")");
header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE PRODUCTO</th>
           <th>CATEGORIA</th>
           <th>PRECIO VENTA</th>
           <th>PRECIO <?php echo $cambio[0]['siglas']; ?></th>
           <th>EXISTENCIA</th>
<?php if ($documento == "EXCEL") { ?>
           <th>STOCK MINIMO</th>
           <th>STOCK MÁXIMO</th>
<?php } ?>
           <th><?php echo $impuesto; ?></th>
           <th>DESCUENTO</th>
<?php if ($documento == "EXCEL") { ?>
           <th>CÓDIGO DE BARRA</th>
           <th>FECHA DE ELABORACIÓN</th>
           <th>FECHA DE EXPIRACIÓN</th>
           <th>PROVEEDOR</th>
           <th>LOTE</th>
<?php } ?>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codproducto']; ?></td>
           <td><?php echo $reg[$i]['producto']; ?></td>
           <td><?php echo $reg[$i]['nomcategoria']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
           <td><?php echo $cambio[0]['simbolo'].number_format($reg[$i]['precioventa']/$cambio[0]['montocambio'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['existencia']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['stockminimo'] == '0' ? "*********" : $reg[$i]['stockminimo']; ?></td>
           <td><?php echo $reg[$i]['stockmaximo'] == '0' ? "*********" : $reg[$i]['stockmaximo']; ?></td>
<?php } ?>
          <td><?php echo $reg[$i]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
          <td><?php echo $reg[$i]['descproducto']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['codigobarra'] == '' ? "*********" : $reg[$i]['codigobarra']; ?></td>
  <td><?php echo $reg[$i]['fechaelaboracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechaelaboracion'])); ?></td>
  <td><?php echo $reg[$i]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechaexpiracion'])); ?></td>
           <td><?php echo $reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['lote'] == '' ? "*********" : $reg[$i]['lote']; ?></td>
<?php } ?>
         </tr>
        <?php } } ?>
</table>
<?php
break;
############################# MODULO DE PRODUCTOS #############################














################################### MODULO DE COMPRAS ###################################

case 'COMPRAS':

$tra = new Login();
$reg = $tra->ListarCompras(); 

$archivo = str_replace(" ", "_","LISTADO DE COMPRAS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE COMPRA</th>
           <th>DESCRIPCIÓN DE PROVEEDOR</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasic'];
$TotalExento+=$reg[$i]['subtotalivanoc'];
$TotalImporte+=$reg[$i]['totalpagoc'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php echo $reg[$i]['cuitproveedor'].": ".$reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuscompra"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuscompra"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuscompra"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
      
      <td><?php echo $reg[$i]['statuscompra'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuscompra']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
         </tr>
        <?php } ?>
         <tr align="center">
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></strong></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'CUENTASXPAGAR':

$tra = new Login();
$reg = $tra->ListarCuentasxPagar(); 

$archivo = str_replace(" ", "_","LISTADO DE COMPRAS POR PAGAR");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE COMPRA</th>
           <th>DESCRIPCIÓN DE PROVEEDOR</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasic'];
$TotalExento+=$reg[$i]['subtotalivanoc'];
$TotalImporte+=$reg[$i]['totalpagoc'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php echo $reg[$i]['cuitproveedor'].": ".$reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuscompra"]; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo $reg[$i]["statuscompra"]; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "VENCIDA"; } ?></td>
<td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); } ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
         </tr>
        <?php } ?>
         <tr align="center">
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></strong></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<td></td>
<td></td>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'COMPRASXPROVEEDOR':

$tra = new Login();
$reg = $tra->BuscarComprasxProveedor(); 

$archivo = str_replace(" ", "_","LISTADO DE COMPRAS DEL PROVEEDOR ".$reg[0]['cuitproveedor'].": ".$reg[0]['nomproveedor'].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE COMPRA</th>
           <th>DESCRIPCIÓN DE PROVEEDOR</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasic'];
$TotalExento+=$reg[$i]['subtotalivanoc'];
$TotalImporte+=$reg[$i]['totalpagoc'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php echo $reg[$i]['cuitproveedor'].": ".$reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuscompra"]; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo $reg[$i]["statuscompra"]; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "VENCIDA"; } ?></td>
<td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); } ?></td>
           <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
         </tr>
        <?php } ?>
         <tr align="center">
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></strong></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<td></td>
<td></td>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;


case 'COMPRASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarComprasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE COMPRAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])));

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE COMPRA</th>
           <th>DESCRIPCIÓN DE PROVEEDOR</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasic'];
$TotalExento+=$reg[$i]['subtotalivanoc'];
$TotalImporte+=$reg[$i]['totalpagoc'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php echo $reg[$i]['cuitproveedor'].": ".$reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuscompra"]; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo $reg[$i]["statuscompra"]; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "VENCIDA"; } ?></td>
<td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); } ?></td>
           <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
         </tr>
        <?php } ?>
         <tr align="center">
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></strong></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<td></td>
<td></td>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

################################## MODULO DE COMPRAS ###################################

















############################# MODULO DE CAJAS #############################
case 'CAJAS':

$tra = new Login();
$reg = $tra->ListarCajas(); 

$archivo = str_replace(" ", "_","LISTADO DE CAJAS ASIGNADAS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE CAJA</th>
           <th>NOMBRE DE CAJA</th>
           <th>RESPONSABLE</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nrocaja']; ?></td>
           <td><?php echo $reg[$i]['nomcaja']; ?></td>
           <td><?php echo $reg[$i]['dni'].": ".$reg[$i]['nombres']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'ARQUEOS':

$tra = new Login();
$reg = $tra->ListarArqueoCaja(); 

$archivo = str_replace(" ", "_","LISTADO DE ARQUEOS DE CAJAS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE CAJA</th>
<?php if ($documento == "EXCEL") { ?>
           <th>RESPONSABLE</th>
           <th>APERTURA</th>
           <th>CIERRE</th>
           <th>OBSERVACIONES</th>
<?php } ?>
           <th>INICIAL</th>
           <th>INGRESOS</th>
           <th>EGRESOS</th>
           <th>CRÉDITOS</th>
           <th>ABONOS</th>
           <th>TOTAL COBRO</th>
           <th>TOTAL INGRESOS</th>
           <th>DINERO EFECTIVO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['dni'].": ".$reg[$i]['nombres']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura'])); ?></td>
           <td><?php echo $reg[$i]['fechacierre'] == '0000-00-00 00:00:00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechacierre'])); ?></td>
           <td><?php echo $reg[$i]['comentarios'] == '' ? "*********" : $reg[$i]['comentarios']; ?></td>
<?php } ?>
            <td><?php echo $simbolo.number_format($reg[$i]['montoinicial'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['ingresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['egresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['creditos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['abonos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['ingresos']+$reg[$i]['creditos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']+$reg[$i]['abonos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['dineroefectivo'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;


case 'MOVIMIENTOS':

$tra = new Login();
$reg = $tra->ListarMovimientos(); 

$archivo = str_replace(" ", "_","LISTADO DE MOVIMIENTOS DE CAJAS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE CAJA</th>
           <th>RESPONSABLE</th>
           <th>DESCRIPCIÓN</th>
           <th>TIPO</th>
           <th>MONTO</th>
           <th>MEDIO</th>
           <th>FECHA MOVIMIENTO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
           <td><?php echo $reg[$i]['dni'].": ".$reg[$i]['nombres']; ?></td>
           <td><?php echo $reg[$i]['descripcionmovimiento']; ?></td>
           <td><?php echo $reg[$i]['tipomovimiento']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['montomovimiento'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['mediopago']; ?></td>
           <td><?php echo $reg[$i]['fechamovimiento']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'ARQUEOSXFECHAS':

$tra = new Login();
$reg = $tra->BuscarArqueosxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE ARQUEOS EN (CAJA ".$reg[0]['nrocaja'].": ".$reg[0]['nomcaja']." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRE DE CAJA</th>
<?php if ($documento == "EXCEL") { ?>
           <th>RESPONSABLE</th>
           <th>APERTURA</th>
           <th>CIERRE</th>
           <th>OBSERVACIONES</th>
<?php } ?>
           <th>INICIAL</th>
           <th>INGRESOS</th>
           <th>EGRESOS</th>
           <th>CRÉDITOS</th>
           <th>ABONOS</th>
           <th>TOTAL COBRO</th>
           <th>TOTAL INGRESOS</th>
           <th>DINERO EFECTIVO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
<?php if ($documento == "EXCEL") { ?>
           <td><?php echo $reg[$i]['dni'].": ".$reg[$i]['nombres']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura'])); ?></td>
           <td><?php echo $reg[$i]['fechacierre'] == '0000-00-00 00:00:00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechacierre'])); ?></td>
           <td><?php echo $reg[$i]['comentarios'] == '' ? "*********" : $reg[$i]['comentarios']; ?></td>
<?php } ?>
            <td><?php echo $simbolo.number_format($reg[$i]['montoinicial'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['ingresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['egresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['creditos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['abonos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['ingresos']+$reg[$i]['creditos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']+$reg[$i]['abonos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['dineroefectivo'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'MOVIMIENTOSXFECHAS':

$tra = new Login();
$reg = $tra->BuscarMovimientosxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE MOVIMIENTOS EN (CAJA ".$reg[0]['nrocaja'].": ".$reg[0]['nomcaja']." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>RESPONSABLE</th>
           <th>DESCRIPCIÓN</th>
           <th>TIPO</th>
           <th>MONTO</th>
           <th>MEDIO</th>
           <th>FECHA MOVIMIENTO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['dni'].": ".$reg[$i]['nombres']; ?></td>
           <td><?php echo $reg[$i]['descripcionmovimiento']; ?></td>
           <td><?php echo $reg[$i]['tipomovimiento']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['montomovimiento'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['mediopago']; ?></td>
           <td><?php echo $reg[$i]['fechamovimiento']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

############################# MODULO DE CAJAS #############################












############################# MODULO DE RESERVACIONES #############################

case 'RESERVACIONES':

$tra = new Login();
$reg = $tra->ListarReservaciones(); 

$archivo = str_replace(" ", "_","LISTADO DE RESERVACIONES");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>HABITACIONES</th>
           <th>FECHA ENTRADA</th>
           <th>FECHA SALIDA</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>SUBTOTAL</th>
           <th>DESCUENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <th>RESERVACIÓN</th>
           <th>OBSERVACIONES</th>
           <?php } ?>
           <th>FECHA DE REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$Subtotal=0;
$Descuento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$Subtotal+=$reg[$i]['subtotal'];
$Descuento+=$reg[$i]['descuento'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['habitaciones']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['descuento'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <td> <?php echo $reg[$i]['reservacion']; ?></td>

        <td><?php echo $reg[$i]['observaciones'] == '0' ? "**********" : $reg[$i]['observaciones']; ?></td>
      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
<td colspan="6"></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($Subtotal, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($Descuento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'RESERVACIONESXCAJAS':

$tra = new Login();
$reg = $tra->BuscarReservacionesxCajas(); 

$archivo = str_replace(" ", "_","LISTADO DE RESERVACIONES EN (CAJA Nº: ".$reg[0]["nrocaja"].": ".$reg[0]["nomcaja"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>HABITACIONES</th>
           <th>FECHA ENTRADA</th>
           <th>FECHA SALIDA</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>SUBTOTAL</th>
           <th>DESCUENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <th>RESERVACIÓN</th>
           <th>OBSERVACIONES</th>
           <?php } ?>
           <th>FECHA DE REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$Subtotal=0;
$Descuento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$Subtotal+=$reg[$i]['subtotal'];
$Descuento+=$reg[$i]['descuento'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['habitaciones']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['descuento'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <td> <?php echo $reg[$i]['reservacion']; ?></td>

        <td><?php echo $reg[$i]['observaciones'] == '0' ? "**********" : $reg[$i]['observaciones']; ?></td>
      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
<td colspan="6"></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($Subtotal, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($Descuento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'RESERVACIONESXFECHAS':

$tra = new Login();
$reg = $tra->BuscarReservacionesxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE RESERVACIONES POR FECHAS DE (ENTRADA ".date("d-m-Y", strtotime($_GET["desde"]))." SALIDA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>HABITACIONES</th>
           <th>FECHA ENTRADA</th>
           <th>FECHA SALIDA</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>SUBTOTAL</th>
           <th>DESCUENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <th>RESERVACIÓN</th>
           <th>OBSERVACIONES</th>
           <?php } ?>
           <th>FECHA DE REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$Subtotal=0;
$Descuento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$Subtotal+=$reg[$i]['subtotal'];
$Descuento+=$reg[$i]['descuento'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['habitaciones']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['descuento'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <td> <?php echo $reg[$i]['reservacion']; ?></td>

        <td><?php echo $reg[$i]['observaciones'] == '0' ? "**********" : $reg[$i]['observaciones']; ?></td>
      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
<td colspan="6"></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($Subtotal, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($Descuento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'RESERVACIONESXCLIENTES':

$tra = new Login();
$reg = $tra->BuscarReservacionesxClientes(); 

$archivo = str_replace(" ", "_","LISTADO DE RESERVACIONES DEL (CLIENTE: ".$reg[0]["dnicliente"].": ".$reg[0]["nomcliente"].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>HABITACIONES</th>
           <th>FECHA ENTRADA</th>
           <th>FECHA SALIDA</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>SUBTOTAL</th>
           <th>DESCUENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <th>RESERVACIÓN</th>
           <th>OBSERVACIONES</th>
           <?php } ?>
           <th>FECHA DE REGISTRO</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$Subtotal=0;
$Descuento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$Subtotal+=$reg[$i]['subtotal'];
$Descuento+=$reg[$i]['descuento'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $reg[$i]['habitaciones']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['descuento'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?></td>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <td> <?php echo $reg[$i]['reservacion']; ?></td>

        <td><?php echo $reg[$i]['observaciones'] == '0' ? "**********" : $reg[$i]['observaciones']; ?></td>
      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
<td colspan="5"></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($Subtotal, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($Descuento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

############################# MODULO DE RESERVACIONES #############################










############################# MODULO DE VENTAS #############################

case 'VENTAS':

$tra = new Login();
$reg = $tra->ListarVentas(); 

$archivo = str_replace(" ", "_","LISTADO DE VENTAS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE VENTA</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasi'];
$TotalExento+=$reg[$i]['subtotalivano'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statusventa"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statusventa'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statusventa']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></strong></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'VENTASXCAJAS':

$tra = new Login();
$reg = $tra->BuscarVentasxCajas(); 

$archivo = str_replace(" ", "_","LISTADO DE VENTAS EN (CAJA Nº: ".$reg[0]["nrocaja"].": ".$reg[0]["nomcaja"]." DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE VENTA</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasi'];
$TotalExento+=$reg[$i]['subtotalivano'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statusventa"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statusventa'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statusventa']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></strong></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
</table>
<?php
break;

case 'VENTASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarVentasxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE VENTAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE VENTA</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>Nº DE ARTICULOS</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>TOTAL GRAVADO</th>
           <th>TOTAL EXENTO</th>
           <?php } ?>
           <th>IMPORTE TOTAL</th>
           <th>TIPO DE PAGO</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalGravado=0;
$TotalExento=0;
$TotalImporte=0;

for($i=0;$i<sizeof($reg);$i++){ 
   
$TotalArticulos+=$reg[$i]['articulos'];
$TotalGravado+=$reg[$i]['subtotalivasi'];
$TotalExento+=$reg[$i]['subtotalivano'];
$TotalImporte+=$reg[$i]['totalpago'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ','); ?></td>
           <?php } ?>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]['tipopago']; ?></td>
           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statusventa"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statusventa'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statusventa']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $TotalArticulos; ?></td>
           <?php if ($documento == "EXCEL") { ?>
<td><?php echo $simbolo.number_format($TotalGravado, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalExento, 2, '.', ','); ?></td>
           <?php } ?>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<td></td>
<?php } ?>
<td></td>
         </tr>
</table>
<?php
break;

case 'DETALLESVENTASXFECHAS':

$tra = new Login();
$reg = $tra->BuscarDetallesVentasxFechas(); 

$archivo = str_replace(" ", "_","DETALLLES DE VENTAS POR FECHAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE PRODUCTO</th>
           <th>CATEGORIA</th>
           <th><?php echo $impuesto; ?></th>
           <th>PRECIO COMPRA</th>
           <th>PRECIO VENTA</th>
           <th>EXISTENCIA</th>
           <th>VENDIDO</th>
           <th>TOTAL VENTA</th>
           <th>TOTAL COMPRA</th>
           <th>GANANCIAS</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {

$PrecioCompra=0;
$PrecioVenta=0;
$ExisteTotal=0;
$VendidosTotal=0;
$CompraTotal=0;
$VentaTotal=0;
$TotalGanancia=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$PrecioCompra+=$reg[$i]['preciocompra'];
$PrecioVenta+=$reg[$i]['precioventa'];
$ExisteTotal+=$reg[$i]['existencia'];
$VendidosTotal+=$reg[$i]['cantidad']; 

$Descuento = $reg[$i]['descproducto']/100;
$PrecioDescuento = $reg[$i]['precioventa']*$Descuento;
$PrecioFinal = $reg[$i]['precioventa']-$PrecioDescuento;

$CompraTotal+=$reg[$i]['preciocompra']*$reg[$i]['cantidad'];
$VentaTotal+=$PrecioFinal*$reg[$i]['cantidad'];

$SumVenta = $PrecioFinal*$reg[$i]['cantidad']; 
$SumCompra = $reg[$i]['preciocompra']*$reg[$i]['cantidad'];
$TotalGanancia+=$SumVenta-$SumCompra;
?>
         <tr class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['codproducto']; ?></td>
          <td><?php echo $reg[$i]['producto']; ?></td>
          <td><?php echo $reg[$i]['codcategoria'] == '0' ? "*****" : $reg[$i]['nomcategoria']; ?></td>
          <td><?php echo $reg[$i]['ivaproducto'] == 'SI' ? number_format($valor, 2, '.', ',')."%" : "(E)"; ?></td>
          <td><?php echo $simbolo.number_format($reg[$i]["preciocompra"], 2, '.', ','); ?></td>
          <td><?php echo $simbolo.number_format($reg[$i]["precioventa"], 2, '.', ','); ?></td>
          <td><?php echo $reg[$i]['existencia']; ?></td>
          <td><?php echo $reg[$i]['cantidad']; ?></td>
          <td><?php echo $simbolo.number_format($PrecioFinal*$reg[$i]['cantidad'], 2, '.', ','); ?></td>
          <td><?php echo $simbolo.number_format($reg[$i]['preciocompra']*$reg[$i]['cantidad'], 2, '.', ','); ?></td>
          <td><?php echo $simbolo.number_format($SumVenta-$SumCompra, 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="5"></td>
<td><strong><?php echo $simbolo.number_format($PrecioCompra, 2, '.', ','); ?></strong></td>
<td><strong><?php echo $simbolo.number_format($PrecioVenta, 2, '.', ','); ?></strong></td>
<td><strong><?php echo $ExisteTotal; ?></strong></td>
<td><strong><?php echo $VendidosTotal; ?></strong></td>
<td><strong><?php echo $simbolo.number_format($VentaTotal, 2, '.', ','); ?></strong></td>
<td><strong><?php echo $simbolo.number_format($CompraTotal, 2, '.', ','); ?></strong></td>
<td><strong><?php echo $simbolo.number_format($TotalGanancia, 2, '.', ','); ?></strong></td>
         </tr>
</table>
<?php
break;
############################# MODULO DE VENTAS #############################












############################# MODULO DE CREDITOS #############################

case 'CREDITOSXRESERVACIONES':

$tra = new Login();
$reg = $tra->ListarCreditosReservaciones(); 

$archivo = str_replace(" ", "_","LISTADO DE CREDITOS EN RESERVACIONES");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>IMPORTE TOTAL</th>
           <th>TOTAL ABONO</th>
           <th>TOTAL DEBE</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalImporte=0;
$TotalAbono=0;
$TotalDebe=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalImporte+=$reg[$i]['totalpago'];
$TotalAbono+=$reg[$i]['abonototal'];
$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalAbono, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalDebe, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
         </tr>
        <?php } ?>
</table>
<?php
break;


case 'CREDITOSXVENTAS':

$tra = new Login();
$reg = $tra->ListarCreditosVentas(); 

$archivo = str_replace(" ", "_","LISTADO DE CREDITOS EN VENTAS");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE VENTA</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>IMPORTE TOTAL</th>
           <th>TOTAL ABONO</th>
           <th>TOTAL DEBE</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalImporte=0;
$TotalAbono=0;
$TotalDebe=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalImporte+=$reg[$i]['totalpago'];
$TotalAbono+=$reg[$i]['abonototal'];
$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statusventa"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statusventa'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statusventa']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
         </tr>
        <?php } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalAbono, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalDebe, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
         </tr>
        <?php } ?>
</table>
<?php
break;

case 'CREDITOSXCLIENTES':

if(decrypt($_GET["url"])==1){

$tra = new Login();
$reg = $tra->BuscarCreditosxClientes(); 

$archivo = str_replace(" ", "_","LISTADO DE CREDITOS EN RESERVACIONES DEL (CLIENTE: ".$reg[0]["dnicliente"].": ".$reg[0]["nomcliente"].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>IMPORTE TOTAL</th>
           <th>TOTAL ABONO</th>
           <th>TOTAL DEBE</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalImporte=0;
$TotalAbono=0;
$TotalDebe=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalImporte+=$reg[$i]['totalpago'];
$TotalAbono+=$reg[$i]['abonototal'];
$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="2"></td>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalAbono, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalDebe, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
         </tr>
</table>

<?php

} else {

$tra = new Login();
$reg = $tra->BuscarCreditosxClientes(); 

$archivo = str_replace(" ", "_","LISTADO DE CREDITOS EN RESERVACIONES DEL (CLIENTE: ".$reg[0]["dnicliente"].": ".$reg[0]["nomcliente"].")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE VENTA</th>
           <th>IMPORTE TOTAL</th>
           <th>TOTAL ABONO</th>
           <th>TOTAL DEBE</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalImporte=0;
$TotalAbono=0;
$TotalDebe=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalImporte+=$reg[$i]['totalpago'];
$TotalAbono+=$reg[$i]['abonototal'];
$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statusventa"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statusventa'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statusventa']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="2"></td>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalAbono, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalDebe, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
         </tr>
</table>
<?php
}
break;

case 'CREDITOSXFECHAS':

if(decrypt($_GET["url"])==1){

$tra = new Login();
$reg = $tra->BuscarCreditosxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE CREDITOS EN RESERVACIONES (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE RESERVACIÓN</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>IMPORTE TOTAL</th>
           <th>TOTAL ABONO</th>
           <th>TOTAL DEBE</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalImporte=0;
$TotalAbono=0;
$TotalDebe=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalImporte+=$reg[$i]['totalpago'];
$TotalAbono+=$reg[$i]['abonototal'];
$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codreservacion']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statuspago"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statuspago"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statuspago'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statuspago']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalAbono, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalDebe, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
  </tr>
</table>

<?php

} else {

$tra = new Login();
$reg = $tra->BuscarCreditosxFechas(); 

$archivo = str_replace(" ", "_","LISTADO DE CREDITOS EN VENTAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")");

header("Content-Type: application/vnd.ms-$documento"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$archivo.$extension);

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE VENTA</th>
           <th>DESCRIPCIÓN DE CLIENTE</th>
           <th>IMPORTE TOTAL</th>
           <th>TOTAL ABONO</th>
           <th>TOTAL DEBE</th>
           <?php if ($documento == "EXCEL") { ?>
           <th>STATUS</th>
           <th>DIAS VENC.</th>
           <th>FECHA VENCE</th>
           <th>FECHA PAGADO</th>
           <?php } ?>
           <th>FECHA DE EMISIÓN</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1;
$TotalArticulos=0;
$TotalImporte=0;
$TotalAbono=0;
$TotalDebe=0;

for($i=0;$i<sizeof($reg);$i++){ 

$TotalImporte+=$reg[$i]['totalpago'];
$TotalAbono+=$reg[$i]['abonototal'];
$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];
?>
         <tr class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['dnicliente'].": ".$reg[$i]['nomcliente']; ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>

           <?php if ($documento == "EXCEL") { ?>
           <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo $reg[$i]["statusventa"]; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "VENCIDA"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo $reg[$i]["statusventa"]; } ?></td>

      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

      <td><?php echo $reg[$i]['fechavencecredito'] == '0000-00-00' ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito'])); ?>
      
      <td><?php echo $reg[$i]['statusventa'] == 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" || $reg[$i]['statusventa']!= 'PAGADA' && $reg[$i]['fechapagado']== "0000-00-00" ? "*****" :  date("d-m-Y",strtotime($reg[$i]['fechapagado'])); ?></td>

      <?php } ?>
           
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
         </tr>
        <?php } } ?>
         <tr>
           <td colspan="3"></td>
<td><?php echo $simbolo.number_format($TotalImporte, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalAbono, 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($TotalDebe, 2, '.', ','); ?></td>
<td></td>
<?php if ($documento == "EXCEL") { ?>
<td></td>
<td></td>
<td></td>
<?php } ?>
  </tr>
</table>
<?php
}
break;

############################# MODULO DE CREDITOS #############################



}
 
?>


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