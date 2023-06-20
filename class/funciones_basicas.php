<?php 
## funcion para prevenir ataques XSS
function limpiar($tags){
$tags = strip_tags($tags);
$tags = stripslashes($tags);
$tags = htmlentities($tags);
return $tags;
//return htmlspecialchars($tags);
}

function portales($cadena)
  {
  $cadena = str_replace ("&aacute;", chr(225), $cadena);
  $cadena = str_replace ("&eacute;", chr(233), $cadena);
  $cadena = str_replace ("&iacute;", chr(237), $cadena);
  $cadena = str_replace ("&oacute;", chr(243), $cadena);
  $cadena = str_replace ("&uacute;", chr(250), $cadena);
  $cadena = str_replace ("&Aacute;", chr(193), $cadena);
  $cadena = str_replace ("&Eacute;", chr(201), $cadena);
  $cadena = str_replace ("&Iacute;", chr(205), $cadena);
  $cadena = str_replace ("&Oacute;", chr(211), $cadena);
  $cadena = str_replace ("&Uacute;", chr(218), $cadena);  
  $cadena = str_replace ("&ntilde;", chr(241), $cadena);    
  $cadena = str_replace ("&Ntilde;", chr(209), $cadena);      
  $cadena = str_replace ("&ldquo;", "\"", $cadena);      
  $cadena = str_replace ("&rdquo;", "\"", $cadena);        
  $cadena = str_replace ("&Ntilde;", chr(209), $cadena);      
  $cadena = str_replace ("&Ntilde;", chr(209), $cadena);      
  $cadena = str_replace ("&nbsp;", "<br /><br />", $cadena);  
  
  return $cadena;
}  

function SubirArchivo ($sfArchivo){
        $dir_subida = 'fotos/';
        $fichero_subido = $dir_subida . basename($_FILES[$sfArchivo]['name']);
        if (move_uploaded_file($_FILES[$sfArchivo]['tmp_name'], $fichero_subido)) {
            return $fichero_subido;
        } else {
            return "";
        }
    }



function eliminarRepetidos($array)
{
    $nuevoArray=Array();
    # bucle recorriendo todo el array
    for($i=0;$i<count($array);$i++)
    {
        $repetido=false;
        # por cada posicion que recorremos, revisamos que no este
        # ya en el array de valores, reviando desde el primer elemento
        # hasta el que estamos revisando
        for($j=0;$j<$i;$j++)
        {
            if($array[$i]==$array[$j])

                $repetido=true;
        }
        if(!$repetido)

            $nuevoArray[]=$array[$i];
    }
    return $nuevoArray;
}

function deleteFromArray(&$array, $deleteIt, $useOldKeys = FALSE)

{

    $key = array_search($deleteIt,$array,TRUE);

    if($key === FALSE)

        return FALSE;

    unset($array[$key]);

    if(!$useOldKeys)

        $array = array_values($array);

    return TRUE;

}


function ceros($cadena)
{
    if( preg_match("/0([^0])/", $cadena, $match) ) {
        return strpos($cadena, $match[1]);
    } else {
        return 0;
    }
} 

#####CONTRASEÑA DE-ENCRIPTAR
function encrypt($string, $key="@ClaveEncriptadaWebMasterChirinos@") {
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
    }
    $result=base64_encode($result);
    $result = str_replace(array('+','/','='),array('-','_','.'),$result);
    return $result;
}

function decrypt($string, $key="@ClaveEncriptadaWebMasterChirinos@") {
    $string = str_replace(array('-','_','.'),array('+','/','='),$string);
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
       $char = substr($string, $i, 1);
       $keychar = substr($key, ($i % strlen($key))-1, 1);
       $char = chr(ord($char)-ord($keychar));
    $result.=$char;
    }
    return $result;
}



function limpiarEntrada($texto) {
 
 	//creamos un arreglo que sirva de patrones para eliminar partes no deseadas en las cadenas
	$busqueda = array(
	'@<script[^>]*?>.*?</script>@si',   // quitar javascript
	'@<[\/\!]*?[^<>]*?>@si',            // quitar tags de HTML
	'@<style[^>]*?>.*?</style>@siU',    // quitar estilos
	'@<![\s\S]*?--[ \t\n\r]*>@'         // quitar comentarios multilínea
	);
 
 	//utilizamos la función preg_replace que busca en una cadena patrones para sustituir
    $salida = preg_replace($busqueda, '', $texto);
    //devolvemos la cadena sin los patrones encontrados
    return $salida;
}


