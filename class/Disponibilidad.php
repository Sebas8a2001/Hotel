<?php

class Disponibilidad extends Db
{
    public $hasta_r;
    public $desde_r;
    public $adultos;
    public $children;
    public $habitaciones;

	public function __construct()
	{
		parent::__construct();
	} 	

    public function BuscarHabitaciones() 
    {
        self::SetNames();	
        $sql = "SELECT * FROM habitaciones 
        INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
        INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo
        WHERE habitaciones.codhabitacion NOT IN (SELECT codhabitacion FROM detallereservaciones WHERE '{$this->hasta_r}' >= DATE_FORMAT(desde,'%d-%m-%Y') AND '{$this->desde_r}' <= DATE_FORMAT(hasta,'%d-%m-%Y')) ORDER BY habitaciones.codhabitacion ASC";
        
        $stmt = $this->dbh->prepare($sql);
        /* $stmt->bindValue(1, trim($this->adultos));
        $stmt->bindValue(2, trim($this->children)); */
        $stmt->execute();

        $num = $stmt->rowCount();
        if($num==0)	{
            return false;
            }
        else
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->p[]=$row;
            }
            $combinaciones = $this->distribuir_huespedes($this->p, $this->desde_r, $this->hasta_r, $this->adultos, $this->children, $this->habitaciones);
            
            foreach ($combinaciones as &$combinacion){
                foreach ($combinacion as &$data){
                    $sql = "SELECT comodidad.* FROM habitacion_comodidad 
                            LEFT JOIN comodidad ON habitacion_comodidad.comodidad_id = comodidad.id
                            WHERE habitacion_id = '{$data['id']}'";
                    $rst = $this->dbh->prepare($sql);
                    $rst->execute();
                    $num = $rst->rowCount();    

                    
                    if($num>0)	{
                        while($row = $rst->fetch(PDO::FETCH_ASSOC))
                        {
                            $data['comodidades'][]=$row;
                        }
                    }

                }
                
            }
            return $combinaciones;
            //return $this->eliminarDuplicados($combinaciones);
        }
    }

    private function eliminarDuplicados($array) {
        //obterner solamente los tipos de hbitación del arreglo

        /* $tipos_habitacion = array_map(function($habitacion) {
            return $habitacion['codtipo'];
        }, $array);

        //eliminar duplicados
        $tipos_habitacion = $this->array_unique($tipos_habitacion);

        $result = array();
        foreach ($array as $element) {
            if (!in_array($element, $result)) {
                array_push($result, $element);
            }
        }
        return $result; */
    }

    private function distribuir_huespedes($habitaciones_disponibles, $fecha_inicio, $fecha_fin, $num_adultos, $num_ninos, $num_habitaciones) {
        $combinaciones = array();
        if ($num_habitaciones == 1){
            $habitaciones_filtradas = array_filter($habitaciones_disponibles, function($habitacion) use ($num_adultos, $num_ninos) {
                return $habitacion['maxadultos'] >= $num_adultos && $habitacion['maxninos'] >= $num_ninos;
            });
        }
        else{
            $habitaciones_filtradas = array_filter($habitaciones_disponibles, function($habitacion) use ($num_adultos, $num_ninos) {
                return $habitacion['maxadultos'] <= $num_adultos && $habitacion['maxninos'] <= $num_ninos;
            });
        }
        
        $habitaciones_filtradas = array_values($habitaciones_filtradas);
        $num_habitaciones_disponibles = count($habitaciones_filtradas);
        
        $indices = range(0, $num_habitaciones_disponibles - 1);
        $combinaciones_indices = iterator_to_array($this->combinaciones($indices, $num_habitaciones));
        
        foreach ($combinaciones_indices as $combinacion_indices) {
            $combinacion_habitaciones = array();
            $num_adultos_restantes = $num_adultos;
            $num_ninos_restantes = $num_ninos;
            
            foreach ($combinacion_indices as $indice) {
                $habitacion = $habitaciones_filtradas[$indice];
                $max_adultos = $habitacion['maxadultos'];
                $max_ninos = $habitacion['maxninos'];
                
                $num_adultos_habitacion = min($num_adultos_restantes, $max_adultos);
                $num_ninos_habitacion = min($num_ninos_restantes, $max_ninos);
                
                $combinacion_habitaciones[] = array(
                    'id' => $habitacion['idhabitacion'],
                    'codhabitacion' => $habitacion['codhabitacion'],
                    'num_adultos' => $num_adultos_habitacion,
                    'num_ninos' => $num_ninos_habitacion,
                    'nomtipo' => $habitacion['nomtipo'],
                    'descriphabitacion' => $habitacion['descriphabitacion'],
                    'codtipo' => $habitacion['codtipo']
                );
                
                $num_adultos_restantes -= $num_adultos_habitacion;
                $num_ninos_restantes -= $num_ninos_habitacion;
            }
            
            if ($num_adultos_restantes == 0 && $num_ninos_restantes == 0) {
                $combinaciones[] = $combinacion_habitaciones;
            }
        }
        
        return $combinaciones;
    }

    function combinaciones($arr, $length) {
        if ($length == 1) {
            foreach ($arr as $val) {
                yield array($val);
            }
        } else {
            $count = count($arr);
            
            for ($i = 0; $i < $count; $i++) {
                $val = $arr[$i];
                
                $sub_arr = array_slice($arr, $i + 1);
                $sub_combinations = $this->combinaciones($sub_arr, $length - 1);
                
                foreach ($sub_combinations as $sub_combination) {
                    array_unshift($sub_combination, $val);
                    yield $sub_combination;
                }
            }
        }
    }
}