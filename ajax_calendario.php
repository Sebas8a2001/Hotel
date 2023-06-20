<?php
session_start();
error_reporting(-1);
require_once("class/conexion.php");
include_once('class/funciones_basicas.php');

$db = db_connect();

function fecha ($valor)
{
	$timer = explode(" ",$valor);
	$fecha = explode("-",$timer[0]);
	$fechex = $fecha[2]."/".$fecha[1]."/".$fecha[0];
	return $fechex;
}

function buscar_en_array($fecha,$array)
{
	$total_eventos=count($array);
	for($e=0;$e<$total_eventos;$e++)
	{
		if ($array[$e]["fecha"]==$fecha) return true;
	}
}

switch ($_GET["accion"])
{
	
	case "generar_calendario":
	{
		$fecha_calendario=array();
		//if ($_GET["mes"]=="" || $_GET["anio"]=="")
		if (empty($_GET["mes"]) or empty($_GET["anio"])) 
		{
			$fecha_calendario[1]=intval(date("m"));
			if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
			$fecha_calendario[0]=date("Y");
		} 
		else 
		{
			$fecha_calendario[1]=intval($_GET["mes"]);
			if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
			else $fecha_calendario[1]=$fecha_calendario[1];
			$fecha_calendario[0]=$_GET["anio"];
		}
		$fecha_calendario[2]="01";
		
		/* obtenemos el dia de la semana del 1 del mes actual */
		$primeromes=date("N",mktime(0,0,0,$fecha_calendario[1],1,$fecha_calendario[0]));
			
		/* comprobamos si el año es bisiesto y creamos array de días */
		if (($fecha_calendario[0] % 4 == 0) && (($fecha_calendario[0] % 100 != 0) || ($fecha_calendario[0] % 400 == 0))) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
		else $dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");
		
		$eventos=array();
		$query=$db->query("select desde, hasta from detallereservaciones where codhabitacion = '".decrypt($_GET["codigo"])."'");

		while($fila=$query->fetch_array())
			{ 
				$eventos[]= array('desde' => $fila["desde"], 'hasta' => $fila["hasta"]);
			}
	
		$meses=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
		
		/* calculamos los días de la semana anterior al día 1 del mes en curso */
		$diasantes=$primeromes-1;
			
		/* los días totales de la tabla siempre serán máximo 42 (7 días x 6 filas máximo) */
		$diasdespues=42;
			
		/* calculamos las filas de la tabla */
		$tope=$dias[intval($fecha_calendario[1])]+$diasantes;
		if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
		else $totalfilas=intval(($tope/7));
			
		
		$mesanterior=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]-1,01,$fecha_calendario[0]));
		$messiguiente=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]+1,01,$fecha_calendario[0]));
	
		echo "<h4 class='portlet-title text-dark text-uppercase'>
		<div align='left'>
		<a rel='$mesanterior' class='anterior'><div class='btn-group m-b-10'><button type='button' class='btn btn-default waves-effect'><i class='fa fa-chevron-left'></i><span></button></a>
		<a class='siguiente' rel='$messiguiente'><button type='button' class='btn btn-default waves-effect'><i class='fa fa-chevron-right'></i></button></a>
		<a class='actual' rel='$messiguiente'><button type='button' onclick='generar_calendario()' class='btn btn-default waves-effect'><label><strong>HOY</strong></label></button></a>
		</div>&nbsp;&nbsp;&nbsp;<strong>".$meses[intval($fecha_calendario[1])]." ".$fecha_calendario[0]." </strong></h4> ";
		
		if (isset($mostrar)) echo $mostrar;
			
		echo "<table class='calendario' cellspacing='0' cellpadding='0'>";
		echo "<tr><th>Lun</th><th>Mar</th><th>Mi&eacute;</th><th>Jue</th><th>Vie</th><th>S&aacute;b</th><th>Dom</th></tr><tr>";
			
			/* inicializamos filas de la tabla */
			$tr=0;
			$dia=1;
			
			function es_finde($fecha)
			{
				$cortamos=explode("-",$fecha);
				$dia=$cortamos[2];
				$mes=$cortamos[1];
				$ano=$cortamos[0];
				$fue=date("w",mktime(0,0,0,$mes,$dia,$ano));
				if (intval($fue)==0 || intval($fue)==6) return true;
				else return false;
			}
			
			for ($i=1;$i<=$diasdespues;$i++)
			{
				if ($tr<$totalfilas)
				{
					if ($i>=$primeromes && $i<=$tope) 
					{
						echo "<td class='";
						/* creamos fecha completa */
						if ($dia<10) $dia_actual="0".$dia; else $dia_actual=$dia;
						$fecha_completa=$fecha_calendario[0]."-".$fecha_calendario[1]."-".$dia_actual;
						
						foreach ($eventos as $evento) {
							$evento_desde = date_create($evento['desde']);
							$evento_hasta = date_create($evento['hasta']);
							$fecha_completa_v = date_create($fecha_completa);
							if ($fecha_completa_v >= $evento_desde && $fecha_completa_v <= $evento_hasta) {
								$hayevento = TRUE;
								break;
							} else { 
								$hayevento = FALSE;
								//break;
							}
						}
						
						/*if (intval($eventos[$fecha_completa])>0) 
						{
							echo "evento";
							$hayevento=$eventos[$fecha_completa];
						}
						else $hayevento=0;*/

						//$hayevento=$fecha_completa;

						/* si es hoy coloreamos la celda */
						if (date("Y-m-d")==$fecha_completa) echo " hoy";
						
						echo "'>";
						
						//if (@$hayevento === TRUE) echo "<span class='label label-success'>".$dia."</span>";
						if (!isset($hayevento)) echo "$dia";

						elseif ($hayevento === TRUE) echo "<span class='label label-success'>".$dia."</span>";

						else echo "$dia";
						
						echo "</td>";
						$dia+=1;
					}
					else echo "<td class='desactivada'>&nbsp;</td>";
					if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$tr+=1;}
				}
			}
			echo "</table>";
		break;
	}
}
?>