function edad($fecha_nac){
//Esta funcion toma una fecha de nacimiento 
//desde una base de datos mysql
//en formato aaaa/mm/dd y calcula la edad en numeros enteros

$dia=date("j");
$mes=date("n");
$anno=date("Y");

//descomponer fecha de nacimiento
$dia_nac=substr($fecha_nac, 8, 2);
$mes_nac=substr($fecha_nac, 5, 2);
$anno_nac=substr($fecha_nac, 0, 4);


if($mes_nac>$mes){
$calc_edad= $anno-$anno_nac-1;
}else{
if($mes==$mes_nac AND $dia_nac>$dia){
$calc_edad= $anno-$anno_nac-1; 
}else{
$calc_edad= $anno-$anno_nac;
}
}
return $calc_edad;
} 



	function estado($muestra) {

    if($muestra == "administrador") {
    echo "ADMINISTRADOR(A)";
    } elseif ($muestra == "secretaria") {
    echo "SECRETARIA";
    } elseif ($muestra == "recepcionista") {
    echo "RECEPCIONISTA";
    } elseif ($muestra == "cliente") {
    echo "CLIENTE";
    } 
    }

function convertir($string)
{
       $string = str_replace(
       array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
       array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', ' DIC'),
       //array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', ' DICIEMBRE'),
       $string
   );        
   return $string;
}

######## INICIO FUNCION CONVERTIR MESES PARA REPORTE PAGOS POR FECHA

function convertir2($string)
{
       $string = str_replace(
       array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
       array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', ' DIC'),
       $string
   );        
   return $string;
}

######## FIN FUNCION CONVERTIR MESES PARA REPORTE PAGOS POR FECHA

function nombremes($mes){
 setlocale(LC_TIME, 'es_ES');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return $nombre;
} 
	

    
function generar_clave($longitud){ 
           $cadena="[^A-Z0-9]"; 
           return substr(preg_replace($cadena, "", sha1(md5(rand()))) . 
           preg_replace($cadena, "", sha1(md5(rand()))) . 
           preg_replace($cadena, "", sha1(md5(rand()))), 
           0, $longitud); 
    }

//Método con rand()
function GenerateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 

function GenerateRandomStringg($length = 49) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 

//Método con str_shuffle() 
function generateRandomString2($length = 50) { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
}



function random_string($length) {
    switch(true) {
        case function_exists('mcrypt_create_iv') :
            $r = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        break;
        case function_exists('openssl_random_pseudo_bytes') :
            $r = openssl_random_pseudo_bytes($length);
        break;
        case is_readable('/dev/urandom') : // deceze
            $r = file_get_contents('/dev/urandom', false, null, 0, $length);
        break;
        default :
            $i = 0;
            $r = '';
            while($i ++ < $length) {
                $r .= chr(mt_rand(0, 255));
            }
        break;
    }
    return substr(bin2hex($r), 0, $length);
}


function formatear($valor)
{
    $a = explode(".",$valor);
    $b = substr($a[1],0,2);
    $numero = $a[0].".".$b;
    
    return $numero;
}

function formatear2($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos, '.', '.');

}

function rount($number, $digitos)
{
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos, '.', '');

}

function removeEmptyElements(&$element)
{
    if (is_array($element)) {
        if ($key = key($element)) {
            $element[$key] = array_filter($element);
        }

        if (count($element) != count($element, COUNT_RECURSIVE)) {
            $element = array_filter(current($element), __FUNCTION__);
        }

        $element = array_filter($element);

        return $element;
    } else {
        return empty($element) ? false : $element;
    }
}

