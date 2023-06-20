<?php
require_once("class/class.php");
?>

<?php
$imp = new Login();
$imp = $imp->ImpuestosPorId();
$impuesto = ($imp == "" ? "Impuesto" : $imp[0]['nomimpuesto']);
$valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

$con = new Login();
$con = $con->ConfiguracionPorId();
$desc_ventas = ($con == "" ? "0.00" : number_format($con[0]['dsctov'], 2, '.', ','));
$simbolo = ($con == "" ? "" : "<strong>".$con[0]['simbolo']."</strong>");

$new = new Login();
?>

<?php
######################## MOSTRAR MENSAJE DE CONTACTO EN VENTANA MODAL ############################
if (isset($_GET['BuscaMensajeModal']) && isset($_GET['codmensaje'])) { 
$reg = $new->ContactPorId();
?>

  <table class="table-responsive" border="0">
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['name']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['phone'] == '' ? "***********" : $reg[0]['phone']; ?></td>
  </tr>
  <tr>
    <td><strong>Email: </strong> <?php echo $reg[0]['email']; ?></td>
  </tr> 
  <tr>
    <td><strong>Asunto: </strong> <?php echo $reg[0]['subject']; ?></td>
  </tr>
  <tr>
    <td><strong>Mensaje: </strong> <?php echo $reg[0]['message']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha: </strong> <?php echo date("d-m-Y H:i:s",strtotime($reg[0]["fecha"])); ?></td>
  </tr>
</table>  

  <?php
   } 
######################## MOSTRAR MENSAJE DE CONTACTO EN VENTANA MODAL ############################
?>


<?php
########################### MOSTRAR USUARIO EN VENTANA MODAL ###########################
if (isset($_GET['BuscaUsuarioModal']) && isset($_GET['codigo'])) { 
$reg = $new->UsuariosPorId();
?>

  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Nº de Documento:</strong> <?php echo $reg[0]['dni']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>Sexo:</strong> <?php echo $reg[0]['sexo']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria: </strong> <?php echo $reg[0]['direccion']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['telefono']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['email']; ?></td>
  </tr>
  <tr>
    <td><strong>Usuario de Acceso: </strong> <?php echo $reg[0]['usuario']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel de Acceso: </strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
   <td><strong>Status de Acceso: </strong> <?php echo $status = ( $reg[0]['status'] == 1 ? "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='badge badge-pill badge-warning'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
  </tr>
</table>  

  <?php
   } 
########################### MOSTRAR USUARIO EN VENTANA MODAL ############################
?>



<?php
########################### MOSTRAR NOTICIAS EN VENTANA MODAL###########################
if (isset($_GET['BuscaNoticiaModal']) && isset($_GET['codnoticia'])) { 

$reg = $new->NoticiasPorId();

  ?>

  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Publicado Por:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>Titulo:</strong> <?php echo $reg[0]['titulonoticia']; ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Noticia:</strong> <?php echo $reg[0]['descripcnoticia']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha Publicado:</strong> <?php echo $reg[0]['statusnoticia'] == 'NO PUBLICADA' ? "*********" : date("d-m-Y h:i:s",strtotime($reg[0]['publicado'])); ?></td>
  </tr>
  <tr>
    <td><strong>Status de Noticia:</strong> <?php echo $status = ( $reg[0]['statusnoticia'] == 'PUBLICADA' ? "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[0]['statusnoticia']."</span>" : "<span class='badge badge-pill badge-dark'><i class='fa fa-times'></i> ".$reg[0]['statusnoticia']."</span>"); ?></td>
  </tr>
</table>
  
  <?php
   } 
########################### MOSTRAR NOTICIAS EN VENTANA MODAL ###########################
?>
























<?php 
########################### RECARGAR IMAGENES DE HABITACION ###########################
if (isset($_GET['RecargaImg']) && isset($_GET['h'])) { ?> 

       <div class="row">

                    <?php
                    $directory="fotos/habitaciones/".$_GET['h'];
                    if (is_dir($directory)) {
                        $dirint = dir($directory);
                        while (($archivo = $dirint->read()) !== false){

                if ($archivo != "." && $archivo != ".." && substr_count($archivo , ".jpg")==1 || substr_count($archivo , ".JPG")==1 ){ ?>

                        <div class="col-md-3">
                            <div class="gal-detail thumb">
                                <a href="<?php echo $directory."/".$archivo; ?>" title="<?php echo "Foto N° #".$archivo; ?>" class="image-popup" title="Screenshot-1">
                                <img src="<?php echo $directory."/".$archivo; ?>" class="thumb-img" height="140" width="240"></a>
                            </div>
                        </div>
                    <?php }
                        }
                    $dirint->close();
                    } else { } ?>
        </div>
<?php
  }
######################## RECARGAR IMAGENES DE HABITACION #########################
?>

<?php
######################## MOSTRAR HABITACION EN VENTANA MODAL #########################
if (isset($_GET['BuscaHabitacionModal']) && isset($_GET['h'])) { 
$reg = $new->HabitacionesPorId();
?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código de Habitación:</strong> <?php echo $reg[0]['codhabitacion']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Habitación:</strong> <?php echo $reg[0]['numhabitacion']; ?></td>
  </tr>
  <tr>
    <td><strong>Tipo de Habitación:</strong> <?php echo $reg[0]['nomtipo']; ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Habitación: </strong> <?php echo $reg[0]['descriphabitacion']; ?></td>
  </tr>
  <tr>
    <td><strong>Piso de Habitación:</strong> <?php echo $reg[0]['piso']; ?></td>
  </tr>
  <tr>
    <td><strong>Vista de Habitación:</strong> <?php echo $reg[0]['vista']; ?></td>
  </tr>
  <tr>
    <td><strong>N° Máximo de Adultos: </strong> <?php echo $reg[0]['maxadultos']; ?></td>
  </tr>
  <tr>
    <td><strong>N° Máximo de Niños: </strong> <?php echo $reg[0]['maxninos']; ?></td>
  </tr>
  <tr>
    <td><strong>Descuento: </strong> <?php echo $reg[0]['deschabitacion']."%"; ?></td>
  </tr> 
  <tr>
    <td><strong>Costo por Temporadas: </strong> <?php echo "<strong>Baja</strong> $".$reg[0]['baja']." <strong>Media</strong> $".$reg[0]['media']." <strong>Alta</strong> $".$reg[0]['alta']; ?></td>
  </tr>
  <tr>
<td><strong>Status de Habitación: </strong> <?php echo $habitacion = ( $reg[0]['statushab'] == 0 ? "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> DISPONIBLE</span>" : "<span class='badge badge-pill badge-dark'><i class='fa fa-times'></i> EN MANTENIMIENTO</span>"); ?></td>
  </tr>
</table><br>

<div id="div3"><table id="datatable" class="table datatable-scroller table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>Temporada</th>
                                                    <th>Desde</th>
                                                    <th>Hasta</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$temp = new Login();
$temp = $temp->ListarTemporadas();

if($temp==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TEMPORADAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($temp);$i++){ 
?>
                                <tr role="row" class="odd">
                          <td><?php echo $temp[$i]['temporada']; ?></td>
                          <td><?php echo date("d-m-Y",strtotime($temp[$i]['desde'])); ?></td>
                          <td><?php echo date("d-m-Y",strtotime($temp[$i]['hasta'])); ?></td>
                                </tr>
                                    <?php } } ?>
                                </tbody>
                        </table></div>

<!--<table id="datatable" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>Temporada</th>
                                                    <th>Meses de Temporada</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$temp = new Login();
$temp = $temp->TemporadasAgrupadas();

if($temp==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TEMPORADAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($temp);$i++){ 
?>
                                <tr role="row" class="odd">
                                <td>
                                <?php if($temp[$i]['temporada']=="BAJA"){ 
                                echo "<strong>".$temp[$i]['temporada']."</strong><br>(".$simbolo.$reg[0]['baja'].")"; 
                                }elseif($temp[$i]['temporada']=="MEDIA"){ 
                                echo "<strong>".$temp[$i]['temporada']."</strong><br>(".$simbolo.$reg[0]['media'].")"; 
                                }else{ 
                            echo "<strong>".$temp[$i]['temporada']."</strong><br>(".$simbolo.$reg[0]['alta'].")"; } ?></td>
                                <td><?php echo convertir($temp[$i]['meses']); ?></td>
                                </tr>
                                    <?php } } ?>
                                </tbody>
                        </table>-->

  <?php
   } 
######################### MOSTRAR HABITACION EN VENTANA MODAL #########################
?>






















<?php 
########################### MUESTRA DIV CLIENTE ###########################
if (isset($_GET['BuscaDivCliente'])) {
  
  ?>
<div class="row">
      <div class="col-md-12">
<font color="red"><strong> Para poder realizar la Carga Masiva de Clientes, el archivo Excel, debe estar estructurado de 10 columnas, la cuales tendrán las siguientes especificaciones:</strong></font><br>

  1. Código de Cliente. (Ejemplo: C1, C2, C3, C4, C5......)<br>
  2. Tipo de Documento. (Debera de Ingresar el Codigo de Documento a la que corresponde)<br>
  3. Nº de Documento.<br>
  4. Nombre de Cliente (Ingresar Nombre completo con Apellidos).<br>
  5. Pais. (Este campo podria estar en blanco, y despues actualizarlo desde el sistema)<br>
  6. Ciudad. (Este campo podria estar en blanco, y despues actualizarlo desde el sistema)<br>
  7. Dirección Domiciliaria.<br>
  8. Nº de Teléfono. (Formato: (9999) 9999999).<br>
  9. Correo Electronico.<br>
  10. Monto de Crédito en Ventas.<br><br>

  <font color="red"><strong> NOTA:</strong></font><br>
  a) El Archivo no debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Todos los datos deberán escribirse en mayúscula para mejor orden y visibilidad en los reportes.<br>
  d) Deben de tener en cuenta que la carga masiva de Clientes, deben de ser cargados como se explica, para evitar problemas de datos del cliente dentro del Sistema.<br><br>
   </div>
</div>                               
<?php 
  }
############################# MUESTRA DIV CLIENTE #############################
?>

<?php
############################ MOSTRAR CLIENTE EN VENTANA MODAL ###########################
if (isset($_GET['BuscaClienteModal']) && isset($_GET['codcliente'])) { 
$reg = $new->ClientesPorId();
?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['documcliente'] == '0' ? "Documento" : $reg[0]['documento'] ?>:</strong> <?php echo $reg[0]['dnicliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres y Apellidos:</strong> <?php echo $reg[0]['nomcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['telefcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Pais:</strong> <?php echo paises($reg[0]['paiscliente']); ?></td>
  </tr>
  <tr>
    <td><strong>Ciudad:</strong> <?php echo $reg[0]['ciudadcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección Domiciliaria: </strong> <?php echo $reg[0]['direccliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['correocliente'] == '' ? "*********" : $reg[0]['correocliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Limite de Crédito: </strong> <?php echo $reg[0]['limitecredito']; ?></td>
  </tr> 
  <tr>
    <td><strong>Fecha de Ingreso: </strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechaingreso'])); ?></td>
  </tr>
</table>

  <?php
   } 
########################### MOSTRAR CLIENTE EN VENTANA MODAL ###########################
?>
















<?php 
############################# MUESTRA DIV PROVEEDOR #############################
if (isset($_GET['BuscaDivProveedor'])) {
  
  ?>
<div class="row">
      <div class="col-md-12">
<font color="red"><strong> Para poder realizar la Carga Masiva de Proveedores, el archivo Excel, debe estar estructurado de 9 columnas, la cuales tendrán las siguientes especificaciones:</strong></font><br>

  1. Código de Proveedor. (Ejemplo: P1, P2, P3, P4, P5......)<br>
  2. Tipo de Documento. (Debera de Ingresar el Codigo de Documento a la que corresponde)<br>
  3. Nº de Documento.<br>
  4. Nombre de Proveedor (Ingresar Nombre de Proveedor).<br>
  5. Nº de Teléfono. (Formato: (9999) 9999999).<br>
  6. Dirección de Proveedor.<br>
  7. Correo Electronico.<br>
  8. Nombre de Vendedor.<br>
  9. Nº de Teléfono de Vendedor. (Formato: (9999) 9999999).<br><br>

  <font color="red"><strong> NOTA:</strong></font><br>
  a) El Archivo no debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Todos los datos deberán escribirse en mayúscula para mejor orden y visibilidad en los reportes.<br>
  d) Deben de tener en cuenta que la carga masiva de Proveedores, deben de ser cargados como se explica, para evitar problemas de datos del proveedor dentro del Sistema.<br><br>
   </div>
</div>
<?php 
  }
########################### MUESTRA DIV PROVEEDOR #############################
?>

<?php
########################### MOSTRAR PROVEEDOR EN VENTANA MODAL ########################
if (isset($_GET['BuscaProveedorModal']) && isset($_GET['codproveedor'])) { 

$reg = $new->ProveedoresPorId();
?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de <?php echo $reg[0]['documproveedor'] == '0' ? "Documento" : $reg[0]['documento'] ?>:</strong> <?php echo $reg[0]['cuitproveedor']; ?>:</td>
  </tr>
  <tr>
    <td><strong>Nombres de Proveedor:</strong> <?php echo $reg[0]['nomproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['tlfproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Dirección de Proveedor: </strong> <?php echo $reg[0]['direcproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electrónico: </strong> <?php echo $reg[0]['emailproveedor']; ?></td>
  </tr> 
  <tr>
    <td><strong>Vendedor: </strong> <?php echo $reg[0]['vendedor']; ?></td>
  </tr> 
  <tr>
    <td><strong>Nº de Teléfono: </strong> <?php echo $reg[0]['tlfvendedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Ingreso: </strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaingreso'])); ?></td>
  </tr>
</table>
<?php 
} 
########################## MOSTRAR PROVEEDOR EN VENTANA MODAL ##########################
?>




















<?php 
############################# MUESTRA DIV INSUMO #############################
if (isset($_GET['BuscaDivInsumos'])) {
  
  ?>
<div class="row">
      <div class="col-md-12">
<font color="red"><strong> Para poder realizar la Carga Masiva de Insumos de Limpieza, el archivo Excel, debe estar estructurado de 122 columnas, la cuales tendrán las siguientes especificaciones:</strong></font><br><br>

  1. Código de Insumo (Ejem. I1, I2, I2, I4).<br>
  2. Nombre de Insumo.<br>
  3. Categoria de Insumo. (Deberá ingresar el Nº de Categoria a la que corresponde o colocar Cero (0)).<br>
  4. Precio Compra. (Numeros con 2 decimales).<br>
  5. Precio Venta. (Numeros con 2 decimales).<br>
  6. Existencia. (Debe de ser solo enteros).<br>
  7. Stock Minimo. (Debe de ser solo enteros).<br>
  8. <?php echo $impuesto; ?> de Insumo. (Ejem. SI o NO).<br>
  9. Descuento de Insumo. (Numeros con 2 decimales).<br>
  10. Fecha de Expiración. (Formato: 0000-00-00).<br>
  11. Proveedor. (Debe de verificar a que codigo pertenece el Proveedor existente).<br><br>
  12. Lote de Producto (En caso de no tener colocar Cero (0)).<br>

  <font color="red"><strong> NOTA:</strong></font><br>
  a) El Archivo no debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Todos los datos deberán escribirse en mayúscula para mejor orden y visibilidad en los reportes.<br>
  d) Deben de tener en cuenta que la carga masiva de Insumos, deben de ser cargados como se explica, para evitar problemas de datos del insumo dentro del Sistema.<br><br>
    </div>
</div>                                 
<?php 
  }
