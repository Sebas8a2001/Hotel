<?php
session_start();
require_once("classconexion.php");

class conectorDB extends Db
{
	public function __construct()
    {
        parent::__construct();
    } 	
	
	public function EjecutarSentencia($consulta, $valores = array()){  //funcion principal, ejecuta todas las consultas
		$resultado = false;
		
		if($statement = $this->dbh->prepare($consulta)){  //prepara la consulta
			if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){ //tomo los nombres de los campos iniciados con :xxxxx
				$campo = array_pop($campo); //inserto en un arreglo
				foreach($campo as $parametro){
					$statement->bindValue($parametro, $valores[substr($parametro,1)]);
				}
			}
			try {
				if (!$statement->execute()) { //si no se ejecuta la consulta...
					print_r($statement->errorInfo()); //imprimir errores
					return false;
				}
				$resultado = $statement->fetchAll(PDO::FETCH_ASSOC); //si es una consulta que devuelve valores los guarda en un arreglo.
				$statement->closeCursor();
			}
			catch(PDOException $e){
				echo "Error de ejecución: \n";
				print_r($e->getMessage());
			}	
		}
		return $resultado;
		$this->dbh = null; //cerramos la conexión
	} /// Termina funcion consultarBD
}/// Termina clase conectorDB

class Json
{
	private $json;

	public function BuscaProductoC($filtro){
    $consulta = "SELECT 
    CONCAT(productos.codproducto, ' | ',productos.producto, ' | ',categorias.nomcategoria, '') as label, productos.codproducto, productos.producto, productos.codcategoria, ROUND(productos.preciocompra, 2) preciocompra, ROUND(productos.precioventa, 2) precioventa, productos.existencia, productos.ivaproducto, ROUND(productos.descproducto, 2) descproducto, categorias.nomcategoria FROM productos INNER JOIN categorias ON productos.codcategoria=categorias.codcategoria WHERE CONCAT(codproducto, '',producto, '',nomcategoria, '',codigobarra) LIKE '%".$filtro."%' GROUP BY codproducto ASC LIMIT 0,15";
        $conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BuscaProductoV($filtro){
    $consulta = "SELECT 
    CONCAT(productos.codproducto, ' | ',productos.producto, ' | ',categorias.nomcategoria, '') as label, productos.codproducto, productos.producto, productos.codcategoria, ROUND(productos.preciocompra, 2) preciocompra, ROUND(productos.precioventa, 2) precioventa, productos.existencia, productos.ivaproducto, ROUND(productos.descproducto, 2) descproducto, categorias.nomcategoria FROM productos INNER JOIN categorias ON productos.codcategoria=categorias.codcategoria WHERE CONCAT(codproducto, '',producto, '',nomcategoria, '',codigobarra) LIKE '%".$filtro."%' GROUP BY codproducto ASC LIMIT 0,15";
        $conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BuscaInsumo($filtro){
    $consulta = "SELECT 
    CONCAT(insumos.codinsumo, ' | ',insumos.insumo, ' | ',categorias.nomcategoria, '') as label, insumos.codinsumo, insumos.insumo, insumos.codcategoria, ROUND(insumos.preciocompra, 2) preciocompra, ROUND(insumos.precioventa, 2) precioventa, insumos.existencia, insumos.stockminimo, insumos.ivainsumo, ROUND(insumos.descinsumo, 2) descinsumo, insumos.fechaexpiracion, insumos.codproveedor, categorias.nomcategoria FROM insumos INNER JOIN categorias ON insumos.codcategoria=categorias.codcategoria WHERE CONCAT(codinsumo, '',insumo, '',nomcategoria) LIKE '%".$filtro."%' GROUP BY codinsumo ASC LIMIT 0,15";
        $conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BuscaClientes($filtro){
		$consulta = "SELECT
	CONCAT(if(clientes.documcliente='0','DOCUMENTO',documentos.documento), ': ',clientes.dnicliente, ': ',clientes.nomcliente) as label,  
	clientes.codcliente, 
	clientes.nomcliente, 
	clientes.limitecredito,
	ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible
    FROM
       clientes 
     LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
     LEFT JOIN
       (SELECT
           codcliente, montocredito       
           FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
           WHERE CONCAT(clientes.dnicliente, '',clientes.nomcliente) LIKE '%".$filtro."%' 
           GROUP BY clientes.codcliente ASC LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}


  }/// TERMINA CLASE  ///
?>