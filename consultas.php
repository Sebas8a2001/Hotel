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
    
$tra = new Login();
?>


<?php
############################# CARGAR MENSAJES ############################
if (isset($_GET['CargaMensajes'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombres</th>
                                                    <th>N° de Teléfono</th>
                                                    <th>Email</th>
                                                    <th>Asunto</th>
                                                    <th>Mensaje</th>
                                                    <th>Recibido</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarContact();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON MENSAJES DE CONTACTO ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                  <tr role="row" class="odd">
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['name']; ?></td>
                                  <td><?php echo $reg[$i]['phone'] == '' ? "*********" : $reg[$i]['phone']; ?></td>
                                  <td><?php echo $reg[$i]['email']; ?></td>
                                  <td><?php echo $reg[$i]['subject']; ?></td>
                                  <td><?php echo $reg[$i]['message']; ?></td>
                                  <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]["fecha"])); ?></td>
                                               <td>

<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerMensaje('<?php echo encrypt($reg[$i]["codmensaje"]); ?>')"><i class="fa fa-eye"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarMensaje('<?php echo encrypt($reg[$i]["codmensaje"]); ?>','<?php echo encrypt("MENSAJES"); ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR MENSAJES ############################
?>


<?php
############################# CARGAR USUARIOS ############################
if (isset($_GET['CargaUsuarios'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Documento</th>
                                                    <th>Nombres y Apellidos</th>
                                                    <th>Sexo</th>
                                                    <th>Nº de Teléfono</th>
                                                    <th>Nivel</th>
                                                    <th>Status</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarUsuarios();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON USUARIOS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['dni']; ?></td>
                                               <td><?php echo $reg[$i]['nombres']; ?></td>
                                               <td><?php echo $reg[$i]['sexo']; ?></td>
                                               <td><?php echo $reg[$i]['telefono']; ?></td>
                                               <td><?php echo $reg[$i]['nivel']; ?></td>
<td><?php echo $status = ( $reg[$i]['status'] == 1 ? "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ACTIVO</span>" : "<span class='badge badge-pill badge-dark'><i class='fa fa-times'></i> INACTIVO</span>"); ?></td>
                                               <td>

<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerUsuario('<?php echo encrypt($reg[$i]["codigo"]); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalUser" data-backdrop="static" data-keyboard="false" onClick="UpdateUsuario('<?php echo $reg[$i]["codigo"]; ?>','<?php echo $reg[$i]["dni"]; ?>','<?php echo $reg[$i]["nombres"]; ?>','<?php echo $reg[$i]["sexo"]; ?>','<?php echo $reg[$i]["direccion"]; ?>','<?php echo $reg[$i]["telefono"]; ?>','<?php echo $reg[$i]["email"]; ?>','<?php echo $reg[$i]["usuario"]; ?>','<?php echo $reg[$i]["nivel"]; ?>','<?php echo $reg[$i]["status"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarUsuario('<?php echo encrypt($reg[$i]["codigo"]); ?>','<?php echo encrypt($reg[$i]["dni"]); ?>','<?php echo encrypt("USUARIOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR USUARIOS ############################
?>


<?php
############################# CARGAR LOGS DE USUARIOS ############################
if (isset($_GET['CargaLogs'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Ip de Acceso</th>
                                                    <th>Fecha de Acceso</th>
                                                    <th>Navegador de Acceso</th>
                                                    <th>Usuario de Acceso</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarLogs();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON REGISTROS DE ACCESO ACTUALMENTE</center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['ip']; ?></td>
                                               <td><?php echo date("d-m-Y h:i:s A",strtotime($reg[$i]['tiempo'])); ?></td>
                                               <td><?php echo $reg[$i]['detalles']; ?></td>
                                               <td><?php echo $reg[$i]['usuario']; ?></td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR LOGS DE USUARIOS ############################
?>


<?php
############################# CARGAR CATEGORIAS ############################
if (isset($_GET['CargaCategorias'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Categoria</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCategorias();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CATEGORIAS DE PRODUCTOS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['nomcategoria']; ?></td>
                                               <td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateCategoria('<?php echo $reg[$i]["codcategoria"]; ?>','<?php echo $reg[$i]["nomcategoria"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarCategoria('<?php echo encrypt($reg[$i]["codcategoria"]); ?>','<?php echo encrypt("CATEGORIAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR CATEGORIAS ############################
?>


<?php
############################# CARGAR TIPOS DE DOCUMENTOS ############################
if (isset($_GET['CargaDocumentos'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción de Documento</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarDocumentos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TIPOS DE DOCUMENTOS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['documento']; ?></td>
                                               <td><?php echo $reg[$i]['descripcion']; ?></td>
                                               <td>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateDocumento('<?php echo $reg[$i]["coddocumento"]; ?>','<?php echo $reg[$i]["documento"]; ?>','<?php echo $reg[$i]["descripcion"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarDocumento('<?php echo encrypt($reg[$i]["coddocumento"]); ?>','<?php echo encrypt("DOCUMENTOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR TIPOS DE DOCUMENTOS ############################
?>


<?php
############################# CARGAR TIPOS DE MONEDA ############################
if (isset($_GET['CargaMonedas'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Moneda</th>
                                                    <th>Siglas</th>
                                                    <th>Simbolo</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarTipoMoneda();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TIPOS DE MONEDAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['moneda']; ?></td>
                                               <td><?php echo $reg[$i]['siglas']; ?></td>
                                               <td><?php echo $reg[$i]['simbolo']; ?></td>
                                               <td>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateTipoMoneda('<?php echo $reg[$i]["codmoneda"]; ?>','<?php echo $reg[$i]["moneda"]; ?>','<?php echo $reg[$i]["siglas"]; ?>','<?php echo $reg[$i]["simbolo"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarTipoMoneda('<?php echo encrypt($reg[$i]["codmoneda"]); ?>','<?php echo encrypt("TIPOMONEDA") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR TIPOS DE MONEDA ############################
?>


<?php
############################# CARGAR TIPOS DE CAMBIO ############################
if (isset($_GET['CargaCambios'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Descripción de Cambio</th>
                                                    <th>Monto de Cambio</th>
                                                    <th>Tipo Moneda</th>
                                                    <th>Fecha Ingreso</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarTipoCambio();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TIPOS DE CAMBIO DE MONEDA ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['descripcioncambio']; ?></td>
                                               <td><?php echo $reg[$i]['montocambio']; ?></td>
  <td><abbr title="<?php echo "Siglas: ".$reg[$i]['siglas']; ?>"><?php echo $reg[$i]['moneda']; ?></abbr></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechacambio'])); ?></td>
                    <td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateTipoCambio('<?php echo $reg[$i]["codcambio"]; ?>','<?php echo $reg[$i]["descripcioncambio"]; ?>','<?php echo $reg[$i]["montocambio"]; ?>','<?php echo $reg[$i]["codmoneda"]; ?>','<?php echo date("Y-m-d",strtotime($reg[$i]['fechacambio'])); ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarTipoCambio('<?php echo encrypt($reg[$i]["codcambio"]); ?>','<?php echo encrypt("TIPOCAMBIO") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR TIPOS DE CAMBIO ############################
?>


<?php
############################# CARGAR MEDIOS DE PAGOS ############################
if (isset($_GET['CargaMediosPagos'])) { 
?>

<div class="table-responsive"><table id="datatable" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Medio de Pago</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarMediosPagos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON MEDIOS DE PAGOS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['mediopago']; ?></td>
                                               <td>
<?php if ($_SESSION["acceso"]!="administradorG") { ?>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateMedio('<?php echo $reg[$i]["codmediopago"]; ?>','<?php echo $reg[$i]["mediopago"]; ?>','update')"><i class="fa fa-edit"></i></button>
<?php } ?>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarMedio('<?php echo encrypt($reg[$i]["codmediopago"]); ?>','<?php echo encrypt("MEDIOSPAGOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR MEDIOS DE PAGOS ############################
?>


<?php
############################# CARGAR IMPUESTOS ############################
if (isset($_GET['CargaImpuestos'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Impuesto</th>
                                                    <th>Valor (%)</th>
                                                    <th>Status</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarImpuestos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON IMPUESTOS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['nomimpuesto']; ?></td>
                                               <td><?php echo $reg[$i]['valorimpuesto']; ?></td>
<td><?php echo $status = ( $reg[$i]['statusimpuesto'] == 'ACTIVO' ? "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[$i]['statusimpuesto']."</span>" : "<span class='badge badge-pill badge-dark'><i class='fa fa-times'></i> ".$reg[$i]['statusimpuesto']."</span>"); ?></td>
                                               <td>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateImpuesto('<?php echo $reg[$i]["codimpuesto"]; ?>','<?php echo $reg[$i]["nomimpuesto"]; ?>','<?php echo $reg[$i]["valorimpuesto"]; ?>','<?php echo $reg[$i]["statusimpuesto"]; ?>','<?php echo date("d-m-Y",strtotime($reg[$i]['fechaimpuesto'])); ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarImpuesto('<?php echo encrypt($reg[$i]["codimpuesto"]); ?>','<?php echo encrypt("IMPUESTOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>

       
 <?php 
   } 
############################# CARGAR IMPUESTOS ############################
?>


<?php
############################# CARGAR PERFIL DE HOTEL ############################
if (isset($_GET['CargaPerfil'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Perfil</th>
                                                    <th>Descripción de Pefil</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarPerfil();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON PERFIL DEL HOTEL ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['nomperfil']; ?></td>
                                               <td><?php echo $reg[$i]['descperfil']; ?></td>
                                               <td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdatePerfil('<?php echo $reg[$i]["codperfil"]; ?>','<?php echo $reg[$i]["nomperfil"]; ?>','<?php echo preg_replace("/\r\n|\r|\n/",'\n',$reg[$i]["descperfil"]); ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarPerfil('<?php echo encrypt($reg[$i]["codperfil"]); ?>','<?php echo encrypt("PERFIL") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR PERFIL DE HOTEL ############################
?>


<?php
############################# CARGAR TEMPORADAS ############################
if (isset($_GET['CargaTemporadas'])) { 
?>

<div class="table-responsive"><table id="datatable" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Temporada</th>
                                                    <th>Fecha Desde</th>
                                                    <th>Fecha Hasta</th>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><th>Acciones</th><?php } ?>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarTemporadas();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TEMPORADAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['temporada']; ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") { ?><td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateTemporada('<?php echo $reg[$i]["codtemporada"]; ?>','<?php echo $reg[$i]['temporada']; ?>','<?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?>','<?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarTemporada('<?php echo encrypt($reg[$i]["codtemporada"]); ?>','<?php echo encrypt("TEMPORADAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td><?php } ?>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR TEMPORADAS ############################
?>


<?php
############################# CARGAR NOTICIAS ############################
if (isset($_GET['CargaNoticias'])) { 
?>

<div class="table-responsive"><table id="datatable" class="table display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th><h4>Descripción de Noticias</h4></th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarNoticias();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON NOTICIAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                          <tr role="row" class="odd">
                                <td><ul class="search-listing list-style-none"><a class="border-bottom pt-0">
                                        <h4 class="mb-0"><a href="#" class="text-cyan font-medium p-0"><?php echo $reg[$i]['titulonoticia']; ?></a></h4>
                                        <a href="#" class="search-links p-0 text-success">
                                          <?php echo $reg[$i]['statusnoticia'] == 'NO PUBLICADA' ? "NO PUBLICADA" : date("d-m-Y h:i:s",strtotime($reg[$i]['publicado'])); ?></a>
                                        <p><?php echo $reg[$i]['descripcnoticia']; ?></p>
                                    
            <?php if ($_SESSION["acceso"]=="administrador" || $_SESSION['acceso'] == "secretaria") { ?>

                                    <span class="text-info" style="font-size: 20px;cursor: pointer;" onClick="UpdateNoticia('<?php echo $reg[$i]["codnoticia"]; ?>','<?php echo $reg[$i]["titulonoticia"]; ?>','<?php echo $reg[$i]["descripcnoticia"]; ?>','<?php echo $reg[$i]["statusnoticia"]; ?>','update')" title="Editar" ><i class="fa fa-edit"></i></span>

                                    <span class="text-dark" style="font-size: 20px;cursor: pointer;" onClick="EliminarNoticia('<?php echo encrypt($reg[$i]["codnoticia"]); ?>','<?php echo encrypt("NOTICIAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></span>
            <?php } ?> </a>
                                </ul></td>
                                            </tr>
                                      <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR NOTICIAS ############################
?>


<?php
############################# CARGAR TIPOS DE HABITACIONES ############################
if (isset($_GET['CargaTipos'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Tipo</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarTipos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TIPOS DE HABITACIONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['nomtipo']; ?></td>
                                               <td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateTipo('<?php echo $reg[$i]["codtipo"]; ?>','<?php echo $reg[$i]["nomtipo"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarTipo('<?php echo encrypt($reg[$i]["codtipo"]); ?>','<?php echo encrypt("TIPOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR TIPOS DE HABITACIONES ############################
?>


<?php
############################# CARGAR TARIFAS DE HABITACIONES ############################
if (isset($_GET['CargaTarifas'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Tipo de Habitación</th>
                                                    <th>Temporada Baja</th>
                                                    <th>Temporada Media</th>
                                                    <th>Temporada Alta</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarTarifas();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON TARIFAS DE HABITACIONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                                    <tr role="row" class="odd">
                                            <td><?php echo $a++; ?></td>
                                            <td><?php echo $reg[$i]['nomtipo']; ?></td>
                                            <td><?php echo $simbolo.number_format($reg[$i]['baja'], 2, '.', ','); ?></td>
                                            <td><?php echo $simbolo.number_format($reg[$i]['media'], 2, '.', ','); ?></td>
                                            <td><?php echo $simbolo.number_format($reg[$i]['alta'], 2, '.', ','); ?></td>
                                    <td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateTarifa('<?php echo $reg[$i]["codtarifa"]; ?>','<?php echo $reg[$i]["codtipo"]; ?>','<?php echo $reg[$i]["baja"]; ?>','<?php echo $reg[$i]["media"]; ?>','<?php echo $reg[$i]["alta"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarTarifa('<?php echo encrypt($reg[$i]["codtarifa"]); ?>','<?php echo encrypt("TARIFAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR TARIFAS DE HABITACIONES ############################
?>


<?php
############################# CARGAR HABITACIONES ############################
if (isset($_GET['CargaHabitaciones'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Img</th>
                                                    <th>N° de Habitación</th>
                                                    <th>Tipo de Habitación</th>
                                                    <th>Máximo Adultos</th>
                                                    <th>Máximo Niños</th>
                                                    <th>Baja</th>
                                                    <th>Media</th>
                                                    <th>Alta</th>
<?php if ($_SESSION['acceso'] == "cliente") { ?><th>Ver</th><?php } else { ?><th>Acciones</th><?php } ?>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarHabitaciones();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON HABITACIONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
<td><?php
$directory='fotos/habitaciones/'.$reg[$i]["codhabitacion"];

if (is_dir($directory)) {
$dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false) {
              
    if ($archivo != "." && $archivo != ".." && substr_count($archivo , ".jpg")==1 || substr_count($archivo , ".JPG")==1 ){
    
    echo '<a href="'.$directory."/".$archivo.'" class="image-zoom" rel="prettyPhoto[pp_gallery'.$reg[$i]["codhabitacion"].']" title="Habitación N° #'.$reg[$i]["numhabitacion"].'">';

       }
    } $dirint->close(); 
  } else { } ?>
    <?php if (file_exists("fotos/habitaciones/".$reg[$i]["codhabitacion"]."/1.JPG")){
    echo "<img src='fotos/habitaciones/".$reg[$i]["codhabitacion"]."/1.JPG?' class='img-rounded' style='margin:0px;' width='50' height='40'>";
       }else{
    echo "<img src='fotos/ninguna.png' class='img-rounded' style='margin:0px;' width='50' height='40'>";  
    } ?></a></td>
                                               <td><?php echo $reg[$i]['numhabitacion']; ?></td>
                                               <td><?php echo $reg[$i]['nomtipo']; ?></td>
                                               <td><i class="fa fa-male"></i> x<?php echo $reg[$i]['maxadultos']; ?></td>
                                               <td><i class="fa fa-child"></i> x<?php echo $reg[$i]['maxninos']; ?></td>
                                               <td><?php echo $simbolo.number_format($reg[$i]['baja'], 2, '.', ','); ?></td>
                                               <td><?php echo $simbolo.number_format($reg[$i]['media'], 2, '.', ','); ?></td>
                                               <td><?php echo $simbolo.number_format($reg[$i]['alta'], 2, '.', ','); ?></td>
<td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerHabitacion('<?php echo encrypt($reg[$i]["codhabitacion"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria") { ?>
<button type="button" class="btn btn-info btn-rounded" onClick="UpdateHabitacion('<?php echo encrypt($reg[$i]["codhabitacion"]); ?>','<?php echo encrypt($reg[$i]["numhabitacion"]); ?>')" title="Editar" ><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarHabitacion('<?php echo encrypt($reg[$i]["codhabitacion"]); ?>','<?php echo encrypt("HABITACIONES") ?>')" title="Eliminar"><i class="fa fa-trash-o"></i></button><?php } ?>

 </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR HABITACIONES ############################
?>


<?php
############################# CARGAR CLIENTES ############################
if (isset($_GET['CargaClientes'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nº de Documento</th>
                                                    <th>Nombres</th>
                                                    <th>Nº de Teléfono</th>
                                                    <th>Correo Electrónico</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarClientes();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CLIENTES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
<td><?php echo "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento'])." ".$reg[$i]['dnicliente']; ?></td>
                                             
                  <td><?php echo $reg[$i]['nomcliente']; ?></td>
                  <td><?php echo $reg[$i]['telefcliente'] == '' ? "***********" : $reg[$i]['telefcliente']; ?></td>
                  <td><?php echo $reg[$i]['correocliente'] == '' ? "***********" : $reg[$i]['correocliente']; ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerCliente('<?php echo encrypt($reg[$i]["codcliente"]); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalCliente" data-backdrop="static" data-keyboard="false" onClick="UpdateCliente('<?php echo $reg[$i]["codcliente"]; ?>','<?php echo $reg[$i]["documcliente"]; ?>','<?php echo $reg[$i]["dnicliente"]; ?>','<?php echo $reg[$i]["nomcliente"]; ?>','<?php echo $reg[$i]["paiscliente"]; ?>','<?php echo $reg[$i]["ciudadcliente"]; ?>','<?php echo $reg[$i]["direccliente"]; ?>','<?php echo $reg[$i]["telefcliente"]; ?>','<?php echo $reg[$i]["correocliente"]; ?>','<?php echo $reg[$i]["limitecredito"]; ?>','update')"><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-warning btn-rounded" onClick="ReiniciarClave('<?php echo encrypt($reg[$i]["codcliente"]); ?>','<?php echo encrypt($reg[$i]["dnicliente"]); ?>','<?php echo encrypt("REINICIAR") ?>')" title="Reiniciar Clave" ><font color="white"><i class="fa fa-key"></i></font></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarCliente('<?php echo encrypt($reg[$i]["codcliente"]); ?>','<?php echo encrypt("CLIENTES") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR CLIENTES ############################
?>


<?php
############################# CARGAR PROVEEDORES ############################
if (isset($_GET['CargaProveedores'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombres de Proveedor</th>
                                                    <th>Correo Electrónico</th>
                                                    <th>Nº de Teléfono</th>
                                                    <th>Vendedor</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarProveedores();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON PROVEEDORES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
<td><abbr title="<?php echo "Nº ".$documento = ($reg[$i]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[$i]['documento'])." ".$reg[$i]['cuitproveedor']; ?>"><?php echo $reg[$i]['nomproveedor']; ?></abbr></td>
           <td><?php echo $reg[$i]['emailproveedor'] == '' ? "*********" : $reg[$i]['emailproveedor']; ?></td>
           <td><?php echo $reg[$i]['tlfproveedor'] == '' ? "*********" : $reg[$i]['tlfproveedor']; ?></td>
           <td><?php echo $reg[$i]['vendedor'] == '' ? "*********" : $reg[$i]['vendedor']; ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerProveedor('<?php echo encrypt($reg[$i]["codproveedor"]); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalProveedor" data-backdrop="static" data-keyboard="false" onClick="UpdateProveedor('<?php echo $reg[$i]["codproveedor"]; ?>','<?php echo $reg[$i]["documproveedor"]; ?>','<?php echo $reg[$i]["cuitproveedor"]; ?>','<?php echo $reg[$i]["nomproveedor"]; ?>','<?php echo $reg[$i]["tlfproveedor"]; ?>','<?php echo $reg[$i]["direcproveedor"]; ?>','<?php echo $reg[$i]["emailproveedor"]; ?>','<?php echo $reg[$i]["vendedor"]; ?>','<?php echo $reg[$i]["tlfvendedor"]; ?>','update')"><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarProveedor('<?php echo encrypt($reg[$i]["codproveedor"]); ?>','<?php echo encrypt("PROVEEDORES") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR PROVEEDORES ############################
?>


<?php
############################# CARGAR INSUMOS EN ALMACEN ############################
if (isset($_GET['CargaInsumos'])) {
$monedap = new Login();
$cambio = $monedap->MonedaProductoId(); 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Insumo</th>
                                                    <th>Categoria</th>
                                                    <th>P.V.P</th>
                                <th><?php echo $cambio == '' ? "*****" : "P.V. ".$cambio[0]['siglas']; ?></th>
                                                    <th>Existencia</th>
                                                    <th><?php echo $impuesto; ?></th>
                                                    <th>Descto</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarInsumos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON INSUMOS DE LIMPIEZA ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
  <td><abbr title="CÓDIGO: <?php echo $reg[$i]['codinsumo']; ?>"><?php echo $reg[$i]['insumo']; ?></abbr></td>
                                              <td><?php echo $reg[$i]['nomcategoria']; ?></td>
                                              <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
<td><?php echo $cambio == '' ? "*****" : "<strong>".$cambio[0]['simbolo']."</strong>".number_format($reg[$i]['precioventa']/$cambio[0]['montocambio'], 2, '.', ','); ?></td>
                                               <td><?php echo $reg[$i]['existencia']; ?></td>
                                               <td><?php echo $reg[$i]['ivainsumo'] == 'SI' ? $valor."%" : "(E)"; ?></td>
                                               <td><?php echo $reg[$i]['descinsumo']; ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerInsumo('<?php echo encrypt($reg[$i]["codinsumo"]); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalInsumos" data-backdrop="static" data-keyboard="false" onClick="UpdateInsumo('<?php echo $reg[$i]["codinsumo"]; ?>','<?php echo $reg[$i]["insumo"]; ?>','<?php echo $reg[$i]["codcategoria"]; ?>','<?php echo $reg[$i]["preciocompra"]; ?>','<?php echo $reg[$i]["precioventa"]; ?>','<?php echo $reg[$i]["existencia"]; ?>','<?php echo $reg[$i]["stockminimo"]; ?>','<?php echo $reg[$i]["ivainsumo"]; ?>','<?php echo $reg[$i]["descinsumo"]; ?>','<?php echo $reg[$i]['fechaexpiracion'] == '0000-00-00' ? "0000-00-00" : date("d-m-Y",strtotime($reg[$i]['fechaexpiracion'])); ?>','<?php echo $reg[$i]['codproveedor'] == '' ? "0" : $reg[$i]['codproveedor']; ?>','<?php echo $reg[$i]["lote"]; ?>','update')"><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarInsumo('<?php echo encrypt($reg[$i]["codinsumo"]); ?>','<?php echo encrypt("INSUMOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR INSUMOS EN ALMACEN ############################
?>


<?php
############################# CARGAR ENTRADAS INSUMOS ############################
if (isset($_GET['CargaEntradaInsumos'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Insumo</th>
                                                    <th>Cantidad</th>
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarEntradaInsumos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON ENTRADAS DE INSUMOS DE LIMPIEZA ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
  <td><abbr title="CÓDIGO: <?php echo $reg[$i]['codinsumo']; ?>"><?php echo $reg[$i]['insumo']; ?></abbr></td>
                                               <td><?php echo $reg[$i]['cantentrada']; ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaentrada'])); ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerEntradaInsumo('<?php echo encrypt($reg[$i]["codentrada"]); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" onClick="UpdateEntradaInsumo('<?php echo $reg[$i]["codentrada"]; ?>','<?php echo $reg[$i]["codinsumo"]; ?>','<?php echo $reg[$i]["codinsumo"]." | ".$reg[$i]["insumo"]." | ".$reg[$i]["nomcategoria"]; ?>','<?php echo $reg[$i]["precioentrada"]; ?>','<?php echo $reg[$i]["cantentrada"]; ?>','<?php echo $reg[$i]['fechaexpiracion'] == '0000-00-00' ? "0000-00-00" : date("d-m-Y",strtotime($reg[$i]['fechaexpiracion'])); ?>','<?php echo $reg[$i]['codproveedor'] == '0' ? "0" : $reg[$i]['codproveedor']; ?>','update')"><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarEntradaInsumo('<?php echo encrypt($reg[$i]["codentrada"]); ?>','<?php echo encrypt($reg[$i]["codinsumo"]); ?>','<?php echo encrypt("ENTRADAINSUMOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR ENTRADAS INSUMOS ############################
?>


<?php
############################# CARGAR SALIDAS INSUMOS ############################
if (isset($_GET['CargaSalidaInsumos'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Código de Insumo</th>
                                                    <th>Nombre de Insumo</th>
                                                    <th>Cantidad</th>
                                                    <th>Responsable</th>
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarSalidaInsumos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON SALIDAS DE INSUMOS DE LIMPIEZA ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                        <tr role="row" class="odd">
                        <td><?php echo $a++; ?></td>
                        <td><?php echo $reg[$i]['codinsumo']; ?></td>
                        <td><?php echo $reg[$i]['insumo']; ?></td>
                        <td><?php echo $reg[$i]['cantsalida']; ?></td>
                        <td><?php echo $reg[$i]['responsable']; ?></td>
                        <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechasalida'])); ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerSalidaInsumo('<?php echo encrypt($reg[$i]["codsalida"]); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalSalida" data-backdrop="static" data-keyboard="false" onClick="UpdateSalidaInsumo('<?php echo $reg[$i]["codsalida"]; ?>','<?php echo $reg[$i]["codinsumo"]; ?>','<?php echo $reg[$i]["codinsumo"]." | ".$reg[$i]["insumo"]." | ".$reg[$i]["nomcategoria"]; ?>','<?php echo $reg[$i]["responsable"]; ?>','<?php echo $reg[$i]["existencia"]; ?>','<?php echo $reg[$i]["cantsalida"]; ?>','<?php echo $reg[$i]["preciosalida"]; ?>','<?php echo $reg[$i]["descsalida"]; ?>','<?php echo $reg[$i]["ivasalida"]; ?>','update')"><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarSalidaInsumo('<?php echo encrypt($reg[$i]["codsalida"]); ?>','<?php echo encrypt($reg[$i]["codinsumo"]); ?>','<?php echo encrypt("SALIDAINSUMOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR SALIDAS INSUMOS ############################
?>


<?php
############################# CARGAR PRODUCTOS ############################
if (isset($_GET['CargaProductos'])) { 
$monedap = new Login();
$cambio = $monedap->MonedaProductoId();
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Img</th>
                                                    <th>Nombre de Producto</th>
                                                    <th>Categoria</th>
                                                    <th>P.V.P</th>
                                <th><?php echo $cambio == '' ? "*****" : "P.V. ".$cambio[0]['siglas']; ?></th>
                                                    <th>Stock</th>
                                                    <th><?php echo $impuesto; ?></th>
                                                    <th>Descto</th>
<?php if ($_SESSION['acceso'] == "cliente") { ?><th>Ver</th><?php } else { ?><th>Acciones</th><?php } ?>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarProductos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON PRODUCTOS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
<td><?php if (file_exists("fotos/productos/".$reg[$i]["codproducto"].".jpg")){
    echo "<img src='fotos/productos/".$reg[$i]["codproducto"].".jpg?' class='img-rounded' style='margin:0px;' width='50' height='40'>";
       }else{
    echo "<img src='fotos/producto.png' class='img-rounded' style='margin:0px;' width='50' height='40'>";  
    } ?></td>
  <td><abbr title="CÓDIGO: <?php echo $reg[$i]['codproducto']; ?>"><?php echo $reg[$i]['producto']; ?></abbr></td>
                                              <td><?php echo $reg[$i]['nomcategoria']; ?></td>
                                              <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
<td><?php echo $cambio == '' ? "*****" : "<strong>".$cambio[0]['simbolo']."</strong>".number_format($reg[$i]['precioventa']/$cambio[0]['montocambio'], 2, '.', ','); ?></td>
                                               <td><?php echo $reg[$i]['existencia']; ?></td>
                                               <td><?php echo $reg[$i]['ivaproducto'] == 'SI' ? $valor."%" : "(E)"; ?></td>
                                               <td><?php echo $reg[$i]['descproducto']; ?></td>
<td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerProducto('<?php echo encrypt($reg[$i]["codproducto"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria") { ?>
<button type="button" class="btn btn-info btn-rounded" onClick="UpdateProducto('<?php echo encrypt($reg[$i]["codproducto"]); ?>')" title="Editar" ><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarProducto('<?php echo encrypt($reg[$i]["codproducto"]); ?>','<?php echo encrypt("PRODUCTOS") ?>')" title="Eliminar"><i class="fa fa-trash-o"></i></button><?php } ?>

 </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR PRODUCTOS ############################
?>


<?php
############################# CARGAR COMPRAS ############################
if (isset($_GET['CargaCompras'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Compra</th>
                                                    <th>Descripción de Proveedor</th>
                                                    <th>Nº de Artic</th>
                                                    <th>Imp. Total</th>
                                                    <th>Fecha Emisión</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCompras();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON COMPRAS A PROVEEDORES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codcompra']; ?></td>
<td><abbr title="<?php echo "Nº ".$documento = ($reg[$i]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['cuitproveedor']; ?>"><?php echo $reg[$i]['nomproveedor']; ?></abbr></td>
      <td class="text-center"><?php echo $reg[$i]['articulos']; ?></td>
      <td class="text-center"><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechaemision'])); ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false" onClick="VerCompraPagada('<?php echo encrypt($reg[$i]["codcompra"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if($_SESSION['acceso']=="administrador" || $_SESSION["acceso"]=="secretaria"){ ?>

<button type="button" class="btn btn-info btn-rounded" onClick="UpdateCompra('<?php echo encrypt($reg[$i]["codcompra"]); ?>','<?php echo encrypt("U"); ?>','<?php echo encrypt("P"); ?>')" title="Editar" ><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarCompra('<?php echo encrypt($reg[$i]["codcompra"]); ?>','<?php echo encrypt($reg[$i]["codproveedor"]); ?>','<?php echo "P"; ?>','<?php echo encrypt("COMPRAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> 

<?php } ?>

<a href="reportepdf?codcompra=<?php echo encrypt($reg[$i]['codcompra']); ?>&tipo=<?php echo encrypt("FACTURACOMPRA") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>
                                              </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR COMPRAS ############################
?>


<?php
############################# CARGAR CUENTAS POR PAGAR ############################
if (isset($_GET['CargaCuentasxPagar'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Compra</th>
                                                    <th>Descripción de Proveedor</th>
                                                    <th>Nº de Artic</th>
                                                    <th>Imp. Total</th>
                                                    <th>Vencidos</th>
                                                    <th>Status</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCuentasxPagar();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CUENTAS POR PAGAR A PROVEEDORES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codcompra']; ?></td>
<td><abbr title="<?php echo "Nº ".$documento = ($reg[$i]['documproveedor'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['cuitproveedor']; ?>"><?php echo $reg[$i]['nomproveedor']; ?></abbr></td>
      <td class="text-center"><?php echo $reg[$i]['articulos']; ?></td>
      <td class="text-center"><?php echo $simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ','); ?></td>
<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "0"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); }
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']); } ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuscompra"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuscompra"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuscompra"]."</span>"; } ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false" onClick="VerCompraPendiente('<?php echo encrypt($reg[$i]["codcompra"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if ($_SESSION["acceso"]=="administrador" || $_SESSION["acceso"]=="secretaria") { ?>

<button type="button" class="btn btn-info btn-rounded" onClick="UpdateCompra('<?php echo encrypt($reg[$i]["codcompra"]); ?>','<?php echo encrypt("U"); ?>','<?php echo "D"; ?>')" title="Editar" ><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-danger btn-rounded" onClick="PagarCompra('<?php echo encrypt($reg[$i]["codcompra"]); ?>','<?php echo encrypt("PAGARFACTURA") ?>')" title="Pagar Factura" ><i class="fa fa-refresh"></i></button> 

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarCompra('<?php echo encrypt($reg[$i]["codcompra"]); ?>','<?php echo encrypt($reg[$i]["codproveedor"]); ?>','<?php echo encrypt("D") ?>','<?php echo encrypt("COMPRAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> 

<?php } ?>

<a href="reportepdf?codcompra=<?php echo encrypt($reg[$i]['codcompra']); ?>&tipo=<?php echo encrypt("FACTURACOMPRA") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>
                                              </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR CUENTAS POR PAGAR ############################
?>


<?php
############################# CARGAR CAJAS PARA VENTAS ############################
if (isset($_GET['CargaCajas'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>Nombre de Caja</th>
                                                    <th>Nº Documento</th>
                                                    <th>Responsable</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCajas();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CAJAS PARA VENTAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
                                               <td><?php echo $reg[$i]['dni']; ?></td>
                                               <td><?php echo $reg[$i]['nombres']; ?></td>
                                               <td>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalCaja" data-backdrop="static" data-keyboard="false" onClick="UpdateCaja('<?php echo $reg[$i]["codcaja"]; ?>','<?php echo $reg[$i]["nrocaja"]; ?>','<?php echo $reg[$i]["nomcaja"]; ?>','<?php echo $reg[$i]["codigo"]; ?>','update')"><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarCaja('<?php echo encrypt($reg[$i]["codcaja"]); ?>','<?php echo encrypt("CAJAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>

       
 <?php 
   } 
############################# CARGAR CAJAS PARA VENTAS ############################
?>


<?php
############################# CARGAR ARQUEOS DE CAJAS PARA VENTAS ############################
if (isset($_GET['CargaArqueos'])) { 

?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                <thead>
                                                <tr role="row">
                                                <th>N°</th>
                                                <th>Caja</th>
                                                <th>Responsable</th>
                                                <th>Hora de Apertura</th>
                                                <th>Hora de Cierre</th>
                                                <th>Monto Inicial</th>
                                                <th>Ventas</th>
                                                <th>Ingresos</th>
                                                <th>Efectivo</th>
                                                <th>Diferencia</th>
                                                <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarArqueoCaja();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON ARQUEOS DE CAJAS PARA VENTAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
            <td><?php echo $a++; ?></td>
            <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
            <td><?php echo $reg[$i]['dni'].": ".$reg[$i]['nombres']; ?></td>
            <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaapertura'])); ?></td>
            <td><?php echo $reg[$i]['statusarqueo'] == 1 ? "**********" : date("d-m-Y H:i:s",strtotime($reg[$i]['fechacierre'])); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['montoinicial'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['ingresos']+$reg[$i]['creditos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']+$reg[$i]['abonos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['dineroefectivo'], 2, '.', ','); ?></td>
            <td><?php echo $simbolo.number_format($reg[$i]['diferencia'], 2, '.', ','); ?></td>
                                               <td>

<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerArqueo('<?php echo encrypt($reg[$i]["codarqueo"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if($_SESSION["acceso"]=="administrador" && $reg[$i]["statusarqueo"]=='1' || $_SESSION["acceso"]=="recepcionista" && $reg[$i]["statusarqueo"]=='1'){ ?>

<button type="button" class="btn btn-dark btn-rounded" data-placement="left" title="Cerrar Arqueo" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalCerrarCaja" data-backdrop="static" data-keyboard="false" onClick="CerrarArqueo('<?php echo $reg[$i]["codarqueo"]; ?>','<?php echo $reg[$i]["nrocaja"].": ".$reg[$i]["nomcaja"]; ?>','<?php echo $reg[$i]["dni"].": ".$reg[$i]["nombres"]; ?>','<?php echo $reg[$i]["montoinicial"]; ?>','<?php echo $reg[$i]["ingresos"]; ?>','<?php echo $reg[$i]["egresos"]; ?>','<?php echo $reg[$i]["creditos"]; ?>','<?php echo $reg[$i]["abonos"]; ?>','<?php echo number_format($reg[$i]["montoinicial"]+$reg[$i]["ingresos"]+$reg[$i]["abonos"]-$reg[$i]["egresos"], 2, '.', ','); ?>','<?php echo $reg[$i]["fechaapertura"]; ?>')"><i class="fa fa-archive"></i></i></button>

<?php } else { ?>

<?php if ($_SESSION['acceso'] == "administrador") { ?>
<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Cerrar Arqueo" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalUpdateArqueo" data-backdrop="static" data-keyboard="false" onClick="UpdateArqueo('<?php echo $reg[$i]["codarqueo"]; ?>','<?php echo $reg[$i]["nrocaja"].": ".$reg[$i]["nomcaja"]; ?>','<?php echo $reg[$i]["dni"].": ".$reg[$i]["nombres"]; ?>','<?php echo number_format($reg[$i]["montoinicial"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["ingresos"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["egresos"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["creditos"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["abonos"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["montoinicial"]+$reg[$i]["ingresos"]+$reg[$i]["abonos"]-$reg[$i]["egresos"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["dineroefectivo"], 2, '.', ''); ?>','<?php echo number_format($reg[$i]["diferencia"], 2, '.', ''); ?>','<?php echo $reg[$i]["comentarios"]; ?>','<?php echo $reg[$i]["fechaapertura"]; ?>','<?php echo $reg[$i]["fechacierre"]; ?>')"><i class="fa fa-edit"></i></i></button>
<?php } ?>

<a href="reportepdf?codarqueo=<?php echo encrypt($reg[$i]['codarqueo']); ?>&tipo=<?php echo encrypt("TICKETCIERRE") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>  

<?php } ?></td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>

 <?php
   } 
############################# CARGAR ARQUEOS DE CAJAS PARA VENTAS ############################
?>


<?php
############################# CARGAR MOVIMIENTOS EN CAJAS PARA VENTAS ############################
if (isset($_GET['CargaMovimientos'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">

                                                 <thead>
                                                 <tr role="row">
                                                  <th>N°</th>
                                                  <th>Caja</th>
                                                  <th>Responsable</th>
                                                  <th>Tipo</th>
                                                  <th>Descripción</th>
                                                  <th>Monto</th>
                                                  <th>Fecha</th>
                                                  <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarMovimientos();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON MOVIMIENTOS EN CAJAS PARA VENTAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?></td>
                                  <td><?php echo $reg[$i]['nombres']; ?></td>
                                  <td><?php echo $reg[$i]['tipomovimiento']; ?></td>
                                  <td><?php echo $reg[$i]['descripcionmovimiento']; ?></td>
                                  <td><?php echo $simbolo.number_format($reg[$i]['montomovimiento'], 2, '.', ','); ?></td>
                                  <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechamovimiento'])); ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerMovimiento('<?php echo encrypt($reg[$i]["codmovimiento"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if ($reg[$i]['statusarqueo']=="1") { ?>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Editar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalMovimiento" data-backdrop="static" data-keyboard="false" onClick="UpdateMovimiento('<?php echo $reg[$i]["codmovimiento"]; ?>','<?php echo $reg[$i]["codcaja"]; ?>','<?php echo $reg[$i]["tipomovimiento"]; ?>','<?php echo $reg[$i]["descripcionmovimiento"]; ?>','<?php echo $reg[$i]["montomovimiento"]; ?>','<?php echo $reg[$i]["codmediopago"]; ?>','<?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechamovimiento'])); ?>','<?php echo $reg[$i]["codarqueo"]; ?>','update')"><i class="fa fa-edit"></i></button>
                                 
<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarMovimiento('<?php echo encrypt($reg[$i]["codmovimiento"]); ?>','<?php echo encrypt("MOVIMIENTOS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> </td>

<?php } ?>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR MOVIMIENTOS EN CAJAS PARA VENTAS ############################
?>


<?php
############################# CARGAR RESERVACIONES ############################
if (isset($_GET['CargaReservaciones'])) { 

   if ($_SESSION["acceso"]=="cliente") { ?>
  
<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Reservación</th>
                                                    <th>Descripción de Cliente</th>
                                                    <th>Habitaciones</th>
                                                    <th>Fecha de Entrada</th>
                                                    <th>Fecha de Salida</th>
                                                    <th>Imp. Total</th>
                                                    <th>Status</th>
                                                    <th>Reservación</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarReservaciones();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESERVACIONES DE HABITACIONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['codreservacion']; ?></td>
<td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
                                               <td><?php echo $reg[$i]['habitaciones']; ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
                                               <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>

      <td><?php if($reg[$i]['reservacion']=="PENDIENTE") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="ACTIVA") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="CANCELADA") { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } else { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; } ?></td>


                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false" onClick="VerReservacion('<?php echo encrypt($reg[$i]["codreservacion"]); ?>')"><i class="fa fa-eye"></i></button>

<a href="reportepdf?codreservacion=<?php echo encrypt($reg[$i]['codreservacion']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>

 </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>

<?php } else { ?> 

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Reservación</th>
                                                    <th>Descripción de Cliente</th>
                                                    <th>Habitaciones</th>
                                                    <th>Fecha de Entrada</th>
                                                    <th>Fecha de Salida</th>
                                                    <th>Imp. Total</th>
                                                    <th>Status</th>
                                                    <th>Reservación</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarReservaciones();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESERVACIONES DE HABITACIONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                                               <td><?php echo $reg[$i]['codreservacion']; ?></td>
<td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td>
                                               <td><?php echo $reg[$i]['habitaciones']; ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['desde'])); ?></td>
                                               <td><?php echo date("d-m-Y",strtotime($reg[$i]['hasta'])); ?></td>
                                               <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>

<td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statuspago"]."</span>"; } 
        elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
        elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statuspago"]."</span>"; } ?></td>

      <td><?php if($reg[$i]['reservacion']=="PENDIENTE") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="ACTIVA") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } elseif($reg[$i]['reservacion']=="CANCELADA") { echo "<span class='badge badge-pill badge-dark'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; 
  } else { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["reservacion"]."</span>"; } ?></td>


                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false" onClick="VerReservacion('<?php echo encrypt($reg[$i]["codreservacion"]); ?>')"><i class="fa fa-eye"></i></button>

<?php if ($reg[$i]["reservacion"]=="PENDIENTE") { ?>

<button type="button" class="btn btn-danger btn-rounded" onClick="ActivarReservacion('<?php echo encrypt($reg[$i]["codreservacion"]); ?>','<?php echo encrypt("ACTIVAR") ?>')" title="Activar Reservación" ><i class="fa fa-refresh"></i></button> 

<?php } elseif ($reg[$i]["reservacion"]=="ACTIVA") { ?>

<button type="button" class="btn btn-warning btn-rounded" onClick="CulminarReservacion('<?php echo encrypt($reg[$i]["codreservacion"]); ?>','<?php echo encrypt("CULMINAR") ?>')" title="Culminar Reservación" ><i class="fa fa-refresh"></i></button> 

<?php } ?>


<?php if($_SESSION['acceso']=="administrador" || $_SESSION["acceso"]=="secretaria"){ ?>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarReservacion('<?php echo encrypt($reg[$i]["codreservacion"]); ?>','<?php echo encrypt("RESERVACIONES") ?>')" title="Eliminar"><i class="fa fa-trash-o"></i></button>

<?php } ?>

<a href="reportepdf?codreservacion=<?php echo encrypt($reg[$i]['codreservacion']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-rounded btn-secondary" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>

 </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
      }
   } 
############################# CARGAR RESERVACIONES ############################
?>


<?php
############################# CARGAR VENTAS ############################
if (isset($_GET['CargaVentas'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Venta</th>
                                                    <th>Descripción de Cliente</th>
                                                    <th>Grab</th>
                                                    <th>Exen</th>
                                                    <th>Iva</th>
                                                    <th>Imp. Total</th>
                                                    <th>Status</th>
                                                    <th>Fecha Emisión</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarVentas();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON VENTAS A CLIENTES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
<td><abbr title="CAJA: <?php echo $reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']; ?>"><?php echo $reg[$i]['codventa']; ?></abbr></td>
<td><abbr title="<?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : "Nº ".$documento = ($reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento']).": ".$reg[$i]['dnicliente']; ?>"><?php echo $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']; ?></abbr></td> 
      <td class="text-center"><?php echo $simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ','); ?></td>
      <td class="text-center"><?php echo $simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ','); ?></td>
      <td class="text-center"><?php echo $simbolo.number_format($reg[$i]['totaliva'], 2, '.', ','); ?><sup><?php echo $reg[$i]['iva']; ?>%</sup></td>
      <td class="text-center"><abbr title="Nº DE ARTICULOS: <?php echo $reg[$i]['articulos']; ?>"><?php echo $simbolo." ".number_format($reg[$i]['totalpago'], 2, '.', ','); ?></abbr></td>
      <td><?php if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-success'><i class='fa fa-exclamation-circle'></i> ".$reg[$i]["statusventa"]."</span>"; } 
      elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00") { echo "<span class='badge badge-pill badge-danger'><i class='fa fa-times'></i> VENCIDA</span>"; }
      elseif($reg[$i]['fechavencecredito'] <= date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00") { echo "<span class='badge badge-pill badge-info'><i class='fa fa-check'></i> ".$reg[$i]["statusventa"]."</span>"; } ?></td>
                    <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
                                               <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false" onClick="VerVenta('<?php echo encrypt($reg[$i]["codventa"]); ?>')"><i class="fa fa-eye"></i></button>


<button type="button" class="btn btn-warning btn-rounded" onClick="AgregaDetalleVenta('<?php echo encrypt($reg[$i]["codventa"]); ?>','<?php echo encrypt("A"); ?>')" title="Agregar Detalle" ><i class="fa fa-tasks"></i></button>

<?php if($_SESSION['acceso']=="administrador" || $_SESSION["acceso"]=="secretaria"){ ?>

<button type="button" class="btn btn-info btn-rounded" onClick="UpdateVenta('<?php echo encrypt($reg[$i]["codventa"]); ?>','<?php echo encrypt("U"); ?>')" title="Editar" ><i class="fa fa-edit"></i></button>

<button type="button" class="btn btn-dark btn-rounded" onClick="EliminarVenta('<?php echo encrypt($reg[$i]["codventa"]); ?>','<?php echo encrypt($reg[$i]["codcliente"]); ?>','<?php echo encrypt("VENTAS") ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></button> 

<?php } ?>

<a href="reportepdf?codventa=<?php echo encrypt($reg[$i]['codventa']); ?>&tipo=<?php echo encrypt($reg[$i]['tipodocumento']) ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>
                                              </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR VENTAS ############################
?>


<?php
############################# CARGAR CREDITOS EN RESERVACIONES ############################
if (isset($_GET['CargaCreditosReservaciones'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Reservación</th>
                                                    <th>Nº de Documento</th>
                                                    <th>Nombre de Cliente</th>
                                                    <th>Imp. Total</th>
                                                    <th>Abono</th>
                                                    <th>Debe</th>
                                                    <th>Fecha Emisión</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCreditosReservaciones();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS DE RESERVACIONES ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codreservacion']; ?></td>
                    <td><?php echo $reg[$i]['dnicliente']; ?></td> 
                    <td><?php echo $reg[$i]['nomcliente']; ?></td> 
  <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['creditopagado'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['creditopagado'], 2, '.', ','); ?></td>
  <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fecharegistro'])); ?></td>
                         <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerCredito('<?php echo encrypt($reg[$i]["codreservacion"]); ?>','<?php echo encrypt("1"); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Abonar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalPago" data-backdrop="static" data-keyboard="false" 
onClick="AbonoCreditoReservacion('<?php echo $reg[$i]["codcliente"]; ?>',
'<?php echo $reg[$i]["codreservacion"]; ?>',
'<?php echo $reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento'].": ".$reg[$i]["dnicliente"]; ?>',
'<?php echo $reg[$i]["nomcliente"]; ?>',
'<?php echo $reg[$i]["codreservacion"]; ?>',
'<?php echo number_format($reg[$i]["totalpago"], 2, '.', ''); ?>',
'<?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])); ?>',
'<?php echo number_format($reg[$i]['totalpago']-$reg[$i]['creditopagado'], 2, '.', ''); ?>',
'<?php echo number_format($reg[$i]['creditopagado'], 2, '.', ''); ?>')"><i class="fa fa-credit-card"></i></button>

<a href="reportepdf?codproceso=<?php echo encrypt($reg[$i]['codreservacion']); ?>&url=<?php echo encrypt("1") ?>&tipo=<?php echo encrypt("TICKETCREDITORESERVACIONES") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>
                                              </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR CREDITOS EN RESERVACIONES ############################
?>


<?php
############################# CARGAR CREDITOS EN VENTAS ############################
if (isset($_GET['CargaCreditosVentas'])) { 
?>

<div class="table-responsive"><table id="default_order" class="table table-striped table-bordered border display">
                                                 <thead>
                                                 <tr role="row">
                                                    <th>N°</th>
                                                    <th>N° de Venta</th>
                                                    <th>Nº de Documento</th>
                                                    <th>Nombre de Cliente</th>
                                                    <th>Imp. Total</th>
                                                    <th>Abono</th>
                                                    <th>Debe</th>
                                                    <th>Fecha Emisión</th>
                                                    <th>Acciones</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody class="BusquedaRapida">

<?php 
$reg = $tra->ListarCreditosVentas();

if($reg==""){
    
    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS DE VENTAS ACTUALMENTE </center>";
    echo "</div>";    

} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                               <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codventa']; ?></td>
                    <td><?php echo $reg[$i]['dnicliente']; ?></td> 
                    <td><?php echo $reg[$i]['nomcliente']; ?></td> 
  <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['creditopagado'], 2, '.', ','); ?></td>
  <td><?php echo $simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['creditopagado'], 2, '.', ','); ?></td>
  <td><?php echo date("d-m-Y H:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
                         <td>
<button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerCredito('<?php echo encrypt($reg[$i]["codventa"]); ?>','<?php echo encrypt("2"); ?>')"><i class="fa fa-eye"></i></button>

<button type="button" class="btn btn-info btn-rounded" data-placement="left" title="Abonar" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModalPago" data-backdrop="static" data-keyboard="false" 
onClick="AbonoCreditoVenta('<?php echo $reg[$i]["codcliente"]; ?>',
'<?php echo $reg[$i]["codventa"]; ?>',
'<?php echo $reg[$i]['documcliente'] == '0' ? "DOCUMENTO" : $reg[$i]['documento'].": ".$reg[$i]["dnicliente"]; ?>',
'<?php echo $reg[$i]["nomcliente"]; ?>',
'<?php echo $reg[$i]["codventa"]; ?>',
'<?php echo number_format($reg[$i]["totalpago"], 2, '.', ''); ?>',
'<?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?>',
'<?php echo number_format($reg[$i]['totalpago']-$reg[$i]['creditopagado'], 2, '.', ''); ?>',
'<?php echo number_format($reg[$i]['creditopagado'], 2, '.', ''); ?>')"><i class="fa fa-credit-card"></i></button>

<a href="reportepdf?codproceso=<?php echo encrypt($reg[$i]['codventa']); ?>&url=<?php echo encrypt("2") ?>&tipo=<?php echo encrypt("TICKETCREDITOVENTA") ?>" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-secondary btn-rounded" title="Imprimir Pdf"><i class="fa fa-print"></i></button></a>
                                              </td>
                                               </tr>
                                                <?php } } ?>
                                            </tbody>
                                     </table></div>
 <?php
   } 
############################# CARGAR CREDITOS EN VENTAS ############################
?>


  <!-- Datatables-->
  <script src="assets/plugins/datatables/dataTables.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
  <script src="assets/plugins/datatables/datatable-basic.init.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').dataTable();
      $('#datatable-responsive').DataTable();
      $('#default_order').dataTable();
    } );
  </script>
        
  <!--Gallery-->
  <script type="text/javascript" src="assets/plugins/gallery/sagallery.js"></script>
  <script src="assets/plugins/gallery/jquery-photo-gallery/jquery-photo-gallery/js/jquery.quicksand.js" type="text/javascript"></script>
  <script src="assets/plugins/gallery/jquery-photo-gallery/jquery-photo-gallery/js/jquery.easing.js" type="text/javascript"></script>
  <script src="assets/plugins/gallery/jquery-photo-gallery/jquery-photo-gallery/js/script.js" type="text/javascript"></script>
  <script src="assets/plugins/gallery/jquery-photo-gallery/jquery-photo-gallery/js/jquery.prettyPhoto.js" type="text/javascript"></script>
  <link href="assets/plugins/gallery/jquery-photo-gallery/jquery-photo-gallery/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
  <!--Gallery-->
        

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