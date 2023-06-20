<?php
include_once('fpdf/pdf.php');
require_once("class/class.php");	
//ob_end_clean();
ob_start();

$casos = array (

                  'MENSAJES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarMensajes',

                                    'output' => array('Listado Mensajes de Contacto.pdf', 'I')

                                  ),

                  'CATEGORIAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarCategorias',

                                    'output' => array('Listado de Categorias.pdf', 'I')

                                  ),

                  'DOCUMENTOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarDocumentos',

                                    'output' => array('Listado de Tipos de Documentos.pdf', 'I')

                                  ),

                  'TIPOMONEDA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarTiposMonedas',

                                    'output' => array('Listado de Tipos de Moneda.pdf', 'I')

                                  ),

                'TIPOCAMBIO' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarTiposCambio',

                                    'output' => array('Listado de Tipos de Cambio.pdf', 'I')

                                  ),
                  
                  'MEDIOSPAGOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarMediosPagos',

                                    'output' => array('Listado de Medios de Pago.pdf', 'I')

                                  ),
                  
                  'IMPUESTOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarImpuestos',

                                    'output' => array('Listado de Impuestos.pdf', 'I')

                                  ),

                  'PERFIL' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarPerfil',

                                    'output' => array('Listado de Perfil de Hotel.pdf', 'I')

                                  ),

                  'TEMPORADAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarTemporadas',

                                    'output' => array('Listado de Temporadas.pdf', 'I')

                                  ),

                  'NOTICIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarNoticias',

                                    'output' => array('Listado de Noticias.pdf', 'I')

                                  ),

                  'TIPOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarTipoHabitaciones',

                                    'output' => array('Listado de Tipo de Habitaciones.pdf', 'I')

                                  ),

                   'TARIFAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarTarifas',

                                    'output' => array('Listado de Tarifas.pdf', 'I')

                                  ),

                  'USUARIOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarUsuarios',

                                    'output' => array('Listado de Usuarios.pdf', 'I')

                                  ),

                  'LOGS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLogs',

                                    'output' => array('Listado Logs de Acceso.pdf', 'I')

                                  ),
                  'HABITACIONES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarHabitaciones',

                                    'output' => array('Listado de Habitaciones.pdf', 'I')

                                  ),

                  'CLIENTES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarClientes',

                                    'output' => array('Listado de Clientes.pdf', 'I')

                                  ),

                  'PROVEDORES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarProveedores',

                                    'output' => array('Listado de Proveedores.pdf', 'I')

                                  ),

                 'INSUMOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarInsumos',

                                    'output' => array('Listado de Insumos.pdf', 'I')

                                  ),

                 'ENTRADAINSUMOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarEntradaInsumos',

                                    'output' => array('Listado Entradas de Insumos.pdf', 'I')

                                  ),

                 'SALIDAINSUMOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarSalidaInsumos',

                                    'output' => array('Listado Salidas de Insumos.pdf', 'I')

                                  ),

                   'KARDEXINSUMOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarKardexInsumos',

                                    'output' => array('Listado de Kardex de Insumo.pdf', 'I')

                                  ),

                 'PRODUCTOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarProductos',

                                    'output' => array('Listado de Productos.pdf', 'I')

                                  ),

                   'KARDEXPRODUCTOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarKardexProducto',

                                    'output' => array('Listado de Kardex de Producto.pdf', 'I')

                                  ),

                  'PRODUCTOSVENDIDOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarProductosVendidos',

                                    'output' => array('Listado de Productos Vendidos.pdf', 'I')

                                  ),

                  'PRODUCTOSXMONEDA' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarProductosxMoneda',

                                    'output' => array('Listado de Productos por Moneda.pdf', 'I')

                                  ),

                 'FACTURACOMPRA' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'FacturaCompra',

                                    'output' => array('Factura de Compra.pdf', 'I')

                                  ),

                 'COMPRAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCompras',

                                    'output' => array('Listado de Compras.pdf', 'I')

                                  ),

                 'CUENTASXPAGAR' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCuentasxPagar',

                                    'output' => array('Listado de Cuentas por Pagar.pdf', 'I')

                                  ),

              'COMPRASXPROVEEDOR' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarComprasxProveedor',

                                    'output' => array('Listado de Compras por Proveedor.pdf', 'I')

                                  ),

              'COMPRASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarComprasxFechas',

                                    'output' => array('Listado de Compras por Fechas.pdf', 'I')

                                  ),

                'CAJAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarCajas',

                                    'output' => array('Listado de Cajas.pdf', 'I')

                                  ),

               'ARQUEOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarArqueos',

                                    'output' => array('Listado de Arqueos de Cajas.pdf', 'I')

                                  ),
        
                  'TICKETCIERRE' => array(

                                    'medidas' => array('P','mm','cierre'),

                                    'func' => 'TicketCierre',

                                    'setPrintFooter' => 'true',

                                    'output' => array('Ticket de Cierre.pdf', 'I')

                                  ),

                'MOVIMIENTOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarMovimientos',

                                    'output' => array('Listado de Movimientos en Caja.pdf', 'I')

                                  ),

                   'ARQUEOSXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarArqueosxFechas',

                                    'output' => array('Listado de Arqueos por Fechas.pdf', 'I')

                                  ),

                  'MOVIMIENTOSXFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarMovimientosxFechas',

                                    'output' => array('Listado de Movimientos por Fechas.pdf', 'I')

                                  ),
        
                  'TICKETRESERVA' => array(

                                    'medidas' => array('P','mm','ticket'),

                                    'func' => 'TicketReservacion',

                                    'setPrintFooter' => 'true',

                                    'output' => array('Ticket de Venta.pdf', 'I')

                                  ),

                  'FACTURARESERVA' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'FacturaReservacion',

                                    'output' => array('Factura de Ventas.pdf', 'I')

                                  ),

                  'RESERVACIONES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarReservaciones',

                                    'output' => array('Listado de Ventas.pdf', 'I')

                                  ),

                  'RESERVACIONESDIARIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarReservacionesDiarias',

                                    'output' => array('Listado de Reservaciones del Dia.pdf', 'I')

                                  ),

                  'RESERVACIONESXTARJETAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarReservacionesxTarjetas',

                                    'output' => array('Listado de Ventas.pdf', 'I')

                                  ),

                  'RESERVACIONESXCAJAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarReservacionesxCajas',

                                    'output' => array('Listado de Reservaciones por Cajas.pdf', 'I')

                                  ),

                  'RESERVACIONESXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarReservacionesxFechas',

                                    'output' => array('Listado de Reservaciones por Fechas.pdf', 'I')

                                  ),

                  'RESERVACIONESXCLIENTES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarReservacionesxClientes',

                                    'output' => array('Listado de Reservaciones por Clientes.pdf', 'I')

                                  ),
        
                  'TICKET' => array(

                                    'medidas' => array('P','mm','ticket'),

                                    'func' => 'TicketVenta',

                                    'setPrintFooter' => 'true',

                                    'output' => array('Ticket de Venta.pdf', 'I')

                                  ),

                  'FACTURA' => array(

                                    'medidas' => array('P', 'mm', 'mitad'),
                                    //'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'FacturaVenta',

                                    'output' => array('Factura de Ventas.pdf', 'I')

                                  ),

                  'VENTAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarVentas',

                                    'output' => array('Listado de Ventas.pdf', 'I')

                                  ),

                  'VENTASDIARIAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarVentasDiarias',

                                    'output' => array('Listado de Ventas del Dia.pdf', 'I')

                                  ),

                  'VENTASXCAJAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarVentasxCajas',

                                    'output' => array('Listado de Ventas por Cajas.pdf', 'I')

                                  ),

                  'VENTASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarVentasxFechas',

                                    'output' => array('Listado de Ventas por Fechas.pdf', 'I')

                                  ),

                  'DETALLESVENTASXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarDetallesVentasxFechas',

                                    'output' => array('Listado de Detalles Ventas por Fechas.pdf', 'I')

                                  ),


        
                  'TICKETCREDITORESERVACIONES' => array(

                                    'medidas' => array('P','mm','ticket'),

                                    'func' => 'TicketCreditoReservacion',

                                    'output' => array('Ticket de Abonos.pdf', 'I')

                                  ),

                  'CREDITOSXRESERVACIONES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCreditosReservaciones',

                                    'output' => array('Listado de Creditos.pdf', 'I')

                                  ),


        
                  'TICKETCREDITOVENTA' => array(

                                    'medidas' => array('P','mm','ticket'),

                                    'func' => 'TicketCreditoVenta',

                                    'output' => array('Ticket de Abonos.pdf', 'I')

                                  ),

                  'CREDITOSXVENTAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCreditosVentas',

                                    'output' => array('Listado de Creditos.pdf', 'I')

                                  ),

                  

                  'CREDITOSXCLIENTES' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCreditosxClientes',

                                    'output' => array('Listado de Creditos por Clientes.pdf', 'I')

                                  ),

                  'CREDITOSXFECHAS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarCreditosxFechas',

                                    'output' => array('Listado de Creditos por Fechas.pdf', 'I')

                                  ),

                );

 
$tipo = decrypt($_GET['tipo']);
$caso_data = $casos[$tipo];
$pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
$pdf->AddPage();
$pdf->SetAuthor("Ing. Ruben Chirinos");
$pdf->SetCreator("FPDF Y PHP");
$pdf->{$caso_data['func']}();
$pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
ob_end_flush();
?>