########### CALCULAR DIAS TRANSCURRIDOS ENTRE DOS FECHAS CONTANDO PURO DIAS HABILES #########
function fechas($start, $end) {
    $range = array();

    if (is_string($start) === true) $start = strtotime($start);
    if (is_string($end) === true ) $end = strtotime($end);

    if ($start > $end) return createDateRangeArray($end, $start);

    do {
        $range[] = date('Y-m-d', $start);
        $start = strtotime("+ 1 day", $start);
    } while($start <= $end);

    return $range;
}

########### CALCULAR DIAS TRANSCURRIDOS ENTRE DOS FECHAS #########
function Dias_Transcurridos($fecha_i,$fecha_f)
{
    $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias   = abs($dias); 
    $dias = floor($dias);       
    return $dias;
}

########### CACLULAR DIAS DE RETRASO ENTRE DOS FECHAS #########
function atraso($fecha)
{
    return floor((time()-strtotime($fecha)) / (60 * 60 * 24 ));
}

function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO SOLES CON $xdecimales/100";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN SOL CON $xdecimales/100";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " SOLES CON $xdecimales/100"; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

function getSubString($string, $length=NULL)
{
    //Si no se especifica la longitud por defecto es 50
    if ($length == NULL)
        $length = 40;
    //Primero eliminamos las etiquetas html y luego cortamos el string
    $stringDisplay = substr(strip_tags($string), 0, $length);
    //Si el texto es mayor que la longitud se agrega puntos suspensivos
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= '...';
    return $stringDisplay;
}

/* 
 *El uso de funciones es más elegante y práctico, 
 *sobre todo si necesitas llamarlas desde varias partes de tu código
 *La función evalúa cada número ($x) de $array y si éste es menor que 0
 *incrementa un contador $i en 1 cada vez. Al final devuelve el total del contador
 */
function get_negativosfor($array) { 
         $i = 0; foreach ($array as $x) 
                    if ($x < 0) $i++; 
         return $i; 
    }

    

