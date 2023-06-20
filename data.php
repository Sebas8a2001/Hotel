<?php
require_once("class/class.php");

header('Content-Type: application/json');


################ GRAFICO HABITACIONES MAS RESERVADAS ########################
if (isset($_GET['Habitaciones_Reservadas'])):

$hab = new Login();
$h = $hab->HabitacionesMasReservadas();

$data = array();
foreach ($h as $row) {
	$data[] = $row;
}

echo json_encode($data);

endif;


################ GRAFICO POR SUCURSALES ########################
if (isset($_GET['ProcesosxSucursales'])):

$grafico = new Login();
$reg = $grafico->GraficoxSucursal();

$data = array();
foreach ($reg as $row) {
	$data[] = $row;
}

echo json_encode($data);

endif;



?>