<?php
//Funci�n que nos retornara una conexi�n con mysqli
function db_connect(){

    $dbhost = "localhost"; // El host
    $dbuser = "root"; // El usuario
    $dbpass = ""; // El Pass
    $db = "softhotel"; // Nombre de la base

    $mysqli = new mysqli($dbhost, $dbuser,$dbpass, $db);
    if ($mysqli -> connect_errno) {
        die( "Fallo la conexi�n a MySQL: (" . $mysqli -> mysqli_connect_errno(). ") " . $mysqli -> mysqli_connect_error());
    }
    return $mysqli;
    //Cerramos la conexi�n
    $mysqli -> mysqli_close();
}

?>

