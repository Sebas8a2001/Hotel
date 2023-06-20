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
$desc_reservas = ($con == "" ? "0.00" : number_format($con[0]['dsctor'], 2, '.', ','));
$simbolo = ($con == "" ? "" : "<strong>".$con[0]['simbolo']."</strong>");

$new = new Login();
?>



<?php
####################### BUSQUEDA HABITACIONES PARA RESERVACIONES ########################
if (isset($_GET['BuscarHabitaciones']) && isset($_GET['desde_r']) && isset($_GET['hasta_r']) && isset($_GET['adultos']) && isset($_GET['children']) && isset($_GET['tipo'])) {

$desde = limpiar($_GET['desde_r']);
$hasta = limpiar($_GET['hasta_r']);
$adultos = limpiar($_GET['adultos']);
$children = limpiar($_GET['children']);
$tipo = limpiar($_GET['tipo']);

  if($desde=="") {

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE ENTRADA PARA TU BÚSQUEDA</center>";
    echo "</div>"; 
    exit;

  } else if($hasta=="") {

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE SALIDA PARA TU BÚSQUEDA</center>";
    echo "</div>"; 
    exit;

  } elseif (strtotime($desde) > strtotime($hasta)) {

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> LA FECHA DE ENTRADA NO PUEDE SER MAYOR QUE LA FECHA DE SALIDA</center>";
    echo "</div>"; 
    exit;
      
  } elseif($adultos==""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CANTIDAD DE ADULTOS </center>";
    echo "</div>";    
    exit;
  
  } elseif(decrypt($tipo)!= 1 && decrypt($tipo)!= 2 && decrypt($tipo)== ""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> HA OCURRIDO UN ERROR EN EL PROCESAMIENTO DE LA INFORMACIÓN, VERIFIQUE NUEVAMENTE </center>";
    echo "</div>";    
    exit;

  } elseif(decrypt($tipo)==1){

  $bus = new Login();
  $reg = $bus->BuscarHabitaciones(); 
  ?>

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Habitaciones Disponibles Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></h4>
      </div>

      <div class="form-body">
        <div class="card-body">

          <div id="div3"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr class="text-center">
                                  <th><i class="fa fa-tasks"></i></th>
                                  <th>Nº</th> 
                                  <th>N° de Habitación</th>
                                  <th>Tipo de Habitación</th>
                                  <th>Descripción de Habitación</th>
                                  <th>Máximo Adultos</th>
                                  <th>Máximo Niños</th>
                                  <th>N° de Adultos</th>
                                  <th>N° de Niños</th> 
                                  <th><i class="fa fa-check"></i></th> 
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
  <td> <button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerHabitacion('<?php echo encrypt($reg[$i]["codhabitacion"]); ?>')"><i class="fa fa-eye"></i></button>
                                    <td><?php echo $a++; ?></td>
                <td><?php echo $reg[$i]['numhabitacion']; ?></td>
          <td><?php echo $reg[$i]['nomtipo']; ?></div></td>
          <td><?php echo $reg[$i]['descriphabitacion']; ?></td>
          <td><i class="fa fa-male"></i> x<?php echo $reg[$i]['maxadultos']; ?></td>
          <td><i class="fa fa-child"></i> x<?php echo $reg[$i]['maxninos']; ?></td>
      <td><select style="color:#000;font-weight:bold;" name="cantadultos[]" id="cantadultos_<?php echo $a; ?>" class='form-control combo' disabled="disabled" required="required"><?php $b = $reg[$i]['maxadultos']; 
                                           for($e=1;$e<=$b;$e++){  ?>
            <option value="<?php echo $e; ?>"><?php echo $e; ?></option>
                                     <?php } ?></select></td>
      <td><input type="hidden" name="url" id="url" value="<?php echo decrypt($tipo); ?>"><select style="color:#000;font-weight:bold;" name="cantchildren[]" id="cantchildren_<?php echo $a; ?>" class='form-control combo' disabled="disabled" required="required"><option value=""></option> 
                     <option value="0" selected="selected">0</option>               
                     <?php $n = $reg[$i]['maxninos']; 
                                           for($f=1;$f<=$n;$f++){  ?>
            <option value="<?php echo $f; ?>"><?php echo $f; ?></option>
                                     <?php } ?></select></td>
<td>

<div class="form-check"><div class="custom-control custom-radio"><input type="checkbox" class="custom-control-input" name="check[]" id="check_<?php echo $a; ?>" value="<?php echo $reg[$i]['codhabitacion']; ?>" onClick="ActivarCombo(<?php echo $a; ?>);"><label class="custom-control-label" for="check_<?php echo $a; ?>"></label></div></div></td>
</td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div><br>

              <div class="text-right">
<button type="button" onClick="RevisaReserva(document.getElementById('check_<?php echo $a; ?>').value,<?php echo "'".$desde."','".$hasta."','".$tipo."'"; ?>)" name="reservacion_1" id="reservacion_1" class="btn btn-info"><span class="fa fa-save"></span> Continuar</button>
<button type="button" onClick="LimpiarCheckbox()" class="btn btn-dark"><span class="fa fa-trash-o"></span> Cancelar</button>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

 <?php } elseif(decrypt($tipo)==2){

  $bus = new Login();
  $reg = $bus->BuscarHabitaciones(); 
 ?>

<hr>
<div class="container boxed">
    <div class="mb20">
<!-- Row -->
 <div class="row">
  <div class="col-lg-12">
    <div class="card">

   <legend>Habitaciones Disponibles Desde <?php echo date("d-m-Y", strtotime($desde)); ?> Hasta <?php echo date("d-m-Y", strtotime($hasta)); ?></legend>
    
      <div class="form-body">
        <div class="card-body">

          <center><div class='alert alert-success'>
  <span class='fa fa-info-circle'></span>POR FAVOR SE AGRADECE SELECCIONAR LA CANTIDAD DE PERSONAS ADULTAS Y NIÑOS(AS) ASIGNADAS PARA CADA HABITACIÓN CORRESPONDIENTE </div></center>

          <div id="div3"><table id="datatable-scroller" class="table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                              <thead>
                        <tr class="text-center" bgcolor="#2cabe3" style="color: #FFFFFF">
                                  <th><i class="fa fa-tasks"></i></th>
                                  <th>Nº</th> 
                                  <th>N° de Habitación</th>
                                  <th>Tipo de Habitación</th>
                                  <th>Descripción de Habitación</th>
                                  <th>Máximo Adultos</th>
                                  <th>Máximo Niños</th>
                                  <th>N° de Adultos</th>
                                  <th>N° de Niños</th> 
                                  <th><i class="fa fa-check"></i></th> 
                                </tr>
                              </thead>
                              <tbody>
<?php
$a=1;
for($i=0;$i<sizeof($reg);$i++){
?>
                                <tr class="text-center">
  <td> <button type="button" class="btn btn-success btn-rounded" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="VerHabitacion('<?php echo encrypt($reg[$i]["codhabitacion"]); ?>')"><i class="fa fa-eye"></i></button>
                                    <td><?php echo $a++; ?></td>
                <td><?php echo $reg[$i]['numhabitacion']; ?></td>
          <td><?php echo $reg[$i]['nomtipo']; ?></div></td>
          <td><?php echo $reg[$i]['descriphabitacion']; ?></td>
          <td><i class="fa fa-male"></i> x<?php echo $reg[$i]['maxadultos']; ?></td>
          <td><i class="fa fa-child"></i> x<?php echo $reg[$i]['maxninos']; ?></td>
      <td><select style="color:#000;font-weight:bold;" name="cantadultos[]" id="cantadultos_<?php echo $a; ?>" class='form-control combo' disabled="disabled" required="required"><?php $b = $reg[$i]['maxadultos']; 
                                           for($e=1;$e<=$b;$e++){  ?>
            <option value="<?php echo $e; ?>"><?php echo $e; ?></option>
                                     <?php } ?></select></td>
      <td><input type="hidden" name="url" id="url" value="<?php echo decrypt($tipo); ?>"><select style="color:#000;font-weight:bold;" name="cantchildren[]" id="cantchildren_<?php echo $a; ?>" class='form-control combo' disabled="disabled" required="required"><option value=""></option> 
                     <option value="0" selected="selected">0</option>               
                     <?php $n = $reg[$i]['maxninos']; 
                                           for($f=1;$f<=$n;$f++){  ?>
            <option value="<?php echo $f; ?>"><?php echo $f; ?></option>
                                     <?php } ?></select></td>
<td>

<div class="form-check"><div class="custom-control custom-radio"><input type="checkbox" class="custom-control-input" name="check[]" id="check_<?php echo $a; ?>" value="<?php echo $reg[$i]['codhabitacion']; ?>" onClick="ActivarCombo(<?php echo $a; ?>);"><label class="custom-control-label" for="check_<?php echo $a; ?>"></label></div></div></td>
</td>
                                  </tr>
                        <?php  }  ?>
                              </tbody>
                          </table>
                      </div><br>

              <div class="text-right">
<button type="button" onClick="RevisaReserva(document.getElementById('check_<?php echo $a; ?>').value,<?php echo "'".$desde."','".$hasta."','".$tipo."'"; ?>)" name="reservacion_1" id="reservacion_1" class="btn btn-info"><span class="fa fa-save"></span> Continuar</button>
<button type="button" onClick="LimpiarCheckbox()" class="btn btn-danger"><span class="fa fa-trash-o"></span> Cancelar</button>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->

   </div>
</div>
<?php
         }
   } 