//Funcion muestra nombre de paises
function paises($pais) {

    if($pais == 'AF') {
    echo "AFGANISTAN";
    } elseif ($pais == 'AL') {
    echo "ALBANIA"; 
    } elseif ($pais == 'DE') {
    echo "ALEMANIA";    
    } elseif ($pais == 'AD') {
    echo "ANDORRA"; 
    } elseif ($pais == 'AO') {
    echo "ANGOLA";  
    } elseif ($pais == 'AI') {
    echo "ANGUILLA";    
    } elseif ($pais == 'AQ') {
    echo "ANTARTIDA";   
    } elseif ($pais == 'AG') {
    echo "ANTIGUA Y BARBUDA";   
    } elseif ($pais == 'AN') {
    echo "NTILLAS HOLANDESAS";  
    } elseif ($pais == 'SA') {
    echo "ARABAIA SAUDI";   
    } elseif ($pais == 'DZ') {
    echo "ARGELIA"; 
    } elseif ($pais == 'AR') {
    echo "ARGENTINA";   
    } elseif ($pais == 'AM') {
    echo "ARMENIA"; 
    } elseif ($pais == 'AW') {
    echo "ArRUBA";  
    } elseif ($pais == 'AU') {
    echo "AUSTRALIA";   
    } elseif ($pais == 'AT') {
    echo "AUSTRIA"; 
    } elseif ($pais == 'AZ') {
    echo "AZERBAIYAN";  
    } elseif ($pais == 'BS') {
    echo "BAHAMAS"; 
    } elseif ($pais == 'BH') {
    echo "BAHREIN"; 
    } elseif ($pais == 'BD') {
    echo "BANGLADESH";  
    } elseif ($pais == 'BB') {
    echo "BARBADOS";    
    } elseif ($pais == 'BE') {
    echo "BELGICA"; 
    } elseif ($pais == 'BZ') {
    echo "BELICE";  
    } elseif ($pais == 'BJ') {
    echo "BENIN";   
    } elseif ($pais == 'BM') {
    echo "BERMUDAS";    
    } elseif ($pais == 'BY') {
    echo "BIELORRUSIA"; 
    } elseif ($pais == 'MM') {
    echo "BIRMANIA";    
    } elseif ($pais == 'BO') {
    echo "BOLIVIA"; 
    } elseif ($pais == 'BA') {
    echo "BOSNIA Y HERZEGOVINA";    
    } elseif ($pais == 'BW') {
    echo "BOTSWANA";    
    } elseif ($pais == 'BR') {
    echo "BRASIL";  
    } elseif ($pais == 'BN') {
    echo "BRUNEI";  
    } elseif ($pais == 'BG') {
    echo "BULGARIA";    
    } elseif ($pais == 'BF') {
    echo "BURKINA FASO";    
    } elseif ($pais == 'BI') {
    echo "BURUNDI"; 
    } elseif ($pais == 'BT') {
    echo "BUTAN";   
    } elseif ($pais == 'CV') {
    echo "CABO VERDE";  
    } elseif ($pais == 'KH') {
    echo "CAMBOYA"; 
    } elseif ($pais == 'CM') {
    echo "CAMERUN"; 
    } elseif ($pais == 'CA') {
    echo "CANADA";  
    } elseif ($pais == 'TD') {
    echo "CHAD";    
    } elseif ($pais == 'CL') {
    echo "CHILE";   
    } elseif ($pais == 'CN') {
    echo "CHINA";   
    } elseif ($pais == 'CY') {
    echo "CHIPRE";  
    } elseif ($pais == 'VA') {
    echo "CIUDAD DEL VATICANO (SANTA SEDE)";    
    } elseif ($pais == 'CO') {
    echo "COLOMBIA";    
    } elseif ($pais == 'CG') {
    echo "CONGO";   
    } elseif ($pais == 'CD') {
    echo "REPUBLICA DEMOCRATICA DEL CONGO"; 
    } elseif ($pais == 'KR') {
    echo "COREA";   
    } elseif ($pais == 'KP') {
    echo "COREA DEL NORTE"; 
    } elseif ($pais == 'CI') {
    echo "COSTA DE MARFIL"; 
    } elseif ($pais == 'CR') {
    echo "COSTA RICA";  
    } elseif ($pais == 'HR') {
    echo "CROACIA"; 
    } elseif ($pais == 'CU') {
    echo "CUBA";    
    } elseif ($pais == 'DK') {
    echo "DINAMARCA";   
    } elseif ($pais == 'DJ') {
    echo "DJIBOUTI";    
    } elseif ($pais == 'DM') {
    echo "DOMINICA";    
    } elseif ($pais == 'EC') {
    echo "ECUADOR"; 
    } elseif ($pais == 'EG') {
    echo "EGIPTO";  
    } elseif ($pais == 'SV') {
    echo "EL SALVADOR"; 
    } elseif ($pais == 'AE') {
    echo "EMIRATOS ARABES UNIDOS";  
    } elseif ($pais == 'ER') {
    echo "ERITREA"; 
    } elseif ($pais == 'SI') {
    echo "ESLOVENIA";   
    } elseif ($pais == 'ES') {
    echo "ESPANA";  
    } elseif ($pais == 'US') {
    echo "ESTADOS UNIDOS";  
    } elseif ($pais == 'EE') {
    echo "ESTONIA"; 
    } elseif ($pais == 'ET') {
    echo "ETIOPIA"; 
    } elseif ($pais == 'FJ') {
    echo "FIJI";    
    } elseif ($pais == 'PH') {
    echo "FILIPINAS";   
    } elseif ($pais == 'FI') {
    echo "FINLANDIA";   
    } elseif ($pais == 'FR') {
    echo "FRANCIA"; 
    } elseif ($pais == 'GA') {
    echo "GABON";   
    } elseif ($pais == 'GM') {
    echo "GAMBIA";  
    } elseif ($pais == 'GE') {
    echo "GEORGIA"; 
    } elseif ($pais == 'GH') {
    echo "GHANA";   
    } elseif ($pais == 'GI') {
    echo "GIBRALTAR";   
    } elseif ($pais == 'GD') {
    echo "GRANADA"; 
    } elseif ($pais == 'GR') {
    echo "GRECIA";  
    } elseif ($pais == 'GL') {
    echo "GROENLANDIA"; 
    } elseif ($pais == 'GP') {
    echo "GUADALUPE";   
    } elseif ($pais == 'GU') {
    echo "GUAM";    
    } elseif ($pais == 'GT') {
    echo "GUATEMALA";   
    } elseif ($pais == 'GY') {
    echo "GUAYANA"; 
    } elseif ($pais == 'GF') {
    echo "GUAYANA FRANCESA";    
    } elseif ($pais == 'GN') {
    echo "GUINEA";  
    } elseif ($pais == 'GQ') {
    echo "GUINEA ECUATORIAL";   
    } elseif ($pais == 'GW') {
    echo "GUINEA-BISSAU";   
    } elseif ($pais == 'HT') {
    echo "HAITI";   
    } elseif ($pais == 'HN') {
    echo "HONDURAS";    
    } elseif ($pais == 'HU') {
    echo "HUNGRIA"; 
    } elseif ($pais == 'IN') {
    echo "INDIA";   
    } elseif ($pais == 'ID') {
    echo "INDONSEIA";   
    } elseif ($pais == 'IQ') {
    echo "IRAK";    
    } elseif ($pais == 'IR') {
    echo "IRAN";    
    } elseif ($pais == 'IE') {
    echo "IRLANDA"; 
    } elseif ($pais == 'BV') {
    echo "ISLA BOUVET"; 
    } elseif ($pais == 'CX') {
    echo "ISLA DE CHRISTMAS";   
    } elseif ($pais == 'IS') {
    echo "ISLANDIA";    
    } elseif ($pais == 'KY') {
    echo "ISLAS CAIMAN";    
    } elseif ($pais == 'CK') {
    echo "ISLAS COOK";  
    } elseif ($pais == 'CC') {
    echo "ISLAS DE COCOS O KEELING";    
    } elseif ($pais == 'FO') {
    echo "ISLAS FAROE"; 
    } elseif ($pais == 'HM') {
    echo "ISLAS HEARD Y MCDONALD";  
    } elseif ($pais == 'FK') {
    echo "ISLAS MALVINAS";  
    } elseif ($pais == 'MP') {
    echo "ISLAS MARIANAS DEL NORTE";    
    } elseif ($pais == 'MH') {
    echo "ISLAS MARSHALL";  
    } elseif ($pais == 'UM') {
    echo "ISLAS MENORES DE EE.UU."; 
    } elseif ($pais == 'PW') {
    echo "ISLAS PALAU"; 
    } elseif ($pais == 'SB') {
    echo "ISLAS SALOMON";   
    } elseif ($pais == 'SJ') {
    echo "ISLAS SVALBARD Y JAN MAYEN";  
    } elseif ($pais == 'TK') {
    echo "ISLAS TOKELAU";   
    } elseif ($pais == 'TC') {
    echo "ISLAS TURKS Y CAICOS";    
    } elseif ($pais == 'VI') {
    echo "ISLAS VIRGENES (EE.UU.)"; 
    } elseif ($pais == 'VG') {
    echo "ISLAS VIRGENES (REINO UNIDO)";    
    } elseif ($pais == 'WF') {
    echo "ISLAS WALLSI Y FUTUNA";   
    } elseif ($pais == 'IL') {
    echo "ISRAEL";  
    } elseif ($pais == 'IT') {
    echo "ITALIA";  
    } elseif ($pais == 'JM') {
    echo "JAMAICA"; 
    } elseif ($pais == 'JP') {
    echo "JAPON";   
    } elseif ($pais == 'JO') {
    echo "JORDANIA";    
    } elseif ($pais == 'KZ') {
    echo "KAZAJISTAN";  
    } elseif ($pais == 'KE') {
    echo "KENIA";   
    } elseif ($pais == 'KG') {
    echo "KIRGUIZISTAN";    
    } elseif ($pais == 'KI') {
    echo "KIRIBATI";    
    } elseif ($pais == 'KW') {
    echo "KUWAIT";  
    } elseif ($pais == 'LA') {
    echo "LAOS";    
    } elseif ($pais == 'LS') {
    echo "LESOTHO"; 
    } elseif ($pais == 'LV') {
    echo "LETONIA"; 
    } elseif ($pais == 'LB') {
    echo "LIBANO";  
    } elseif ($pais == 'LR') {
    echo "LIBERIA"; 
    } elseif ($pais == 'LY') {
    echo "LIBIA";   
    } elseif ($pais == 'LI') {
    echo "LIECHTENSTEIN";   
    } elseif ($pais == 'LT') {
    echo "LITUANIA";    
    } elseif ($pais == 'LU') {
    echo "LUXEMBURGO";  
    } elseif ($pais == 'MK') {
    echo "EX REPUBLICA YUGOSLAVA DE MACEDONIA"; 
    } elseif ($pais == 'MG') {
    echo "MADAGASCAR";  
    } elseif ($pais == 'MY') {
    echo "MALASIA"; 
    } elseif ($pais == 'MW') {
    echo "MALAWI";  
    } elseif ($pais == 'MV') {
    echo "MALDIVAS";    
    } elseif ($pais == 'ML') {
    echo "MALI";    
    } elseif ($pais == 'MT') {
    echo "MALTA";   
    } elseif ($pais == 'MA') {
    echo "MARRUECOS";   
    } elseif ($pais == 'MQ') {
    echo "MARTINICA";   
    } elseif ($pais == 'MU') {
    echo "MAURICIO";    
    } elseif ($pais == 'MR') {
    echo "MAURITANIA";  
    } elseif ($pais == 'YT') {
    echo "MAYOTTE"; 
    } elseif ($pais == 'MX') {
    echo "MEXICO";  
    } elseif ($pais == 'FM') {
    echo "MICRONESIA";  
    } elseif ($pais == 'MD') {
    echo "MOLDAVIA";    
    } elseif ($pais == 'MC') {
    echo "MONACO";  
    } elseif ($pais == 'MN') {
    echo "MONGOLIA";    
    } elseif ($pais == 'MS') {
    echo "MONTSERRAT";  
    } elseif ($pais == 'MZ') {
    echo "MOZAMBIQUE";  
    } elseif ($pais == 'NA') {
    echo "NAMIBIA"; 
    } elseif ($pais == 'NR') {
    echo "NAURU";   
    } elseif ($pais == 'NP') {
    echo "NEPAL";   
    } elseif ($pais == 'NI') {
    echo "NICARAGUA";   
    } elseif ($pais == 'NE') {
    echo "NIGER";   
    } elseif ($pais == 'NG') {
    echo "NIGERIA"; 
    } elseif ($pais == 'NU') {
    echo "NIUE";    
    } elseif ($pais == 'NF') {
    echo "NORFOLK"; 
    } elseif ($pais == 'NO') {
    echo "NORUEGA"; 
    } elseif ($pais == 'NC') {
    echo "NUEVA CALEDONIA"; 
    } elseif ($pais == 'NZ') {
    echo "NUEVA ZELANDA";   
    } elseif ($pais == 'OM') {
    echo "OMAN";    
    } elseif ($pais == 'NL') {
    echo "PAISES BAJOS";    
    } elseif ($pais == 'PA') {
    echo "PANAMA";  
    } elseif ($pais == 'PG') {
    echo "PAPUA NUEVA GUINEA";  
    } elseif ($pais == 'PK') {
    echo "PAQUISTAN";   
    } elseif ($pais == 'PY') {
    echo "PARAGUAY";    
    } elseif ($pais == 'PE') {
    echo "PERU";    
    } elseif ($pais == 'PN') {
    echo "PITCAIRN";    
    } elseif ($pais == 'PF') {
    echo "POLINESIA FRANCESA";  
    } elseif ($pais == 'PL') {
    echo "POLONIA"; 
    } elseif ($pais == 'PT') {
    echo "PORTUGAL";    
    } elseif ($pais == 'PR') {
    echo "PUERTO RICO"; 
    } elseif ($pais == 'QA') {
    echo "QATAR";   
    } elseif ($pais == 'UK') {
    echo "REINO UNIDO"; 
    } elseif ($pais == 'CF') {
    echo "REPUBLICA CENTROAFRICANA";    
    } elseif ($pais == 'CZ') {
    echo "REPUBLICA CHECA"; 
    } elseif ($pais == 'ZA') {
    echo "REPUBLICA DE SUDAFRICA";  
    } elseif ($pais == 'DO') {
    echo "REPUBLICA DOMINICANA";    
    } elseif ($pais == 'SK') {
    echo "REPUBLICA ESLOVACA";  
    } elseif ($pais == 'RE') {
    echo "REUNION"; 
    } elseif ($pais == 'RW') {
    echo "RUANDA";  
    } elseif ($pais == 'RO') {
    echo "RUMANIA"; 
    } elseif ($pais == 'RU') {
    echo "RUSIA";   
    } elseif ($pais == 'EH') {
    echo "SAHARA OCCIDENTAL";   
    } elseif ($pais == 'KN') {
    echo "SAINT KITTS Y NEVIS"; 
    } elseif ($pais == 'WS') {
    echo "SAMOA";   
    } elseif ($pais == 'AS') {
    echo "SAMOA AMERICANA"; 
    } elseif ($pais == 'SM') {
    echo "SAN MARINO";  
    } elseif ($pais == 'VC') {
    echo "SAN VICENTE Y GRANADINAS";    
    } elseif ($pais == 'SH') {
    echo "SANTA HELENA";    
    } elseif ($pais == 'LC') {
    echo "SANTA LUCIA"; 
    } elseif ($pais == 'ST') {
    echo "SANTO TOME Y PRINCIPE";   
    } elseif ($pais == 'SN') {
    echo "SENEGAL"; 
    } elseif ($pais == 'SC') {
    echo "SEYCHELLES";  
    } elseif ($pais == 'SL') {
    echo "SIERRA LEONA";    
    } elseif ($pais == 'SG') {
    echo "SINGAPUR";    
    } elseif ($pais == 'SY') {
    echo "SIRIA";   
    } elseif ($pais == 'SO') {
    echo "SOMALIA"; 
    } elseif ($pais == 'LK') {
    echo "SRI LANKA";   
    } elseif ($pais == 'PM') {
    echo "ST. PIERRE Y MIQUELON";   
    } elseif ($pais == 'SZ') {
    echo "SUAZILANDIA"; 
    } elseif ($pais == 'SD') {
    echo "SUDAN";   
    } elseif ($pais == 'SE') {
    echo "SUECIA";  
    } elseif ($pais == 'CH') {
    echo "SUIZA";   
    } elseif ($pais == 'SR') {
    echo "SURINAM"; 
    } elseif ($pais == 'TH') {
    echo "TAILANDIA";   
    } elseif ($pais == 'TW') {
    echo "TAIWAN";  
    } elseif ($pais == 'TZ') {
    echo "TANZANIA";    
    } elseif ($pais == 'TJ') {
    echo "TAYIKISTAN";  
    } elseif ($pais == 'TF') {
    echo "TERRITORIOS FRANCESES DEL SUR";   
    } elseif ($pais == 'TP') {
    echo "TIMOR ORIENTAL";  
    } elseif ($pais == 'TG') {
    echo "TOGO";    
    } elseif ($pais == 'TO') {
    echo "TONGA";   
    } elseif ($pais == 'TT') {
    echo "TRINIDAD Y TOBAGO";   
    } elseif ($pais == 'TN') {
    echo "TUNEZ";   
    } elseif ($pais == 'TM') {
    echo "TURKMENISTAN";    
    } elseif ($pais == 'TR') {
    echo "TURQUIA"; 
    } elseif ($pais == 'TV') {
    echo "TUVALU";  
    } elseif ($pais == 'UA') {
    echo "UCRANIA"; 
    } elseif ($pais == 'UG') {
    echo "UGANDA";  
    } elseif ($pais == 'UY') {
    echo "URUGUAY"; 
    } elseif ($pais == 'UZ') {
    echo "UZBEKISTAN";  
    } elseif ($pais == 'VU') {
    echo "VANUATU"; 
    } elseif ($pais == 'VE') {
    echo "VENEZUELA";   
    } elseif ($pais == 'VN') {
    echo "VIETNAM"; 
    } elseif ($pais == 'YE') {
    echo "YEMEN";   
    } elseif ($pais == 'YU') {
    echo "YUGOSLAVIA";  
    } elseif ($pais == 'ZM') {
    echo "ZAMBIA";  
    } elseif ($pais == 'ZW') {
    echo "ZIMBABUE";    
    } 
    }
?>