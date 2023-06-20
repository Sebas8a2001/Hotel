<?php
require_once("class/class.php");
?>
<script src="assets/script/script2.js"></script>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script> 

<?php
$imp = new Login();
$imp = $imp->ImpuestosPorId();
$impuesto = ($imp == "" ? "Impuesto" : $imp[0]['nomimpuesto']);
$valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

//$simbolo = ($_SESSION["acceso"] == "administradorG" ? "" : "<strong>".$_SESSION["simbolo"]."</strong>");

$new = new Login();
?>



<?php 
######################## MUESTRA CONDICIONES DE PAGO ########################
if (isset($_GET['BuscaCondicionesPagos']) && isset($_GET['tipopago']) && isset($_GET['txtTotal'])) { 
  
$tra = new Login();

 if(limpiar($_GET['tipopago'])==""){ echo ""; 

 } elseif(limpiar($_GET['tipopago'])=="CONTADO"){  ?>

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
               <label class="control-label">Monto Recibido: </label>
              <input type="hidden" name="montodevuelto" id="montodevuelto" value="0.00">
               <input style="color:#000;font-weight:bold;" class="form-control" type="text" name="montopagado" id="montopagado" autocomplete="off" placeholder="Monto Recibido" onKeyUp="CalculoDevolucion();" required="" aria-required="true"> 
               <i class="fa fa-tint form-control-feedback"></i>
            </div> 
        </div>
    </div>
          
 <?php   } else if(limpiar($_GET['tipopago'])=="CREDITO"){  ?>

      <div class="row">
              <div class="col-md-6"> 
                   <div class="form-group has-feedback"> 
                      <label class="control-label">Fecha Vence Crédito: <span class="symbol required"></span></label> 
                      <input style="color:#000;font-weight:bold;" type="text" class="form-control expira" name="fechavencecredito" id="fechavencecredito" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Fecha Vence Crédito" aria-required="true">
                      <i class="fa fa-calendar form-control-feedback"></i>  
                 </div> 
              </div> 

              <div class="col-md-6"> 
                  <div class="form-group has-feedback"> 
                     <label class="control-label">Abono Crédito: <span class="symbol required"></span></label>
                     <input style="color:#000;font-weight:bold;" class="form-control number" type="text" name="montoabono" id="montoabono" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" autocomplete="off" placeholder="Ingrese Monto de Abono" value="0.00" required="" aria-required="true"> 
                     <i class="fa fa-tint form-control-feedback"></i>
                  </div> 
              </div>
          </div>
 
<?php  }
  }
######################## MUESTRA CONDICIONES DE PAGO ########################
?>

<?php 
########################### MUESTRA MEDIOS DE PAGO PARA VENTAS ########################
if (isset($_GET['MuestraMediosPagos']) && isset($_GET['codmediopago'])) { 

$reg = $new->MediosPagosPorId();
  
if(limpiar($_GET['codmediopago'])=="") { echo "";


} else if($reg[0]['mediopago']=="EFECTIVO"){ ?>

          <div class="row">
              <div class="col-md-6"> 
                  <div class="form-group has-feedback"> 
                     <label class="control-label">Monto Pagado: <span class="symbol required"></span></label>
                     <input class="form-control number" type="text" name="montopagado" id="montopagado" aria-describedby="basic-addon3" oninput="" onKeyUp="calculateChange();" autocomplete="off" placeholder="Monto Pagado por Cliente" required="" aria-required="true"> 
                     <i class="fa fa-tint form-control-feedback"></i>
                  </div> 
              </div>

              <div class="col-md-6"> 
                  <div class="form-group has-feedback"> 
                     <label class="control-label">Cambio Devuelto: <span class="symbol required"></span></label>
                     <input class="form-control calculodevolucion" type="text" name="montodevuelto" id="montodevuelto" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cambio Devuelto a Cliente" readonly="readonly" value="0.00" aria-required="true"> 
                     <i class="fa fa-tint form-control-feedback"></i>
                  </div> 
              </div>
          </div>
<?php      
     }
  }
############################# MUESTRA MEDIOS DE PAGO PARA VENTAS ########################
?>