######################## BUSQUEDA HABITACIONES PARA RESERVACIONES #######################
?>

<?php
######################## MUESTRA HABITACIONES RESERVADAS ###########################
if (isset($_GET['BuscaHabitacionesReservadas']) && isset($_GET['desde']) && isset($_GET['hasta']) && isset($_GET['check'])) {

include_once('class/conexion.php');
$link = db_connect();

$check = limpiar($_GET['check']);
$desde = limpiar(date("Y-m-d",strtotime($_GET['desde'])));
$hasta = limpiar(date("Y-m-d",strtotime($_GET['hasta'])));
$tipo = limpiar($_GET['tipo']);

$check1 = explode(",",$check);
$num = count($check1);

if(decrypt($tipo)!= 1 && decrypt($tipo)!= 2 && decrypt($tipo)== ""){

    echo "<div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<center><span class='fa fa-info-circle'></span> HA OCURRIDO UN ERROR EN EL PROCESAMIENTO DE LA INFORMACIÓN, VERIFIQUE NUEVAMENTE </center>";
    echo "</div>";    
    exit;

  } elseif(decrypt($tipo)==1){
            
  if($num > 1) {     
?>

<!-- Row -->
<div class="row">
  <div class="col-md-12">
    <div class="card card-body printableArea">
      <!--<h3><b>DETALLES DE RESERVACIÓN</b></h3> -->
      <h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-file-send"></i> DETALLES DE RESERVACIÓN</h2>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="pull-left">
            <address>
              <h3> &nbsp;<b class="text-dark"><?php echo $con[0]['nomhotel'] ?></b></h3>
              <p class="text-muted ml-1"><i class="fa fa-flash"></i> Nº <?php echo ($con[0]['documenhotel'] == '0' ? "DOC:" : $con[0]['documento'].": ")." ".$con[0]['nrohotel'] ?>,
                <br/> <i class="fa fa-map-marker"></i> <?php echo $con[0]['direchotel'] ?>,
                <br/> <i class="fa fa-envelope"></i> <?php echo $con[0]['emailhotel'] ?>,
                <br/> <i class="fa fa-phone"></i> <?php echo $con[0]['tlfhotel'] ?></p>
              </address>
            </div>
            <div class="pull-right text-right">
              <address>
                <h3><?php switch($con[0]['categoriahotel']){ case 1: ?>
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
                 } ?>  </h3>
                <h4 class="font-bold">ESTRELLAS</h4>
                  <p class="mt-2"><b>Fecha de Entrada :</b> <i class="fa fa-calendar"></i> <?php echo date("d-m-Y", strtotime($desde)); ?></p>
                  <p><b>Fecha de Salida :</b> <i class="fa fa-calendar"></i> <?php echo date("d-m-Y", strtotime($hasta)); ?></p>
                </address>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive mt-2" style="clear: both;">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nº</th> 
                      <th>N° de Habitación</th>
                      <th>Tipo de Habitación</th>
                      <th>Descripción de Habitación</th>
                      <th>Noches</th>
                      <th>Valor Total</th>
                      <th>Descuento</th>
                      <th>Valor Neto</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$total = 0;
$i=0;
while($i < $num) {
$check2 = $check1[$i];

  $sql = mysqli_query($link,"SELECT 
  habitaciones.codhabitacion,
  habitaciones.numhabitacion,
  habitaciones.descriphabitacion,
  habitaciones.codtarifa,
  habitaciones.deschabitacion,
  tiposhabitaciones.nomtipo,
  tarifas.baja,
  tarifas.media,
  tarifas.alta FROM habitaciones 
  INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
  INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo
  WHERE habitaciones.codhabitacion = '".$check2."' AND habitaciones.statushab = '0'") or die(mysqli_error($link));
  $array = mysqli_fetch_array($sql);

  $inicio = $desde;
  $fin = $hasta;
  $pago = 0;
  $totalpago = 0;

  if($array=="") {

  echo "<div class='col-md-12'><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TARIFAS REGISTRADAS ACTUALMENTE</center>";
  echo "</div></div>";
  exit;

  } 
  
$sql2 = mysqli_query($link,"SELECT * FROM tarifas 
    WHERE codtarifa = '".$array['codtarifa']."'") or die (mysqli_error($link));
  $array2 = mysqli_fetch_array($sql2); 

while($inicio <= $fin) {
  $sql1 = mysqli_query($link,"SELECT temporada FROM temporadas 
    WHERE desde <= '".$inicio."' and hasta >= '".$inicio."'") or die (mysqli_error($link));
  $array1 = mysqli_fetch_array($sql1);

  if($array1=="") {

  echo "<div class='col-md-12'><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TEMPORADAS PARA TARIFAS REGISTRADAS ACTUALMENTE</center>";
  echo "</div></div>";
  exit;

  } else { 

  if($array1['temporada']=='BAJA') {
        $costo = $array2['baja']; 
  } elseif($array1['temporada']=='MEDIA') {
        $costo = $array2['media'];
  } elseif($array1['temporada']=='ALTA') {
        $costo = $array2['alta'];
  }

  $pago = $pago + $costo;
  $subtotaldescuento = $pago*$array['deschabitacion']/100;
  $subtotalneto = $pago-$subtotaldescuento;

   mysqli_free_result($sql1);

   $inicio = date("Y-m-d", strtotime("$inicio +1 day"));
  }
}
$i++;
?>
                    <tr>
                    <td><?php echo $i; ?></td>
        <td><input name="codhabitacion[]" type="hidden" id="codhabitacion" value="<?php echo $array['codhabitacion']; ?>" />#<?php echo $array['numhabitacion']; ?></td>
        <td><?php echo $array['nomtipo']; ?></td>
        <td><?php echo $array['descriphabitacion']; ?></td>
        <td><?php echo Dias_Transcurridos($desde,$hasta); ?></td>
        
        <td><input name="valortotal[]" type="hidden" id="valortotal" value="<?php echo number_format($pago, 2, '.', ''); ?>" />
          <?php echo $simbolo.number_format($pago, 2, '.', ''); ?></td>
        
        <td><input name="subtotaldescuento[]" type="hidden" id="subtotaldescuento" value="<?php echo number_format($subtotaldescuento, 2, '.', ''); ?>" /><input name="deschabitacion[]" type="hidden" id="deschabitacion" value="<?php echo $array['deschabitacion']; ?>" /><?php echo $simbolo.number_format($subtotaldescuento, 2, '.', ''); ?><sup><?php echo $array['deschabitacion']; ?>%</sup></td>
        
        <td><input name="valorneto[]" type="hidden" id="valorneto" value="<?php echo number_format($subtotalneto, 2, '.', ''); ?>" /><?php echo $simbolo.number_format($subtotalneto, 2, '.', ''); ?></td>
                    </tr>
<?php 
$iva=$valor/100;
$descuento=$desc_reservas/100;
$total = $total + $subtotalneto;

$totaliva=$total*$iva;
$subtotal = $total + $totaliva;
$totaldescuento=$subtotal*$descuento;
$totalpago = $subtotal - $totaldescuento;  
   
}
?>
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="pull-right mt-2 text-right">
                <p>
                <label>Subtotal:</label> <?php echo $simbolo; ?><label id="lblsubtotal" name="lblsubtotal"><?php echo number_format($total, 2, '.', ''); ?></label><br>
              <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="<?php echo number_format($total, 2, '.', ''); ?>"/>

                <label><?php echo $impuesto; ?> <?php echo $valor; ?>%:</label> <?php echo $simbolo; ?><label id="lbliva" name="lbliva"><?php echo number_format($totaliva, 2, '.', ''); ?></label><br>
                <input type="hidden" name="iva" id="iva" value="<?php echo $valor; ?>">
                <input type="hidden" name="txtIva" id="txtIva" value="<?php echo number_format($totaliva, 2, '.', ''); ?>"/>

                <label>Descuento <?php echo $desc_reservas; ?>%:</label> <?php echo $simbolo; ?><label id="lbldescuento" name="lbldescuento"><?php echo number_format($totaldescuento, 2, '.', ''); ?></label> 
                <input type="hidden" name="descuento" id="descuento" value="<?php echo $desc_reservas; ?>"/>
                <input type="hidden" name="txtDescuento" id="txtDescuento" value="<?php echo number_format($totaldescuento, 2, '.', ''); ?>"/></p>
                <hr>
                <h3><b>Importe Total :</b> <?php echo $simbolo; ?><label id="lbltotal" name="lbltotal"><?php echo number_format($totalpago, 2, '.', ''); ?></label>
                <input type="hidden" name="txtTotal" id="txtTotal" value="<?php echo number_format($totalpago, 2, '.', ''); ?>"/>
              </h3>
              </div>
              <div class="clearfix"></div>               

              <hr>
              <h5 class="card-title">Metodo de Pago</h5>
              <ul class="nav nav-tabs" role="tablist">
            
                <li role="presentation" class="nav-item">
                  <a href="#iefecty" class="nav-link active" onClick="CargaTab('<?php echo encrypt("1"); ?>');" aria-controls="efecty" role="tab" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-money"></i></span> 
                    <span class="hidden-xs">Efectivo</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#itarjeta" class="nav-link" onClick="CargaTab('<?php echo encrypt("2"); ?>');" aria-controls="credito" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-credit-card"></i></span>
                    <span class="hidden-xs"> Tarjeta de Crédito</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#itransf" class="nav-link" onClick="CargaTab('<?php echo encrypt("3"); ?>');" aria-controls="transf" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-folder-open"></i></span>
                    <span class="hidden-xs">Transferencia</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#icheque" class="nav-link" onClick="CargaTab('<?php echo encrypt("4"); ?>');" aria-controls="cheque" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-file-archive-o"></i></span>
                    <span class="hidden-xs">Cheque</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#icredito" class="nav-link" onClick="CargaTab('<?php echo encrypt("5"); ?>');" aria-controls="credito" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-bank"></i></span>
                    <span class="hidden-xs">Crédito</span>
                  </a>
                </li>
              </ul>

              <div class="tab-content">

                <div id="muestratabs">

                  <!-- PAGO EN EFECTIVO -->
                  <div role="tabpanel" class="tab-pane active" id="iefecty">
                    <div class="row">
                      <div class="col-md-4 mt-3">
                        <div class="form-group">
                          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
                          <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
                              <label class="custom-control-label" for="ticket">TICKET</label>
                            </div>
                          </div>

                          <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
                              <label class="custom-control-label" for="factura">FACTURA</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 mt-3"> 
                        <div class="form-group has-feedback"> 
                          <label class="control-label">Monto Pagado: <span class="symbol required"></span></label> 
                          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
                          <input type="hidden" name="formapago" id="formapago" value="EFECTIVO">
                          <input type="text" class="form-control" name="montopagado" id="montopagado" onKeyUp="this.value=this.value.toUpperCase(); EfectivoReserva();" placeholder="Ingrese Monto Recibido" autocomplete="off" required="" aria-required="true">
                          <i class="fa fa-tint form-control-feedback"></i>
                        </div> 
                      </div>

                      <div class="col-md-4 mt-3"> 
                        <div class="form-group has-feedback"> 
                          <label class="control-label">Monto Devuelto: <span class="symbol required"></span></label> 
                          <input type="hidden" name="montodevuelto" id="montodevuelto">
                          <input type="text" class="form-control" name="devolucion" id="devolucion" value="0.00" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Monto Devuelto" autocomplete="off" disabled="" required="" aria-required="true">
                          <i class="fa fa-tint form-control-feedback"></i>
                        </div> 
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group has-feedback2"> 
                          <label class="control-label">Observaciones: </label> 
                          <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="2" required="required"></textarea>
                          <i class="fa fa-comment-o form-control-feedback2"></i>
                        </div> 
                      </div>
                    </div>
                  </div>

                </div>
              
              <div class="clearfix"></div>
              <hr>
              <div class="text-right">
  <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-print"></span> Registrar</button>
  <button type="button" onClick="LimpiarTabs();" class="btn btn-dark"><span class="fa fa-trash-o"></span> Limpiar</button>
              </div>
            </div>

      </div>
    </div>
  </div>
</div>
<!-- End Row -->

<?php } else { ?>

<!-- Row -->
<div class="row">
  <div class="col-md-12">
    <div class="card card-body printableArea">
      <h2 class="card-subtitle m-0 text-dark"><i class="font-22 mdi mdi-file-send"></i> DETALLES DE RESERVACIÓN</h2>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="pull-left">
            <address>
              <h3> &nbsp;<b class="text-dark"><?php echo $con[0]['nomhotel'] ?></b></h3>
              <p class="text-muted ml-1"><i class="fa fa-flash"></i> Nº <?php echo ($con[0]['documenhotel'] == '0' ? "DOC:" : $con[0]['documento'].": ")." ".$con[0]['nrohotel'] ?>,
                <br/> <i class="fa fa-map-marker"></i> <?php echo $con[0]['direchotel'] ?>,
                <br/> <i class="fa fa-envelope"></i> <?php echo $con[0]['emailhotel'] ?>,
                <br/> <i class="fa fa-phone"></i> <?php echo $con[0]['tlfhotel'] ?></p>
              </address>
            </div>
            <div class="pull-right text-right">
              <address>
                <h3><?php switch($con[0]['categoriahotel']){ case 1: ?>
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
                 } ?>  </h3>
                <h4 class="font-bold">ESTRELLAS</h4>
                  <p class="mt-2"><b>Fecha de Entrada :</b> <i class="fa fa-calendar"></i> <?php echo date("d-m-Y", strtotime($desde)); ?></p>
                  <p><b>Fecha de Salida :</b> <i class="fa fa-calendar"></i> <?php echo date("d-m-Y", strtotime($hasta)); ?></p>
                </address>
              </div>
            </div>
            <div class="col-md-12">
              <div class="table-responsive mt-2" style="clear: both;">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nº</th> 
                      <th>N° de Habitación</th>
                      <th>Tipo de Habitación</th>
                      <th>Descripción de Habitación</th>
                      <th>Noches</th>
                      <th>Valor Total</th>
                      <th>Descuento</th>
                      <th>Valor Neto</th>
                    </tr>
                  </thead>
                  <tbody>
  <?php
  $sql = mysqli_query($link,"SELECT 
  habitaciones.codhabitacion,
  habitaciones.numhabitacion,
  habitaciones.descriphabitacion,
  habitaciones.codtarifa,
  habitaciones.deschabitacion,
  tiposhabitaciones.nomtipo,
  tarifas.baja,
  tarifas.media,
  tarifas.alta FROM habitaciones 
  INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
  INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo
  WHERE habitaciones.codhabitacion = '".$check."' AND habitaciones.statushab = '0'") or die(mysqli_error($link));
  $array = mysqli_fetch_array($sql);
  
  $inicio = $desde;
  $fin = $hasta;
  $pago = 0;

  if($array=="") {

  echo "<div class='col-md-12'><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TARIFAS REGISTRADAS ACTUALMENTE</center>";
  echo "</div></div>";
  exit;

  } 
  
$sql2 = mysqli_query($link,"SELECT * FROM tarifas 
    WHERE codtarifa = '".$array['codtarifa']."'") or die (mysqli_error($link));
  $array2 = mysqli_fetch_array($sql2); 

while($inicio <= $fin) {

  $sql1 = mysqli_query($link,"SELECT temporada FROM temporadas 
    WHERE desde <= '".$inicio."' and hasta >= '".$inicio."'") or die (mysqli_error($link));
  $array1 = mysqli_fetch_array($sql1);

  if($array1=="") {

  echo "<div class='col-md-12'><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TEMPORADAS PARA TARIFAS REGISTRADAS ACTUALMENTE</center>";
  echo "</div></div>";
  exit;

  } else { 
  
 if($array1['temporada']=='BAJA') {
        $costo = $array2['baja']; 
  } elseif($array1['temporada']=='MEDIA') {
        $costo = $array2['media'];
  } elseif($array1['temporada']=='ALTA') {
        $costo = $array2['alta'];
  }

  $iva=$valor/100;
  $descuento=$desc_reservas/100;
  $pago = $pago + $costo;
  $subtotaldescuento = $pago*$array['deschabitacion']/100;
  $subtotalneto = $pago-$subtotaldescuento;

  $totaliva=$subtotalneto*$iva;
  $subtotal = $subtotalneto + $totaliva;
  $totaldescuento=$subtotal*$descuento;
  $totalpago = $subtotal - $totaldescuento;

mysqli_free_result($sql1);

$inicio = date("Y-m-d", strtotime("$inicio +1 day"));
  }
}

?>
                    <tr>
                      <td>1</td>
        <td><input name="codhabitacion[]" type="hidden" id="codhabitacion" value="<?php echo $array['codhabitacion']; ?>" />#<?php echo $array['numhabitacion']; ?></td>
        <td><?php echo $array['nomtipo']; ?></td>
        <td><?php echo $array['descriphabitacion']; ?></td>
        <td><?php echo Dias_Transcurridos($desde,$hasta); ?></td>
        
        <td><input name="valortotal[]" type="hidden" id="valortotal" value="<?php echo number_format($pago, 2, '.', ''); ?>" />
          <?php echo $simbolo.number_format($pago, 2, '.', ''); ?></td>
        
        <td><input name="subtotaldescuento[]" type="hidden" id="subtotaldescuento" value="<?php echo number_format($subtotaldescuento, 2, '.', ''); ?>" /><input name="deschabitacion[]" type="hidden" id="deschabitacion" value="<?php echo $array['deschabitacion']; ?>" /><?php echo $simbolo.number_format($subtotaldescuento, 2, '.', ''); ?><sup><?php echo $array['deschabitacion']; ?>%</sup></td>

        <td><input name="valorneto[]" type="hidden" id="valorneto" value="<?php echo number_format($subtotalneto, 2, '.', ''); ?>" /><?php echo $simbolo.number_format($subtotalneto, 2, '.', ''); ?></td>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="pull-right mt-2 text-right">
                <p>
                <label>Subtotal:</label> <?php echo $simbolo; ?><label id="lblsubtotal" name="lblsubtotal"><?php echo number_format($subtotalneto, 2, '.', ''); ?></label><br>
              <input type="hidden" name="txtsubtotal" id="txtsubtotal" value="<?php echo number_format($subtotalneto, 2, '.', ''); ?>"/>

                <label><?php echo $impuesto; ?> <?php echo $valor; ?>%:</label> <?php echo $simbolo; ?><label id="lbliva" name="lbliva"><?php echo number_format($totaliva, 2, '.', ''); ?></label><br>
                <input type="hidden" name="iva" id="iva" value="<?php echo $valor; ?>">
                <input type="hidden" name="txtIva" id="txtIva" value="<?php echo number_format($totaliva, 2, '.', ''); ?>"/>

                <label>Descuento <?php echo $desc_reservas; ?>%:</label> <?php echo $simbolo; ?><label id="lbldescuento" name="lbldescuento"><?php echo number_format($totaldescuento, 2, '.', ''); ?></label> 
                <input type="hidden" name="descuento" id="descuento" value="<?php echo $desc_reservas; ?>"/>
                <input type="hidden" name="txtDescuento" id="txtDescuento" value="<?php echo number_format($totaldescuento, 2, '.', ''); ?>"/></p>
                <hr>
                <h3><b>Importe Total :</b> <?php echo $simbolo; ?><label id="lbltotal" name="lbltotal"><?php echo number_format($totalpago, 2, '.', ''); ?></label>
                <input type="hidden" name="txtTotal" id="txtTotal" value="<?php echo number_format($totalpago, 2, '.', ''); ?>"/>
              </h3>
              </div>             

              <div class="clearfix"></div>
              <hr>

              <h5 class="card-title">Metodo de Pago</h5>
              <ul class="nav nav-tabs" role="tablist">
            
                <li role="presentation" class="nav-item">
                  <a href="#iefecty" class="nav-link active" onClick="CargaTab('<?php echo encrypt("1"); ?>');" aria-controls="efecty" role="tab" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-money"></i></span> 
                    <span class="hidden-xs">Efectivo</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#itarjeta" class="nav-link" onClick="CargaTab('<?php echo encrypt("2"); ?>');" aria-controls="credito" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-credit-card"></i></span>
                    <span class="hidden-xs"> Tarjeta de Crédito</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#itransf" class="nav-link" onClick="CargaTab('<?php echo encrypt("3"); ?>');" aria-controls="transf" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-folder-open"></i></span>
                    <span class="hidden-xs">Transferencia</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#icheque" class="nav-link" onClick="CargaTab('<?php echo encrypt("4"); ?>');" aria-controls="cheque" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-file-archive-o"></i></span>
                    <span class="hidden-xs">Cheque</span>
                  </a>
                </li>

                <li role="presentation" class="nav-item">
                  <a href="#icredito" class="nav-link" onClick="CargaTab('<?php echo encrypt("5"); ?>');" aria-controls="credito" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-bank"></i></span>
                    <span class="hidden-xs">Crédito</span>
                  </a>
                </li>
              </ul>

              <div class="tab-content">

                <div id="muestratabs">

                  <!-- PAGO EN EFECTIVO -->
                  <div role="tabpanel" class="tab-pane active" id="iefecty">
                    <div class="row">
                      <div class="col-md-4 mt-3">
                        <div class="form-group">
                          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
                          <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
                              <label class="custom-control-label" for="ticket">TICKET</label>
                            </div>
                          </div>

                          <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
                              <label class="custom-control-label" for="factura">FACTURA</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 mt-3"> 
                        <div class="form-group has-feedback"> 
                          <label class="control-label">Monto Pagado: <span class="symbol required"></span></label> 
                          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
                          <input type="hidden" name="formapago" id="formapago" value="EFECTIVO">
                          <input type="text" class="form-control" name="montopagado" id="montopagado" onKeyUp="this.value=this.value.toUpperCase(); EfectivoReserva();" placeholder="Ingrese Monto Recibido" autocomplete="off" required="" aria-required="true">
                          <i class="fa fa-tint form-control-feedback"></i>
                        </div> 
                      </div>

                      <div class="col-md-4 mt-3"> 
                        <div class="form-group has-feedback"> 
                          <label class="control-label">Monto Devuelto: <span class="symbol required"></span></label> 
                          <input type="hidden" name="montodevuelto" id="montodevuelto">
                          <input type="text" class="form-control" name="devolucion" id="devolucion" value="0.00" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Monto Devuelto" autocomplete="off" disabled="" required="" aria-required="true">
                          <i class="fa fa-tint form-control-feedback"></i>
                        </div> 
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group has-feedback2"> 
                          <label class="control-label">Observaciones: </label> 
                          <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="2" required="required"></textarea>
                          <i class="fa fa-comment-o form-control-feedback2"></i>
                        </div> 
                      </div>
                    </div>
                  </div>

                </div>
              
              <div class="clearfix"></div>
              <hr>
              <div class="text-right">
  <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-print"></span> Registrar</button>
  <button type="button" onClick="LimpiarTabs();" class="btn btn-dark"><span class="fa fa-trash-o"></span> Limpiar</button>
              </div>
            </div>

      </div>
    </div>
  </div>
</div>
<!-- End Row -->
<?php
########################################### PROCESO LA CONDICION EN PAGINA ###########################################
}
  } elseif(decrypt($tipo)==2){ ?>

<section id="page">
    
    <div id="content" class="pt30 pb30">
        <div class="container">

            <div class="row mb30" id="booking-breadcrumb">
                <div class="col-xs-3">
                  <div class="breadcrumb-item done">
                    <i class="fa fa-calendar"></i>
                    <span>Fecha de Reservación</span>
                  </div>
                </div>
                <div class="col-xs-3">
                  <div class="breadcrumb-item done">
                    <i class="fa fa-info-circle"></i>
                    <span>Resumen Habitaciones</span>
                  </div>
                </div>
                <div class="col-xs-3">
                  <div class="breadcrumb-item done">
                    <i class="fa fa-list"></i>
                    <span>Detalles de Reservación</span>
                  </div>
                </div>
                <div class="col-xs-3">
                  <div class="breadcrumb-item active">
                    <i class="fa fa-credit-card"></i>
                    <span>Pago de Reservación</span>
                  </div>
                </div>
            </div>
                       
      <div class="row">
          <div class="col-md-6">
          
          <fieldset>
            <legend>Datos Personales del Cliente</legend>

            <div class="row">
              <div class="col-md-9">
                <div class="form-group has-feedback">
                  <label class="control-label">Búsqueda de Clientes: <span class="symbol required"></span></label>
                  <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="busqueda" id="busqueda" onKeyUp="this.value=this.value.toUpperCase();" style="width: 440px;" placeholder="Ingrese Nº de Documento para la Búsqueda" autocomplete="off" required="" aria-required="true"/>
                  <i class="fa fa-search form-control-feedback"></i>
                </div>
              </div>

              <div class="col-md-2"><br>
    <button type="button" id="search_button" onClick="BuscarCliente(this.form.busqueda.value)" class="btn btn-info"><span class="fa fa-search-plus"></span> Buscar</button>
              </div>
            </div>
              
            <div id="muestraclientes"></div>
              
          <small class="text-dark">Una vez registrado en el sistema, podrá acceder a su panel de administración, ingresando su número de identificación para usuario y clave y seleccionando su nivel de acceso como cliente</span></small>
          <hr />
              
            
              <!--<div class="text-right">
  <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-print"></span> Registrar</button>
  <button type="button" onClick="LimpiarTabs();" class="btn btn-danger"><span class="fa fa-trash-o"></span> Limpiar</button>
              </div>-->

                  
                                          
                        </fieldset>
                    </div>
          
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Detalles de Reservación</legend>
                            <div class="ctaBox">
                                     <div class="row">
  <?php
  $total = 0;
  $i=0;
  while($i < $num) {
  $check2 = $check1[$i];

  $sql = mysqli_query($link,"SELECT 
  habitaciones.codhabitacion,
  habitaciones.numhabitacion,
  habitaciones.descriphabitacion,
  habitaciones.codtarifa,
  habitaciones.deschabitacion,
  tiposhabitaciones.nomtipo,
  tarifas.baja,
  tarifas.media,
  tarifas.alta FROM habitaciones 
  INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
  INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo
  WHERE habitaciones.codhabitacion = '".$check2."' AND habitaciones.statushab = '0'") or die(mysqli_error($link));
  $array = mysqli_fetch_array($sql);

  $inicio = $desde;
  $fin = $hasta;
  $pago = 0;
  $totalpago = 0;

  if($array=="") {

  echo "<div class='col-md-12'><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TARIFAS REGISTRADAS ACTUALMENTE</center>";
  echo "</div></div>";
  exit;

  } 
  
  $sql2 = mysqli_query($link,"SELECT * FROM tarifas 
    WHERE codtarifa = '".$array['codtarifa']."'") or die (mysqli_error($link));
  $array2 = mysqli_fetch_array($sql2);

  while($inicio <= $fin) {
  
  $sql1 = mysqli_query($link,"SELECT temporada FROM temporadas 
    WHERE desde <= '".$inicio."' and hasta >= '".$inicio."'") or die (mysqli_error($link));
  $array1 = mysqli_fetch_array($sql1);

  if($array1=="") {

  echo "<div class='col-md-12'><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-text='true'>&times;</button>";
  echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN TEMPORADAS PARA TARIFAS REGISTRADAS ACTUALMENTE</center>";
  echo "</div></div>";
  exit;

  } else { 

  if($array1['temporada']=='BAJA') {
        $costo = $array2['baja']; 
  } elseif($array1['temporada']=='MEDIA') {
        $costo = $array2['media'];
  } elseif($array1['temporada']=='ALTA') {
        $costo = $array2['alta'];
  }

  $pago = $pago + $costo;
  $subtotaldescuento = $pago*$array['deschabitacion']/100;
  $subtotalneto = $pago-$subtotaldescuento;

   mysqli_free_result($sql1);

   $inicio = date("Y-m-d", strtotime("$inicio +1 day"));
  }
}
$i++;
?>    
              <div class="col-md-6">
                <h3>
    <input name="codhabitacion[]" type="hidden" id="codhabitacion" value="<?php echo $array['codhabitacion']; ?>" />
    #<?php echo $array['numhabitacion']; ?>: <?php echo utf8_encode($array['descriphabitacion']); ?> 
                </h3>
              </div>

              <div class="col-md-3">
                <span class="pull-right lead text-center">
    <input name="valortotal[]" type="hidden" id="valortotal" value="<?php echo number_format($pago, 2, '.', ''); ?>" />
    <input name="subtotaldescuento[]" type="hidden" id="subtotaldescuento" value="<?php echo number_format($subtotaldescuento, 2, '.', ''); ?>" />
    <input name="deschabitacion[]" type="hidden" id="deschabitacion" value="<?php echo $array['deschabitacion']; ?>" />
    <?php echo $simbolo.number_format($subtotaldescuento, 2, '.', ''); ?><sup><?php echo $array['deschabitacion']; ?>%</sup><br>
                </span>
              </div>
                                         
              <div class="col-md-3">
                <span class="pull-right lead text-center">
    <input name="valorneto[]" type="hidden" id="valorneto" value="<?php echo number_format($subtotalneto, 2, '.', ''); ?>" />
    <?php echo $simbolo.number_format($subtotalneto, 2, '.', ''); ?><br>
                </span>
              </div>


<?php 
$iva=$valor/100;
$descuento=$desc_reservas/100;
$total = $total + $subtotalneto;

$totaliva=$total*$iva;
$subtotal = $total + $totaliva;
$totaldescuento=$subtotal*$descuento;
$totalpago = $subtotal - $totaldescuento;  
}
?>                
                  </div><p>
    Entrada <strong><input name="desde" type="hidden" id="desde" value="<?php echo $desde; ?>"><?php echo $desde; ?></strong><br>
    Salida <strong><input name="hasta" type="hidden" id="hasta" value="<?php echo $hasta; ?>"><?php echo $hasta; ?></strong><br>
                  <strong><?php echo Dias_Transcurridos($desde,$hasta); ?></strong> noche(s)</p>    
                  </div>
                </fieldset>

                <fieldset>
                  <legend>Detalle de Pago</legend>
                </fieldset>
                
                <div id="total_booking" class="mb10">                                                         
                    <div class="row">
                      <div class="col-xs-6">Subtotal</div>
                      <div class="col-xs-6 text-right"><input type="hidden" name="txtsubtotal" id="txtsubtotal" value="<?php echo number_format($total, 2, '.', ''); ?>"/><?php echo $simbolo.number_format($total, 2, '.', ''); ?></div>
                    </div>
                
                    <div class="row">
                      <div class="col-xs-6"><?php echo $impuesto; ?> (<?php echo $valor; ?>%)</div>
                      <div class="col-xs-6 text-right"><input type="hidden" name="iva" id="iva" value="<?php echo $valor; ?>"><input type="hidden" name="txtIva" id="txtIva" value="<?php echo number_format($totaliva, 2, '.', ''); ?>"/><?php echo $simbolo.number_format($totaliva, 2, '.', ''); ?></div>
                    </div>
                               
                    <div class="row">
                      <div class="col-xs-6">Descuento (<?php echo $desc_reservas; ?>%)</div>
                      <div class="col-xs-6 text-right"><input type="hidden" name="descuento" id="descuento" value="<?php echo $desc_reservas; ?>"/><input type="hidden" name="txtDescuento" id="txtDescuento" value="<?php echo number_format($totaldescuento, 2, '.', ''); ?>"/><?php echo $simbolo.number_format($totaldescuento, 2, '.', ''); ?></div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6">
                      <h3>Importe Total</h3>
                      </div>
                  
                      <div class="col-xs-6 lead text-right"><input type="hidden" name="txtTotal" id="txtTotal" value="<?php echo number_format($totalpago, 2, '.', ''); ?>"/><?php echo $simbolo.number_format($totalpago, 2, '.', ''); ?></div>
                    </div>
                </div>

                <fieldset>
                    <legend>Observaciones de Reservación</legend>
                    <div class="form-group has-feedback">
                      <textarea style="color:#000;font-weight:bold;" name="observaciones" class="form-control tooltips" id="observaciones" onkeyup="this.value=this.value.toUpperCase();" data-rel="tooltip" placeholder="Ingrese Observacion de Reservacion" autocomplete="off" data-placement="top" rows="3" required="required"></textarea>
                        <div class="field-notice" rel="comments"></div>
                    </div>
                </fieldset>

                <div class="text-right">
  <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-print"></span> Registrar</button>
  <button type="button" onClick="LimpiarTabs();" class="btn btn-danger"><span class="fa fa-trash-o"></span> Limpiar</button>
              </div>


                    </div>
                </div>
        </div>
    </div>
</section>  
     
  <?php
  }
} 
############################# MUESTRA HABITACIONES RESERVADAS ###########################
?>

<?php 
######################## MUESTRA DATOS DEL PARA RESERVACIONES ########################
if (isset($_GET['BuscarClientes']) && isset($_GET['busqueda'])) { 
  
$valor = limpiar($_GET['busqueda']);

if($valor=="") {

    echo "<center><div class='alert alert-danger'>";
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "<span class='fa fa-info-circle'></span> POR FAVOR REALICE LA BÚSQUEDA DEL CLIENTE</div></center>";
    exit;   
    
} else {

$bus = new Login();
$reg = $bus->BuscarClientes();

?>
    <div class="row">
      <div class="col-md-5">
        <div class="form-group has-feedback">
          <label class="control-label">Nº Documento: </label>
          <input type="hidden" name="codcliente" id="codcliente" value="<?php echo encrypt($reg[0]['codcliente']); ?>">
          <br /><abbr title="Nº de Documento"><?php echo $documento = ($reg[0]['documcliente'] == '' ? "" : $reg[0]['documento'])." ".$reg[0]['dnicliente']; ?></abbr> 
        </div>
      </div>

      <div class="col-md-7">
        <div class="form-group has-feedback">
          <label class="control-label">Nombres y Apellidos: </label>
          <br /><abbr title="Nombre y Apellido"><?php echo $reg[0]['nomcliente']; ?></abbr>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="form-group has-feedback">
          <label class="control-label">Nº de Telefono: </label>
          <br /><abbr title="Nº de Telefono"><?php echo $reg[0]['telefcliente']; ?></abbr> 
        </div>
      </div>

      <div class="col-md-7">
        <div class="form-group has-feedback">
          <label class="control-label">Correo Electrónico: </label>
          <br /><abbr title="Correo Electrónico"><?php echo $reg[0]['correocliente'] == '' ? "**********" : $reg[0]['correocliente']; ?></abbr>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group has-feedback">
          <label class="control-label">Dirección Domiciliaria: </label>
          <br /><abbr title="Dirección Domiciliaria"><?php echo paises($reg[0]['paiscliente'])." - ".$reg[0]['ciudadcliente']." - ".$reg[0]['direccliente']; ?></abbr> 
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-11">
        <div class="form-group has-feedback">
          <label class="control-label">Forma de Pago: <span class="symbol required"></span></label>
          <i class="fa fa-bars form-control-feedback"></i>
          <select style="color:#000;font-weight:bold;" name="busqueda_forma" id="busqueda_forma" class='form-control' onChange="CondicionesPagosWeb(this.form.busqueda_forma.value)" required="required">
          <option value="">SELECCIONE</option>
          <option value="1">EFECTIVO</option>
          <option value="2">TARJETA DE CRÉDITO</option>
          <option value="3">TRANSFERENCIA</option>
          <option value="4">CHEQUE</option>
          </select>
        </div>
      </div>
    </div>
    <div id="muestraformaspago"></div>
<?php
     }
  }
####################### MUESTRA DATOS DEL CLIENTE PARA RESERVACIONES ########################
?>

<?php 
######################## MUESTRA CONDICIONES DE PAGO EN WEB PARA RESERVACIONES ########################
if (isset($_GET['BuscaCondicionPago']) && isset($_GET['busqueda_forma'])) { 
  
$tra = new Login();

 if(limpiar($_GET['busqueda_forma'])==""){ echo ""; 

 } elseif(limpiar($_GET['busqueda_forma']) == 1){  ?>
               
  <!-- PAGO EN EFECTIVO -->
  <div role="tabpanel" class="tab-pane active" id="iefecty">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">Tipo Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">&nbsp;&nbsp;TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">&nbsp;&nbsp;FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Monto Pagado: <span class="symbol required"></span></label>
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="EFECTIVO"> 
          <input style="color:#000;font-weight:bold;" type="text" class="form-control calculodevolucion" name="montopagado" id="montopagado" onKeyUp="this.value=this.value.toUpperCase(); EfectivoReserva();" placeholder="Ingrese Monto Recibido" value="0.00" autocomplete="off" disabled="" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Monto Devuelto: <span class="symbol required"></span></label> 
          <input type="hidden" name="montodevuelto" id="montodevuelto" readonly="readonly">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="devolucion" id="devolucion" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Monto Devuelto" value="0.00" autocomplete="off" disabled="" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>
    </div>
  </div>
 
 <?php } else if(limpiar($_GET['busqueda_forma']) == 2){ ?>

  <!-- PAGO EN TARJETA -->
  <div role="tabpanel" class="tab-pane" id="itarjeta">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">Tipo Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">&nbsp;&nbsp;TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">&nbsp;&nbsp;FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de Tarjeta: <span class="symbol required"></span></label> 
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="TARJETA DE CRÉDITO"> 
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="nrotarjeta" id="nrotarjeta" onKeyUp="this.value=this.value.toUpperCase();" onBlur="validatecreditcard();" placeholder="Nº de Tarjeta de Crédito" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-keyboard-o form-control-feedback"></i>
        </div> 
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group has-feedback">
          <label class="control-label">Nombre de Tarjeta: <span class="symbol required"></span></label>
          <input type="hidden" name="tipotarjeta" id="tipotarjeta" readonly="">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="tarjeta" id="tarjeta" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre de Tarjeta de Crédito" autocomplete="off" disabled="" required="" aria-required="true">
          <i class="fa fa-credit-card form-control-feedback"></i> 
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group has-feedback">
          <label class="control-label">Mes/Año de Expiración: <span class="symbol required"></span></label> 
          <input style="color:#000;font-weight:bold;" type="text" class="form-control expira-inputmask" name="expira" id="expira" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Expiración MM/AA" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-calendar form-control-feedback"></i>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group has-feedback">
          <label class="control-label">Código CVC: <span class="symbol required"></span></label>
          <input style="color:#000;font-weight:bold;" type="text" class="form-control cvc-inputmask" name="codverifica" id="codverifica" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Código CVC" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-pencil form-control-feedback"></i>
        </div>
      </div>
    </div>
  </div>

 <?php } else if(limpiar($_GET['busqueda_forma']) == 3){ ?>

  <!-- PAGO EN TRANSFERENCIA -->
  <div role="tabpanel" class="tab-pane" id="itransf">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">Tipo Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">&nbsp;&nbsp;TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">&nbsp;&nbsp;FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de Comprobante: <span class="symbol required"></span></label>
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="TRANSFERENCIA">  
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="nrotransferencia" id="nrotransferencia" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Transferencia o Recibo" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4">
          <div class="form-group has-feedback">
              <label>Foto de Comprobante: </label>
<input type="file" class="form-control" data-original-title="Subir Archivo" data-rel="tooltip" title="Realice la búsqueda del archivo" placeholder="Suba su Backup" name="sel_file" id="sel_file"/>
              <i class="fa fa-pencil form-control-feedback"></i>  
          </div>
      </div>
    </div>
  </div>

 <?php } else if(limpiar($_GET['busqueda_forma']) == 4){ ?>

   <!-- PAGO EN CHEQUE -->
   <div role="tabpanel" class="tab-pane" id="icheque">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">Tipo Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">&nbsp;&nbsp;TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">&nbsp;&nbsp;FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de Cheque: <span class="symbol required"></span></label>
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="CHEQUE">  
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="cheque" id="cheque" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Cheque" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4">
        <div class="form-group has-feedback">
          <label class="control-label">Nombre de Banco: <span class="symbol required"></span></label>
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="bancocheque" id="bancocheque" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre de Banco de Cheque" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-pencil form-control-feedback"></i> 
        </div>
      </div>
    </div>
  </div>  
 
<?php  }
  }
####################### MUESTRA CONDICIONES DE PAGO EN WEB PARA RESERVACIONES ########################
?>


<?php 
######################## MUESTRA CONDICIONES DE PAGO EN TABS PARA RESERVACIONES ########################
if (isset($_GET['BuscaTabsReservacion']) && isset($_GET['busqueda_forma'])) { 
  
$tra = new Login();

 if(limpiar($_GET['busqueda_forma'])==""){ echo ""; 

 } elseif(limpiar(decrypt($_GET['busqueda_forma'])) == 1){  ?>
               
  <!-- PAGO EN EFECTIVO -->
  <div role="tabpanel" class="tab-pane active" id="iefecty">
    <div class="row">
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Monto Pagado: <span class="symbol required"></span></label> 
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="EFECTIVO">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control calculodevolucion" name="montopagado" id="montopagado" onKeyUp="this.value=this.value.toUpperCase(); EfectivoReserva();" placeholder="Ingrese Monto Recibido" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Monto Devuelto: <span class="symbol required"></span></label> 
          <input type="hidden" name="montodevuelto" id="montodevuelto" readonly="readonly">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="devolucion" id="devolucion" value="0.00" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Monto Devuelto" autocomplete="off" disabled="" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"> 
        <div class="form-group has-feedback2"> 
          <label class="control-label">Observaciones: </label> 
          <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="2" required="required"></textarea>
          <i class="fa fa-comment-o form-control-feedback2"></i>
        </div> 
      </div>
    </div>
  </div>

 
 <?php } else if(limpiar(decrypt($_GET['busqueda_forma'])) == 2){ ?>

  <!-- PAGO EN TARJETA -->
  <div role="tabpanel" class="tab-pane" id="itarjeta">
    <div class="row">
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de Tarjeta: <span class="symbol required"></span></label> 
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="TARJETA DE CRÉDITO">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="nrotarjeta" id="nrotarjeta" onKeyUp="this.value=this.value.toUpperCase();" onBlur="validatecreditcard();" placeholder="Nº de Tarjeta de Crédito" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-keyboard-o form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4 mt-3">
        <div class="form-group has-feedback">
          <label class="control-label">Nombre de Tarjeta: <span class="symbol required"></span></label>
          <input type="hidden" name="tipotarjeta" id="tipotarjeta" readonly="">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="tarjeta" id="tarjeta" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre de Tarjeta de Crédito" autocomplete="off" disabled="" required="" aria-required="true">
          <i class="fa fa-credit-card form-control-feedback"></i> 
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group has-feedback">
          <label class="control-label">Mes/Año de Expiración: <span class="symbol required"></span></label> 
          <input style="color:#000;font-weight:bold;" type="text" class="form-control expira-inputmask" name="expira" id="expira" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Expiración MM/AA" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-calendar form-control-feedback"></i>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group has-feedback">
          <label class="control-label">Código CVC: <span class="symbol required"></span></label>
          <input style="color:#000;font-weight:bold;" type="text" class="form-control cvc-inputmask" name="codverifica" id="codverifica" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Código CVC" autocomplete="off" required="" aria-required="true"><small class="text-dark">Son 4 o 3 Digitos ubicados al reverso de la Tarjeta de Crédito</small>
          <i class="fa fa-pencil form-control-feedback"></i>
        </div>
      </div>

      <div class="col-md-4"> 
        <div class="form-group has-feedback2"> 
          <label class="control-label">Observaciones: </label> 
          <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="1" required="required"></textarea>
          <i class="fa fa-comment-o form-control-feedback2"></i>
        </div> 
      </div>
    </div>
  </div>

 <?php } else if(limpiar(decrypt($_GET['busqueda_forma'])) == 3){ ?>

  <!-- PAGO EN TRANSFERENCIA -->
  <div role="tabpanel" class="tab-pane" id="itransf">
    <div class="row">
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de Transferencia o Recibo: <span class="symbol required"></span></label> 
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="TRANSFERENCIA">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="nrotransferencia" id="nrotransferencia" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Transferencia o Recibo" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback">
          <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="form-group has-feedback"> 
              <label class="control-label">Comprobante de Transferencia: </label>
              <div class="input-group">
                <div class="form-control" data-trigger="fileinput"><i class="fa fa-file-archive-o fileinput-exists"></i>
                  <span class="fileinput-filename"></span>
                </div>
                <span class="input-group-addon btn btn-info btn-file">
                  <span class="fileinput-new"><i class="fa fa-cloud-upload"></i> Selecciona Archivo</span>
                  <span class="fileinput-exists"><i class="fa fa-file-archive-o"></i> Cambiar</span>
                  <input type="file" class="btn btn-default" data-original-title="Realice la búsqueda del archivo" data-rel="tooltip" placeholder="Suba su Imagen" name="sel_file" id="sel_file" autocomplete="off">
                </span>
                <a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Quitar</a>
              </div><small class="text-dark"><p>Realice la Carga del Comprobante de Transferencia.<br></small>
              </div>
            </div>
          </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"> 
          <div class="form-group has-feedback2"> 
            <label class="control-label">Observaciones: </label> 
            <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="2" required="required"></textarea>
            <i class="fa fa-comment-o form-control-feedback2"></i>
          </div> 
        </div>
      </div>
    </div>

 <?php } else if(limpiar(decrypt($_GET['busqueda_forma'])) == 4){ ?>

   <!-- PAGO EN CHEQUE -->
   <div role="tabpanel" class="tab-pane" id="icheque">
    <div class="row">
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Nº de Cheque: <span class="symbol required"></span></label> 
          <input type="hidden" id="tipopago" name="tipopago" value="CONTADO">
          <input type="hidden" name="formapago" id="formapago" value="CHEQUE">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="cheque" id="cheque" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nº de Cheque" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4 mt-3">
        <div class="form-group has-feedback">
          <label class="control-label">Nombre de Banco: <span class="symbol required"></span></label>
          <input style="color:#000;font-weight:bold;" type="text" class="form-control" name="bancocheque" id="bancocheque" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Nombre de Banco de Cheque" autocomplete="off" required="" aria-required="true">
          <i class="fa fa-pencil form-control-feedback"></i> 
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12"> 
        <div class="form-group has-feedback2"> 
          <label class="control-label">Observaciones: </label> 
          <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="2" required="required"></textarea>
          <i class="fa fa-comment-o form-control-feedback2"></i>
        </div> 
      </div>
    </div>
  </div>  

  <?php } elseif(limpiar(decrypt($_GET['busqueda_forma'])) == 5){  ?>
     
  <!-- PAGO EN CREDITO -->
  <div role="tabpanel" class="tab-pane active" id="icredito">
    <div class="row">
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <label class="control-label">Tipo de Documento: <span class="symbol required"></span></label><br>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="ticket" name="tipodocumento" value="TICKETRESERVA" checked="checked">
              <label class="custom-control-label" for="ticket">TICKET</label>
            </div>
          </div>

          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="factura" name="tipodocumento" value="FACTURARESERVA">
              <label class="custom-control-label" for="factura">FACTURA</label>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Fecha Vencimiento: <span class="symbol required"></span></label> 
          <input type="hidden" id="tipopago" name="tipopago" value="CREDITO">
          <input type="hidden" name="formapago" id="formapago" value="CREDITO">
          <input style="color:#000;font-weight:bold;" type="text" class="form-control date-inputmask expira" name="fechavencecredito" id="fechavencecredito" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Fecha Vence Crédito: dd-mm-aaaa" aria-required="true">
          <i class="fa fa-calendar form-control-feedback"></i>
        </div> 
      </div>

      <div class="col-md-4 mt-3"> 
        <div class="form-group has-feedback"> 
          <label class="control-label">Abono Crédito: <span class="symbol required"></span></label>
          <input style="color:#000;font-weight:bold;" class="form-control number" type="text" name="montoabono" id="montoabono" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" autocomplete="off" placeholder="Ingrese Monto de Abono" value="0.00" required="" aria-required="true"> 
          <i class="fa fa-tint form-control-feedback"></i>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"> 
        <div class="form-group has-feedback2"> 
          <label class="control-label">Observaciones: </span></label> 
          <textarea style="color:#000;font-weight:bold;" class="form-control" name="observaciones" id="observaciones" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Observaciones de Pago" autocomplete="off" rows="2" required="required"></textarea>
          <i class="fa fa-comment-o form-control-feedback2"></i>
        </div> 
      </div>
    </div>
  </div>     
 
<?php  }
  }
####################### MUESTRA CONDICIONES DE PAGO EN TABS PARA RESERVACIONES ########################
?>
