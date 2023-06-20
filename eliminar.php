<?php
require_once("class/class.php");
$tra = new Login();
$tipo = decrypt($_GET['tipo']);
switch($tipo)
{

case 'MENSAJES':
$tra->EliminarContact();
exit;
break;

case 'USUARIOS':
$tra->EliminarUsuarios();
exit;
break;

case 'CATEGORIAS':
$tra->EliminarCategorias();
exit;
break;

case 'DOCUMENTOS':
$tra->EliminarDocumentos();
exit;

case 'TIPOMONEDA':
$tra->EliminarTipoMoneda();
exit;

case 'TIPOCAMBIO':
$tra->EliminarTipoCambio();
exit;

case 'MEDIOSPAGOS':
$tra->EliminarMediosPagos();
exit;

case 'IMPUESTOS':
$tra->EliminarImpuestos();
exit;
break;

case 'PERFIL':
$tra->EliminarPerfil();
exit;
break;

case 'TEMPORADAS':
$tra->EliminarTemporada();
exit;
break;

case 'NOTICIAS':
$tra->EliminarNoticias();
exit;
break;

case 'TIPOS':
$tra->EliminarTipos();
exit;

case 'TARIFAS':
$tra->EliminarTarifas();
exit;

case 'HABITACIONES':
$tra->EliminarHabitaciones();
exit;

case 'CLIENTES':
$tra->EliminarClientes();
exit;
break;

case 'REINICIAR':
$tra->ReiniciarClave();
exit;
break;

case 'PROVEEDORES':
$tra->EliminarProveedores();
exit;
break;

case 'INSUMOS':
$tra->EliminarInsumos();
exit;
break;

case 'SALIDAINSUMOS':
$tra->EliminarSalidaInsumos();
exit;
break;

case 'COMPRAS':
$tra->EliminarCompras();
exit;
break;

case 'PAGARFACTURA':
$tra->PagarCompras();
exit;
break;

case 'DETALLESCOMPRAS':
$tra->EliminarDetallesCompras();
exit;
break;

case 'CAJAS':
$tra->EliminarCajas();
exit;

case 'MOVIMIENTOS':
$tra->EliminarMovimiento();
exit;
break;

case 'ACTIVAR':
$tra->ActivarReservaciones();
exit;
break;

case 'CULMINAR':
$tra->CulminarReservaciones();
exit;
break;

case 'RESERVACIONES':
$tra->EliminarReservaciones();
exit;
break;

case 'DETALLESRESERVACIONES':
$tra->EliminarDetallesReservaciones();
exit;
break;

case 'VENTAS':
$tra->EliminarVentas();
exit;
break;

case 'DETALLESVENTAS':
$tra->EliminarDetallesVentas();
exit;
break;

}
?>