############################# MUESTRA DIV INSUMO #############################
?>

<?php
############################# MOSTRAR INSUMO EN VENTANA MODAL ###########################
if (isset($_GET['BuscaInsumoModal']) && isset($_GET['codinsumo'])) { 

$reg = $new->InsumosPorId(); 

?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codinsumo']; ?></td>
  </tr>
  <tr>
    <td><strong>Insumo:</strong> <?php echo $reg[0]['insumo']; ?></td>
  </tr> 
  <tr>
    <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
  </tr> 
  <tr>
    <td><strong>Precio de Compra: </strong> <?php echo $simbolo.number_format($reg[0]['preciocompra'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong>Precio de Venta: </strong> <?php echo $simbolo.number_format($reg[0]['precioventa'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong>Existencia: </strong> <?php echo $reg[0]['existencia']; ?></td>
  </tr> 
  <tr>
    <td><strong>Stock Minimo: </strong> <?php echo $reg[0]['stockminimo'] == '0' ? "*********" : $reg[0]['stockminimo']; ?></td>
  </tr> 
  <tr>
    <td><strong><?php echo $impuesto; ?>: </strong> <?php echo $reg[0]['ivainsumo'] == 'SI' ? $valor."%" : "(E)"; ?></td>
  </tr> 
  <tr>
    <td><strong>Descuento: </strong> <?php echo $reg[0]['descinsumo']."%"; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Expiración: </strong> <?php echo $reg[0]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fechaexpiracion'])); ?></td>
  </tr>
  <tr>
  <td><strong>Proveedor: </strong><?php echo $reg[0]['codproveedor'] == '' ? "*********" : $reg[0]['cuitproveedor'].": ".$reg[0]['nomproveedor']; ?></td>
  </tr> 
  <tr>
  <td><strong>Lote: </strong><?php echo $reg[0]['lote']; ?></td>
  </tr> 
</table>
<?php 
} 
############################# MOSTRAR INSUMO EN VENTANA MODAL ###########################
?>


<?php
######################### MOSTRAR ENTRADA INSUMO EN VENTANA MODAL ########################
if (isset($_GET['BuscaEntradaInsumoModal']) && isset($_GET['codentrada'])) { 

$reg = $new->EntradaInsumosPorId(); 

?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codinsumo']; ?></td>
  </tr>
  <tr>
    <td><strong>Insumo:</strong> <?php echo $reg[0]['insumo']; ?></td>
  </tr> 
  <tr>
  <td><strong>Proveedor: </strong><?php echo $reg[0]['codproveedor'] == '0' ? "*********" : $reg[0]['cuitproveedor'].": ".$reg[0]['nomproveedor']; ?></td>
  </tr> 
  <tr>
    <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
  </tr> 
  <tr>
    <td><strong>Precio de Compra: </strong> <?php echo $simbolo.number_format($reg[0]['precioentrada'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong>Cantidad de Entrada: </strong> <?php echo $reg[0]['cantentrada']; ?></td>
  </tr> 
  <tr>
    <td><strong>Fecha de Expiración: </strong> <?php echo $reg[0]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fechaexpiracion'])); ?></td>
  </tr> 
  <tr>
    <td><strong>Fecha de Entrada: </strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechaentrada'])); ?></td>
  </tr>
</table>
<?php 
} 
####################### MOSTRAR ENTRADA INSUMO EN VENTANA MODAL #########################
?>


<?php
######################## MOSTRAR SALIDA INSUMO EN VENTANA MODAL ########################
if (isset($_GET['BuscaSalidaInsumoModal']) && isset($_GET['codsalida'])) { 

$reg = $new->SalidaInsumosPorId(); 

?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codinsumo']; ?></td>
  </tr>
  <tr>
    <td><strong>Insumo:</strong> <?php echo $reg[0]['insumo']; ?></td>
  </tr> 
  <tr>
    <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
  </tr> 
  <tr>
    <td><strong>Responsable: </strong> <?php echo $reg[0]['responsable']; ?></td>
  </tr> 
  <tr>
    <td><strong>Cantidad de Salida: </strong> <?php echo $reg[0]['cantsalida']; ?></td>
  </tr>
  <tr>
    <td><strong>Precio de Venta: </strong> <?php echo $simbolo.number_format($reg[0]['preciosalida'], 2, '.', ','); ?></td>
  </tr>  
  <tr>
    <td><strong><?php echo $impuesto; ?>: </strong> <?php echo $reg[0]['ivasalida'] == 'SI' ? $valor."%" : "(E)"; ?></td>
  </tr> 
  <tr>
    <td><strong>Descuento: </strong> <?php echo $reg[0]['descsalida']."%"; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha de Salida: </strong> <?php echo date("d-m-Y",strtotime($reg[0]['fechasalida'])); ?></td>
  </tr>
</table>
<?php 
} 
####################### MOSTRAR SALIDA INSUMO EN VENTANA MODAL ########################
?>


<?php 
########################## BUSQUEDA DE KARDEX POR INSUMOS ##########################
if (isset($_GET['BuscaKardexInsumo']) && isset($_GET['codinsumo'])) { 

$codinsumo = limpiar($_GET['codinsumo']); 

  if($codinsumo=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL INSUMO DE LIMPIEZA CORRECTAMENTE</center>";
  echo "</div>";
  exit;
   
   } else {
  
$kardex = new Login();
$kardex = $kardex->BuscarKardexInsumo();  
 ?>
 
 <!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Movimientos del Insumo <?php echo $kardex[0]['codinsumo'].": ".$kardex[0]['insumo']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codinsumo=<?php echo $codinsumo; ?>&tipo=<?php echo encrypt("KARDEXINSUMOS") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codinsumo=<?php echo $codinsumo; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("KARDEXINSUMOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codinsumo=<?php echo $codinsumo; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("KARDEXINSUMOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>

              </div>
            </div>
          </div>

          <div id="div3"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                              <tr class="text-center">
                                  <th>Nº</th>
                                  <th>Movimiento</th>
                                  <th>Entradas</th>
                                  <th>Salidas</th>
                                  <th>Devolución</th>
                                  <th>Precio Costo</th>
                                  <th>Costo Movimiento</th>
                                  <th>Stock Actual</th>
                                  <th>Documento</th>
                                  <th>Fecha de Kardex</th>
                              </tr>
                              </thead>
                              <tbody>
<?php
$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
$a=1;
for($i=0;$i<sizeof($kardex);$i++){ 
$TotalEntradas+=$kardex[$i]['entradas'];
$TotalSalidas+=$kardex[$i]['salidas'];
$TotalDevolucion+=$kardex[$i]['devolucion'];
?>
                              <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $kardex[$i]['movimiento']; ?></td>
                                  <td><?php echo $kardex[$i]['entradas']; ?></td>
                                  <td><?php echo $kardex[$i]['salidas']; ?></td>
                                  <td><?php echo $kardex[$i]['devolucion']; ?></td>
                                  <td><?php echo $simbolo.number_format($kardex[$i]['precio'], 2, '.', ','); ?></td>
                          <?php if($kardex[$i]["movimiento"]=="ENTRADAS"){ ?>
        <td><?php echo $simbolo.number_format($kardex[$i]['precio']*$kardex[$i]['entradas'], 2, '.', ','); ?></td>
                          <?php } elseif($kardex[$i]["movimiento"]=="SALIDAS"){ ?>
        <td><?php echo $simbolo.number_format($kardex[$i]['precio']*$kardex[$i]['salidas'], 2, '.', ','); ?></td>
                          <?php } else { ?>
        <td><?php echo $simbolo.number_format($kardex[$i]['precio']*$kardex[$i]['devolucion'], 2, '.', ','); ?></td>
                          <?php } ?>
                                  <td><?php echo $kardex[$i]['stockactual']; ?></td>
                                  <td><?php echo $kardex[$i]['documento']; ?></td>
                                  <td><?php echo date("d-m-Y",strtotime($kardex[$i]['fechakardex'])); ?></td>
                              </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                        
              <strong>Detalles de Insumo de Limpieza</strong><br>
              <strong>Código:</strong> <?php echo $kardex[0]['codinsumo']; ?><br>
              <strong>Descripción:</strong> <?php echo $kardex[0]['insumo']; ?><br>
              <strong>Categoria:</strong> <?php echo $kardex[0]['nomcategoria']; ?><br>
              <strong>Total Entradas:</strong> <?php echo $TotalEntradas; ?><br>
              <strong>Total Salidas:</strong> <?php echo $TotalSalidas; ?><br>
              <strong>Total Devolución:</strong> <?php echo $TotalDevolucion; ?><br>
              <strong>Existencia:</strong> <?php echo $kardex[0]['existencia']; ?><br>
              <strong>Precio Compra:</strong> <?php echo $simbolo.number_format($kardex[0]['preciocompra'], 2, '.', ','); ?>                      </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
    <?php
    } 
  }
########################### BUSQUEDA DE KARDEX POR INSUMOS ##########################
?>



























<?php 
############################# MUESTRA DIV PRODUCTO ###############################
if (isset($_GET['BuscaDivProducto'])) {
  
  ?>
<div class="row">
      <div class="col-md-12">
<font color="red"><strong> Para poder realizar la Carga Masiva de Productos, el archivo Excel, debe estar estructurado de 15 columnas, la cuales tendrán las siguientes especificaciones:</strong></font><br><br>

  1. Código de Producto (Ejem. 00001).<br>
  2. Nombre de Producto.<br>
  3. Categoria de Producto. (Deberá ingresar el Nº de Categoria a la que corresponde o colocar Cero (0)).<br>
  4. Precio Compra. (Numeros con 2 decimales).<br>
  5. Precio Venta. (Numeros con 2 decimales).<br>
  6. Existencia. (Debe de ser solo enteros).<br>
  7. Stock Minimo. (Debe de ser solo enteros).<br>
  8. Stock Máximo. (Debe de ser solo enteros).<br>
  9. <?php echo $impuesto; ?> de Producto. (Ejem. SI o NO).<br>
  10. Descuento de Producto. (Numeros con 2 decimales).<br>
  11. Código de Barra. (En caso de no tener colocar Cero (0)).<br>
  12. Fecha de Elaboración. (Formato: 0000-00-00).<br>
  13. Fecha de Expiración. (Formato: 0000-00-00).<br>
  14. Proveedor. (Debe de verificar a que codigo pertenece el Proveedor existente).<br>
  15. Lote de Producto (En caso de no tener colocar Cero (0)).<br><br>

  <font color="red"><strong> NOTA:</strong></font><br>
  a) El Archivo no debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Todos los datos deberán escribirse en mayúscula para mejor orden y visibilidad en los reportes.<br>
  d) Deben de tener en cuenta que la carga masiva de Productos, deben de ser cargados como se explica, para evitar problemas de datos del productos dentro del Sistema.<br><br>
    </div>
</div>                                 
<?php 
  }
############################# MUESTRA DIV PRODUCTO #############################
?>

<?php
########################## MOSTRAR PRODUCTOS EN VENTANA MODAL ##########################
if (isset($_GET['BuscaProductoModal']) && isset($_GET['codproducto'])) { 

$reg = $new->ProductosPorId(); 

$monedap = new Login();
$cambio = $monedap->MonedaProductoId(); 
?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Código:</strong> <?php echo $reg[0]['codproducto']; ?></td>
  </tr>
  <tr>
    <td><strong>Producto:</strong> <?php echo $reg[0]['producto']; ?></td>
  </tr> 
  <tr>
    <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
  </tr> 
  <tr>
    <td><strong>Precio de Compra: </strong> <?php echo $simbolo.number_format($reg[0]['preciocompra'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong>Precio de Venta: </strong> <?php echo $simbolo.number_format($reg[0]['precioventa'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong><?php echo $cambio == '' ? "*****" : "Precio ".$cambio[0]['siglas']; ?>: </strong> 
      <?php echo $cambio == '' ? "*****" : "<strong>".$cambio[0]['simbolo']."</strong>".number_format($reg[0]['precioventa']/$cambio[0]['montocambio'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong>Existencia: </strong> <?php echo $reg[0]['existencia']; ?></td>
  </tr> 
  <tr>
    <td><strong>Stock Minimo: </strong> <?php echo $reg[0]['stockminimo'] == '0' ? "*********" : $reg[0]['stockminimo']; ?></td>
  </tr> 
  <tr>
    <td><strong>Stock Máximo: </strong> <?php echo $reg[0]['stockmaximo'] == '0' ? "*********" : $reg[0]['stockmaximo']; ?></td>
  </tr> 
  <tr>
    <td><strong><?php echo $impuesto; ?>: </strong> <?php echo $reg[0]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
  </tr> 
  <tr>
    <td><strong>Descuento: </strong> <?php echo $reg[0]['descproducto']."%"; ?></td>
  </tr> 
  <tr>
    <td><strong>Código de Barra: </strong> <?php echo $reg[0]['codigobarra'] == '' ? "*********" : $reg[0]['codigobarra']; ?></td>
  </tr> 
  <tr>
    <td><strong>Fecha de Elaboración: </strong> <?php echo $reg[0]['fechaelaboracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fechaelaboracion'])); ?></td>
  </tr> 
  <tr>
    <td><strong>Fecha de Expiración: </strong> <?php echo $reg[0]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[0]['fechaexpiracion'])); ?></td>
  </tr>
  <tr>
    <td><strong>Status: </strong> <?php echo $status = ( $reg[0]['existencia'] != 0 ? "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='badge badge-pill badge-warning'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
  </tr>
  <tr>
  <td><strong>Proveedor: </strong><?php echo $reg[0]['cuitproveedor'].": ".$reg[0]['nomproveedor']; ?></td>
  </tr> 
  <tr>
    <td><strong>Nº de Lote: </strong> <?php echo $reg[0]['lote'] == '' ? "*********" : $reg[0]['lote']; ?></td>
  </tr> 
</table>
<?php 
} 
########################## MOSTRAR PRODUCTOS EN VENTANA MODAL ############################
?>


<?php 
########################## BUSQUEDA DE KARDEX POR PRODUCTOS ##########################
if (isset($_GET['BuscaKardexProducto']) && isset($_GET['codproducto'])) { 

$codproducto = limpiar($_GET['codproducto']); 

  if($codproducto=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL PRODUCTO CORRECTAMENTE</center>";
  echo "</div>";
  exit;
   
   } else {
  
$kardex = new Login();
$kardex = $kardex->BuscarKardexProducto();  
 ?>
 
 <!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Movimientos del Producto <?php echo $kardex[0]['codproducto'].": ".$kardex[0]['producto']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codproducto=<?php echo $codproducto; ?>&tipo=<?php echo encrypt("KARDEXPRODUCTOS") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codproducto=<?php echo $codproducto; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("KARDEXPRODUCTOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codproducto=<?php echo $codproducto; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("KARDEXPRODUCTOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>

              </div>
            </div>
          </div>

          <div id="div3"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                              <tr class="text-center">
                                  <th>Nº</th>
                                  <th>Movimiento</th>
                                  <th>Entradas</th>
                                  <th>Salidas</th>
                                  <th>Devolución</th>
                                  <th>Precio Costo</th>
                                  <th>Costo Movimiento</th>
                                  <th>Stock Actual</th>
                                  <th>Documento</th>
                                  <th>Fecha de Kardex</th>
                              </tr>
                              </thead>
                              <tbody>
<?php
$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
$a=1;
for($i=0;$i<sizeof($kardex);$i++){ 
$TotalEntradas+=$kardex[$i]['entradas'];
$TotalSalidas+=$kardex[$i]['salidas'];
$TotalDevolucion+=$kardex[$i]['devolucion'];
?>
                              <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $kardex[$i]['movimiento']; ?></td>
                                  <td><?php echo $kardex[$i]['entradas']; ?></td>
                                  <td><?php echo $kardex[$i]['salidas']; ?></td>
                                  <td><?php echo $kardex[$i]['devolucion']; ?></td>
                                  <td><?php echo $simbolo.number_format($kardex[$i]['precio'], 2, '.', ','); ?></td>
                          <?php if($kardex[$i]["movimiento"]=="ENTRADAS"){ ?>
        <td><?php echo $simbolo.number_format($kardex[$i]['precio']*$kardex[$i]['entradas'], 2, '.', ','); ?></td>
                          <?php } elseif($kardex[$i]["movimiento"]=="SALIDAS"){ ?>
        <td><?php echo $simbolo.number_format($kardex[$i]['precio']*$kardex[$i]['salidas'], 2, '.', ','); ?></td>
                          <?php } else { ?>
        <td><?php echo $simbolo.number_format($kardex[$i]['precio']*$kardex[$i]['devolucion'], 2, '.', ','); ?></td>
                          <?php } ?>
                                  <td><?php echo $kardex[$i]['stockactual']; ?></td>
                                  <td><?php echo $kardex[$i]['documento']; ?></td>
                                  <td><?php echo date("d-m-Y",strtotime($kardex[$i]['fechakardex'])); ?></td>
                              </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                        
              <strong>Detalles de Producto</strong><br>
              <strong>Código:</strong> <?php echo $kardex[0]['codproducto']; ?><br>
              <strong>Descripción:</strong> <?php echo $kardex[0]['producto']; ?><br>
              <strong>Categoria:</strong> <?php echo $kardex[0]['nomcategoria']; ?><br>
              <strong>Total Entradas:</strong> <?php echo $TotalEntradas; ?><br>
              <strong>Total Salidas:</strong> <?php echo $TotalSalidas; ?><br>
              <strong>Total Devolución:</strong> <?php echo $TotalDevolucion; ?><br>
              <strong>Existencia:</strong> <?php echo $kardex[0]['existencia']; ?><br>
              <strong>Precio Compra:</strong> <?php echo $simbolo.number_format($kardex[0]['preciocompra'], 2, '.', ','); ?><br>
              <strong>Precio Venta:</strong> <?php echo $simbolo.number_format($kardex[0]['precioventa'], 2, '.', ','); ?>
                      </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
    <?php
    } 
  }
########################### BUSQUEDA DE KARDEX POR PRODUCTOS ##########################
?>


<?php 
########################### BUSQUEDA DE PRODUCTOS VENDIDOS ##########################
if (isset($_GET['BuscaProductoVendidos']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
   
 if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {
  
$vendidos = new Login();
$reg = $vendidos->BuscarProductosVendidos();  
 ?>
 
 <!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Productos Vendidos por Fecha Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("PRODUCTOSVENDIDOS") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("PRODUCTOSVENDIDOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("PRODUCTOSVENDIDOS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>Código</th>
                                  <th>Descripción de Producto</th>
                                  <th>Categoria</th>
                                  <th>Desc</th>
                                  <th>Precio de Venta</th>
                                  <th>Existencia</th>
                                  <th>Vendido</th>
                                  <th>Monto Total</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
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
                      <tr class="text-center">
                      <td><?php echo $a++; ?></div></td>
                      <td><?php echo $reg[$i]['codproducto']; ?></td>
                      <td><?php echo $reg[$i]['producto']; ?></td>
                      <td><?php echo $reg[$i]['nomcategoria']; ?></td>
                      <td><?php echo $reg[$i]['descproducto']; ?>%</td>
                      <td><?php echo $simbolo.number_format($reg[$i]["precioventa"], 2, '.', ','); ?></td>
                      <td><?php echo $reg[$i]['existencia']; ?></td>
                      <td><?php echo $reg[$i]['cantidad']; ?></td>
                      <td><?php echo $simbolo.number_format($pagoTotal*$reg[$i]['cantidad'], 2, '.', ','); ?></td>
                                </tr>
                        <?php  }  ?>
                      <tr align="center">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong><?php echo $simbolo.number_format($precioTotal, 2, '.', ','); ?></strong></td>
                        <td><strong><?php echo $existeTotal; ?></strong></td>
                        <td><strong><?php echo $vendidosTotal; ?></strong></td>
                        <td><strong><?php echo $simbolo.number_format($pagoTotal, 2, '.', ','); ?></strong></td>
                      </tr>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
    <?php
    } 
  }
########################### BUSQUEDA DE PRODUCTOS VENDIDOS ##########################
?>


<?php 
########################### BUSQUEDA DE PRODUCTOS POR MONEDA ##########################
if (isset($_GET['BuscaProductoxMoneda']) && isset($_GET['codmoneda'])) { 

  $codmoneda = limpiar($_GET['codmoneda']);

  if($codmoneda=="") { 

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TIPO DE MONEDA PARA TU BÚSQUEDA</center>";
  echo "</div>";
  exit;
   
   } else {

$cambio = new Login();
$cambio = $cambio->BuscarTiposCambios();
  
$reg = $new->ListarProductos();  
 ?>
 
 <!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Productos al Cambio de <?php echo $cambio[0]['moneda']." (".$cambio[0]['siglas'].")"; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codmoneda=<?php echo $codmoneda; ?>&tipo=<?php echo encrypt("PRODUCTOSXMONEDA") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codmoneda=<?php echo $codmoneda; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("PRODUCTOSXMONEDA") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codmoneda=<?php echo $codmoneda; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("PRODUCTOSXMONEDA") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>

              </div>
            </div>
          </div>

          <div id="div3"><table id="datatable-responsive" class="table table-hover table-nomargin table-bordered dataTable table-striped" cellspacing="0" width="100%">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Img</th>
                                                    <th>Código</th>
                                                    <th>Nombre de Producto</th>
                                                    <th>Categoria</th>
                                                    <th>Precio Venta</th>
                                                    <th><?php echo $cambio[0]['siglas']; ?></th>
                                                    <th>Existencia</th>
      <th><?php echo $impuesto; ?></th>
                                                    <th>Descuento</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 

if($reg==""){ 

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
<td><a href="#" data-placement="left" title="Ver Imagen" data-original-title="" data-href="#" data-toggle="modal" data-target=".bs-example-modal-sm" data-backdrop="static" data-keyboard="false" onClick="VerImagen('<?php echo encrypt($reg[$i]["codproducto"]); ?>','<?php echo encrypt($reg[$i]['codsucursal']) ?>')"><?php if (file_exists("fotos/productos/".$reg[$i]["codproducto"].".jpg")){
    echo "<img src='fotos/productos/".$reg[$i]["codproducto"].".jpg?' class='img-rounded' style='margin:0px;' width='50' height='45'>"; 
}else{
   echo "<img src='fotos/producto.png' class='img-rounded' style='margin:0px;' width='50' height='45'>";  
} 
     ?></a></td>
                                               <td><?php echo $reg[$i]['codproducto']; ?></td>
                                               <td><?php echo $reg[$i]['producto']; ?></td>
                                               <td><?php echo $reg[$i]['nomcategoria']; ?></td>
                                              <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
                                              <td><?php echo "<strong>".$cambio[0]['simbolo']."</strong>".number_format($reg[$i]['precioventa']/$cambio[0]['montocambio'], 2, '.', ','); ?></td>
                                               <td><?php echo $reg[$i]['existencia']; ?></td>
                                               <td><?php echo $reg[$i]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
                                               <td><?php echo $reg[$i]['descproducto']; ?></td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table>
                         </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
    <?php
    } 
  }
########################### BUSQUEDA DE PRODUCTOS POR MONEDA ##########################
?>




















<?php
######################### MOSTRAR COMPRA PAGADA EN VENTANA MODAL ########################
if (isset($_GET['BuscaCompraPagadaModal']) && isset($_GET['codcompra'])) { 
 
$reg = $new->ComprasPorId();

  if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON COMPRAS Y DETALLES ACTUALMENTE </center>";
    echo "</div>";    

} else {
?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
  <h3><b class="text-dark">HOTEL</b></h3>
  <p class="text-muted m-l-5"><?php echo $con[0]['nomhotel']; ?>,
  <br/> Nº <?php echo $con[0]['documenhotel'] == '0' ? "DOCUMENTO" : $con[0]['documento'] ?>: <?php echo $con[0]['nrohotel']; ?> - TLF: <?php echo $con[0]['tlfhotel']; ?></p>

  <h3><b class="text-dark">Nº COMPRA <?php echo $reg[0]['codcompra']; ?></b></h3>
  <p class="text-muted m-l-5">STATUS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuscompra"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["statuscompra"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[0]['fechavencecredito'] <= date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuscompra"]."</span>"; } ?>

  <?php if($reg[0]['fechavencecredito']!= "0000-00-00") { ?>
  <br>DIAS VENCIDOS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito']); }
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[0]['fechapagado'],$reg[0]['fechavencecredito']); } ?>
  <?php } ?>
  
  <?php if($reg[0]['fechapagado']!= "0000-00-00") { ?>
  <br>FECHA PAGADA: <?php echo date("d-m-Y",strtotime($reg[0]['fechapagado'])); ?>
  <?php } ?>

  <br>FECHA DE EMISIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fechaemision'])); ?>
  <br/> FECHA DE RECEPCIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fecharecepcion'])); ?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
  <h3><b class="text-dark">PROVEEDOR</b></h3>
  <p class="text-muted m-l-30"><?php echo $reg[0]['nomproveedor'] == '' ? "**********************" : $reg[0]['nomproveedor']; ?>,
  <br/>DIREC: <?php echo $reg[0]['direcproveedor'] == '' ? "*********" : $reg[0]['direcproveedor']; ?> 
  <br/> EMAIL: <?php echo $reg[0]['emailproveedor'] == '' ? "**********************" : $reg[0]['emailproveedor']; ?>
  <br/> Nº <?php echo $reg[0]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[0]['documento'] ?>: <?php echo $reg[0]['cuitproveedor'] == '' ? "**********************" : $reg[0]['cuitproveedor']; ?> - TLF: <?php echo $reg[0]['tlfproveedor'] == '' ? "**********************" : $reg[0]['tlfproveedor']; ?>
  <br/> VENDEDOR: <?php echo $reg[0]['vendedor']; ?> - TLF: <?php echo $reg[0]['tlfvendedor'] == '' ? "**********************" : $reg[0]['tlfvendedor']; ?></p>
                                            
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="text-center">
                        <th>#</th>
                        <th>Descripción de Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
<?php if ($_SESSION['acceso'] == "administrador") { ?><th>Acción</th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesCompras();

$SubTotal = 0;
$a=1;
for($i=0;$i<sizeof($detalle);$i++){  
$SubTotal += $detalle[$i]['valorneto']; 
?>
                                                <tr class="text-center">
      <td><?php echo $a++; ?></td>
      <td><h5><?php echo $detalle[$i]['producto']; ?></h5>
      <small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      <td><?php echo $detalle[$i]['cantcompra']; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['preciocomprac'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valortotal'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.$detalle[$i]['totaldescuentoc']; ?><sup><?php echo $detalle[$i]['descfactura']; ?>%</sup></td>
      <td><?php echo $detalle[$i]['ivaproductoc'] == 'SI' ? $reg[0]['ivac']."%" : "(E)"; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','); ?></td>
 <?php if ($_SESSION['acceso'] == "administrador") { ?><td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleCompraPagadaModal('<?php echo encrypt($detalle[$i]["coddetallecompra"]); ?>','<?php echo encrypt($detalle[$i]["codcompra"]); ?>','<?php echo encrypt($reg[0]["codproveedor"]); ?>','<?php echo encrypt("DETALLESCOMPRAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td><?php } ?>
                                                </tr>
                                      <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <div class="pull-right text-right">
<p><b>Subtotal:</b> <?php echo $simbolo.number_format($SubTotal, 2, '.', ','); ?></p>
<p><b>Total Grabado <?php echo $reg[0]['ivac'] ?>%:</b> <?php echo $simbolo.number_format($reg[0]['subtotalivasic'], 2, '.', ','); ?></p>
<p><b>Total Exento 0%:</b> <?php echo $simbolo.number_format($reg[0]['subtotalivanoc'], 2, '.', ','); ?></p>
<p><b>Total <?php echo $impuesto; ?> (<?php echo $reg[0]['ivac']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totalivac'], 2, '.', ','); ?> </p>
<p><b>Desc. Global (<?php echo $reg[0]['descuentoc']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totaldescuentoc'], 2, '.', ','); ?> </p>
                                        <hr>
<h3><b>Importe Total :</b> <?php echo $simbolo.number_format($reg[0]['totalpagoc'], 2, '.', ','); ?></h3></div>
                                    <div class="clearfix"></div>
                                    <hr>
                                <div class="col-md-12">
                                    <div class="text-right">
 <a href="reportepdf?codcompra=<?php echo encrypt($reg[0]['codcompra']); ?>&tipo=<?php echo encrypt("FACTURACOMPRA") ?>" target="_blank" rel="noopener noreferrer"><button id="print" class="btn waves-light btn-light" type="button"><span><i class="fa fa-print"></i> Imprimir</span> </button></a>
 <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
                                    </div>
                                </div>
                            </div>
                <!-- .row -->

  <?php
       }
   } 
######################### MOSTRAR COMPRA PAGADA EN VENTANA MODAL ########################
?>

<?php
####################### MOSTRAR COMPRA PENDIENTE EN VENTANA MODAL #######################
if (isset($_GET['BuscaCompraPendienteModal']) && isset($_GET['codcompra'])) { 
 
$reg = $new->ComprasPorId();

  if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON COMPRAS Y DETALLES ACTUALMENTE </center>";
    echo "</div>";    

} else {
?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
  <h3><b class="text-dark">HOTEL</b></h3>
  <p class="text-muted m-l-5"><?php echo $con[0]['nomhotel']; ?>,
  <br/> Nº <?php echo $con[0]['documenhotel'] == '0' ? "DOCUMENTO" : $con[0]['documento'] ?>: <?php echo $con[0]['nrohotel']; ?> - TLF: <?php echo $con[0]['tlfhotel']; ?></p>

  <h3><b class="text-dark">Nº COMPRA <?php echo $reg[0]['codcompra']; ?></b></h3>
  <p class="text-muted m-l-5">STATUS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuscompra"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["statuscompra"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[0]['fechavencecredito'] <= date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuscompra"]."</span>"; } ?>

  <?php if($reg[0]['fechavencecredito']!= "0000-00-00") { ?>
  <br>DIAS VENCIDOS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito']); }
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[0]['fechapagado'],$reg[0]['fechavencecredito']); } ?>
  <?php } ?>
  
  <?php if($reg[0]['fechapagado']!= "0000-00-00") { ?>
  <br>FECHA PAGADA: <?php echo date("d-m-Y",strtotime($reg[0]['fechapagado'])); ?>
  <?php } ?>

  <br>FECHA DE EMISIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fechaemision'])); ?>
  <br/> FECHA DE RECEPCIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fecharecepcion'])); ?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
  <h3><b class="text-dark">PROVEEDOR</b></h3>
  <p class="text-muted m-l-30"><?php echo $reg[0]['nomproveedor'] == '' ? "**********************" : $reg[0]['nomproveedor']; ?>,
  <br/>DIREC: <?php echo $reg[0]['direcproveedor'] == '' ? "*********" : $reg[0]['direcproveedor']; ?> 
  <br/> EMAIL: <?php echo $reg[0]['emailproveedor'] == '' ? "**********************" : $reg[0]['emailproveedor']; ?>
  <br/> Nº <?php echo $reg[0]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[0]['documento'] ?>: <?php echo $reg[0]['cuitproveedor'] == '' ? "**********************" : $reg[0]['cuitproveedor']; ?> - TLF: <?php echo $reg[0]['tlfproveedor'] == '' ? "**********************" : $reg[0]['tlfproveedor']; ?>
  <br/> VENDEDOR: <?php echo $reg[0]['vendedor']; ?> - TLF: <?php echo $reg[0]['tlfvendedor'] == '' ? "**********************" : $reg[0]['tlfvendedor']; ?></p>
                                            
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                              <tr class="text-center">
                        <th>#</th>
                        <th>Descripción de Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
<?php if ($_SESSION['acceso'] == "administrador") { ?><th>Acción</th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesCompras();

$SubTotal = 0;
$a=1;
for($i=0;$i<sizeof($detalle);$i++){  
$SubTotal += $detalle[$i]['valorneto'];
?>
                                                <tr class="text-center">
      <td><?php echo $a++; ?></td>
      <td><h5><?php echo $detalle[$i]['producto']; ?></h5>
      <small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      <td><?php echo $detalle[$i]['cantcompra']; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['preciocomprac'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valortotal'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.$detalle[$i]['totaldescuentoc']; ?><sup><?php echo $detalle[$i]['descfactura']; ?>%</sup></td>
      <td><?php echo $detalle[$i]['ivaproductoc'] == 'SI' ? $reg[0]['ivac']."%" : "(E)"; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','); ?></td>
 <?php if ($_SESSION['acceso'] == "administrador") { ?><td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleCompraPendienteModal('<?php echo encrypt($detalle[$i]["coddetallecompra"]); ?>','<?php echo encrypt($detalle[$i]["codcompra"]); ?>','<?php echo encrypt($reg[0]["codproveedor"]); ?>','<?php echo encrypt("DETALLESCOMPRAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td><?php } ?>
                                                </tr>
                                      <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <div class="pull-right text-right">
<p><b>Subtotal:</b> <?php echo $simbolo.number_format($SubTotal, 2, '.', ','); ?></p>
<p><b>Total Grabado <?php echo $reg[0]['ivac'] ?>%:</b> <?php echo $simbolo.number_format($reg[0]['subtotalivasic'], 2, '.', ','); ?></p>
<p><b>Total Exento 0%:</b> <?php echo $simbolo.number_format($reg[0]['subtotalivanoc'], 2, '.', ','); ?></p>
<p><b>Total <?php echo $impuesto; ?> (<?php echo $reg[0]['ivac']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totalivac'], 2, '.', ','); ?> </p>
<p><b>Desc. Global (<?php echo $reg[0]['descuentoc']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totaldescuentoc'], 2, '.', ','); ?> </p>
                                        <hr>
<h3><b>Importe Total :</b> <?php echo $simbolo.number_format($reg[0]['totalpagoc'], 2, '.', ','); ?></h3></div>
                                    <div class="clearfix"></div>
                                    <hr>

                                <div class="col-md-12">
                                    <div class="text-right">
 <a href="reportepdf?codcompra=<?php echo encrypt($reg[0]['codcompra']); ?>&tipo=<?php echo encrypt("FACTURACOMPRA") ?>" target="_blank" rel="noopener noreferrer"><button id="print" class="btn waves-light btn-light" type="button"><span><i class="fa fa-print"></i> Imprimir</span></button></a>
 <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
                                    </div>
                                </div>
                            </div>
                <!-- .row -->

  <?php
       }
   } 
###################### MOSTRAR COMPRA PENDIENTE EN VENTANA MODAL #######################
?>


<?php
######################## MOSTRAR DETALLES DE COMPRAS UPDATE ############################
if (isset($_GET['MuestraDetallesComprasUpdate']) && isset($_GET['codcompra'])) { 
 
$reg = $new->ComprasPorId();

?>

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
<?php if ($_SESSION['acceso'] == "administrador") { ?><th>Acción</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesCompras();
$a=1;
for($i=0;$i<sizeof($detalle);$i++){  
    ?>
                                 <tr class="text-center">
      <td>
      <input type="text" class="form-control" name="cantcompra[]" id="cantcompra<?php echo $a; ?>" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad" value="<?php echo $detalle[$i]["cantcompra"]; ?>" style="width: 80px;" onfocus="this.style.background=('#B7F0FF')" onBlur="this.style.background=('#e4e7ea')" title="Ingrese Cantidad" required="" aria-required="true">
      <input type="hidden" name="cantidadcomprabd[]" id="cantidadcomprabd" value="<?php echo $detalle[$i]["cantcompra"]; ?>">
      </td>
      
      <td>
      <input type="hidden" name="coddetallecompra[]" id="coddetallecompra" value="<?php echo $detalle[$i]["coddetallecompra"]; ?>">
      <input type="hidden" name="tipoentrada[]" id="tipoentrada" value="<?php echo $detalle[$i]["tipoentrada"]; ?>">
      <input type="hidden" name="codproducto[]" id="codproducto" value="<?php echo $detalle[$i]["codproducto"]; ?>">
      <?php echo $detalle[$i]['codproducto']; ?>
      </td>
      
      <td><input type="hidden" name="precioventa[]" id="precioventa" value="<?php echo $detalle[$i]["precioventac"]; ?>"><h5><?php echo $detalle[$i]['producto']; ?></h5><small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      
      <td><input type="hidden" name="preciocompra[]" id="preciocompra" value="<?php echo $detalle[$i]["preciocomprac"]; ?>"><?php echo $simbolo.$detalle[$i]['preciocomprac']; ?></td>

      <td><input type="hidden" name="valortotal[]" id="valortotal" value="<?php echo $detalle[$i]["valortotal"]; ?>"><?php echo $simbolo.$detalle[$i]['valortotal']; ?></td>
      
      <td><input type="hidden" name="descfactura[]" id="descfactura" value="<?php echo $detalle[$i]["descfactura"]; ?>"><?php echo $simbolo.$detalle[$i]['totaldescuentoc']; ?><sup><?php echo $detalle[$i]['descfactura']; ?>%</sup></td>

      <td><input type="hidden" name="ivaproducto[]" id="ivaproducto" value="<?php echo $detalle[$i]["ivaproductoc"]; ?>"><?php echo $detalle[$i]['ivaproductoc'] == 'SI' ? $valor."%" : "(E)"; ?></td>

      <td><?php echo $simbolo.$detalle[$i]['valorneto']; ?></td>

 <?php if ($_SESSION['acceso'] == "administrador") { ?><td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleCompraUpdate('<?php echo encrypt($detalle[$i]["coddetallecompra"]); ?>','<?php echo encrypt($detalle[$i]["codcompra"]); ?>','<?php echo encrypt($reg[0]["codproveedor"]); ?>','<?php echo encrypt("DETALLESCOMPRAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td><?php } ?>
                                 </tr>
                     <?php } ?>
                </tbody>
            </table><hr>

             <table id="carritototal" class="table-responsive">
                <tr>
    <td width="50">&nbsp;</td>
    <td width="250">
    <h5><label>Total Gravado <?php echo $reg[0]['ivac'] ?>%:</label></h5>
    </td>
                  
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal" name="lblsubtotal"><?php echo $reg[0]['subtotalivasic'] ?></label></h5>
    <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="<?php echo $reg[0]['subtotalivasic'] ?>"/>
    </td>

    <td width="250">
    <h5><label>Total Exento 0%:</label></h5>
    </td>
    
    <td width="250">
    <h5><?php echo $simbolo; ?><label id="lblsubtotal2" name="lblsubtotal2"><?php echo $reg[0]['subtotalivanoc'] ?></label></h5>
    <input type="hidden" name="txtsubtotal2" id="txtsubtotal2" value="<?php echo $reg[0]['subtotalivanoc'] ?>"/>
    </td>

    <td class="text-center" width="250">
    <h2><b>Importe Total</b></h2>
    </td>
                </tr>
                <tr>
    <td>&nbsp;</td>
    <td>
    <h5><label><?php echo $impuesto; ?> <?php echo $reg[0]['ivac'] ?>%:<input type="hidden" name="iva" id="iva" autocomplete="off" value="<?php echo $reg[0]['ivac'] ?>"></label></h5>
    </td>
    
    <td>
    <h5><?php echo $simbolo; ?><label id="lbliva" name="lbliva"><?php echo $reg[0]['totalivac'] ?></label></h5>
    <input type="hidden" name="txtIva" id="txtIva" value="<?php echo $reg[0]['totalivac'] ?>"/>
    </td>

    <td>
    <h5><label>Desc. Global <input class="number" type="text" name="descuento" id="descuento" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:70px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $reg[0]['descuentoc'] ?>">%:</label></h5>
    </td>

    <td>
    <h5><?php echo $simbolo; ?><label id="lbldescuento" name="lbldescuento"><?php echo $reg[0]['totaldescuentoc'] ?></label></h5>
    <input type="hidden" name="txtDescuento" id="txtDescuento" value="<?php echo $reg[0]['totaldescuentoc'] ?>"/>
    </td>

    <td class="text-center">
    <h2><?php echo $simbolo; ?><label id="lbltotal" name="lbltotal"><?php echo $reg[0]['totalpagoc'] ?></label></h2>
    <input type="hidden" name="txtTotal" id="txtTotal" value="<?php echo $reg[0]['totalpagoc'] ?>"/>
    </td>
                    </tr>
                  </table>
        </div>
<?php
  } 
######################## MOSTRAR DETALLES DE COMPRAS UPDATE ########################
?>


<?php
######################## BUSQUEDA COMPRAS POR PROVEEDORES ########################
if (isset($_GET['BuscaComprasxProvedores']) && isset($_GET['codproveedor'])) {
  
  $codproveedor = limpiar($_GET['codproveedor']);

 if($codproveedor=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE PROVEEDOR PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else {

$pre = new Login();
$reg = $pre->BuscarComprasxProveedor();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Compras al Proveedor <?php echo $reg[0]['cuitproveedor'].": ".$reg[0]['nomproveedor']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codproveedor=<?php echo $codproveedor; ?>&tipo=<?php echo encrypt("COMPRASXPROVEEDOR") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codproveedor=<?php echo $codproveedor; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("COMPRASXPROVEEDOR") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codproveedor=<?php echo $codproveedor; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("COMPRASXPROVEEDOR") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

  <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                              <tr class="text-center">
                              <th>Nº</th>
                              <th>N° de Compra</th>
                              <th>Descripción de Proveedor</th>
                              <th>Nº de Articulos</th>
                              <th>Imp. Total</th>
                              <th>Status</th>
                              <th>Dias Venc.</th>
                              <th>Fecha de Emisión</th>
                              <th>Fecha de Recepción</th>
                              <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codcompra']; ?></td>
 <td><abbr title="<?php echo "Nº ".$documento = ($reg[$i]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']).": ".$reg[$i]['cuitproveedor']; ?>"><?php echo $reg[$i]['nomproveedor']; ?></abbr></td>
                    <td><?php echo $reg[$i]['articulos']; ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
                    <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuscompra"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuscompra"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuscompra"]."</span>"; } ?></td>
<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharecepcion'])); ?></td>
                    <td>
<a href="reportepdf?codcompra=<?php echo encrypt($reg[$i]['codcompra']); ?>&tipo=<?php echo encrypt("FACTURACOMPRA") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
########################## BUSQUEDA COMPRAS POR PROVEEDORES ##########################
?>


<?php
########################## BUSQUEDA COMPRAS POR FECHAS ##########################
if (isset($_GET['BuscaComprasxFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarComprasxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Compras de Productos por Fechas Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("COMPRASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("COMPRASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("COMPRASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

  <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                              <th>Nº</th>
                              <th>N° de Compra</th>
                              <th>Descripción de Proveedor</th>
                              <th>Nº de Articulos</th>
                              <th>Imp. Total</th>
                              <th>Status</th>
                              <th>Fecha de Emisión</th>
                              <th>Fecha de Recepción</th>
                              <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codcompra']; ?></td>
<td><abbr title="<?php echo "Nº ".$documento = ($reg[$i]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']).": ".$reg[$i]['cuitproveedor']; ?>"><?php echo $reg[$i]['nomproveedor']; ?></abbr></td>
                    <td><?php echo $reg[$i]['articulos']; ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
                    <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuscompra"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuscompra"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuscompra"]."</span>"; } ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fecharecepcion'])); ?></td>
                    <td>
<a href="reportepdf?codcompra=<?php echo encrypt($reg[$i]['codcompra']); ?>&tipo=<?php echo encrypt("FACTURACOMPRA") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
########################## BUSQUEDA COMPRAS POR FECHAS ########################
?>






















<?php
######################## MOSTRAR CAJA DE VENTA EN VENTANA MODAL #########################
if (isset($_GET['BuscaCajaModal']) && isset($_GET['codcaja'])) { 

$reg = $new->CajasPorId();
?>
  
  <table class="table-responsive" border="0" align="center"> 
  <tr>
    <td><strong>Nº de Caja:</strong> <?php echo $reg[0]['nrocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nomcaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Responsable de Caja: </strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
</table>
<?php 
} 
######################## MOSTRAR CAJA DE VENTA EN VENTANA MODAL #########################
?>


<?php
######################## MOSTRAR ARQUEO EN CAJA EN VENTANA MODAL #######################
if (isset($_GET['BuscaArqueoModal']) && isset($_GET['codarqueo'])) { 

$reg = $new->ArqueoCajaPorId();

  ?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nomcaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Monto Inicial:</strong> <?php echo $simbolo.number_format($reg[0]['montoinicial'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Ingresos:</strong> <?php echo $simbolo.number_format($reg[0]['ingresos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Egresos:</strong> <?php echo $simbolo.number_format($reg[0]['egresos'], 2, '.', ','); ?></td>
    </tr>
  <tr>
    <td><strong>Créditos:</strong> <?php echo $simbolo.number_format($reg[0]['creditos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Abonos de Créditos:</strong> <?php echo $simbolo.number_format($reg[0]['abonos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Total Cobro:</strong> <?php echo $simbolo.number_format($reg[0]['ingresos']+$reg[0]['creditos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Total Ingresos:</strong> <?php echo $simbolo.number_format($reg[0]['ingresos']+$reg[0]['abonos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Dinero en Efectivo:</strong> <?php echo $simbolo.number_format($reg[0]['dineroefectivo'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Diferencia:</strong> <?php echo $simbolo.number_format($reg[0]['diferencia'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Observaciones:</strong> <?php echo $reg[0]['comentarios']; ?></td>
  </tr>
  <tr>
    <td><strong>Hora Apertura:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechaapertura'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora Cierre:</strong> <?php echo $cierre = ( $reg[0]['statusarqueo'] == '1' ? $reg[0]['fechacierre'] : date("d-m-Y h:i:s",strtotime($reg[0]['fechacierre']))); ?></td>
  </tr>
  <tr>
    <td><strong>Responsable:</strong> <?php echo $reg[0]['dni'].": ".$reg[0]['nombres']; ?></td>
  </tr>
</table>
  
  <?php
   } 
######################## MOSTRAR ARQUEO EN CAJA EN VENTANA MODAL #######################
?>


<?php
######################### BUSQUEDA ARQUEOS DE CAJA POR FECHAS ####################
if (isset($_GET['BuscaArqueosxFechas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $codcaja = limpiar($_GET['codcaja']);
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($codcaja=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarArqueosxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Arqueos de Cajas por Fechas</h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("ARQUEOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("ARQUEOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("ARQUEOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

  <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>Caja</th>
                                  <th>Hora de Apertura</th>
                                  <th>Hora de Cierre</th>
                                  <th>Inicial</th>
                                  <th>Ingresos</th>
                                  <th>Egresos</th>
                                  <th>Créditos</th>
                                  <th>Abonos</th>
                                  <th>Total Cobro</th>
                                  <th>Total Ingresos</th>
                                  <th>Dinero Efectivo</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                    <td><?php echo $a++; ?></td>
<td><abbr title="<?php echo "Responsable: ".$reg[$i]['nombres'] ?>"><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></abbr></td>
              <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaapertura'])); ?></td>
<td><?php echo $reg[$i]['fechacierre'] == '0000-00-00 00:00:00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechacierre'])); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['montoinicial'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['ingresos'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['egresos'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['creditos'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['abonos'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['ingresos']+$reg[$i]['creditos'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']+$reg[$i]['abonos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['dineroefectivo'], 2, '.', ','); ?></td>
                                </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
######################### BUSQUEDA ARQUEOS DE CAJAS POR FECHAS ########################
?>









<?php
###################### MOSTRAR MOVIMIENTO EN CAJA EN VENTANA MODAL #####################
if (isset($_GET['BuscaMovimientoModal']) && isset($_GET['codmovimiento'])) { 

$reg = $new->MovimientosPorId();

  ?>
  
  <table class="table-responsive" border="0" align="center">
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nomcaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Tipo de Movimiento:</strong> <?php echo $reg[0]['tipomovimiento']; ?></td>
  </tr>
  <tr>
    <td><strong>Descripción de Movimiento:</strong> <?php echo $reg[0]['descripcionmovimiento']; ?></td>
  </tr>
  <tr>
    <td><strong>Monto de Movimiento:</strong> <?php echo $simbolo.number_format($reg[0]['montomovimiento'], 2, '.', ','); ?></td>
    </tr>
  <tr>
    <td><strong>Tipo de Pago:</strong> <?php echo $reg[0]['mediopago']; ?></td>
  </tr>
  <tr>
    <td><strong>Hora Cierre:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechamovimiento'])); ?></td>
  </tr>
  <tr>
    <td><strong>Responsable:</strong> <?php echo $reg[0]['dni'].": ".$reg[0]['nombres']; ?></td>
  </tr>
</table>
  
  <?php
   } 
##################### MOSTRAR MOVIMIENTO EN CAJA EN VENTANA MODAL #######################
?>






<?php
######################### BUSQUEDA MOVIMIENTOS DE CAJA POR FECHAS ########################
if (isset($_GET['BuscaMovimientosxFechas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $codcaja = limpiar($_GET['codcaja']);
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($codcaja=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarMovimientosxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Movimientos en Cajas por Fechas</h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("MOVIMIENTOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("MOVIMIENTOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("MOVIMIENTOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

  <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>Nº de Caja</th>
                                  <th>Responsable</th>
                                  <th>Tipo Movimiento</th>
                                  <th>Descripción</th>
                                  <th>Monto</th>
                                  <th>Forma de Movimiento</th>
                                  <th>Fecha Movimiento</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                    <td><?php echo $a++; ?></td>
              <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
              <td><?php echo $reg[$i]['nombres']; ?></td>
<td><?php echo $status = ( $reg[$i]['tipomovimiento'] == 'INGRESO' ? "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]['tipomovimiento']."</span>" : "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> ".$reg[$i]['tipomovimiento']."</span>"); ?></td>
<td><?php echo $reg[$i]['descripcionmovimiento']; ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['montomovimiento'], 2, '.', ','); ?></td>
              <td><?php echo $reg[$i]['mediopago']; ?></td>
              <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechamovimiento'])); ?></td>
                                </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
######################## BUSQUEDA MOVIMIENTOS DE CAJAS POR FECHAS ########################
?>
































<?php
######################### MOSTRAR RESERVACIONES EN VENTANA MODAL ########################
if (isset($_GET['BuscaReservacionModal']) && isset($_GET['codreservacion'])) { 
 
$reg = $new->ReservacionesPorId();

  if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESERVACIÓN Y DETALLES ACTUALMENTE </center>";
    echo "</div>";    

} else {
?> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
  <h3><b class="text-dark">HOTEL</b></h3>
  <p class="text-muted m-l-5"><?php echo $con[0]['nomhotel']; ?>,
  <br/> Nº <?php echo $con[0]['documenhotel'] == '0' ? "DOCUMENTO" : $con[0]['documento'] ?>: <?php echo $con[0]['nrohotel']; ?> - TLF: <?php echo $con[0]['tlfhotel']; ?></p>

  <h3><b class="text-dark">Nº RESERVACIÓN <?php echo $reg[0]['codreservacion']; ?></b></h3>
  <p class="text-muted m-l-5">Nº SERIE: <?php echo $reg[0]['codserie']; ?>
  <br>Nº DE CAJA: <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nomcaja']; ?>
  <br>TIPO DE PAGO: <?php echo $reg[0]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[0]['tipopago']; ?>
  <?php if($reg[0]['fechavencecredito']!= "0000-00-00") { ?>
  <br>DIAS VENCIDOS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito']); }
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[0]['fechapagado'],$reg[0]['fechavencecredito']); } ?>
  <?php } ?>

  <br>STATUS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuspago"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["statuspago"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[0]['fechavencecredito'] <= date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuspago"]."</span>"; } ?>
  
  <?php if($reg[0]['fechapagado']!= "0000-00-00") { ?>
  <br>FECHA PAGADA: <?php echo date("d-m-Y",strtotime($reg[0]['fechapagado'])); ?>
  <?php } ?>

  <br>FECHA DE EMISIÓN: <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fecharegistro'])); ?>
  <br>RESERVACIÓN: <?php if($reg[0]['reservacion']=="PENDIENTE") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["reservacion"]."</span>"; 
  } elseif($reg[0]['reservacion']=="ACTIVA") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[0]["reservacion"]."</span>"; 
  } elseif($reg[0]['reservacion']=="CANCELADA") { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-check'></i> ".$reg[0]["reservacion"]."</span>"; 
  } else { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["reservacion"]."</span>"; } ?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
  <h3><b class="text-dark">CLIENTE</b></h3>
  <p class="text-muted m-l-30"><?php echo $reg[0]['nomcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente']; ?>,
  <br/>DIREC: <?php echo $reg[0]['direccliente'] == '' ? "*********" : $reg[0]['direccliente']; ?> - <?php echo paises($reg[0]['paiscliente']); ?>
  <br/> EMAIL: <?php echo $reg[0]['correocliente'] == '' ? "**********************" : $reg[0]['correocliente']; ?>
  <br/> Nº <?php echo $reg[0]['documcliente'] == '0' ? "DOCUMENTO" : $reg[0]['documento'] ?>: <?php echo $reg[0]['dnicliente'] == '' ? "**********************" : $reg[0]['dnicliente']; ?> - TLF: <?php echo $reg[0]['telefcliente'] == '' ? "**********************" : $reg[0]['telefcliente']; ?></p>
                                            
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                      <address>
                  <?php if (file_exists("fotos/comprobantes/".encrypt($reg[0]["codreservacion"]).".jpg")){
    echo "<img src='fotos/comprobantes/".encrypt($reg[0]["codreservacion"]).".jpg?' style='margin:0px;' width='340' height='150'>"; } ?>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                               <thead>
                        <tr class="text-center">
                        <th>#</th>
                        <th>Nº de Habitación</th>
                        <th>Descripción de Habitación</th>
                        <th>Nº Adultos</th>
                        <th>Nº Niños</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Valor Total</th>
                        <th>Descuento</th>
                        <th>Valor Neto</th>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><th>Acción</th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesReservaciones();

$a=1;
for($i=0;$i<sizeof($detalle);$i++){  

  


?>
                                                <tr class="text-center">
      <td><?php echo $a++; ?></td>
      <td><?php echo $detalle[$i]['numhabitacion']; ?></td>
      <td><h5><?php echo $detalle[$i]['descriphabitacion']; ?></h5>
      <small>(<?php echo $detalle[$i]['nomtipo']; ?>)</small></td>
      <td><?php echo $detalle[$i]['adultos']; ?></td>
      <td><?php echo $detalle[$i]['children']; ?></td>
      <td><?php echo date("d-m-Y",strtotime($detalle[$i]['desde'])); ?></td>
      <td><?php echo date("d-m-Y",strtotime($detalle[$i]['hasta'])); ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valortotal'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.$detalle[$i]['totaldescuento']; ?><sup><?php echo $detalle[$i]['deschabitacion']; ?>%</sup></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','); ?></td>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><td><button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleReservacionModal('<?php echo encrypt($detalle[$i]["coddetallereservacion"]); ?>','<?php echo encrypt($reg[0]["codreservacion"]); ?>','<?php echo encrypt("DETALLESRESERVACIONES") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td><?php } ?>
                                                </tr>
                                      <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <div class="pull-right text-right">
<p><b>SubTotal:</b> <?php echo $simbolo.number_format($reg[0]['subtotal'], 2, '.', ','); ?><p>
<p><b>Total <?php echo $impuesto; ?> (<?php echo $reg[0]['iva']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totaliva'], 2, '.', ','); ?> </p>
<p><b>Desc. Global (<?php echo $reg[0]['descuento']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totaldescuento'], 2, '.', ','); ?> </p>
                                        <hr>
<h3><b>Importe Total:</b> <?php echo $simbolo.number_format($reg[0]['totalpago'], 2, '.', ','); ?></h3></div>
                                    <div class="clearfix"></div>
                                    <hr>

                                <div class="col-md-12">
                                    <div class="text-right">
 <a href="reportepdf?codreservacion=<?php echo encrypt($reg[0]['codreservacion']); ?>&tipo=<?php echo encrypt($reg[0]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button id="print" class="btn waves-light btn-light" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button></a>
 <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
                                    </div>
                                </div>
                            </div>
                <!-- .row -->
  <?php
       }
   } 
######################### MOSTRAR RESERVACIONES EN VENTANA MODAL ########################
?>

<?php
####################### MOSTRAR DETALLES DE RESERVACIONES UPDATE #########################
if (isset($_GET['MuestraDetallesReservacionesUpdate']) && isset($_GET['codreservacion'])) { 
 
$reg = $new->VentasPorId();

?>

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
                        <th>Acción</th>
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

      <td><input type="hidden" name="preciocompra[]" id="preciocompra" value="<?php echo $detalle[$i]["preciocompra"]; ?>"><h5><?php echo $detalle[$i]['producto']; ?></h5><small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      
      <td><input type="hidden" name="precioventa[]" id="precioventa" value="<?php echo $detalle[$i]["precioventa"]; ?>"><?php echo $simbolo.$detalle[$i]['precioventa']; ?></td>

       <td><input type="hidden" name="valortotal[]" id="valortotal" value="<?php echo $detalle[$i]["valortotal"]; ?>"><?php echo $simbolo.$detalle[$i]['valortotal']; ?></td>
      
      <td><input type="hidden" name="descproducto[]" id="descproducto" value="<?php echo $detalle[$i]["descproducto"]; ?>"><?php echo $simbolo.$detalle[$i]['totaldescuentov']; ?><sup><?php echo $detalle[$i]['descproducto']; ?>%</sup></td>

      <td><input type="hidden" name="ivaproducto[]" id="ivaproducto" value="<?php echo $detalle[$i]["ivaproducto"]; ?>"><?php echo $detalle[$i]['ivaproducto'] == 'SI' ? $reg[0]['iva']."%" : "(E)"; ?></td>

      <td><?php echo $simbolo.$detalle[$i]['valorneto']; ?></td>
      <td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleReservacionUpdate('<?php echo encrypt($detalle[$i]["coddetallereservacion"]); ?>','<?php echo encrypt($detalle[$i]["codreservacion"]); ?>','<?php echo encrypt($reg[0]["codcliente"]); ?>','<?php echo encrypt("DETALLESRESERVACIONES") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td>
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
<?php
  } 
######################## MOSTRAR DETALLES DE RESERVACIONES UPDATE #######################
?>


<?php
######################### BUSQUEDA RESERVACIONES POR CAJAS ##########################
if (isset($_GET['BuscaReservacionesxCajas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $codcaja = limpiar($_GET['codcaja']);
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($codcaja=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarReservacionesxCajas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Reservaciones en Caja <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nomcaja']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("RESERVACIONESXCAJAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RESERVACIONESXCAJAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RESERVACIONESXCAJAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th> 
                                  <th>N° de Reservación</th>
                                  <th>Habitaciones</th>
                                  <th>Fecha de Entrada</th>
                                  <th>Fecha de Salida</th>
                                  <th>Imp. Total</th>
                                  <th>Tipo de Pago</th>
                                  <th>Status</th>
                                  <th>Reservación</th>
                                  <th>Pdf</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                    <td><?php echo $a++; ?></td>
                                    <td><?php echo $reg[$i]['codreservacion']; ?></td>
                                    <td><?php echo $reg[$i]['habitaciones']; ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
                                    <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
                                    <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
                                    <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>
<td><?php if($reg[$i]['reservacion']=="PENDIENTE") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="ACTIVA") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="CANCELADA") { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } else { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-info'></i> ".$reg[$i]["reservacion"]."</span>"; } ?></td>
  <td> <a href="reportepdf?codreservacion=<?php echo encrypt($reg[$i]['codreservacion']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
######################### BUSQUEDA RESERVACIONES POR CAJAS ########################
?>


<?php
######################### BUSQUEDA RESERVACIONES POR FECHAS ########################
if (isset($_GET['BuscaReservacionesxFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarReservacionesxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Reservaciones por Fechas de Entrada <?php echo date("d-m-Y", strtotime($desde)); ?> - Salida <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("RESERVACIONESXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RESERVACIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RESERVACIONESXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th> 
                                  <th>N° de Reservación</th>
                                  <th>Habitaciones</th>
                                  <th>Fecha de Entrada</th>
                                  <th>Fecha de Salida</th>
                                  <th>Imp. Total</th>
                                  <th>Tipo de Pago</th>
                                  <th>Status</th>
                                  <th>Reservación</th>
                                  <th>Pdf</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                    <td><?php echo $a++; ?></td>
                                    <td><?php echo $reg[$i]['codreservacion']; ?></td>
                                    <td><?php echo $reg[$i]['habitaciones']; ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
                                    <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
                                    <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
                                    <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>
<td><?php if($reg[$i]['reservacion']=="PENDIENTE") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="ACTIVA") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="CANCELADA") { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } else { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-info'></i> ".$reg[$i]["reservacion"]."</span>"; } ?></td>
  <td> <a href="reportepdf?codreservacion=<?php echo encrypt($reg[$i]['codreservacion']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
######################### BUSQUEDA RESERVACIONES POR FECHAS ########################
?>


<?php
######################### BUSQUEDA RESERVACIONES POR CLIENTES ########################
if (isset($_GET['BuscaReservacionesxClientes']) && isset($_GET['codcliente'])) {
  
  $codcliente = limpiar($_GET['codcliente']);

 if($codcliente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL CLIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

} else {

$pre = new Login();
$reg = $pre->BuscarReservacionesxClientes();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Reservaciones del Cliente <?php echo $reg[0]['dnicliente'].": ".$reg[0]['nomcliente']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcliente=<?php echo $codcliente; ?>&tipo=<?php echo encrypt("RESERVACIONESXCLIENTES") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcliente=<?php echo $codcliente; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("RESERVACIONESXCLIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcliente=<?php echo $codcliente; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("RESERVACIONESXCLIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th> 
                                  <th>N° de Reservación</th>
                                  <th>Habitaciones</th>
                                  <th>Fecha de Entrada</th>
                                  <th>Fecha de Salida</th>
                                  <th>Imp. Total</th>
                                  <th>Tipo de Pago</th>
                                  <th>Status</th>
                                  <th>Reservación</th>
                                  <th>Pdf</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                    <td><?php echo $a++; ?></td>
                                    <td><?php echo $reg[$i]['codreservacion']; ?></td>
                                    <td><?php echo $reg[$i]['habitaciones']; ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
                                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
                                    <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
                                    <td><?php echo $reg[$i]['tipopago'] == 'TARJETA' ? "TARJETA DE CRÉDITO" : $reg[$i]['tipopago']; ?></td>
                                    <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>
<td><?php if($reg[$i]['reservacion']=="PENDIENTE") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="ACTIVA") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="CANCELADA") { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } else { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-info'></i> ".$reg[$i]["reservacion"]."</span>"; } ?></td>
  <td> <a href="reportepdf?codreservacion=<?php echo encrypt($reg[$i]['codreservacion']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
######################### BUSQUEDA RESERVACIONES POR CLIENTES ########################
?>



































<?php 
############################# MUESTRA FORMULARIO PARA VENTAS ########################
if (isset($_GET['CargaDetalleCaja'])) {

$arqueo = new Login();
$arqueo = $arqueo->ArqueoCajaPorUsuario(); 
?>

    <h4 class="modal-title text-white" id="myModalLabel"><i class="mdi mdi-desktop-mac"></i> Caja Nº: <?php echo $arqueo[0]["nrocaja"].":".$arqueo[0]["nomcaja"]; ?></h4>
    <input type="hidden" name="codcaja" id="codcaja" value="<?php echo $arqueo[0]["codcaja"]; ?>">
             
<?php  
  }
############################# MUESTRA FORMULARIO PARA VENTAS ########################
?>

<?php 
############################# MUESTRA CAJA DE VENTA PARA CIERRE ########################
if (isset($_GET['MuestraCajaVenta'])) { 

$reg = $new->ArqueoCajaPorUsuario();

  if($reg==""){

    echo "<center><div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<span class='fa fa-info-circle'></span> NO TIENE UN ARQUEO DE CAJA, VERIFIQUE NUEVAMENTE POR FAVOR </div></center>";
    exit;

  } else {

?>

      <div class="row">
          <div class="col-md-12">
              <div class="form-group has-feedback">
                <label class="control-label">Nº de Caja: <span class="symbol required"></span></label>
                <input type="hidden" name="proceso" id="proceso" value="cierre"/>
                <input type="hidden" name="codarqueo" id="codarqueo" value="<?php echo $reg[0]["codarqueo"]; ?>"/>
                <input type="text" class="form-control" name="responsable" id="responsable" placeholder="Ingrese Nombre Cajero" autocomplete="off" value="<?php echo $reg[0]["nrocaja"].": ".$reg[0]["nomcaja"].": ".$reg[0]["nombres"]; ?>" disabled=""aria-required="true"/>
                <i class="fa fa-pencil form-control-feedback"></i> 
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Monto Inicial: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="montoinicial" id="montoinicial" autocomplete="off" placeholder="Monto Inicial" value="<?php echo $reg[0]["montoinicial"]; ?>" autocomplete="off" readonly="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i> 
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Ingresos: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="ingresos" id="ingresos" autocomplete="off" placeholder="Ingrese Monto de Ingresos" autocomplete="off" value="<?php echo $reg[0]["ingresos"]; ?>" readonly="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i> 
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Egresos: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="egresos" id="egresos" autocomplete="off" placeholder="Monto de Egresos" autocomplete="off" value="<?php echo $reg[0]["egresos"]; ?>" readonly="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Créditos: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="creditos" id="creditos" autocomplete="off" placeholder="Monto de Créditos" autocomplete="off" value="<?php echo $reg[0]["creditos"]; ?>" readonly="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Abonos de Crédito: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="abonos" id="abonos" autocomplete="off" placeholder="Abono de Créditos" autocomplete="off" value="<?php echo $reg[0]["abonos"]; ?>" readonly="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i>
            </div>
         </div>

          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Estimado en Caja: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="estimado" id="estimado" autocomplete="off" placeholder="Estimado en Caja" autocomplete="off" value="<?php echo number_format($reg[0]["montoinicial"]+$reg[0]["ingresos"]+$reg[0]["abonos"]-$reg[0]["egresos"], 2, '.', ','); ?>" readonly="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i>
              </div>
          </div>
      </div>


      <div class="row">
          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Efectivo Disponible: <span class="symbol required"></span></label>
                <input type="text" class="form-control cierrecaja" name="dineroefectivo" id="dineroefectivo" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Efectivo" autocomplete="off" required="" aria-required="true"/> 
                <i class="fa fa-tint form-control-feedback"></i>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Diferencia en Caja: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="diferencia" id="diferencia" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" placeholder="Diferencia en Caja" autocomplete="off" readonly="" aria-required="true"/>
                <i class="fa fa-tint form-control-feedback"></i>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Hora de Apertura: <span class="symbol required"></span></label>
                <input type="text" class="form-control" name="fechaapertura" id="fechaapertura" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Hora de Apertura" value="<?php echo $reg[0]["fechaapertura"]; ?>" autocomplete="off" readonly="" aria-required="true"/> 
                <i class="fa fa-clock-o form-control-feedback"></i> 
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-4">
              <div class="form-group has-feedback">
                <label class="control-label">Hora de Cierre: <span class="symbol required"></span></label>
                <input type="text" class="form-control fecharegistro" name="fecharegistro" id="fecharegistro" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Hora de Cierre" autocomplete="off" readonly="" aria-required="true"/> 
                <i class="fa fa-clock-o form-control-feedback"></i> 
              </div>
          </div>

          <div class="col-md-8">
              <div class="form-group has-feedback2">
                <label class="control-label">Observaciones: </label>
                <input type="text" class="form-control" name="comentarios" id="comentarios" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Cierre" autocomplete="off" required="" aria-required="true"/> 
                <i class="fa fa-comment-o form-control-feedback2"></i> 
              </div>
          </div>
      </div>

<?php    
     }       
  }
############################# MUESTRA CAJA DE VENTA PARA CIERRE ########################
?>

<?php
############################# MOSTRAR VENTAS EN VENTANA MODAL ############################
if (isset($_GET['BuscaVentaModal']) && isset($_GET['codventa'])) { 
 
$reg = $new->VentasPorId();

  if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON VENTAS Y DETALLES ACTUALMENTE </center>";
    echo "</div>";    

} else {
?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
  <h3><b class="text-dark">HOTEL</b></h3>
  <p class="text-muted m-l-5"><?php echo $con[0]['nomhotel']; ?>,
  <br/> Nº <?php echo $con[0]['documenhotel'] == '0' ? "DOCUMENTO" : $con[0]['documento'] ?>: <?php echo $con[0]['nrohotel']; ?> - TLF: <?php echo $con[0]['tlfhotel']; ?></p>

  <h3><b class="text-dark">Nº VENTA <?php echo $reg[0]['codventa']; ?></b></h3>
  <p class="text-muted m-l-5">Nº SERIE: <?php echo $reg[0]['codserie']; ?>
  <br>Nº DE CAJA: <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nomcaja']; ?>
  
  <?php if($reg[0]['fechavencecredito']!= "0000-00-00") { ?>
  <br>DIAS VENCIDOS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito']); }
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[0]['fechapagado'],$reg[0]['fechavencecredito']); } ?>
  <?php } ?>

  <br>STATUS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statusventa"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["statusventa"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[0]['fechavencecredito'] <= date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statusventa"]."</span>"; } ?>
  
  <?php if($reg[0]['fechapagado']!= "0000-00-00") { ?>
  <br>FECHA PAGADA: <?php echo date("d-m-Y",strtotime($reg[0]['fechapagado'])); ?>
  <?php } ?>

  <br>FECHA DE EMISIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fechaventa'])); ?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
  <h3><b class="text-dark">CLIENTE</b></h3>
  <p class="text-muted m-l-30"><?php echo $reg[0]['nomcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente']; ?>,
  <br/>DIREC: <?php echo $reg[0]['direccliente'] == '' ? "*********" : $reg[0]['direccliente']; ?> - <?php echo paises($reg[0]['paiscliente']); ?>
  <br/> EMAIL: <?php echo $reg[0]['correocliente'] == '' ? "**********************" : $reg[0]['correocliente']; ?>
  <br/> Nº <?php echo $reg[0]['documcliente'] == '0' ? "DOCUMENTO" : $reg[0]['documento'] ?>: <?php echo $reg[0]['dnicliente'] == '' ? "**********************" : $reg[0]['dnicliente']; ?> - TLF: <?php echo $reg[0]['telefcliente'] == '' ? "**********************" : $reg[0]['telefcliente']; ?></p>
                                            
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                               <thead>
                        <tr class="text-center">
                        <th>#</th>
                        <th>Descripción de Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Valor Total</th>
                        <th>Desc %</th>
                        <th><?php echo $impuesto; ?></th>
                        <th>Valor Neto</th>
                        <th>Acción</th>
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
      <td><h5><?php echo $detalle[$i]['producto']; ?></h5>
      <small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      <td><?php echo $detalle[$i]['cantventa']; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['precioventa'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valortotal'], 2, '.', ','); ?></td>
      <td><?php echo $simbolo.$detalle[$i]['totaldescuentov']; ?><sup><?php echo $detalle[$i]['descproducto']; ?>%</sup></td>
      <td><?php echo $detalle[$i]['ivaproducto'] == 'SI' ? $reg[0]['iva']."%" : "(E)"; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','); ?></td>
 <td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleVentaModal('<?php echo encrypt($detalle[$i]["coddetalleventa"]); ?>','<?php echo encrypt($detalle[$i]["codventa"]); ?>','<?php echo encrypt($reg[0]["codcliente"]); ?>','<?php echo encrypt("DETALLESVENTAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td>
                                                </tr>
                                      <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <div class="pull-right text-right">
<p><b>Total Grabado <?php echo $reg[0]['iva'] ?>%:</b> <?php echo $simbolo.number_format($reg[0]['subtotalivasi'], 2, '.', ','); ?><p>
<p><b>Total Exento 0%:</b> <?php echo $simbolo.number_format($reg[0]['subtotalivano'], 2, '.', ','); ?></p>
<p><b>Total <?php echo $impuesto; ?> (<?php echo $reg[0]['iva']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totaliva'], 2, '.', ','); ?> </p>
<p><b>Desc. Global (<?php echo $reg[0]['descuento']; ?>%):</b> <?php echo $simbolo.number_format($reg[0]['totaldescuento'], 2, '.', ','); ?> </p>
                                        <hr>
<h3><b>Importe Total:</b> <?php echo $simbolo.number_format($reg[0]['totalpago'], 2, '.', ','); ?></h3></div>
                                    <div class="clearfix"></div>
                                    <hr>

                                <div class="col-md-12">
                                    <div class="text-right">
 <a href="reportepdf?codventa=<?php echo encrypt($reg[0]['codventa']); ?>&tipo=<?php echo encrypt($reg[0]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button id="print" class="btn waves-light btn-light" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button></a>
 <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
                                    </div>
                                </div>
                            </div>
                <!-- .row -->
  <?php
       }
   } 
############################# MOSTRAR VENTAS EN VENTANA MODAL ############################
?>


<?php
########################## MOSTRAR DETALLES DE VENTAS UPDATE ############################
if (isset($_GET['MuestraDetallesVentasUpdate']) && isset($_GET['codventa'])) { 
 
$reg = $new->VentasPorId();

?>

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
                        <th>Acción</th>
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

      <td><input type="hidden" name="preciocompra[]" id="preciocompra" value="<?php echo $detalle[$i]["preciocompra"]; ?>"><h5><?php echo $detalle[$i]['producto']; ?></h5><small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>
      
      <td><input type="hidden" name="precioventa[]" id="precioventa" value="<?php echo $detalle[$i]["precioventa"]; ?>"><?php echo $simbolo.$detalle[$i]['precioventa']; ?></td>

       <td><input type="hidden" name="valortotal[]" id="valortotal" value="<?php echo $detalle[$i]["valortotal"]; ?>"><?php echo $simbolo.$detalle[$i]['valortotal']; ?></td>
      
      <td><input type="hidden" name="descproducto[]" id="descproducto" value="<?php echo $detalle[$i]["descproducto"]; ?>"><?php echo $simbolo.$detalle[$i]['totaldescuentov']; ?><sup><?php echo $detalle[$i]['descproducto']; ?>%</sup></td>

      <td><input type="hidden" name="ivaproducto[]" id="ivaproducto" value="<?php echo $detalle[$i]["ivaproducto"]; ?>"><?php echo $detalle[$i]['ivaproducto'] == 'SI' ? $reg[0]['iva']."%" : "(E)"; ?></td>

      <td><?php echo $simbolo.$detalle[$i]['valorneto']; ?></td>
      <td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleVentaUpdate('<?php echo encrypt($detalle[$i]["coddetalleventa"]); ?>','<?php echo encrypt($detalle[$i]["codventa"]); ?>','<?php echo encrypt($reg[0]["codcliente"]); ?>','<?php echo encrypt("DETALLESVENTAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td>
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
<?php
  } 
########################## MOSTRAR DETALLES DE VENTAS UPDATE ############################
?>

<?php
######################### MOSTRAR DETALLES DE VENTAS AGREGAR ############################
if (isset($_GET['MuestraDetallesVentasAgregar']) && isset($_GET['codventa'])) { 
 
$reg = $new->VentasPorId();

?>

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
                        <th>Acción</th>
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
      
      <td><h5><?php echo $detalle[$i]['producto']; ?></h5><small>(<?php echo $detalle[$i]['nomcategoria']; ?>)</small></td>

      <td><?php echo $detalle[$i]['cantventa']; ?></td>
      
      <td><?php echo $simbolo.$detalle[$i]['precioventa']; ?></td>

       <td><?php echo $simbolo.$detalle[$i]['valortotal']; ?></td>
      
      <td><?php echo $simbolo.$detalle[$i]['totaldescuentov']; ?><sup><?php echo $detalle[$i]['descproducto']; ?>%</sup></td>

      <td><?php echo $detalle[$i]['ivaproducto'] == 'SI' ? $reg[0]['iva']."%" : "(E)"; ?></td>

      <td><?php echo $simbolo.$detalle[$i]['valorneto']; ?></td>

      <td>
<button type="button" class="btn btn-rounded btn-dark" onClick="EliminarDetalleVentaAgregar('<?php echo encrypt($detalle[$i]["coddetalleventa"]); ?>','<?php echo encrypt($detalle[$i]["codventa"]); ?>','<?php echo encrypt($reg[0]["codcliente"]); ?>','<?php echo encrypt("DETALLESVENTAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button></td>
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
<?php
  } 
########################## MOSTRAR DETALLES DE VENTAS AGREGAR ##########################
?>


<?php
########################## BUSQUEDA VENTAS POR CAJAS ###########################
if (isset($_GET['BuscaVentasxCajas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $codcaja = limpiar($_GET['codcaja']);
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($codcaja=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU BÚSQUEDA</center>";
   echo "</div>";   
   exit;

} else if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarVentasxCajas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Ventas en Caja <?php echo $reg[0]['nrocaja'].": ".$reg[0]['nomcaja']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("VENTASXCAJAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("VENTASXCAJAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("VENTASXCAJAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>N° de Venta</th>
                                  <th>Descripción de Cliente</th>
                                  <th>Nº de Articulos</th>
                                  <th>Grab</th>
                                  <th>Exen</th>
                                  <th><?php echo $impuesto; ?></th>
                                  <th>Imp. Total</th>
                                  <th>Status</th>
                                  <th>Fecha Emisión</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['codventa']; ?></td>
  <td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
  <td><?php echo $reg[$i]['articulos']; ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['totaliva'], 2, '.', ','); ?><sup><?php echo $reg[$i]['iva']; ?>%</sup></td>
  <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
  <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } ?></td>
  <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
  <td> <a href="reportepdf?codventa=<?php echo encrypt($reg[$i]['codventa']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
######################### BUSQUEDA VENTAS POR CAJAS ########################
?>


<?php
######################### BUSQUEDA VENTAS POR FECHAS ########################
if (isset($_GET['BuscaVentasxFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {
  
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

 if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {

$pre = new Login();
$reg = $pre->BuscarVentasxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Ventas por Fechas Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("VENTASXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("VENTASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("VENTASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>N° de Venta</th>
                                  <th>Descripción de Cliente</th>
                                  <th>Nº de Articulos</th>
                                  <th>Grab</th>
                                  <th>Exen</th>
                                  <th><?php echo $impuesto; ?></th>
                                  <th>Imp. Total</th>
                                  <th>Status</th>
                                  <th>Fecha Emisión</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['codventa']; ?></td>
  <td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento3']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
  <td><?php echo $reg[$i]['articulos']; ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['totaliva'], 2, '.', ','); ?><sup><?php echo $reg[$i]['iva']; ?>%</sup></td>
  <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
  <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } ?></td>
  <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
  <td> <a href="reportepdf?codventa=<?php echo encrypt($reg[$i]['codventa']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php
  
   }
 } 
########################### BUSQUEDA VENTAS POR FECHAS ###########################
?>

<?php 
########################### BUSQUEDA DE DETALLES VENTAS POR FECHAS ##########################
if (isset($_GET['BuscaDetallesVentasxFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 

$desde = limpiar($_GET['desde']); 
$hasta = limpiar($_GET['hasta']);
  
  if($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} else {
  
$vendidos = new Login();
$reg = $vendidos->BuscarDetallesVentasxFechas();  
 ?>
 
 <!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Detalles de Ventas por Fecha</h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("DETALLESVENTASXFECHAS") ?>" target="_blank" rel="noopener noreferrer"  data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("DETALLESVENTASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("DETALLESVENTASXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

      <div class="row">
        <div class="col-md-12">      
            <label class="control-label">Fecha Desde: </label> <?php echo date("d-m-Y", strtotime($desde)); ?><br>

            <label class="control-label">Fecha Hasta: </label> <?php echo date("d-m-Y", strtotime($hasta)); ?>
        </div>
      </div>

          <div id="div2"><table id="datatable-scroller" class="table2 table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Nº</th>
                                  <th>Descripción</th>
                                  <th>Categoria</th>
                                  <th><?php echo $impuesto; ?></th>
                                  <th>Precio de Compra</th>
                                  <th>Precio de Venta</th>
                                  <th>Existencia</th>
                                  <th>Vendido</th>
                                  <th>Total Venta</th>
                                  <th>Total Compra</th>
                                  <th>Ganancias</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
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
                                <tr>
                      <td><?php echo $a++; ?></div></td>
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
                        <?php  }  ?>
                      <tr>
                        <td colspan="4"></td>
                        <td><strong><?php echo $simbolo.number_format($PrecioCompra, 2, '.', ','); ?></strong></td>
                        <td><strong><?php echo $simbolo.number_format($PrecioVenta, 2, '.', ','); ?></strong></td>
                        <td><strong><?php echo $ExisteTotal; ?></strong></td>
                        <td><strong><?php echo $VendidosTotal; ?></strong></td>
                        <td><strong><?php echo $simbolo.number_format($VentaTotal, 2, '.', ','); ?></strong></td>
                        <td><strong><?php echo $simbolo.number_format($CompraTotal, 2, '.', ','); ?></strong></td>
                        <td><strong><?php echo $simbolo.number_format($TotalGanancia, 2, '.', ','); ?></strong></td>
                      </tr>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
    <?php
    } 
  }
########################### BUSQUEDA DE DETALLES VENTAS POR FECHAS ##########################
?>



























<?php
###################### MOSTRAR VENTA DE CREDITO EN VENTANA MODAL ######################
if (isset($_GET['BuscaCreditoModal']) && isset($_GET['codproceso']) && isset($_GET['url'])) { 
 
$reg = $new->CreditosPorId();

if(decrypt($_GET['url'])==1){

?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
  <h3><b class="text-dark">HOTEL</b></h3>
  <p class="text-muted m-l-5"><?php echo $con[0]['nomhotel']; ?>,
  <br/> Nº <?php echo $con[0]['documenhotel'] == '0' ? "DOCUMENTO" : $con[0]['documento'] ?>: <?php echo $con[0]['nrohotel']; ?> <br/> Nº TLF: <?php echo $con[0]['tlfhotel']; ?></p>

  <p class="text-muted m-l-5">Nº RESERVACIÓN: <?php echo $reg[0]['codreservacion']; ?>
  <br>Nº SERIE: <?php echo $reg[0]['codserie']; ?>
  <br>TOTAL FACTURA: <?php echo $simbolo.number_format($reg[0]['totalpago'], 2, '.', ','); ?>
  <br>TOTAL ABONO: <?php echo $simbolo.number_format($reg[0]['abonototal'], 2, '.', ','); ?>
  <br>TOTAL DEBE: <?php echo $simbolo.number_format($reg[0]['totalpago']-$reg[0]['abonototal'], 2, '.', ','); ?>
    
  <?php if($reg[0]['fechavencecredito']!= "0000-00-00") { ?>
  <br>DIAS VENCIDOS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito']); }
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[0]['fechapagado'],$reg[0]['fechavencecredito']); } ?>
  <?php } ?>

  <br>STATUS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuspago"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["statuspago"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[0]['fechavencecredito'] <= date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statuspago"]."</span>"; } ?>
  
  <?php if($reg[0]['fechapagado']!= "0000-00-00") { ?>
  <br>FECHA PAGADA: <?php echo date("d-m-Y",strtotime($reg[0]['fechapagado'])); ?>
  <?php } ?>

  <br>FECHA DE EMISIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fecharegistro'])); ?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
  <h3><b class="text-dark">CLIENTE</b></h3>
  <p class="text-muted m-l-30"><?php echo $reg[0]['nomcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente']; ?>,
  <br/>DIREC: <?php echo $reg[0]['direccliente'] == '' ? "*********" : $reg[0]['direccliente']; ?> - <?php echo paises($reg[0]['paiscliente']); ?>
  <br/> EMAIL: <?php echo $reg[0]['correocliente'] == '' ? "**********************" : $reg[0]['correocliente']; ?>
  <br/> Nº <?php echo $reg[0]['documcliente'] == '0' ? "DOCUMENTO" : $reg[0]['documento'] ?>: <?php echo $reg[0]['dnicliente'] == '' ? "**********************" : $reg[0]['dnicliente']; ?>
  <br/>Nº TLF: <?php echo $reg[0]['telefcliente'] == '' ? "**********************" : $reg[0]['telefcliente']; ?></p>
                                            
                                        </address>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                               <thead>
                        <tr class="text-center"><th colspan="4">Detalles de Abonos</th></tr>
                        <tr class="text-center">
                        <th>#</th>
                        <th>Nº de Caja</th>
                        <th>Monto de Abono</th>
                        <th>Fecha de Abono</th>
                        </tr>
                                            </thead>
                                            <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesAbonos();

if($detalle==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON ABONOS ACTUALMENTE </center>";
    echo "</div>";    

} else {

$a=1;
for($i=0;$i<sizeof($detalle);$i++){  

?>
                                                <tr class="text-center">
      <td><?php echo $a++; ?></td>
      <td><?php echo $detalle[$i]['nrocaja'].": ".$detalle[$i]['nomcaja']; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['montoabono'], 2, '.', ','); ?></td>
      <td><?php echo date("d-m-Y h:i:s",strtotime($detalle[$i]['fechaabono'])); ?></td>
                                                </tr>
                                      <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <hr>

                                <div class="col-md-12">
                                    <div class="text-right">
 <a href="reportepdf?codproceso=<?php echo encrypt($reg[0]['codreservacion']); ?>&url=<?php echo encrypt("1") ?>&tipo=<?php echo encrypt("TICKETCREDITORESERVACIONES") ?>" target="_blank" rel="noopener noreferrer"><button id="print" class="btn waves-light btn-light" type="button"><span><i class="fa fa-print"></i> Imprimir</span></button></a>
 <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
                                    </div>
                                </div>
                              </div>
                <!-- .row -->

<?php } else { ?>

                           <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
  <h3><b class="text-dark">HOTEL</b></h3>
  <p class="text-muted m-l-5"><?php echo $con[0]['nomhotel']; ?>,
  <br/> Nº <?php echo $con[0]['documenhotel'] == '0' ? "DOCUMENTO" : $con[0]['documento'] ?>: <?php echo $con[0]['nrohotel']; ?> <br/> Nº TLF: <?php echo $con[0]['tlfhotel']; ?></p>

  <p class="text-muted m-l-5">Nº VENTA: <?php echo $reg[0]['codventa']; ?>
  <br>Nº SERIE: <?php echo $reg[0]['codserie']; ?>
  <br>TOTAL FACTURA: <?php echo $simbolo.number_format($reg[0]['totalpago'], 2, '.', ','); ?>
  <br>TOTAL ABONO: <?php echo $simbolo.number_format($reg[0]['abonototal'], 2, '.', ','); ?>
  <br>TOTAL DEBE: <?php echo $simbolo.number_format($reg[0]['totalpago']-$reg[0]['abonototal'], 2, '.', ','); ?>
    
  <?php if($reg[0]['fechavencecredito']!= "0000-00-00") { ?>
  <br>DIAS VENCIDOS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito']); }
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[0]['fechapagado'],$reg[0]['fechavencecredito']); } ?>
  <?php } ?>

  <br>STATUS: 
  <?php if($reg[0]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statusventa"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] >= date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[0]["statusventa"]."</span>"; } 
        elseif($reg[0]['fechavencecredito'] < date("Y-m-d") && $reg[0]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[0]['fechavencecredito'] <= date("Y-m-d") && $reg[0]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[0]["statusventa"]."</span>"; } ?>
  
  <?php if($reg[0]['fechapagado']!= "0000-00-00") { ?>
  <br>FECHA PAGADA: <?php echo date("d-m-Y",strtotime($reg[0]['fechapagado'])); ?>
  <?php } ?>

  <br>FECHA DE EMISIÓN: <?php echo date("d-m-Y",strtotime($reg[0]['fechaventa'])); ?></p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
  <h3><b class="text-dark">CLIENTE</b></h3>
  <p class="text-muted m-l-30"><?php echo $reg[0]['nomcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente']; ?>,
  <br/>DIREC: <?php echo $reg[0]['direccliente'] == '' ? "*********" : $reg[0]['direccliente']; ?> - <?php echo paises($reg[0]['paiscliente']); ?>
  <br/> EMAIL: <?php echo $reg[0]['correocliente'] == '' ? "**********************" : $reg[0]['correocliente']; ?>
  <br/> Nº <?php echo $reg[0]['documcliente'] == '0' ? "DOCUMENTO" : $reg[0]['documento'] ?>: <?php echo $reg[0]['dnicliente'] == '' ? "**********************" : $reg[0]['dnicliente']; ?>
  <br/>Nº TLF: <?php echo $reg[0]['telefcliente'] == '' ? "**********************" : $reg[0]['telefcliente']; ?></p>
                                            
                                        </address>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                               <thead>
                        <tr class="text-center"><th colspan="4">Detalles de Abonos</th></tr>
                        <tr class="text-center">
                        <th>#</th>
                        <th>Nº de Caja</th>
                        <th>Monto de Abono</th>
                        <th>Fecha de Abono</th>
                        </tr>
                                            </thead>
                                            <tbody>
<?php 
$tra = new Login();
$detalle = $tra->VerDetallesAbonos();

if($detalle==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON ABONOS ACTUALMENTE </center>";
    echo "</div>";    

} else {

$a=1;
for($i=0;$i<sizeof($detalle);$i++){  

?>
                                                <tr class="text-center">
      <td><?php echo $a++; ?></td>
      <td><?php echo $detalle[$i]['nrocaja'].": ".$detalle[$i]['nomcaja']; ?></td>
      <td><?php echo $simbolo.number_format($detalle[$i]['montoabono'], 2, '.', ','); ?></td>
      <td><?php echo date("d-m-Y h:i:s",strtotime($detalle[$i]['fechaabono'])); ?></td>
                                                </tr>
                                      <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <hr>

                                <div class="col-md-12">
                                    <div class="text-right">
 <a href="reportepdf?codproceso=<?php echo encrypt($reg[0]['codventa']); ?>&url=<?php echo encrypt("2") ?>&tipo=<?php echo encrypt("TICKETCREDITOVENTA") ?>" target="_blank" rel="noopener noreferrer"><button id="print" class="btn waves-light btn-light" type="button"><span><i class="fa fa-print"></i> Imprimir</span></button></a>
 <button type="button" class="btn btn-dark" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cerrar</button>
                                    </div>
                                </div>
                              </div>
                <!-- .row -->


  <?php
      }
  } 
####################### MOSTRAR VENTA DE CREDITO EN VENTANA MODAL ######################
?>


<?php
######################### BUSQUEDA CREDITOS POR CLIENTES ########################
if (isset($_GET['BuscaCreditosxClientes']) && isset($_GET['codcliente']) && isset($_GET['url'])) {
  
  $codcliente = limpiar($_GET['codcliente']);
  $url = limpiar(decrypt($_GET['url']));

 if($codcliente=="") {

   echo "<div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<center><span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL CLIENTE CORRECTAMENTE</center>";
   echo "</div>";   
   exit;

  } elseif($url== ""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TIPO DE CRÉDITO PARA TU BÚSQUEDA </center>";
    echo "</div>";    
    exit;

  } elseif($url!= 1 && $url!= 2){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> HA OCURRIDO UN ERROR EN EL PROCESAMIENTO DE LA INFORMACIÓN, VERIFIQUE NUEVAMENTE </center>";
    echo "</div>";    
    exit;

  } elseif($url==1){

$pre = new Login();
$reg = $pre->BuscarCreditosxClientes();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Créditos en Reservaciones del Cliente <?php echo $reg[0]['dnicliente'].": ".$reg[0]['nomcliente']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcliente=<?php echo $codcliente; ?>&url=<?php echo encrypt($url); ?>&tipo=<?php echo encrypt("CREDITOSXCLIENTES") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcliente=<?php echo $codcliente; ?>&url=<?php echo encrypt($url); ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CREDITOSXCLIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcliente=<?php echo $codcliente; ?>&url=<?php echo encrypt($url); ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CREDITOSXCLIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>N° de Reservación</th>
                                  <th>Descripción de Cliente</th>
                                  <th>Imp. Total</th>
                                  <th>Total Abono</th>
                                  <th>Total Debe</th>
                                  <th>Status</th>
                                  <th>Dias Venc</th>
                                  <th>Fecha Emisión</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['codreservacion']; ?></td>
  <td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>
      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>
  <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
  <td> <a href="reportepdf?codproceso=<?php echo encrypt($reg[$i]['codreservacion']); ?>&url=<?php echo encrypt($url); ?>&tipo=<?php echo encrypt("TICKETCREDITORESERVACIONES"); ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php } else { 

$pre = new Login();
$reg = $pre->BuscarCreditosxClientes();
?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Créditos en Ventas del Cliente <?php echo $reg[0]['dnicliente'].": ".$reg[0]['nomcliente']; ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?codcliente=<?php echo $codcliente; ?>&url=<?php echo encrypt($url); ?>&tipo=<?php echo encrypt("CREDITOSXCLIENTES") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcliente=<?php echo $codcliente; ?>&url=<?php echo encrypt($url); ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CREDITOSXCLIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?codcliente=<?php echo $codcliente; ?>&url=<?php echo encrypt($url); ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CREDITOSXCLIENTES") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>N° de Venta</th>
                                  <th>Descripción de Cliente</th>
                                  <th>Imp. Total</th>
                                  <th>Total Abono</th>
                                  <th>Total Debe</th>
                                  <th>Status</th>
                                  <th>Dias Venc</th>
                                  <th>Fecha Emisión</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['codventa']; ?></td>
  <td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>
      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>
  <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
  <td> <a href="reportepdf?codproceso=<?php echo encrypt($reg[$i]['codventa']); ?>&url=<?php echo encrypt($url); ?>&tipo=<?php echo encrypt("TICKETCREDITOVENTA"); ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
<?php
  
   }
 } 
######################### BUSQUEDA CREDITOS POR CLIENTES ########################
?>


<?php
######################### BUSQUEDA CREDITOS POR FECHAS ########################
if (isset($_GET['BuscaCreditosxFechas']) && isset($_GET['desde']) && isset($_GET['hasta']) && isset($_GET['url'])) {
  
  $url = limpiar(decrypt($_GET['url']));
  $desde = limpiar($_GET['desde']);
  $hasta = limpiar($_GET['hasta']);

  if($url== ""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TIPO DE CRÉDITO PARA TU BÚSQUEDA </center>";
    echo "</div>";    
    exit;

  } elseif($url!= 1 && $url!= 2){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> HA OCURRIDO UN ERROR EN EL PROCESAMIENTO DE LA INFORMACIÓN, VERIFIQUE NUEVAMENTE </center>";
    echo "</div>";    
    exit;

  } elseif($desde=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;


} else if($hasta=="") {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BÚSQUEDA</center>";
  echo "</div>"; 
  exit;

} elseif (strtotime($desde) > strtotime($hasta)) {

  echo "<div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE FIN</center>";
  echo "</div>"; 
  exit;

} elseif($url==1){

$pre = new Login();
$reg = $pre->BuscarCreditosxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Créditos en Reservaciones por Fechas Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?url=<?php echo encrypt($url); ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CREDITOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?url=<?php echo encrypt($url); ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CREDITOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?url=<?php echo encrypt($url); ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CREDITOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>N° de Reservación</th>
                                  <th>Descripción de Cliente</th>
                                  <th>Imp. Total</th>
                                  <th>Total Abono</th>
                                  <th>Total Debe</th>
                                  <th>Status</th>
                                  <th>Dias Venc</th>
                                  <th>Fecha Emisión</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['codreservacion']; ?></td>
  <td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>
      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>
  <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
  <td> <a href="reportepdf?codproceso=<?php echo encrypt($reg[$i]['codreservacion']); ?>&url=<?php echo encrypt($url); ?>&tipo=<?php echo encrypt("TICKETCREDITORESERVACIONES"); ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php } else { 

$pre = new Login();
$reg = $pre->BuscarCreditosxFechas();
  ?>

<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Créditos en Ventas por Fechas Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div class="row">
            <div class="col-md-7">
              <div class="btn-group m-b-20">
              <a class="btn waves-effect waves-light btn-light" href="reportepdf?url=<?php echo encrypt($url); ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo encrypt("CREDITOSXFECHAS") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?url=<?php echo encrypt($url); ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("CREDITOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>

              <a class="btn waves-effect waves-light btn-light" href="reporteexcel?url=<?php echo encrypt($url); ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("CREDITOSXFECHAS") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
              </div>
            </div>
          </div>

          <div id="div2"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th>Nº</th>
                                  <th>N° de Venta</th>
                                  <th>Descripción de Cliente</th>
                                  <th>Imp. Total</th>
                                  <th>Total Abono</th>
                                  <th>Total Debe</th>
                                  <th>Status</th>
                                  <th>Dias Venc</th>
                                  <th>Fecha Emisión</th>
                                  <th>Reporte</th>
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['codventa']; ?></td>
  <td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['abonototal'], 2, '.', ','); ?></td>
           <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','); ?></td>
      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>
  <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
  <td> <a href="reportepdf?codproceso=<?php echo encrypt($reg[$i]['codventa']); ?>&url=<?php echo encrypt($url); ?>&tipo=<?php echo encrypt("TICKETCREDITOVENTA"); ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a></td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->
<?php
  
   }
 } 
######################### BUSQUEDA CREDITOS POR FECHAS ########################
?>
















<?php 
############################# MUESTRA MENSAJES EN CHAT #############################################
if (isset($_GET['CargaChat'])) {
  
$chat = new Login();
$chat = $chat->ListarMensajes(); 

if($chat==""){
    
    echo "";   

} else {

$a=1;
for($i=0;$i<sizeof($chat);$i++){  
?>

  <?php if ($chat[$i]['tipo']!= "U") { ?>    

    <!--chat Row -->
    <li class="chat-item">
      <div class="chat-img">
        <?php if (file_exists("fotos/".$chat[$i]['dnicliente'].".jpg")){
          echo "<img src='fotos/".$chat[$i]['dnicliente'].".jpg?'>"; 
        } else {
          echo "<img src='fotos/cliente.jpg'>"; 
        } ?></div>
        <div class="chat-content">
          <div class="box bg-light-success">
            <h5 class="font-medium alert-link"><?php echo $chat[$i]['nomcliente']; ?></h5>
            <p class="font-light mb-0"><?php echo $chat[$i]['mensaje']; ?></p>
          <div class="chat-time alert-link"><?php echo date("d-m-Y H:i:s",strtotime($chat[$i]['tiempo'])); ?></div>
        </div>
      </div>
    </li>

  <?php } else { ?>

    <!--chat Row -->
    <li class="odd chat-item">
      <div class="chat-content">
        <div class="box bg-light-success">
          <h5 class="font-medium alert-link"><?php echo $chat[$i]['nivel']; ?></h5>
          <p class="font-light mb-0"><?php echo $chat[$i]['mensaje']; ?></p>
          <div class="chat-time alert-link"><?php echo date("d-m-Y H:i:s",strtotime($chat[$i]['tiempo'])); ?></div>
          </div>
        </div>
      <div class="chat-img">
        <?php if (file_exists("fotos/".$chat[$i]['dni'].".jpg")){
            echo "<img src='fotos/".$chat[$i]['dni'].".jpg?'>"; 
        } else {
            echo "<img src='fotos/avatar.jpg'>"; 
        } ?></div>
    </li>

<?php
      } 
    }
  }
}
############################# FIN DE MUESTRA MENSAJES EN CHAT ######################################
?>