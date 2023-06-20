<?php
include('class.consultas.php');

if (isset($_GET['Busqueda_Cliente'])):

$filtro = $_GET["term"];
$Json = new Json;
$clientes = $Json->BuscaClientes($filtro);
echo  json_encode($clientes);

endif;

if (isset($_GET['Busqueda_Insumo']) or isset($_GET['Busqueda_Kardex_Insumo'])):

$filtro = $_GET["term"];
$Json = new Json;
$insumo  = $Json->BuscaInsumo($filtro);
echo json_encode($insumo);

endif;

if (isset($_GET['Busqueda_Producto_Venta'])):

$filtro = $_GET["term"];
$Json = new Json;
$producto = $Json->BuscaProductoV($filtro);
echo json_encode($producto);

endif;

if (isset($_GET['Busqueda_Producto_Compra']) or isset($_GET['Busqueda_Kardex_Producto'])):

$filtro = $_GET["term"];
$Json = new Json;
$producto = $Json->BuscaProductoC($filtro);
echo json_encode($producto);

endif;

?>  