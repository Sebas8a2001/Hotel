<?php
session_start();
require_once("classconexion.php");
include_once('funciones_basicas.php');
include "class.phpmailer.php";
include "class.smtp.php";
include("fngccvalidator.class.php");

// Motrar todos los errores de PHP
error_reporting(E_ALL);//muestro errores
//error_reporting(0);//desactivo errores
ini_set('display_errors', '1');

//evita el error Fatal error: Allowed memory size of X bytes exhausted (tried to allocate Y bytes)...
ini_set('memory_limit', '-1'); 
// es lo mismo que set_time_limit(300) ;
ini_set('max_execution_time', 3800); 


############################### CLASE LOGIN  ################################
class Login extends Db
{
	public function __construct()
	{
		parent::__construct();
	} 	

##################### FUNCION PARA EXPIRAR SESSION POR INACTIVIDAD ####################
public function ExpiraSession(){

	if(!isset($_SESSION['acceso'])){// Esta logeado?.
		header("Location: logout.php"); 
	}

	//Verifico el tiempo si esta seteado, caso contrario lo seteo.
	if(isset($_SESSION['time'])){
		$tiempo = $_SESSION['time'];
	} else {
		$tiempo = strtotime(date("Y-m-d h:i:s"));
	}

	$inactividad =3600; //600 equivale a 5 minutos

	$actual =  strtotime(date("Y-m-d h:i:s"));

	if( ($actual-$tiempo) >= $inactividad){ ?>					
		
	<script type='text/javascript' language='javascript'>
	alert('SU SESSION A EXPIRADO \nPOR FAVOR LOGUEESE DE NUEVO PARA ACCEDER AL SISTEMA') 
	document.location.href='logout'	 
	</script>

<?php } else {

		$_SESSION['time'] =$actual;
	} 
}
###################### FUNCION PARA EXPIRAR SESSION POR INACTIVIDAD #####################

###################### FUNCION PARA ACCEDER AL SISTEMA #######################
public function Logueo()
{
	self::SetNames();
	if(empty($_POST["usuario"]) or empty($_POST["password"]))
	{
		echo "1";
		exit;
	}

	$pass = limpiar(sha1(md5($_POST["password"])));

if ($_POST['select'] == "ADMINISTRADOR(A)" || $_POST['select']=="SECRETARIA" || $_POST['select']=="RECEPCIONISTA") {

	$sql = "SELECT * FROM usuarios WHERE usuario = ? AND password = ? AND status = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(limpiar($_POST["usuario"]), $pass));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		echo "2";
		exit;
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[]=$row;
		}
		$_SESSION["codigo"] = $p[0]["codigo"];
		$_SESSION["dni"] = $p[0]["dni"];
		$_SESSION["nombres"] = $p[0]["nombres"];
		$_SESSION["sexo"] = $p[0]["sexo"];
		$_SESSION["direccion"] = $p[0]["direccion"];
		$_SESSION["telefono"] = $p[0]["telefono"];
		$_SESSION["email"] = $p[0]["email"];
		$_SESSION["usuario"] = $p[0]["usuario"];
		$_SESSION["password"] = $p[0]["password"];
		$_SESSION["nivel"] = $p[0]["nivel"];
		$_SESSION["status"] = $p[0]["status"];
		$_SESSION["select"] = $_POST['select'];
		$_SESSION["ingreso"] = limpiar(date("d-m-Y h:i:s A"));

		$query = "INSERT INTO log values (null, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1,$a);
		$stmt->bindParam(2,$b);
		$stmt->bindParam(3,$c);
		$stmt->bindParam(4,$d);
		$stmt->bindParam(5,$e);

		$a = limpiar($_SERVER['REMOTE_ADDR']);
		$b = limpiar(date("Y-m-d h:i:s"));
		$c = limpiar($_SERVER['HTTP_USER_AGENT']);
		$d = limpiar($_SERVER['PHP_SELF']);
		$e = limpiar($_POST["usuario"]);
		$stmt->execute();

		switch($_SESSION["nivel"])
		{
			case 'ADMINISTRADOR(A)':
			$_SESSION["acceso"]="administrador";
			
			?>

			<script type="text/javascript">
				window.location="panel";
			</script>
			
			<?php
			break;
			case 'SECRETARIA':
			$_SESSION["acceso"]="secretaria";
			?>

			<script type="text/javascript">
				window.location="panel";
			</script>
			
			<?php
			break;
			case 'RECEPCIONISTA':
			$_SESSION["acceso"]="recepcionista";
			?>

			<script type="text/javascript">
				window.location="panel";
			</script>
			
			<?php
			break;
		  }
		} 
	} else {

	$sql = "SELECT * FROM clientes LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento WHERE clientes.dnicliente = ? and clientes.passwordcliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(limpiar($_POST["usuario"]), $pass));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		echo "2";
		exit;
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[]=$row;
		}

		$_SESSION["codcliente"] = $p[0]["codcliente"];
		$_SESSION["documento"] = $p[0]["documento"];
		$_SESSION["tipoidentificacion"] = $p[0]["tipoidentificacion"];
		$_SESSION["dnicliente"] = $p[0]["dnicliente"];
		$_SESSION["nomcliente"] = $p[0]["nomcliente"];
		$_SESSION["nombres"] = $p[0]["nomcliente"];
		$_SESSION["paiscliente"] = $p[0]["paiscliente"];
		$_SESSION["ciudadcliente"] = $p[0]["ciudadcliente"];
		$_SESSION["direccliente"] = $p[0]["direccliente"];
		$_SESSION["telefcliente"] = $p[0]["telefcliente"];
		$_SESSION["correocliente"] = $p[0]["correocliente"];
		$_SESSION["password"] = $p[0]["passwordcliente"];
		$_SESSION["nivel"] = "CLIENTE";
		$_SESSION["select"] = $_POST['select'];
		$_SESSION["ingreso"] = limpiar(date("d-m-Y h:i:s A"));
		$_SESSION["usuario"] = $p[0]["dnicliente"];
		$_SESSION["acceso"]="cliente";

		$query = "INSERT INTO log values (null, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1,$a);
		$stmt->bindParam(2,$b);
		$stmt->bindParam(3,$c);
		$stmt->bindParam(4,$d);
		$stmt->bindParam(5,$e);

		$a = limpiar($_SERVER['REMOTE_ADDR']);
		$b = limpiar(date("Y-m-d h:i:s"));
		$c = limpiar($_SERVER['HTTP_USER_AGENT']);
		$d = limpiar($_SERVER['PHP_SELF']);
		$e = limpiar($_POST["usuario"]);
		$stmt->execute();

		switch($_SESSION["nivel"])
		{
			case 'CLIENTE':
			$_SESSION["acceso"]="cliente";
			
			?>

			<script type="text/javascript">
				window.location="panel";
			</script>
			
			<?php
			break;
		    }
		
	    }
    }
	//print_r($_POST);
	exit;
}
###################### FUNCION PARA ACCEDER AL SISTEMA #######################



















######################### FUNCION RECUPERAR Y ACTUALIZAR PASSWORD #######################

############################ FUNCION PARA RECUPERAR CLAVE ############################
public function RecuperarPassword()
{
	self::SetNames();
	if(empty($_["email"]))
	{
		echo "1";
		exit;
	}

if ($_POST['select'] == "ADMINISTRADOR(A)" || $_POST['select']=="SECRETARIA" || $_POST['select']=="RECEPCIONISTA") {

	$sql = "SELECT * FROM usuarios WHERE email = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["email"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "2";
		exit;
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$pa[] = $row;
		}
		$id = $pa[0]["codigo"];
		$nombres = $pa[0]["nombres"];
	}
	
	$sql = "UPDATE usuarios SET "
	." password = ? "
	." where "
	." codigo = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $password);
	$stmt->bindParam(2, $codigo);

	$codigo = $id;
	$pass = strtoupper(generar_clave(15));
	$password = sha1(md5($pass));
	$stmt->execute();

+	$para = $_POST["email"];
	$titulo = 'RECUPERACION DE PASSWORD';
	$header = 'From: ' . 'SISTEMA DE GESTION DE RESERVACIONES';
	$msjCorreo = " Nombre: $nombres\n Nuevo Passw: $pass\n Mensaje: Por favor use esta nueva clave de acceso para ingresar al Sistema de Gestion de Reservaciones\n";
	mail($para, $titulo, $msjCorreo, $header);

	echo "<span class='fa fa-check-square-o'></span> SU NUEVA CLAVE DE ACCESO LE FUE ENVIADA A SU CORREO ELECTRONICO EXITOSAMENTE";

    } else {

	$sql = "SELECT * FROM clientes WHERE correocliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["email"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "2";
		exit;
	}
	else
	{
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$pa[] = $row;
		}
		$codcliente = $pa[0]["codcliente"];
	    $nomcliente = $pa[0]["nomcliente"];
		$password = $pa[0]["passwordcliente"];
	}
	
	$sql = "UPDATE clientes set "
	." passwordcliente = ? "
	." where "
	." codcliente = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $password);
	$stmt->bindParam(2, $codigo);

	$codigo = $codcliente;
	$pass = strtoupper(generar_clave(10));
	$password = sha1(md5($pass));
	$stmt->execute();

	$para = $_POST["email"];
	$titulo = 'RECUPERACION DE PASSWORD';
	$header = 'From: ' . 'SISTEMA DE GESTION DE RESERVACIONES';
	$msjCorreo = " Nombre: $nomcliente\n Nuevo Passw: $pass\n Mensaje: Por favor use esta nueva clave de acceso para ingresar al Sistema de Gestion de Reservaciones\n";
	mail($para, $titulo, $msjCorreo, $header);

	echo "<span class='fa fa-check-square-o'></span> SU NUEVA CLAVE DE ACCESO LE FUE ENVIADA A SU CORREO ELECTRONICO EXITOSAMENTE";

    }
}	
############################ FUNCION PARA RECUPERAR CLAVE #############################

########################### FUNCION PARA ACTUALIZAR PASSWORD ###########################
public function ActualizarPassword()
{
	self::SetNames();
	if(empty($_POST["dni"]))
	{
		echo "1";
		exit;

	} elseif(sha1(md5($_POST["password"]))==$_POST["clave"]){

		echo "2";
		exit;
	}
		
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {
		
		$sql = "UPDATE usuarios SET "
		." usuario = ?, "
		." password = ? "
		." where "
		." codigo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $usuario);
		$stmt->bindParam(2, $password);
		$stmt->bindParam(3, $codigo);	

		$usuario = limpiar($_POST["usuario"]);
		$password = sha1(md5($_POST["password"]));
		$codigo = limpiar($_POST["codigo"]);
		$stmt->execute();
		
		echo "<span class='fa fa-check-square-o'></span> SU CLAVE DE ACCESO FUE ACTUALIZADA EXITOSAMENTE, SER&Aacute; EXPULSADO DE SU SESI&Oacute;N Y DEBER&Aacute; DE ACCEDER NUEVAMENTE";
		?>
		<script>
			function redireccionar(){location.href="logout.php";}
			setTimeout ("redireccionar()", 3000);
		</script>
		<?php
		exit;

} else {

		$sql = "UPDATE clientes set "
		." passwordcliente = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $password);
		$stmt->bindParam(2, $codigo);	

		$password = sha1(md5($_POST["password"]));
		$codigo = limpiar($_POST["codigo"]);
		$stmt->execute();
		
		echo "<span class='fa fa-check-square-o'></span> SU CLAVE DE ACCESO FUE ACTUALIZADA EXITOSAMENTE, SER&Aacute; EXPULSADO DE SU SESI&Oacute;N Y DEBER&Aacute; DE ACCEDER NUEVAMENTE";
		?>
		<script>
			function redireccionar(){location.href="logout.php";}
			setTimeout ("redireccionar()", 3000);
		</script>
		<?php
		exit;
	}	
}
########################## FUNCION PARA ACTUALIZAR PASSWORD ##########################

######################## FUNCION RECUPERAR Y ACTUALIZAR PASSWORD ########################
































########################## FUNCION CONFIGURACION GENERAL ############################

######################## FUNCION ID CONFIGURACION #########################
public function ConfiguracionPorId()
{
	self::SetNames();
	$sql = " SELECT 
	configuracion.id,
	configuracion.documgerente,
	configuracion.cedgerente,
	configuracion.nomgerente,
	configuracion.tlfgerente,
	configuracion.direcgerente,
	configuracion.documenhotel,
	configuracion.nrohotel,
	configuracion.nomhotel,
	configuracion.tlfhotel,
	configuracion.direchotel,
	configuracion.emailhotel,
	configuracion.categoriahotel,
	configuracion.nroactividad,
	configuracion.iniciofactura,
	configuracion.fechaautorizacion,
	configuracion.llevacontabilidad,
	configuracion.acerca,
	configuracion.metodopago,
	configuracion.dsctor,
	configuracion.dsctov,
	configuracion.codmoneda,
	configuracion.codmoneda2,
	documentos.documento,
	documentos2.documento AS documento2,
	tiposmoneda.moneda,
	tiposmoneda2.moneda AS moneda2,
	tiposmoneda.simbolo,
	tiposmoneda2.simbolo AS simbolo2
	FROM configuracion 
	LEFT JOIN documentos ON configuracion.documenhotel = documentos.coddocumento
	LEFT JOIN documentos AS documentos2 ON configuracion.documgerente = documentos2.coddocumento 
	LEFT JOIN tiposmoneda ON configuracion.codmoneda = tiposmoneda.codmoneda
	LEFT JOIN tiposmoneda AS tiposmoneda2 ON configuracion.codmoneda2 = tiposmoneda2.codmoneda WHERE configuracion.id = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array('1'));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################### FUNCION ID CONFIGURACION #########################

########################## FUNCION  ACTUALIZAR CONFIGURACION #########################
public function ActualizarConfiguracion()
{
	self::SetNames();
	if(empty($_POST["cedgerente"]) or empty($_POST["nomgerente"]) or empty($_POST["tlfgerente"]) or empty($_POST["direcgerente"]) or empty($_POST["nrohotel"]) or empty($_POST["nomhotel"]) or empty($_POST["tlfhotel"]) or empty($_POST["direchotel"]) or empty($_POST["emailhotel"]) or empty($_POST["categoriahotel"]) or empty($_POST["nroactividad"]) or empty($_POST["iniciofactura"]) or empty($_POST["fechaautorizacion"]) or empty($_POST["llevacontabilidad"]) or empty($_POST["dsctor"]) or empty($_POST["dsctov"]) or empty($_POST["codmoneda"]) or empty($_POST["codmoneda2"]))
	{
		echo "1";
		exit;
	}
	$sql = "UPDATE configuracion set "
	." documgerente = ?, "
	." cedgerente = ?, "
	." nomgerente = ?, "
	." tlfgerente = ?, "
	." direcgerente = ?, "
	." documenhotel = ?, "
	." nrohotel = ?, "
	." nomhotel = ?, "
	." tlfhotel = ?, "
	." direchotel = ?, "
	." emailhotel = ?, "
	." categoriahotel = ?, "
	." nroactividad = ?, "
	." iniciofactura = ?, "
	." fechaautorizacion = ?, "
	." llevacontabilidad = ?, "
	." acerca = ?, "
	." metodopago = ?, "
	." dsctor = ?, "
	." dsctov = ?, "
	." codmoneda = ?, "
	." codmoneda2 = ? "
	." where "
	." id = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $documgerente);
	$stmt->bindParam(2, $cedgerente);
	$stmt->bindParam(3, $nomgerente);
	$stmt->bindParam(4, $tlfgerente);
	$stmt->bindParam(5, $direcgerente);
	$stmt->bindParam(6, $documenhotel);
	$stmt->bindParam(7, $nrohotel);
	$stmt->bindParam(8, $nomhotel);
	$stmt->bindParam(9, $tlfhotel);
	$stmt->bindParam(10, $direchotel);
	$stmt->bindParam(11, $emailhotel);
	$stmt->bindParam(12, $categoriahotel);
	$stmt->bindParam(13, $nroactividad);
	$stmt->bindParam(14, $iniciofactura);
	$stmt->bindParam(15, $fechaautorizacion);
	$stmt->bindParam(16, $llevacontabilidad);
	$stmt->bindParam(17, $acerca);
	$stmt->bindParam(18, $metodopago);
	$stmt->bindParam(19, $dsctor);
	$stmt->bindParam(20, $dsctov);
	$stmt->bindParam(21, $codmoneda);
	$stmt->bindParam(22, $codmoneda2);
	$stmt->bindParam(23, $id);

	$documgerente = limpiar($_POST["documgerente"]);
	$cedgerente = limpiar($_POST["cedgerente"]);
	$nomgerente = limpiar($_POST["nomgerente"]);
	$tlfgerente = limpiar($_POST["tlfgerente"]);
	$direcgerente = limpiar($_POST["direcgerente"]);
	$documenhotel = limpiar($_POST["documenhotel"]);
	$nrohotel = limpiar($_POST["nrohotel"]);
	$nomhotel = limpiar($_POST["nomhotel"]);
	$tlfhotel = limpiar($_POST["tlfhotel"]);
	$direchotel = limpiar($_POST["direchotel"]);
	$emailhotel = limpiar($_POST["emailhotel"]);
	$categoriahotel = limpiar($_POST["categoriahotel"]);
	$nroactividad = limpiar($_POST["nroactividad"]);
	$iniciofactura = limpiar($_POST["iniciofactura"]);
if (limpiar(isset($_POST['fechaautorizacion'])) && limpiar($_POST['fechaautorizacion']!="")) { $fechaautorizacion = limpiar(date("Y-m-d",strtotime($_POST['fechaautorizacion']))); } else { $fechaautorizacion = limpiar('0000-00-00'); };
	$llevacontabilidad = limpiar($_POST["llevacontabilidad"]);
	$acerca = limpiar($_POST["acerca"]);
	$metodopago = limpiar($_POST["metodopago"]);
	$dsctor = limpiar($_POST["dsctor"]);
	$dsctov = limpiar($_POST["dsctov"]);
	$codmoneda = limpiar($_POST["codmoneda"]);
	$codmoneda2 = limpiar($_POST["codmoneda2"]);
	$id = limpiar($_POST["id"]);
	$stmt->execute();

	##################  SUBIR LOGO #1 ######################################
         //datos del arhivo  
    if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
    if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
    if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
	if ((strpos($tipo_archivo,'image/png')!==false)&&$tamano_archivo<200000) {  
			if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/logo-principal.png"))
			
					{ 
		 ## se puede dar un aviso
					} 
		 ## se puede dar otro aviso 
				}
	##################  FINALIZA SUBIR LOGO #1 ######################################

	##################  SUBIR LOGO #2 ######################################
         //datos del arhivo  
    if (isset($_FILES['imagen2']['name'])) { $nombre_archivo = $_FILES['imagen2']['name']; } else { $nombre_archivo =''; }
    if (isset($_FILES['imagen2']['type'])) { $tipo_archivo = $_FILES['imagen2']['type']; } else { $tipo_archivo =''; }
    if (isset($_FILES['imagen2']['size'])) { $tamano_archivo = $_FILES['imagen2']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
	if ((strpos($tipo_archivo,'image/png')!==false)&&$tamano_archivo<200000) {  
			if (move_uploaded_file($_FILES['imagen2']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/logo-admin.png"))
			
					{ 
		 ## se puede dar un aviso
					} 
		 ## se puede dar otro aviso 
				}
	##################  FINALIZA SUBIR LOGO #2 ######################################

	##################  SUBIR LOGO #3 ######################################
         //datos del arhivo  
    if (isset($_FILES['imagen3']['name'])) { $nombre_archivo = $_FILES['imagen3']['name']; } else { $nombre_archivo =''; }
    if (isset($_FILES['imagen3']['type'])) { $tipo_archivo = $_FILES['imagen3']['type']; } else { $tipo_archivo =''; }
    if (isset($_FILES['imagen3']['size'])) { $tamano_archivo = $_FILES['imagen3']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
	if ((strpos($tipo_archivo,'image/png')!==false)&&$tamano_archivo<200000) {  
			if (move_uploaded_file($_FILES['imagen3']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/logo-pdf.png"))
			
					{ 
		 ## se puede dar un aviso
					} 
		 ## se puede dar otro aviso 
				}
	##################  FINALIZA SUBIR LOGO #3 ######################################

	echo "<span class='fa fa-check-square-o'></span> LOS DATOS DE CONFIGURACI&Oacute;N FUERON ACTUALIZADOS EXITOSAMENTE";
	exit;
}
########################### FUNCION  ACTUALIZAR CONFIGURACION ###########################

######################### FIN DE FUNCION CONFIGURACION GENERAL ########################

















################################## CLASE MENSAJE DE CONTACTO ####################################

############################## FUNCION ENVIAR MENSAJE EN CONTACTO ##############################
public function EnviarContact()
{
	self::SetNames();
	if(empty($_POST["name"]) or empty($_POST["email"]) or empty($_POST["subject"]) or empty($_POST["message"]))
	{
		echo "1";
		exit;
	}

	################## DATOS DE CONFIGURACION #####################
	$sql = "SELECT * FROM configuracion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
    $rucemisor = $row['nrohotel'];
    $nomsucursal = $row['nomhotel'];
    $correo = $row['emailhotel'];
    ################## DATOS DE CONFIGURACION #####################

	#################### VALIDACION DE ENVIO DE CORREO CON PHPMAILER ####################
	$smtp=new PHPMailer();
	$smtp->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);

	# Indicamos que vamos a utilizar un servidor SMTP
	$smtp->IsSMTP();

    # Definimos el formato del correo con UTF-8
	$smtp->CharSet="UTF-8";

    # autenticación contra nuestro servidor smtp
	$smtp->Port = 465;
	$smtp->IsSMTP(); // use SMTP
	$smtp->SMTPAuth   = true;
	$smtp->SMTPSecure = 'ssl';						// enable SMTP authentication
	$smtp->Host       = "smtp.gmail.com";			// sets MAIL as the SMTP server
	$smtp->Username   = $correo;	// MAIL username
	$smtp->Password   = "**********";			// MAIL password

	# datos de quien realiza el envio
	$smtp->From       = $correo; // from mail
	$smtp->FromName   = portales(utf8_decode($_POST['name'])); // from mail name

	# Indicamos las direcciones donde enviar el mensaje con el formato
	#   "correo"=>"nombre usuario"
	# Se pueden poner tantos correos como se deseen

	# establecemos un limite de caracteres de anchura
	$smtp->WordWrap   = 50; // set word wrap

	# NOTA: Los correos es conveniente enviarlos en formato HTML y Texto para que
	# cualquier programa de correo pueda leerlo.

	# Definimos el contenido HTML del correo
	$contenidoHTML="<head>";
	$contenidoHTML.="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
	$contenidoHTML.="</head><body>";
	$contenidoHTML.="<b>".$_POST['subject']."</b>";
	$contenidoHTML.="<p>SR(A) ".$_POST['name']."</p>";
	$contenidoHTML.="<p>".$_POST['email']."</p>";
	$contenidoHTML.="<p>".$_POST['message']."</p>";
	$contenidoHTML.="</body>\n";

	# Definimos el contenido en formato Texto del correo
	$contenidoTexto="".$_POST['subject']."";
	$contenidoTexto.="\n\n";

	# Definimos el subject
	$smtp->Subject="".$_POST['subject']."";

	# Adjuntamos el archivo al correo.
    $smtp->AddAttachment("fotos/logo-admin.png", "logo.png");
	//$smtp->AddAttachment("");

	# Indicamos el contenido
	$smtp->AltBody=$contenidoTexto; //Text Body
	$smtp->MsgHTML($contenidoHTML); //Text body HTML

	$smtp->ClearAllRecipients();
	$smtp->AddAddress($correo,portales(utf8_decode($nomsucursal)));

	//$smtp->Send();
	//Enviamos email
	//if(!$smtp->Send()) {

		$query = "INSERT INTO contact values (null, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $name);
		$stmt->bindParam(2, $phone);
		$stmt->bindParam(3, $email);
		$stmt->bindParam(4, $subject);
		$stmt->bindParam(5, $message);
		$stmt->bindParam(6, $fecha);

		$name = limpiar($_POST["name"]);
		$phone = limpiar($_POST["phone"]);
		$email = limpiar($_POST["email"]);
		$subject = limpiar($_POST["subject"]);
		$message = limpiar($_POST["message"]);
		$fecha = limpiar(date("Y-m-d H:i:s"));
		$stmt->execute();

	    echo "<span class='fa fa-check-square-o'></span> EL MENSAJE HA SIDO ENVIADO EXITOSAMENTE, PRONTO LE RESPONDEREMOS, GRACIAS POR PREFERIRNOS";
	    exit;
}
############################# FUNCION ENVIAR MENSAJE EN CONTACTO ###############################

######################## FUNCION LISTAR MENSAJES DE CONTACTO ###############################
public function ListarContact()
{
	self::SetNames();
	$sql = "SELECT * FROM contact ORDER BY fecha DESC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
########################## FUNCION LISTAR MENSAJES DE CONTACTO ##########################

############################ FUNCION ID MENSAJES DE CONTACTO #################################
public function ContactPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM contact WHERE codmensaje = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codmensaje"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}		
############################ FUNCION ID MENSAJES DE CONTACTO #################################

########################## FUNCION ELIMINAR MENSAJES DE CONTACTO ########################
public function EliminarContact()
{
	self::SetNames();
    if($_SESSION['acceso'] == "administrador") {

	$sql = "DELETE FROM contact WHERE codmensaje = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codmensaje);
		$codmensaje = decrypt($_GET["codmensaje"]);
		$stmt->execute();

		echo "1";
		exit;

	} else {
		   
		echo "2";
		exit;
	} 	
}
############################ FUNCION ELIMINAR MENSAJES DE CONTACTO #######################

################################## CLASE MENSAJE CONTACTO ####################################




















################################## CLASE USUARIOS ####################################

############################## FUNCION REGISTRAR USUARIOS ##############################
public function RegistrarUsuarios()
{
	self::SetNames();
	if(empty($_POST["nombres"]) or empty($_POST["usuario"]) or empty($_POST["password"]))
	{
		echo "1";
		exit;
	}

	$sql = " SELECT dni FROM usuarios WHERE dni = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["dni"]));
	$num = $stmt->rowCount();
	if($num > 0)
	{
		
		echo "2";
		exit;
	}
	else
	{
		$sql = " SELECT email FROM usuarios WHERE email = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["email"]));
		$num = $stmt->rowCount();
		if($num > 0)
		{

			echo "3";
			exit;
		}
		else
		{
			$sql = " SELECT usuario FROM usuarios WHERE usuario = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["usuario"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO usuarios values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $dni);
				$stmt->bindParam(2, $nombres);
				$stmt->bindParam(3, $sexo);
				$stmt->bindParam(4, $direccion);
				$stmt->bindParam(5, $telefono);
				$stmt->bindParam(6, $email);
				$stmt->bindParam(7, $usuario);
				$stmt->bindParam(8, $password);
				$stmt->bindParam(9, $nivel);
				$stmt->bindParam(10, $status);

				$dni = limpiar($_POST["dni"]);
				$nombres = limpiar($_POST["nombres"]);
				$sexo = limpiar($_POST["sexo"]);
				$direccion = limpiar($_POST["direccion"]);
				$telefono = limpiar($_POST["telefono"]);
				$email = limpiar($_POST["email"]);
				$usuario = limpiar($_POST["usuario"]);
				$password = sha1(md5($_POST["password"]));
				$nivel = limpiar($_POST["nivel"]);
				$status = limpiar($_POST["status"]);
				$stmt->execute();

		##################  SUBIR FOTO DE USUARIOS ######################################
         //datos del arhivo  
				if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
				if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
				if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
				if ((strpos($tipo_archivo,'image/jpeg')!==false)&&$tamano_archivo<50000) 
				{  
					if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/".$_POST["dni"].".jpg"))
					{ 
		 ## se puede dar un aviso
					} 
		 ## se puede dar otro aviso 
				}
		##################  FINALIZA SUBIR FOTO DE USUARIOS ######################################

				echo "<span class='fa fa-check-square-o'></span> EL USUARIO HA SIDO REGISTRADO EXITOSAMENTE";
				exit;
			}
			else
			{
				echo "4";
				exit;
			}
		}
	}
}
############################# FUNCION REGISTRAR USUARIOS ###############################

############################## FUNCION LISTAR USUARIOS ################################
public function ListarUsuarios()
{
	self::SetNames();
	$sql = "SELECT * FROM usuarios";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
############################## FUNCION LISTAR USUARIOS ##############################

############################ FUNCION LISTAR LOGS DE USUARIOS ###########################
public function ListarLogs()
{
	self::SetNames();
	$sql = "SELECT * FROM log";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

   }
########################### FUNCION LISTAR LOGS DE USUARIOS ############################

########################### FUNCION ID USUARIOS #################################
public function UsuariosPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM usuarios WHERE codigo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codigo"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID USUARIOS #################################

############################ FUNCION ACTUALIZAR USUARIOS ############################
public function ActualizarUsuarios()
{

	self::SetNames();
	if(empty($_POST["dni"]) or empty($_POST["nombres"]) or empty($_POST["usuario"]) or empty($_POST["password"]))
	{
		echo "1";
		exit;
	}

	$sql = "SELECT * FROM usuarios WHERE codigo != ? AND dni = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codigo"],$_POST["dni"]));
	$num = $stmt->rowCount();
	if($num > 0)
	{
		echo "2";
		exit;
	}
	else
	{
		$sql = " SELECT email FROM usuarios WHERE codigo != ? AND email = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codigo"],$_POST["email"]));
		$num = $stmt->rowCount();
		if($num > 0)
		{
			echo "3";
			exit;
		}
		else
		{
			$sql = " SELECT usuario FROM usuarios WHERE codigo != ? AND usuario = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codigo"],$_POST["usuario"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE usuarios set "
				." dni = ?, "
				." nombres = ?, "
				." sexo = ?, "
				." direccion = ?, "
				." telefono = ?, "
				." email = ?, "
				." usuario = ?, "
				." password = ?, "
				." nivel = ?, "
				." status = ? "
				." where "
				." codigo = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $dni);
				$stmt->bindParam(2, $nombres);
				$stmt->bindParam(3, $sexo);
				$stmt->bindParam(4, $direccion);
				$stmt->bindParam(5, $telefono);
				$stmt->bindParam(6, $email);
				$stmt->bindParam(7, $usuario);
				$stmt->bindParam(8, $password);
				$stmt->bindParam(9, $nivel);
				$stmt->bindParam(10, $status);
				$stmt->bindParam(11, $codigo);

				$dni = limpiar($_POST["dni"]);
				$nombres = limpiar($_POST["nombres"]);
				$sexo = limpiar($_POST["sexo"]);
				$direccion = limpiar($_POST["direccion"]);
				$telefono = limpiar($_POST["telefono"]);
				$email = limpiar($_POST["email"]);
				$usuario = limpiar($_POST["usuario"]);
				$password = sha1(md5($_POST["password"]));
				$nivel = limpiar($_POST["nivel"]);
				$status = limpiar($_POST["status"]);
				$codigo = limpiar($_POST["codigo"]);
				$stmt->execute();

		################## SUBIR FOTO DE USUARIOS ######################################
         //datos del arhivo  
				if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
				if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
				if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; }  
         //compruebo si las características del archivo son las que deseo  
				if ((strpos($tipo_archivo,'image/jpeg')!==false)&&$tamano_archivo<50000) 
				{  
					if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/".$nombre_archivo) && rename("fotos/".$nombre_archivo,"fotos/".$_POST["dni"].".jpg"))
					{ 
		 ## se puede dar un aviso
					} 
		 ## se puede dar otro aviso 
				}
		################## FINALIZA SUBIR FOTO DE USUARIOS ###################

				echo "<span class='fa fa-check-square-o'></span> EL USUARIO HA SIDO ACTUALIZADO EXITOSAMENTE";
				exit;
			}
			else
			{
				echo "4";
				exit;
			}
		}
	}
}
############################ FUNCION ACTUALIZAR USUARIOS ############################

############################# FUNCION ELIMINAR USUARIOS ##############################
public function EliminarUsuarios()
{
	self::SetNames();
	if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codigo FROM ventas WHERE codigo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codigo"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = " DELETE FROM usuarios WHERE codigo = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codigo);
			$codigo = decrypt($_GET["codigo"]);
			$stmt->execute();

			$dni = decrypt($_GET["dni"]);
			if (file_exists("fotos/".$dni.".jpg")){
		//funcion para eliminar una carpeta con contenido
			$archivos = "fotos/".$dni.".jpg";		
			unlink($archivos);
			}

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
############################## FUNCION ELIMINAR USUARIOS #############################

################################ FIN DE CLASE USUARIOS ################################

























#################################### CLASE CATEGORIAS ##################################

############################# FUNCION REGISTRAR CATEGORIAS ############################
public function RegistrarCategorias()
{
	self::SetNames();
	if(empty($_POST["nomcategoria"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT nomcategoria FROM categorias WHERE nomcategoria = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["nomcategoria"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO categorias values (null, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $nomcategoria);

				$nomcategoria = limpiar($_POST["nomcategoria"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA CATEGORIA HA SIDO REGISTRADA EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
############################# FUNCION REGISTRAR CATEGORIAS ##############################

############################# FUNCION LISTAR CATEGORIAS #############################
public function ListarCategorias()
{
	self::SetNames();
	$sql = "SELECT * FROM categorias ORDER BY nomcategoria ASC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################## FUNCION LISTAR NOTICIAS #############################

############################ FUNCION ID CATEGORIAS #################################
public function CategoriasPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM categorias WHERE codcategoria = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codcategoria"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID CATEGORIAS #################################

############################ FUNCION ACTUALIZAR CATEGORIAS ############################
public function ActualizarCategorias()
{

	self::SetNames();
	if(empty($_POST["codcategoria"]) or empty($_POST["nomcategoria"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT nomcategoria FROM categorias WHERE codcategoria != ? AND nomcategoria = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codcategoria"],$_POST["nomcategoria"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE categorias set "
				." nomcategoria = ? "
				." where "
				." codcategoria = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $nomcategoria);
				$stmt->bindParam(2, $codcategoria);

				$nomcategoria = limpiar($_POST["nomcategoria"]);
				$codcategoria = limpiar($_POST["codcategoria"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA CATEGORIA HA SIDO ACTUALIZADA EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}
############################ FUNCION ACTUALIZAR CATEGORIAS ############################

############################ FUNCION ELIMINAR CATEGORIAS ############################
public function EliminarCategorias()
{
	self::SetNames();

	if($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codcategoria FROM productos WHERE codcategoria = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codcategoria"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM categorias WHERE codcategoria = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codcategoria);
			$codcategoria = decrypt($_GET["codcategoria"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
############################# FUNCION ELIMINAR CATEGORIAS #############################

################################ FIN DE CLASE CATEGORIAS ###############################


























############################### CLASE TIPOS DE DOCUMENTOS ##############################

########################## FUNCION REGISTRAR TIPO DE DOCUMENTOS #########################
public function RegistrarDocumentos()
{
	self::SetNames();
	if(empty($_POST["documento"]) or empty($_POST["descripcion"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT * FROM documentos WHERE documento = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["documento"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO documentos values (null, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $documento);
				$stmt->bindParam(2, $descripcion);

				$documento = limpiar($_POST["documento"]);
				$descripcion = limpiar($_POST["descripcion"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TIPO DE DOCUMENTO HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
############################ FUNCION REGISTRAR TIPO DE MONEDA #########################

############################ FUNCION LISTAR TIPO DE MONEDA ############################
public function ListarDocumentos()
{
	self::SetNames();
	$sql = "SELECT * FROM documentos ORDER BY documento ASC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
########################### FUNCION LISTAR TIPO DE DOCUMENTOS ##########################

########################### FUNCION ID TIPO DE DOCUMENTOS ############################
public function DocumentoPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM documentos WHERE coddocumento = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["coddocumento"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################### FUNCION ID TIPO DE DOCUMENTOS ############################

######################### FUNCION ACTUALIZAR TIPO DE DOCUMENTOS ########################
public function ActualizarDocumentos()
{

	self::SetNames();
	if(empty($_POST["coddocumento"]) or empty($_POST["documento"]) or empty($_POST["descripcion"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT documento FROM documentos WHERE coddocumento != ? AND documento = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["coddocumento"],$_POST["documento"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE documentos set "
				." documento = ?, "
				." descripcion = ? "
				." where "
				." coddocumento = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $documento);
				$stmt->bindParam(2, $descripcion);
				$stmt->bindParam(3, $coddocumento);

				$documento = limpiar($_POST["documento"]);
				$descripcion = limpiar($_POST["descripcion"]);
				$coddocumento = limpiar($_POST["coddocumento"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TIPO DE DOCUMENTO HA SIDO ACTUALIZADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}
######################## FUNCION ACTUALIZAR TIPO DE DOCUMENTOS ########################

######################### FUNCION ELIMINAR TIPO DE DOCUMENTOS #########################
public function EliminarDocumentos()
{
	self::SetNames();
	if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT documenhotel FROM configuracion WHERE documenhotel = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["coddocumento"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM documentos WHERE coddocumento = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$coddocumento);
			$coddocumento = decrypt($_GET["coddocumento"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
########################## FUNCION ELIMINAR TIPOS DE DOCUMENTOS ########################

########################## FIN DE CLASE TIPOS DE DOCUMENTOS ###########################




























################################ CLASE TIPOS DE MONEDAS ###############################

############################ FUNCION REGISTRAR TIPO DE MONEDA ###########################
public function RegistrarTipoMoneda()
{
	self::SetNames();
	if(empty($_POST["moneda"]) or empty($_POST["moneda"]) or empty($_POST["simbolo"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT * FROM tiposmoneda WHERE moneda = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["moneda"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO tiposmoneda values (null, ?, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $moneda);
				$stmt->bindParam(2, $siglas);
				$stmt->bindParam(3, $simbolo);

				$moneda = limpiar($_POST["moneda"]);
				$siglas = limpiar($_POST["siglas"]);
				$simbolo = limpiar($_POST["simbolo"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TIPO DE MONEDA HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
########################### FUNCION REGISTRAR TIPO DE MONEDA ##########################

########################### FUNCION LISTAR TIPO DE MONEDA ###########################
public function ListarTipoMoneda()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposmoneda";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################ FUNCION LISTAR TIPO DE MONEDA #############################

############################ FUNCION ID TIPO DE MONEDA #################################
public function TipoMonedaPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposmoneda WHERE codmoneda = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codmoneda"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID TIPO DE MONEDA #################################

########################### FUNCION ACTUALIZAR TIPO DE MONEDA #########################
public function ActualizarTipoMoneda()
{

	self::SetNames();
	if(empty($_POST["codmoneda"]) or empty($_POST["moneda"]) or empty($_POST["siglas"]) or empty($_POST["simbolo"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT moneda FROM tiposmoneda WHERE codmoneda != ? AND moneda = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codmoneda"],$_POST["moneda"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE tiposmoneda set "
				." moneda = ?, "
				." siglas = ?, "
				." simbolo = ? "
				." where "
				." codmoneda = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $moneda);
				$stmt->bindParam(2, $siglas);
				$stmt->bindParam(3, $simbolo);
				$stmt->bindParam(4, $codmoneda);

				$moneda = limpiar($_POST["moneda"]);
				$siglas = limpiar($_POST["siglas"]);
				$simbolo = limpiar($_POST["simbolo"]);
				$codmoneda = limpiar($_POST["codmoneda"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TIPO DE MONEDA HA SIDO ACTUALIZADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}

############################# FUNCION PARA TRAER PERFIL DE RESTAURANTE ##########################



public function ListarPerfilR()
{
	self::SetNames();
	$sql = "SELECT * FROM instalacion where id=1";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }













############################# FUNCION PARA TRAER CATEGORIAS CARTA ##########################


public function ListarCategoriasCarta()
{
	self::SetNames();
	$sql = "SELECT * FROM carta_categoria";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }






########################### FUNCION PARA TRAER PRODUCTOS DEL MENU #########################
public function ListarProductosCarta()
{
	self::SetNames();
	$sql ="SELECT * FROM carta_producto";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
########################## FUNCION ELIMINAR TIPO DE MONEDA ############################
public function EliminarTipoMoneda()
{
	self::SetNames();
	if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codmoneda FROM tiposcambio WHERE codmoneda = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codmoneda"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM tiposmoneda WHERE codmoneda = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codmoneda);
			$codmoneda = decrypt($_GET["codmoneda"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
######################### FUNCION ELIMINAR TIPOS DE MONEDAS ###########################

###################### FUNCION BUSCAR TIPOS DE CAMBIOS POR MONEDA ######################
public function BuscarTiposCambios()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposmoneda INNER JOIN tiposcambio ON tiposmoneda.codmoneda = tiposcambio.codmoneda WHERE tiposcambio.codmoneda = ? ORDER BY tiposcambio.codcambio DESC LIMIT 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codmoneda"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "<center><div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<span class='fa fa-info-circle'></span> NO SE ENCONTRARON TIPOS DE CAMBIO PARA LA MONEDA SELECCIONADA</div></center>";
		exit;
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSCAR TIPOS DE CAMBIOS POR MONEDA ######################

########################## FIN DE CLASE TIPOS DE MONEDAS ###############################
























################################# CLASE TIPOS DE CAMBIOS ###############################

############################# FUNCION REGISTRAR TIPO DE CAMBIO #########################
public function RegistrarTipoCambio()
{
	self::SetNames();
	if(empty($_POST["descripcioncambio"]) or empty($_POST["montocambio"]) or empty($_POST["codmoneda"]) or empty($_POST["fechacambio"]))
	{
		echo "1";
		exit;
	}
			
		$sql = "SELECT codmoneda, fechacambio FROM tiposcambio WHERE codmoneda = ? AND fechacambio = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codmoneda"],date("Y-m-d",strtotime($_POST['fechacambio']))));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = "INSERT INTO tiposcambio values (null, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $descripcioncambio);
			$stmt->bindParam(2, $montocambio);
			$stmt->bindParam(3, $codmoneda);
			$stmt->bindParam(4, $fechacambio);

			$descripcioncambio = limpiar($_POST["descripcioncambio"]);
			$montocambio = number_format($_POST["montocambio"], 3, '.', '');
			$codmoneda = limpiar($_POST["codmoneda"]);
			$fechacambio = limpiar(date("Y-m-d",strtotime($_POST['fechacambio'])));
			$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TIPO DE CAMBIO HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
############################ FUNCION REGISTRAR TIPO DE CAMBIO #########################

########################## FUNCION LISTAR TIPO DE CAMBIO ################################
public function ListarTipoCambio()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposcambio INNER JOIN tiposmoneda ON tiposcambio.codmoneda = tiposmoneda.codmoneda";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################ FUNCION LISTAR TIPO DE CAMBIO ###########################

############################ FUNCION ID TIPO DE CAMBIO #################################
public function TipoCambioPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposcambio INNER JOIN tiposmoneda ON tiposcambio.codmoneda = tiposmoneda.codmoneda WHERE tiposcambio.codcambio = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codcambio"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID TIPO DE CAMBIO #################################

########################### FUNCION ACTUALIZAR TIPO DE CAMBIO ##########################
public function ActualizarTipoCambio()
{
	self::SetNames();
	if(empty($_POST["codcambio"])or empty($_POST["descripcioncambio"]) or empty($_POST["montocambio"]) or empty($_POST["codmoneda"]) or empty($_POST["fechacambio"]))
	{
		echo "1";
		exit;
	}
			
		$sql = "SELECT codmoneda, fechacambio FROM tiposcambio WHERE codcambio != ? AND codmoneda = ? AND fechacambio = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codcambio"],$_POST["codmoneda"],date("Y-m-d",strtotime($_POST['fechacambio']))));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$sql = "UPDATE tiposcambio set "
			." descripcioncambio = ?, "
			." montocambio = ?, "
			." codmoneda = ?, "
			." fechacambio = ? "
			." where "
			." codcambio = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $descripcioncambio);
			$stmt->bindParam(2, $montocambio);
			$stmt->bindParam(3, $codmoneda);
			$stmt->bindParam(4, $fechacambio);
			$stmt->bindParam(5, $codcambio);

			$descripcioncambio = limpiar($_POST["descripcioncambio"]);
			$montocambio = number_format($_POST["montocambio"], 3, '.', '');
			$codmoneda = limpiar($_POST["codmoneda"]);
			$fechacambio = limpiar(date("Y-m-d",strtotime($_POST['fechacambio'])));
			$codcambio = limpiar($_POST["codcambio"]);
			$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TIPO DE CAMBIO HA SIDO ACTUALIZADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
########################### FUNCION ACTUALIZAR TIPO DE CAMBIO #########################

########################## FUNCION ELIMINAR TIPO DE CAMBIO ############################
public function EliminarTipoCambio()
{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		    $sql = "DELETE FROM tiposcambio WHERE codcambio = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codcambio);
			$codcambio = decrypt($_GET["codcambio"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		} 
}
########################### FUNCION ELIMINAR TIPO DE CAMBIO ############################

######################### FUNCION BUSCAR PRODUCTOS POR MONEDA ##########################
public function MonedaProductoId()
{
	self::SetNames();
	$sql = "SELECT configuracion.codmoneda2, tiposmoneda.moneda, tiposmoneda.siglas, tiposmoneda.simbolo, tiposcambio.montocambio 
	FROM configuracion 
	INNER JOIN tiposmoneda ON configuracion.codmoneda2 = tiposmoneda.codmoneda
	INNER JOIN tiposcambio ON tiposmoneda.codmoneda = tiposcambio.codmoneda WHERE configuracion.id = ? ORDER BY tiposcambio.codcambio DESC LIMIT 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array('1'));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	   }
}
######################## FUNCION BUSCAR PRODUCTOS POR MONEDA ###########################

############################ FIN DE CLASE TIPOS DE CAMBIOS ##############################


























################################ CLASE MEDIOS DE PAGOS #################################

########################## FUNCION REGISTRAR MEDIOS DE PAGOS ###########################
public function RegistrarMediosPagos()
{
	self::SetNames();
	if(empty($_POST["mediopago"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT mediopago FROM mediospagos WHERE mediopago = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["mediopago"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO mediospagos values (null, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $mediopago);

				$mediopago = limpiar($_POST["mediopago"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL MEDIO DE PAGO HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
############################ FUNCION REGISTRAR MEDIOS DE PAGOS ##########################

########################### FUNCION LISTAR MEDIOS DE PAGOS ###########################
public function ListarMediosPagos()
{
	self::SetNames();
	$sql = "SELECT * FROM mediospagos";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
########################### FUNCION LISTAR MEDIOS DE PAGOS #############################

########################### FUNCION ID MEDIOS DE PAGOS #################################
public function MediosPagosPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM mediospagos WHERE codmediopago = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codmediopago"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID MEDIOS DE PAGOS #################################

######################### FUNCION ACTUALIZAR MEDIOS DE PAGOS ##########################
public function ActualizarMediosPagos()
{
	self::SetNames();
	if(empty($_POST["codmediopago"]) or empty($_POST["mediopago"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT mediopago FROM mediospagos WHERE codmediopago != ? AND mediopago = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codmediopago"],$_POST["mediopago"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE mediospagos set "
				." mediopago = ? "
				." where "
				." codmediopago = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $mediopago);
				$stmt->bindParam(2, $codmediopago);

				$mediopago = limpiar($_POST["mediopago"]);
				$codmediopago = limpiar($_POST["codmediopago"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL MEDIO DE PAGO HA SIDO ACTUALIZADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}
########################### FUNCION ACTUALIZAR MEDIOS DE PAGOS #########################

########################### FUNCION ELIMINAR MEDIOS DE PAGOS ###########################
public function EliminarMediosPagos()
{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT formapago FROM ventas WHERE formapago = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codmediopago"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM mediospagos WHERE codmediopago = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codmediopago);
			$codmediopago = decrypt($_GET["codmediopago"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
########################## FUNCION ELIMINAR MEDIOS DE PAGOS #############################

########################### FIN DE CLASE MEDIOS DE PAGOS ############################


























################################ CLASE IMPUESTOS ################################

############################ FUNCION REGISTRAR IMPUESTOS ###############################
public function RegistrarImpuestos()
{
	self::SetNames();
	if(empty($_POST["nomimpuesto"]) or empty($_POST["valorimpuesto"]) or empty($_POST["statusimpuesto"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT statusimpuesto FROM impuestos WHERE nomimpuesto != ? AND statusimpuesto = ? AND statusimpuesto = 'ACTIVO'";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["nomimpuesto"],$_POST["statusimpuesto"]));
			$num = $stmt->rowCount();
			if($num>0)
			{
				echo "2";
				exit;
			}
			else
			{

			$sql = " SELECT nomimpuesto FROM impuestos WHERE nomimpuesto = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["nomimpuesto"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO impuestos values (null, ?, ?, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $nomimpuesto);
				$stmt->bindParam(2, $valorimpuesto);
				$stmt->bindParam(3, $statusimpuesto);
				$stmt->bindParam(4, $fechaimpuesto);

				$nomimpuesto = limpiar($_POST["nomimpuesto"]);
				$valorimpuesto = limpiar($_POST["valorimpuesto"]);
				$statusimpuesto = limpiar($_POST["statusimpuesto"]);
				$fechaimpuesto = limpiar(date("Y-m-d",strtotime($_POST['fechaimpuesto'])));
				$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL IMPUESTO HA SIDO REGISTRADO  EXITOSAMENTE";
			exit;

			} else {

			echo "3";
			exit;
	    }
	}
}
################################ FUNCION REGISTRAR IMPUESTOS #########################

############################ FUNCION LISTAR IMPUESTOS ################################
public function ListarImpuestos()
{
	self::SetNames();
	$sql = "SELECT * FROM impuestos";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################ FUNCION LISTAR IMPUESTOS ################################

############################ FUNCION ID IMPUESTOS #################################
public function ImpuestosPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM impuestos WHERE statusimpuesto = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array("ACTIVO"));
	$num = $stmt->rowCount();
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
}
############################ FUNCION ID IMPUESTOS #################################

############################ FUNCION ACTUALIZAR IMPUESTOS ############################
public function ActualizarImpuestos()
{

	self::SetNames();
	if(empty($_POST["codimpuesto"]) or empty($_POST["nomimpuesto"]) or empty($_POST["valorimpuesto"]) or empty($_POST["statusimpuesto"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT statusimpuesto FROM impuestos WHERE codimpuesto != ? AND statusimpuesto = ? AND statusimpuesto = 'ACTIVO'";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codimpuesto"],$_POST["statusimpuesto"]));
			$num = $stmt->rowCount();
			if($num>0)
			{
				echo "2";
				exit;
			}
			else
			{

			$sql = "SELECT nomimpuesto FROM impuestos WHERE codimpuesto != ? AND nomimpuesto = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codimpuesto"],$_POST["nomimpuesto"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE impuestos set "
				." nomimpuesto = ?, "
				." valorimpuesto = ?, "
				." statusimpuesto = ? "
				." where "
				." codimpuesto = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $nomimpuesto);
				$stmt->bindParam(2, $valorimpuesto);
				$stmt->bindParam(3, $statusimpuesto);
				$stmt->bindParam(4, $codimpuesto);

				$nomimpuesto = limpiar($_POST["nomimpuesto"]);
				$valorimpuesto = limpiar($_POST["valorimpuesto"]);
				$statusimpuesto = limpiar($_POST["statusimpuesto"]);
				$codimpuesto = limpiar($_POST["codimpuesto"]);
				$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL IMPUESTO HA SIDO ACTUALIZADO EXITOSAMENTE";
			exit;

			} else {

			echo "3";
			exit;
		}
	}
}
############################ FUNCION ACTUALIZAR IMPUESTOS ############################

######################### FUNCION ELIMINAR IMPUESTOS #########################
public function EliminarImpuestos()
{
	self::SetNames();
	if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT * FROM impuestos WHERE codimpuesto = ? AND statusimpuesto = 'ACTIVO'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codimpuesto"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM impuestos WHERE codimpuesto = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codimpuesto);
			$codimpuesto = decrypt($_GET["codimpuesto"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
######################## FUNCION ELIMINAR IMPUESTOS ###########################

############################# FIN DE CLASE IMPUESTOS ################################






















################################ CLASE PERFIL DE HOTEL ################################

########################### FUNCION REGISTRAR PERFIL DE HOTEL ###########################
public function RegistrarPerfil()
{
	self::SetNames();
	if(empty($_POST["nomperfil"]) or empty($_POST["descperfil"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT nomperfil FROM perfil WHERE nomperfil = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["nomperfil"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO perfil values (null, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $nomperfil);
				$stmt->bindParam(2, $descperfil);

				$nomperfil = limpiar($_POST["nomperfil"]);
			    $descperfil = limpiar($_POST["descperfil"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL PERFIL DE HOTEL HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

			} else {

			echo "3";
			exit;
	    }
}
###################### FUNCION PARA MOSTRAR INFORMACION HOTEL (ABOUT-INDEX.PHP) #######################
public function ListarPerfilIndex()
{
	self::SetNames();
	$sql = "SELECT * FROM perfil where codperfil=3";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
###################### FUNCION LISTAR PERIFL DE HOTEL #########################
public function ListarPerfil()
{
	self::SetNames();
	$sql = "SELECT * FROM perfil";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
######################## FUNCION LISTAR PERFIL DE HOTEL ######################

############################ FUNCION ID PERFIL DE HOTEL #################################
public function PerfilPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM perfil WHERE codperfil = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codperfil"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID PERFIL DE HOTEL #################################

######################### FUNCION ACTUALIZAR PERFIL DE HOTEL ##########################
public function ActualizarPerfil()
{

	self::SetNames();
	if(empty($_POST["codperfil"]) or empty($_POST["nomperfil"]) or empty($_POST["descperfil"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT nomperfil FROM perfil WHERE codperfil != ? AND nomperfil = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codperfil"],$_POST["nomperfil"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE perfil set "
				." nomperfil = ?, "
				." descperfil = ? "
				." where "
				." codperfil = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $nomperfil);
				$stmt->bindParam(2, $descperfil);
				$stmt->bindParam(3, $codperfil);

				$nomperfil = limpiar($_POST["nomperfil"]);
			    $descperfil = limpiar($_POST["descperfil"]);
			    //$descperfil = limpiar(preg_replace("/\r\n|\r|\n/",'\n',$_POST["descperfil"]));
				$codperfil = limpiar($_POST["codperfil"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL PERFIL DE HOTEL HA SIDO ACTUALIZADO EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}
########################## FUNCION ACTUALIZAR PERFIL DE HOTEL #########################

########################## FUNCION ELIMINAR PERFIL DE HOTEL #############################
public function EliminarPerfil()
{
	self::SetNames();

	if($_SESSION['acceso'] == "administrador") {


			$sql = "DELETE FROM perfil WHERE codperfil = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codperfil);
			$codperfil = decrypt($_GET["codperfil"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
}
########################### FUNCION ELIMINAR PERFIL DE HOTEL ############################

############################ FIN DE CLASE PERFIL DE HOTEL #############################


























################################## CLASE TEMPORADAS #####################################

############################# FUNCION REGISTRAR TEMPORADAS ##########################
public function RegistrarTemporadas()
{
	self::SetNames();
	if(empty($_POST["temporada"]) or empty($_POST["desde"]) or empty($_POST["hasta"]))
	{
		echo "1";
		exit;
	}

		$sql = " SELECT desde FROM temporadas WHERE DATE_FORMAT(desde,'%Y-%m') = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(date("Y-m",strtotime($_POST["desde"]))));
		$num = $stmt->rowCount();
		if($num > 0)
		{
		echo "2";
		exit;
		}
		else
		{
			$sql = " SELECT hasta FROM temporadas WHERE DATE_FORMAT(hasta,'%Y-%m') = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array(date("Y-m",strtotime($_POST["hasta"]))));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO temporadas values (null, ?, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $temporada);
				$stmt->bindParam(2, $desde);
				$stmt->bindParam(3, $hasta);

				$temporada = limpiar($_POST["temporada"]);
				$desde = limpiar(date("Y-m-d",strtotime($_POST['desde'])));
				$hasta = limpiar(date("Y-m-d",strtotime($_POST['hasta'])));
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA TEMPORADA HA SIDO REGISTRADA EXITOSAMENTE";
			exit;

			} else {

			echo "3";
			exit;
	    }
	}
}
########################### FUNCION REGISTRAR TEMPORADAS ##########################

############################# FUNCION LISTAR TEMPORADAS ############################
public function ListarTemporadas()
{
	self::SetNames();
	$sql = "SELECT * FROM temporadas ORDER BY desde DESC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################# FUNCION LISTAR TEMPORADAS ##############################

############################ FUNCION TEMPORADAS #################################
 public function TemporadasAgrupadas()
 {
 	self::SetNames();
		//$sql = " SELECT GROUP_CONCAT(DATE_FORMAT(desde,'%d-%m-%Y') SEPARATOR '<br> ') as fecha_desde, GROUP_CONCAT(DATE_FORMAT(hasta,'%d-%m-%Y') SEPARATOR '<br> ') as fecha_hasta, temporada FROM temporadas GROUP BY temporada DESC LIMIT 0,6";
 	$sql = " SELECT 
 	GROUP_CONCAT(DISTINCT DATE_FORMAT(desde,'%m') SEPARATOR ', ') as meses, temporada 
 	FROM temporadas GROUP BY temporada DESC";
 	foreach ($this->dbh->query($sql) as $row)
 	{
 		$this->p[] = $row;
 	}
 	return $this->p;
 	$this->dbh=null;
 }
############################ FUNCION TEMPORADAS #################################

############################ FUNCION ID TEMPORADAS #################################
public function TemporadasPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM temporadas WHERE codtemporada = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codtemporada"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID TEMPORADAS #################################

############################ FUNCION ACTUALIZAR TEMPORADAS ############################
public function ActualizarTemporadas()
{
	self::SetNames();
	if(empty($_POST["codtemporada"]) or empty($_POST["temporada"]) or empty($_POST["desde"]) or empty($_POST["hasta"]))
	{
		echo "1";
		exit;
	}

	$sql = " SELECT desde FROM temporadas WHERE codtemporada != ? AND DATE_FORMAT(desde,'%Y-%m') = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codtemporada"],date("Y-m",strtotime($_POST["desde"]))));
	$num = $stmt->rowCount();
	if($num > 0)
	{
	echo "2";
	exit;
	}
	else
	{
		$sql = " SELECT hasta FROM temporadas WHERE codtemporada != ? AND DATE_FORMAT(hasta,'%Y-%m') = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codtemporada"],date("Y-m",strtotime($_POST["hasta"]))));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$sql = " UPDATE temporadas set "
			." temporada = ?, "
			." desde = ?, "
			." hasta = ? "
			." where "
			." codtemporada = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $temporada);
			$stmt->bindParam(2, $desde);
			$stmt->bindParam(3, $hasta);
			$stmt->bindParam(4, $codtemporada);

			$temporada = limpiar($_POST["temporada"]);
			$desde = limpiar(date("Y-m-d",strtotime($_POST['desde'])));
			$hasta = limpiar(date("Y-m-d",strtotime($_POST['hasta'])));
			$codtemporada = limpiar($_POST["codtemporada"]);
			$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA TEMPORADA HA SIDO ACTUALIZADA EXITOSAMENTE";
			exit;

			} else {

			echo "3";
			exit;
		}
	}
}
############################ FUNCION ACTUALIZAR TEMPORADAS ############################

############################ FUNCION ELIMINAR TEMPORADAS #################################
public function EliminarTemporada()
{
	self::SetNames();
	if($_SESSION['acceso'] == "administrador") {

	$sql = "DELETE FROM temporadas WHERE codtemporada = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1,$codtemporada);
	$codtemporada = decrypt($_GET["codtemporada"]);
	$stmt->execute();

		echo "1";
		exit;

	} else {
	   
		echo "2";
		exit;
	 } 	
}
############################## FUNCION ELIMINAR TEMPORADAS ############################

############################ FIN DE CLASE TEMPORADAS ################################


















################################# CLASE NOTICIAS ######################################

############################## FUNCION REGISTRAR NOTICIAS ##############################
public function RegistrarNoticias()
{
	self::SetNames();
	if(empty($_POST["titulonoticia"]) or empty($_POST["descripcnoticia"]) or empty($_POST["statusnoticia"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT titulonoticia FROM noticias WHERE titulonoticia = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["titulonoticia"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO noticias values (null, ?, ?, ?, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $titulonoticia);
				$stmt->bindParam(2, $descripcnoticia);
				$stmt->bindParam(3, $publicado);
				$stmt->bindParam(4, $statusnoticia);
				$stmt->bindParam(5, $codigo);

				$titulonoticia = limpiar($_POST["titulonoticia"]);
			    $descripcnoticia = limpiar(preg_replace("/\r\n|\r|\n/",'\n',$_POST["descripcnoticia"]));
if (limpiar($_POST["statusnoticia"]=='PUBLICADA')) { $publicado = limpiar(date("Y-m-d h:i:s")); } else { $publicado = limpiar("0000-00-00 00:00:00"); }
			    $statusnoticia = limpiar($_POST["statusnoticia"]);
			    $codigo = limpiar($_SESSION["codigo"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA NOTICIA HA SIDO REGISTRADA EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
	    }
}
############################## FUNCION REGISTRAR NOTICIAS ###############################

############################## FUNCION LISTAR NOTICIAS ################################
public function ListarNoticias()
{
	self::SetNames();
	$sql = "SELECT * FROM noticias INNER JOIN usuarios ON noticias.codigo = usuarios.codigo ORDER BY publicado DESC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################## FUNCION LISTAR NOTICIAS #############################

########################### FUNCION LISTAR NOTICIAS ACTIVAS ############################
public function ListarNoticiasActivas()
{
	self::SetNames();
	$sql = "SELECT * FROM noticias INNER JOIN usuarios ON noticias.codigo = usuarios.codigo WHERE noticias.statusnoticia = 'PUBLICADA' ORDER BY publicado DESC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################ FUNCION LISTAR NOTICIAS ACTIVAS ############################

############################ FUNCION ID NOTICIAS #################################
public function NoticiasPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM noticias INNER JOIN usuarios ON noticias.codigo = usuarios.codigo WHERE noticias.codnoticia = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codnoticia"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID NOTICIAS #################################

############################ FUNCION ACTUALIZAR NOTICIAS ############################
public function ActualizarNoticias()
{

	self::SetNames();
	if(empty($_POST["codnoticia"]) or empty($_POST["titulonoticia"]) or empty($_POST["descripcnoticia"]) or empty($_POST["statusnoticia"]))
	{
		echo "1";
		exit;
	}

			$sql = " SELECT titulonoticia FROM noticias WHERE codnoticia != ? AND titulonoticia = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codnoticia"],$_POST["titulonoticia"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE noticias set "
				." titulonoticia = ?, "
				." descripcnoticia = ?, "
				." publicado = ?, "
				." statusnoticia = ? "
				." where "
				." codnoticia = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $titulonoticia);
				$stmt->bindParam(2, $descripcnoticia);
				$stmt->bindParam(3, $publicado);
				$stmt->bindParam(4, $statusnoticia);
				$stmt->bindParam(5, $codnoticia);

				$titulonoticia = limpiar($_POST["titulonoticia"]);
			    $descripcnoticia = limpiar(preg_replace("/\r\n|\r|\n/",'\n',$_POST["descripcnoticia"]));
if (limpiar($_POST["statusnoticia"]=='PUBLICADA')) { $publicado = limpiar(date("Y-m-d h:i:s")); } else { $publicado = limpiar("0000-00-00 00:00:00"); }
			    $statusnoticia = limpiar($_POST["statusnoticia"]);
				$codnoticia = limpiar($_POST["codnoticia"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA NOTICIA HA SIDO ACTUALIZADA EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}
############################ FUNCION ACTUALIZAR NOTICIAS ############################

############################ FUNCION ELIMINAR NOTICIAS #################################
public function EliminarNoticias()
{
	self::SetNames();
	if($_SESSION['acceso'] == "administrador") {

			$sql = "DELETE FROM noticias WHERE codnoticia = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codnoticia);
			$codnoticia = decrypt($_GET["codnoticia"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 	
}
############################## FUNCION ELIMINAR NOTICIAS ############################

############################## FIN DE CLASE NOTICIAS ###################################

























########################## CLASE TIPOS DE HABITACIONES #############################

######################## FUNCION REGISTRAR TIPOS DE HABITACIONES ########################
public function RegistrarTipos()
{
	self::SetNames();
	if(empty($_POST["nomtipo"]))
	{
		echo "1";
		exit;
	}
	$sql = " SELECT nomtipo FROM tiposhabitaciones WHERE nomtipo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["nomtipo"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$query = " INSERT INTO tiposhabitaciones values (null, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $nomtipo);

		$nomtipo = limpiar($_POST["nomtipo"]);
		$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL TIPO DE HABITACI&Oacute;N HA SIDO REGISTRADO EXITOSAMENTE";
		exit;

		} else {

		echo "2";
		exit;
    }
}
####################### FUNCION REGISTRAR TIPOS DE HABITACIONES #######################

######################## FUNCION LISTAR TIPOS DE HABITACIONES ##########################
public function ListarTipos()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposhabitaciones";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
######################### FUNCION LISTAR TIPOS DE HABITACIONES #########################

######################### FUNCION ID TIPOS DE HABITACIONES ##########################
public function TiposPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM tiposhabitaciones WHERE codtipo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codtipo"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
######################## FUNCION ID TIPOS DE HABITACIONES #########################

####################### FUNCION ACTUALIZAR TIPOS DE HABITACIONES ######################
public function ActualizarTipos()
{

	self::SetNames();
	if(empty($_POST["codtipo"]) or empty($_POST["nomtipo"]))
	{
		echo "1";
		exit;
	}
	$sql = " SELECT nomtipo FROM tiposhabitaciones WHERE codtipo != ? AND nomtipo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codtipo"],$_POST["nomtipo"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$sql = " UPDATE tiposhabitaciones set "
		." nomtipo = ? "
		." where "
		." codtipo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $nomtipo);
		$stmt->bindParam(2, $codtipo);

		$nomtipo = limpiar($_POST["nomtipo"]);
		$codtipo = limpiar($_POST["codtipo"]);
		$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL TIPO DE HABITACI&Oacute;N HA SIDO ACTUALIZADO EXITOSAMENTE";
		exit;

		} else {

		echo "2";
		exit;
	}
}
##################### FUNCION ACTUALIZAR TIPOS DE HABITACIONES ########################

####################### FUNCION ELIMINAR TIPOS DE HABITACIONES ########################
public function EliminarTipos()
{
	self::SetNames();
	if($_SESSION['acceso'] == "administrador") {

	$sql = "SELECT codtipo FROM tarifas WHERE codtipo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codtipo"])));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$sql = "DELETE FROM tiposhabitaciones WHERE codtipo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codtipo);
		$codtipo = decrypt($_GET["codtipo"]);
		$stmt->execute();

		echo "1";
		exit;

	} else {
		   
		echo "2";
		exit;
	} 
			
	} else {
		
		echo "3";
		exit;
	}	
}
######################## FUNCION ELIMINAR TIPOS DE HABITACIONES #######################

######################### FIN DE CLASE TIPOS DE HABITACIONES ##########################
























############################ CLASE TARIFAS DE HABITACIONES ############################

###################### FUNCION REGISTRAR TARIFAS DE HABITACIONES #######################
public function RegistrarTarifas()
{
	self::SetNames();
	if(empty($_POST["codtipo"]) or empty($_POST["baja"]) or empty($_POST["media"]) or empty($_POST["alta"]))
	{
		echo "1";
		exit;
	}
	else if($_POST["baja"]=="0.00" or $_POST["media"]=="0.00" or $_POST["alta"]=="0.00")
		{
		    echo "2";
			exit;
		} 

			$sql = " SELECT codtipo FROM tarifas WHERE codtipo = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codtipo"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$query = " INSERT INTO tarifas values (null, ?, ?, ?, ?);";
				$stmt = $this->dbh->prepare($query);
				$stmt->bindParam(1, $codtipo);
				$stmt->bindParam(2, $baja);
				$stmt->bindParam(3, $media);
				$stmt->bindParam(4, $alta);

				$codtipo = limpiar($_POST["codtipo"]);
				$baja = limpiar($_POST["baja"]);
				$media = limpiar($_POST["media"]);
				$alta = limpiar($_POST["alta"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA TARIFA DE HABITACI&Oacute;N HA SIDO REGISTRADA EXITOSAMENTE";
			exit;

			} else {

			echo "3";
			exit;
	    }
}
####################### FUNCION REGISTRAR TARIFAS DE HABITACIONES ######################

####################### FUNCION LISTAR TARIFAS DE HABITACIONES ########################
public function ListarTarifas()
{
	self::SetNames();
	$sql = "SELECT * FROM tarifas INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
####################### FUNCION LISTAR TARIFAS DE HABITACIONES ########################

######################## FUNCION ID TARIFAS DE HABITACIONES ###########################
public function TarifasPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM tarifas INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo WHERE tarifas.codtarifa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codtarifa"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################## FUNCION ID TARIFAS DE HABITACIONES #######################

###################### FUNCION ACTUALIZAR TARIFAS DE HABITACIONES #######################
public function ActualizarTarifas()
{

	self::SetNames();
	if(empty($_POST["codtarifa"]) or empty($_POST["codtipo"]) or empty($_POST["baja"]) or empty($_POST["media"]) or empty($_POST["alta"]))
	{
		echo "1";
		exit;
	}
	else if($_POST["baja"]=="0.00" or $_POST["media"]=="0.00" or $_POST["alta"]=="0.00")
		{
		    echo "2";
			exit;
		} 

			$sql = " SELECT codtipo FROM tarifas WHERE codtarifa != ? AND codtipo = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array($_POST["codtarifa"],$_POST["codtipo"]));
			$num = $stmt->rowCount();
			if($num == 0)
			{
				$sql = " UPDATE tarifas set "
				." codtipo = ?, "
				." baja = ?, "
				." media = ?, "
				." alta = ? "
				." where "
				." codtarifa = ?;
				";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindParam(1, $codtipo);
				$stmt->bindParam(2, $baja);
				$stmt->bindParam(3, $media);
				$stmt->bindParam(4, $alta);
				$stmt->bindParam(5, $codtarifa);

				$codtipo = limpiar($_POST["codtipo"]);
				$baja = limpiar($_POST["baja"]);
				$media = limpiar($_POST["media"]);
				$alta = limpiar($_POST["alta"]);
				$codtarifa = limpiar($_POST["codtarifa"]);
				$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL TARIFA DE HABITACI&Oacute;N HA SIDO ACTUALIZADA EXITOSAMENTE";
			exit;

			} else {

			echo "2";
			exit;
		}
}
###################### FUNCION ACTUALIZAR TARIFAS DE HABITACIONES #######################

####################### FUNCION ELIMINAR TARIFAS DE HABITACIONES #######################
public function EliminarTarifas()
{
	self::SetNames();

	if($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codtarifa FROM habitaciones WHERE codtarifa = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codtarifa"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM tarifas WHERE codtarifa = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codtarifa);
			$codtarifa = decrypt($_GET["codtarifa"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
######################## FUNCION ELIMINAR TARIFAS DE HABITACIONES ######################

######################### FIN DE CLASE TARIFAS DE HABITACIONES #########################
























################################ CLASE HABITACIONES ##################################

############################ FUNCION REGISTRAR HABITACIONES ###########################
public function RegistrarHabitaciones()
{
	self::SetNames();
	if(empty($_POST["numhabitacion"]) or empty($_POST["descriphabitacion"]) or empty($_POST["piso"]) or empty($_POST["vista"]) or empty($_POST["codtarifa"]))
	{
		echo "1";
		exit;
	}

	$sql = "SELECT codhabitacion FROM habitaciones ORDER BY idhabitacion DESC LIMIT 1";
	foreach ($this->dbh->query($sql) as $row){

		$id=$row["codhabitacion"];

	}
	if(empty($id))
	{
		$codhabitacion = "H1";

	} else {

		$resto = substr($id, 0, 1);
		$coun = strlen($resto);
		$num     = substr($id, $coun);
		$codigo     = $num + 1;
		$codhabitacion = "H".$codigo;
	}

	$sql = "SELECT numhabitacion FROM habitaciones WHERE numhabitacion = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["numhabitacion"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		
		if (isset($_FILES["file"]))
		{
			$autoinc = 1;
			foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ) {

			$file_name = $_FILES['file']['name'][$key];
			$file_size =$_FILES['file']['size'][$key];
			$file_tmp =$_FILES['file']['tmp_name'][$key];
			$file_type=$_FILES['file']['type'][$key];

			if ($file_type == ''){  }

    //valido que los archivos cargados sean imagenes con extension jpeg,jpg,png,gif
			elseif ($file_type != '' && $file_type != 'image/jpeg' && $file_type != 'image/jpg' && $file_type != 'image/JPEG' && $file_type != 'image/JPG')

			{

    //si los archivos cargados no son imagenes muestro un mensaje de error de carga
				echo "2";
				exit;

			} else {

				if (is_dir('./fotos/habitaciones/'.$codhabitacion)) {

            //guardo las imagenes cargadas en la carpeta que se creo
			move_uploaded_file($file_tmp,"./fotos/habitaciones/".$codhabitacion."/".$file_name);

            //Ruta de la imagen original
			$rutaImagenOriginal="./fotos/habitaciones/".$codhabitacion."/".$_FILES['file']['name'][$key];

            //Nuevo nombre
			//$rutaImagenRedimen="./fotos/".$_POST["codhabitacion"]."/{$autoinc}.".pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
			$rutaImagenRedimen="./fotos/habitaciones/".$codhabitacion."/{$autoinc}.JPG";

            //Creamos una variable imagen a partir de la imagen original
			$img_original = imagecreatefromjpeg($rutaImagenOriginal);

            //Se define el maximo ancho o alto que tendra la imagen final
			$max_ancho = 400;
			$max_alto = 200;

            //Ancho y alto de la imagen original
			list($ancho,$alto)=getimagesize($rutaImagenOriginal);

            //Se calcula ancho y alto de la imagen final
			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;

            //Si el ancho y el alto de la imagen no superan los maximos,
            //ancho final y alto final son los que tiene actualmente
            if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
            	$ancho_final = $ancho;
            	$alto_final = $alto;
            }
            /*
            * si proporcion horizontal*alto mayor que el alto maximo,
            * alto final es alto por la proporcion horizontal
            * es decir, le quitamos al alto, la misma proporcion que
            * le quitamos al alto
            *
            */
            elseif (($x_ratio * $alto) < $max_alto){
            	$alto_final = ceil($x_ratio * $alto);
            	$ancho_final = $max_ancho;
            }
            /*
            * Igual que antes pero a la inversa
            */
            else{
            	$ancho_final = ceil($y_ratio * $ancho);
            	$alto_final = $max_alto;
            }

            //Creamos una imagen en blanco de tamaño $ancho_final por $alto_final .
            $tmp=imagecreatetruecolor($ancho_final,$alto_final);

            //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
            imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

            //Se destruye variable $img_original para liberar memoria
            imagedestroy($img_original);

            unlink($rutaImagenOriginal);

            //Definimos la calidad de la imagen final
            $calidad=95;


            //Se crea la imagen final en el directorio indicado
            imagejpeg($tmp,$rutaImagenRedimen,$calidad);

        } else {

            //creo la carpeta donde guardare las imagenes cargadas
        	$dirmake = mkdir('./fotos/habitaciones/'.$codhabitacion, 0777);

        	$pathInfo = pathinfo($file_name);
        	$sum=1;
            //guardo las imagenes cargadas en la carpeta que se creo
        	move_uploaded_file($file_tmp,"./fotos/habitaciones/".$codhabitacion."/".$file_name);

            //Ruta de la imagen original
        	$rutaImagenOriginal="./fotos/habitaciones/".$codhabitacion."/".$_FILES['file']['name'][$key];

            //Nuevo nombre
			//$rutaImagenRedimen="./fotos/".$_POST["codhabitacion"]."/{$autoinc}.".pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
        	$rutaImagenRedimen="./fotos/habitaciones/".$codhabitacion."/{$autoinc}.JPG";

            //Creamos una variable imagen a partir de la imagen original
        	$img_original = imagecreatefromjpeg($rutaImagenOriginal);

            //Se define el maximo ancho o alto que tendra la imagen final
        	$max_ancho = 400;
        	$max_alto = 200;

            //Ancho y alto de la imagen original
        	list($ancho,$alto)=getimagesize($rutaImagenOriginal);

            //Se calcula ancho y alto de la imagen final
        	$x_ratio = $max_ancho / $ancho;
        	$y_ratio = $max_alto / $alto;

            //Si el ancho y el alto de la imagen no superan los maximos,
            //ancho final y alto final son los que tiene actualmente
            if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
            	$ancho_final = $ancho;
            	$alto_final = $alto;
            }
            /*
            * si proporcion horizontal*alto mayor que el alto maximo,
            * alto final es alto por la proporcion horizontal
            * es decir, le quitamos al alto, la misma proporcion que
            * le quitamos al alto
            *
            */
            elseif (($x_ratio * $alto) < $max_alto){
            	$alto_final = ceil($x_ratio * $alto);
            	$ancho_final = $max_ancho;
            }
            /*
            * Igual que antes pero a la inversa
            */
            else{
            	$ancho_final = ceil($y_ratio * $ancho);
            	$alto_final = $max_alto;
            }

            //Creamos una imagen en blanco de tamaño $ancho_final por $alto_final .
            $tmp=imagecreatetruecolor($ancho_final,$alto_final);

            //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
            imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

            //Se destruye variable $img_original para liberar memoria
            imagedestroy($img_original);

            unlink($rutaImagenOriginal);

            //Definimos la calidad de la imagen final
            $calidad=95;

            //Se crea la imagen final en el directorio indicado
            imagejpeg($tmp,$rutaImagenRedimen,$calidad);

           }
        }

           $autoinc++;

           }
        }

        $query = " INSERT INTO habitaciones values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codhabitacion);
	    $stmt->bindParam(2, $numhabitacion);
		$stmt->bindParam(3, $descriphabitacion);
		$stmt->bindParam(4, $piso);
		$stmt->bindParam(5, $vista);
		$stmt->bindParam(6, $maxadultos);
		$stmt->bindParam(7, $maxninos);
		$stmt->bindParam(8, $codtarifa);
		$stmt->bindParam(9, $deschabitacion);
		$stmt->bindParam(10, $statushab);
		
		$numhabitacion = limpiar($_POST["numhabitacion"]);
		$descriphabitacion = limpiar($_POST["descriphabitacion"]);
		$piso = limpiar($_POST["piso"]);
		$vista = limpiar($_POST["vista"]);
		$maxadultos = limpiar($_POST["maxadultos"]);
		$maxninos = limpiar($_POST["maxninos"]);
		$codtarifa = limpiar($_POST["codtarifa"]);
		$deschabitacion = limpiar($_POST["deschabitacion"]);
		$statushab = limpiar($_POST["statushab"]);
		$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> LA HABITACI&Oacute;N HA SIDO REGISTRADO EXITOSAMENTE";
		exit;

	} else {

		echo "3";
		exit;
	}
}
############################# FUNCION REGISTRAR HABITACIONES ###########################

############################# FUNCION LISTAR HABITACIONES #############################
public function ListarHabitaciones()
	{
	self::SetNames();
	$sql = "SELECT * FROM habitaciones 
	INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
	INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo 
	ORDER BY habitaciones.codhabitacion ASC";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
############################# FUNCION LISTAR HABITACIONES ###########################

################### FUNCION LISTAR HABITACIONES AGRUPADAS POR TIPOS #################
public function ListarHabitacionesxTipos()
	{
	self::SetNames();
	$sql = "SELECT * FROM tiposhabitaciones";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
##################### FUNCION DESCRIPCION HABITACIONES ##################
public function MostrarDescripciones($valorFiltro)
{
    self::SetNames();
    $sql = "SELECT * FROM tiposhabitaciones WHERE nomtipo = :nom";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':nom', $valorFiltro);
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->p[] = $row;
    }
    
    $this->dbh = null;
    return $this->p;
}
########################## FUNCION ID HABITACIONES #################################

public function ListarComodidades($valorFiltro)
{
    self::SetNames();
    $sql = "SELECT * FROM habitacion_comodidad h1 INNER JOIN comodidad h2 ON h1.comodidad_id = h2.id JOIN tiposhabitaciones t1 ON t1.codtipo= h1.habitacion_id WHERE t1.nomtipo= :nom";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':nom', $valorFiltro);
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->p[] = $row;
    }
    
    $this->dbh = null;
    return $this->p;
}



########################## FUNCION ID HABITACIONES #################################
public function HabitacionesPorId()
{
	self::SetNames();
	$sql = " SELECT 
	habitaciones.idhabitacion,
	habitaciones.codhabitacion, 
	habitaciones.numhabitacion, 
	habitaciones.descriphabitacion, 
	habitaciones.piso, 
	habitaciones.vista, 
	habitaciones.maxadultos, 
	habitaciones.maxninos, 
	habitaciones.codtarifa, 
	habitaciones.deschabitacion, 
	habitaciones.statushab, 
	reservaciones.reservacion,
	tiposhabitaciones.nomtipo, 
	tarifas.baja, 
	tarifas.media, 
	tarifas.alta 
	FROM habitaciones INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
	INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo 
	LEFT JOIN detallereservaciones ON habitaciones.codhabitacion = detallereservaciones.codhabitacion 
	LEFT JOIN reservaciones ON detallereservaciones.codreservacion = reservaciones.codreservacion
	WHERE habitaciones.codhabitacion = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["h"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID HABITACIONES #################################

############################ FUNCION ACTUALIZAR HABITACIONES ############################
public function ActualizarHabitaciones()
{
    self::SetNames();
	if(empty($_POST["codhabitacion"]) or empty($_POST["numhabitacion"]) or empty($_POST["descriphabitacion"]) or empty($_POST["piso"]) or empty($_POST["vista"]) or empty($_POST["codtarifa"]))
	{
		echo "1";
		exit;
	}

	$sql = "SELECT numhabitacion FROM habitaciones WHERE codhabitacion != ? AND numhabitacion = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codhabitacion"],$_POST["numhabitacion"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{

		if (isset($_FILES["file"]))
		{
			$autoinc = 1;
			foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ) {

			$file_name = $_FILES['file']['name'][$key];
			$file_size =$_FILES['file']['size'][$key];
			$file_tmp =$_FILES['file']['tmp_name'][$key];
			$file_type=$_FILES['file']['type'][$key];

			if ($file_type == ''){  }

    //valido que los archivos cargados sean imagenes con extension jpeg,jpg,png,gif
			elseif ($file_type != '' && $file_type != 'image/jpeg' && $file_type != 'image/jpg' && $file_type != 'image/JPEG' && $file_type != 'image/JPG')

			{

    //si los archivos cargados no son imagenes muestro un mensaje de error de carga
				echo "2";
				exit;

			} else {

			if (is_dir('./fotos/habitaciones/'.$_POST["codhabitacion"])) {

            //guardo las imagenes cargadas en la carpeta que se creo
			move_uploaded_file($file_tmp,"./fotos/habitaciones/".$_POST["codhabitacion"]."/".$file_name);

            //Ruta de la imagen original
			$rutaImagenOriginal="./fotos/habitaciones/".$_POST["codhabitacion"]."/".$_FILES['file']['name'][$key];

            //Nuevo nombre
			//$rutaImagenRedimen="./fotos/".$_POST["codhabitacion"]."/{$autoinc}.".pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
			$rutaImagenRedimen="./fotos/habitaciones/".$_POST["codhabitacion"]."/{$autoinc}.JPG";

            //Creamos una variable imagen a partir de la imagen original
			$img_original = imagecreatefromjpeg($rutaImagenOriginal);

            //Se define el maximo ancho o alto que tendra la imagen final
			$max_ancho = 400;
			$max_alto = 200;

            //Ancho y alto de la imagen original
			list($ancho,$alto)=getimagesize($rutaImagenOriginal);

            //Se calcula ancho y alto de la imagen final
			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;

            //Si el ancho y el alto de la imagen no superan los maximos,
            //ancho final y alto final son los que tiene actualmente
            if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
            	$ancho_final = $ancho;
            	$alto_final = $alto;
            }
            /*
            * si proporcion horizontal*alto mayor que el alto maximo,
            * alto final es alto por la proporcion horizontal
            * es decir, le quitamos al alto, la misma proporcion que
            * le quitamos al alto
            *
            */
            elseif (($x_ratio * $alto) < $max_alto){
            	$alto_final = ceil($x_ratio * $alto);
            	$ancho_final = $max_ancho;
            }
            /*
            * Igual que antes pero a la inversa
            */
            else{
            	$ancho_final = ceil($y_ratio * $ancho);
            	$alto_final = $max_alto;
            }

            //Creamos una imagen en blanco de tamaño $ancho_final por $alto_final .
            $tmp=imagecreatetruecolor($ancho_final,$alto_final);

            //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
            imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

            //Se destruye variable $img_original para liberar memoria
            imagedestroy($img_original);

            unlink($rutaImagenOriginal);

            //Definimos la calidad de la imagen final
            $calidad=95;


            //Se crea la imagen final en el directorio indicado
            imagejpeg($tmp,$rutaImagenRedimen,$calidad);

        } else {

            //creo la carpeta donde guardare las imagenes cargadas
        	$dirmake = mkdir('./fotos/habitaciones/'.$_POST["codhabitacion"], 0777);

        	$pathInfo = pathinfo($file_name);
        	$sum=1;
            //guardo las imagenes cargadas en la carpeta que se creo
        	move_uploaded_file($file_tmp,"./fotos/habitaciones/".$_POST["codhabitacion"]."/".$file_name);

            //Ruta de la imagen original
        	$rutaImagenOriginal="./fotos/habitaciones/".$_POST["codhabitacion"]."/".$_FILES['file']['name'][$key];

            //Nuevo nombre
			//$rutaImagenRedimen="./fotos/".$_POST["codhabitacion"]."/{$autoinc}.".pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
        	$rutaImagenRedimen="./fotos/habitaciones/".$_POST["codhabitacion"]."/{$autoinc}.JPG";

            //Creamos una variable imagen a partir de la imagen original
        	$img_original = imagecreatefromjpeg($rutaImagenOriginal);

            //Se define el maximo ancho o alto que tendra la imagen final
        	$max_ancho = 400;
        	$max_alto = 200;

            //Ancho y alto de la imagen original
        	list($ancho,$alto)=getimagesize($rutaImagenOriginal);

            //Se calcula ancho y alto de la imagen final
        	$x_ratio = $max_ancho / $ancho;
        	$y_ratio = $max_alto / $alto;

            //Si el ancho y el alto de la imagen no superan los maximos,
            //ancho final y alto final son los que tiene actualmente
            if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
            	$ancho_final = $ancho;
            	$alto_final = $alto;
            }
            /*
            * si proporcion horizontal*alto mayor que el alto maximo,
            * alto final es alto por la proporcion horizontal
            * es decir, le quitamos al alto, la misma proporcion que
            * le quitamos al alto
            *
            */
            elseif (($x_ratio * $alto) < $max_alto){
            	$alto_final = ceil($x_ratio * $alto);
            	$ancho_final = $max_ancho;
            }
            /*
            * Igual que antes pero a la inversa
            */
            else{
            	$ancho_final = ceil($y_ratio * $ancho);
            	$alto_final = $max_alto;
            }

            //Creamos una imagen en blanco de tamaño $ancho_final por $alto_final .
            $tmp=imagecreatetruecolor($ancho_final,$alto_final);

            //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
            imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

            //Se destruye variable $img_original para liberar memoria
            imagedestroy($img_original);

            unlink($rutaImagenOriginal);

            //Definimos la calidad de la imagen final
            $calidad=95;

            //Se crea la imagen final en el directorio indicado
            imagejpeg($tmp,$rutaImagenRedimen,$calidad);

           }
        }

           $autoinc++;

           }
        }


		$sql = "UPDATE habitaciones set "
		." numhabitacion = ?, "
		." descriphabitacion = ?, "
		." piso = ?, "
		." vista = ?, "
		." maxadultos = ?, "
		." maxninos = ?, "
		." codtarifa = ?, "
		." deschabitacion = ?, "
		." statushab = ? "
		." where "
		." codhabitacion = ?;
		";
		$stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $numhabitacion);
		$stmt->bindParam(2, $descriphabitacion);
		$stmt->bindParam(3, $piso);
		$stmt->bindParam(4, $vista);
		$stmt->bindParam(5, $maxadultos);
		$stmt->bindParam(6, $maxninos);
		$stmt->bindParam(7, $codtarifa);
		$stmt->bindParam(8, $deschabitacion);
		$stmt->bindParam(9, $statushab);
		$stmt->bindParam(10, $codhabitacion);
		
		$numhabitacion = limpiar($_POST["numhabitacion"]);
		$descriphabitacion = limpiar($_POST["descriphabitacion"]);
		$piso = limpiar($_POST["piso"]);
		$vista = limpiar($_POST["vista"]);
		$maxadultos = limpiar($_POST["maxadultos"]);
		$maxninos = limpiar($_POST["maxninos"]);
		$codtarifa = limpiar($_POST["codtarifa"]);
		$deschabitacion = limpiar($_POST["deschabitacion"]);
		$statushab = limpiar($_POST["statushab"]);
		$codhabitacion = limpiar($_POST["codhabitacion"]);
		$stmt->execute();
    
	echo "<span class='fa fa-check-square-o'></span> LA HABITACI&Oacute;N HA SIDO ACTUALIZADA EXITOSAMENTE";
	exit;

	} else {

		echo "3";
		exit;
	}
}
############################ FUNCION ACTUALIZAR HABITACIONES ############################

########################## FUNCION ELIMINAR HABITACIONES #########################
	public function EliminarHabitaciones()
	{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codhabitacion FROM detallereservaciones WHERE codhabitacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codhabitacion"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM habitaciones where codhabitacion = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codhabitacion);
			$codhabitacion = decrypt($_GET["codhabitacion"]);
			$stmt->execute();

			//funcion para eliminar una carpeta con contenido
			$codhabitacion = decrypt($_GET["codhabitacion"]);
			$carpeta = "./fotos/habitaciones/".$codhabitacion;		
			$borrarRaiz = true; #true: deja la carpeta pero elimina el contenido. false: borra todo
			$rta = deldir($carpeta, $borrarRaiz);    

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
############################# FUNCION ELIMINAR HABITACIONES ##########################

############################# FIN DE CLASE HABITACIONES ###########################































############################### CLASE CLIENTES ####################################

################################ FUNCION CARGAR CLIENTES ################################
	public function CargarClientes()
	{
		self::SetNames();
		if(empty($_FILES["sel_file"]))
		{
			echo "1";
			exit;
		}
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         //echo 'Cargando nombre del archivo: '.$fname.' ';
         $chk_ext = explode(".",$fname);
         
        if(strtolower(end($chk_ext)) == "csv")
        {
        //si es correcto, entonces damos permisos de lectura para subir
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $this->dbh->beginTransaction();
        
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

               //Insertamos los datos con los valores...
			   
		$query = "INSERT INTO clientes values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcliente);
		$stmt->bindParam(2, $documcliente);
		$stmt->bindParam(3, $dnicliente);
		$stmt->bindParam(4, $nomcliente);
		$stmt->bindParam(5, $paiscliente);
		$stmt->bindParam(6, $ciudadcliente);
		$stmt->bindParam(7, $direccliente);
		$stmt->bindParam(8, $telefcliente);
		$stmt->bindParam(9, $correocliente);
		$stmt->bindParam(10, $passwordcliente);
		$stmt->bindParam(11, $limitecredito);
		$stmt->bindParam(12, $fechaingreso);

		$codcliente = limpiar($data[0]);
		$documcliente = limpiar($data[1]);
		$dnicliente = limpiar($data[2]);
		$nomcliente = limpiar($data[3]);
		$paiscliente = limpiar($data[4]);
		$ciudadcliente = limpiar($data[5]);
		$direccliente = limpiar($data[6]);
		$telefcliente = limpiar($data[7]);
		$correocliente = limpiar($data[8]);
		$passwordcliente = sha1(md5($data[2]));
		$limitecredito = limpiar($data[10]);
		$fechaingreso = limpiar(date("Y-m-d"));
		$stmt->execute();
				
        }
           $this->dbh->commit();
           //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
           fclose($handle);
	        
	echo "<span class='fa fa-check-square-o'></span> LA CARGA MASIVA DE CLIENTES FUE REALIZADA EXITOSAMENTE";
	exit;
             
         }
         else
         {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para ver si esta separado por " , "
         echo "2";
		 exit;
      }  
}
############################### FUNCION CARGAR CLIENTES ################################

############################# FUNCION REGISTRAR CLIENTES ###############################
public function RegistrarClientes()
{
	self::SetNames();
	if(empty($_POST["dnicliente"]) or empty($_POST["nomcliente"]) or empty($_POST["paiscliente"]))
	{
		echo "1";
		exit;
	}

	$sql = "SELECT codcliente FROM clientes ORDER BY idcliente DESC LIMIT 1";
	foreach ($this->dbh->query($sql) as $row){

		$id=$row["codcliente"];

	}
	if(empty($id))
	{
		$codcliente = "C1";

	} else {

		$resto = substr($id, 0, 1);
		$coun = strlen($resto);
		$num     = substr($id, $coun);
		$codigo     = $num + 1;
		$codcliente = "C".$codigo;
	}

	$sql = "SELECT dnicliente FROM clientes WHERE dnicliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["dnicliente"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$query = " INSERT INTO clientes values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcliente);
	    $stmt->bindParam(2, $documcliente);
		$stmt->bindParam(3, $dnicliente);
		$stmt->bindParam(4, $nomcliente);
		$stmt->bindParam(5, $paiscliente);
		$stmt->bindParam(6, $ciudadcliente);
		$stmt->bindParam(7, $direccliente);
		$stmt->bindParam(8, $telefcliente);
		$stmt->bindParam(9, $correocliente);
		$stmt->bindParam(10, $passwordcliente);
		$stmt->bindParam(11, $limitecredito);
		$stmt->bindParam(12, $fechaingreso);
		
		$documcliente = limpiar($_POST["documcliente"]);
		$dnicliente = limpiar($_POST["dnicliente"]);
		$nomcliente = limpiar($_POST["nomcliente"]);
		$paiscliente = limpiar($_POST["paiscliente"]);
		$ciudadcliente = limpiar($_POST["ciudadcliente"]);
		$direccliente = limpiar($_POST["direccliente"]);
		$telefcliente = limpiar($_POST["telefcliente"]);
		$correocliente = limpiar($_POST["correocliente"]);
		$passwordcliente = limpiar(sha1(md5($_POST["dnicliente"])));
if (limpiar(isset($_POST['limitecredito']))) { $limitecredito = limpiar($_POST["limitecredito"]); } else { $limitecredito = limpiar("0.00"); }
	    $fechaingreso = limpiar(date("Y-m-d"));
		$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL CLIENTE HA SIDO REGISTRADO EXITOSAMENTE";
		exit;

	} else {

		echo "2";
		exit;
	}
}
############################## FUNCION REGISTRAR CLIENTES #############################

############################## FUNCION LISTAR CLIENTES ################################
	public function ListarClientes()
	{
		self::SetNames();
	$sql = "SELECT * FROM clientes LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
############################# FUNCION LISTAR CLIENTES ################################

############################ FUNCION ID CLIENTES #################################
	public function ClientesPorId()
	{
		self::SetNames();
		$sql = "SELECT * FROM clientes LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento WHERE clientes.codcliente = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codcliente"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID CLIENTES #################################
	
############################ FUNCION ACTUALIZAR CLIENTES ############################
public function ActualizarClientes()
{
	
self::SetNames();
	if(empty($_POST["codcliente"]) or empty($_POST["dnicliente"]) or empty($_POST["nomcliente"]) or empty($_POST["paiscliente"]))
	{
		echo "1";
		exit;
	}

	$sql = " SELECT dnicliente FROM clientes WHERE codcliente != ? AND dnicliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codcliente"],$_POST["dnicliente"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$sql = "UPDATE clientes set "
		." documcliente = ?, "
		." dnicliente = ?, "
		." nomcliente = ?, "
		." paiscliente = ?, "
		." ciudadcliente = ?, "
		." direccliente = ?, "
		." telefcliente = ?, "
		." correocliente = ?, "
		." limitecredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $documcliente);
		$stmt->bindParam(2, $dnicliente);
		$stmt->bindParam(3, $nomcliente);
		$stmt->bindParam(4, $paiscliente);
		$stmt->bindParam(5, $ciudadcliente);
		$stmt->bindParam(6, $direccliente);
		$stmt->bindParam(7, $telefcliente);
		$stmt->bindParam(8, $correocliente);
		$stmt->bindParam(9, $limitecredito);
		$stmt->bindParam(10, $codcliente);
		
		$documcliente = limpiar($_POST["documcliente"]);
		$dnicliente = limpiar($_POST["dnicliente"]);
		$nomcliente = limpiar($_POST["nomcliente"]);
		$paiscliente = limpiar($_POST["paiscliente"]);
		$ciudadcliente = limpiar($_POST["ciudadcliente"]);
		$direccliente = limpiar($_POST["direccliente"]);
		$telefcliente = limpiar($_POST["telefcliente"]);
		$correocliente = limpiar($_POST["correocliente"]);
		$limitecredito = limpiar($_POST["limitecredito"]);
		$codcliente = limpiar($_POST["codcliente"]);
		$stmt->execute();
    
	echo "<span class='fa fa-check-square-o'></span> EL CLIENTE HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;

	} else {

		echo "2";
		exit;
	}
}
############################ FUNCION ACTUALIZAR CLIENTES ############################

################################## FUNCION REINICIAR CLAVE ###################################
public function ReiniciarClave()
{
	self::SetNames();
	$sql = "UPDATE clientes set "
	." passwordcliente = ? "
	." where "
	." codcliente = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	
	$stmt->bindParam(1, $password);
	$stmt->bindParam(2,$codcliente);
	
	$password = sha1(md5(decrypt($_GET['dnicliente'])));
	$codcliente= limpiar(decrypt($_GET['codcliente']));
	$stmt->execute();

	echo "1";
	exit;
}
################################## FUNCION REINICIAR CLAVE ###################################

############################ FUNCION ELIMINAR CLIENTES #############################
public function EliminarClientes()
{
self::SetNames();
	if ($_SESSION['acceso'] == "administrador") {

	$sql = "SELECT codcliente FROM reservaciones WHERE codcliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codcliente"])));
	$num = $stmt->rowCount();
	if($num == 0)
	{

		$sql = "DELETE FROM clientes where codcliente = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codcliente);
		$codcliente = decrypt($_GET["codcliente"]);
		$stmt->execute();

		echo "1";
		exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
############################## FUNCION ELIMINAR CLIENTES #############################

############################## FIN DE CLASE CLIENTES ##################################




























############################### CLASE PROVEEDORES ##################################

############################## FUNCION CARGAR PROVEEDORES ##############################
	public function CargarProveedores()
	{
		self::SetNames();
		if(empty($_FILES["sel_file"]))
		{
			echo "1";
			exit;
		}
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         //echo 'Cargando nombre del archivo: '.$fname.' ';
         $chk_ext = explode(".",$fname);
         
        if(strtolower(end($chk_ext)) == "csv")
        {
        //si es correcto, entonces damos permisos de lectura para subir
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $this->dbh->beginTransaction();
        
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

               //Insertamos los datos con los valores...
			   
		$query = "INSERT INTO proveedores values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codproveedor);
		$stmt->bindParam(2, $documproveedor);
		$stmt->bindParam(3, $dniproveedor);
		$stmt->bindParam(4, $nomproveedor);
		$stmt->bindParam(5, $tlfproveedor);
		$stmt->bindParam(6, $direcproveedor);
		$stmt->bindParam(7, $emailproveedor);
		$stmt->bindParam(8, $vendedor);
		$stmt->bindParam(9, $tlfvendedor);
		$stmt->bindParam(10, $fechaingreso);

		$codproveedor = limpiar($data[0]);
		$documproveedor = limpiar($data[1]);
		$dniproveedor = limpiar($data[2]);
		$nomproveedor = limpiar($data[3]);
		$tlfproveedor = limpiar($data[4]);
		$direcproveedor = limpiar($data[5]);
		$emailproveedor = limpiar($data[6]);
		$vendedor = limpiar($data[7]);
		$tlfvendedor = limpiar($data[8]);
		$fechaingreso = limpiar(date("Y-m-d"));
		$stmt->execute();
				
        }
           $this->dbh->commit();
           //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
           fclose($handle);
	        
	echo "<span class='fa fa-check-square-o'></span> LA CARGA MASIVA DE PROVEEDORES FUE REALIZADA EXITOSAMENTE";
	exit;
             
         }
         else
         {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para ver si esta separado por " , "
         echo "2";
		 exit;
      }  
}
############################# FUNCION CARGAR PROVEEDORES #############################

############################ FUNCION REGISTRAR PROVEEDORES ############################
	public function RegistrarProveedores()
	{
		self::SetNames();
		if(empty($_POST["cuitproveedor"]) or empty($_POST["nomproveedor"]) or empty($_POST["direcproveedor"]))
		{
			echo "1";
			exit;
		}

		$sql = "SELECT codproveedor FROM proveedores ORDER BY idproveedor DESC LIMIT 1";
		foreach ($this->dbh->query($sql) as $row){

			$id=$row["codproveedor"];

		}
		if(empty($id))
		{
			$codproveedor = "P1";

		} else {

			$resto = substr($id, 0, 1);
			$coun = strlen($resto);
			$num     = substr($id, $coun);
			$codigo     = $num + 1;
			$codproveedor = "P".$codigo;
		}

		$sql = " SELECT cuitproveedor FROM proveedores WHERE cuitproveedor = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["cuitproveedor"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = " INSERT INTO proveedores values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codproveedor);
		    $stmt->bindParam(2, $documproveedor);
			$stmt->bindParam(3, $cuitproveedor);
			$stmt->bindParam(4, $nomproveedor);
			$stmt->bindParam(5, $tlfproveedor);
			$stmt->bindParam(6, $direcproveedor);
			$stmt->bindParam(7, $emailproveedor);
			$stmt->bindParam(8, $vendedor);
			$stmt->bindParam(9, $tlfvendedor);
			$stmt->bindParam(10, $fechaingreso);
			
			$documproveedor = limpiar($_POST["documproveedor"]);
			$cuitproveedor = limpiar($_POST["cuitproveedor"]);
			$nomproveedor = limpiar($_POST["nomproveedor"]);
			$tlfproveedor = limpiar($_POST["tlfproveedor"]);
			$direcproveedor = limpiar($_POST["direcproveedor"]);
			$emailproveedor = limpiar($_POST["emailproveedor"]);
			$vendedor = limpiar($_POST["vendedor"]);
			$tlfvendedor = limpiar($_POST["tlfvendedor"]);
		    $fechaingreso = limpiar(date("Y-m-d"));
			$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> EL PROVEEDOR HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

		} else {

			echo "2";
			exit;
		}
	}
############################ FUNCION REGISTRAR PROVEEDORES #############################

############################ FUNCION LISTAR PROVEEDORES ##############################
	public function ListarProveedores()
	{
		self::SetNames();
	    $sql = "SELECT * FROM proveedores LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
############################ FUNCION LISTAR PROVEEDORES #############################

############################ FUNCION ID PROVEEDORES #################################
	public function ProveedoresPorId()
	{
		self::SetNames();
		$sql = "SELECT * FROM proveedores LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento WHERE proveedores.codproveedor = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproveedor"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID PROVEEDORES #################################
	
############################ FUNCION ACTUALIZAR PROVEEDORES ############################
	public function ActualizarProveedores()
	{
	self::SetNames();
		if(empty($_POST["codproveedor"]) or empty($_POST["cuitproveedor"]) or empty($_POST["nomproveedor"]) or empty($_POST["direcproveedor"]))
		{
			echo "1";
			exit;
		}
		$sql = " SELECT cuitproveedor FROM proveedores WHERE codproveedor != ? AND cuitproveedor = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codproveedor"],$_POST["cuitproveedor"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$sql = "UPDATE proveedores set "
			." documproveedor = ?, "
			." cuitproveedor = ?, "
			." nomproveedor = ?, "
			." tlfproveedor = ?, "
			." direcproveedor = ?, "
			." emailproveedor = ?, "
			." vendedor = ?, "
			." tlfvendedor = ? "
			." where "
			." codproveedor = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $documproveedor);
			$stmt->bindParam(2, $cuitproveedor);
			$stmt->bindParam(3, $nomproveedor);
			$stmt->bindParam(4, $tlfproveedor);
			$stmt->bindParam(5, $direcproveedor);
			$stmt->bindParam(6, $emailproveedor);
			$stmt->bindParam(7, $vendedor);
			$stmt->bindParam(8, $tlfvendedor);
			$stmt->bindParam(9, $codproveedor);
			
			$documproveedor = limpiar($_POST["documproveedor"]);
			$cuitproveedor = limpiar($_POST["cuitproveedor"]);
			$nomproveedor = limpiar($_POST["nomproveedor"]);
			$tlfproveedor = limpiar($_POST["tlfproveedor"]);
			$direcproveedor = limpiar($_POST["direcproveedor"]);
			$emailproveedor = limpiar($_POST["emailproveedor"]);
			$vendedor = limpiar($_POST["vendedor"]);
			$tlfvendedor = limpiar($_POST["tlfvendedor"]);
			$codproveedor = limpiar($_POST["codproveedor"]);
			$stmt->execute();
        
		echo "<span class='fa fa-check-square-o'></span> EL PROVEEDOR HA SIDO ACTUALIZADO EXITOSAMENTE";
		exit;

		} else {

			echo "2";
			exit;
		}
	}
############################ FUNCION ACTUALIZAR PROVEEDORES ############################

############################ FUNCION ELIMINAR PROVEEDORES ############################
	public function EliminarProveedores()
	{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codproveedor FROM productos OR insumos WHERE codproveedor = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproveedor"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM proveedores where codproveedor = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codproveedor);
			$codproveedor = decrypt($_GET["codproveedor"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
############################ FUNCION ELIMINAR PROVEEDORES ############################

############################# FIN DE CLASE PROVEEDORES #################################

























################################ CLASE DE INSUMOS #################################

############################ FUNCION CARGAR DE INSUMOS #################################
	public function CargarInsumos()
	{
		self::SetNames();
		if(empty($_FILES["sel_file"]))
		{
			echo "1";
			exit;
		}
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         //echo 'Cargando nombre del archivo: '.$fname.' ';
         $chk_ext = explode(".",$fname);
         
        if(strtolower(end($chk_ext)) == "csv")
        {
        //si es correcto, entonces damos permisos de lectura para subir
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $this->dbh->beginTransaction();
        
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

               //Insertamos los datos con los valores...
			   
		$query = "INSERT INTO insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codinsumo);
		$stmt->bindParam(2, $insumo);
		$stmt->bindParam(3, $codcategoria);
		$stmt->bindParam(4, $preciocompra);
		$stmt->bindParam(5, $precioventa);
		$stmt->bindParam(6, $existencia);
		$stmt->bindParam(7, $stockminimo);
		$stmt->bindParam(8, $ivainsumo);
		$stmt->bindParam(9, $descinsumo);
		$stmt->bindParam(10, $fechaexpiracion);
		$stmt->bindParam(11, $codproveedor);
		$stmt->bindParam(12, $lote);

		$codinsumo = limpiar($data[0]);
		$insumo = limpiar($data[1]);
		$codcategoria = limpiar($data[2]);
		$preciocompra = limpiar($data[3]);
		$precioventa = limpiar($data[4]);
		$existencia = limpiar($data[5]);
		$stockminimo = limpiar($data[6]);
		$ivainsumo = limpiar($data[7]);
		$descinsumo = limpiar($data[8]);
		$fechaexpiracion = limpiar($data[9]);
		$codproveedor = limpiar($data[10]);
		$lote = limpiar($data[11]);
		$stmt->execute();

##################### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX #####################
		$query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codproceso);
		$stmt->bindParam(2, $codresponsable);
		$stmt->bindParam(3, $codinsumo);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivainsumo);
		$stmt->bindParam(10, $descinsumo);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);
		
		$codproceso = limpiar($data[0]);
		$codresponsable = limpiar("0");
		$codinsumo = limpiar($data[0]);
		$movimiento = limpiar("ENTRADAS");
		$entradas = limpiar($data[5]);
		$salidas = limpiar("0");
		$devolucion = limpiar("0");
		$stockactual = limpiar($data[5]);
		$ivainsumo = limpiar($data[7]);
		$descinsumo = limpiar($data[8]);
		$precio = limpiar($data[4]);
		$documento = limpiar("INVENTARIO INICIAL");
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
##################### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX #####################
				
        }
           $this->dbh->commit();
           //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
           fclose($handle);
	        
	echo "<span class='fa fa-check-square-o'></span> LA CARGA MASIVA DE INSUMOS DE LIMPIEZA FUE REALIZADA EXITOSAMENTE";
	exit;
             
         }
         else
         {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para ver si esta separado por " , "
         echo "2";
		 exit;
      }  
}
############################# FUNCION CARGAR DE INSUMOS #############################

########################### FUNCION REGISTRAR DE INSUMOS ###############################
public function RegistrarInsumos()
{
	self::SetNames();
	if(empty($_POST["codinsumo"]) or empty($_POST["insumo"]) or empty($_POST["codcategoria"]) or empty($_POST["existencia"]))
	{
		echo "1";
		exit;
	}

	$sql = " SELECT codinsumo FROM insumos WHERE codinsumo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codinsumo"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$query = " INSERT INTO insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codinsumo);
		$stmt->bindParam(2, $insumo);
		$stmt->bindParam(3, $codcategoria);
		$stmt->bindParam(4, $preciocompra);
		$stmt->bindParam(5, $precioventa);
		$stmt->bindParam(6, $existencia);
		$stmt->bindParam(7, $stockminimo);
		$stmt->bindParam(8, $ivainsumo);
		$stmt->bindParam(9, $descinsumo);
		$stmt->bindParam(10, $fechaexpiracion);
		$stmt->bindParam(11, $codproveedor);
		$stmt->bindParam(12, $lote);
		
		$codinsumo = limpiar($_POST["codinsumo"]);
		$insumo = limpiar($_POST["insumo"]);
		$codcategoria = limpiar($_POST["codcategoria"]);
		$preciocompra = limpiar($_POST["preciocompra"]);
		$precioventa = limpiar($_POST["precioventa"]);
		$existencia = limpiar($_POST["existencia"]);
		$stockminimo = limpiar($_POST["stockminimo"]);
		$ivainsumo = limpiar($_POST["ivainsumo"]);
		$descinsumo = limpiar($_POST["descinsumo"]);
		if (limpiar($_POST['fechaexpiracion']=="")) { $fechaexpiracion = "0000-00-00";  } else { $fechaexpiracion = limpiar(date("Y-m-d",strtotime($_POST['fechaexpiracion']))); }
		$codproveedor = limpiar($_POST['codproveedor']);
		$lote = limpiar($_POST['lote']);
		$stmt->execute();

        ################# REGISTRAMOS LOS DATOS DE INSUMOS EN KARDEX ###################
		$query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codinsumo);
		$stmt->bindParam(2, $codresponsable);
		$stmt->bindParam(3, $codinsumo);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivainsumo);
		$stmt->bindParam(10, $descinsumo);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);

		$codresponsable = limpiar($_POST['codproveedor']);
		$movimiento = limpiar("ENTRADAS");
		$entradas = limpiar($_POST['existencia']);
		$salidas = limpiar("0");
		$devolucion = limpiar("0");
		$stockactual = limpiar($_POST['existencia']);
		$ivainsumo = limpiar($_POST["ivainsumo"]);
		$descinsumo = limpiar($_POST["descinsumo"]);
		$precio = limpiar($_POST['precioventa']);
		$documento = limpiar("INVENTARIO INICIAL");
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
        ################## REGISTRAMOS LOS DATOS DE INSUMOS EN KARDEX #################

		echo "<span class='fa fa-check-square-o'></span> EL INSUMO DE LIMPIEZA HA SIDO REGISTRADO EXITOSAMENTE";
		exit;

	} else {

		echo "2";
		exit;
	}
}
############################ FUNCION REGISTRAR DE INSUMOS #########################

########################### FUNCION LISTAR DE INSUMOS ################################
public function ListarInsumos()
	{
	self::SetNames();
	$sql = "SELECT insumos.idinsumo, insumos.codinsumo, insumos.insumo, insumos.codcategoria, insumos.preciocompra, insumos.precioventa, insumos.existencia, insumos.stockminimo, insumos.ivainsumo, insumos.descinsumo, insumos.fechaexpiracion, insumos.codproveedor, insumos.lote, categorias.nomcategoria, proveedores.cuitproveedor, proveedores.nomproveedor 
	FROM insumos LEFT JOIN categorias ON insumos.codcategoria = categorias.codcategoria 
	LEFT JOIN proveedores ON insumos.codproveedor = proveedores.codproveedor";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
############################ FUNCION LISTAR DE INSUMOS ################################

############################ FUNCION ID DE INSUMOS #################################
public function InsumosPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM insumos LEFT JOIN categorias ON insumos.codcategoria = categorias.codcategoria LEFT JOIN proveedores ON insumos.codproveedor = proveedores.codproveedor WHERE insumos.codinsumo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codinsumo"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID DE INSUMOS #################################
	
############################ FUNCION ACTUALIZAR DE INSUMOS ############################
public function ActualizarInsumos()
{
    self::SetNames();
	if(empty($_POST["nroinsumo"]) or empty($_POST["insumo"]) or empty($_POST["codcategoria"]) or empty($_POST["existencia"]))
	{
		echo "1";
		exit;
	}
	
	$sql = " SELECT insumo FROM insumos WHERE codinsumo != ? AND insumo = ? AND codcategoria = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["nroinsumo"],$_POST["insumo"],$_POST["codcategoria"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$sql = "UPDATE insumos set "
		." insumo = ?, "
		." codcategoria = ?, "
		." preciocompra = ?, "
		." precioventa = ?, "
		." existencia = ?, "
		." stockminimo = ?, "
		." ivainsumo = ?, "
		." descinsumo = ?, "
		." fechaexpiracion = ?, "
		." codproveedor = ?, "
		." lote = ? "
		." where "
		." codinsumo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $insumo);
		$stmt->bindParam(2, $codcategoria);
		$stmt->bindParam(3, $preciocompra);
		$stmt->bindParam(4, $precioventa);
		$stmt->bindParam(5, $existencia);
		$stmt->bindParam(6, $stockminimo);
		$stmt->bindParam(7, $ivainsumo);
		$stmt->bindParam(8, $descinsumo);
		$stmt->bindParam(9, $fechaexpiracion);
		$stmt->bindParam(10, $codproveedor);
		$stmt->bindParam(11, $lote);
		$stmt->bindParam(12, $codinsumo);
		
		$insumo = limpiar($_POST["insumo"]);
		$codcategoria = limpiar($_POST["codcategoria"]);
		$preciocompra = limpiar($_POST["preciocompra"]);
		$precioventa = limpiar($_POST["precioventa"]);
		$existencia = limpiar($_POST["existencia"]);
		$stockminimo = limpiar($_POST["stockminimo"]);
		$ivainsumo = limpiar($_POST["ivainsumo"]);
		$descinsumo = limpiar($_POST["descinsumo"]);
		if (limpiar($_POST['fechaexpiracion']=="")) { $fechaexpiracion = "0000-00-00";  } else { $fechaexpiracion = limpiar(date("Y-m-d",strtotime($_POST['fechaexpiracion']))); }
		$codproveedor = limpiar($_POST['codproveedor']);
		$lote = limpiar($_POST['lote']);
		$codinsumo = limpiar($_POST["nroinsumo"]);
		$stmt->execute();
    
	echo "<span class='fa fa-check-square-o'></span> EL INSUMO DE LIMPIEZA HA SIDO ACTUALIZADO EXITOSAMENTE";
	exit;

	} else {

		echo "2";
		exit;
	}
}
############################ FUNCION ACTUALIZAR DE INSUMOS ############################

########################### FUNCION ELIMINAR DE INSUMOS ###############################
	public function EliminarInsumos()
	{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codinsumo FROM salida_insumos WHERE codinsumo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codinsumo"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM insumos where codinsumo = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codinsumo);
			$codinsumo = decrypt($_GET["codinsumo"]);
			$stmt->execute();

			$sql = "DELETE FROM kardex_insumos where codinsumo = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codinsumo);
			$codinsumo = decrypt($_GET["codinsumo"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
############################ FUNCION ELIMINAR DE INSUMOS #############################

############################ FIN DE CLASE DE INSUMOS ################################



























################################ CLASE SALIDAS DE INSUMOS ##############################

####################### FUNCION REGISTRAR SALIDAS DE INSUMOS #########################
	public function RegistrarSalidaInsumos()
	{
		self::SetNames();
		if(empty($_POST["codinsumo"]) or empty($_POST["responsable"]) or empty($_POST["cantsalida"]))
		{
			echo "1";
			exit;
		}
		
		############### VERIFICO LA EXISTENCIA DEL INSUMOS EN ALMACEN ################
		$sql = "SELECT existencia FROM insumos WHERE codinsumo = '".limpiar($_POST['codinsumo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];

		if ($_POST["cantsalida"] > $existenciabd) 
        { 
		    echo "2";
		    exit;
	    }

		$sql = "SELECT codsalida FROM salida_insumos ORDER BY idsalida DESC LIMIT 1";
		foreach ($this->dbh->query($sql) as $row){

			$id=$row["codsalida"];

		}
		if(empty($id))
		{
			$codsalida = "S1";

		} else {

			$resto = substr($id, 0, 1);
			$coun = strlen($resto);
			$num     = substr($id, $coun);
			$codigo     = $num + 1;
			$codsalida = "S".$codigo;
		}


		$query = " INSERT INTO salida_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codsalida);
			$stmt->bindParam(2, $codinsumo);
			$stmt->bindParam(3, $responsable);
			$stmt->bindParam(4, $cantsalida);
			$stmt->bindParam(5, $preciosalida);
			$stmt->bindParam(6, $ivasalida);
			$stmt->bindParam(7, $descsalida);
			$stmt->bindParam(8, $fechasalida);
			
			$codinsumo = limpiar($_POST["codinsumo"]);
			$responsable = limpiar($_POST["responsable"]);
			$cantsalida = limpiar($_POST["cantsalida"]);
			$preciosalida = limpiar($_POST["precioventa"]);
			$ivasalida = limpiar($_POST["ivainsumo"]);
			$descsalida = limpiar($_POST["descinsumo"]);
			$fechasalida = limpiar(date("Y-m-d"));
			$stmt->execute();

		############### ACTUALIZAMOS LA EXISTENCIA DEL INSUMOS EN ALMACEN ##############
		$sql = "UPDATE insumos set "
			  ." existencia = ? "
			  ." WHERE "
			  ." codinsumo = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $existencia);
		$stmt->bindParam(2, $codinsumo);
		
		$existencia = limpiar($existenciabd-$_POST['cantsalida']);
		$codinsumo = limpiar($_POST['codinsumo']);
		$stmt->execute();

        ############### REGISTRAMOS LOS DATOS DE INSUMOS EN KARDEX #####################
			$query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codsalida);
			$stmt->bindParam(2, $codresponsable);
			$stmt->bindParam(3, $codinsumo);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivainsumo);
			$stmt->bindParam(10, $descinsumo);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);

			$codresponsable = limpiar($_POST['responsable']);
			$movimiento = limpiar("SALIDAS");
			$entradas = limpiar("0");
			$salidas = limpiar($_POST['cantsalida']);
			$devolucion = limpiar("0");
			$stockactual = limpiar($existenciabd-$_POST['cantsalida']);
			$ivainsumo = limpiar($_POST["ivainsumo"]);
			$descinsumo = limpiar($_POST["descinsumo"]);
			$precio = limpiar($_POST['precioventa']);
			$documento = limpiar("SALIDA: ".$codsalida);
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();
		################ ACTUALIZAMOS LOS DATOS DE INSUMOS EN KARDEX #################

			echo "<span class='fa fa-check-square-o'></span> LA SALIDA DE INSUMOS DE LIMPIEZA HA SIDO REGISTRADA EXITOSAMENTE";
			exit;
}
####################### FUNCION REGISTRAR SALIDAS DE INSUMOS ########################

####################### FUNCION LISTAR SALIDAS DE INSUMOS ########################
public function ListarSalidaInsumos()
	{
	self::SetNames();
	$sql = "SELECT salida_insumos.idsalida, salida_insumos.codsalida, salida_insumos.codinsumo, salida_insumos.responsable, salida_insumos.cantsalida, salida_insumos.preciosalida, salida_insumos.ivasalida, salida_insumos.descsalida, salida_insumos.fechasalida, insumos.insumo, insumos.codcategoria, insumos.existencia, categorias.nomcategoria FROM salida_insumos 
	INNER JOIN insumos ON salida_insumos.codinsumo = insumos.codinsumo 
	LEFT JOIN categorias ON insumos.codcategoria = categorias.codcategoria
	LEFT JOIN proveedores ON insumos.codproveedor = proveedores.codproveedor";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
######################### FUNCION LISTAR SALIDAS DE INSUMOS ###########################

######################## FUNCION ID SALIDAS DE INSUMOS #########################
	public function SalidaInsumosPorId()
	{
		self::SetNames();
		$sql = "SELECT salida_insumos.idsalida, salida_insumos.codsalida, salida_insumos.codinsumo, salida_insumos.responsable, salida_insumos.cantsalida, salida_insumos.preciosalida, salida_insumos.ivasalida, salida_insumos.descsalida, salida_insumos.fechasalida, insumos.insumo, insumos.codcategoria, categorias.nomcategoria FROM salida_insumos 
	    INNER JOIN insumos ON salida_insumos.codinsumo = insumos.codinsumo 
	    LEFT JOIN categorias ON insumos.codcategoria = categorias.codcategoria
	    LEFT JOIN proveedores ON insumos.codproveedor = proveedores.codproveedor WHERE salida_insumos.codsalida = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codsalida"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
######################## FUNCION ID SALIDAS DE INSUMOS #########################
	
######################## FUNCION ACTUALIZAR SALIDAS DE INSUMOS #######################
	public function ActualizarSalidaInsumos()
	{
	self::SetNames();
		if(empty($_POST["codsalida"]) or empty($_POST["codinsumo"]) or empty($_POST["cantsalida"]) or empty($_POST["cantsalidabd"]))
		{
			echo "1";
			exit;
		}

		$sql2 = "SELECT codinsumo FROM salida_insumos WHERE codsalida = '".limpiar($_POST['codsalida'])."'";
			foreach ($this->dbh->query($sql2) as $row2)
			{
				$this->p2[] = $row2;
			}
			$insumo = $row2['codinsumo'];
		
		################ VERIFICO LA EXISTENCIA DEL INSUMOS EN ALMACEN ##################
		$sql = "SELECT existencia FROM insumos WHERE codinsumo = '".limpiar($_POST['codinsumo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];
		$cantsalida = $_POST["cantsalida"];
		$cantsalidabd = $_POST["cantsalidabd"];
		$totalsalida = $cantsalida-$cantsalidabd;

		if ($totalsalida > $existenciabd) 
        { 
		    echo "2";
		    exit;
	    } 
	    elseif ($_POST['codinsumo'] != $insumo) 
        { 
		    echo "3";
		    exit;
	    }
	
		$sql = "UPDATE salida_insumos set "
			." responsable = ?, "
			." cantsalida = ? "
			." where "
			." codsalida = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $responsable);
		    $stmt->bindParam(2, $cantsalida);
			$stmt->bindParam(3, $codsalida);
			
			$responsable = limpiar($_POST["responsable"]);
			$cantsalida = limpiar($_POST["cantsalida"]);
			$codsalida = limpiar($_POST["codsalida"]);
			$stmt->execute();

		############# ACTUALIZAMOS LA EXISTENCIA DEL INSUMOS EN ALMACEN ###############
		$sql = "UPDATE insumos set "
			  ." existencia = ? "
			  ." WHERE "
			  ." codinsumo = ?;
			   ";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $existencia);
			$stmt->bindParam(2, $codinsumo);
			
			$existencia = limpiar($existenciabd-$totalsalida);
			$codinsumo = limpiar($_POST['codinsumo']);
			$stmt->execute();

        ################# ACTUALIZAMOS LOS DATOS DE INSUMOS EN KARDEX ################
	    $sql3 = " UPDATE kardex_insumos set "
			." codresponsable = ?, "
			." salidas = ?, "
			." stockactual = ? "
			." WHERE "
			." codproceso = '".limpiar($_POST["codsalida"])."';
			";
			$stmt = $this->dbh->prepare($sql3);
			$stmt->bindParam(1, $codresponsable);
			$stmt->bindParam(2, $salidas);
			$stmt->bindParam(3, $existencia);
			
			$codresponsable = limpiar($_POST["responsable"]);
			$salidas = limpiar($_POST["cantsalida"]);
			$stmt->execute();
        ################ ACTUALIZAMOS LOS DATOS DE INSUMOS EN KARDEX #################
        
		echo "<span class='fa fa-check-square-o'></span> LA SALIDA DE INSUMOS DE LIMPIEZA HA SIDO ACTUALIZADA EXITOSAMENTE";
		exit;
	}
####################### FUNCION ACTUALIZAR SALIDAS DE INSUMOS ########################

####################### FUNCION ELIMINAR SALIDAS DE INSUMOS #########################
	public function EliminarSalidaInsumos()
	{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		################ OBTENGO LOS DATOS DE LA SALIDAS A ELIMINAR ################
			$sql2 = "SELECT responsable, cantsalida, preciosalida, ivasalida, descsalida FROM salida_insumos WHERE codsalida = '".limpiar(decrypt($_GET['codsalida']))."'";
			foreach ($this->dbh->query($sql2) as $row2)
			{
				$this->p2[] = $row2;
			}
			$responsable = $row2["responsable"];
			$cantsalida = $row2['cantsalida'];
			$preciosalida = $row2['preciosalida'];
			$ivasalida = $row2['ivasalida'];
			$descsalida = $row2['descsalida'];
		
		################ VERIFICO LA EXISTENCIA DEL INSUMO EN ALMACEN ################
			$sql = "SELECT existencia FROM insumos WHERE codinsumo = '".limpiar(decrypt($_GET['codinsumo']))."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			$existenciabd = $row['existencia'];

		############# ACTUALIZAMOS LA EXISTENCIA DEL INSUMOS EN ALMACEN ###############
			$sql = "UPDATE insumos set "
			." existencia = ? "
			." WHERE "
			." codinsumo = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $existencia);
			$stmt->bindParam(2, $codinsumo);

			$existencia = limpiar($existenciabd+$cantsalida);
			$codinsumo = limpiar(decrypt($_GET['codinsumo']));
			$stmt->execute();

        ############### REGISTRAMOS LOS DATOS DE INSUMOS EN KARDEX ###############
			$query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codsalida);
			$stmt->bindParam(2, $codresponsable);
			$stmt->bindParam(3, $codinsumo);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivainsumo);
			$stmt->bindParam(10, $descinsumo);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);

			$codsalida = limpiar(decrypt($_GET['codsalida']));
			$codresponsable = limpiar($responsable);
			$movimiento = limpiar("DEVOLUCION");
			$entradas = limpiar("0");
			$salidas = limpiar("0");
			$devolucion = limpiar($cantsalida);
			$stockactual = limpiar($existenciabd+$cantsalida);
			$ivainsumo = limpiar($ivasalida);
			$descinsumo = limpiar($descsalida);
			$precio = limpiar($preciosalida);
			$documento = limpiar("DEVOLUCION SALIDA: ".decrypt($_GET["codsalida"]));
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();
        ################# REGISTRAMOS LOS DATOS DE INSUMOS EN KARDEX ################

		    $sql = "DELETE FROM salida_insumos where codsalida = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codsalida);
			$codsalida = decrypt($_GET["codsalida"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
}
######################## FUNCION ELIMINAR SALIDAS DE INSUMOS #########################

############################ FUNCION BUSCA KARDEX INSUMOS #############################
public function BuscarkardexInsumo() 
	       {
		self::SetNames();
		$sql ="SELECT * FROM (insumos LEFT JOIN kardex_insumos ON insumos.codinsumo=kardex_insumos.codinsumo) 
		LEFT JOIN categorias ON insumos.codcategoria=categorias.codcategoria 
		LEFT JOIN proveedores ON insumos.codproveedor=proveedores.codproveedor 
		WHERE kardex_insumos.codinsumo = ?";
        $stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_GET["codinsumo"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
		echo "<div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN MOVIMIENTOS EN KARDEX PARA EL INSUMO INGRESADO</center>";
		echo "</div>";		
		exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
########################### FUNCION BUSCA KARDEX INSUMOS ###########################

########################## FIN DE CLASE SALIDAS DE INSUMOS ############################

























################################# CLASE PRODUCTOS ###################################

############################# FUNCION CARGAR PRODUCTOS #############################
	public function CargarProductos()
	{
		self::SetNames();
		if(empty($_FILES["sel_file"]))
		{
			echo "1";
			exit;
		}
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         //echo 'Cargando nombre del archivo: '.$fname.' ';
         $chk_ext = explode(".",$fname);
         
        if(strtolower(end($chk_ext)) == "csv")
        {
        //si es correcto, entonces damos permisos de lectura para subir
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");
        $this->dbh->beginTransaction();
        
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

               //Insertamos los datos con los valores...
    $query = "INSERT INTO productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    	$stmt = $this->dbh->prepare($query);
    	$stmt->bindParam(1, $codproducto);
    	$stmt->bindParam(2, $producto);
    	$stmt->bindParam(3, $codcategoria);
    	$stmt->bindParam(4, $preciocompra);
    	$stmt->bindParam(5, $precioventa);
    	$stmt->bindParam(6, $existencia);
    	$stmt->bindParam(7, $stockminimo);
    	$stmt->bindParam(8, $stockmaximo);
    	$stmt->bindParam(9, $ivaproducto);
    	$stmt->bindParam(10, $descproducto);
    	$stmt->bindParam(11, $codigobarra);
    	$stmt->bindParam(12, $fechaelaboracion);
    	$stmt->bindParam(13, $fechaexpiracion);
    	$stmt->bindParam(14, $codproveedor);
    	$stmt->bindParam(15, $lote);
    	$stmt->bindParam(16, $stockteorico);
    	$stmt->bindParam(17, $motivoajuste);

    	$codproducto = limpiar($data[0]);
    	$producto = limpiar($data[1]);
    	$codcategoria = limpiar($data[2]);
    	$preciocompra = limpiar($data[3]);
    	$precioventa = limpiar($data[4]);
    	$existencia = limpiar($data[5]);
    	$stockminimo = limpiar($data[6]);
    	$stockmaximo = limpiar($data[7]);
    	$ivaproducto = limpiar($data[8]);
    	$descproducto = limpiar($data[9]);
    	$codigobarra = limpiar($data[10]);
    	$fechaelaboracion = limpiar($data[11]);
    	$fechaexpiracion = limpiar($data[12]);
    	$codproveedor = limpiar($data[13]);
    	$lote = limpiar($data[14]);
    	$stockteorico = limpiar("0");
    	$motivoajuste = limpiar("NINGUNO");
    	$stmt->execute();

##################### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX #####################
		$query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codproceso);
		$stmt->bindParam(2, $codresponsable);
		$stmt->bindParam(3, $codproducto);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivaproducto);
		$stmt->bindParam(10, $descproducto);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);
		
		$codproceso = limpiar($data[0]);
		$codresponsable = limpiar("0");
		$codproducto = limpiar($data[0]);
		$movimiento = limpiar("ENTRADAS");
		$entradas = limpiar($data[5]);
		$salidas = limpiar("0");
		$devolucion = limpiar("0");
		$stockactual = limpiar($data[5]);
		$ivaproducto = limpiar($data[8]);
		$descproducto = limpiar($data[9]);
		$precio = limpiar($data[4]);
		$documento = limpiar("INVENTARIO INICIAL");
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
##################### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX #####################
	
        }
           
           $this->dbh->commit();
           //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
           fclose($handle);
	        
	echo "<span class='fa fa-check-square-o'></span> LA CARGA MASIVA DE PRODUCTOS FUE REALIZADA EXITOSAMENTE";
	exit;
             
         }
         else
         {
    //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para ver si esta separado por " , "
         echo "2";
		 exit;
      }  
}
################################ FUNCION CARGAR PRODUCTOS ##############################

############################ FUNCION REGISTRAR PRODUCTOS ###############################
	public function RegistrarProductos()
	{
		self::SetNames();
		if(empty($_POST["codproducto"]) or empty($_POST["producto"]) or empty($_POST["codcategoria"]))
		{
			echo "1";
			exit;
		}


		$sql = " SELECT codproducto FROM productos WHERE codproducto = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codproducto"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
	        $query = "INSERT INTO productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codproducto);
			$stmt->bindParam(2, $producto);
			$stmt->bindParam(3, $codcategoria);
			$stmt->bindParam(4, $preciocompra);
			$stmt->bindParam(5, $precioventa);
			$stmt->bindParam(6, $existencia);
			$stmt->bindParam(7, $stockminimo);
			$stmt->bindParam(8, $stockmaximo);
			$stmt->bindParam(9, $ivaproducto);
			$stmt->bindParam(10, $descproducto);
			$stmt->bindParam(11, $codigobarra);
			$stmt->bindParam(12, $fechaelaboracion);
			$stmt->bindParam(13, $fechaexpiracion);
			$stmt->bindParam(14, $codproveedor);
			$stmt->bindParam(15, $lote);
			$stmt->bindParam(16, $stockteorico);
			$stmt->bindParam(17, $motivoajuste);

			$codproducto = limpiar($_POST["codproducto"]);
			$producto = limpiar($_POST["producto"]);
			$codcategoria = limpiar($_POST["codcategoria"]);
			$preciocompra = limpiar($_POST["preciocompra"]);
			$precioventa = limpiar($_POST["precioventa"]);
			$existencia = limpiar($_POST["existencia"]);
			$stockminimo = limpiar($_POST["stockminimo"]);
			$stockmaximo = limpiar($_POST["stockmaximo"]);
			$ivaproducto = limpiar($_POST["ivaproducto"]);
			$descproducto = limpiar($_POST["descproducto"]);
			$codigobarra = limpiar($_POST["codigobarra"]);
			if (limpiar($_POST['fechaelaboracion']=="")) { $fechaelaboracion = "0000-00-00";  } else { $fechaelaboracion = limpiar(date("Y-m-d",strtotime($_POST['fechaelaboracion']))); }
			if (limpiar($_POST['fechaexpiracion']=="")) { $fechaexpiracion = "0000-00-00";  } else { $fechaexpiracion = limpiar(date("Y-m-d",strtotime($_POST['fechaexpiracion']))); }
			$codproveedor = limpiar($_POST["codproveedor"]);
			$lote = limpiar($_POST["lote"]);
			$stockteorico = limpiar("0");
			$motivoajuste = limpiar("NINGUNO");
			$stmt->execute();

##################### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX #####################
			$query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codproceso);
			$stmt->bindParam(2, $codresponsable);
			$stmt->bindParam(3, $codproducto);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivaproducto);
			$stmt->bindParam(10, $descproducto);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);

			$codproceso = limpiar($_POST['codproducto']);
			$codresponsable = limpiar("0");
			$codproducto = limpiar($_POST['codproducto']);
			$movimiento = limpiar("ENTRADAS");
			$entradas = limpiar($_POST['existencia']);
			$salidas = limpiar("0");
			$devolucion = limpiar("0");
			$stockactual = limpiar($_POST['existencia']);
			$ivaproducto = limpiar($_POST["ivaproducto"]);
			$descproducto = limpiar($_POST["descproducto"]);
			$precio = limpiar($_POST['precioventa']);
			$documento = limpiar("INVENTARIO INICIAL");
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();
##################### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX #####################


	##################  SUBIR FOTO DE PRODUCTO ######################################
         //datos del arhivo  
if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; } 
         //compruebo si las características del archivo son las que deseo  
if ((strpos($tipo_archivo,'image/jpeg')!==false)&&$tamano_archivo<200000) 
		 {  
if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/productos/".$nombre_archivo) && rename("fotos/productos/".$nombre_archivo,"fotos/productos/".$codproducto.".jpg"))
		 { 
		 ## se puede dar un aviso
		 } 
		 ## se puede dar otro aviso 
		 }
	################## FINALIZA SUBIR FOTO DE PRODUCTO ###################

			echo "<span class='fa fa-check-square-o'></span> EL PRODUCTO HA SIDO REGISTRADO EXITOSAMENTE";
			exit;

		} else {

			echo "2";
			exit;
		}
	}
########################## FUNCION REGISTRAR PRODUCTOS ###############################

########################## FUNCION LISTAR PRODUCTOS ################################
	public function ListarProductos()
	{
		self::SetNames();
$sql = "SELECT * FROM (productos INNER JOIN categorias ON productos.codcategoria=categorias.codcategoria)
	LEFT JOIN proveedores ON productos.codproveedor=proveedores.codproveedor";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
############################ FUNCION LISTAR PRODUCTOS ################################

############################ FUNCION LISTAR PRODUCTOS ################################
	public function ListarProductosModal()
	{
		self::SetNames();
    $sql = "SELECT * FROM productos LEFT JOIN categorias ON productos.codcategoria=categorias.codcategoria";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
########################### FUNCION LISTAR PRODUCTOS ################################

############################ FUNCION ID PRODUCTOS #################################
	public function ProductosPorId()
	{
		self::SetNames();
		$sql = "SELECT
		productos.idproducto,
		productos.codproducto,
		productos.producto,
		productos.codcategoria,
		productos.preciocompra,
		productos.precioventa,
		productos.existencia,
		productos.stockminimo,
		productos.stockmaximo,
		productos.ivaproducto,
		productos.descproducto,
		productos.codigobarra,
		productos.fechaelaboracion,
		productos.fechaexpiracion,
		productos.codproveedor,
		productos.lote,
		productos.stockteorico,
		productos.motivoajuste,
		categorias.nomcategoria,
		proveedores.cuitproveedor,
		proveedores.nomproveedor
		FROM(productos INNER JOIN categorias ON productos.codcategoria=categorias.codcategoria)
		LEFT JOIN proveedores ON productos.codproveedor=proveedores.codproveedor WHERE productos.codproducto = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproducto"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID PRODUCTOS #################################

############################ FUNCION ACTUALIZAR PRODUCTOS ############################
	public function ActualizarProductos()
	{
	self::SetNames();
		if(empty($_POST["codproducto"]) or empty($_POST["producto"]) or empty($_POST["codcategoria"]))
		{
			echo "1";
			exit;
		}
		$sql = "SELECT codproducto FROM productos WHERE idproducto != ? AND codproducto = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["idproducto"],$_POST["codproducto"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$sql = "UPDATE productos set"
			." producto = ?, "
			." codcategoria = ?, "
			." preciocompra = ?, "
			." precioventa = ?, "
			." existencia = ?, "
			." stockminimo = ?, "
			." stockmaximo = ?, "
			." ivaproducto = ?, "
			." descproducto = ?, "
			." codigobarra = ?, "
			." fechaelaboracion = ?, "
			." fechaexpiracion = ?, "
			." codproveedor = ?, "
			." lote = ? "
			." where "
			." idproducto = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $producto);
			$stmt->bindParam(2, $codcategoria);
			$stmt->bindParam(3, $preciocompra);
			$stmt->bindParam(4, $precioventa);
			$stmt->bindParam(5, $existencia);
			$stmt->bindParam(6, $stockminimo);
			$stmt->bindParam(7, $stockmaximo);
			$stmt->bindParam(8, $ivaproducto);
			$stmt->bindParam(9, $descproducto);
			$stmt->bindParam(10, $codigobarra);
			$stmt->bindParam(11, $fechaelaboracion);
			$stmt->bindParam(12, $fechaexpiracion);
			$stmt->bindParam(13, $codproveedor);
			$stmt->bindParam(14, $lote);
			$stmt->bindParam(15, $idproducto);

			$producto = limpiar($_POST["producto"]);
			$codcategoria = limpiar($_POST["codcategoria"]);
			$preciocompra = limpiar($_POST["preciocompra"]);
			$precioventa = limpiar($_POST["precioventa"]);
			$existencia = limpiar($_POST["existencia"]);
			$stockminimo = limpiar($_POST["stockminimo"]);
			$stockmaximo = limpiar($_POST["stockmaximo"]);
			$ivaproducto = limpiar($_POST["ivaproducto"]);
			$descproducto = limpiar($_POST["descproducto"]);
			$codigobarra = limpiar($_POST["codigobarra"]);
			if (limpiar($_POST['fechaelaboracion']=="")) { $fechaelaboracion = "0000-00-00";  } else { $fechaelaboracion = limpiar(date("Y-m-d",strtotime($_POST['fechaelaboracion']))); }
			if (limpiar($_POST['fechaexpiracion']=="")) { $fechaexpiracion = "0000-00-00";  } else { $fechaexpiracion = limpiar(date("Y-m-d",strtotime($_POST['fechaexpiracion']))); }
			$codproveedor = limpiar($_POST["codproveedor"]);
			$lote = limpiar($_POST["lote"]);
			$codproducto = limpiar($_POST["codproducto"]);
			$idproducto = limpiar($_POST["idproducto"]);
			$stmt->execute();


	################## SUBIR FOTO DE PRODUCTO ######################################
         //datos del arhivo  
if (isset($_FILES['imagen']['name'])) { $nombre_archivo = $_FILES['imagen']['name']; } else { $nombre_archivo =''; }
if (isset($_FILES['imagen']['type'])) { $tipo_archivo = $_FILES['imagen']['type']; } else { $tipo_archivo =''; }
if (isset($_FILES['imagen']['size'])) { $tamano_archivo = $_FILES['imagen']['size']; } else { $tamano_archivo =''; } 
         //compruebo si las características del archivo son las que deseo  
if ((strpos($tipo_archivo,'image/jpeg')!==false)&&$tamano_archivo<200000) 
		 {  
if (move_uploaded_file($_FILES['imagen']['tmp_name'], "fotos/productos/".$nombre_archivo) && rename("fotos/productos/".$nombre_archivo,"fotos/productos/".$codproducto.".jpg"))
		 { 
		 ## se puede dar un aviso
		 } 
		 ## se puede dar otro aviso 
		 }
	################## FINALIZA SUBIR FOTO DE PRODUCTO ###################
        
		echo "<span class='fa fa-check-square-o'></span> EL PRODUCTO HA SIDO ACTUALIZADO EXITOSAMENTE";
		exit;

		} else {

			echo "2";
			exit;
		}
	}
############################ FUNCION ACTUALIZAR PRODUCTOS ############################

######################### FUNCION AJUSTAR STOCK DE PRODUCTOS ###########################
	public function ActualizarAjuste()
	{
	self::SetNames();
		if(empty($_POST["codproducto"]) or empty($_POST["stockteorico"]) or empty($_POST["motivoajuste"]))
		{
			echo "1";
		    exit;
		}
		
		$sql = "UPDATE productos set"
			  ." stockteorico = ?, "
			  ." motivoajuste = ? "
			  ." where "
			  ." idproducto = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $stockteorico);
		$stmt->bindParam(2, $motivoajuste);
	    $stmt->bindParam(3, $idproducto);
		
		$stockteorico = limpiar($_POST["stockteorico"]);
		$motivoajuste = limpiar($_POST["motivoajuste"]);
		$idproducto = limpiar($_POST["idproducto"]);
		$stmt->execute();
	
		echo "<span class='fa fa-check-square-o'></span> EL AJUSTE DE STOCK DEL PRODUCTO SE HA REALIZADO EXITOSAMENTE";
		exit;
	}
########################## FUNCION AJUSTAR STOCK DE PRODUCTOS ##########################

######################### FUNCION ELIMINAR PRODUCTOS ###############################
	public function EliminarProductos()
	{
	self::SetNames();
		if ($_SESSION["acceso"]=="administrador") {

		$sql = "SELECT codproducto FROM detalleventas WHERE codproducto = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproducto"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM productos WHERE codproducto = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codproducto);
			$codproducto = decrypt($_GET["codproducto"]);
			$stmt->execute();

			$sql = "DELETE FROM kardex_productos where codproducto = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codproducto);
			$codproducto = decrypt($_GET["codproducto"]);
			$stmt->execute();

			$codproducto = decrypt($_GET["codproducto"]);
			if (file_exists("fotos/productos/".$codproducto.".jpg")){
		    //funcion para eliminar una carpeta con contenido
			$archivos = "fotos/productos/".$codproducto.".jpg";		
			unlink($archivos);
			}

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
########################### FUNCION ELIMINAR PRODUCTOS #################################

########################## FUNCION BUSCA KARDEX DE PRODUCTOS ##########################
public function BuscarkardexProducto() 
	       {
		self::SetNames();
		$sql ="SELECT * FROM (productos LEFT JOIN kardex_productos ON productos.codproducto=kardex_productos.codproducto) 
		LEFT JOIN categorias ON productos.codcategoria=categorias.codcategoria 
		LEFT JOIN proveedores ON productos.codproveedor=proveedores.codproveedor 
		WHERE kardex_productos.codproducto = ?";
        $stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_GET["codproducto"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
		echo "<div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN MOVIMIENTOS EN KARDEX PARA EL PRODUCTO INGRESADO</center>";
		echo "</div>";		
		exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
########################## FUNCION BUSCA KARDEX PRODUCTOS ############################

########################## FUNCION BUSCAR PRODUCTOS FACTURADOS ########################
public function BuscarProductosVendidos() 
	       {
		self::SetNames();
       $sql ="SELECT productos.codproducto, productos.producto, productos.codcategoria, detalleventas.descproducto, detalleventas.precioventa, productos.existencia, categorias.nomcategoria, ventas.fechaventa, SUM(detalleventas.cantventa) as cantidad FROM (ventas LEFT JOIN detalleventas ON ventas.codventa=detalleventas.codventa) LEFT JOIN productos ON detalleventas.codproducto=productos.codproducto LEFT JOIN categorias ON categorias.codcategoria=productos.codcategoria WHERE DATE_FORMAT(ventas.fechaventa,'%Y-%m-%d') >= ? AND DATE_FORMAT(ventas.fechaventa,'%Y-%m-%d') <= ? GROUP BY detalleventas.codproducto, detalleventas.precioventa, detalleventas.descproducto ORDER BY productos.codproducto ASC";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
		echo "<div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN PRODUCTOS FACTURADOS PARA EL RANGO DE FECHA INGRESADA</center>";
		echo "</div>";		
		exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION PRODUCTOS FACTURADOS ############################

############################ FIN DE CLASE PRODUCTOS #################################


























###################################### CLASE COMPRAS ###################################

############################# FUNCION REGISTRAR COMPRAS #############################
public function RegistrarCompras()
	{
	self::SetNames();
	if(empty($_POST["codcompra"]) or empty($_POST["fechaemision"]) or empty($_POST["fecharecepcion"]) or empty($_POST["codproveedor"]))
	{
		echo "1";
		exit;
	}

	if (limpiar(isset($_POST['fechavencecredito']))) {  

	$fechaactual = date("Y-m-d");
	$fechavence = date("Y-m-d",strtotime($_POST['fechavencecredito']));
	
     if (strtotime($fechavence) < strtotime($fechaactual)) {
  
     echo "2";
	 exit;
  
         }
    }

	if(empty($_SESSION["CarritoCompra"]))
	{
		echo "3";
		exit;
		
	} else {

    $sql = "SELECT codcompra FROM compras WHERE codcompra = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST['codcompra']));
	$num = $stmt->rowCount();
	if($num == 0)
	{

    $query = "INSERT INTO compras values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $codcompra);
	$stmt->bindParam(2, $codproveedor);
	$stmt->bindParam(3, $subtotalivasic);
	$stmt->bindParam(4, $subtotalivanoc);
	$stmt->bindParam(5, $ivac);
	$stmt->bindParam(6, $totalivac);
	$stmt->bindParam(7, $descuentoc);
	$stmt->bindParam(8, $totaldescuentoc);
	$stmt->bindParam(9, $totalpagoc);
	$stmt->bindParam(10, $tipocompra);
	$stmt->bindParam(11, $formacompra);
	$stmt->bindParam(12, $fechavencecredito);
	$stmt->bindParam(13, $fechapagado);
	$stmt->bindParam(14, $observaciones);
	$stmt->bindParam(15, $statuscompra);
	$stmt->bindParam(16, $fechaemision);
	$stmt->bindParam(17, $fecharecepcion);
	$stmt->bindParam(18, $codigo);
    
	$codcompra = limpiar($_POST["codcompra"]);
	$codproveedor = limpiar($_POST["codproveedor"]);
	$subtotalivasic = limpiar($_POST["txtsubtotal"]);
	$subtotalivanoc = limpiar($_POST["txtsubtotal2"]);
	$ivac = limpiar($_POST["iva"]);
	$totalivac = limpiar($_POST["txtIva"]);
	$descuentoc = limpiar($_POST["descuento"]);
	$totaldescuentoc = limpiar($_POST["txtDescuento"]);
	$totalpagoc = limpiar($_POST["txtTotal"]);
	$tipocompra = limpiar($_POST["tipocompra"]);
if (limpiar($_POST["tipocompra"]=="CONTADO")) { $formacompra = limpiar($_POST["formacompra"]); } else { $formacompra = "CREDITO"; }
if (limpiar($_POST["tipocompra"]=="CREDITO")) { $fechavencecredito = limpiar(date("Y-m-d",strtotime($_POST['fechavencecredito']))); } else { $fechavencecredito = "0000-00-00"; }
    $fechapagado = limpiar("0000-00-00");
    $observaciones = limpiar("NINGUNA");
if (limpiar($_POST["tipocompra"]=="CONTADO")) { $statuscompra = limpiar("PAGADA"); } else { $statuscompra = "PENDIENTE"; }
    $fechaemision = limpiar(date("Y-m-d",strtotime($_POST['fechaemision'])));
    $fecharecepcion = limpiar(date("Y-m-d",strtotime($_POST['fecharecepcion'])));
	$codigo = limpiar($_SESSION["codigo"]);
	$stmt->execute();
	
	$this->dbh->beginTransaction();

	$detalle = $_SESSION["CarritoCompra"];
	for ($i = 0, $iMax = count($detalle); $i < $iMax; $i++) {

	$query = "INSERT INTO detallecompras values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $codcompra);
	$stmt->bindParam(2, $tipoentrada);
    $stmt->bindParam(3, $codproducto);
    $stmt->bindParam(4, $producto);
    $stmt->bindParam(5, $codcategoria);
	$stmt->bindParam(6, $preciocomprac);
	$stmt->bindParam(7, $precioventac);
	$stmt->bindParam(8, $cantcompra);
	$stmt->bindParam(9, $ivaproductoc);
	//$stmt->bindParam(10, $montoiva);
	$stmt->bindParam(10, $descproductoc);
	$stmt->bindParam(11, $descfactura);
	$stmt->bindParam(12, $valortotal);
	$stmt->bindParam(13, $totaldescuentoc);
	$stmt->bindParam(14, $valorneto);
	$stmt->bindParam(15, $lotec);
	$stmt->bindParam(16, $fechaelaboracionc);
	$stmt->bindParam(17, $fechaexpiracionc);
		
	$codcompra = limpiar($_POST['codcompra']);
	$tipoentrada = limpiar($detalle[$i]['tipoentrada']);
	$codproducto = limpiar($detalle[$i]['txtCodigo']);
	$producto = limpiar($detalle[$i]['producto']);
	$codcategoria = limpiar($detalle[$i]['codcategoria']);
	$preciocomprac = limpiar($detalle[$i]['precio']);
	$precioventac = limpiar($detalle[$i]['precio2']);
	$cantcompra = limpiar($detalle[$i]['cantidad']);
	$ivaproductoc = limpiar($detalle[$i]['ivaproducto']);
	//$montoiva = limpiar($detalle[$i]['ivaproducto'] == 'SI' ? $_POST["iva"] : "0.00");
	$descproductoc = limpiar($detalle[$i]['descproducto']);
	$descfactura = limpiar($detalle[$i]['descproductofact']);
	$descuento = $detalle[$i]["descproductofact"]/100;
	$valortotal = number_format($detalle[$i]['precio']*$detalle[$i]['cantidad'], 2, '.', '');
	$totaldescuentoc = number_format($valortotal*$descuento, 2, '.', '');
    $valorneto = number_format($valortotal-$totaldescuentoc, 2, '.', '');
	$lotec = limpiar($detalle[$i]['lote']);
if (limpiar($detalle[$i]['fechaelaboracion']=="")) { $fechaelaboracionc = "0000-00-00";  } else { $fechaelaboracionc = limpiar(date("Y-m-d",strtotime($detalle[$i]['fechaelaboracion']))); }
if (limpiar($detalle[$i]['fechaexpiracion']=="")) { $fechaexpiracionc = "0000-00-00";  } else { $fechaexpiracionc = limpiar(date("Y-m-d",strtotime($detalle[$i]['fechaexpiracion']))); }
	$stmt->execute();

	if(limpiar($detalle[$i]['tipoentrada'])=="PRODUCTO"){

		############### VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################
		$sql = "SELECT existencia FROM productos 
		WHERE codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciaproductobd = $row['existencia'];

		############# ACTUALIZAMOS LA EXISTENCIA DE PRODUCTOS COMPRADOS ###############
		$sql = "UPDATE productos set "
		      ." preciocompra = ?, "
			  ." precioventa = ?, "
			  ." existencia = ?, "
			  ." ivaproducto = ?, "
			  ." descproducto = ?, "
			  ." fechaelaboracion = ?, "
			  ." fechaexpiracion = ?, "
			  ." codproveedor = ?, "
			  ." lote = ? "
			  ." WHERE "
			  ." codproducto = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $preciocompra);
		$stmt->bindParam(2, $precioventa);
		$stmt->bindParam(3, $existencia);
		$stmt->bindParam(4, $ivaproducto);
		$stmt->bindParam(5, $descproducto);
		$stmt->bindParam(6, $fechaelaboracion);
		$stmt->bindParam(7, $fechaexpiracion);
		$stmt->bindParam(8, $codproveedor);
		$stmt->bindParam(9, $lote);
		$stmt->bindParam(10, $codproducto);
		
		$preciocompra = limpiar($detalle[$i]['precio']);
		$precioventa = limpiar($detalle[$i]['precio2']);
		$existencia = limpiar($existenciaproductobd+$detalle[$i]['cantidad']);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
if (limpiar($detalle[$i]['fechaelaboracion']=="")) { $fechaelaboracion = "0000-00-00";  } else { $fechaelaboracion = limpiar(date("Y-m-d",strtotime($detalle[$i]['fechaelaboracion']))); }
if (limpiar($detalle[$i]['fechaexpiracion']=="")) { $fechaexpiracion = "0000-00-00";  } else { $fechaexpiracion = limpiar(date("Y-m-d",strtotime($detalle[$i]['fechaexpiracion']))); }
		$codproveedor = limpiar($_POST['codproveedor']);
		$lote = limpiar($detalle[$i]['lote']);
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$stmt->execute();

		############### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX ###################
        $query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcompra);
		$stmt->bindParam(2, $codproveedor);
		$stmt->bindParam(3, $codproducto);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivaproducto);
		$stmt->bindParam(10, $descproducto);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);		

		$codcompra = limpiar($_POST['codcompra']);
		$codproveedor = limpiar($_POST["codproveedor"]);
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$movimiento = limpiar("ENTRADAS");
		$entradas= limpiar($detalle[$i]['cantidad']);
		$salidas = limpiar("0");
		$devolucion = limpiar("0");
		$stockactual = limpiar($detalle[$i]['cantidad']+$existenciaproductobd);
		$precio = limpiar($detalle[$i]["precio"]);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
		$documento = limpiar("COMPRA: ".$_POST['codcompra']);
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();

	} else {

		############### VERIFICO LA EXISTENCIA DEL INSUMO EN ALMACEN ################
		$sql = "SELECT existencia FROM insumos WHERE codinsumo = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciainsumobd = $row['existencia'];

		############# ACTUALIZAMOS LA EXISTENCIA DE INSUMOS COMPRADOS ###############
		$sql = "UPDATE insumos set "
		      ." preciocompra = ?, "
			  ." precioventa = ?, "
			  ." existencia = ?, "
			  ." ivainsumo = ?, "
			  ." descinsumo = ?, "
			  ." fechaexpiracion = ?, "
			  ." codproveedor = ?, "
			  ." lote = ? "
			  ." WHERE "
			  ." codinsumo = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $preciocompra);
		$stmt->bindParam(2, $precioventa);
		$stmt->bindParam(3, $existencia);
		$stmt->bindParam(4, $ivainsumo);
		$stmt->bindParam(5, $descinsumo);
		$stmt->bindParam(6, $fechaexpiracion);
		$stmt->bindParam(7, $codproveedor);
		$stmt->bindParam(8, $lote);
		$stmt->bindParam(9, $codinsumo);
		
		$preciocompra = limpiar($detalle[$i]['precio']);
		$precioventa = limpiar($detalle[$i]['precio2']);
		$existencia = limpiar($detalle[$i]['cantidad']+$existenciainsumobd);
		$ivainsumo = limpiar($detalle[$i]['ivaproducto']);
		$descinsumo = limpiar($detalle[$i]['descproducto']);
if (limpiar($detalle[$i]['fechaexpiracion']=="")) { $fechaexpiracion = "0000-00-00";  } else { $fechaexpiracion = limpiar(date("Y-m-d",strtotime($detalle[$i]['fechaexpiracion']))); }
		$codproveedor = limpiar($_POST['codproveedor']);
		$lote = limpiar($detalle[$i]['lote']);
		$codinsumo = limpiar($detalle[$i]['txtCodigo']);
		$stmt->execute();

		############### REGISTRAMOS LOS DATOS DE INSUMOS EN KARDEX ###################
        $query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcompra);
		$stmt->bindParam(2, $codproveedor);
		$stmt->bindParam(3, $codinsumo);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivainsumo);
		$stmt->bindParam(10, $descinsumo);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);		

		$codcompra = limpiar($_POST['codcompra']);
		$codproveedor = limpiar($_POST["codproveedor"]);
		$codinsumo = limpiar($detalle[$i]['txtCodigo']);
		$movimiento = limpiar("ENTRADAS");
		$entradas= limpiar($detalle[$i]['cantidad']);
		$salidas = limpiar("0");
		$devolucion = limpiar("0");
		$stockactual = limpiar($detalle[$i]['cantidad']+$existenciainsumobd);
		$precio = limpiar($detalle[$i]["precio"]);
		$ivainsumo = limpiar($detalle[$i]['ivaproducto']);
		$descinsumo = limpiar($detalle[$i]['descproducto']);
		$documento = limpiar("COMPRA: ".$_POST['codcompra']);
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();

		}

    }
    ####################### DESTRUYO LA VARIABLE DE SESSION #####################
	unset($_SESSION["CarritoCompra"]);
    $this->dbh->commit();

		
echo "<span class='fa fa-check-square-o'></span> LA COMPRA HA SIDO REGISTRADA EXITOSAMENTE <a href='reportepdf?codcompra=".encrypt($codcompra)."&tipo=".encrypt("FACTURACOMPRA")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

echo "<script>window.open('reportepdf?codcompra=".encrypt($codcompra)."&tipo=".encrypt("FACTURACOMPRA")."', '_blank');</script>";
	exit;
		}
		else
		{
			echo "4";
			exit;
		}
	}
}
############################ FUNCION REGISTRAR COMPRAS ##########################

######################### FUNCION LISTAR COMPRAS ################################
public function ListarCompras()
{
	self::SetNames();

	$sql = "SELECT 
	compras.codcompra, 
	compras.codproveedor, 
	compras.subtotalivasic, 
	compras.subtotalivanoc, 
	compras.ivac, 
	compras.totalivac, 
	compras.descuentoc, 
	compras.totaldescuentoc, 
	compras.totalpagoc, 
	compras.statuscompra, 
	compras.fechavencecredito, 
	compras.fechapagado,
	compras.observaciones,
	compras.fecharecepcion, 
	compras.fechaemision, 
	proveedores.documproveedor, 
	proveedores.cuitproveedor, 
	proveedores.nomproveedor, 
	documentos.documento,
	SUM(detallecompras.cantcompra) AS articulos 
	FROM (compras LEFT JOIN detallecompras ON detallecompras.codcompra = compras.codcompra) 
	LEFT JOIN proveedores ON compras.codproveedor = proveedores.codproveedor 
	LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento
	LEFT JOIN usuarios ON compras.codigo = usuarios.codigo WHERE compras.statuscompra = 'PAGADA' GROUP BY detallecompras.codcompra";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
################################## FUNCION LISTAR COMPRAS ############################

########################### FUNCION LISTAR CUENTAS POR PAGAR #######################
public function ListarCuentasxPagar()
{
	self::SetNames();

	$sql = "SELECT 
	compras.codcompra, 
	compras.codproveedor, 
	compras.subtotalivasic, 
	compras.subtotalivanoc, 
	compras.ivac, 
	compras.totalivac, 
	compras.descuentoc, 
	compras.totaldescuentoc, 
	compras.totalpagoc, 
	compras.statuscompra, 
	compras.fechavencecredito, 
	compras.fechapagado,
	compras.observaciones,
	compras.fecharecepcion, 
	compras.fechaemision, 
	proveedores.documproveedor, 
	proveedores.cuitproveedor, 
	proveedores.nomproveedor, 
	documentos.documento,
	SUM(detallecompras.cantcompra) AS articulos 
	FROM (compras LEFT JOIN detallecompras ON detallecompras.codcompra = compras.codcompra) 
	LEFT JOIN proveedores ON compras.codproveedor = proveedores.codproveedor 
	LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento
	LEFT JOIN usuarios ON compras.codigo = usuarios.codigo WHERE compras.statuscompra = 'PENDIENTE' GROUP BY detallecompras.codcompra";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
######################### FUNCION LISTAR CUENTAS POR PAGAR ############################

############################ FUNCION PARA PAGAR COMPRAS ############################
public function PagarCompras()
	{
		if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria") {
		
		self::SetNames();
		$sql = " UPDATE compras SET"
			  ." statuscompra = ?, "
			  ." fechapagado = ? "
			  ." WHERE "
			  ." codcompra = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $statuscompra);
		$stmt->bindParam(2, $fechapagado);
		$stmt->bindParam(3, $codcompra);

		$statuscompra = limpiar("PAGADA");
		$fechapagado = limpiar(date("Y-m-d"));
		$codcompra = limpiar(decrypt($_GET["codcompra"]));
		$stmt->execute();
	
		echo "1";
		exit;
		   
		   } else {
		   
			echo "2";
			exit;
		  }
			
	}
########################## FUNCION PARA PAGAR COMPRAS ###############################

############################ FUNCION ID COMPRAS #################################
	public function ComprasPorId()
	{
		self::SetNames();
		$sql = " SELECT 
		compras.idcompra, 
		compras.codcompra,
		compras.codproveedor, 
		compras.subtotalivasic,
		compras.subtotalivanoc, 
		compras.ivac,
		compras.totalivac, 
		compras.descuentoc,
		compras.totaldescuentoc, 
		compras.totalpagoc, 
		compras.tipocompra,
		compras.formacompra,
		compras.fechavencecredito,
	    compras.fechapagado,
	    compras.observaciones,
		compras.statuscompra,
		compras.fechaemision,
		compras.fecharecepcion,
		compras.codigo,
		proveedores.documproveedor,
		proveedores.cuitproveedor, 
		proveedores.nomproveedor, 
		proveedores.tlfproveedor, 
		proveedores.direcproveedor, 
		proveedores.emailproveedor,
		proveedores.vendedor,
		proveedores.tlfvendedor,
	    documentos.documento,
		mediospagos.mediopago,
		usuarios.dni, 
		usuarios.nombres
		FROM (compras INNER JOIN proveedores ON compras.codproveedor = proveedores.codproveedor) 
		LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento
		LEFT JOIN mediospagos ON compras.formacompra = mediospagos.codmediopago
		LEFT JOIN usuarios ON compras.codigo = usuarios.codigo
		WHERE compras.codcompra = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codcompra"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
############################ FUNCION ID COMPRAS #################################
	
############################ FUNCION VER DETALLES COMPRAS ############################
public function VerDetallesCompras()
	{
		self::SetNames();
		$sql = "SELECT
		detallecompras.coddetallecompra,
		detallecompras.codcompra,
		detallecompras.tipoentrada,
		detallecompras.codproducto,
		detallecompras.producto,
		detallecompras.codcategoria,
		detallecompras.preciocomprac,
		detallecompras.precioventac,
		detallecompras.cantcompra,
		detallecompras.ivaproductoc,
		detallecompras.descproductoc,
		detallecompras.descfactura,
		detallecompras.valortotal, 
		detallecompras.totaldescuentoc,
		detallecompras.valorneto,
		detallecompras.lotec,
		detallecompras.fechaelaboracionc,
		detallecompras.fechaexpiracionc,
		categorias.nomcategoria		
		FROM detallecompras INNER JOIN categorias ON detallecompras.codcategoria = categorias.codcategoria
		WHERE detallecompras.codcompra = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codcompra"])));
		$num = $stmt->rowCount();
		
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
############################ FUNCION VER DETALLES COMPRAS ##############################

############################## FUNCION ACTUALIZAR COMPRAS #############################
	public function ActualizarCompras()
	{
		self::SetNames();
		if(empty($_POST["codcompra"]) or empty($_POST["fechaemision"]) or empty($_POST["fecharecepcion"]) or empty($_POST["codproveedor"]))
		{
			echo "1";
			exit;
		}

		if (limpiar(isset($_POST['fechavencecredito']))) {  

		$fechaactual = date("Y-m-d");
		$fechavence = date("Y-m-d",strtotime($_POST['fechavencecredito']));
		
	     if (strtotime($fechavence) < strtotime($fechaactual)) {
	  
	     echo "2";
		 exit;
	  
	         }
        }

		for($i=0;$i<count($_POST['coddetallecompra']);$i++){  //recorro el array
	        if (!empty($_POST['coddetallecompra'][$i])) {

		       if($_POST['cantcompra'][$i]==0){

			      echo "3";
			      exit();

		        }
	        }
        }

        $this->dbh->beginTransaction();

        for($i=0;$i<count($_POST['coddetallecompra']);$i++){  //recorro el array
	         if (!empty($_POST['coddetallecompra'][$i])) {

	    $sql = "SELECT cantcompra FROM detallecompras WHERE coddetallecompra = '".limpiar($_POST['coddetallecompra'][$i])."' AND codcompra = '".limpiar($_POST["codcompra"])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		
		$cantidadbd = $row['cantcompra'];

		if($cantidadbd != $_POST['cantcompra'][$i]){

			$query = "UPDATE detallecompras set"
			." cantcompra = ?, "
			." valortotal = ?, "
			." totaldescuentoc = ?, "
			." valorneto = ? "
			." WHERE "
			." coddetallecompra = ? AND codcompra = ?;
			";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $cantcompra);
			$stmt->bindParam(2, $valortotal);
			$stmt->bindParam(3, $totaldescuento);
			$stmt->bindParam(4, $valorneto);
			$stmt->bindParam(5, $coddetallecompra);
			$stmt->bindParam(6, $codcompra);

			$cantcompra = limpiar($_POST['cantcompra'][$i]);
			$preciocompra = limpiar($_POST['preciocompra'][$i]);
			$precioventa = limpiar($_POST['precioventa'][$i]);
			$ivaproducto = limpiar($_POST['ivaproducto'][$i]);
			$descuento = limpiar($_POST['descfactura'][$i]/100);
			$valortotal = number_format($_POST['preciocompra'][$i] * $_POST['cantcompra'][$i], 2, '.', '');
			$totaldescuento = number_format($valortotal * $descuento, 2, '.', '');
			$valorneto = number_format($valortotal - $totaldescuento, 2, '.', '');
			$coddetallecompra = limpiar($_POST['coddetallecompra'][$i]);
			$codcompra = limpiar($_POST["codcompra"]);
			$stmt->execute();

		if(limpiar($_POST['tipoentrada'][$i])=="PRODUCTO"){

		############### VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################	
		$sql = "SELECT existencia FROM productos WHERE codproducto = '".limpiar($_POST['codproducto'][$i])."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			$existenciaproductobd = $row['existencia'];
			$cantcompra = $_POST["cantcompra"][$i];
			$cantidadcomprabd = $_POST["cantidadcomprabd"][$i];
			$totalcompra = $cantcompra-$cantidadcomprabd;	

		############ ACTUALIZAMOS EXISTENCIA DEL PRODUCTO EN ALMACEN ################
		$sql2 = " UPDATE productos set "
			  ." existencia = ? "
			  ." WHERE "
			  ." codproducto = '".limpiar($_POST["codproducto"][$i])."';
			  ";
			  $stmt = $this->dbh->prepare($sql2);
			  $stmt->bindParam(1, $existencia);
			  $existencia = $existenciaproductobd+$totalcompra;
			  $stmt->execute();

		############## ACTUALIZAMOS LOS DATOS DEL PRODUCTO EN KARDEX ###################
		$sql3 = " UPDATE kardex_productos set "
		      ." entradas = ?, "
		      ." stockactual = ? "
			  ." WHERE "
			  ." codproceso = '".limpiar($_POST["codcompra"])."' and codproducto = '".limpiar($_POST["codproducto"][$i])."';
			   ";
		$stmt = $this->dbh->prepare($sql3);
		$stmt->bindParam(1, $entradas);
		$stmt->bindParam(2, $existencia);
		
		$entradas = limpiar($_POST["cantcompra"][$i]);
	    $existencia = $existenciaproductobd+$totalcompra;
		$stmt->execute();

		} else {

		############### VERIFICO LA EXISTENCIA DEL INSUMOS EN ALMACEN ################	
		$sql = "SELECT existencia FROM insumos WHERE codinsumo = '".limpiar($_POST['codproducto'][$i])."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			$existenciainsumobd = $row['existencia'];
			$cantcompra = $_POST["cantcompra"][$i];
			$cantidadcomprabd = $_POST["cantidadcomprabd"][$i];
			$totalcompra = $cantcompra-$cantidadcomprabd;	

		############ ACTUALIZAMOS EXISTENCIA DEL INSUMOS EN ALMACEN ################
		$sql2 = " UPDATE insumos set "
			  ." existencia = ? "
			  ." WHERE "
			  ." codinsumo = '".limpiar($_POST["codproducto"][$i])."';
			  ";
			  $stmt = $this->dbh->prepare($sql2);
			  $stmt->bindParam(1, $existencia);
			  $existencia = $existenciainsumobd+$totalcompra;
			  $stmt->execute();

		############## ACTUALIZAMOS LOS DATOS DEL INSUMOS EN KARDEX ###################
		$sql3 = " UPDATE kardex_insumos set "
		      ." entradas = ?, "
		      ." stockactual = ? "
			  ." WHERE "
			  ." codproceso = '".limpiar($_POST["codcompra"])."' and codinsumo = '".limpiar($_POST["codproducto"][$i])."';
			   ";
		$stmt = $this->dbh->prepare($sql3);
		$stmt->bindParam(1, $entradas);
		$stmt->bindParam(2, $existencia);
		
		$entradas = limpiar($_POST["cantcompra"][$i]);
	    $existencia = $existenciainsumobd+$totalcompra;
		$stmt->execute();

		}


			} else {

               echo "";

		       }
	        }
        }

        $this->dbh->commit();

            ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
			$sql3 = "SELECT SUM(valorneto) AS valorneto FROM detallecompras WHERE codcompra = '".limpiar($_POST["codcompra"])."' AND ivaproductoc = 'SI'";
			foreach ($this->dbh->query($sql3) as $row3)
			{
				$this->p[] = $row3;
			}
			$subtotalivasic = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);

		    ############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############
			$sql4 = "SELECT SUM(valorneto) AS valorneto FROM detallecompras WHERE codcompra = '".limpiar($_POST["codcompra"])."' AND ivaproductoc = 'NO'";
			foreach ($this->dbh->query($sql4) as $row4)
			{
				$this->p[] = $row4;
			}
			$subtotalivanoc = ($row4['valorneto']== "" ? "0.00" : $row4['valorneto']);

           ############ ACTUALIZO LOS TOTALES EN LA COTIZACION ##############
			$sql = " UPDATE compras SET "
			." codproveedor = ?, "
			." subtotalivasic = ?, "
			." subtotalivanoc = ?, "
			." totalivac = ?, "
			." descuentoc = ?, "
			." totaldescuentoc = ?, "
			." totalpagoc = ?, "
			." tipocompra = ?, "
			." formacompra = ?, "
			." fechavencecredito = ?, "
			." fechaemision = ?, "
			." fecharecepcion = ? "
			." WHERE "
			." codcompra = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $codproveedor);
			$stmt->bindParam(2, $subtotalivasic);
			$stmt->bindParam(3, $subtotalivanoc);
			$stmt->bindParam(4, $totalivac);
			$stmt->bindParam(5, $descuentoc);
			$stmt->bindParam(6, $totaldescuentoc);
			$stmt->bindParam(7, $totalpagoc);
			$stmt->bindParam(8, $tipocompra);
			$stmt->bindParam(9, $formacompra);
			$stmt->bindParam(10, $fechavencecredito);
			$stmt->bindParam(11, $fechaemision);
			$stmt->bindParam(12, $fecharecepcion);
			$stmt->bindParam(13, $codcompra);

			$codproveedor = limpiar($_POST["codproveedor"]);
			$ivac = $_POST["iva"]/100;
			$totalivac = number_format($subtotalivasic*$ivac, 2, '.', '');
			$descuentoc = limpiar($_POST["descuento"]);
		    $txtDescuento = $_POST["descuento"]/100;
		    $total = number_format($subtotalivasic+$subtotalivanoc+$totalivac, 2, '.', '');
		    $totaldescuentoc = number_format($total*$txtDescuento, 2, '.', '');
		    $totalpagoc = number_format($total-$totaldescuentoc, 2, '.', '');

			$tipocompra = limpiar($_POST["tipocompra"]);
			if (limpiar($_POST["tipocompra"]=="CONTADO")) { $formacompra = limpiar($_POST["formacompra"]); } else { $formacompra = "CREDITO"; }
			if (limpiar($_POST["tipocompra"]=="CREDITO")) { $fechavencecredito = limpiar(date("Y-m-d",strtotime($_POST['fechavencecredito']))); } else { $fechavencecredito = "0000-00-00"; }
			if (limpiar($_POST["tipocompra"]=="CONTADO")) { $statuscompra = limpiar("PAGADA"); } else { $statuscompra = "PENDIENTE"; }
			
			$fechaemision = limpiar(date("Y-m-d",strtotime($_POST['fechaemision'])));
			$fecharecepcion = limpiar(date("Y-m-d",strtotime($_POST['fecharecepcion'])));
			$codcompra = limpiar($_POST["codcompra"]);
			$stmt->execute();


echo "<span class='fa fa-check-square-o'></span> LA COMPRA HA SIDO ACTUALIZADA EXITOSAMENTE <a href='reportepdf?codcompra=".encrypt($codcompra)."&tipo=".encrypt("FACTURACOMPRA")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

echo "<script>window.open('reportepdf?codcompra=".encrypt($codcompra)."&tipo=".encrypt("FACTURACOMPRA")."', '_blank');</script>";
	exit;
}
############################# FUNCION ACTUALIZAR COMPRAS #########################

########################## FUNCION ELIMINAR DETALLES COMPRAS ########################
	public function EliminarDetallesCompras()
	{
	    self::SetNames();
		if ($_SESSION["acceso"]=="administrador") {

		$sql = "SELECT * FROM detallecompras WHERE codcompra = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codcompra"])));
		$num = $stmt->rowCount();
		if($num > 1)
		{

			$sql = "SELECT tipoentrada, codproducto, cantcompra, preciocomprac, ivaproductoc, descproductoc FROM detallecompras WHERE coddetallecompra = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute(array(decrypt($_GET["coddetallecompra"])));
			$num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p[] = $row;
			}
			$tipoentrada = $row['tipoentrada'];
			$codproducto = $row['codproducto'];
			$cantidadbd = $row['cantcompra'];
			$preciocomprabd = $row['preciocomprac'];
			$ivaproductobd = $row['ivaproductoc'];
			$descproductobd = $row['descproductoc'];

		if(limpiar($tipoentrada)=="PRODUCTO"){

			############### VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################
			$sql2 = "SELECT existencia FROM productos WHERE codproducto = ?";
			$stmt = $this->dbh->prepare($sql2);
			$stmt->execute(array($codproducto));
			$num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p[] = $row;
			}
			$existenciaproductobd = $row['existencia'];

			############# ACTUALIZAMOS LA EXISTENCIA DE PRODUCTO EN ALMACEN #############
			$sql = "UPDATE productos SET "
			." existencia = ? "
			." WHERE "
			." codproducto = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $existencia);
			$stmt->bindParam(2, $codproducto);

			$existencia = limpiar($existenciaproductobd-$cantidadbd);
			$stmt->execute();


		    ########## REGISTRAMOS LOS DATOS DEL PRODUCTO ELIMINADO EN KARDEX ##########
			$query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcompra);
			$stmt->bindParam(2, $codproveedor);
			$stmt->bindParam(3, $codproducto);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivaproducto);
			$stmt->bindParam(10, $descproducto);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);		

			$codcompra = limpiar(decrypt($_GET["codcompra"]));
		    $codproveedor = limpiar(decrypt($_GET["codproveedor"]));
			$movimiento = limpiar("DEVOLUCION");
			$entradas= limpiar("0");
			$salidas = limpiar("0");
			$devolucion = limpiar($cantidadbd);
			$stockactual = limpiar($existenciaproductobd-$cantidadbd);
			$ivaproducto = limpiar($ivaproductobd);
			$descproducto = limpiar($descproductobd);
			$precio = limpiar($preciocomprabd);
			$documento = limpiar("DEVOLUCION COMPRA: ".decrypt($_GET["codcompra"]));
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();

		} else {

			############### VERIFICO LA EXISTENCIA DEL INSUMO EN ALMACEN ################
			$sql2 = "SELECT existencia FROM insumos WHERE codinsumo = ?";
			$stmt = $this->dbh->prepare($sql2);
			$stmt->execute(array($codproducto));
			$num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p[] = $row;
			}
			$existenciainsumobd = $row['existencia'];

			############# ACTUALIZAMOS LA EXISTENCIA DE INSUMO EN ALMACEN #############
			$sql = "UPDATE insumos SET "
			." existencia = ? "
			." WHERE "
			." codinsumo = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $existencia);
			$stmt->bindParam(2, $codproducto);

			$existencia = limpiar($existenciainsumobd-$cantidadbd);
			$stmt->execute();

		    ########## REGISTRAMOS LOS DATOS DEL INSUMO ELIMINADO EN KARDEX ##########
			$query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcompra);
			$stmt->bindParam(2, $codproveedor);
			$stmt->bindParam(3, $codproducto);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivainsumo);
			$stmt->bindParam(10, $descinsumo);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);		

			$codcompra = limpiar(decrypt($_GET["codcompra"]));
		    $codproveedor = limpiar(decrypt($_GET["codproveedor"]));
			$movimiento = limpiar("DEVOLUCION");
			$entradas= limpiar("0");
			$salidas = limpiar("0");
			$devolucion = limpiar($cantidadbd);
			$stockactual = limpiar($existenciainsumobd-$cantidadbd);
			$ivainsumo = limpiar($ivaproductobd);
			$descinsumo = limpiar($descproductobd);
			$precio = limpiar($preciocomprabd);
			$documento = limpiar("DEVOLUCION COMPRA: ".decrypt($_GET["codcompra"]));
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();

		}


			########## ELIMINAMOS EL PRODUCTO EN DETALLES DE COMPRAS ###########
			$sql = "DELETE FROM detallecompras WHERE coddetallecompra = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$coddetallecompra);
			$coddetallecompra = decrypt($_GET["coddetallecompra"]);
			$stmt->execute();


		    ############ CONSULTO LOS TOTALES DE COMPRAS ##############
		    $sql2 = "SELECT ivac, descuentoc FROM compras WHERE codcompra = ?";
		    $stmt = $this->dbh->prepare($sql2);
		    $stmt->execute(array(decrypt($_GET["codcompra"])));
		    $num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$paea[] = $row;
			}
			$iva = $paea[0]["ivac"]/100;
		    $descuento = $paea[0]["descuentoc"]/100;

             ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
			$sql3 = "SELECT SUM(valorneto) AS valorneto FROM detallecompras WHERE codcompra = '".limpiar(decrypt($_GET["codcompra"]))."' AND ivaproductoc = 'SI'";
			foreach ($this->dbh->query($sql3) as $row3)
			{
				$this->p[] = $row3;
			}
			$subtotalivasic = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);

		    ############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############
			$sql4 = "SELECT SUM(valorneto) AS valorneto FROM detallecompras WHERE codcompra = '".limpiar(decrypt($_GET["codcompra"]))."' AND ivaproductoc = 'NO'";
			foreach ($this->dbh->query($sql4) as $row4)
			{
				$this->p[] = $row4;
			}
			$subtotalivanoc = ($row4['valorneto']== "" ? "0.00" : $row4['valorneto']);


            ############ ACTUALIZO LOS TOTALES EN LA COMPRAS ##############
			$sql = " UPDATE compras SET "
			." subtotalivasic = ?, "
			." subtotalivanoc = ?, "
			." totalivac = ?, "
			." totaldescuentoc = ?, "
			." totalpagoc = ? "
			." WHERE "
			." codcompra = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $subtotalivasic);
			$stmt->bindParam(2, $subtotalivanoc);
			$stmt->bindParam(3, $totalivac);
			$stmt->bindParam(4, $totaldescuentoc);
			$stmt->bindParam(5, $totalpagoc);
			$stmt->bindParam(6, $codcompra);

			$totalivac= number_format($subtotalivasic*$iva, 2, '.', '');
		    $total= number_format($subtotalivasic+$subtotalivanoc+$totalivac, 2, '.', '');
		    $totaldescuentoc = number_format($total*$descuento, 2, '.', '');
		    $totalpagoc = number_format($total-$totaldescuentoc, 2, '.', '');
			$codcompra = limpiar(decrypt($_GET["codcompra"]));
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
###################### FUNCION ELIMINAR DETALLES COMPRAS #######################

####################### FUNCION ELIMINAR COMPRAS #################################
	public function EliminarCompras()
	{
	self::SetNames();
		if ($_SESSION["acceso"]=="administrador") {

	$sql = "SELECT  tipoentrada, codproducto, cantcompra, preciocomprac, ivaproductoc, descproductoc FROM detallecompras WHERE codcompra = '".limpiar(decrypt($_GET["codcompra"]))."'";

		$array=array();

	foreach ($this->dbh->query($sql) as $row)
		{
				$this->p[] = $row;

			$tipoentrada = $row['tipoentrada'];
			$codproducto = $row['codproducto'];
			$cantidadbd = $row['cantcompra'];
			$preciocomprabd = $row['preciocomprac'];
			$ivaproductobd = $row['ivaproductoc'];
			$descproductobd = $row['descproductoc'];

	if(limpiar($tipoentrada)=="PRODUCTO"){

			$sql2 = "SELECT existencia FROM productos WHERE codproducto = ?";
			$stmt = $this->dbh->prepare($sql2);
			$stmt->execute( array($codproducto));
			$num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p[] = $row;
			}
			$existenciaproductobd = $row['existencia'];

			########### ACTUALIZAMOS LA EXISTENCIA DE PRODUCTO EN ALMACEN #############
			$sql = "UPDATE productos SET "
			." existencia = ? "
			." WHERE "
			." codproducto = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $existencia);
			$stmt->bindParam(2, $codproducto);

			$existencia = limpiar($existenciaproductobd-$cantidadbd);
			$stmt->execute();

		    ########## REGISTRAMOS LOS DATOS DEL PRODUCTO ELIMINADO EN KARDEX ##########
			$query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcompra);
			$stmt->bindParam(2, $codproveedor);
			$stmt->bindParam(3, $codproducto);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivaproducto);
			$stmt->bindParam(10, $descproducto);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);		

			$codcompra = limpiar(decrypt($_GET["codcompra"]));
		    $codproveedor = limpiar(decrypt($_GET["codproveedor"]));
			$movimiento = limpiar("DEVOLUCION");
			$entradas= limpiar("0");
			$salidas = limpiar("0");
			$devolucion = limpiar($cantidadbd);
			$stockactual = limpiar($existenciaproductobd-$cantidadbd);
			$ivaproducto = limpiar($ivaproductobd);
			$descproducto = limpiar($descproductobd);
			$precio = limpiar($preciocomprabd);
			$documento = limpiar("DEVOLUCION COMPRA: ".decrypt($_GET["codcompra"]));
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();

		} else {

			############### VERIFICO LA EXISTENCIA DEL INSUMO EN ALMACEN ################
			$sql2 = "SELECT existencia FROM insumos WHERE codinsumo = ?";
			$stmt = $this->dbh->prepare($sql2);
			$stmt->execute(array($codproducto));
			$num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p[] = $row;
			}
			$existenciainsumobd = $row['existencia'];

			############# ACTUALIZAMOS LA EXISTENCIA DE INSUMO EN ALMACEN #############
			$sql = "UPDATE insumos SET "
			." existencia = ? "
			." WHERE "
			." codinsumo = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $existencia);
			$stmt->bindParam(2, $codproducto);

			$existencia = limpiar($existenciainsumobd-$cantidadbd);
			$stmt->execute();

		    ########## REGISTRAMOS LOS DATOS DEL INSUMO ELIMINADO EN KARDEX ##########
			$query = "INSERT INTO kardex_insumos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcompra);
			$stmt->bindParam(2, $codproveedor);
			$stmt->bindParam(3, $codproducto);
			$stmt->bindParam(4, $movimiento);
			$stmt->bindParam(5, $entradas);
			$stmt->bindParam(6, $salidas);
			$stmt->bindParam(7, $devolucion);
			$stmt->bindParam(8, $stockactual);
			$stmt->bindParam(9, $ivainsumo);
			$stmt->bindParam(10, $descinsumo);
			$stmt->bindParam(11, $precio);
			$stmt->bindParam(12, $documento);
			$stmt->bindParam(13, $fechakardex);		

			$codcompra = limpiar(decrypt($_GET["codcompra"]));
		    $codproveedor = limpiar(decrypt($_GET["codproveedor"]));
			$movimiento = limpiar("DEVOLUCION");
			$entradas= limpiar("0");
			$salidas = limpiar("0");
			$devolucion = limpiar($cantidadbd);
			$stockactual = limpiar($existenciainsumobd-$cantidadbd);
			$ivainsumo = limpiar($ivaproductobd);
			$descinsumo = limpiar($descproductobd);
			$precio = limpiar($preciocomprabd);
			$documento = limpiar("DEVOLUCION COMPRA: ".decrypt($_GET["codcompra"]));
			$fechakardex = limpiar(date("Y-m-d"));
			$stmt->execute();

		}

	}

			$sql = "DELETE FROM compras WHERE codcompra = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codcompra);
			$codcompra = decrypt($_GET["codcompra"]);
			$stmt->execute();

			$sql = "DELETE FROM detallecompras WHERE codcompra = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codcompra);
			$codcompra = decrypt($_GET["codcompra"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {

			echo "2";
			exit;
		}
	}
######################### FUNCION ELIMINAR COMPRAS #################################

##################### FUNCION BUSQUEDA COMPRAS POR PROVEEDORES ###################
	public function BuscarComprasxProveedor() 
	{
		self::SetNames();
		$sql = "SELECT 
		compras.codcompra,
		compras.codproveedor, 
		compras.subtotalivasic,
		compras.subtotalivanoc, 
		compras.ivac,
		compras.totalivac, 
		compras.descuentoc,
		compras.totaldescuentoc, 
		compras.totalpagoc, 
		compras.tipocompra,
		compras.formacompra,
		compras.fechavencecredito,
	    compras.fechapagado,
	    compras.observaciones,
		compras.statuscompra,
		compras.fechaemision,
		compras.fecharecepcion,
		proveedores.documproveedor,
		proveedores.cuitproveedor, 
		proveedores.nomproveedor, 
		proveedores.tlfproveedor, 
		proveedores.direcproveedor, 
		proveedores.emailproveedor,
		proveedores.vendedor,
		proveedores.tlfvendedor,
	    documentos.documento,
		SUM(detallecompras.cantcompra) as articulos 
		FROM (compras LEFT JOIN detallecompras ON compras.codcompra=detallecompras.codcompra) 
		INNER JOIN proveedores ON compras.codproveedor = proveedores.codproveedor 
		LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento
		WHERE compras.codproveedor = ? GROUP BY detallecompras.codcompra";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproveedor"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON COMPRAS DE PRODUCTOS PARA EL PROVEEDOR SELECCIONADO</center>";
	echo "</div>";		
	exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
################### FUNCION BUSQUEDA COMPRAS POR PROVEEDORES ###################

###################### FUNCION BUSQUEDA COMPRAS POR FECHAS ###########################
	public function BuscarComprasxFechas() 
	{
		self::SetNames();
		$sql ="SELECT 
		compras.codcompra,
		compras.codproveedor, 
		compras.subtotalivasic,
		compras.subtotalivanoc, 
		compras.ivac,
		compras.totalivac, 
		compras.descuentoc,
		compras.totaldescuentoc, 
		compras.totalpagoc, 
		compras.tipocompra,
		compras.formacompra,
		compras.fechavencecredito,
	    compras.fechapagado,
	    compras.observaciones,
		compras.statuscompra,
		compras.fechaemision,
		compras.fecharecepcion,
		proveedores.documproveedor,
		proveedores.cuitproveedor, 
		proveedores.nomproveedor, 
		proveedores.tlfproveedor, 
		proveedores.direcproveedor, 
		proveedores.emailproveedor,
		proveedores.vendedor,
		proveedores.tlfvendedor,
	    documentos.documento,
		SUM(detallecompras.cantcompra) as articulos 
		FROM (compras LEFT JOIN detallecompras ON compras.codcompra=detallecompras.codcompra) 
		INNER JOIN proveedores ON compras.codproveedor = proveedores.codproveedor 
		LEFT JOIN documentos ON proveedores.documproveedor = documentos.coddocumento
		 WHERE DATE_FORMAT(compras.fecharecepcion,'%Y-%m-%d') >= ? AND DATE_FORMAT(compras.fecharecepcion,'%Y-%m-%d') <= ? GROUP BY detallecompras.codcompra";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON COMPRAS DE PRODUCTO PARA EL RANGO DE FECHA INGRESADO</center>";
	echo "</div>";		
	exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################### FUNCION BUSQUEDA COMPRAS POR FECHAS ###########################

############################# FIN DE CLASE COMPRAS ###################################






























################################ CLASE CAJAS DE VENTAS #############################

########################### FUNCION REGISTRAR CAJAS DE VENTAS ##########################
public function RegistrarCajas()
{
	self::SetNames();
	if(empty($_POST["nrocaja"]) or empty($_POST["nomcaja"]) or empty($_POST["codigo"]))
	{
		echo "1";
		exit;
	}
		
		$sql = "SELECT nrocaja FROM cajas WHERE nrocaja = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["nrocaja"]));
		$num = $stmt->rowCount();
		if($num > 0)
		{
		    echo "2";
		    exit;

		} else {
			
		$sql = "SELECT nomcaja FROM cajas WHERE nomcaja = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["nomcaja"]));
		$num = $stmt->rowCount();
		if($num > 0)
		{
			echo "3";
			exit;

		} else {
			
		$sql = "SELECT codigo FROM cajas WHERE codigo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codigo"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = "INSERT INTO cajas values (null, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $nrocaja);
			$stmt->bindParam(2, $nomcaja);
			$stmt->bindParam(3, $codigo);

			$nrocaja = limpiar($_POST["nrocaja"]);
			$nomcaja = limpiar($_POST["nomcaja"]);
			$codigo = limpiar($_POST["codigo"]);
			$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA CAJA PARA VENTA HA SIDO REGISTRADA EXITOSAMENTE";
			exit;

			} else {

			echo "4";
			exit;
		    }
		}
	}
}
########################### FUNCION REGISTRAR CAJAS DE VENTAS ###########################

######################### FUNCION LISTAR CAJAS DE VENTAS ##########################
public function ListarCajas()
{
	self::SetNames();
	
	if($_SESSION["acceso"] == "administrador") {

        $sql = "SELECT * FROM cajas INNER JOIN usuarios ON cajas.codigo = usuarios.codigo";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;

			} else {

		$sql = "SELECT * FROM cajas INNER JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE cajas.codigo = '".limpiar($_SESSION["codigo"])."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;

	}
}
########################## FUNCION LISTAR CAJAS DE VENTAS ##########################

########################## FUNCION LISTAR CAJAS ABIERTAS ##########################
public function ListarCajasAbiertas()
{
	self::SetNames();
	
	if($_SESSION["acceso"] == "recepcionista") {

    $sql = "SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo  
    WHERE cajas.codigo = '".limpiar($_SESSION["codigo"])."'
    AND arqueocaja.statusarqueo = 1
    GROUP BY arqueocaja.codarqueo";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

		} else {

	$sql = "SELECT * FROM cajas INNER JOIN arqueocaja ON cajas.codcaja = arqueocaja.codcaja 
	LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE arqueocaja.statusarqueo = '1'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
   }
}
############################ FUNCION LISTAR CAJAS ABIERTAS ############################

############################ FUNCION ID CAJAS DE VENTAS #################################
public function CajasPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM cajas LEFT JOIN usuarios ON usuarios.codigo = cajas.codigo WHERE cajas.codcaja = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codcaja"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID CAJAS DE VENTAS #################################

########################## FUNCION ACTUALIZAR CAJAS DE VENTAS #########################
public function ActualizarCajas()
{
	self::SetNames();
	if(empty($_POST["codcaja"]) or empty($_POST["nrocaja"]) or empty($_POST["nomcaja"]) or empty($_POST["codigo"]))
	{
		echo "1";
		exit;
	}
		$sql = "SELECT nrocaja FROM cajas WHERE codcaja != ? AND nrocaja = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codcaja"],$_POST["nrocaja"]));
		$num = $stmt->rowCount();
		if($num > 0)
		{
		    echo "2";
		    exit;

		} else {
			
		$sql = "SELECT nomcaja FROM cajas WHERE codcaja != ? AND nomcaja = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codcaja"],$_POST["nomcaja"]));
		$num = $stmt->rowCount();
		if($num > 0)
		{
			echo "3";
			exit;

		} else {
			
		$sql = "SELECT codigo FROM cajas WHERE codcaja != ? AND codigo = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codcaja"],$_POST["codigo"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$sql = "UPDATE cajas set "
			." nrocaja = ?, "
			." nomcaja = ?, "
			." codigo = ? "
			." where "
			." codcaja = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $nrocaja);
			$stmt->bindParam(2, $nomcaja);
			$stmt->bindParam(3, $codigo);
			$stmt->bindParam(4, $codcaja);

			$nrocaja = limpiar($_POST["nrocaja"]);
			$nomcaja = limpiar($_POST["nomcaja"]);
			$codigo = limpiar($_POST["codigo"]);
			$codcaja = limpiar($_POST["codcaja"]);
			$stmt->execute();

			echo "<span class='fa fa-check-square-o'></span> LA CAJA PARA VENTA HA SIDO ACTUALIZADA EXITOSAMENTE";
			exit;

			} else {

			echo "4";
			exit;
		    }
		}
	}
}
######################### FUNCION ACTUALIZAR CAJAS DE VENTAS #########################

########################### FUNCION ELIMINAR CAJAS DE VENTAS ############################
public function EliminarCajas()
{
	self::SetNames();
		if ($_SESSION['acceso'] == "administrador") {

		$sql = "SELECT codcaja FROM ventas WHERE codcaja = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codcaja"])));
		$num = $stmt->rowCount();
		if($num == 0)
		{

			$sql = "DELETE FROM cajas WHERE codcaja = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$codcaja);
			$codcaja = decrypt($_GET["codcaja"]);
			$stmt->execute();

			echo "1";
			exit;

		} else {
		   
			echo "2";
			exit;
		  } 
			
		} else {
		
		echo "3";
		exit;
	 }	
}
######################### FUNCION ELIMINAR CAJAS DE VENTAS ############################

########################### FIN DE CLASE CAJAS DE VENTAS #############################



























############################# CLASE ARQUEOS DE CAJA ###############################

######################## FUNCION PARA REGISTRAR ARQUEO DE CAJA ########################
public function RegistrarArqueoCaja()
{
	self::SetNames();
	if(empty($_POST["codcaja"]) or empty($_POST["montoinicial"]) or empty($_POST["fecharegistro"]))
	{
		echo "1";
		exit;
	}

	$sql = "SELECT codcaja FROM arqueocaja WHERE codcaja = ? AND statusarqueo = '1'";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST["codcaja"]));
	$num = $stmt->rowCount();
	if($num == 0)
	{
		$query = "INSERT INTO arqueocaja values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcaja);
		$stmt->bindParam(2, $montoinicial);
		$stmt->bindParam(3, $ingresos);
		$stmt->bindParam(4, $egresos);
		$stmt->bindParam(5, $creditos);
		$stmt->bindParam(6, $abonos);
		$stmt->bindParam(7, $dineroefectivo);
		$stmt->bindParam(8, $diferencia);
		$stmt->bindParam(9, $comentarios);
		$stmt->bindParam(10, $fechaapertura);
		$stmt->bindParam(11, $fechacierre);
		$stmt->bindParam(12, $statusarqueo);

		$codcaja = limpiar($_POST["codcaja"]);
		$montoinicial = limpiar($_POST["montoinicial"]);
	if (limpiar(isset($_POST['ingresos']))) { $ingresos = limpiar($_POST['ingresos']); } else { $ingresos = limpiar('0.00'); }
	if (limpiar(isset($_POST['egresos']))) { $egresos = limpiar($_POST['egresos']); } else { $egresos = limpiar('0.00'); }
	if (limpiar(isset($_POST['creditos']))) { $creditos = limpiar($_POST['creditos']); } else { $creditos = limpiar('0.00'); }
	if (limpiar(isset($_POST['abonos']))) { $abonos = limpiar($_POST['abonos']); } else { $abonos = limpiar('0.00'); }
	if (limpiar(isset($_POST['dineroefectivo']))) { $dineroefectivo = limpiar($_POST['dineroefectivo']); } else { $dineroefectivo = limpiar('0.00'); }
	if (limpiar(isset($_POST['diferencia']))) { $diferencia = limpiar($_POST['diferencia']); } else { $diferencia = limpiar('0.00'); }
	if (limpiar(isset($_POST['comentarios']))) { $comentarios = limpiar($_POST['comentarios']); } else { $comentarios = limpiar('NINGUNO'); }
		$fechaapertura = limpiar(date("Y-m-d h:i:s",strtotime($_POST['fecharegistro'])));
		$fechacierre = limpiar(date("0000-00-00 00:00:00"));
		$statusarqueo = limpiar("1");
		$stmt->execute();

		echo "<span class='fa fa-check-square-o'></span> EL ARQUEO DE CAJA HA SIDO REALIZADO EXITOSAMENTE";
		exit;

			} else {

			echo "2";
			exit;
	    }
}
####################### FUNCION PARA REGISTRAR ARQUEO DE CAJA ########################

######################### FUNCION PARA LISTAR ARQUEO DE CAJA #########################
public function ListarArqueoCaja()
{
	self::SetNames();
	
	if($_SESSION['acceso'] == "administrador") {

        $sql = "SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;

	} else {

		$sql = "SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE cajas.codigo = '".limpiar($_SESSION["codigo"])."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;

			}
		}
######################### FUNCION PARA LISTAR ARQUEO DE CAJA #########################

########################## FUNCION ID ARQUEO DE CAJA #############################
public function ArqueoCajaPorId()
{
	self::SetNames();
	$sql = "SELECT * FROM arqueocaja 
    INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
    LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo    
	WHERE arqueocaja.codarqueo = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codarqueo"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################## FUNCION ID ARQUEO DE CAJA #############################

###################### FUNCION VERIFICA ARQUEO DE CAJA POR USUARIO ####################
public function ArqueoCajaPorUsuario()
{
	self::SetNames();
	$sql = "SELECT * FROM arqueocaja INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja INNER JOIN usuarios ON cajas.codigo = usuarios.codigo WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = '1'";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_SESSION["codigo"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
###################### FUNCION VERIFICA ARQUEO DE CAJA POR USUARIO #####################

######################### FUNCION PARA CERRAR ARQUEO DE CAJA #########################
public function CerrarArqueoCaja()
{
	self::SetNames();
	if(empty($_POST["codarqueo"]) or empty($_POST["dineroefectivo"]))
	{
		echo "1";
		exit;
	}

	if($_POST["dineroefectivo"] != 0.00 || $_POST["dineroefectivo"] != 0){

		$sql = "UPDATE arqueocaja SET "
		." dineroefectivo = ?, "
		." diferencia = ?, "
		." comentarios = ?, "
		." fechacierre = ?, "
		." statusarqueo = ? "
		." WHERE "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $dineroefectivo);
		$stmt->bindParam(2, $diferencia);
		$stmt->bindParam(3, $comentarios);
		$stmt->bindParam(4, $fechacierre);
		$stmt->bindParam(5, $statusarqueo);
		$stmt->bindParam(6, $codarqueo);

		$dineroefectivo = limpiar($_POST["dineroefectivo"]);
		$diferencia = limpiar($_POST["diferencia"]);
		$comentarios = limpiar($_POST['comentarios']);
		$fechacierre = limpiar(date("Y-m-d H:i:s",strtotime($_POST['fecharegistro2'])));
		$statusarqueo = limpiar("0");
		$codarqueo = limpiar($_POST["codarqueo"]);
		$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL CIERRE DE CAJA FUE REALIZADO EXITOSAMENTE <a href='reportepdf?codarqueo=".encrypt($codarqueo)."&tipo=".encrypt("TICKETCIERRE")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR TICKET</strong></font color></a></div>";

	echo "<script>window.open('reportepdf?codarqueo=".encrypt($codarqueo)."&tipo=".encrypt("TICKETCIERRE")."', '_blank');</script>";
	exit;

	} else {

		echo "2";
		exit;
    }
}
######################### FUNCION PARA CERRAR ARQUEO DE CAJA ######################

######################### FUNCION PARA ACTUALIZAR ARQUEO DE CAJA #########################
public function ActualizarArqueoCaja()
{
	self::SetNames();
	if(empty($_POST["codarqueo"]) or empty($_POST["dineroefectivo"]))
	{
		echo "1";
		exit;
	}

	if($_POST["dineroefectivo"] != 0.00 || $_POST["dineroefectivo"] != 0){

		$sql = "UPDATE arqueocaja SET "
		." dineroefectivo = ?, "
		." diferencia = ?, "
		." comentarios = ? "
		." WHERE "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $dineroefectivo);
		$stmt->bindParam(2, $diferencia);
		$stmt->bindParam(3, $comentarios);
		$stmt->bindParam(4, $codarqueo);

		$dineroefectivo = limpiar($_POST["dineroefectivo"]);
		$diferencia = limpiar($_POST["diferencia"]);
		$comentarios = limpiar($_POST['comentarios']);
		$codarqueo = limpiar($_POST["codarqueo"]);
		$stmt->execute();

	echo "<span class='fa fa-check-square-o'></span> EL ARQUEO DE CAJA FUE ACTUALIZADO EXITOSAMENTE <a href='reportepdf?codarqueo=".encrypt($codarqueo)."&tipo=".encrypt("TICKETCIERRE")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR TICKET</strong></font color></a></div>";

	echo "<script>window.open('reportepdf?codarqueo=".encrypt($codarqueo)."&tipo=".encrypt("TICKETCIERRE")."', '_blank');</script>";
	exit;

	} else {

		echo "2";
		exit;
    }
}
######################### FUNCION PARA ACTUALIZAR ARQUEO DE CAJA ######################

###################### FUNCION BUSCAR ARQUEOS DE CAJA POR FECHAS ######################
public function BuscarArqueosxFechas() 
{
	self::SetNames();
	$sql = "SELECT * FROM arqueocaja 
	INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE arqueocaja.codcaja = ? 
	AND DATE_FORMAT(arqueocaja.fechaapertura,'%Y-%m-%d') BETWEEN ? AND ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(decrypt($_GET['codcaja'])));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(3, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "<center><div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<span class='fa fa-info-circle'></span> NO SE ENCONTRARON ARQUEOS DE CAJAS PARA LAS FECHAS SELECCIONADAS</div></center>";
		exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSCAR ARQUEOS DE CAJA POR FECHAS ######################

######################### FIN DE CLASE ARQUEOS DE CAJA ###############################



























############################ CLASE MOVIMIENTOS EN CAJAS #############################

###################### FUNCION PARA REGISTRAR MOVIMIENTO EN CAJA ########################
public function RegistrarMovimientos()
{
	self::SetNames();
	if(empty($_POST["tipomovimiento"]) or empty($_POST["montomovimiento"]) or empty($_POST["codmediopago"]) or empty($_POST["codcaja"]))
	{
		echo "1";
		exit;
	}
	elseif($_POST["montomovimiento"] == "" || $_POST["montomovimiento"] == 0 || $_POST["montomovimiento"] == 0.00)
	{
		echo "2";
		exit;

	}
	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja WHERE codcaja = ? AND statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(limpiar($_POST["codcaja"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "4";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$arqueo = $row['codarqueo'];
		$inicial = $row['montoinicial'];
		$ingreso = $row['ingresos'];
		$egresos = $row['egresos'];
		$total = $inicial+$ingreso-$egresos;
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

    ####################### OBTENGO TIPO DE PAGO #######################
	$sql = " SELECT 
	mediopago 
	FROM mediospagos 
	WHERE codmediopago = '".limpiar($_POST["codmediopago"])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$mediopago = $row['mediopago'];
	####################### OBTENGO TIPO DE PAGO #######################

	//REALIZO LA CONDICION SI EL MOVIMIENTO ES UN INGRESO
	if($_POST["tipomovimiento"]=="INGRESO"){ 

		############## ACTUALIZO DATOS EN ARQUEO ##############
		$sql = " UPDATE arqueocaja SET "
		." ingresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ingresos);
		$stmt->bindParam(2, $codcaja);

		$ingresos = number_format($_POST["montomovimiento"]+$ingreso, 2, '.', '');
		$codcaja = limpiar($_POST["codcaja"]);
		$stmt->execute();
		############## ACTUALIZO DATOS EN ARQUEO ##############

		############## REGISTRO EL MOVIMIENTOS EN CAJA ##############
		$query = "INSERT INTO movimientoscajas values (null, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcaja);
		$stmt->bindParam(2, $tipomovimiento);
		$stmt->bindParam(3, $descripcionmovimiento);
		$stmt->bindParam(4, $montomovimiento);
		$stmt->bindParam(5, $codmediopago);
		$stmt->bindParam(6, $fechamovimiento);
		$stmt->bindParam(7, $arqueo);

		$codcaja = limpiar($_POST["codcaja"]);
		$tipomovimiento = limpiar($_POST["tipomovimiento"]);
		$descripcionmovimiento = limpiar($_POST["descripcionmovimiento"]);
		$montomovimiento = limpiar($_POST["montomovimiento"]);
		$codmediopago = limpiar($_POST["codmediopago"]);
		$fechamovimiento = limpiar(date("Y-m-d h:i:s",strtotime($_POST['fecharegistro'])));
		$stmt->execute();
		############## REGISTRO EL MOVIMIENTOS EN CAJA ##############

	//REALIZO LA CONDICION SI EL MOVIMIENTO ES UN EGRESO
	} else {

		if($mediopago!="EFECTIVO"){

			echo "5";
			exit;

        } else if($_POST["montomovimiento"]>$total){

			echo "6";
			exit;

        } else {

		######################## ACTUALIZO DATOS EN ARQUEO ########################
        $sql = "UPDATE arqueocaja SET "
		." egresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = 1;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $egresos);
		$stmt->bindParam(2, $codcaja);

		$egresos = number_format($egresos+$_POST["montomovimiento"], 2, '.', '');
		$codcaja = limpiar($_POST["codcaja"]);
		$stmt->execute();
		######################## ACTUALIZO DATOS EN ARQUEO ########################

		############## REGISTRO EL MOVIMIENTOS EN CAJA ##############
		$query = "INSERT INTO movimientoscajas values (null, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codcaja);
		$stmt->bindParam(2, $tipomovimiento);
		$stmt->bindParam(3, $descripcionmovimiento);
		$stmt->bindParam(4, $montomovimiento);
		$stmt->bindParam(5, $codmediopago);
		$stmt->bindParam(6, $fechamovimiento);
		$stmt->bindParam(7, $arqueo);

		$codcaja = limpiar($_POST["codcaja"]);
		$tipomovimiento = limpiar($_POST["tipomovimiento"]);
		$descripcionmovimiento = limpiar($_POST["descripcionmovimiento"]);
		$montomovimiento = limpiar($_POST["montomovimiento"]);
		$codmediopago = limpiar($_POST["codmediopago"]);
		$fechamovimiento = limpiar(date("Y-m-d h:i:s",strtotime($_POST['fecharegistro'])));
		$stmt->execute();
		############## REGISTRO EL MOVIMIENTOS EN CAJA ##############

	    }
	}

	echo "<span class='fa fa-check-square-o'></span> EL MOVIMIENTO EN CAJA HA SIDO REGISTRADO EXITOSAMENTE";
	exit;	
}
###################### FUNCION PARA REGISTRAR MOVIMIENTO EN CAJA ########################

###################### FUNCION PARA LISTAR MOVIMIENTO EN CAJA ########################
public function ListarMovimientos()
{
	self::SetNames();
	
	if($_SESSION['acceso'] == "recepcionista") {

		$sql = " SELECT * FROM movimientoscajas
        LEFT JOIN arqueocaja ON movimientoscajas.codarqueo = arqueocaja.codarqueo 
		LEFT JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja 
		LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo 
		LEFT JOIN mediospagos ON mediospagos.codmediopago = movimientoscajas.codmediopago 
		WHERE usuarios.codigo = '".limpiar($_SESSION["codigo"])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;

	} else {

		$sql = "SELECT * FROM movimientoscajas 
        LEFT JOIN arqueocaja ON movimientoscajas.codarqueo = arqueocaja.codarqueo 
		LEFT JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja 
		LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo 
		LEFT JOIN mediospagos ON mediospagos.codmediopago = movimientoscajas.codmediopago";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
####################### FUNCION PARA LISTAR MOVIMIENTO EN CAJA ######################

####################### FUNCION ID MOVIMIENTO EN CAJA #############################
public function MovimientosPorId()
{
	self::SetNames();
	$sql = " SELECT * from movimientoscajas 
    LEFT JOIN arqueocaja ON movimientoscajas.codarqueo = arqueocaja.codarqueo 
    LEFT JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja
	LEFT JOIN mediospagos ON movimientoscajas.codmediopago = mediospagos.codmediopago 
	LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE movimientoscajas.codmovimiento = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codmovimiento"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################## FUNCION ID MOVIMIENTO EN CAJA #############################

##################### FUNCION PARA ACTUALIZAR MOVIMIENTOS EN CAJA #####################
public function ActualizarMovimientos()
{
	self::SetNames();
    if(empty($_POST["codmovimiento"]) or empty($_POST["tipomovimiento"]) or empty($_POST["montomovimiento"]) or empty($_POST["codmediopago"]) or empty($_POST["codcaja"]))
	{
		echo "1";
		exit;
	}
	elseif($_POST["montomovimiento"] == "" || $_POST["montomovimiento"] == 0 || $_POST["montomovimiento"] == 0.00)
	{
		echo "2";
		exit;

	}
	elseif($_POST["tipomovimiento"] != $_POST["tipomovimientobd"] || $_POST["codmediopago"] != $_POST["codmediopagobd"])
	{
		echo "3";
		exit;

	}

	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja WHERE codcaja = ? AND statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(limpiar($_POST["codcaja"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "4";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$arqueo = $row['codarqueo'];
		$inicial = $row['montoinicial'];
		$ingreso = $row['ingresos'];
		$egreso = $row['egresos'];
		$status = $row['statusarqueo'];
		$total = $inicial+$ingreso-$egreso;
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

	$montomovimiento = limpiar($_POST["montomovimiento"]);
	$montomovimientobd = limpiar($_POST["montomovimientobd"]);
	$ingresobd = number_format($ingreso-$montomovimientobd, 2, '.', '');
	$totalmovimiento = number_format($montomovimiento-$montomovimientobd, 2, '.', '');

	####################### OBTENGO TIPO DE PAGO #######################
	$sql = " SELECT 
	mediopago 
	FROM mediospagos 
	WHERE codmediopago = '".limpiar($_POST["codmediopago"])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$mediopago = $row['mediopago'];
	####################### OBTENGO TIPO DE PAGO #######################

	if($status == 1) {

	if($_POST["tipomovimiento"]=="INGRESO"){ //REALIZO LA CONDICION SI EL MOVIMIENTO ES UN INGRESO

	    ############## ACTUALIZO DATOS EN ARQUEO ##############
		$sql = "UPDATE arqueocaja SET "
		." ingresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ingresos);
		$stmt->bindParam(2, $codcaja);

		$ingresos = number_format($montomovimiento+$ingresobd, 2, '.', '');
		$codcaja = limpiar($_POST["codcaja"]);
		$stmt->execute();
		############## ACTUALIZO DATOS EN ARQUEO ##############

	    ############## ACTUALIZO DATOS EN MOVIMIENTO ##############
	    $sql = "UPDATE movimientoscajas SET"
		." codcaja = ?, "
		." tipomovimiento = ?, "
		." descripcionmovimiento = ?, "
		." montomovimiento = ?, "
		." codmediopago = ? "
		." WHERE "
		." codmovimiento = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $codcaja);
		$stmt->bindParam(2, $tipomovimiento);
		$stmt->bindParam(3, $descripcionmovimiento);
		$stmt->bindParam(4, $montomovimiento);
		$stmt->bindParam(5, $codmediopago);
		$stmt->bindParam(6, $codmovimiento);

		$codcaja = limpiar($_POST["codcaja"]);
		$tipomovimiento = limpiar($_POST["tipomovimiento"]);
		$descripcionmovimiento = limpiar($_POST["descripcionmovimiento"]);
		$montomovimiento = limpiar($_POST["montomovimiento"]);
		$codmediopago = limpiar($_POST["codmediopago"]);
		$codmovimiento = limpiar($_POST["codmovimiento"]);
		$stmt->execute();
		############## ACTUALIZO DATOS EN MOVIMIENTO ##############

	} else { //REALIZO LA CONDICION SI EL MOVIMIENTO ES UN EGRESO

	    if($mediopago!="EFECTIVO"){

			echo "5";
			exit;

        } else if($totalmovimiento>$total){

			echo "6";
			exit;

        } else {

	    ############## ACTUALIZO DATOS EN ARQUEO ##############
        $sql = "UPDATE arqueocaja SET"
		." egresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $egresos);
		$stmt->bindParam(2, $codcaja);

		$egresos = number_format($totalmovimiento+$egreso, 2, '.', '');
		$codcaja = limpiar($_POST["codcaja"]);
		$stmt->execute();
		############## ACTUALIZO DATOS EN ARQUEO ##############

		############## ACTUALIZO DATOS EN MOVIMIENTO ##############
		$sql = "UPDATE movimientoscajas SET"
		." codcaja = ?, "
		." tipomovimiento = ?, "
		." descripcionmovimiento = ?, "
		." montomovimiento = ?, "
		." codmediopago = ? "
		." WHERE "
		." codmovimiento = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $codcaja);
		$stmt->bindParam(2, $tipomovimiento);
		$stmt->bindParam(3, $descripcionmovimiento);
		$stmt->bindParam(4, $montomovimiento);
		$stmt->bindParam(5, $codmediopago);
		$stmt->bindParam(6, $codmovimiento);

		$codcaja = limpiar($_POST["codcaja"]);
		$tipomovimiento = limpiar($_POST["tipomovimiento"]);
		$descripcionmovimiento = limpiar($_POST["descripcionmovimiento"]);
		$montomovimiento = limpiar($_POST["montomovimiento"]);
		$codmediopago = limpiar($_POST["codmediopago"]);
		$codmovimiento = limpiar($_POST["codmovimiento"]);
		$stmt->execute();
		############## ACTUALIZO DATOS EN MOVIMIENTO ##############

	    }
	}	

	echo "<span class='fa fa-check-square-o'></span> EL MOVIMIENTO EN CAJA HA SIDO ACTUALIZADO EXITOSAMENTE";
    exit;

	} else {
		   
		echo "7";
		exit;
    }
} 
##################### FUNCION PARA ACTUALIZAR MOVIMIENTOS EN CAJA #######################	

###################### FUNCION PARA ELIMINAR MOVIMIENTOS EN CAJA #####################
public function EliminarMovimiento()
{
	if($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria" || $_SESSION['acceso'] == "recepcionista") {

    #################### OBTENEMOS DATOS DE MOVIMIENTO ####################
	$sql = "SELECT * FROM movimientoscajas 
	INNER JOIN arqueocaja ON movimientoscajas.codarqueo = arqueocaja.codarqueo 
	WHERE movimientoscajas.codmovimiento = '".limpiar(decrypt($_GET["codmovimiento"]))."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$tipomovimiento = $row['tipomovimiento'];
	$montomovimiento = $row['montomovimiento'];
	$codmediopago = $row['codmediopago'];
	$codcaja = $row['codcaja'];
	$descripcionmovimiento = $row['descripcionmovimiento'];
	$fechamovimiento = $row['fechamovimiento'];

	//OBTENEMOS CAMPOS DE ARQUEO
	$inicial = $row['montoinicial'];
	$ingreso = $row2['ingresos'];
	$egreso = $row2['egresos'];
	$status = $row['statusarqueo'];
	#################### OBTENEMOS DATOS DE MOVIMIENTO ####################

    if($status == 1) {

    if($tipomovimiento=="INGRESO"){

		############ ACTUALIZAMOS ARQUEO EN CAJA ############
	    $sql = "UPDATE arqueocaja SET"
		." ingresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $ingresos);
		$stmt->bindParam(2, $codcaja);

		$entro = $montomovimiento;
		$ingresos = number_format($ingreso-$entro, 2, '.', '');
		$stmt->execute();
		############ ACTUALIZAMOS ARQUEO EN CAJA ############

    } else {

		############ ACTUALIZAMOS ARQUEO EN CAJA ############
	    $sql = "UPDATE arqueocaja SET "
		." egresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $egresos);
		$stmt->bindParam(2, $codcaja);

		$salio = $montomovimiento;
		$egresos = number_format($egreso-$salio, 2, '.', '');
		$stmt->execute();
		############ ACTUALIZAMOS ARQUEO EN CAJA ############

    }

		############ ELIMINAMOS MOVIMIENTO ############
        $sql = "DELETE FROM movimientoscajas WHERE codmovimiento = ? ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codmovimiento);
		$codmovimiento = decrypt($_GET["codmovimiento"]);
		$stmt->execute();
		############ ELIMINAMOS MOVIMIENTO ############

	echo "1";
		exit;
		   
	} else {
		   
		echo "2";
		exit;
	}
			
	} else {
		
		echo "3";
		exit;
	}	
}
##################### FUNCION PARA ELIMINAR MOVIMIENTOS EN CAJAS  ######################

#################### FUNCION BUSCAR MOVIMIENTOS DE CAJA POR FECHAS #####################
public function BuscarMovimientosxFechas() 
	{
	self::SetNames();		
	$sql = "SELECT * FROM movimientoscajas 
	INNER JOIN cajas ON movimientoscajas.codcaja = cajas.codcaja 
	LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo 
	LEFT JOIN mediospagos ON mediospagos.codmediopago = movimientoscajas.codmediopago 
	WHERE movimientoscajas.codcaja = ? 
	AND DATE_FORMAT(movimientoscajas.fechamovimiento,'%Y-%m-%d') BETWEEN ? AND ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(decrypt($_GET['codcaja'])));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(3, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<center><div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<span class='fa fa-info-circle'></span> NO SE ENCONTRARON MOVIMIENTOS DE CAJAS PARA LAS FECHAS SELECCIONADAS</div></center>";
	exit;
	}
	else
	{
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
    }
}
##################### FUNCION BUSCAR MOVIMIENTOS DE CAJA POR FECHAS ###################

####################### FIN DE CLASE MOVIMIENTOS EN CAJAS ############################





































############################## CLASE RESERVACIONES ###################################

##################### FUNCION BUSCAR CLIENTE PARA RESERVACIONESS ###################
public function BuscarClientes() 
	       {
		self::SetNames();		
$sql = "SELECT * FROM clientes LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento WHERE clientes.dnicliente = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(limpiar($_GET["busqueda"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
		echo "<center><div class='alert alert-danger'>";
		echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		echo "<span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESULTADOS EN TU BÚSQUEDA <a class='on-default' data-placement='left' data-toggle='modal' data-original-title='Click aqui para Nuevo Cliente' data-target='#myModalCliente' style='cursor: pointer;' data-backdrop='static' data-keyboard='false'><font color='black'><strong>NUEVO CLIENTE</strong></font color></a></div></center>";
		exit;
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
	    }
	
}
##################### FUNCION BUSCAR CLIENTE PARA RESERVACIONESS ###################

####################### FUNCION BUSCAR HABITACIONES DISPONIBLES #######################
public function BuscarHabitaciones() 
	{
	self::SetNames();		
    $sql = "SELECT * FROM habitaciones 
    INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa 
    INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo
    WHERE habitaciones.maxadultos >= ? AND habitaciones.maxninos >= ? AND habitaciones.statushab = '0' AND habitaciones.codhabitacion NOT IN (SELECT codhabitacion FROM detallereservaciones WHERE '{$_GET['hasta_r']}' >= DATE_FORMAT(desde,'%d-%m-%Y') AND '{$_GET['desde_r']}' <= DATE_FORMAT(hasta,'%d-%m-%Y')) ORDER BY habitaciones.codhabitacion ASC";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim($_GET['adultos']));
	$stmt->bindValue(2, trim($_GET['children']));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<center><div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<span class='fa fa-info-circle'></span> NO SE ENCONTRARON HABITACIONES DISPONIBLES PARA LA FECHA SELECCIONADA</div></center>";
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
    }
}
###################### FUNCION BUSCAR HABITACIONES DISPONIBLES ##########################

######################### FUNCION REGISTRAR RESERVACIONES ###########################
	public function RegistrarReservaciones()
	{
		self::SetNames();

	if(limpiar(decrypt($_POST["tipo"]))!="" && limpiar(decrypt($_POST["tipo"]))=="1"){

		####################### VERIFICO ARQUEO DE CAJA #######################
		$sql = "SELECT * FROM arqueocaja 
		INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
		INNER JOIN usuarios ON cajas.codigo = usuarios.codigo 
		WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = 1";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_SESSION["codigo"]));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "1";
			exit;

		} else {
			
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			$codarqueo = $row['codarqueo'];
			$codcaja = $row['codcaja'];
		    $ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);
		    $credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);
		    $abono = ($row['abonos']== "" ? "0.00" : $row['abonos']);
		}
	    ####################### VERIFICO ARQUEO DE CAJA #######################
	}

    if(empty($_POST["codcliente"]))
	{
		echo "2";
		exit;
	}
	elseif($_POST["txtTotal"]=="0.00" || $_POST["txtTotal"]=="0")
	{
		echo "3";
		exit;
		
	}

	############## CREO LOS CODIGO DE RESERVACION-SERIE-AUTORIZACION ################
	$sql = " SELECT nroactividad, iniciofactura FROM configuracion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$nroactividad = $row['nroactividad'];
	$iniciofactura = $row['iniciofactura'];
	
	$sql = "SELECT codreservacion FROM reservaciones ORDER BY idreservacion DESC LIMIT 1";
	foreach ($this->dbh->query($sql) as $row){

		$reserva=$row["codreservacion"];
	}
	if(empty($reserva))
	{
		$codreservacion = $nroactividad.'-'.$iniciofactura;
		$codserie = $nroactividad;
		$codautorizacion = limpiar(GenerateRandomStringg());

	} else {

		$var = strlen($nroactividad."-");
        $var1 = substr($reserva , $var);
        $var2 = strlen($var1);
        $var3 = $var1 + 1;
        $var4 = str_pad($var3, $var2, "0", STR_PAD_LEFT);
        $codreservacion = $nroactividad.'-'.$var4;
		$codserie = $nroactividad;
		$codautorizacion = limpiar(GenerateRandomStringg());
	}
    ################# CREO LOS CODIGO RESERVACION-SERIE-AUTORIZACION ###############

	########################### SUBIR RECIBO DE TRANSFERENCIA ###########################
	if (isset($_FILES["sel_file"])){

    //datos del arhivo
    if (isset($_FILES['sel_file']['name'])) { $nombre_archivo = limpiar($_FILES['sel_file']['name']); } else { $nombre_archivo =''; }
    if (isset($_FILES['sel_file']['type'])) { $tipo_archivo = limpiar($_FILES['sel_file']['type']); } else { $tipo_archivo =''; }
    if (isset($_FILES['sel_file']['size'])) { $tamano_archivo = limpiar($_FILES['sel_file']['size']); } else { $tamano_archivo =''; } 

		/*if ($tipo_archivo == ''){	

			echo "4";
			exit;
		} */

	    //valido que los archivos cargados sean imagenes con extension jpeg,jpg
		if ($tipo_archivo != '' && $tipo_archivo != 'image/jpeg' && $tipo_archivo != 'image/jpg'){

	    //si los archivos cargados no son imagenes muestro un mensaje de error de carga
			echo "5";
			exit;

		} else {

        //aqui guardo la imagen en la carpeta fotos
		move_uploaded_file($_FILES['sel_file']['tmp_name'], "fotos/comprobantes/".$nombre_archivo) && rename("fotos/comprobantes/".$nombre_archivo,"fotos/comprobantes/".encrypt($codreservacion).".jpg");
		}
	}
    ########################### SUBIR RECIBO DE TRANSFERENCIA ###########################

    ########################### PAGO POR TARJETA DE CREDITO ###########################
	if (limpiar(isset($_POST["nrotarjeta"]))){
		
	    //si el tipo de tarjeta viene en blanco
		if (limpiar($_POST["tipotarjeta"]) == ''){	

			echo "6";
			exit;

	    //si el tipo de tarjeta es american express y tiene 3 digitos como verificacion
		} elseif (limpiar($_POST["tipotarjeta"]) == 'AMERICAN EXPRESS' && limpiar(strlen($_POST['codverifica'])) == '3'){	

			echo "7";
			exit;

		//si el tipo de tarjeta es american express y tiene 3 digitos como verificacion
		} elseif (limpiar($_POST["tipotarjeta"]) == 'VISA' && limpiar(strlen($_POST['codverifica'])) == '4' or limpiar($_POST["tipotarjeta"]) == 'MASTERCARD' && limpiar(strlen($_POST['codverifica'])) == '4' or limpiar($_POST["tipotarjeta"]) == 'DINERS CLUB' && limpiar(strlen($_POST['codverifica'])) == '4'){	

			echo "8";
			exit;

	     //si el numero de tarjeta ingresado es invalido
		} elseif (limpiar($_POST["tipotarjeta"]) == 'ERROR! TARJETA DE CREDITO INVALIDA') {

			echo "9";
			exit;
		}
	}			
    ########################### PAGO POR TARJETA DE CREDITO ###########################

	################### SELECCIONE LOS DATOS DEL CLIENTE ######################
    $sql = "SELECT
    clientes.codcliente,
    clientes.dnicliente,
    clientes.nomcliente, 
    clientes.correocliente, 
    clientes.limitecredito,
    ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
    ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible
    FROM clientes 
    LEFT JOIN
       (SELECT
       codcliente, montocredito       
       FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
       WHERE clientes.codcliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_POST["tipo"])=="1" ? $_POST['codcliente'] : decrypt($_POST['codcliente'])));
	$num = $stmt->rowCount();
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$p[] = $row;
	}
    $codcliente = $row['codcliente'];
    $dnicliente = $row['dnicliente'];
    $nomcliente = $row['nomcliente'];
    $correocliente = $row['correocliente'];
    $limitecredito = $row['limitecredito'];
    $montoactual = (empty($row['montoactual']) ? "0.00" : $row['montoactual']);
    $creditodisponible = $row['creditodisponible'];
    $montoabono = (empty($_POST["montoabono"]) ? "0.00" : $_POST["montoabono"]);
    $total = number_format($_POST["txtTotal"]-$montoabono, 2, '.', '');
    ################### SELECCIONE LOS DATOS DEL CLIENTE ######################
	
	if (limpiar(isset($_POST['fechavencecredito']))) {  

		$fechaactual = date("Y-m-d");
		$fechavence = date("Y-m-d",strtotime($_POST['fechavencecredito']));

		if (strtotime($fechavence) < strtotime($fechaactual)) {

			echo "10";
			exit;
		}
	}

	if ($_POST["tipopago"] == "CREDITO" && $_POST["codcliente"] == '0') { 

	        echo "11";
	        exit;

    } else if ($_POST["tipopago"] == "CREDITO") {

	    if ($limitecredito != "0.00" && $total > $creditodisponible) {
  
           echo "12";
	       exit;
        } 
    }

    if($_POST["tipopago"]=="CREDITO" && $_POST["montoabono"] >= $_POST["txtTotal"])
	{
		echo "13";
		exit;
	}

    $fecha = date("Y-m-d H:i:s");

    $query = "INSERT INTO reservaciones values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $tipodocumento);
	$stmt->bindParam(2, $codcaja);
	$stmt->bindParam(3, $codreservacion);
	$stmt->bindParam(4, $codserie);
	$stmt->bindParam(5, $codautorizacion);
	$stmt->bindParam(6, $codcliente);
	$stmt->bindParam(7, $iva);
	$stmt->bindParam(8, $totaliva);
	$stmt->bindParam(9, $subtotal);
	$stmt->bindParam(10, $descuento);
	$stmt->bindParam(11, $totaldescuento);
	$stmt->bindParam(12, $totalpago);
	$stmt->bindParam(13, $creditopagado);
	$stmt->bindParam(14, $tipopago);
	$stmt->bindParam(15, $formapago);
	$stmt->bindParam(16, $montopagado);
	$stmt->bindParam(17, $montodevuelto);
	$stmt->bindParam(18, $tipotarjeta);
	$stmt->bindParam(19, $nrotarjeta);
	$stmt->bindParam(20, $expira);
	$stmt->bindParam(21, $codverifica);
	$stmt->bindParam(22, $nrotransferencia);
	$stmt->bindParam(23, $cheque);
	$stmt->bindParam(24, $bancocheque);
	$stmt->bindParam(25, $fechavencecredito);
	$stmt->bindParam(26, $fechapagado);
	$stmt->bindParam(27, $statuspago);
	$stmt->bindParam(28, $reservacion);
	$stmt->bindParam(29, $reservacion_desde);
	$stmt->bindParam(30, $reservacion_hasta);
	$stmt->bindParam(31, $fecharegistro);
	$stmt->bindParam(32, $observaciones);
	$stmt->bindParam(33, $codigo);
    
	$tipodocumento = limpiar($_POST["tipodocumento"]);
	$codcaja = (limpiar(decrypt($_POST["tipo"]))=="1" ? $codcaja : "0");
	//$codcliente = (limpiar(decrypt($_POST["tipo"]))=="1" ? $_POST['codcliente'] : decrypt($_POST['codcliente']));
	$iva = limpiar($_POST["iva"]);
	$totaliva = limpiar($_POST["txtIva"]);
	$subtotal = limpiar($_POST["txtsubtotal"]);
	$descuento = limpiar($_POST["descuento"]);
	$totaldescuento = limpiar($_POST["txtDescuento"]);
	$totalpago = limpiar($_POST["txtTotal"]);
	$creditopagado = limpiar(isset($_POST['montoabono']) ? $_POST["montoabono"] : "0.00");
	$tipopago = limpiar($_POST["tipopago"]);
	$formapago = limpiar($_POST["tipopago"]=="CONTADO" ? $_POST["formapago"] : "CREDITO");
    $montopagado = limpiar(isset($_POST['montopagado']) ? $_POST["montopagado"] : "0.00");
	$montodevuelto = limpiar(isset($_POST['montodevuelto']) ? $_POST["montodevuelto"] : "0.00");
	$tipotarjeta = limpiar(isset($_POST['tipotarjeta']) ? $_POST["tipotarjeta"] : "0");
	$nrotarjeta = limpiar(isset($_POST['nrotarjeta']) ? $_POST["nrotarjeta"] : "0");
	$expira = limpiar(isset($_POST['expira']) ? $_POST["expira"] : "0");
	$codverifica = limpiar(isset($_POST['codverifica']) ? $_POST["codverifica"] : "0");
	$nrotransferencia = limpiar(isset($_POST['nrotransferencia']) ? $_POST["nrotransferencia"] : "0");
	$cheque = limpiar(isset($_POST['cheque']) ? $_POST["cheque"] : "0");
	$bancocheque = limpiar(isset($_POST['bancocheque']) ? $_POST["bancocheque"] : "0");
	$fechavencecredito = limpiar(isset($_POST['fechavencecredito']) ? date("Y-m-d",strtotime($_POST['fechavencecredito'])) : "0000-00-00");
	$fechapagado = limpiar("0000-00-00");
    if(decrypt($_POST["tipo"])=="1"){
	  $statuspago = limpiar($_POST["tipopago"]=="CONTADO" ? "PAGADA" : "PENDIENTE");
    }else{
	  $statuspago = limpiar("PENDIENTE");
    }
	$montodevuelto = limpiar(isset($_POST['montodevuelto']) ? $_POST["montodevuelto"] : "0.00");
    $reservacion = (limpiar(decrypt($_POST["tipo"]))=="1" && limpiar(date("Y-m-d",strtotime($_POST['desde_r']))) == limpiar(date("Y-m-d",strtotime($fecha))) ? limpiar("ACTIVA") : limpiar("PENDIENTE"));

	$reservacion_desde = limpiar(date("Y-m-d",strtotime($_POST['desde_r'])));
	$reservacion_hasta = limpiar(date("Y-m-d",strtotime($_POST['hasta_r'])));
    $fecharegistro = limpiar($fecha);
	$observaciones = limpiar(isset($_POST['observaciones']) ? $_POST["observaciones"] : "0");
    $codigo = limpiar(decrypt($_POST["tipo"])=="1" ? $_SESSION["codigo"] : "0");
	$stmt->execute();

	$this->dbh->beginTransaction();
	for($i=0;$i<count($_POST['codhabitacion']);$i++){  //recorro el array
        if (!empty($_POST['codhabitacion'][$i])) {

		$query = "INSERT INTO detallereservaciones values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codreservacion);
		$stmt->bindParam(2, $codhabitacion);
		$stmt->bindParam(3, $adultos);
		$stmt->bindParam(4, $children);
		$stmt->bindParam(5, $desde);
		$stmt->bindParam(6, $hasta);
		$stmt->bindParam(7, $deschabitacion);
		$stmt->bindParam(8, $valortotal);
		$stmt->bindParam(9, $subtotaldescuento);
		$stmt->bindParam(10, $valorneto);
		$stmt->bindParam(11, $fechadetalle);
			
		$codhabitacion = limpiar($_POST['codhabitacion'][$i]);
		$adultos = limpiar($_POST['cantadultos'][$i]);
		$children = limpiar($_POST['cantchildren'][$i]);
		$desde = limpiar(date("Y-m-d",strtotime($_POST['desde_r'])));
		$hasta = limpiar(date("Y-m-d",strtotime($_POST['hasta_r'])));
		$deschabitacion = limpiar($_POST['deschabitacion'][$i]);
		$valortotal = limpiar($_POST['valortotal'][$i]);
		$subtotaldescuento = limpiar($_POST['subtotaldescuento'][$i]);
		$valorneto = limpiar($_POST['valorneto'][$i]);
		$fechadetalle = limpiar($fecha);
		$stmt->execute();

	   }
    }
    $this->dbh->commit();

    if(limpiar(decrypt($_POST["tipo"]))!="" && limpiar(decrypt($_POST["tipo"]))=="1"){

    ################ AGREGAMOS EL INGRESO A CONTADO ################
	if (limpiar($_POST["tipopago"]=="EFECTIVO")){

		$sql = "UPDATE arqueocaja set "
		." ingresos = ? "
		." WHERE "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codarqueo);

		$txtTotal = number_format($_POST["txtTotal"]+$ingreso, 2, '.', '');
		$stmt->execute();
	}
    ################ AGREGAMOS EL INGRESO A CONTADO ################

    ################ AGREGAMOS EL INGRESO Y ABONOS A CREDITO ################
    if (limpiar($_POST["tipopago"]=="CREDITO")) {

		$sql = " UPDATE arqueocaja SET "
		." creditos = ?, "
		." abonos = ? "
		." where "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $totalabono);
		$stmt->bindParam(3, $codarqueo);

		$TotalCredito = number_format($_POST["txtTotal"]-$_POST["montoabono"], 2, '.', '');
		$txtTotal = number_format($TotalCredito+$credito, 2, '.', '');
		$totalabono = number_format($_POST["montoabono"]+$abono, 2, '.', '');
		$stmt->execute();

		$sql = " SELECT codcliente FROM creditosxclientes WHERE codcliente = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codcliente"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = "INSERT INTO creditosxclientes values (null, ?, ?);";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcliente);
			$stmt->bindParam(2, $montocredito);

			//$codcliente = limpiar(decrypt($_POST['codcliente']));
			$montocredito = number_format($_POST["txtTotal"]-$_POST["montoabono"], 2, '.', '');
			$stmt->execute();

		} else { 

			$sql = "UPDATE creditosxclientes set"
			." montocredito = ? "
			." where "
			." codcliente = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $montocredito);
			$stmt->bindParam(2, $codcliente);

			$montocredito = number_format($montoactual+($_POST["txtTotal"]-$_POST["montoabono"]), 2, '.', '');
			//$codcliente = limpiar(decrypt($_POST['codcliente']));
			$stmt->execute();
		}

		if (limpiar($_POST["montoabono"]!="0.00" && $_POST["montoabono"]!="0" && $_POST["montoabono"]!="")) {

			$query = "INSERT INTO abonoscreditosreservaciones values (null, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcaja);
			$stmt->bindParam(2, $codreservacion);
			$stmt->bindParam(3, $codcliente);
			$stmt->bindParam(4, $montoabono);
			$stmt->bindParam(5, $fechaabono);

			//$codcliente = limpiar(decrypt($_POST['codcliente']));
			$montoabono = number_format($_POST["montoabono"], 2, '.', '');
			$fechaabono = limpiar($fecha);
			$stmt->execute();
		}
	}
    ################ AGREGAMOS EL INGRESO Y ABONOS A CREDITO ################

    }

    echo "<span class='fa fa-check-square-o'></span> LA RESERVACION HA SIDO REGISTRADA EXITOSAMENTE <a href='reportepdf?codreservacion=".encrypt($codreservacion)."&tipo=".encrypt($tipodocumento)."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

    echo "<script>window.open('reportepdf?codreservacion=".encrypt($codreservacion)."&tipo=".encrypt($tipodocumento)."', '_blank');</script>";
	exit;
}
########################### FUNCION REGISTRAR RESERVACIONES #############################

########################### FUNCION LISTAR RESERVACIONES ################################
public function ListarReservaciones()
{
	self::SetNames();

	if ($_SESSION["acceso"]=="cliente") {

	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo WHERE reservaciones.codcliente = '".$_SESSION['codcliente']."' GROUP BY detallereservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

      } else {

    $sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo GROUP BY detallereservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

   }
}
########################### FUNCION LISTAR RESERVACIONES ############################

########################### FUNCION LISTAR RESERVACIONES POR TARJETAS DE CREDITO ################################
public function ListarReservacionesxTarjetas()
{
	self::SetNames();

	if ($_SESSION["acceso"]=="cliente") {

	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo  WHERE reservaciones.codcliente = '".$_SESSION['codcliente']."' AND tipopago = 'TARJETA' GROUP BY detallereservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

      } else {

    $sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo WHERE tipopago = 'TARJETA' GROUP BY detallereservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

   }
}
########################### FUNCION LISTAR RESERVACIONES POR TARJETAS DE CREDITO ############################

############################ FUNCION PARA ACTIVAR RESERVACIONES ############################
public function ActivarReservaciones()
	{
	
	if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {
		
		self::SetNames();
            $sql = "SELECT desde, hasta FROM detallereservaciones 
            WHERE codreservacion = '".limpiar(decrypt($_GET["codreservacion"]))."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			$fechaactual = date("Y-m-d");
			$desde = date("Y-m-d",strtotime($row['desde']));
			$hasta = date("Y-m-d",strtotime($row['hasta']));

	if (strtotime($fechaactual) < strtotime($desde)) {

				echo "2";
				exit;

			} else {

		$sql = " UPDATE reservaciones SET"
			  ." reservacion = ? "
			  ." WHERE "
			  ." codreservacion = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $reservacion);
		$stmt->bindParam(2, $codreservacion);

		$reservacion = limpiar("ACTIVA");
		$codreservacion = limpiar(decrypt($_GET["codreservacion"]));
		$stmt->execute();
	
		echo "1";
		exit;
		   }
    } else {
		   
		echo "3";
		exit;
    }
}
########################## FUNCION PARA ACTIVAR RESERVACIONES ###############################

############################ FUNCION PARA CULMINAR RESERVACIONES ############################
public function CulminarReservaciones()
	{
	
	if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="secretaria" || $_SESSION["acceso"]=="recepcionista") {
		
		self::SetNames();
            $sql = "SELECT desde, hasta FROM detallereservaciones 
            WHERE codreservacion = '".limpiar(decrypt($_GET["codreservacion"]))."'";
			foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
			$fechaactual = date("Y-m-d");
			$desde = date("Y-m-d",strtotime($row['desde']));
			$hasta = date("Y-m-d",strtotime($row['hasta']));

	if (strtotime($fechaactual) < strtotime($hasta)) {

				echo "2";
				exit;

			} else {

		$sql = " UPDATE reservaciones SET"
			  ." reservacion = ? "
			  ." WHERE "
			  ." codreservacion = ?;
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $reservacion);
		$stmt->bindParam(2, $codreservacion);

		$reservacion = limpiar("CULMINADA");
		$codreservacion = limpiar(decrypt($_GET["codreservacion"]));
		$stmt->execute();
	
		echo "1";
		exit;
		   }
    } else {
		   
		echo "3";
		exit;
    }
}
########################## FUNCION PARA CULMINAR RESERVACIONES ###############################

############################ FUNCION ID RESERVACIONES #################################
public function ReservacionesPorId()
	{
	self::SetNames();
	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codserie,
	reservaciones.codautorizacion,
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	clientes.codcliente,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.paiscliente, 
	clientes.ciudadcliente, 
	clientes.direccliente, 
	clientes.telefcliente, 
	clientes.correocliente,
	clientes.limitecredito,
	documentos.documento,
	cajas.nrocaja,
	cajas.nomcaja,
	usuarios.dni, 
	usuarios.nombres,
	ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
	ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible,
	    pag2.abonototal
    FROM (reservaciones INNER JOIN clientes ON reservaciones.codcliente = clientes.codcliente)
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo
    LEFT JOIN
        (SELECT codcliente, montocredito FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
    LEFT JOIN
        (SELECT codreservacion, codcliente, SUM(if(montoabono!='0',montoabono,'0.00')) AS abonototal
        FROM abonoscreditosreservaciones 
        WHERE codreservacion = '".limpiar(decrypt($_GET["codreservacion"]))."') pag2 ON pag2.codcliente = clientes.codcliente
        WHERE reservaciones.codreservacion = ?";
    $stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codreservacion"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID RESERVACIONES #################################
	
######################### FUNCION VER DETALLES RESERVACIONES ##########################
public function VerDetallesReservaciones()
	{
		self::SetNames();
		$sql = "SELECT
		detallereservaciones.coddetallereservacion,
		detallereservaciones.codreservacion,
		detallereservaciones.codhabitacion,
		detallereservaciones.adultos,
		detallereservaciones.children,
		detallereservaciones.desde,
		detallereservaciones.hasta,
		detallereservaciones.deschabitacion,
		detallereservaciones.valortotal,
		detallereservaciones.totaldescuento,
		detallereservaciones.valorneto,
		detallereservaciones.fechadetalle, 
		habitaciones.numhabitacion,
		habitaciones.descriphabitacion,
		tiposhabitaciones.nomtipo
		FROM detallereservaciones INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion 
		INNER JOIN tarifas ON habitaciones.codtarifa = tarifas.codtarifa
		INNER JOIN tiposhabitaciones ON tarifas.codtipo = tiposhabitaciones.codtipo
		WHERE detallereservaciones.codreservacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codreservacion"])));
		$num = $stmt->rowCount();
		
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
######################### FUNCION VER DETALLES RESERVACIONES ############################

######################### FUNCION ACTUALIZAR RESERVACIONES ###########################
public function ActualizarReservaciones()
	{
	self::SetNames();
	if(empty($_POST["codreservacion"]) or empty($_POST["tipopago"]))
	{
		echo "1";
		exit;
	}

	    ############ CONSULTO TOTAL ACTUAL ##############
		$sql = "SELECT totalpago FROM reservaciones WHERE codreservacion = '".limpiar($_POST["codreservacion"])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$totalpagobd = $row['totalpago'];

	   ################### SELECCIONE LOS DATOS DEL CLIENTE ######################
	    $sql = "SELECT
        clientes.codcliente,
        clientes.dnicliente,
	    clientes.nomcliente, 
	    clientes.correocliente, 
	    clientes.limitecredito,
	    ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
	    ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible
        FROM clientes 
        LEFT JOIN
           (SELECT
           codcliente, montocredito       
           FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
           WHERE clientes.codcliente = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST['codcliente']));
		$num = $stmt->rowCount();
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[] = $row;
		}
        $codcliente = $row['codcliente'];
        $dnicliente = $row['dnicliente'];
        $nomcliente = $row['nomcliente'];
        $correocliente = $row['correocliente'];
        $limitecredito = $row['limitecredito'];
        $montoactual = $row['montoactual'];
        $creditodisponible = $row['creditodisponible'];
        $montoabono = (empty($_POST["abonototal"]) ? "0.00" : $_POST["abonototal"]);
        $total = number_format($_POST["txtTotal"], 2, '.', '');

    if ($_POST["tipopago"] == "CREDITO") {

      
		   /*if ($limitecredito != "0.00" && $total > $creditodisponible) {

	           echo "3";
		       exit;

	        }*/ 
	 }

	$this->dbh->beginTransaction();
	for($i=0;$i<count($_POST['coddetallereservacion']);$i++){  //recorro el array
	if (!empty($_POST['coddetallereservacion'][$i])) {

	$query = "UPDATE detallereservaciones set"
		." desde = ?, "
		." hasta = ?, "
		." valortotal = ?, "
		." totaldescuento = ?, "
		." valorneto = ? "
		." WHERE "
		." coddetallereservacion = ? AND codreservacion = ?;
		";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $desde);
		$stmt->bindParam(2, $hasta);
		$stmt->bindParam(3, $valortotal);
		$stmt->bindParam(4, $totaldescuento);
		$stmt->bindParam(5, $valorneto);
		$stmt->bindParam(6, $coddetalleventa);
		$stmt->bindParam(7, $codreservacion);

		$desde = limpiar(date("Y-m-d",strtotime($_POST['desde_r'])));
		$hasta = limpiar(date("Y-m-d",strtotime($_POST['hasta_r'])));
		$descuento = $_POST['deschabitacion'][$i]/100;
		$valortotal = number_format($_POST['valortotal'][$i], 2, '.', '');
		$totaldescuento = number_format($valortotal * $descuento, 2, '.', '');
		$valorneto = number_format($valortotal - $totaldescuentov, 2, '.', '');
		$coddetallereservacion = limpiar($_POST['coddetallereservacion'][$i]);
		$codreservacion = limpiar($_POST["codreservacion"]);
		$stmt->execute();

			} 
        }    
            $this->dbh->commit();

        ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
        $sql3 = "SELECT SUM(valorneto) AS valorneto FROM coddetallereservacion WHERE codreservacion = '".limpiar($_POST["codreservacion"])."'";
        foreach ($this->dbh->query($sql3) as $row3)
        {
        	$this->p[] = $row3;
        }
        $subtotalivasi = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);

        ############ ACTUALIZO LOS TOTALES EN LA COTIZACION ##############
        $sql = " UPDATE reservaciones SET "
        ." codcliente = ?, "
        ." subtotal = ?, "
        ." totaliva = ?, "
        ." descuento = ?, "
        ." totaldescuento = ?, "
        ." totalpago = ?, "
		." montodevuelto = ? "
        ." WHERE "
        ." codreservacion = ?;
        ";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $codcliente);
        $stmt->bindParam(2, $subtotal);
        $stmt->bindParam(3, $totaliva);
        $stmt->bindParam(4, $descuento);
        $stmt->bindParam(5, $totaldescuento);
        $stmt->bindParam(6, $totalpago);
		$stmt->bindParam(7, $montodevuelto);
        $stmt->bindParam(8, $codreservacion);

        $codcliente = limpiar($_POST["codcliente"]);
        $iva = $_POST["iva"]/100;
        $totaliva = number_format($subtotal*$iva, 2, '.', '');
        $descuento = limpiar($_POST["descuento"]);
        $txtDescuento = $_POST["descuento"]/100;
        $total = number_format($subtotal+$totaliva, 2, '.', '');
        $totaldescuento = number_format($total*$txtDescuento, 2, '.', '');
        $totalpago = number_format($total-$totaldescuento, 2, '.', '');
		$montodevuelto = number_format($totalpago > $_POST["pagado"] ? "0.00" : $_POST["pagado"]-$totalpago, 2, '.', '');
        $codreservacion = limpiar($_POST["codreservacion"]);
        $tipodocumento = limpiar($_POST["tipodocumento"]);
        $tipopago = limpiar($_POST["tipopago"]);
        $observaciones = limpiar($_POST["observaciones"]);
        $stmt->execute();

    #################### AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ####################
	if (limpiar($_POST["tipopago"]=="CONTADO") && $totalpagobd != $totalpago){

		$sql = "SELECT ingresos FROM arqueocaja WHERE codcaja = '".limpiar($_POST["codcaja"])."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);

		$sql = "UPDATE arqueocaja set "
		." ingresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtTotal);
		$stmt->bindParam(2, $codcaja);

        $TxtTotal = number_format(($totalpagobd>$totalpago ? $ingreso-($totalpagobd-$totalpago) : $ingreso+($totalpago-$totalpagobd)), 2, '.', '');
		$codcaja = limpiar($_POST["codcaja"]);
		$stmt->execute();
	}
    #################### AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ####################

    ############## AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ##################
	if (limpiar($_POST["tipopago"]=="CREDITO") && $totalpagobd != $totalpago) {

		$sql = "SELECT creditos FROM arqueocaja WHERE codcaja = '".limpiar($_POST["codcaja"])."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);

		$sql = " UPDATE arqueocaja SET "
		." creditos = ? "
		." where "
		." codcaja = ? and statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtTotal);
		$stmt->bindParam(2, $codcaja);

		$TxtTotal = number_format(($totalpagobd>$totalpago ? $credito-($totalpagobd-$totalpago) : $credito+($totalpago-$totalpagobd)), 2, '.', '');
		$codcaja = limpiar($_POST["codcaja"]);
		$stmt->execute(); 	

		$sql = "UPDATE creditosxclientes set"
		." montocredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $montocredito);
		$stmt->bindParam(2, $codcliente);

        $montocredito = number_format(($totalpagobd>$totalpago ? $montoactual-($totalpagobd-$totalpago) : $montoactual+($totalpago-$totalpagobd)), 2, '.', '');
		$codcliente = limpiar($_POST["codcliente"]);
		$stmt->execute(); 
	}
    ############## AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ##################

echo "<span class='fa fa-check-square-o'></span> LA RESERVACION HA SIDO ACTUALIZADA EXITOSAMENTE <a href='reportepdf?codreservacion=".encrypt($codreservacion)."&tipo=".encrypt($tipodocumento)."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

echo "<script>window.open('reportepdf?codreservacion=".encrypt($codreservacion)."&tipo=".encrypt($tipodocumento)."', '_blank');</script>";
	exit;
}
############################ FUNCION ACTUALIZAR RESERVACIONES #########################

###################### FUNCION ELIMINAR DETALLES RESERVACIONES ##########################
public function EliminarDetallesReservaciones()
{
	
	self::SetNames();
	if ($_SESSION["acceso"]=="administrador") {

        ############ CONSULTO TOTAL ACTUAL ##############
		$sql = "SELECT codcaja, codcliente, tipopago, totalpago FROM reservaciones WHERE codreservacion = '".limpiar(decrypt($_GET["codreservacion"]))."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$cajabd = $row['codcaja'];
		$clientebd = $row['codcliente'];
		$tipopagobd = $row['tipopago'];
		$totalpagobd = $row['totalpago'];

		################### VERIFICO MONTO DE CREDITO DEL CLIENTE ######################
		$sql = "SELECT montocredito FROM creditosxclientes WHERE codcliente = '".$clientebd."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$monto = (empty($row['montocredito']) ? "0.00" : $row['montocredito']);


		$sql = "SELECT * FROM detallereservaciones WHERE codreservacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codreservacion"])));
		$num = $stmt->rowCount();
		if($num > 1)
		{

			$sql = "DELETE FROM detallereservaciones WHERE coddetallereservacion = ?";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1,$coddetallereservacion);
			$coddetallereservacion = decrypt($_GET["coddetallereservacion"]);
			$stmt->execute();

		    ############ CONSULTO LOS TOTALES DE COTIZACIONES ##############
			$sql2 = "SELECT iva, descuento FROM reservaciones WHERE codreservacion = ?";
			$stmt = $this->dbh->prepare($sql2);
			$stmt->execute(array(decrypt($_GET["codreservacion"])));
			$num = $stmt->rowCount();

			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$paea[] = $row;
			}
			$iva = $paea[0]["iva"]/100;
			$descuento = $paea[0]["descuento"]/100;

            ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
			$sql3 = "SELECT SUM(valorneto) AS valorneto FROM detallereservaciones WHERE codreservacion = '".limpiar(decrypt($_GET["codreservacion"]))."'";
			foreach ($this->dbh->query($sql3) as $row3)
			{
				$this->p[] = $row3;
			}
			$subtotal = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);

            ############ ACTUALIZO LOS TOTALES EN LA COTIZACION ##############
			$sql = " UPDATE reservaciones SET "
			." subtotal = ?, "
			." totaliva = ?, "
			." totaldescuento = ?, "
			." totalpago = ? "
			." WHERE "
			." codreservacion = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $subtotal);
			$stmt->bindParam(2, $totaliva);
			$stmt->bindParam(3, $totaldescuento);
			$stmt->bindParam(4, $totalpago);
			$stmt->bindParam(5, $codreservacion);

			$totaliva= number_format($subtotal*$iva, 2, '.', '');
			$total= number_format($subtotal+$totaliva, 2, '.', '');
			$totaldescuento= number_format($total*$descuento, 2, '.', '');
			$totalpago= number_format($total-$totaldescuento, 2, '.', '');
			$codreservacion = limpiar(decrypt($_GET["codreservacion"]));
			$stmt->execute();

	#################### QUITAMOS LA DIFERENCIA EN CAJA ####################
	if ($tipopagobd=="EFECTIVO"){

		$sql = "SELECT ingresos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);

		$sql = "UPDATE arqueocaja set "
		." ingresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = '1';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtTotal);
		$stmt->bindParam(2, $cajabd);

		$Calculo = number_format($totalpagobd-$totalpago, 2, '.', '');
		$TxtTotal = number_format($ingreso-$Calculo, 2, '.', '');
		$stmt->execute();
	}
    #################### QUITAMOS LA DIFERENCIA EN CAJA ####################
    
    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################
	if ($tipopagobd=="CREDITO") {

		$sql = "SELECT creditos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);

		$sql = " UPDATE arqueocaja SET "
	    ." creditos = ? "
	    ." where "
	    ." codcaja = ? and statusarqueo = '1';
	    ";
	    $stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $TxtTotal);
	    $stmt->bindParam(2, $cajabd);

	    $Calculo = number_format($totalpagobd-$totalpago, 2, '.', '');
	    $TxtTotal = number_format($credito-$Calculo, 2, '.', '');
	    $stmt->execute();

		$sql = "UPDATE creditosxclientes set"
	    ." montocredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $montocredito);
		$stmt->bindParam(2, $clientebd);

		$montocredito = number_format($monto-$Calculo, 2, '.', '');
		$stmt->execute(); 	
	}
    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################

			echo "1";
			exit;

		} else {

			echo "2";
			exit;
		} 

	} else {
		
		echo "3";
		exit;
	}	
}
######################## FUNCION ELIMINAR DETALLES RESERVACIONES ######################

######################## FUNCION ELIMINAR RESERVACIONES #################################
public function EliminarReservaciones()
{
	self::SetNames();
	if ($_SESSION["acceso"]=="administrador") {

        ############ CONSULTO TOTAL ACTUAL ##############
		$sql = "SELECT codcaja, codcliente, tipopago, totalpago FROM reservaciones WHERE codreservacion = '".limpiar(decrypt($_GET["codreservacion"]))."'";
		foreach ($this->dbh->query($sql) as $row)
			{
				$this->p[] = $row;
			}
		$cajabd = $row['codcaja'];
		$clientebd = $row['codcliente'];
		$tipopagobd = $row['tipopago'];
		$totalpagobd = $row['totalpago'];

		################### VERIFICO MONTO DE CREDITO DEL CLIENTE ######################
		$sql = "SELECT montocredito FROM creditosxclientes WHERE codcliente = '".$clientebd."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
        $monto = (empty($row['montocredito']) ? "0.00" : $row['montocredito']);


	#################### QUITAMOS LA DIFERENCIA EN CAJA ####################
	if ($tipopagobd=="EFECTIVO"){

		$sql = "SELECT ingresos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);

		$sql = "UPDATE arqueocaja set "
	    ." ingresos = ? "
	    ." WHERE "
	    ." codcaja = ? AND statusarqueo = '1';
	    ";
	    $stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $TxtTotal);
	    $stmt->bindParam(2, $cajabd);

        $TxtTotal = number_format($ingreso-$totalpagobd, 2, '.', '');
	    $stmt->execute();
	}
    #################### QUITAMOS LA DIFERENCIA EN CAJA ####################

    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################
	if ($tipopagobd=="CREDITO") {

		$sql = "SELECT creditos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);

		$sql = " UPDATE arqueocaja SET "
	    ." creditos = ? "
	    ." where "
	    ." codcaja = ? and statusarqueo = '1';
	    ";
	    $stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $TxtTotal);
	    $stmt->bindParam(2, $cajabd);

	    $TxtTotal = number_format($credito-$totalpagobd, 2, '.', '');
	    $stmt->execute();

		$sql = "UPDATE creditosxclientes set"
	    ." montocredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $montocredito);
		$stmt->bindParam(2, $clientebd);

		$montocredito = number_format($monto-$totalpagobd, 2, '.', '');
		$stmt->execute(); 	
	}
    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################

		$sql = "DELETE FROM reservaciones WHERE codreservacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codreservacion);
		$codreservacion = decrypt($_GET["codreservacion"]);
		$stmt->execute();

		$sql = "DELETE FROM detallereservaciones WHERE codreservacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codreservacion);
		$codreservacion = decrypt($_GET["codreservacion"]);
		$stmt->execute();

		$sql = "DELETE FROM abonoscreditosreservaciones WHERE codreservacion = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1,$codreservacion);
		$codreservacion = decrypt($_GET["codreservacion"]);
		$stmt->execute();

	if ($tipopagobd=="CREDITO") {

		$recibo = decrypt($_GET["codreservacion"]);
		if (file_exists("fotos/comprobantes/".encrypt($recibo).".jpg")){
	    //funcion para eliminar una carpeta con contenido
		$archivos = "fotos/comprobantes/".encrypt($recibo).".jpg";		
		unlink($archivos);
		}
	}

		echo "1";
		exit;

	} else {

		echo "2";
		exit;
	}
}
############################ FUNCION ELIMINAR RESERVACIONES ########################


############################ FUNCION LISTAR RESERVACIONES DIARIAS ###########################
public function BuscarReservacionesDiarias()
{
	self::SetNames();
	if($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria") {

	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo WHERE DATE_FORMAT(reservaciones.fecharegistro,'%d-%m-%Y') = '".date("d-m-Y")."' GROUP BY detallereservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		    return $this->p;
			$this->dbh=null;

	} else {

	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo WHERE reservaciones.codigo = '".limpiar($_SESSION["codigo"])."' AND DATE_FORMAT(reservaciones.fecharegistro,'%d-%m-%Y') = '".date("d-m-Y")."' GROUP BY detallereservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		    return $this->p;
			$this->dbh=null;
	}
}
########################## FUNCION LISTAR RESERVACIONES DIARIAS ############################

#################### FUNCION BUSQUEDA RESERVACIONES POR CAJAS #####################
public function BuscarReservacionesxCajas() 
	{
	self::SetNames();
	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo 
	WHERE reservaciones.codcaja = ? 
	AND DATE_FORMAT(reservaciones.fecharegistro,'%Y-%m-%d') BETWEEN ? AND ? 
	GROUP BY detallereservaciones.codreservacion";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(decrypt($_GET['codcaja'])));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(3, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESERVACIONES PARA LA CAJA SELECCIONADA</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSQUEDA RESERVACIONES POR CAJAS ####################

###################### FUNCION BUSQUEDA RESERVACIONES POR FECHAS #####################
public function BuscarReservacionesxFechas() 
{
	self::SetNames();
	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
	LEFT JOIN cajas ON reservaciones.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN usuarios ON reservaciones.codigo = usuarios.codigo 
	WHERE DATE_FORMAT(detallereservaciones.desde,'%Y-%m-%d') BETWEEN ? AND ? 
	GROUP BY detallereservaciones.codreservacion";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON RESERVACIONES PARA EL RANGO DE FECHA INGRESADO</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSQUEDA RESERVACIONES POR FECHAS ######################

###################### FUNCION BUSQUEDA RESERVACIONES POR CLIENTES #####################
public function BuscarReservacionesxClientes() 
{
	self::SetNames();
	$sql = "SELECT 
	reservaciones.idreservacion, 
	reservaciones.tipodocumento, 
	reservaciones.codcaja, 
	reservaciones.codreservacion, 
	reservaciones.codcliente,
	reservaciones.iva, 
	reservaciones.totaliva,
	reservaciones.subtotal, 
	reservaciones.descuento, 
	reservaciones.totaldescuento,
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,  
	reservaciones.montopagado, 
	reservaciones.montodevuelto, 
	reservaciones.tipotarjeta, 
	reservaciones.nrotarjeta, 
	reservaciones.expira, 
	reservaciones.codverifica,  
	reservaciones.cheque, 
	reservaciones.fechavencecredito, 
	reservaciones.fechapagado, 
	reservaciones.statuspago,
	reservaciones.reservacion, 
	reservaciones.reservacion_desde,
	reservaciones.reservacion_hasta,
	reservaciones.observaciones, 
	reservaciones.fecharegistro,
	detallereservaciones.desde,
	detallereservaciones.hasta,
	clientes.codcliente,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.paiscliente, 
	clientes.ciudadcliente,
	clientes.direccliente,  
	clientes.telefcliente, 
	documentos.documento,
	GROUP_CONCAT('#', habitaciones.numhabitacion SEPARATOR ', ') AS habitaciones 
	FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion)
	INNER JOIN habitaciones ON detallereservaciones.codhabitacion = habitaciones.codhabitacion
    INNER JOIN clientes ON reservaciones.codcliente = clientes.codcliente
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE reservaciones.codcliente = ? 
	GROUP BY detallereservaciones.codreservacion";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim($_GET['codcliente']));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS PARA EL CLIENTE INGRESADO</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSQUEDA RESERVACIONES POR CLIENTES ####################

################################ FIN DE CLASE RESERVACIONES #############################















































###################################### CLASE VENTAS ###################################

########################### FUNCION REGISTRAR VENTAS ############################
public function RegistrarVentas()
	{
	self::SetNames();
	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja 
	INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	INNER JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_SESSION["codigo"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "1";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$codarqueo = $row['codarqueo'];
		$codcaja = $row['codcaja'];
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);
		$abono = ($row['abonos']== "" ? "0.00" : $row['abonos']);
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

    if(empty($_POST["tipodocumento"]) or empty($_POST["tipopago"]))
	{
		echo "2";
		exit;
	}
	elseif(empty($_SESSION["CarritoVenta"]) || $_POST["txtTotal"]=="0.00")
	{
		echo "3";
		exit;
	}

	############### VALIDO SI LA CANTIDAD ES MAYOR QUE LA EXISTENCIA ################
	$v = $_SESSION["CarritoVenta"];
	for($i=0;$i<count($v);$i++){

	    $sql = "SELECT existencia FROM productos WHERE codproducto = '".$v[$i]['txtCodigo']."'";
	    foreach ($this->dbh->query($sql) as $row)
	    {
		$this->p[] = $row;
	    }
	
	    $existenciadb = $row['existencia'];
	    $cantidad = $v[$i]['cantidad'];

        if ($cantidad > $existenciadb) 
        { 
	       echo "4";
	       exit;
        }
	}
	############ VALIDO SI LA CANTIDAD ES MAYOR QUE LA EXISTENCIA #############

	################### SELECCIONE LOS DATOS DEL CLIENTE ######################
    $sql = "SELECT
    clientes.codcliente,
    clientes.dnicliente,
    clientes.nomcliente, 
    clientes.correocliente, 
    clientes.limitecredito,
    ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
    ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible
    FROM clientes 
    LEFT JOIN
       (SELECT
       codcliente, montocredito       
       FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
       WHERE clientes.codcliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST['codcliente']));
	$num = $stmt->rowCount();
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$p[] = $row;
	}
	$codcliente = $row['codcliente'];
    $dnicliente = $row['dnicliente'];
    $nomcliente = $row['nomcliente'];
    $correocliente = $row['correocliente'];
    $limitecredito = $row['limitecredito'];
    $montoactual = (empty($row['montoactual']) ? "0.00" : $row['montoactual']);
    $creditodisponible = $row['creditodisponible'];
    $montoabono = (empty($_POST["montoabono"]) ? "0.00" : $_POST["montoabono"]);
    $total = number_format($_POST["txtTotal"]-$montoabono, 2, '.', '');
    ################### SELECCIONE LOS DATOS DEL CLIENTE ######################
		
	################### VALIDO TIPO DE PAGO ES A CREDITO ######################
    if (limpiar($_POST["tipopago"]) == "CREDITO") {

    	$fechaactual = date("Y-m-d");
		$fechavence = date("Y-m-d",strtotime($_POST['fechavencecredito']));

		if ($_POST["codcliente"] == '0') { 

        echo "5";
        exit;

        } else if (strtotime($fechavence) < strtotime($fechaactual)) {

			echo "6";
			exit;

		} else if ($limitecredito != "0.00" && $total > $creditodisponible) {

            echo "7";
            exit;

        } else if($_POST["montoabono"] >= $_POST["txtTotal"]) { 

	        echo "8";
	        exit;
        }
    }
    ################### VALIDO TIPO DE PAGO ES A CREDITO ######################
	
    ################### CREO LOS CODIGO VENTA-SERIE-AUTORIZACION ####################
	$sql = " SELECT nroactividad, iniciofactura FROM configuracion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$nroactividad = $row['nroactividad'];
	$iniciofactura = $row['iniciofactura'];
	
	$sql = "SELECT codventa FROM ventas ORDER BY idventa DESC LIMIT 1";
	foreach ($this->dbh->query($sql) as $row){

		$venta=$row["codventa"];

	}
	if(empty($venta))
	{
		$codventa = $nroactividad.'-'.$iniciofactura;
		$codserie = $nroactividad;
		$codautorizacion = limpiar(GenerateRandomStringg());

	} else {

		$var = strlen($nroactividad."-");
        $var1 = substr($venta , $var);
        $var2 = strlen($var1);
        $var3 = $var1 + 1;
        $var4 = str_pad($var3, $var2, "0", STR_PAD_LEFT);
        $codventa = $nroactividad.'-'.$var4;
		$codserie = $nroactividad;
		$codautorizacion = limpiar(GenerateRandomStringg());
	}
    ################### CREO LOS CODIGO VENTA-SERIE-AUTORIZACION ####################

    $fecha = date("Y-m-d H:i:s");

	################################ REGISTRO DE VENTAS ################################
	$query = "INSERT INTO ventas values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $tipodocumento);
	$stmt->bindParam(2, $codarqueo);
	$stmt->bindParam(3, $codcaja);
	$stmt->bindParam(4, $codventa);
	$stmt->bindParam(5, $codserie);
	$stmt->bindParam(6, $codautorizacion);
	$stmt->bindParam(7, $codcliente);
	$stmt->bindParam(8, $subtotalivasi);
	$stmt->bindParam(9, $subtotalivano);
	$stmt->bindParam(10, $iva);
	$stmt->bindParam(11, $totaliva);
	$stmt->bindParam(12, $descuento);
	$stmt->bindParam(13, $totaldescuento);
	$stmt->bindParam(14, $totalpago);
	$stmt->bindParam(15, $totalpago2);
	$stmt->bindParam(16, $creditopagado);
	$stmt->bindParam(17, $tipopago);
	$stmt->bindParam(18, $formapago);
	$stmt->bindParam(19, $montopagado);
	$stmt->bindParam(20, $montodevuelto);
	$stmt->bindParam(21, $fechavencecredito);
	$stmt->bindParam(22, $fechapagado);
	$stmt->bindParam(23, $statusventa);
	$stmt->bindParam(24, $fechaventa);
	$stmt->bindParam(25, $observaciones);
	$stmt->bindParam(26, $codigo);
   
	$tipodocumento = limpiar($_POST["tipodocumento"]);
	$codcaja = limpiar($_POST["codcaja"]);
	$codcliente = limpiar($_POST["codcliente"]);
	$subtotalivasi = limpiar($_POST["txtsubtotal"]);
	$subtotalivano = limpiar($_POST["txtsubtotal2"]);
	$iva = limpiar($_POST["iva"]);
	$totaliva = limpiar($_POST["txtIva"]);
	$descuento = limpiar($_POST["descuento"]);
	$totaldescuento = limpiar($_POST["txtDescuento"]);
	$totalpago = limpiar($_POST["txtTotal"]);
	$totalpago2 = limpiar($_POST["txtTotalCompra"]);
	$creditopagado = limpiar(isset($_POST['montoabono']) ? $_POST["montoabono"] : "0.00");
	$tipopago = limpiar($_POST["tipopago"]);
	$formapago = limpiar($_POST["tipopago"]=="CONTADO" ? decrypt($_POST["codmediopago"]) : "CREDITO");
	$montopagado = limpiar(isset($_POST['montopagado']) ? $_POST["montopagado"] : "0.00");
	$montodevuelto = limpiar(isset($_POST['montodevuelto']) ? $_POST["montodevuelto"] : "0.00");
	$fechavencecredito = limpiar($_POST["tipopago"]=="CREDITO" ? date("Y-m-d",strtotime($_POST['fechavencecredito'])) : "0000-00-00");
    $fechapagado = limpiar("0000-00-00");
    $statusventa = limpiar($_POST["tipopago"]=="CONTADO" ? "PAGADA" : "PENDIENTE");
    $fechaventa = limpiar($fecha);
	$observaciones = limpiar($_POST["observaciones"]);
	$codigo = limpiar($_SESSION["codigo"]);
	$stmt->execute();
	################################ REGISTRO DE VENTAS ################################

	$this->dbh->beginTransaction();
	$detalle = $_SESSION["CarritoVenta"];
	for ($i = 0, $iMax = count($detalle); $i < $iMax; $i++) {

		############################### REGISTRO DETALLES DE VENTAS ###############################
		$query = "INSERT INTO detalleventas values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codventa);
	    $stmt->bindParam(2, $codproducto);
		$stmt->bindParam(3, $cantidad);
		$stmt->bindParam(4, $preciocompra);
		$stmt->bindParam(5, $precioventa);
		$stmt->bindParam(6, $ivaproducto);
		$stmt->bindParam(7, $descproducto);
		$stmt->bindParam(8, $valortotal);
		$stmt->bindParam(9, $totaldescuentov);
		$stmt->bindParam(10, $valorneto);
		$stmt->bindParam(11, $valorneto2);
			
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$cantidad = limpiar($detalle[$i]['cantidad']);
		$preciocompra = limpiar($detalle[$i]['precio']);
		$precioventa = limpiar($detalle[$i]['precio2']);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
		$descuento = $detalle[$i]['descproducto']/100;
		$valortotal = number_format($detalle[$i]['precio2']*$detalle[$i]['cantidad'], 2, '.', '');
		$totaldescuentov = number_format($valortotal*$descuento, 2, '.', '');
	    $valorneto = number_format($valortotal-$totaldescuentov, 2, '.', '');
		$valorneto2 = number_format($detalle[$i]['precio']*$detalle[$i]['cantidad'], 2, '.', '');
		$stmt->execute();
		############################### REGISTRO DETALLES DE VENTAS ###############################

		################ VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################
		$sql = "SELECT * FROM productos 
		WHERE codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];
	    ################ VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################

	    ##################### ACTUALIZO LA EXISTENCIA DEL ALMACEN ####################
		$sql = " UPDATE productos set "
			  ." existencia = ? "
			  ." where "
			  ." codproducto = '".limpiar($detalle[$i]['txtCodigo'])."';
			   ";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $existencia);
		$cantventa = limpiar($detalle[$i]['cantidad']);
		$existencia = $existenciabd-$cantventa;
		$stmt->execute();

		############### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX ###################
	    $query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codventa);
		$stmt->bindParam(2, $codcliente);
		$stmt->bindParam(3, $codproducto);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivaproducto);
		$stmt->bindParam(10, $descproducto);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);		

		$codcliente = limpiar($_POST["codcliente"]);
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$movimiento = limpiar("SALIDAS");
		$entradas = limpiar("0");
		$salidas= limpiar($detalle[$i]['cantidad']);
		$devolucion = limpiar("0");
		$stockactual = limpiar($existenciabd-$detalle[$i]['cantidad']);
		$precio = limpiar($detalle[$i]["precio2"]);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
		$documento = limpiar("VENTA: ".$codventa);
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
		############### REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX ###################
    }
		
	####################### DESTRUYO LA VARIABLE DE SESSION #####################
	unset($_SESSION["CarritoVenta"]);
    $this->dbh->commit();

    ################ AGREGAMOS EL INGRESO A CONTADO ##############
	if (limpiar($_POST["tipopago"]=="CONTADO")){

		$sql = "UPDATE arqueocaja set "
		." ingresos = ? "
		." WHERE "
		." codarqueo = ? AND statusarqueo = 1;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $codarqueo);

		$txtTotal = number_format($_POST["txtTotal"]+$ingreso, 2, '.', '');
		$stmt->execute();
	}
    ################ AGREGAMOS EL INGRESO A CONTADO ################

    ################ AGREGAMOS EL INGRESO Y ABONOS A CREDITO ################
	if (limpiar($_POST["tipopago"]=="CREDITO")) {

		$sql = " UPDATE arqueocaja SET "
		." creditos = ?, "
		." abonos = ? "
		." where "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $txtTotal);
		$stmt->bindParam(2, $totalabono);
		$stmt->bindParam(3, $codarqueo);

		$TotalCredito = number_format($_POST["txtTotal"]-$_POST["montoabono"], 2, '.', '');
		$txtTotal = number_format($TotalCredito+$credito, 2, '.', '');
		$totalabono = number_format($_POST["montoabono"]+$abono, 2, '.', '');
		$stmt->execute();

		$sql = " SELECT codcliente FROM creditosxclientes WHERE codcliente = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array($_POST["codcliente"]));
		$num = $stmt->rowCount();
		if($num == 0)
		{
			$query = "INSERT INTO creditosxclientes values (null, ?, ?);";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcliente);
			$stmt->bindParam(2, $montocredito);

			$codcliente = limpiar($_POST["codcliente"]);
			$montocredito = number_format($_POST["txtTotal"]-$_POST["montoabono"], 2, '.', '');
			$stmt->execute();

		} else { 

			$sql = "UPDATE creditosxclientes set"
			." montocredito = ? "
			." where "
			." codcliente = ?;
			";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(1, $montocredito);
			$stmt->bindParam(2, $codcliente);

			$montocredito = number_format($montoactual+($_POST["txtTotal"]-$_POST["montoabono"]), 2, '.', '');
			$codcliente = limpiar($_POST["codcliente"]);
			$stmt->execute();
		}

		
		if (limpiar($_POST["montoabono"]!="0.00" && $_POST["montoabono"]!="0" && $_POST["montoabono"]!="")) {

			$query = "INSERT INTO abonoscreditosventas values (null, ?, ?, ?, ?, ?); ";
			$stmt = $this->dbh->prepare($query);
			$stmt->bindParam(1, $codcaja);
			$stmt->bindParam(2, $codventa);
			$stmt->bindParam(3, $codcliente);
			$stmt->bindParam(4, $montoabono);
			//$stmt->bindParam(5, $formaabono);
			$stmt->bindParam(5, $fechaabono);

			$codcliente = limpiar($_POST["codcliente"]);
			$montoabono = number_format($_POST["montoabono"], 2, '.', '');
			//$formaabono = decrypt($_POST["formaabono"]);
			$fechaabono = limpiar($fecha);
			$stmt->execute();
		}
	}
    ################ AGREGAMOS EL INGRESO Y ABONOS A CREDITO ################

    echo "<span class='fa fa-check-square-o'></span> LA VENTA DE PRODUCTOS HA SIDO REGISTRADA EXITOSAMENTE <a href='reportepdf?codventa=".encrypt($codventa)."&tipo=".encrypt($tipodocumento)."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

    echo "<script>window.open('reportepdf?codventa=".encrypt($codventa)."&tipo=".encrypt($tipodocumento)."', '_blank');</script>";
	exit;
}
############################ FUNCION REGISTRAR VENTAS ##############################

################################## FUNCION LISTAR VENTAS ################################
public function ListarVentas()
{
	self::SetNames();
	if ($_SESSION['acceso'] == "administrador") {

	$sql = "SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2, 
	ventas.creditopagado, 
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito, 
	ventas.fechapagado,
	ventas.statusventa, 
	ventas.fechaventa,
	ventas.observaciones,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	mediospagos.mediopago,
	SUM(detalleventas.cantventa) AS articulos 
	FROM (ventas LEFT JOIN detalleventas ON detalleventas.codventa = ventas.codventa)
	INNER JOIN cajas ON ventas.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
	LEFT JOIN documentos AS documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN usuarios ON ventas.codigo = usuarios.codigo GROUP BY detalleventas.codventa";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;

    } else if($_SESSION["acceso"] == "recepcionista") {

    $sql = "SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2,
	ventas.creditopagado, 
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito, 
	ventas.fechapagado,
	ventas.statusventa, 
	ventas.fechaventa,
	ventas.observaciones,  
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	mediospagos.mediopago,
	SUM(detalleventas.cantventa) AS articulos 
	FROM (ventas LEFT JOIN detalleventas ON detalleventas.codventa = ventas.codventa)
	INNER JOIN cajas ON ventas.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
	LEFT JOIN documentos AS documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN usuarios ON ventas.codigo = usuarios.codigo WHERE ventas.codigo = '".limpiar($_SESSION["codigo"])."' GROUP BY detalleventas.codventa";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
		   return $this->p;
		$this->dbh=null;
	}
}
################################## FUNCION LISTAR VENTAS ############################

############################ FUNCION ID VENTAS #################################
public function VentasPorId()
	{
	self::SetNames();
	$sql = "SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codarqueo,
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2,
	ventas.creditopagado, 
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito, 
    ventas.fechapagado,
	ventas.statusventa, 
	ventas.fechaventa,
    ventas.observaciones,  
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.paiscliente, 
	clientes.ciudadcliente, 
	clientes.direccliente, 
	clientes.telefcliente, 
	clientes.correocliente,
	clientes.limitecredito,
	documentos.documento,
    cajas.nrocaja,
    cajas.nomcaja,
    mediospagos.mediopago,
    usuarios.dni, 
    usuarios.nombres,
	ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
    ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible,
    pag2.abonototal
    FROM (ventas LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente)
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN cajas ON ventas.codcaja = cajas.codcaja
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN usuarios ON ventas.codigo = usuarios.codigo
    LEFT JOIN
        (SELECT codcliente, montocredito       
        FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
    LEFT JOIN
        (SELECT codventa, codcliente, SUM(if(montoabono!='0',montoabono,'0.00')) AS abonototal
        FROM abonoscreditosventas 
        WHERE codventa = '".limpiar(decrypt($_GET["codventa"]))."') pag2 ON pag2.codcliente = clientes.codcliente
        WHERE ventas.codventa = ?";
    $stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codventa"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID VENTAS #################################
	
########################## FUNCION VER DETALLES VENTAS ###########################
public function VerDetallesVentas()
	{
	self::SetNames();
	$sql = "SELECT
	detalleventas.coddetalleventa,
	detalleventas.codventa,
	detalleventas.codproducto,
	detalleventas.cantventa,
	detalleventas.preciocompra,
	detalleventas.precioventa,
	detalleventas.ivaproducto,
	detalleventas.descproducto,
	detalleventas.valortotal, 
	detalleventas.totaldescuentov,
	detalleventas.valorneto,
	detalleventas.valorneto2,
	productos.producto,
	categorias.nomcategoria
	FROM detalleventas INNER JOIN productos ON detalleventas.codproducto = productos.codproducto 
	INNER JOIN categorias ON productos.codcategoria = categorias.codcategoria
	WHERE detalleventas.codventa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codventa"])));
	$num = $stmt->rowCount();
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$this->p[]=$row;
	}
	return $this->p;
	$this->dbh=null;
}
############################ FUNCION VER DETALLES VENTAS ###########################

########################### FUNCION ACTUALIZAR VENTAS ############################
public function ActualizarVentas()
	{
	self::SetNames();
	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja 
	INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	INNER JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_SESSION["codigo"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "1";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$codarqueo = $row['codarqueo'];
		$codcaja = $row['codcaja'];
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);
		$abono = ($row['abonos']== "" ? "0.00" : $row['abonos']);
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

	if(decrypt($_POST["arqueoxventa"]) != $codarqueo)
	{
		echo "2";
		exit;
	}
	elseif(empty($_POST["codventa"]) or empty($_POST["tipopago"]))
	{
		echo "3";
		exit;
	}

	################## VERIFICO STOCK DISPONIBLE ##################
	for($i=0;$i<count($_POST['coddetalleventa']);$i++){  //recorro el array
        if (!empty($_POST['coddetalleventa'][$i])) {

	        if($_POST['cantventa'][$i]==0){

		        echo "4";
		        exit();
	        }
	        elseif($_POST['cantventa'][$i] != $_POST['cantidadventabd'][$i])
	        {
			    ############## VALIDO SI LA CANTIDAD ES MAYOR QUE LA EXISTENCIA #############
			    $sql = "SELECT existencia 
			    FROM productos 
			    WHERE codproducto = '".limpiar($_POST['codproducto'][$i])."'";
				    foreach ($this->dbh->query($sql) as $row)
				{
					$this->p[] = $row;
				}
				$existenciabd = $row['existencia'];
				$cantidad = $_POST["cantventa"][$i];
				$cantidadbd = $_POST["cantidadventabd"][$i];
				$totalventa = number_format($cantidad - $cantidadbd, 2, '.', '');
				############## VALIDO SI LA CANTIDAD ES MAYOR QUE LA EXISTENCIA #############

				if ($totalventa > $existenciabd) 
				{ 
					echo "5";
					exit;
				}
	        }
        }
    }
    ################## VERIFICO STOCK DISPONIBLE ##################

    ################### SELECCIONE LOS DATOS DEL CLIENTE ######################
    $sql = "SELECT
    clientes.codcliente,
    clientes.dnicliente,
    clientes.nomcliente, 
    clientes.correocliente, 
    clientes.limitecredito,
    ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
    ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible
    FROM clientes 
    LEFT JOIN
       (SELECT
       codcliente, montocredito       
       FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
       WHERE clientes.codcliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST['codcliente']));
	$num = $stmt->rowCount();
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$p[] = $row;
	}
    $codcliente = $row['codcliente'];
    $dnicliente = $row['dnicliente'];
    $nomcliente = $row['nomcliente'];
    $correocliente = $row['correocliente'];
    $limitecredito = $row['limitecredito'];
    $montoactual = $row['montoactual'];
    $creditodisponible = $row['creditodisponible'];
    $montoabono = (empty($_POST["abonototal"]) ? "0.00" : $_POST["abonototal"]);
    $total = number_format($_POST["txtTotal"], 2, '.', '');
    ################### SELECCIONE LOS DATOS DEL CLIENTE ######################

    ############ CONSULTO TOTAL ACTUAL ##############
	$sql = "SELECT totalpago FROM ventas 
	WHERE codventa = '".limpiar($_POST["codventa"])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$totalpagobd = $row['totalpago'];
	############ CONSULTO TOTAL ACTUAL ##############


	$this->dbh->beginTransaction();
	for($i=0;$i<count($_POST['coddetalleventa']);$i++){  //recorro el array
	if (!empty($_POST['coddetalleventa'][$i])) {

	$sql = "SELECT cantventa FROM detalleventas
	WHERE coddetalleventa = '".limpiar($_POST['coddetalleventa'][$i])."' 
	AND codventa = '".limpiar($_POST["codventa"])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$cantidadbd = $row['cantventa'];

    if($cantidadbd != $_POST['cantventa'][$i]){

    	############ CONSULTO LA EXISTENCIA DE PRODUCTO EN ALMACEN ############
	    $sql = "SELECT existencia 
	    FROM productos 
	    WHERE codproducto = '".limpiar($_POST['codproducto'][$i])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];
		$cantventa = $_POST["cantventa"][$i];
		$cantidadventabd = $_POST["cantidadventabd"][$i];
	    $totalventa = number_format($cantventa - $cantidadventabd, 2, '.', '');
		############ CONSULTO LA EXISTENCIA DE PRODUCTO EN ALMACEN ############

		############## ACTUALIZAMOS EXISTENCIA DEL PRODUCTO EN ALMACEN #1 ##############
		$sql2 = " UPDATE productos set "
		." existencia = ? "
		." WHERE "
		." codproducto = '".limpiar($_POST["codproducto"][$i])."';
		";
		$stmt = $this->dbh->prepare($sql2);
		$stmt->bindParam(1, $existencia);
		$existencia = number_format($existenciabd - $totalventa, 2, '.', '');
		$stmt->execute();
	    ############## ACTUALIZAMOS EXISTENCIA DEL PRODUCTO EN ALMACEN #1 ##############

	    ############### ACTUALIZAMOS LOS DATOS DEL PRODUCTO EN KARDEX ###############
		$sql3 = " UPDATE kardex_productos set "
		." salidas = ?, "
		." stockactual = ? "
		." WHERE "
		." codproceso = '".limpiar($_POST["codventa"])."' 
		AND codproducto = '".limpiar($_POST["codproducto"][$i])."';
		";
		$stmt = $this->dbh->prepare($sql3);
		$stmt->bindParam(1, $salidas);
		$stmt->bindParam(2, $existencia);
		
		$salidas = limpiar($_POST["cantventa"][$i]);
		$existencia = number_format($existenciabd - $totalventa, 2, '.', '');
		$stmt->execute();
		############### ACTUALIZAMOS LOS DATOS DEL PRODUCTO EN KARDEX ###############
	   
	    ####################### ACTUALIZO DETALLES DE VENTAS #######################
	    $query = "UPDATE detalleventas set"
		." cantventa = ?, "
		." valortotal = ?, "
		." totaldescuentov = ?, "
		." valorneto = ?, "
		." valorneto2 = ? "
		." WHERE "
		." coddetalleventa = ? AND codventa = ?;
		";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $cantventa);
		$stmt->bindParam(2, $valortotal);
		$stmt->bindParam(3, $totaldescuentov);
		$stmt->bindParam(4, $valorneto);
		$stmt->bindParam(5, $valorneto2);
		$stmt->bindParam(6, $coddetalleventa);
		$stmt->bindParam(7, $codventa);

		$cantventa = limpiar($_POST['cantventa'][$i]);
		$preciocompra = limpiar($_POST['preciocompra'][$i]);
		$precioventa = limpiar($_POST['precioventa'][$i]);
		$ivaproducto = limpiar($_POST['ivaproducto'][$i]);
		$descuento = $_POST['descproducto'][$i]/100;
		$valortotal = number_format($_POST['precioventa'][$i] * $_POST['cantventa'][$i], 2, '.', '');
		$totaldescuentov = number_format($valortotal * $descuento, 2, '.', '');
		$valorneto = number_format($valortotal - $totaldescuentov, 2, '.', '');
		$valorneto2 = number_format($_POST['preciocompra'][$i] * $_POST['cantventa'][$i], 2, '.', '');
		$coddetalleventa = limpiar($_POST['coddetalleventa'][$i]);
		$codventa = limpiar($_POST["codventa"]);
		$stmt->execute();
		####################### ACTUALIZO DETALLES DE VENTAS #######################
		
		    }
        } 
    }    
    $this->dbh->commit();

    ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
    $sql3 = "SELECT SUM(valorneto) AS valorneto, SUM(valorneto2) AS valorneto2 FROM detalleventas WHERE codventa = '".limpiar($_POST["codventa"])."' AND ivaproducto = 'SI'";
    foreach ($this->dbh->query($sql3) as $row3)
    {
    	$this->p[] = $row3;
    }
    $subtotalivasi = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);
    $subtotalivasi2 = ($row3['valorneto2']== "" ? "0.00" : $row3['valorneto2']);
    ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############

    ############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############
    $sql4 = "SELECT SUM(valorneto) AS valorneto, SUM(valorneto2) AS valorneto2 FROM detalleventas WHERE codventa = '".limpiar($_POST["codventa"])."' AND ivaproducto = 'NO'";
    foreach ($this->dbh->query($sql4) as $row4)
    {
    	$this->p[] = $row4;
    }
    $subtotalivano = ($row4['valorneto']== "" ? "0.00" : $row4['valorneto']);
    $subtotalivano2 = ($row4['valorneto2']== "" ? "0.00" : $row4['valorneto2']);
    ############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############

    ############ ACTUALIZO LOS TOTALES EN LA VENTA ##############
    $sql = " UPDATE ventas SET "
    ." codcliente = ?, "
    ." subtotalivasi = ?, "
    ." subtotalivano = ?, "
    ." totaliva = ?, "
    ." descuento = ?, "
    ." totaldescuento = ?, "
    ." totalpago = ?, "
	." totalpago2 = ?, "
	." montopagado = ?, "
	." montodevuelto = ? "
    ." WHERE "
    ." codventa = ?;
    ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(1, $codcliente);
    $stmt->bindParam(2, $subtotalivasi);
    $stmt->bindParam(3, $subtotalivano);
    $stmt->bindParam(4, $totaliva);
    $stmt->bindParam(5, $descuento);
    $stmt->bindParam(6, $totaldescuento);
    $stmt->bindParam(7, $totalpago);
    $stmt->bindParam(8, $totalpago2);
	$stmt->bindParam(9, $montopagado);
	$stmt->bindParam(10, $montodevuelto);
    $stmt->bindParam(11, $codventa);

    $codcliente = limpiar($_POST["codcliente"]);
    $iva = $_POST["iva"]/100;
    $totaliva = number_format($subtotalivasi*$iva, 2, '.', '');
    $descuento = limpiar($_POST["descuento"]);
    $txtDescuento = $_POST["descuento"]/100;
    $total = number_format($subtotalivasi+$subtotalivano+$totaliva, 2, '.', '');
    $totaldescuento = number_format($total*$txtDescuento, 2, '.', '');
    $totalpago = number_format($total-$totaldescuento, 2, '.', '');
    $totalpago2 = number_format($subtotalivasi2+$subtotalivano2, 2, '.', '');
	$montopagado = number_format($totalpago > $_POST["pagado"] ? $_POST["txtTotal"] : $_POST["pagado"], 2, '.', '');
	$montodevuelto = number_format($totalpago > $_POST["pagado"] ? "0.00" : $_POST["pagado"]-$totalpago, 2, '.', '');
    $codventa = limpiar($_POST["codventa"]);
    $tipodocumento = limpiar($_POST["tipodocumento"]);
    $tipopago = limpiar($_POST["tipopago"]);
    $observaciones = limpiar($_POST["observaciones"]);
    $fecha = date("Y-m-d H:i:s");
    $stmt->execute();
    ############ ACTUALIZO LOS TOTALES EN LA VENTA ##############

    #################### AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ####################
	if (limpiar($_POST["tipopago"]=="CONTADO") && $totalpagobd != $totalpago){

		##################### ACTUALIZO DATOS EN CAJA #####################
		$sql = "UPDATE arqueocaja set "
		." ingresos = ? "
		." WHERE "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtTotal);
		$stmt->bindParam(2, $codarqueo);

        if($totalpagobd > $totalpago){
        $TxtTotal = number_format($ingreso-($totalpagobd-$totalpago), 2, '.', '');
        } elseif($totalpagobd < $totalpago){
        $TxtTotal = number_format($ingreso+($totalpago-$totalpagobd), 2, '.', '');
        }
		$stmt->execute();
		##################### ACTUALIZO DATOS EN CAJA #####################
	}
    #################### AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ####################

    ############## AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ##################
	if (limpiar($_POST["tipopago"]=="CREDITO") && $totalpagobd != $totalpago) {

		##################### ACTUALIZO DATOS EN CAJA #####################
		$sql = " UPDATE arqueocaja SET "
		." creditos = ? "
		." where "
		." codarqueo = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtCredito);
		$stmt->bindParam(2, $codarqueo);

		if($totalpagobd > $totalpago){
        $TxtCredito = number_format($credito-($totalpagobd-$totalpago), 2, '.', '');
        } elseif($totalpagobd < $totalpago){
        $TxtCredito = number_format($credito+($totalpago-$totalpagobd), 2, '.', '');
        }
		$stmt->execute();
		##################### ACTUALIZO DATOS EN CAJA ##################### 	

		##################### ACTUALIZO CREDITO X CLIENTE #####################
		$sql = "UPDATE creditosxclientes set"
		." montocredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtMonto);
		$stmt->bindParam(2, $codcliente);

        if($totalpagobd > $totalpago){
        $TxtMonto = number_format($montoactual-($totalpagobd-$totalpago), 2, '.', '');
        } elseif($totalpagobd < $totalpago){
        $TxtMonto = number_format($montoactual+($totalpago-$totalpagobd), 2, '.', '');
        }
		$codcliente = limpiar($_POST["codcliente"]);
		$stmt->execute(); 
		##################### ACTUALIZO CREDITO X CLIENTE #####################
	}
    ############## AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ##################

    echo "<span class='fa fa-check-square-o'></span> LA VENTA DE PRODUCTOS HA SIDO ACTUALIZADA EXITOSAMENTE <a href='reportepdf?codventa=".encrypt($codventa)."&tipo=".encrypt($tipodocumento)."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

    echo "<script>window.open('reportepdf?codventa=".encrypt($codventa)."&tipo=".encrypt($tipodocumento)."', '_blank');</script>";
	exit;
}
############################# FUNCION ACTUALIZAR VENTAS #############################

########################## FUNCION AGREGAR DETALLES VENTAS #############################
public function AgregarDetallesVentas()
	{
	self::SetNames();
	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja 
	INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	INNER JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_SESSION["codigo"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "1";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$codarqueo = $row['codarqueo'];
		$codcaja = $row['codcaja'];
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);
		$abono = ($row['abonos']== "" ? "0.00" : $row['abonos']);
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

	if(decrypt($_POST["arqueoxventa"]) != $codarqueo)
	{
		echo "2";
		exit;
	}
	elseif(empty($_POST["codventa"]) or empty($_POST["tipopago"]))
	{
		echo "3";
		exit;
	}
	else if(empty($_SESSION["CarritoVenta"]) || $_POST["txtTotal"]=="0.00")
	{
		echo "4";
		exit;
	}

	################### SELECCIONE LOS DATOS DEL CLIENTE ######################
    $sql = "SELECT
    clientes.codcliente,
    clientes.dnicliente,
    clientes.nomcliente, 
    clientes.correocliente, 
    clientes.limitecredito,
    ROUND(SUM(if(pag.montocredito!='0',pag.montocredito,'0.00')), 2) montoactual,
    ROUND(SUM(if(pag.montocredito!='0',clientes.limitecredito-pag.montocredito,clientes.limitecredito)), 2) creditodisponible
    FROM clientes 
    LEFT JOIN
       (SELECT
       codcliente, montocredito       
       FROM creditosxclientes) pag ON pag.codcliente = clientes.codcliente
       WHERE clientes.codcliente = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_POST['codcliente']));
	$num = $stmt->rowCount();
	if($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$p[] = $row;
	}
    $codcliente = $row['codcliente'];
    $dnicliente = $row['dnicliente'];
    $nomcliente = $row['nomcliente'];
    $correocliente = $row['correocliente'];
    $limitecredito = $row['limitecredito'];
    $montoactual = (empty($row['montoactual']) ? "0.00" : $row['montoactual']);
    $creditodisponible = $row['creditodisponible'];
    $montoabono = (empty($_POST["abonototal"]) ? "0.00" : $_POST["abonototal"]);
    $total = number_format($_POST["txtTotal"], 2, '.', '');
    ################### SELECCIONE LOS DATOS DEL CLIENTE ######################

    /*if ($_POST["tipopago"] == "CREDITO") {
  
	    if ($limitecredito != "0.00" && $total > $creditodisponible) {	
  
           echo "5";
	       exit;

        } 
    }*/

    ############ CONSULTO TOTAL ACTUAL DE VENTAS ##############
	$sql = "SELECT
	descuento,
	totalpago 
	FROM ventas 
	WHERE codventa = '".limpiar($_POST["codventa"])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$descuentobd = $row['descuento'];
	$totalpagobd = $row['totalpago'];
	############ CONSULTO TOTAL ACTUAL DE VENTAS ##############

	################## VERIFICO STOCK DISPONIBLE ##################
	$this->dbh->beginTransaction();
    $detalle = $_SESSION["CarritoVenta"];
	for($i=0;$i<count($detalle);$i++){

	    ############### VERIFICO AL EXISTENCIA DEL PRODUCTO AGREGADO ################
		$sql = "SELECT * FROM productos 
		WHERE codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];
		############### VERIFICO AL EXISTENCIA DEL PRODUCTO AGREGADO ################

		############ REVISAMOS SI LA CANTIDAD ES MAYOR QUE LA EXISTENCIA #######
	    if ($detalle[$i]['cantidad'] > $existenciabd) 
	    { 
		    echo "6";
		    exit;
	    }
	    ############ REVISAMOS SI LA CANTIDAD ES MAYOR QUE LA EXISTENCIA #######
 
 
    ############# REVISAMOS QUE EL PRODUCTO NO ESTE EN LA BD ###################
    $sql = "SELECT 
    codventa, 
    codproducto 
    FROM detalleventas 
    WHERE codventa = '".limpiar($_POST['codventa'])."'  
    AND codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num == 0){

	    $query = "INSERT INTO detalleventas values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codventa);
	    $stmt->bindParam(2, $codproducto);
		$stmt->bindParam(3, $cantidad);
		$stmt->bindParam(4, $preciocompra);
		$stmt->bindParam(5, $precioventa);
		$stmt->bindParam(6, $ivaproducto);
		$stmt->bindParam(7, $descproducto);
		$stmt->bindParam(8, $valortotal);
		$stmt->bindParam(9, $totaldescuentov);
		$stmt->bindParam(10, $valorneto);
		$stmt->bindParam(11, $valorneto2);
			
		$codventa = limpiar($_POST["codventa"]);
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$cantidad = limpiar($detalle[$i]['cantidad']);
		$preciocompra = limpiar($detalle[$i]['precio']);
		$precioventa = limpiar($detalle[$i]['precio2']);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
		$descuento = $detalle[$i]['descproducto']/100;
		$valortotal = number_format($detalle[$i]['precio2']*$detalle[$i]['cantidad'], 2, '.', '');
		$totaldescuentov = number_format($valortotal*$descuento, 2, '.', '');
	    $valorneto = number_format($valortotal-$totaldescuentov, 2, '.', '');
		$valorneto2 = number_format($detalle[$i]['precio']*$detalle[$i]['cantidad'], 2, '.', '');
		$stmt->execute();

		################ VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################
		$sql = "SELECT * FROM productos 
		WHERE codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];
	    ################ VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################

		##################### ACTUALIZO LA EXISTENCIA DEL ALMACEN ####################
		$sql = " UPDATE productos set "
		." existencia = ? "
		." where "
		." codproducto = '".limpiar($detalle[$i]['txtCodigo'])."';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $existencia);
		$cantventa = number_format($detalle[$i]['cantidad'], 2, '.', '');
		$existencia = number_format($existenciabd - $cantventa, 2, '.', '');
		$stmt->execute();
	    ##################### ACTUALIZO LA EXISTENCIA DEL ALMACEN ####################

		################ REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX ###################
	    $query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codventa);
		$stmt->bindParam(2, $codcliente);
		$stmt->bindParam(3, $codproducto);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivaproducto);
		$stmt->bindParam(10, $descproducto);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);		

		$codventa = limpiar($_POST['codventa']);
		$codcliente = limpiar($_POST["codcliente"]);
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$movimiento = limpiar("SALIDAS");
		$entradas = limpiar("0");
		$salidas= limpiar($detalle[$i]['cantidad']);
		$devolucion = limpiar("0");
		$stockactual = limpiar($existenciabd-$detalle[$i]['cantidad']);
		$precio = limpiar($detalle[$i]["precio2"]);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
		$documento = limpiar("VENTA: ".$_POST['codventa']);
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
		################ REGISTRAMOS LOS DATOS DE PRODUCTOS EN KARDEX ###################

    } else {

	  	$sql = "SELECT cantventa 
	  	FROM detalleventas 
	  	WHERE codventa = '".limpiar($_POST['codventa'])."'  
	  	AND codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$cantidad = $row['cantventa'];

	  	$query = "UPDATE detalleventas set"
		." cantventa = ?, "
		." descproducto = ?, "
		." valortotal = ?, "
		." totaldescuentov = ?, "
		." valorneto = ?, "
		." valorneto2 = ? "
		." WHERE "
		." codventa = ? AND codproducto = ?;
		";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $cantventa);
		$stmt->bindParam(2, $descproducto);
		$stmt->bindParam(3, $valortotal);
		$stmt->bindParam(4, $totaldescuentov);
		$stmt->bindParam(5, $valorneto);
		$stmt->bindParam(6, $valorneto2);
		$stmt->bindParam(7, $codventa);
		$stmt->bindParam(8, $codproducto);

		$cantventa = limpiar($detalle[$i]['cantidad']+$cantidad);
		$preciocompra = limpiar($detalle[$i]['precio']);
		$precioventa = limpiar($detalle[$i]['precio2']);
		$ivaproducto = limpiar($detalle[$i]['ivaproducto']);
		$descproducto = limpiar($detalle[$i]['descproducto']);
		$descuento = $detalle[$i]['descproducto']/100;
		$valortotal = number_format($detalle[$i]['precio2'] * $cantventa, 2, '.', '');
		$totaldescuentov = number_format($valortotal * $descuento, 2, '.', '');
		$valorneto = number_format($valortotal - $totaldescuentov, 2, '.', '');
		$valorneto2 = number_format($detalle[$i]['precio'] * $cantventa, 2, '.', '');
		$codventa = limpiar($_POST["codventa"]);
		$codproducto = limpiar($detalle[$i]['txtCodigo']);
		$stmt->execute();

		################ VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################
		$sql = "SELECT * FROM productos 
		WHERE codproducto = '".limpiar($detalle[$i]['txtCodigo'])."'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$existenciabd = $row['existencia'];
	    ################ VERIFICO LA EXISTENCIA DEL PRODUCTO EN ALMACEN ################

		##################### ACTUALIZO LA EXISTENCIA DEL ALMACEN ####################
		$sql = " UPDATE productos set "
		." existencia = ? "
		." where "
		." codproducto = '".limpiar($detalle[$i]['txtCodigo'])."';
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $existencia);
		$cantventa = number_format($detalle[$i]['cantidad'], 2, '.', '');
		$existencia = number_format($existenciabd - $cantventa, 2, '.', '');
		$stmt->execute();
	    ##################### ACTUALIZO LA EXISTENCIA DEL ALMACEN ####################

		############# ACTUALIZAMOS LOS DATOS DEL PRODUCTO EN KARDEX ###########
		$sql3 = " UPDATE kardex_productos set "
		." salidas = ?, "
		." stockactual = ? "
	    ." WHERE "
	    ." codproceso = '".limpiar($_POST["codventa"])."' 
	    AND codproducto = '".limpiar($detalle[$i]['txtCodigo'])."';
		";
		$stmt = $this->dbh->prepare($sql3);
		$stmt->bindParam(1, $salidas);
		$stmt->bindParam(2, $existencia);
		
		$salidas = limpiar($detalle[$i]['cantidad']+$cantidad);
		$stmt->execute();
		############# ACTUALIZAMOS LOS DATOS DEL PRODUCTO EN KARDEX ###########

        }
    }
    ####################### DESTRUYO LA VARIABLE DE SESSION #####################
    unset($_SESSION["CarritoVenta"]);
    $this->dbh->commit();

    ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
	$sql3 = "SELECT SUM(valorneto) AS valorneto, SUM(valorneto2) AS valorneto2 
	FROM detalleventas WHERE codventa = '".limpiar($_POST["codventa"])."' AND ivaproducto = 'SI'";
	foreach ($this->dbh->query($sql3) as $row3)
	{
		$this->p[] = $row3;
	}
	$subtotalivasi = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);
	$subtotalivasi2 = ($row3['valorneto2']== "" ? "0.00" : $row3['valorneto2']);
	############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############

	############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############
	$sql4 = "SELECT SUM(valorneto) AS valorneto, SUM(valorneto2) AS valorneto2 
	FROM detalleventas WHERE codventa = '".limpiar($_POST["codventa"])."' AND ivaproducto = 'NO'";
	foreach ($this->dbh->query($sql4) as $row4)
	{
			$this->p[] = $row4;
	}
	$subtotalivano = ($row4['valorneto']== "" ? "0.00" : $row4['valorneto']);
	$subtotalivano2 = ($row4['valorneto2']== "" ? "0.00" : $row4['valorneto2']);
	############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############

    ############ ACTUALIZO LOS TOTALES EN LA VENTA ##############
	$sql = " UPDATE ventas SET "
	." codcliente = ?, "
	." subtotalivasi = ?, "
	." subtotalivano = ?, "
	." totaliva = ?, "
	." descuento = ?, "
	." totaldescuento = ?, "
	." totalpago = ?, "
	." totalpago2 = ?, "
	." montopagado = ?, "
	." montodevuelto = ? "
	." WHERE "
	." codventa = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $codcliente);
	$stmt->bindParam(2, $subtotalivasi);
	$stmt->bindParam(3, $subtotalivano);
	$stmt->bindParam(4, $totaliva);
	$stmt->bindParam(5, $descuento);
	$stmt->bindParam(6, $totaldescuento);
	$stmt->bindParam(7, $totalpago);
	$stmt->bindParam(8, $totalpago2);
	$stmt->bindParam(9, $montopagado);
	$stmt->bindParam(10, $montodevuelto);
	$stmt->bindParam(11, $codventa);

	$codcliente = limpiar($_POST["codcliente"]);
	$iva = $_POST["iva"]/100;
	$totaliva = number_format($subtotalivasi*$iva, 2, '.', '');
	$descuento = limpiar($_POST["descuento"]);
	$txtDescuento = $_POST["descuento"]/100;
	$total = number_format($subtotalivasi+$subtotalivano+$totaliva, 2, '.', '');
	$totaldescuento = number_format($total*$txtDescuento, 2, '.', '');
	$totalpago = number_format($total-$totaldescuento, 2, '.', '');
	$totalpago2 = number_format($subtotalivasi2+$subtotalivano2, 2, '.', '');
	$montopagado = number_format($totalpago, 2, '.', '');
	$montodevuelto = limpiar("0.00");
	$codventa = limpiar($_POST["codventa"]);
	$tipodocumento = limpiar($_POST["tipodocumento"]);
	$tipopago = limpiar($_POST["tipopago"]);
	$observaciones = limpiar($_POST["observaciones"]);
	$fecha = date("Y-m-d H:i:s");
	$stmt->execute();
	############ ACTUALIZO LOS TOTALES EN LA VENTA ##############

    #################### AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ####################
    if (limpiar($_POST["tipopago"]=="CONTADO") && $totalpagobd != $totalpago){

        ##################### ACTUALIZO DATOS EN CAJA #####################
        $sql = "UPDATE arqueocaja set "
        ." ingresos = ? "
        ." WHERE "
        ." codarqueo = ?;
        ";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $TxtTotal);
        $stmt->bindParam(2, $codarqueo);

        $TxtTotal = number_format($ingreso+($totalpago-$totalpagobd), 2, '.', '');
        $stmt->execute();
        ##################### ACTUALIZO DATOS EN CAJA #####################
    }
    #################### AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ####################

    ############## AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ##################
    if (limpiar($_POST["tipopago"]=="CREDITO") && $totalpagobd != $totalpago) {

        ##################### ACTUALIZO DATOS EN CAJA #####################
        $sql = " UPDATE arqueocaja SET "
        ." creditos = ? "
        ." where "
        ." codarqueo = ?;
        ";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(1, $TxtCredito);
        $stmt->bindParam(2, $codarqueo);
        
        $TxtCredito = number_format($credito+($totalpago-$totalpagobd), 2, '.', '');
        $stmt->execute(); 
        ##################### ACTUALIZO DATOS EN CAJA #####################

		##################### ACTUALIZO CREDITO X CLIENTE #####################
		$sql = "UPDATE creditosxclientes set"
		." montocredito = ? "
		." where "
		." codcliente = ? AND codsucursal = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtMonto);
		$stmt->bindParam(2, $codcliente);
		$stmt->bindParam(3, $codsucursal);
		
		$TxtMonto = number_format($montoactual+($totalpago-$totalpagobd), 2, '.', '');
        $codcliente = limpiar($_POST["codcliente"]);
		$codsucursal = limpiar($_POST["codsucursal"]);
		$stmt->execute(); 
		##################### ACTUALIZO CREDITO X CLIENTE #####################
    }
    ############## AGREGAMOS O QUITAMOS LA DIFERENCIA EN CAJA ##################

    echo "<span class='fa fa-check-square-o'></span> LOS DETALLES DE PRODUCTOS FUERON AGREGADOS A LA VENTA EXITOSAMENTE <a href='reportepdf?codventa=".encrypt($codventa)."&tipo=".encrypt($tipodocumento)."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR REPORTE</strong></font color></a></div>";

    echo "<script>window.open('reportepdf?codventa=".encrypt($codventa)."&tipo=".encrypt($tipodocumento)."', '_blank');</script>";
	exit;
}
########################### FUNCION AGREGAR DETALLES VENTAS ##########################

######################### FUNCION ELIMINAR DETALLES VENTAS #########################
public function EliminarDetallesVentas()
{
	self::SetNames();
	if ($_SESSION["acceso"]=="administrador") {

    ############ CONSULTO TOTAL ACTUAL DE VENTAS ##############
	$sql = "SELECT 
	codcaja, 
	codcliente,
	iva,
	descuento, 
	tipopago, 
	totalpago 
	FROM ventas WHERE codventa = '".limpiar(decrypt($_GET["codventa"]))."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$cajabd = $row['codcaja'];
	$clientebd = $row['codcliente'];
	$iva = $row["iva"]/100;
	$descuento = $row["descuento"]/100;
	$tipopagobd = $row['tipopago'];
	$totalpagobd = $row['totalpago'];
	############ CONSULTO TOTAL ACTUAL DE VENTAS ##############

	################### VERIFICO MONTO DE CREDITO DEL CLIENTE ######################
	$sql = "SELECT montocredito FROM creditosxclientes 
	WHERE codcliente = '".$clientebd."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$monto = (empty($row['montocredito']) ? "0.00" : $row['montocredito']);
	################### VERIFICO MONTO DE CREDITO DEL CLIENTE ######################

	$sql = "SELECT * FROM detalleventas WHERE codventa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codventa"])));
	$num = $stmt->rowCount();
	if($num > 1)
	{
		$sql = "SELECT 
		codproducto, 
		cantventa, 
		precioventa, 
		ivaproducto, 
		descproducto
		FROM detalleventas 
		WHERE coddetalleventa = ?";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["coddetalleventa"])));
		$num = $stmt->rowCount();

		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[] = $row;
		}
		$codproductobd = $row['codproducto'];
		$cantidadbd = $row['cantventa'];
		$precioventabd = $row['precioventa'];
		$ivaproductobd = $row['ivaproducto'];
		$descproductobd = $row['descproducto'];

		############ OBTENGO LA EXISTENCIA DE PRODUCTO EN ALMACEN #############
		$sql2 = "SELECT existencia FROM productos WHERE codproducto = ?";
		$stmt = $this->dbh->prepare($sql2);
		$stmt->execute(array($codproductobd));
		$num = $stmt->rowCount();

		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[] = $row;
		}
		$existenciabd = $row['existencia'];
		############ OBTENGO LA EXISTENCIA DE PRODUCTO EN ALMACEN #############

		############ ACTUALIZAMOS LA EXISTENCIA DE PRODUCTO EN ALMACEN #############
		$sql = "UPDATE productos SET "
		." existencia = ? "
		." WHERE "
		." codproducto = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $existencia);
		$stmt->bindParam(2, $codproducto);

		$existencia = number_format($existenciabd+$cantidadbd, 2, '.', '');
		$codproducto = limpiar($codproductobd);
		$stmt->execute();
		############ ACTUALIZAMOS LA EXISTENCIA DE PRODUCTO EN ALMACEN #############

	    ######## REGISTRAMOS LOS DATOS DEL PRODUCTO ELIMINADO EN KARDEX ##########
		$query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codventa);
		$stmt->bindParam(2, $codresponsable);
		$stmt->bindParam(3, $codproducto);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivaproducto);
		$stmt->bindParam(10, $descproducto);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);		

		$codventa = limpiar(decrypt($_GET["codventa"]));
		$codresponsable = limpiar($clientebd);
		$codproducto = limpiar($codproductobd);
		$movimiento = limpiar("DEVOLUCION");
		$entradas= limpiar("0");
		$salidas = limpiar("0");
		$devolucion = limpiar($cantidadbd);
		$stockactual = limpiar($existenciabd+$cantidadbd);
		$ivaproducto = limpiar($ivaproductobd);
		$descproducto = number_format($descproductobd, 2, '.', '');
		$precio = number_format($precioventabd, 2, '.', '');
		$documento = limpiar("DEVOLUCION VENTA: ".decrypt($_GET["codventa"]));
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
		########## REGISTRAMOS LOS DATOS DEL PRODUCTO ELIMINADO EN KARDEX ##########

	################## ELIMINO DETALLE DE VENTA ##################
	$sql = "DELETE FROM detalleventas WHERE coddetalleventa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1,$coddetalleventa);
	$coddetalleventa = decrypt($_GET["coddetalleventa"]);
	$stmt->execute();
	################## ELIMINO DETALLE DE VENTA ##################

    ############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############
	$sql3 = "SELECT SUM(valorneto) AS valorneto, SUM(valorneto2) AS valorneto2 FROM detalleventas WHERE codventa = '".limpiar(decrypt($_GET["codventa"]))."' AND ivaproducto = 'SI'";
	foreach ($this->dbh->query($sql3) as $row3)
	{
		$this->p[] = $row3;
	}
	$subtotalivasi = ($row3['valorneto']== "" ? "0.00" : $row3['valorneto']);
	$subtotalivasi2 = ($row3['valorneto2']== "" ? "0.00" : $row3['valorneto2']);
	############ SUMO LOS IMPORTE DE PRODUCTOS CON IVA ##############

    ############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############
	$sql4 = "SELECT SUM(valorneto) AS valorneto, SUM(valorneto2) AS valorneto2 FROM detalleventas WHERE codventa = '".limpiar(decrypt($_GET["codventa"]))."' AND ivaproducto = 'NO'";
	foreach ($this->dbh->query($sql4) as $row4)
	{
		$this->p[] = $row4;
	}
	$subtotalivano = ($row4['valorneto']== "" ? "0.00" : $row4['valorneto']);
	$subtotalivano2 = ($row4['valorneto2']== "" ? "0.00" : $row4['valorneto2']);
	############ SUMO LOS IMPORTE DE PRODUCTOS SIN IVA ##############

    ############ ACTUALIZO LOS TOTALES EN LA VENTA ##############
	$sql = " UPDATE ventas SET "
	." subtotalivasi = ?, "
	." subtotalivano = ?, "
	." totaliva = ?, "
	." totaldescuento = ?, "
	." totalpago = ?, "
	." totalpago2= ? "
	." WHERE "
	." codventa = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $subtotalivasi);
	$stmt->bindParam(2, $subtotalivano);
	$stmt->bindParam(3, $totaliva);
	$stmt->bindParam(4, $totaldescuento);
	$stmt->bindParam(5, $totalpago);
	$stmt->bindParam(6, $totalpago2);
	$stmt->bindParam(7, $codventa);

	$totaliva= number_format($subtotalivasi*$iva, 2, '.', '');
	$total= number_format($subtotalivasi+$subtotalivano+$totaliva, 2, '.', '');
	$totaldescuento= number_format($total*$descuento, 2, '.', '');
	$totalpago= number_format($total-$totaldescuento, 2, '.', '');
	$totalpago2 = number_format($subtotalivasi+$subtotalivano, 2, '.', '');
	$codventa = limpiar(decrypt($_GET["codventa"]));
	$stmt->execute();
	############ ACTUALIZO LOS TOTALES EN LA VENTA ##############

	#################### QUITAMOS LA DIFERENCIA EN CAJA ####################
	if ($tipopagobd=="CONTADO"){

		$sql = "SELECT ingresos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = 1";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);

		$sql = "UPDATE arqueocaja set "
		." ingresos = ? "
		." WHERE "
		." codcaja = ? AND statusarqueo = 1;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $TxtTotal);
		$stmt->bindParam(2, $cajabd);

		$MontoCalculo = number_format($totalpagobd-$totalpago, 2, '.', '');
		$TxtTotal = number_format($ingreso-$MontoCalculo, 2, '.', '');
		$stmt->execute();
	}
    #################### QUITAMOS LA DIFERENCIA EN CAJA ####################
    
    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################
	if ($tipopagobd=="CREDITO") {

		$sql = "SELECT creditos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);

		$sql = " UPDATE arqueocaja SET "
	    ." creditos = ? "
	    ." where "
	    ." codcaja = ? and statusarqueo = '1';
	    ";
	    $stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $TxtTotal);
	    $stmt->bindParam(2, $cajabd);

	    $Calculo = number_format($totalpagobd-$totalpago, 2, '.', '');
	    $TxtTotal = number_format($credito-$Calculo, 2, '.', '');
	    $stmt->execute();

		$sql = "UPDATE creditosxclientes set"
	    ." montocredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $montocredito);
		$stmt->bindParam(2, $clientebd);

		$montocredito = number_format($monto-$Calculo, 2, '.', '');
		$stmt->execute(); 	
	}
    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################

		echo "1";
		exit;

	} else {

		echo "2";
		exit;
	} 

	} else {
		
		echo "3";
		exit;
	}	
}
########################## FUNCION ELIMINAR DETALLES VENTAS ##########################

######################### FUNCION ELIMINAR VENTAS #################################
public function EliminarVentas()
{
	self::SetNames();
	if ($_SESSION["acceso"]=="administrador") {

    ############ CONSULTO TOTAL ACTUAL ##############
	$sql = "SELECT 
	codcaja, 
	codcliente, 
	tipopago, 
	totalpago 
	FROM ventas 
	WHERE codventa = '".limpiar(decrypt($_GET["codventa"]))."' ";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	$cajabd = $row['codcaja'];
	$clientebd = $row['codcliente'];
	$tipopagobd = $row['tipopago'];
	$totalpagobd = $row['totalpago'];
	############ CONSULTO TOTAL ACTUAL ##############

	################### VERIFICO MONTO DE CREDITO DEL CLIENTE ######################
	$sql = "SELECT montocredito FROM creditosxclientes 
	WHERE codcliente = '".$clientebd."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
    $monto = (empty($row['montocredito']) ? "0.00" : $row['montocredito']);
    ################### VERIFICO MONTO DE CREDITO DEL CLIENTE ######################

    $sql = "SELECT * FROM detalleventas 
    WHERE codventa = '".limpiar(decrypt($_GET["codventa"]))."'";

	$array=array();

	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;

		$codproductobd = $row['codproducto'];
		$cantidadbd = $row['cantventa'];
		$precioventabd = $row['precioventa'];
		$ivaproductobd = $row['ivaproducto'];
		$descproductobd = $row['descproducto'];

		############ OBTENGO LA EXISTENCIA DE PRODUCTO EN ALMACEN #############
		$sql2 = "SELECT existencia FROM productos WHERE codproducto = ?";
		$stmt = $this->dbh->prepare($sql2);
		$stmt->execute(array($codproductobd,));
		$num = $stmt->rowCount();

		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$p[] = $row;
		}
		$existenciabd = $row['existencia'];
		############ OBTENGO LA EXISTENCIA DE PRODUCTO EN ALMACEN #############

		############ ACTUALIZAMOS LA EXISTENCIA DE PRODUCTO EN ALMACEN #############
		$sql = "UPDATE productos SET "
		." existencia = ? "
		." WHERE "
		." codproducto = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $existencia);
		$stmt->bindParam(2, $codproducto);

		$existencia = number_format($existenciabd+$cantidadbd, 2, '.', '');
		$codproducto = limpiar($codproductobd);
		$stmt->execute();
		############ ACTUALIZAMOS LA EXISTENCIA DE PRODUCTO EN ALMACEN #############

	    ########## REGISTRAMOS LOS DATOS DEL PRODUCTO ELIMINADO EN KARDEX #########
		$query = "INSERT INTO kardex_productos values (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ";
		$stmt = $this->dbh->prepare($query);
		$stmt->bindParam(1, $codventa);
		$stmt->bindParam(2, $codresponsable);
		$stmt->bindParam(3, $codproducto);
		$stmt->bindParam(4, $movimiento);
		$stmt->bindParam(5, $entradas);
		$stmt->bindParam(6, $salidas);
		$stmt->bindParam(7, $devolucion);
		$stmt->bindParam(8, $stockactual);
		$stmt->bindParam(9, $ivaproducto);
		$stmt->bindParam(10, $descproducto);
		$stmt->bindParam(11, $precio);
		$stmt->bindParam(12, $documento);
		$stmt->bindParam(13, $fechakardex);		

		$codventa = limpiar(decrypt($_GET["codventa"]));
		$codresponsable = limpiar($clientebd);
		$codproducto = limpiar($codproductobd);
		$movimiento = limpiar("DEVOLUCION");
		$entradas= limpiar("0");
		$salidas = limpiar("0");
		$devolucion = limpiar($cantidadbd);
		$stockactual = limpiar($existenciabd+$cantidadbd);
		$ivaproducto = limpiar($ivaproductobd);
		$descproducto = number_format($descproductobd, 2, '.', '');
		$precio = number_format($precioventabd, 2, '.', '');
		$documento = limpiar("DEVOLUCION VENTA: ".decrypt($_GET["codventa"]));
		$fechakardex = limpiar(date("Y-m-d"));
		$stmt->execute();
		########## REGISTRAMOS LOS DATOS DEL PRODUCTO ELIMINADO EN KARDEX #########
	}

	#################### QUITAMOS LA DIFERENCIA EN CAJA ####################
	if ($tipopagobd=="CONTADO"){

		$sql = "SELECT ingresos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);

		$sql = "UPDATE arqueocaja set "
	    ." ingresos = ? "
	    ." WHERE "
	    ." codcaja = ? AND statusarqueo = '1';
	    ";
	    $stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $TxtTotal);
	    $stmt->bindParam(2, $cajabd);

        $TxtTotal = number_format($ingreso-$totalpagobd, 2, '.', '');
	    $stmt->execute();
	}
    #################### QUITAMOS LA DIFERENCIA EN CAJA ####################

    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################
	if ($tipopagobd=="CREDITO") {

		$sql = "SELECT creditos FROM arqueocaja WHERE codcaja = '".$cajabd."' AND statusarqueo = '1'";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		$credito = ($row['creditos']== "" ? "0.00" : $row['creditos']);

		$sql = " UPDATE arqueocaja SET "
	    ." creditos = ? "
	    ." where "
	    ." codcaja = ? and statusarqueo = '1';
	    ";
	    $stmt = $this->dbh->prepare($sql);
	    $stmt->bindParam(1, $TxtTotal);
	    $stmt->bindParam(2, $cajabd);

	    $TxtTotal = number_format($credito-$totalpagobd, 2, '.', '');
	    $stmt->execute();

		$sql = "UPDATE creditosxclientes set"
	    ." montocredito = ? "
		." where "
		." codcliente = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $montocredito);
		$stmt->bindParam(2, $clientebd);

		$montocredito = number_format($monto-$totalpagobd, 2, '.', '');
		$stmt->execute(); 	
	}
    ############## QUITAMOS LA DIFERENCIA EN CAJA ##################

    ################## ELIMINO VENTA ##################
	$sql = "DELETE FROM ventas WHERE codventa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1,$codventa);
	$codventa = decrypt($_GET["codventa"]);
	$stmt->execute();
	################## ELIMINO VENTA ##################

	################## ELIMINO DETALLE DE VENTA ##################
	$sql = "DELETE FROM detalleventas WHERE codventa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1,$codventa);
	$codventa = decrypt($_GET["codventa"]);
	$stmt->execute();
	################## ELIMINO DETALLE DE VENTA ##################

	################## ELIMINO DETALLE DE ABONOS ##################
	$sql = "DELETE FROM abonoscreditosventas WHERE codventa = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1,$codventa);
	$codventa = decrypt($_GET["codventa"]);
	$stmt->execute();
	################## ELIMINO DETALLE DE ABONOS ##################

		echo "1";
		exit;

	} else {

		echo "2";
		exit;
	}
}
########################### FUNCION ELIMINAR VENTAS ##########################

############################ FUNCION LISTAR VENTAS DIARIAS ###########################
public function BuscarVentasDiarias()
{
	self::SetNames();
	if($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria") {

	$sql = "SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2,
	ventas.creditopagado, 
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito, 
	ventas.fechapagado,
	ventas.statusventa, 
	ventas.fechaventa,
	ventas.observaciones,
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	mediospagos.mediopago,
	SUM(detalleventas.cantventa) AS articulos 
	FROM (ventas LEFT JOIN detalleventas ON detalleventas.codventa = ventas.codventa)
	INNER JOIN cajas ON ventas.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
	LEFT JOIN documentos AS documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN usuarios ON ventas.codigo = usuarios.codigo 
	WHERE DATE_FORMAT(ventas.fechaventa,'%d-%m-%Y') = '".date("d-m-Y")."' 
	GROUP BY detalleventas.codventa";
	foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		    return $this->p;
			$this->dbh=null;

	} else {

	$sql = "SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2, 
	ventas.creditopagado,
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito, 
	ventas.fechapagado,
	ventas.statusventa, 
	ventas.fechaventa,
	ventas.observaciones,  
	cajas.nrocaja,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	documentos.documento,
	mediospagos.mediopago,
	SUM(detalleventas.cantventa) AS articulos 
	FROM (ventas LEFT JOIN detalleventas ON detalleventas.codventa = ventas.codventa)
	INNER JOIN cajas ON ventas.codcaja = cajas.codcaja 
	LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
	LEFT JOIN documentos AS documentos ON clientes.documcliente = documentos.coddocumento
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN usuarios ON ventas.codigo = usuarios.codigo 
	WHERE ventas.codigo = '".limpiar($_SESSION["codigo"])."' 
	AND DATE_FORMAT(ventas.fechaventa,'%d-%m-%Y') = '".date("d-m-Y")."' 
	GROUP BY detalleventas.codventa";
	foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		    return $this->p;
			$this->dbh=null;
	}
}
########################## FUNCION LISTAR VENTAS DIARIAS ############################

###################### FUNCION BUSQUEDA VENTAS POR CAJAS ###########################
public function BuscarVentasxCajas() 
{
	self::SetNames();
	$sql ="SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2,
	ventas.creditopagado, 
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito,
    ventas.fechapagado, 
	ventas.statusventa, 
	ventas.fechaventa, 
    ventas.observaciones, 
	cajas.nrocaja,
	cajas.nomcaja,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.paiscliente, 
	clientes.ciudadcliente, 
	clientes.direccliente,
	clientes.telefcliente,  
	clientes.correocliente,
	documentos.documento,
	mediospagos.mediopago,
	SUM(detalleventas.cantventa) as articulos 
	FROM (ventas LEFT JOIN detalleventas ON detalleventas.codventa=ventas.codventa)
	LEFT JOIN cajas ON ventas.codcaja = cajas.codcaja 
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
	LEFT JOIN documentos AS documentos ON clientes.documcliente = documentos.coddocumento
	 WHERE ventas.codcaja = ? 
	 AND DATE_FORMAT(ventas.fechaventa,'%Y-%m-%d') BETWEEN ? AND ? 
	 GROUP BY detalleventas.codventa";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(decrypt($_GET['codcaja'])));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(3, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON VENTAS PARA LA CAJA SELECCIONADA</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSQUEDA VENTAS POR CAJAS ###########################

###################### FUNCION BUSQUEDA VENTAS POR FECHAS ###########################
public function BuscarVentasxFechas() 
{
	self::SetNames();
	$sql ="SELECT 
	ventas.idventa, 
	ventas.tipodocumento, 
	ventas.codventa, 
	ventas.codserie, 
	ventas.codautorizacion, 
	ventas.codcaja, 
	ventas.codcliente, 
	ventas.subtotalivasi, 
	ventas.subtotalivano, 
	ventas.iva, 
	ventas.totaliva, 
	ventas.descuento, 
	ventas.totaldescuento, 
	ventas.totalpago, 
	ventas.totalpago2, 
	ventas.creditopagado, 
	ventas.tipopago, 
	ventas.formapago, 
	ventas.montopagado, 
	ventas.montodevuelto, 
	ventas.fechavencecredito, 
    ventas.fechapagado,
	ventas.statusventa, 
	ventas.fechaventa, 
    ventas.observaciones,
	clientes.documcliente,
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.paiscliente, 
	clientes.ciudadcliente, 
	clientes.direccliente,
	clientes.telefcliente,  
	clientes.correocliente,
	documentos.documento,
	mediospagos.mediopago,
	SUM(detalleventas.cantventa) as articulos 
	FROM (ventas LEFT JOIN detalleventas ON detalleventas.codventa=ventas.codventa)
	LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
	LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
	LEFT JOIN documentos AS documentos ON clientes.documcliente = documentos.coddocumento
	WHERE DATE_FORMAT(ventas.fechaventa,'%Y-%m-%d') BETWEEN ? AND ? 
	GROUP BY detalleventas.codventa";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON VENTAS PARA EL RANGO DE FECHA INGRESADO</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
###################### FUNCION BUSQUEDA VENTAS POR FECHAS ###########################

###################### FUNCION BUSCAR DETALLES VENTAS POR FECHAS #########################
public function BuscarDetallesVentasxFechas() 
{
   self::SetNames();
   $sql ="SELECT 
   detalleventas.codproducto,
   detalleventas.descproducto,  
   detalleventas.ivaproducto,
   detalleventas.preciocompra, 
   detalleventas.precioventa,
   productos.producto,
   productos.codcategoria,
   productos.existencia,
   categorias.nomcategoria, 
   ventas.iva, 
   ventas.fechaventa,
   SUM(detalleventas.cantventa) as cantidad 
   FROM (ventas INNER JOIN detalleventas ON ventas.codventa = detalleventas.codventa) 
   LEFT JOIN productos ON detalleventas.codproducto = productos.codproducto
   LEFT JOIN categorias ON categorias.codcategoria=productos.codcategoria
   WHERE DATE_FORMAT(ventas.fechaventa,'%Y-%m-%d') BETWEEN ? AND ?
   GROUP BY detalleventas.codproducto, detalleventas.precioventa, detalleventas.descproducto
   ORDER BY detalleventas.codproducto ASC";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
	$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN PRODUCTOS FACTURADOS PARA EL RANGO DE FECHA INGRESADA</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
########################### FUNCION BUSCAR DETALLES VENTAS POR FECHAS ###############################

############################### FIN DE CLASE VENTAS ###################################






































###################################### CLASE CREDITOS ###################################

#################### FUNCION REGISTRAR PAGOS A CREDITOS EN RESERVACIONES ########################
public function RegistrarPagoReservaciones()
{
	self::SetNames();
	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja 
	INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	INNER JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_SESSION["codigo"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "1";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$codarqueo = $row['codarqueo'];
		$codcaja = $row['codcaja'];
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

	if(empty($_POST["codcliente"]) or empty($_POST["codreservacion"]) or empty($_POST["montoabono"]))
	{
		echo "2";
		exit;
	} 
	else if($_POST["montoabono"] > $_POST["totaldebe"])
	{
		echo "3";
		exit;
	}

	################### VERIFICO CREDITO DEL CLIENTE ######################
	$sql = "SELECT montocredito 
	FROM creditosxclientes 
	WHERE codcliente = '".limpiar($_POST['codcliente'])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
    $monto = (empty($row['montocredito']) ? "0.00" : $row['montocredito']);
    ################### VERIFICO CREDITO DEL CLIENTE ######################

	################### REGISTRO ABONOS ######################
	$query = "INSERT INTO abonoscreditosreservaciones values (null, ?, ?, ?, ?, ?); ";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $codcaja);
	$stmt->bindParam(2, $codreservacion);
	$stmt->bindParam(3, $codcliente);
	$stmt->bindParam(4, $montoabono);
	$stmt->bindParam(5, $fechaabono);

	$codreservacion = limpiar($_POST["codreservacion"]);
	$codcliente = limpiar($_POST["codcliente"]);
	$montoabono = limpiar($_POST["montoabono"]);
	$fechaabono = limpiar(date("Y-m-d h:i:s"));
	$stmt->execute();
	################### REGISTRO ABONOS ######################

	############### AGREGAMOS EL INGRESO A CAJA ##############
	$sql = "UPDATE arqueocaja set "
	." ingresos = ? "
	." WHERE "
	." codcaja = ? AND statusarqueo = '1';
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $txtTotal);
	$stmt->bindParam(2, $codcaja);

	$txtTotal = number_format($_POST["montoabono"]+$ingreso, 2, '.', '');
	$stmt->execute();
	############### AGREGAMOS EL INGRESO A CAJA ##############

	############### VERIFICAMOS CREDITO DE CLIENTE ##############
	$sql = "UPDATE creditosxclientes set"
	." montocredito = ? "
	." where "
	." codcliente = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $montocredito);
	$stmt->bindParam(2, $codcliente);

    $montocredito = number_format($monto-$_POST["montoabono"], 2, '.', '');
	$codcliente = limpiar($_POST["codcliente"]);
	$stmt->execute(); 
	############### VERIFICAMOS CREDITO DE CLIENTE ##############

    ############## ACTUALIZAMOS EL STATUS DE LA FACTURA ##################
	if($_POST["montoabono"] == $_POST["totaldebe"]) {

		$sql = "UPDATE reservaciones set "
		." statusventa = ?, "
		." fechapagado = ? "
		." WHERE "
		." codreservacion = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $statusventa);
		$stmt->bindParam(2, $fechapagado);
		$stmt->bindParam(3, $codreservacion);

		$statusventa = limpiar("PAGADA");
		$fechapagado = limpiar(date("Y-m-d"));
		$codreservacion = limpiar($_POST["codreservacion"]);
		$stmt->execute();
	
	} else {

		$sql = "UPDATE reservaciones set "
		." creditopagado = ? "
		." WHERE "
		." codreservacion = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $creditopagado);
		$stmt->bindParam(2, $codreservacion);

		$creditopagado = number_format($_POST["totalabono"] + $_POST["montoabono"], 2, '.', '');
		$codreservacion = limpiar($_POST["codreservacion"]);
		$stmt->execute();
	}
    ############## ACTUALIZAMOS EL STATUS DE LA FACTURA ##################

	echo "<span class='fa fa-check-square-o'></span> EL ABONO AL CR&Eacute;DITO DE RESERVACI&Oacute;N HA SIDO REGISTRADO EXITOSAMENTE <a href='reportepdf?codproceso=".encrypt($codreservacion)."&url=".encrypt("1")."&tipo=".encrypt("TICKETCREDITORESERVACIONES")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR TICKET</strong></font color></a></div>";

	echo "<script>window.open('reportepdf?codproceso=".encrypt($codreservacion)."&url=".encrypt("1")."&tipo=".encrypt("TICKETCREDITORESERVACIONES")."', '_blank');</script>";
	exit;
}
####################### FUNCION REGISTRAR PAGOS A CREDITOS EN RESERVACIONES #######################

###################### FUNCION LISTAR CREDITOS EN RESERVACIONES ####################### 
public function ListarCreditosReservaciones()
{
	self::SetNames();
	$sql = "SELECT 
	reservaciones.codreservacion, 
	reservaciones.totalpago, 
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,
	reservaciones.statuspago,
	reservaciones.fecharegistro, 
	reservaciones.fechavencecredito,
	reservaciones.fechapagado,
	clientes.codcliente,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.telefcliente, 
	abonoscreditosreservaciones.codreservacion as codigo, 
	abonoscreditosreservaciones.fechaabono, 
	documentos.documento,
	SUM(abonoscreditosreservaciones.montoabono) AS abonototal 
	FROM (reservaciones INNER JOIN clientes ON reservaciones.codcliente = clientes.codcliente)
	LEFT JOIN abonoscreditosreservaciones ON reservaciones.codreservacion = abonoscreditosreservaciones.codreservacion
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE reservaciones.tipopago ='CREDITO' GROUP BY reservaciones.codreservacion";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
###################### FUNCION LISTAR CREDITOS EN RESERVACIONES ####################### 

########################## FUNCION REGISTRAR PAGOS A CREDITOS EN VENTAS ########################
public function RegistrarPagoVentas()
{
	self::SetNames();
	####################### VERIFICO ARQUEO DE CAJA #######################
	$sql = "SELECT * FROM arqueocaja 
	INNER JOIN cajas ON arqueocaja.codcaja = cajas.codcaja 
	INNER JOIN usuarios ON cajas.codigo = usuarios.codigo 
	WHERE usuarios.codigo = ? AND arqueocaja.statusarqueo = 1";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array($_SESSION["codigo"]));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "1";
		exit;

	} else {
		
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		$codarqueo = $row['codarqueo'];
		$codcaja = $row['codcaja'];
		$ingreso = ($row['ingresos']== "" ? "0.00" : $row['ingresos']);
	}
    ####################### VERIFICO ARQUEO DE CAJA #######################

	if(empty($_POST["codcliente"]) or empty($_POST["codventa"]) or empty($_POST["montoabono"]))
	{
		echo "2";
		exit;
	} 
	else if($_POST["montoabono"] > $_POST["totaldebe"])
	{
		echo "3";
		exit;
	}

	################### VERIFICO CREDITO DEL CLIENTE ######################
	$sql = "SELECT montocredito 
	FROM creditosxclientes 
	WHERE codcliente = '".limpiar($_POST['codcliente'])."'";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
    $monto = (empty($row['montocredito']) ? "0.00" : $row['montocredito']);
    ################### VERIFICO CREDITO DEL CLIENTE ######################

	################### REGISTRO ABONOS ######################
	$query = "INSERT INTO abonoscreditosventas values (null, ?, ?, ?, ?, ?); ";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $codcaja);
	$stmt->bindParam(2, $codventa);
	$stmt->bindParam(3, $codcliente);
	$stmt->bindParam(4, $montoabono);
	$stmt->bindParam(5, $fechaabono);

	$codventa = limpiar($_POST["codventa"]);
	$codcliente = limpiar($_POST["codcliente"]);
	$montoabono = limpiar($_POST["montoabono"]);
	$fechaabono = limpiar(date("Y-m-d h:i:s"));
	$stmt->execute();
	################### REGISTRO ABONOS ######################

	############### AGREGAMOS EL INGRESO A CAJA ##############
	$sql = "UPDATE arqueocaja set "
	." ingresos = ? "
	." WHERE "
	." codcaja = ? AND statusarqueo = '1';
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $txtTotal);
	$stmt->bindParam(2, $codcaja);

	$txtTotal = number_format($_POST["montoabono"]+$ingreso, 2, '.', '');
	$stmt->execute();
	############### AGREGAMOS EL INGRESO A CAJA ##############

	############### VERIFICAMOS CREDITO DE CLIENTE ##############
	$sql = "UPDATE creditosxclientes set"
	." montocredito = ? "
	." where "
	." codcliente = ?;
	";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindParam(1, $montocredito);
	$stmt->bindParam(2, $codcliente);

    $montocredito = number_format($monto-$_POST["montoabono"], 2, '.', '');
	$codcliente = limpiar($_POST["codcliente"]);
	$stmt->execute(); 
	############### VERIFICAMOS CREDITO DE CLIENTE ##############

    ############## ACTUALIZAMOS EL STATUS DE LA FACTURA ##################
	if($_POST["montoabono"] == $_POST["totaldebe"]) {

		$sql = "UPDATE ventas set "
		." statusventa = ?, "
		." fechapagado = ? "
		." WHERE "
		." codventa = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $statusventa);
		$stmt->bindParam(2, $fechapagado);
		$stmt->bindParam(3, $codventa);

		$statusventa = limpiar("PAGADA");
		$fechapagado = limpiar(date("Y-m-d"));
		$codventa = limpiar($_POST["codventa"]);
		$stmt->execute();
	
	} else {

		$sql = "UPDATE ventas set "
		." creditopagado = ? "
		." WHERE "
		." codventa = ?;
		";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(1, $creditopagado);
		$stmt->bindParam(2, $codventa);

		$creditopagado = number_format($_POST["totalabono"] + $_POST["montoabono"], 2, '.', '');
		$codventa = limpiar($_POST["codventa"]);
		$stmt->execute();
	}
    ############## ACTUALIZAMOS EL STATUS DE LA FACTURA ##################

	echo "<span class='fa fa-check-square-o'></span> EL ABONO AL CR&Eacute;DITO DE VENTA HA SIDO REGISTRADO EXITOSAMENTE <a href='reportepdf?codproceso=".encrypt($codventa)."&url=".encrypt("2")."&tipo=".encrypt("TICKETCREDITOVENTA")."' class='on-default' data-placement='left' data-toggle='tooltip' data-original-title='Imprimir Documento' target='_black' rel='noopener noreferrer'><font color='black'><strong>IMPRIMIR TICKET</strong></font color></a></div>";

	echo "<script>window.open('reportepdf?codproceso=".encrypt($codventa)."&url=".encrypt("2")."&tipo=".encrypt("TICKETCREDITOVENTA")."', '_blank');</script>";
	exit;
}
######################### FUNCION REGISTRAR PAGOS A CREDITOS EN VENTAS ############################

###################### FUNCION LISTAR CREDITOS EN VENTAS ####################### 
public function ListarCreditosVentas()
{
	self::SetNames();
	$sql = "SELECT 
	ventas.codventa, 
	ventas.totalpago,
	ventas.creditopagado,  
	ventas.tipopago,
	ventas.statusventa,
	ventas.fechaventa, 
	ventas.fechavencecredito,
	ventas.fechapagado,
	clientes.codcliente,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.telefcliente, 
	abonoscreditosventas.codventa as codigo, 
	abonoscreditosventas.fechaabono, 
	documentos.documento,
	SUM(abonoscreditosventas.montoabono) AS abonototal 
	FROM (ventas INNER JOIN clientes ON ventas.codcliente = clientes.codcliente)
	LEFT JOIN abonoscreditosventas ON ventas.codventa = abonoscreditosventas.codventa
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE ventas.tipopago ='CREDITO' GROUP BY ventas.codventa";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
###################### FUNCION LISTAR CREDITOS EN VENTAS ####################### 

############################ FUNCION ID CREDITOS #################################
public function CreditosPorId()
{
	self::SetNames();

	if(decrypt($_GET["url"])==1){	

		$sql = " SELECT 
		reservaciones.idreservacion, 
		reservaciones.tipodocumento, 
		reservaciones.codreservacion, 
		reservaciones.codserie, 
		reservaciones.codautorizacion, 
		reservaciones.codcaja, 
		reservaciones.codcliente, 
		reservaciones.subtotal, 
		reservaciones.iva, 
		reservaciones.totaliva, 
		reservaciones.descuento, 
		reservaciones.totaldescuento, 
		reservaciones.totalpago,
	    reservaciones.creditopagado,  
		reservaciones.tipopago, 
	    reservaciones.formapago, 
		reservaciones.montopagado, 
		reservaciones.montodevuelto, 
		reservaciones.fechavencecredito, 
	    reservaciones.fechapagado,
		reservaciones.statuspago, 
		reservaciones.fecharegistro,
	    reservaciones.observaciones,
		cajas.nrocaja,
		cajas.nomcaja,
		clientes.documcliente,
		clientes.dnicliente, 
		clientes.nomcliente, 
		clientes.telefcliente, 
		clientes.paiscliente, 
		clientes.ciudadcliente, 
		clientes.direccliente, 
		clientes.correocliente,
		documentos.documento,
		usuarios.dni, 
		usuarios.nombres,
		SUM(montoabono) AS abonototal
		FROM (reservaciones LEFT JOIN abonoscreditosreservaciones ON reservaciones.codreservacion = abonoscreditosreservaciones.codreservacion)
		LEFT JOIN clientes ON reservaciones.codcliente = clientes.codcliente
		LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
		LEFT JOIN cajas ON abonoscreditosreservaciones.codcaja = cajas.codcaja
		LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo
		WHERE reservaciones.codreservacion = ? GROUP BY abonoscreditosreservaciones.codreservacion";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproceso"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	
	} else {

		$sql = " SELECT 
		ventas.idventa, 
		ventas.tipodocumento, 
		ventas.codventa, 
		ventas.codserie, 
		ventas.codautorizacion, 
		ventas.codcaja, 
		ventas.codcliente, 
		ventas.subtotalivasi, 
		ventas.subtotalivano, 
		ventas.iva, 
		ventas.totaliva, 
		ventas.descuento, 
		ventas.totaldescuento, 
		ventas.totalpago, 
		ventas.totalpago2,
	    ventas.creditopagado,  
		ventas.tipopago, 
		ventas.formapago, 
		ventas.montopagado, 
		ventas.montodevuelto, 
		ventas.fechavencecredito, 
	    ventas.fechapagado,
		ventas.statusventa, 
		ventas.fechaventa,
	    ventas.observaciones,
		cajas.nrocaja,
		cajas.nomcaja,
		clientes.documcliente,
		clientes.dnicliente, 
		clientes.nomcliente, 
		clientes.telefcliente, 
		clientes.paiscliente, 
		clientes.ciudadcliente, 
		clientes.direccliente, 
		clientes.correocliente,
		documentos.documento,
		mediospagos.mediopago,
		usuarios.dni, 
		usuarios.nombres,
		SUM(montoabono) AS abonototal
		FROM (ventas LEFT JOIN abonoscreditosventas ON ventas.codventa = abonoscreditosventas.codventa)
		LEFT JOIN clientes ON ventas.codcliente = clientes.codcliente
		LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
		LEFT JOIN cajas ON abonoscreditosventas.codcaja = cajas.codcaja
		LEFT JOIN mediospagos ON ventas.formapago = mediospagos.codmediopago 
		LEFT JOIN usuarios ON cajas.codigo = usuarios.codigo
		WHERE ventas.codventa = ? GROUP BY abonoscreditosventas.codventa";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(decrypt($_GET["codproceso"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
			echo "";
		}
		else
		{
			if($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[] = $row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
############################ FUNCION ID CREDITOS #################################
	
############################ FUNCION VER DETALLES VENTAS ############################
public function VerDetallesAbonos()
{
	self::SetNames();

	if(decrypt($_GET["url"])==1){

	$sql = "SELECT * FROM abonoscreditosreservaciones 
	INNER JOIN reservaciones ON abonoscreditosreservaciones.codreservacion = reservaciones.codreservacion 
	LEFT JOIN cajas ON abonoscreditosreservaciones.codcaja = cajas.codcaja 
	WHERE abonoscreditosreservaciones.codreservacion = ?";	
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(decrypt($_GET["codproceso"])));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	
	} else {

	$sql = "SELECT * FROM abonoscreditosventas 
	INNER JOIN ventas ON abonoscreditosventas.codventa = ventas.codventa 
	LEFT JOIN cajas ON abonoscreditosventas.codcaja = cajas.codcaja 
	WHERE abonoscreditosventas.codventa = ?";	
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim(decrypt($_GET["codproceso"])));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
########################## FUNCION VER DETALLES VENTAS ##############################

###################### FUNCION BUSQUEDA CREDITOS POR CLIENTES ###########################
public function BuscarCreditosxClientes() 
	{
	self::SetNames();

	if(decrypt($_GET["url"])==1){

	$sql = "SELECT 
	reservaciones.codreservacion, 
	reservaciones.totalpago,
	reservaciones.creditopagado,  
	reservaciones.tipopago, 
	reservaciones.formapago,
	reservaciones.statuspago,
	reservaciones.fecharegistro, 
	reservaciones.fechavencecredito,
	reservaciones.fechapagado,
	clientes.codcliente,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.telefcliente, 
	abonoscreditosreservaciones.codreservacion as codigo, 
	abonoscreditosreservaciones.fechaabono, 
	documentos.documento,
	SUM(abonoscreditosreservaciones.montoabono) AS abonototal  
	FROM (reservaciones INNER JOIN clientes ON reservaciones.codcliente = clientes.codcliente)
	LEFT JOIN abonoscreditosreservaciones ON reservaciones.codreservacion = abonoscreditosreservaciones.codreservacion
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE reservaciones.codcliente = ? 
	AND reservaciones.tipopago ='CREDITO' 
	GROUP BY reservaciones.codreservacion";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim($_GET['codcliente']));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS DE RESERVACIONES PARA EL CLIENTE INGRESADO</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[]=$row;
		}
		return $this->p;
		$this->dbh=null;
	}
	} else {

	$sql = "SELECT 
	ventas.codventa, 
	ventas.totalpago,
	ventas.creditopagado,  
	ventas.tipopago,
	ventas.statusventa,
	ventas.fechaventa, 
	ventas.fechavencecredito,
	ventas.fechapagado,
	clientes.codcliente,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.telefcliente, 
	abonoscreditosventas.codventa as codigo, 
	abonoscreditosventas.fechaabono, 
	documentos.documento,
	SUM(abonoscreditosventas.montoabono) AS abonototal  
	FROM (ventas INNER JOIN clientes ON ventas.codcliente = clientes.codcliente)
	LEFT JOIN abonoscreditosventas ON ventas.codventa = abonoscreditosventas.codventa
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE ventas.codcliente = ? 
	AND ventas.tipopago ='CREDITO' 
	GROUP BY ventas.codventa";
	$stmt = $this->dbh->prepare($sql);
	$stmt->bindValue(1, trim($_GET['codcliente']));
	$stmt->execute();
	$num = $stmt->rowCount();
	if($num==0)
	{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS DE VENTAS PARA EL CLIENTE INGRESADO</center>";
	echo "</div>";		
	exit;
	}
	else
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
###################### FUNCION BUSQUEDA CREDITOS POR CLIENTES ###########################

###################### FUNCION BUSQUEDA CREDITOS POR FECHAS ###########################
public function BuscarCreditosxFechas() 
	{
	self::SetNames();

	if(decrypt($_GET["url"])==1){

	$sql = "SELECT 
	reservaciones.codreservacion, 
	reservaciones.totalpago,
	reservaciones.creditopagado, 
	reservaciones.tipopago, 
	reservaciones.formapago,
	reservaciones.statuspago,
	reservaciones.fecharegistro, 
	reservaciones.fechavencecredito,
	reservaciones.fechapagado,
	clientes.codcliente,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.telefcliente, 
	abonoscreditosreservaciones.codreservacion as codigo, 
	abonoscreditosreservaciones.fechaabono, 
	documentos.documento,
	SUM(abonoscreditosreservaciones.montoabono) AS abonototal  
	FROM (reservaciones INNER JOIN clientes ON reservaciones.codcliente = clientes.codcliente)
	LEFT JOIN abonoscreditosreservaciones ON reservaciones.codreservacion = abonoscreditosreservaciones.codreservacion
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE DATE_FORMAT(reservaciones.fecharegistro,'%Y-%m-%d') BETWEEN ? AND ?
	AND reservaciones.tipopago ='CREDITO' 
	GROUP BY reservaciones.codreservacion";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS EN RESERVACIONES PARA EL RANGO DE FECHA INGRESADO</center>";
	echo "</div>";		
	exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	} else {

		$sql = "SELECT 
	ventas.codventa, 
	ventas.totalpago, 
	ventas.creditopagado, 
	ventas.tipopago,
	ventas.statusventa,
	ventas.fechaventa, 
	ventas.fechavencecredito,
	ventas.fechapagado,
	clientes.codcliente,
	clientes.documcliente, 
	clientes.dnicliente, 
	clientes.nomcliente, 
	clientes.telefcliente, 
	abonoscreditosventas.codventa as codigo, 
	abonoscreditosventas.fechaabono, 
	documentos.documento,
	SUM(abonoscreditosventas.montoabono) AS abonototal  
	FROM (ventas INNER JOIN clientes ON ventas.codcliente = clientes.codcliente)
	LEFT JOIN abonoscreditosventas ON ventas.codventa = abonoscreditosventas.codventa
	LEFT JOIN documentos ON clientes.documcliente = documentos.coddocumento
	WHERE DATE_FORMAT(ventas.fechaventa,'%Y-%m-%d') BETWEEN ? AND ?
	 AND ventas.tipopago ='CREDITO' GROUP BY ventas.codventa";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(1, trim(date("Y-m-d",strtotime($_GET['desde']))));
		$stmt->bindValue(2, trim(date("Y-m-d",strtotime($_GET['hasta']))));
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num==0)
		{
	echo "<div class='alert alert-danger'>";
	echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	echo "<center><span class='fa fa-info-circle'></span> NO SE ENCONTRARON CREDITOS EN VENTAS PARA EL RANGO DE FECHA INGRESADO</center>";
	echo "</div>";		
	exit;
		}
		else
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$this->p[]=$row;
			}
			return $this->p;
			$this->dbh=null;
		}
	}
}
###################### FUNCION BUSQUEDA CREDITOS POR FECHAS ###########################

###################################### CLASE CREDITOS ###################################





























################################# CLASE CHAT #####################################

############################# FUNCION REGISTRAR MENSAJE ###############################
public function RegistrarMensaje()
{
	self::SetNames();
	if(empty($_POST["respuesta"]) or empty($_POST["mensaje"]))
	{
		echo "1";
		exit;
	}

	if($_SESSION["acceso"]=="cliente"){

		$sql = "SELECT * FROM reservaciones 
		WHERE codcliente = ? 
		AND reservacion = 'ACTIVA'";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(limpiar($_SESSION["codcliente"])));
		$num = $stmt->rowCount();
		if($num==0)
		{
		    echo "2";
		    exit;
	    }
	}
	

	$query = " INSERT INTO mensajes values (null, ?, ?, ?, ?, ?); ";
	$stmt = $this->dbh->prepare($query);
	$stmt->bindParam(1, $codigo);
	$stmt->bindParam(2, $mensaje);
	$stmt->bindParam(3, $tiempo);
	$stmt->bindParam(4, $respuesta);
	$stmt->bindParam(5, $tipo);

	$codigo = limpiar($_SESSION['acceso'] == "cliente" ? $_SESSION["codcliente"] : $_SESSION["codigo"]);
	$mensaje = limpiar($_POST["mensaje"]);
	$tiempo = limpiar(date("Y-m-d H:i:s"));
	//$respuesta = limpiar("1");
	$respuesta = limpiar($_POST["respuesta"]);
	$tipo = limpiar($_SESSION['acceso'] == "cliente" ? "C" : "U");
	$stmt->execute();

	//echo "<span class='fa fa-check-square-o'></span> EL MENSAJE HA SIDO REGISTRADO EXITOSAMENTE";
	echo "";
	exit;

}
############################## FUNCION REGISTRAR MENSAJE ############################

############################## FUNCION LISTAR MENSAJE ###########################
public function ListarMensajes()
{
	self::SetNames();

	if($_SESSION['acceso'] == "cliente") {

		$sql = "SELECT * FROM mensajes
		LEFT JOIN clientes ON mensajes.codigo = clientes.codcliente 
		LEFT JOIN usuarios ON mensajes.codigo = usuarios.codigo 
		WHERE mensajes.respuesta = '".limpiar($_SESSION["codcliente"])."'
		 ORDER BY mensajes.codmensaje ASC";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;

	}  else {
	
	$sql = "SELECT * FROM mensajes 
	LEFT JOIN clientes ON mensajes.codigo = clientes.codcliente 
	LEFT JOIN usuarios ON mensajes.codigo = usuarios.codigo 
	ORDER BY mensajes.codmensaje ASC";
		foreach ($this->dbh->query($sql) as $row)
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
 }
############################# FUNCION LISTAR MENSAJE #############################

############################ FUNCION ID MENSAJE #################################
public function MensajePorId()
{
	self::SetNames();
	$sql = "SELECT * FROM mensajes WHERE codmensaje = ?";
	$stmt = $this->dbh->prepare($sql);
	$stmt->execute(array(decrypt($_GET["codmensaje"])));
	$num = $stmt->rowCount();
	if($num==0)
	{
		echo "";
	}
	else
	{
		if($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$this->p[] = $row;
		}
		return $this->p;
		$this->dbh=null;
	}
}
############################ FUNCION ID MENSAJE #################################

########################### FUNCION LISTAR CLIENTES ACTIVOS #########################
public function ListarClientesActivos()
	{
	self::SetNames();
	$sql = "SELECT * FROM clientes 
	LEFT JOIN reservaciones ON clientes.codcliente = reservaciones.codcliente 
	WHERE reservaciones.reservacion = 'ACTIVA' 
	GROUP BY clientes.codcliente";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
########################### FUNCION LISTAR CLIENTES ACTIVOS #########################

############################### FIN DE CLASE MENSAJES #################################


































############################# FUNCION PARA GRAFICOS #################################

########################### FUNCION SUMA DE VENTAS #################################
 public function SumaVentas()
{
	self::SetNames();
	$sql ="SELECT  
	MONTH(fechaventa) mes, 
	SUM(totalpago) totalmes
	FROM ventas 
	WHERE YEAR(fechaventa) = '".date('Y')."' 
	AND MONTH(fechaventa) GROUP BY MONTH(fechaventa) ORDER BY 1";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 
 }
########################### FUNCION SUMA DE VENTAS #################################

########################### FUNCION SUMA DE RESERVACIONES ##########################
 public function SumaReservaciones()
{
	self::SetNames();
	$sql ="SELECT  
	MONTH(fecharegistro) mes, 
	SUM(totalpago) totalmes
	FROM reservaciones 
	WHERE YEAR(fecharegistro) = '".date('Y')."' 
	AND MONTH(fecharegistro) GROUP BY MONTH(fecharegistro) ORDER BY 1";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 
 }
########################### FUNCION SUMA DE RESERVACIONES ##########################

########################### FUNCION PRODUCTOS 5 MAS VENDIDOS ##########################
public function HabitacionesMasReservadas()
	{
	self::SetNames();

    $sql = "SELECT 
    habitaciones.codhabitacion, 
    habitaciones.numhabitacion, 
    COUNT(detallereservaciones.codhabitacion) as cantidad 
    FROM (reservaciones LEFT JOIN detallereservaciones ON reservaciones.codreservacion=detallereservaciones.codreservacion) 
    LEFT JOIN habitaciones ON detallereservaciones.codhabitacion=habitaciones.codhabitacion 
    GROUP BY detallereservaciones.codhabitacion 
    ORDER BY habitaciones.codhabitacion ASC LIMIT 8";
	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
 }
############################ FUNCION 5 PRODUCTOS MAS VENDIDOS ###########################

########################### FUNCION PARA CONTAR REGISTROS #############################
public function ContarRegistros()
{
   self::SetNames();

$sql = "SELECT
(SELECT COUNT(codhabitacion) FROM habitaciones) AS habitaciones,
(SELECT COUNT(codigo) FROM usuarios) AS usuarios,
(SELECT COUNT(codproducto) FROM productos) AS productos,
(SELECT COUNT(codcliente) FROM clientes) AS clientes,
(SELECT COUNT(codproveedor) FROM proveedores) AS proveedores,
(SELECT COUNT(codreservacion) FROM reservaciones) AS reservaciones,
(SELECT COUNT(codventa) FROM ventas) AS ventas,
(SELECT COUNT(codproducto) FROM productos WHERE existencia <= stockminimo) AS minimo,
(SELECT COUNT(codproducto) FROM productos WHERE fechaexpiracion != '0000-00-00' AND fechaexpiracion <= '".date("Y-m-d")."') AS vencidos,
(SELECT COUNT(idcompra) FROM compras WHERE tipocompra = 'CREDITO' AND statuscompra = 'PENDIENTE' AND fechavencecredito <= '".date("Y-m-d")."') AS creditoscomprasvencidos,
(SELECT COUNT(idreservacion) FROM reservaciones WHERE reservacion = 'ACTIVA') AS activas,
(SELECT COUNT(idreservacion) FROM reservaciones WHERE reservacion = 'PENDIENTE') AS pendientes,
(SELECT COUNT(idreservacion) FROM reservaciones INNER JOIN detallereservaciones ON reservaciones.codreservacion = detallereservaciones.codreservacion WHERE reservaciones.reservacion = 'ACTIVA' OR reservaciones.reservacion = 'PENDIENTE' AND detallereservaciones.hasta <= '".date("Y-m-d")."') AS vencidas,
(SELECT COUNT(idreservacion) FROM reservaciones WHERE tipopago = 'CREDITO' AND statuspago = 'PENDIENTE' AND fechavencecredito <= '".date("Y-m-d")."') AS creditosreservacionesvencidos,
(SELECT COUNT(idventa) FROM ventas WHERE tipopago = 'CREDITO' AND statusventa = 'PENDIENTE' AND fechavencecredito <= '".date("Y-m-d")."') AS creditosventasvencidos";

	foreach ($this->dbh->query($sql) as $row)
	{
		$this->p[] = $row;
	}
	return $this->p;
	$this->dbh=null;
}
########################## FUNCION PARA CONTAR REGISTROS ############################

################################# FUNCION PARA GRAFICOS ################################




}
############################# TERMINA LA CLASE LOGIN #############################
?>