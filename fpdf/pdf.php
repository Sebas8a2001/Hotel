<?php
define('FPDF_FONTPATH','fpdf/font/');
define('EURO', chr(128));
require('fpdf.php');
 
class PDF extends FPDF
{
var $widths;
var $aligns;
var $flowingBlockAttr;

########################## FUNCION PARA MOSTRAR EL FOOTER ##########################
function Footer() 
{
  if($this->PageNo() != 1){
  //footer code
  $this->Ln();
  $this->SetY(-12);
  //Courier B 10
  $this->SetFont('courier','B',10);
  //Titulo de Footer
  $this->Cell(190,5,'GESTIÓN DE RESERVACIONES','T',0,'L');
  //$this->AliasNbPages();
  //Numero de Pagina
  $this->Cell(0,5,'Pagina '.$this->PageNo(),'T',1,'R'); 

  }
}
########################## FUNCION PARA MOSTRAR EL FOOTER #############################
	
	
############################## REPORTES DE ADMINISTRACION ###############################

########################## FUNCION LISTAR MENSAJES DE CONTACTO ##############################
function TablaListarMensajes()
   {
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(335,10,'LISTADO DE MENSAJES DE CONTACTO',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(60,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(35,8,'Nº DE TELEFONO',1,0,'C', True);
    $this->Cell(40,8,'EMAIL',1,0,'C', True);
    $this->Cell(40,8,'ASUNTO',1,0,'C', True);
    $this->Cell(90,8,'MENSAJE',1,0,'C', True);
    $this->Cell(50,8,'FECHA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarContact();

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,60,35,40,40,90,50));

    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,portales(utf8_decode($reg[$i]["name"])),utf8_decode($reg[$i]['phone'] == '' ? "******" : $reg[$i]['phone']),utf8_decode($reg[$i]['email']),portales(utf8_decode($reg[$i]['subject'])),portales(utf8_decode($reg[$i]['message'])),utf8_decode(date("d-m-Y H:i:s",strtotime($reg[$i]["fecha"])))));
       }
    }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y H:i:s'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR MENSAJES DE CONTACTO ##############################

########################## FUNCION LISTAR CATEGORIAS ##############################
function TablaListarCategorias()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
	$this->SetFont('Courier','B',12);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
	$this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
	$this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
	$this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
	$this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
	$this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
	$this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
	$this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
	$this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
	$this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
	$this->Cell(45,5,"",0,0,'C');
	$this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE CATEGORIAS',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(180,8,'NOMBRE DE CATEGORIA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarCategorias();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,180));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["nomcategoria"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CATEGORIAS ##############################

########################## FUNCION LISTAR TIPOS DE DOCUMENTOS #########################
function TablaListarDocumentos()
   {
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);


    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(190,10,'LISTADO GENERAL DE DOCUMENTOS TRIBUTARIOS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(50,8,'NOMBRE DE DOCUMENTO',1,0,'C', True);
    $this->Cell(125,8,'DESCRIPCIÓN DE DOCUMENTO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarDocumentos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,50,125));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["documento"]),utf8_decode($reg[$i]["descripcion"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR TIPOS DE DOCUMENTOS #########################

########################## FUNCION LISTAR TIPOS DE MONEDA ##############################
function TablaListarTiposMonedas()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE TIPOS DE MONEDA',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(85,8,'NOMBRE DE MONEDA',1,0,'C', True);
    $this->Cell(45,8,'SIGLAS',1,0,'C', True);
    $this->Cell(45,8,'SIMBOLO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarTipoMoneda();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(15,85,45,45));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["moneda"]),utf8_decode($reg[$i]["siglas"]),utf8_decode($reg[$i]["simbolo"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR TIPOS DE MONEDA ##############################

########################## FUNCION LISTAR TIPOS DE CAMBIO ##############################
function TablaListarTiposCambio()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE TIPOS DE CAMBIO',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(70,8,'DESCRIPCIÓN DE CAMBIO',1,0,'C', True);
    $this->Cell(35,8,'MONTO DE CAMBIO',1,0,'C', True);
    $this->Cell(35,8,'TIPO DE MONEDA',1,0,'C', True);
    $this->Cell(35,8,'FECHA DE INGRESO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarTipoCambio();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(15,70,35,35,35));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["descripcioncambio"]),utf8_decode($reg[$i]["montocambio"]),utf8_decode($reg[$i]['moneda']."/".$reg[$i]['siglas']),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechacambio'])))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR TIPOS DE CAMBIO ##############################

########################## FUNCION LISTAR MEDIOS DE PAGO ##############################
function TablaListarMediosPagos()
   {
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(190,10,'LISTADO GENERAL DE MEDIOS DE PAGO',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(175,8,'NOMBRE DE PAGO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarMediosPagos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,175));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["mediopago"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR MEDIOS DE PAGO ##############################

########################## FUNCION LISTAR IMPUESTOS ##############################
function TablaListarImpuestos()
   {
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(190,10,'LISTADO GENERAL DE IMPUESTOS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(70,8,'NOMBRE DE IMPUESTO',1,0,'C', True);
    $this->Cell(35,8,'VALOR(%)',1,0,'C', True);
    $this->Cell(35,8,'STATUS',1,0,'C', True);
    $this->Cell(35,8,'FECHA DE INGRESO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarImpuestos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,70,35,35,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["nomimpuesto"]),utf8_decode($reg[$i]["valorimpuesto"]),utf8_decode($reg[$i]['statusimpuesto']),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechaimpuesto'])))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR IMPUESTOS ##############################

########################## FUNCION LISTAR PERFIL DE HOTEL ##############################
function TablaListarPerfil()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE PERFIL DE HOTEL',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(60,8,'NOMBRE DE PERFIL',1,0,'C', True);
    $this->Cell(120,8,'DESCRIPCIÓN DE PERFIL',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarPerfil();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,60,120));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["nomperfil"]),utf8_decode($reg[$i]["descperfil"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR PERFIL DE HOTEL ##############################

########################## FUNCION LISTAR TEMPORADAS ##############################
function TablaListarTemporadas()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE TEMPORADAS',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(75,8,'NOMBRE DE TEMPORADA',1,0,'C', True);
    $this->Cell(50,8,'FECHA DESDE',1,0,'C', True);
    $this->Cell(50,8,'FECHA HASTA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarTemporadas();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(15,75,50,50));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["temporada"]),utf8_decode(date("d-m-Y",strtotime($reg[$i]['desde']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['hasta'])))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR TEMPORADAS ##############################

########################## FUNCION LISTAR NOTICIAS ##############################
function TablaListarNoticias()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(330,10,'LISTADO GENERAL DE NOTICIAS',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(85,8,'TITULO DE NOTICIA',1,0,'C', True);
    $this->Cell(150,8,'DESCRIPCIÓN DE NOTICIA',1,0,'C', True);
    $this->Cell(50,8,'FECHA PUBLICADO',1,0,'C', True);
    $this->Cell(35,8,'STATUS',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarNoticias();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,85,150,50,35));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["titulonoticia"]),utf8_decode($reg[$i]["descripcnoticia"]),utf8_decode($reg[$i]['statusnoticia'] == 'NO PUBLICADA' ? "**********" : date("d-m-Y h:i:s",strtotime($reg[$i]['publicado']))),utf8_decode($reg[$i]["statusnoticia"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR NOTICIAS ##############################

########################## FUNCION LISTAR TIPO DE HABITACIONES ########################
function TablaListarTipoHabitaciones()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE TIPO DE HABITACIONES',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(175,8,'NOMBRE DE TIPO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarTipos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(15,175));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,portales(utf8_decode($reg[$i]["nomtipo"]))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR TIPO DE HABITACIONES #########################

########################## FUNCION LISTAR TARIFAS ##############################
function TablaListarTarifas()
   {
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE TARIFAS',0,0,'C');

   	$this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(55,8,'NOMBRE DE TIPO',1,0,'C', True);
    $this->Cell(40,8,'TEMPORADA BAJA',1,0,'C', True);
    $this->Cell(40,8,'TEMPORADA MEDIA',1,0,'C', True);
    $this->Cell(40,8,'TEMPORADA ALTA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarTarifas();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(15,55,40,40,40));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,portales(utf8_decode($reg[$i]["nomtipo"])),utf8_decode($reg[$i]["baja"]),utf8_decode($reg[$i]["media"]),utf8_decode($reg[$i]["alta"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR TARIFAS ##############################

########################## FUNCION LISTAR USUARIOS ##############################
function TablaListarUsuarios()
   {
    
    $tra = new Login();
    $reg = $tra->ListarUsuarios();
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE USUARIOS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(30,8,'Nº DOCUMENTO',1,0,'C', True);
    $this->Cell(80,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(25,8,'SEXO',1,0,'C', True);
    $this->Cell(45,8,'Nº DE TELÉFONO',1,0,'C', True);
    $this->Cell(60,8,'EMAIL',1,0,'C', True);
    $this->Cell(40,8,'USUARIO',1,0,'C', True);
    $this->Cell(40,8,'NIVEL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,30,80,25,45,60,40,40));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["dni"]),utf8_decode($reg[$i]["nombres"]),utf8_decode($reg[$i]["sexo"]),utf8_decode($reg[$i]["telefono"]),utf8_decode($reg[$i]["email"]),utf8_decode($reg[$i]["usuario"]),utf8_decode($reg[$i]["nivel"])));
        }
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR USUARIOS ##############################

########################## FUNCION LISTAR LOGS DE USUARIOS ##############################
 function TablaListarLogs()
   {

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO DE LOGS DE ACCESO DE USUARIOS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(10,8,'N°',1,0,'C', True);
    $this->Cell(35,8,'IP EQUIPO',1,0,'C', True);
    $this->Cell(45,8,'TIEMPO ENTRADA',1,0,'C', True);
    $this->Cell(145,8,'NAVEGADOR DE ACCESO',1,0,'C', True);
    $this->Cell(60,8,'PÁGINAS DE ACCESO',1,0,'C', True);
    $this->Cell(35,8,'USUARIO',1,1,'C', True);
    

    $tra = new Login();
    $reg = $tra->ListarLogs();

    if($reg==""){
    echo "";      
    } else {
    
    /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,35,45,145,60,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["ip"]),utf8_decode($reg[$i]["tiempo"]),utf8_decode($reg[$i]["detalles"]),utf8_decode($reg[$i]["paginas"]),utf8_decode($reg[$i]["usuario"])));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
   }
########################## FUNCION LISTAR LOGS DE USUARIOS ##############################

############################## REPORTES DE ADMINISTRACION ############################







































############################### REPORTES DE MANTENIMIENTO #############################

########################## FUNCION LISTAR HABITACIONES ##############################
function TablaListarHabitaciones()
   {

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE HABITACIONES',0,0,'C');
    

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(25,8,'NÚMERO',1,0,'C', True);
    $this->Cell(40,8,'TIPO',1,0,'C', True);
    $this->Cell(50,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(30,8,'PISO',1,0,'C', True);
    $this->Cell(30,8,'VISTA',1,0,'C', True);
    $this->Cell(30,8,'MÁX. ADULTOS',1,0,'C', True);
    $this->Cell(30,8,'MÁX. NIÑOS',1,0,'C', True);
    $this->Cell(35,8,'COSTO',1,0,'C', True);
    $this->Cell(15,8,'DESC',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarHabitaciones();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,25,40,50,30,30,30,30,35,15,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["numhabitacion"]),portales(utf8_decode($reg[$i]["nomtipo"])),portales(utf8_decode($reg[$i]["descriphabitacion"])),utf8_decode($reg[$i]["piso"]),utf8_decode($reg[$i]['vista']),utf8_decode($reg[$i]["maxadultos"]),utf8_decode($reg[$i]["maxninos"]),utf8_decode("(BAJA ".$reg[$i]["baja"].")\n(MEDIA ".$reg[$i]["media"].")\n(ALTA ".$reg[$i]["alta"].")"),utf8_decode($reg[$i]["deschabitacion"]),utf8_decode($habitacion = ( $reg[$i]['statushab'] == 0 ? "DISPONIBLE" : "MANTENIMIENTO"))));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR HABITACIONES ##############################

########################## FUNCION LISTAR CLIENTES ##############################
function TablaListarClientes()
   {

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
	
	$con = new Login();
    $con = $con->ConfiguracionPorId(); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(330,10,'LISTADO GENERAL DE CLIENTES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE DOCUMENTO',1,0,'C', True);
    $this->Cell(70,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(35,8,'Nº DE TELEFONO',1,0,'C', True);
    $this->Cell(90,8,'DIRECCIÓN DOMICILIARIA',1,0,'C', True);
    $this->Cell(60,8,'EMAIL',1,0,'C', True);
    $this->Cell(25,8,'CRÉDITO',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarClientes();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(15,35,70,35,90,60,25));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["documento"]." ".$reg[$i]["dnicliente"]),portales(utf8_decode($reg[$i]["nomcliente"])),utf8_decode($reg[$i]["telefcliente"]),utf8_decode($reg[$i]["paiscliente"]." - ".$reg[$i]["ciudadcliente"]." - ".$reg[$i]["direccliente"]),utf8_decode($reg[$i]['correocliente']),utf8_decode($reg[$i]["limitecredito"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR CLIENTES ##############################

########################## FUNCION LISTAR PROVEEDORES ##############################
function TablaListarProveedores()
   {

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE PROVEEDORES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE DOCUMENTO',1,0,'C', True);
    $this->Cell(60,8,'NOMBRE DE PROVEEDOR',1,0,'C', True);
    $this->Cell(25,8,'Nº DE TLF',1,0,'C', True);
    $this->Cell(75,8,'DIRECCIÓN DOMICILIARIA',1,0,'C', True);
    $this->Cell(60,8,'EMAIL',1,0,'C', True);
    $this->Cell(35,8,'VENDEDOR',1,0,'C', True);
    $this->Cell(25,8,'Nº DE TLF',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarProveedores();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,60,25,75,60,35,25));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["documento"]." ".$reg[$i]["cuitproveedor"]),portales(utf8_decode($reg[$i]["nomproveedor"])),utf8_decode($reg[$i]["tlfproveedor"]),utf8_decode($reg[$i]["direcproveedor"]),utf8_decode($reg[$i]['emailproveedor']),utf8_decode($reg[$i]["vendedor"]),utf8_decode($reg[$i]["tlfvendedor"])));
       }
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR PROVEEDORES ##############################











########################## FUNCION LISTAR INSUMOS DE LIMPIEZA ##########################
function TablaListarInsumos()
   {
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE INSUMOS DE LIMPIEZA',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(20,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(65,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(35,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(35,8,'PRECIO COMPRA',1,0,'C', True);
    $this->Cell(35,8,'PRECIO VENTA',1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(30,8,'STOCK MINIMO',1,0,'C', True);
    $this->Cell(40,8,'FECHA EXPIRACIÓN',1,0,'C', True);
    $this->Cell(15,8,$impuesto,1,0,'C', True);
    $this->Cell(15,8,'DESC',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarInsumos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,20,65,35,35,35,25,30,40,15,15));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalCompra=0;
    $TotalVenta=0;
    $TotalArticulos=0;
    for($i=0;$i<sizeof($reg);$i++){ 
    $TotalCompra+=$reg[$i]['preciocompra'];
    $TotalVenta+=$reg[$i]['precioventa']-$reg[$i]['descinsumo']/100;
    $TotalArticulos+=$reg[$i]['existencia'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codinsumo"]),utf8_decode($reg[$i]["insumo"]),utf8_decode($reg[$i]["nomcategoria"]),utf8_decode($simbolo.number_format($reg[$i]['preciocompra'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['precioventa'], 2, '.', ',')),utf8_decode($reg[$i]["existencia"]),utf8_decode($reg[$i]["stockminimo"]),utf8_decode($reg[$i]['fechaexpiracion'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechaexpiracion']))),
        utf8_decode($reg[$i]['ivainsumo'] == 'SI' ? $imp[0]["valorimpuesto"]."%" : "(E)"),
        utf8_decode($reg[$i]['descinsumo'])));
       }
   
    $this->Cell(85,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(50,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalCompra, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalVenta, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(25,5,utf8_decode($TotalArticulos),1,0,'L');
    $this->Ln();
   }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
######################### FUNCION LISTAR INSUMOS DE LIMPIEZA #########################

##################### FUNCION LISTAR SALIDA DE INSUMOS DE LIMPIEZA ######################
function TablaListarSalidaInsumos()
   {
    
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");
    
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']); 

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',12);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(190,10,'LISTADO GENERAL SALIDAS DE INSUMOS DE LIMPIEZA',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(15,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(40,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(35,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(15,8,'SALIDA',1,0,'C', True);
    $this->Cell(45,8,'RESPONSABLE',1,0,'C', True);
    $this->Cell(30,8,'FECHA SALIDA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarSalidaInsumos();

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,15,40,35,15,45,30));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codinsumo"]),utf8_decode($reg[$i]["insumo"]),utf8_decode($reg[$i]["nomcategoria"]),utf8_decode($reg[$i]["cantsalida"]),utf8_decode($reg[$i]['responsable'] == '' ? "*********" : $reg[$i]['responsable']),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechasalida'])))));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
###################### FUNCION LISTAR SALIDA DE INSUMOS DE LIMPIEZA #####################

######################## FUNCION LISTAR KARDEX POR INSUMO ##############################
function TablaListarKardexInsumos()
   {

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $kardex = new Login();
    $kardex = $kardex->BuscarKardexInsumo(); 

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,"KARDEX GENERAL DEL INSUMO (".$kardex[0]["insumo"].")",0,0,'C');    

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(45,8,'MOVIMIENTO',1,0,'C', True);
    $this->Cell(25,8,'ENTRADAS',1,0,'C', True);
    $this->Cell(25,8,'SALIDAS',1,0,'C', True);
    $this->Cell(25,8,'DEVOLUCIÓN',1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(20,8,$impuesto,1,0,'C', True);
    $this->Cell(30,8,'DESCUENTO',1,0,'C', True);
    $this->Cell(25,8,'PRECIO',1,0,'C', True);
    $this->Cell(60,8,'DOCUMENTO',1,0,'C', True);
    $this->Cell(35,8,'FECHA KARDEX',1,1,'C', True);

    if($kardex==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,45,25,25,25,25,20,30,25,60,35));

    $TotalEntradas=0;
    $TotalSalidas=0;
    $TotalDevolucion=0;
    $a=1;
    for($i=0;$i<sizeof($kardex);$i++){ 
    $TotalEntradas+=$kardex[$i]['entradas'];
    $TotalSalidas+=$kardex[$i]['salidas'];
    $TotalDevolucion+=$kardex[$i]['devolucion'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($kardex[$i]["movimiento"]),
        utf8_decode($kardex[$i]["entradas"]),
        utf8_decode($kardex[$i]["salidas"]),
        utf8_decode($kardex[$i]["devolucion"]),
        utf8_decode($kardex[$i]['stockactual']),
        utf8_decode($kardex[$i]['ivainsumo'] == 'SI' ? $imp[0]["valorimpuesto"]."%" : "(E)"),
        utf8_decode($kardex[$i]['descinsumo']),
        utf8_decode($simbolo.number_format($kardex[$i]['precio'], 2, '.', ',')),
        utf8_decode($kardex[$i]['documento']),
        utf8_decode(date("d-m-Y",strtotime($kardex[$i]['fechakardex'])))));
       }
   }
   
    $this->Cell(325,5,'',0,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(120,5,'DETALLES DEL INSUMO',1,0,'C', True);
    $this->Ln();
    
    $this->Cell(35,5,'CÓDIGO',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($kardex[0]['codinsumo']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'DESCRIPCIÓN',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($kardex[0]['insumo']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'ENTRADAS',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($TotalEntradas),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'SALIDAS',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($TotalSalidas),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'DEVOLUCIÓN',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($TotalDevolucion),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'EXISTENCIA',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($kardex[0]['existencia']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'PRECIO COMPRA',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($simbolo.number_format($kardex[0]['preciocompra'], 2, '.', ',')),1,0,'C');
    $this->Ln();
    

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR KARDEX POR INSUMO ##############################




########################## FUNCION LISTAR PRODUCTOS ##############################
function TablaListarProductos()
   {
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $tra = new Login();
    $reg = $tra->ListarProductos(); 

    $monedap = new Login();
    $cambio = $monedap->MonedaProductoId(); 
   
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(330,7,'LISTADO GENERAL DE PRODUCTOS EN ALMACEN',0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(25,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(90,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(50,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(40,8,'PRECIO COMPRA',1,0,'C', True);
    $this->Cell(40,8,'PRECIO VENTA',1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(20,8,$impuesto,1,0,'C', True);
    $this->Cell(15,8,'DESC',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,25,90,50,40,40,25,20,15));

    $a=1;
    $TotalCompra=0;
    $TotalVenta=0;
    $TotalMoneda=0;
    $TotalArticulos=0;
    for($i=0;$i<sizeof($reg);$i++){ 
    $TotalCompra+=$reg[$i]['preciocompra'];
    $TotalVenta+=$reg[$i]['precioventa']-$reg[$i]['descproducto']/100;
    $TotalArticulos+=$reg[$i]['existencia'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]['codproducto']),
        portales(utf8_decode($reg[$i]["producto"])),
        utf8_decode($reg[$i]["nomcategoria"]),
        utf8_decode($simbolo.number_format($reg[$i]['preciocompra'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($reg[$i]['precioventa'], 2, '.', ',')),
        utf8_decode($reg[$i]['existencia']),
        utf8_decode($reg[$i]['ivaproducto'] == 'SI' ? $imp[0]["valorimpuesto"]."%" : "(E)"),
        utf8_decode($reg[$i]['descproducto'])));
       }
   
    $this->Cell(130,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(50,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalCompra, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalVenta, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(25,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->Ln();
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR PRODUCTOS ##############################

######################## FUNCION LISTAR KARDEX POR PRODUCTO #########################
function TablaListarKardexProducto()
   {

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $kardex = new Login();
    $kardex = $kardex->BuscarKardexProducto(); 

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,"KARDEX GENERAL DEL PRODUCTO (".$kardex[0]["producto"].")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'MOVIMIENTO',1,0,'C', True);
    $this->Cell(25,8,'ENTRADAS',1,0,'C', True);
    $this->Cell(25,8,'SALIDAS',1,0,'C', True);
    $this->Cell(25,8,'DEVOLUCIÓN',1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(20,8,$impuesto,1,0,'C', True);
    $this->Cell(30,8,'DESCUENTO',1,0,'C', True);
    $this->Cell(30,8,'PRECIO',1,0,'C', True);
    $this->Cell(70,8,'DOCUMENTO',1,0,'C', True);
    $this->Cell(30,8,'FECHA KARDEX',1,1,'C', True);

    if($kardex==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,35,25,25,25,25,20,30,30,70,30));

    $TotalEntradas=0;
    $TotalSalidas=0;
    $TotalDevolucion=0;
    $a=1;
    for($i=0;$i<sizeof($kardex);$i++){ 
    $TotalEntradas+=$kardex[$i]['entradas'];
    $TotalSalidas+=$kardex[$i]['salidas'];
    $TotalDevolucion+=$kardex[$i]['devolucion'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($kardex[$i]["movimiento"]),
        utf8_decode($kardex[$i]["entradas"]),
        utf8_decode($kardex[$i]["salidas"]),
        utf8_decode($kardex[$i]["devolucion"]),
        utf8_decode($kardex[$i]['stockactual']),
        utf8_decode($kardex[$i]['ivaproducto'] == 'SI' ? $imp[0]["valorimpuesto"]."%" : "(E)"),
        utf8_decode($kardex[$i]['descproducto']),
        utf8_decode($simbolo.number_format($kardex[$i]['precio'], 2, '.', ',')),
        utf8_decode($kardex[$i]['documento']),
        utf8_decode(date("d-m-Y",strtotime($kardex[$i]['fechakardex'])))));
       }
   }
   
    $this->Cell(325,5,'',0,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(120,5,'DETALLES DEL PRODUCTO',1,0,'C', True);
    $this->Ln();
    
    $this->Cell(35,5,'CÓDIGO',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($kardex[0]['codproducto']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'DESCRIPCIÓN',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,portales(utf8_decode($kardex[0]['producto'])),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'ENTRADAS',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($TotalEntradas),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'SALIDAS',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($TotalSalidas),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'DEVOLUCIÓN',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($TotalDevolucion),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'EXISTENCIA',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($kardex[0]['existencia']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'PRECIO COMPRA',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($simbolo.number_format($kardex[0]['preciocompra'], 2, '.', ',')),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'PRECIO VENTA',1,0,'C', True);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(85,5,utf8_decode($simbolo.number_format($kardex[0]['precioventa'], 2, '.', ',')),1,0,'C');
    $this->Ln();
    

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR KARDEX POR PRODUCTO #########################

########################## FUNCION LISTAR PRODUCTOS VENDIDOS #########################
function TablaListarProductosVendidos()
   {

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $tra = new Login();
    $reg = $tra->BuscarProductosVendidos(); 

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(330,7,'LISTADO DE PRODUCTOS VENDIDOS POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');   

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(30,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(100,8,'DESCRIPCIÓN DE PRODUCTO',1,0,'C', True);
    $this->Cell(50,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(20,8,'DESC',1,0,'C', True);
    $this->Cell(30,8,"PRECIO VENTA",1,0,'C', True);
    $this->Cell(30,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(25,8,'VENDIDO',1,0,'C', True);
    $this->Cell(30,8,'MONTO TOTAL',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
	$this->SetWidths(array(15,30,100,50,20,30,30,25,30));

    $precioTotal=0;
    $existeTotal=0;
    $vendidosTotal=0;
    $pagoTotal=0;
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $precioTotal+=$reg[$i]['precioventa'];
    $existeTotal+=$reg[$i]['existencia'];
    $vendidosTotal+=$reg[$i]['cantidad']; 

    $Descuento = $reg[$i]['descproducto']/100;
    $PrecioDescuento = $reg[$i]['precioventa']*$Descuento;
    $PrecioFinal = $reg[$i]['precioventa']-$PrecioDescuento;
    $pagoTotal+=$PrecioFinal*$reg[$i]['cantidad'];

	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,
		utf8_decode($reg[$i]["codproducto"]),
		portales(utf8_decode($reg[$i]["producto"])),
		utf8_decode($reg[$i]["nomcategoria"]),
		utf8_decode($reg[$i]['descproducto']),
		utf8_decode($simbolo.number_format($reg[$i]["precioventa"], 2, '.', ',')),
		utf8_decode($reg[$i]['existencia']),
		utf8_decode($reg[$i]['cantidad']),
		utf8_decode($simbolo.number_format($pagoTotal*$reg[$i]['cantidad'], 2, '.', ','))));
       }
   }
   
    $this->Cell(165,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(50,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($precioTotal, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($existeTotal),0,0,'L');
    $this->CellFitSpace(25,5,utf8_decode($vendidosTotal),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($pagoTotal, 2, '.', ',')),0,0,'L');
    $this->Ln();
   

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR PRODUCTOS VENDIDOS ##########################

######################### FUNCION LISTAR PRODUCTOS SEGUN MODENA #########################
function TablaListarProductosxMoneda()
   {

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $cambio = new Login();
    $cambio = $cambio->BuscarTiposCambios();

    $tra = new Login();
    $reg = $tra->ListarProductos(); 

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO GENERAL DE PRODUCTOS EN ALMACEN',0,1,'C');
    $this->Cell(330,7," Y MONEDA (".$cambio[0]["moneda"].")",0,0,'C');    
    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(30,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(100,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(50,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(35,8,'PRECIO VENTA',1,0,'C', True);
    $this->Cell(30,8,'PRECIO '.$cambio[0]['siglas'],1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(20,8,$impuesto,1,0,'C', True);
    $this->Cell(25,8,'DESCUENTO',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,30,100,50,35,30,25,20,25));

    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codproducto"]),portales(utf8_decode($reg[$i]["producto"])),utf8_decode($reg[$i]["nomcategoria"]),utf8_decode($simbolo.number_format($reg[$i]['precioventa'], 2, '.', ',')),$tipo = ($cambio[0]['moneda'] == "EURO" ? chr(128) : $cambio[0]['simbolo']).utf8_decode(number_format($reg[$i]['precioventa']/$cambio[0]['montocambio'], 2, '.', ',')),utf8_decode($reg[$i]['existencia']),utf8_decode($reg[$i]['ivaproducto']),utf8_decode($reg[$i]['descproducto'])));
       }
   }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
################## FUNCION LISTAR PRODUCTOS SEGUN MODENA ###################

############################### REPORTES DE MANTENIMIENTO #############################










































############################### REPORTES DE COMPRAS ##################################

########################## FUNCION FACTURA COMPRA ##############################
function FacturaCompra()
    {
        
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);

    $tra = new Login();
    $reg = $tra->ComprasPorId();

    //Logo
    if (file_exists("fotos/logo-admin.png")) {
        $logo = "./fotos/logo-admin.png";
        $this->Image($logo , 15, 11, 66 , 18, "PNG");

    } else {

        $logo = "./assets/images/null.png";                         
        $this->Image($logo , 15, 11, 66, 20, "PNG");  
    } 


######################### BLOQUE N° 1 ######################### 
   //BLOQUE DE DATOS DE PRINCIPAL
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 10, 335, 20, '1.5', '');
    
    //Bloque de membrete principal
    $this->SetFillColor(229);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(161, 13, 13, 13, '1.5', 'F');

    //Bloque de membrete principal
    $this->SetFillColor(229);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(161, 13, 13, 13, '1.5', '');

    $this->SetFont('courier','B',24);
    $this->SetXY(164, 16.5);
    $this->Cell(20, 5, 'C', 0 , 0);
    
    $this->SetFont('courier','B',12);
    $this->SetXY(270, 12);
    $this->Cell(42, 5, 'N° DE COMPRA ', 0, 0);
    $this->SetFont('courier','B',12);
    $this->SetXY(312, 12);
    $this->CellFitSpace(30, 5,utf8_decode($reg[0]['codcompra']), 0, 0, "R");
    
    $this->SetFont('courier','B',10);
    $this->SetXY(270, 16);
    $this->Cell(42, 5, 'FECHA DE EMISIÓN ', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(312, 16);
    $this->CellFitSpace(30, 5,utf8_decode(date("d-m-Y",strtotime($reg[0]['fechaemision']))), 0, 0, "R");
    
    $this->SetFont('courier','B',10);
    $this->SetXY(270, 20);
    $this->Cell(42, 5, 'FECHA DE RECEPCIÓN ', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(312, 20);
    $this->CellFitSpace(30, 5,utf8_decode(date("d-m-Y",strtotime($reg[0]['fecharecepcion']))), 0, 0, "R");
    
    $this->SetFont('courier','B',10);
    $this->SetXY(270, 24);
    $this->Cell(42, 5, 'ESTADO DE COMPRA', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(312, 24);
    
    if($reg[0]['fechavencecredito']== '0000-00-00') { 
    $this->Cell(30, 5,utf8_decode($reg[0]['statuscompra']), 0, 0, "R");
    } elseif($reg[0]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->Cell(30, 5,utf8_decode($reg[0]['statuscompra']), 0, 0, "R");
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) { 
    $this->Cell(30, 5,utf8_decode("VENCIDA"), 0, 0, "R");
    }
######################### BLOQUE N° 1 ######################### 

############################## BLOQUE N° 2 #####################################   
   //BLOQUE DE DATOS DE PROVEEDOR
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 32, 335, 30, '1.5', '');

    //DATOS DE HOTEL LINEA 1
    $this->SetFont('courier','B',12);
    $this->SetXY(12, 33);
    $this->Cell(330, 5, 'DATOS DE HOTEL ', 0, 0);
    //DATOS DE HOTEL LINEA 1

    //DATOS DE HOTEL LINEA 2
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 38);
    $this->CellFitSpace(28, 5, 'Nº DE '.$documento = ($con[0]['documenhotel'] == '0' ? "REG.:" : $con[0]['documento'].":"), 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(40, 38);
    $this->CellFitSpace(30, 5,utf8_decode($con[0]['nrohotel']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(70, 38);
    $this->Cell(30, 5, 'RAZÓN SOCIAL:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(100, 38);
    $this->CellFitSpace(50, 5,utf8_decode($con[0]['nomhotel']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(150, 38);
    $this->Cell(24, 5, 'DIRECCIÓN:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(174, 38);
    $this->CellFitSpace(116, 5,utf8_decode($con[0]['direchotel']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(290, 38);
    $this->Cell(22, 5, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(312, 38);
    $this->CellFitSpace(30, 5,utf8_decode($con[0]['tlfhotel']), 0, 0);
    //DATOS DE HOTEL LINEA 2

    //DATOS DE HOTEL LINEA 3
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 42);
    $this->Cell(28, 5, 'EMAIL:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(40, 42);
    $this->CellFitSpace(80, 5,utf8_decode($con[0]['emailhotel']), 0, 0);
    //DATOS DE HOTEL LINEA 3

    //DATOS DE HOTEL LINEA 4
    $this->SetFont('courier','B',10);
    $this->SetXY(120, 42);
    $this->Cell(30, 5, 'RESPONSABLE:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(150, 42);
    $this->CellFitSpace(80, 5,utf8_decode($con[0]['nomgerente']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(230, 42);
    $this->CellFitSpace(26, 5,'Nº DE '.$documento = ($con[0]['documgerente'] == '0' ? "DOC.:" : $con[0]['documento2'].":"), 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(256, 42);
    $this->CellFitSpace(34, 5,utf8_decode($con[0]['cedgerente']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(290, 42);
    $this->Cell(22, 5, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(312, 42);
    $this->CellFitSpace(30, 5,utf8_decode($tlf = ($con[0]['tlfgerente'] == '' ? "*********" : $con[0]['tlfgerente'])), 0, 0);
    //DATOS DE HOTEL LINEA 4
################################# BLOQUE N° 2 #######################################   

################################# BLOQUE N° 3 #######################################   
    //DATOS DE HOTEL LINEA 5
    $this->SetFont('courier','B',12);
    $this->SetXY(12, 48);
    $this->Cell(330, 4, 'DATOS DE PROVEEDOR', 0, 0);
    //DATOS DE HOTEL LINEA 5

    //DATOS DE HOTEL LINEA 6
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 52);
    $this->CellFitSpace(28, 5, 'Nº DE '.$documento = ($reg[0]['documproveedor'] == '0' ? "DOC.:" : $reg[0]['documento'].":"), 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(40, 52);
    $this->CellFitSpace(30, 5,utf8_decode($reg[0]['cuitproveedor']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(70, 52);
    $this->Cell(30, 5, 'RAZÓN SOCIAL:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(100, 52);
    $this->CellFitSpace(84, 5,utf8_decode($reg[0]['nomproveedor']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(184, 52);
    $this->Cell(24, 5, 'DIRECCIÓN:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(208, 52);
    $this->CellFitSpace(134, 5,utf8_decode($reg[0]['direcproveedor']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(12, 56);
    $this->Cell(28, 5, 'EMAIL:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(40, 56);
    $this->CellFitSpace(130, 5,utf8_decode($reg[0]['emailproveedor']), 0, 0);
    //DATOS DE HOTEL LINEA 6

    //DATOS DE HOTEL LINEA 7
    $this->SetFont('courier','B',10);
    $this->SetXY(170, 56);
    $this->Cell(24, 5, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(194, 56);
    $this->CellFitSpace(38, 5,utf8_decode($reg[0]['tlfproveedor']), 0, 0);

    $this->SetFont('courier','B',10);
    $this->SetXY(232, 56);
    $this->Cell(24, 5, 'VENDEDOR:', 0, 0);
    $this->SetFont('courier','',10);
    $this->SetXY(256, 56);
    $this->CellFitSpace(86, 5,utf8_decode($reg[0]['vendedor']), 0, 0);
    //DATOS DE HOTEL LINEA 7
################################# BLOQUE N° 3 #######################################   

################################# BLOQUE N° 4 #######################################   
    //Bloque Cuadro de Detalles de Productos
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 68, 335, 90, '0', '');

    $this->SetFont('courier','B',9);
    $this->SetXY(10, 64);
    $this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
    $this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
    $this->Cell(10,8,'N°',1,0,'C', True);
    $this->Cell(20,8,'TIPO',1,0,'C', True);
    $this->Cell(30,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(18,8,'LOTE',1,0,'C', True);
    $this->Cell(23,8,'F.VCTO',1,0,'C', True);
    $this->Cell(75,8,'DESCRIPCIÓN DE PRODUCTO',1,0,'C', True);
    $this->Cell(30,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(15,8,'CANT',1,0,'C', True);
    $this->Cell(15,8,$impuesto,1,0,'C', True);
    $this->Cell(25,8,'PRECIO UNIT',1,0,'C', True);
    $this->Cell(25,8,'VALOR TOTAL',1,0,'C', True);
    $this->Cell(18,8,'% DCTO',1,0,'C', True);
    $this->Cell(31,8,'VALOR NETO',1,1,'C', True);
################################# BLOQUE N° 4 ####################################### 

################################# BLOQUE N° 5 ####################################### 
    $tra = new Login();
    $detalle = $tra->VerDetallesCompras();
    $cantidad = 0;
    $SubTotal = 0;

     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,20,30,18,23,75,30,15,15,25,25,18,31));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($detalle);$i++){ 
    $cantidad += $detalle[$i]['cantcompra'];
    $valortotal = $detalle[$i]["preciocomprac"]*$detalle[$i]["cantcompra"];
    $SubTotal += $detalle[$i]['valorneto'];

    $this->SetX(10);
    $this->SetFont('Courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->RowFacture(array($a++,
        utf8_decode($detalle[$i]["tipoentrada"]),
        utf8_decode($detalle[$i]["codproducto"]),
        utf8_decode($detalle[$i]["lotec"]),
        utf8_decode($detalle[$i]["fechaexpiracionc"] == '0000-00-00' ? "******" : $detalle[$i]["fechaexpiracionc"]),
        portales(utf8_decode($detalle[$i]["producto"])),
        utf8_decode($detalle[$i]["nomcategoria"]),
        utf8_decode($detalle[$i]["cantcompra"]),
        utf8_decode($detalle[$i]["ivaproductoc"] == 'SI' ? $reg[0]['ivac']."%" : "(E)"),
        utf8_decode($simbolo.number_format($detalle[$i]['preciocomprac'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($detalle[$i]['valortotal'], 2, '.', ',')),
        utf8_decode(number_format($detalle[$i]['descfactura'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','))));
       }
################################# BLOQUE N° 5 ####################################### 

    ########################### BLOQUE N° 5 DE TOTALES #############################    
    //Bloque de Informacion adicional
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 162, 240, 38, '1.5', '');

    //Linea de membrete Nro 1
    $this->SetFont('courier','B',14);
    $this->SetXY(115, 164);
    $this->Cell(20, 5, 'INFORMACIÓN ADICIONAL', 0 , 0);
       
    //Linea de membrete Nro 2
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 170);
    $this->Cell(20, 5, 'CANTIDAD DE PRODUCTOS:', 0 , 0);
    $this->SetXY(64, 170);
    $this->SetFont('courier','',10);
    $this->Cell(20, 5,utf8_decode($cantidad), 0 , 0);
       
    //Linea de membrete Nro 3
    $this->SetFont('courier','B',10);
    $this->SetXY(120, 170);
    $this->Cell(20, 5, 'TIPO DE DOCUMENTO:', 0 , 0);
    $this->SetXY(168, 170);
    $this->SetFont('courier','',10);
    $this->Cell(20, 5,utf8_decode("FACTURA"), 0 , 0);
       
    //Linea de membrete Nro 4
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 175);
    $this->Cell(20, 5, 'TIPO DE PAGO:', 0 , 0);
    $this->SetXY(64, 175);
    $this->SetFont('courier','',10);
    $this->Cell(20, 5,utf8_decode($reg[0]['tipocompra']), 0 , 0);
       
    if($reg[0]['tipocompra']=="CREDITO"){

   //Linea de membrete Nro 5
    $this->SetFont('courier','B',10);
    $this->SetXY(120, 175);
    $this->Cell(20, 5, 'FECHA DE VENCIMIENTO:', 0 , 0);
    $this->SetXY(168, 175);
    $this->SetFont('courier','',10);
    $this->Cell(20, 5,utf8_decode($vence = ( $reg[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($reg[0]['fechavencecredito'])))), 0 , 0);
        
    //Linea de membrete Nro 6
    $this->SetFont('courier','B',10);
    $this->SetXY(200, 175);
    $this->Cell(20, 5, 'DIAS VENCIDOS:', 0 , 0);
    $this->SetXY(234, 175);
    $this->SetFont('courier','',10);
        
      if($reg[0]['fechavencecredito']== '0000-00-00') { 
        $this->Cell(20, 5,utf8_decode("0"), 0 , 0);
      } elseif($reg[0]['fechavencecredito'] >= date("Y-m-d")) { 
        $this->Cell(20, 5,utf8_decode("0"), 0 , 0);
      } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) { 
        $this->Cell(20, 5,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito'])), 0 , 0);
      }
    }
    
    //Linea de membrete Nro 4
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 180);
    $this->Cell(20, 5, 'MEDIO DE PAGO:', 0 , 0);
    $this->SetXY(64, 180);
    $this->SetFont('courier','',10);
    $this->Cell(20, 5,utf8_decode($variable = ($reg[0]['tipocompra'] == 'CONTADO' ? $reg[0]['mediopago'] : $reg[0]['formacompra'])), 0 , 0);
    
    //Linea de membrete Nro 4
    $this->SetFont('courier','B',10);
    $this->SetXY(12, 185);
    $this->MultiCell(236,4,$this->SetFont('Courier','',10).utf8_decode(numtoletras($reg[0]["totalpagoc"])),0,'J');
    
    //Bloque de Totales de factura
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(253, 162, 91, 38, '1.5', '');

     //Linea de membrete Nro 1
    $this->SetFont('courier','B',10);
    $this->SetXY(254, 165);
    $this->CellFitSpace(44, 5, 'SUBTOTAL:', 0, 0);
    $this->SetXY(298, 165);
    $this->SetFont('courier','',10);
    $this->CellFitSpace(46, 5,utf8_decode($simbolo.number_format($SubTotal, 2, '.', ',')), 0, 0, "R");

     //Linea de membrete Nro 2
    $this->SetFont('courier','B',10);
    $this->SetXY(254, 170);
    $this->CellFitSpace(44, 5, 'TOTAL GRAVADO ('.$reg[0]["ivac"].'%):', 0, 0);
    $this->SetXY(298, 170);
    $this->SetFont('courier','',10);
    $this->CellFitSpace(46, 5,utf8_decode($simbolo.number_format($reg[0]["subtotalivasic"], 2, '.', ',')), 0, 0, "R");

     //Linea de membrete Nro 3
    $this->SetFont('courier','B',10);
    $this->SetXY(254, 175);
    $this->CellFitSpace(44, 5, 'TOTAL EXENTO (0%):', 0, 0);
    $this->SetXY(298, 175);
    $this->SetFont('courier','',10);
    $this->CellFitSpace(46, 5,utf8_decode($simbolo.number_format($reg[0]["subtotalivanoc"], 2, '.', ',')), 0, 0, "R");

     //Linea de membrete Nro 4
    $this->SetFont('courier','B',10);
    $this->SetXY(254, 180);
    $this->CellFitSpace(44, 5, $impuesto == '' ? "TOTAL IMP." : "TOTAL ".$impuesto." (".$reg[0]["ivac"]."%):", 0, 0);
    $this->SetXY(298, 180);
    $this->SetFont('courier','',10);
    $this->CellFitSpace(46, 5,utf8_decode($simbolo.number_format($reg[0]["totalivac"], 2, '.', ',')), 0, 0, "R");

     //Linea de membrete Nro 5
    $this->SetFont('courier','B',10);
    $this->SetXY(254, 185);
    $this->CellFitSpace(44, 5, "DESC. GLOBAL (".$reg[0]["descuentoc"].'%):', 0, 0);
    $this->SetXY(298, 185);
    $this->SetFont('courier','',10);
    $this->CellFitSpace(46, 5,utf8_decode($simbolo.number_format($reg[0]["totaldescuentoc"], 2, '.', ',')), 0, 0, "R");

     //Linea de membrete Nro 6
    $this->SetFont('courier','B',10);
    $this->SetXY(254, 190);
    $this->CellFitSpace(44, 5, 'IMPORTE TOTAL:', 0, 0);
    $this->SetXY(298, 190);
    $this->SetFont('courier','',10);
    $this->CellFitSpace(46, 5,utf8_decode($simbolo.number_format($reg[0]["totalpagoc"], 2, '.', ',')), 0, 0, "R");
    
    }
########################## FUNCION FACTURA COMPRA ##############################

########################## FUNCION LISTAR COMPRAS ##############################
function TablaListarCompras()
   {
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarCompras();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE COMPRAS',0,0,'C');


    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE COMPRA',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE PROVEEDOR',1,0,'C', True);
    $this->Cell(40,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(40,8,'TOTAL GRAVADO',1,0,'C', True);
    $this->Cell(40,8,'TOTAL EXENTO',1,0,'C', True);
    $this->Cell(40,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(40,8,'FECHA DE EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,40,40,40,40,40));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalGravado=0;
    $TotalExento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalGravado+=$reg[$i]['subtotalivasic'];
    $TotalExento+=$reg[$i]['subtotalivanoc'];
    $TotalImporte+=$reg[$i]['totalpagoc'];
 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codcompra"]),portales(utf8_decode($reg[$i]["nomproveedor"])),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['subtotalivasic'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['subtotalivanoc'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ',')),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechaemision'])))));
        }
   
    $this->Cell(130,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(40,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalGravado, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalExento, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR COMPRAS ##############################

########################## FUNCION LISTAR CUENTAS POR PAGAR #########################
function TablaListarCuentasxPagar()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $tra = new Login();
    $reg = $tra->ListarCuentasxPagar();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE CUENTAS POR PAGAR',0,0,'C');


    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE COMPRA',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE PROVEEDOR',1,0,'C', True);
    $this->Cell(40,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(40,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(40,8,'STATUS',1,0,'C', True);
    $this->Cell(40,8,'FECHA VENCE',1,0,'C', True);
    $this->Cell(40,8,'FECHA DE EMISIÓN',1,1,'C', True);
    
    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,40,40,40,40,40));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalImporte+=$reg[$i]['totalpagoc'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codcompra"]),portales(utf8_decode($reg[$i]["nomproveedor"])),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ',')),utf8_decode($reg[$i]['fechavencecredito']== '0000-00-00' || $reg[$i]['fechavencecredito'] >= date("Y-m-d") ? $reg[$i]['statuscompra'] : "VENCIDA"),utf8_decode($reg[$i]['fechavencecredito'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechavencecredito']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechaemision'])))));
        }
   
    $this->Cell(130,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(40,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR CUENTAS POR PAGAR #########################

####################### FUNCION LISTAR COMPRAS POR PROVEEDORES ########################
function TablaListarComprasxProveedor()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarComprasxProveedor();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE COMPRAS POR PROVEEDOR',0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE COMPRA',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE PROVEEDOR',1,0,'C', True);
    $this->Cell(40,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(40,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(40,8,'STATUS',1,0,'C', True);
    $this->Cell(40,8,'FECHA VENCE',1,0,'C', True);
    $this->Cell(40,8,'FECHA DE EMISIÓN',1,1,'C', True);
    
    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,40,40,40,40,40));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalImporte+=$reg[$i]['totalpagoc'];
 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codcompra"]),portales(utf8_decode($reg[$i]["nomproveedor"])),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ',')),utf8_decode($reg[$i]['fechavencecredito']== '0000-00-00' || $reg[$i]['fechavencecredito'] >= date("Y-m-d") ? $reg[$i]['statuscompra'] : "VENCIDA"),utf8_decode($reg[$i]['fechavencecredito'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechavencecredito']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechaemision'])))));
        }
      }
   
    $this->Cell(130,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(40,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
####################### FUNCION LISTAR COMPRAS POR PROVEEDORES #########################

####################### FUNCION LISTAR COMPRAS POR FECHAS #########################
function TablaListarComprasxFechas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarComprasxFechas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE COMPRAS POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE COMPRA',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE PROVEEDOR',1,0,'C', True);
    $this->Cell(40,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(40,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(40,8,'STATUS',1,0,'C', True);
    $this->Cell(40,8,'FECHA VENCE',1,0,'C', True);
    $this->Cell(40,8,'FECHA DE EMISIÓN',1,1,'C', True);
    
    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,40,40,40,40,40));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalImporte+=$reg[$i]['totalpagoc'];
 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codcompra"]),portales(utf8_decode($reg[$i]["nomproveedor"])),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['totalpagoc'], 2, '.', ',')),utf8_decode($reg[$i]['fechavencecredito']== '0000-00-00' || $reg[$i]['fechavencecredito'] >= date("Y-m-d") ? $reg[$i]['statuscompra'] : "VENCIDA"),utf8_decode($reg[$i]['fechavencecredito'] == '0000-00-00' ? "*********" : date("d-m-Y",strtotime($reg[$i]['fechavencecredito']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechaemision'])))));
        }
      }
   
    $this->Cell(130,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(40,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(40,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR COMPRAS POR FECHAS #########################

############################### REPORTES DE COMPRAS #################################



























############################### REPORTES DE CAJAS DE VENTAS #############################

########################## FUNCION LISTAR CAJAS ASIGNADAS ##############################
function TablaListarCajas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarCajas();
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE CAJAS ASIGNADAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE CAJA',1,0,'C', True);
    $this->Cell(55,8,'NOMBRE DE CAJA',1,0,'C', True);
    $this->Cell(90,8,'RESPONSABLE',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,35,55,90));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["nrocaja"]),utf8_decode($reg[$i]['nomcaja']),utf8_decode($reg[$i]["nombres"])));
        }
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR CAJAS ASIGNADAS ##############################

########################## FUNCION TICKET CIERRE ARQUEO ##############################
function TicketCierre()
{  
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);

    $tra = new Login();
    $reg = $tra->ArqueoCajaPorId();

    if (file_exists("fotos/logo-pdf.png")) {

    $logo = "./fotos/logo-pdf.png";
    $this->Image($logo , 25, 4, 25, 12, "PNG");
    //$this->Image($logo , 20, 3, 35, 15, "PNG");
    $this->Ln(6);

    }
  
    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5, "TICKET DE CIERRE", 0, 0, 'C');
    $this->Ln(5);
  
    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,4,utf8_decode($con[0]['nomhotel']), 0, 1, 'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(70,3,$con[0]['documenhotel'] == '0' ? "" : "Nº ".$con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,utf8_decode($con[0]['direchotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,utf8_decode($con[0]['emailhotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"OBLIGADO A LLEVAR CONTABILIDAD: ".utf8_decode($con[0]['llevacontabilidad']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"AMBIENTE: PRODUCCIÓN",0,1,'C');
    
    $this->SetX(2);
    $this->CellFitSpace(70,3,"EMISIÓN: NORMAL",0,1,'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(20,3,"CAJA Nº:",0,0,'L');
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(50,3,utf8_decode($reg[0]['nrocaja']."-".$reg[0]['nomcaja']),0,1,'L');
    
    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(20,3,"CAJERO:",0,0,'L');
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(50,3,utf8_decode($reg[0]['nombres']),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(20,3,"FECHA EMISIÓN:",0,0,'L');
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(40,3,date("d-m-Y H:i:s"),0,1,'L');

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(30,3,"HORA APERTURA:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(40,3,utf8_decode(date("d-m-Y H:i:s",strtotime($reg[0]['fechaapertura']))),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(30,3,"HORA CIERRE:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(40,3,utf8_decode(date("d-m-Y H:i:s",strtotime($reg[0]['fechacierre']))),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(30,3,"MONTO APERTURA:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(40,3,utf8_decode($simbolo.number_format($reg[0]["montoinicial"], 2, '.', ',')),0,1,'L');

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,3,"DESGLOSE EN VENTAS",0,1,'C');
    $this->Ln(1);

    /*$a=1;
    for($i=0;$i<sizeof($reg);$i++):
       if($reg[$i]['mediopago'] != ""){

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,$reg[$i]['mediopago'],0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[$i]['montopagado'], 2, '.', ',')),0,1,'R');

       }
    endfor;*/

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"INGRESOS:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]["ingresos"], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"CRÉDITOS:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]["creditos"], 2, '.', ',')),0,1,'R');

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,3,"MOVIMIENTOS EN CAJA",0,1,'C');
    $this->Ln(1);

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"EGRESOS:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]["egresos"], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"ABONO CRÉDITO:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]["abonos"], 2, '.', ',')),0,1,'R');

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->CellFitSpace(70,3,"REPORTE DE CAJA",0,1,'C');
    $this->Ln(1);

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"TOTAL EN VENTAS:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]['ingresos']+$reg[0]['creditos'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"TOTAL INGRESOS:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]['ingresos']+$reg[0]['abonos'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"EFECTIVO EN CAJA:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]["dineroefectivo"], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(34,3,"DIF. EFECTIVO:",0,0,'L');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(6,3,utf8_decode($simbolo),0,0,'R');
    $this->SetFont('Courier',"B",8);
    $this->CellFitSpace(30,3,utf8_decode(number_format($reg[0]["diferencia"], 2, '.', ',')),0,1,'R');


    if($reg[0]["comentarios"]==""){

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->Ln(3);

   } else { 

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,3,'--------------------------',0,0,'C');
    $this->Ln(2);

    $this->SetX(2);
    $this->MultiCell(70,4,$this->SetFont('Courier',"",7).utf8_decode($reg[0]["comentarios"]),0,'L');

    $this->SetFont('Courier','B',12);
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->Ln(3);

    }
 
    $this->SetFont('Courier','BI',9);
    $this->SetX(2);
    $this->SetFillColor(3, 3, 3);
    $this->CellFitSpace(70,3,"GRACIAS POR SU ATENCIÓN",0,1,'C');
    $this->Ln(3);     
}
########################## FUNCION TICKET CIERRE ARQUEO ##############################

########################## FUNCION LISTAR ARQUEOS DE CAJAS ##############################
function TablaListarArqueos()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
	
    $tra = new Login();
    $reg = $tra->ListarArqueoCaja();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(330,10,'LISTADO GENERAL DE ARQUEOS EN CAJAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(100,8,'Nº DE CAJA',1,0,'C', True);
    $this->Cell(25,8,'INICIO',1,0,'C', True);
    $this->Cell(25,8,'CIERRE',1,0,'C', True);
    $this->Cell(20,8,'INICIAL',1,0,'C', True);
    $this->Cell(25,8,'INGRESOS',1,0,'C', True);
    $this->Cell(25,8,'EGRESOS',1,0,'C', True);
    $this->Cell(25,8,'CRÉDITOS',1,0,'C', True);
    $this->Cell(25,8,'ABONOS',1,0,'C', True);
    $this->Cell(25,8,'EFECTIVO',1,0,'C', True);
    $this->Cell(25,8,'DIFERENCIA',1,1,'C', True);
    
    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,100,25,25,20,25,25,25,25,25,25));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,
		utf8_decode($reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']."/".$reg[$i]['nombres']),
		utf8_decode( date("d-m-Y h:i:s",strtotime($reg[$i]['fechaapertura']))),
	utf8_decode($reg[$i]['fechacierre'] == '0000-00-00 00:00:00' ? "*********" : date("d-m-Y h:i:s",strtotime($reg[$i]['fechacierre']))),
		utf8_decode($simbolo.number_format($reg[$i]['montoinicial'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['ingresos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['egresos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['creditos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['abonos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['dineroefectivo'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['diferencia'], 2, '.', ','))));
        }
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR ARQUEOS DE CAJAS ##############################

########################## FUNCION LISTAR MOVIMIENTOS EN CAJA ##########################
function TablaListarMovimientos()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarMovimientos();
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',12);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,10,'LISTADO GENERAL DE MOVIMIENTOS EN CAJA',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE CAJA',1,0,'C', True);
    $this->Cell(20,8,'TIPO',1,0,'C', True);
    $this->Cell(55,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(30,8,'MONTO',1,0,'C', True);
    $this->Cell(35,8,'MEDIO',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,40,20,55,30,35));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]['nrocaja'].": ".$reg[$i]['nomcaja']),utf8_decode($reg[$i]["tipomovimiento"]),utf8_decode($reg[$i]['descripcionmovimiento']),utf8_decode($simbolo.number_format($reg[$i]['montomovimiento'], 2, '.', ',')),utf8_decode($reg[$i]["mediopago"])));
        }
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR MOVIMIENTOS EN CAJAS ########################

###################### FUNCION LISTAR ARQUEOS DE CAJAS POR FECHAS ########################
function TablaListarArqueosxFechas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
	
    $tra = new Login();
    $reg = $tra->BuscarArqueosxFechas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
	
	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(330,7,"LISTADO DE ARQUEOS EN (CAJA ".$reg[0]['nrocaja'].": ".$reg[0]['nomcaja'].": ".$reg[0]['nombres'].")",0,1,'C');
	$this->Cell(330,7,"Y FECHAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');


    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'INICIO',1,0,'C', True);
    $this->Cell(35,8,'CIERRE',1,0,'C', True);
    $this->Cell(20,8,'INICIAL',1,0,'C', True);
    $this->Cell(25,8,'INGRESOS',1,0,'C', True);
    $this->Cell(25,8,'EGRESOS',1,0,'C', True);
    $this->Cell(25,8,'CRÉDITOS',1,0,'C', True);
    $this->Cell(25,8,'ABONOS',1,0,'C', True);
    $this->Cell(35,8,'TOTAL COBRO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL INGRESOS',1,0,'C', True);
    $this->Cell(30,8,'EFECTIVO',1,0,'C', True);
    $this->Cell(30,8,'DIFERENCIA',1,1,'C', True);
    
    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,35,35,20,25,25,25,25,35,35,30,30));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,
		utf8_decode( date("d-m-Y h:i:s",strtotime($reg[$i]['fechaapertura']))),
	utf8_decode($reg[$i]['fechacierre'] == '0000-00-00 00:00:00' ? "*********" : date("d-m-Y h:i:s",strtotime($reg[$i]['fechacierre']))),
		utf8_decode($simbolo.number_format($reg[$i]['montoinicial'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['ingresos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['egresos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['creditos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['abonos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['ingresos']+$reg[$i]['creditos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']+$reg[$i]['abonos']-$reg[$i]['egresos'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['dineroefectivo'], 2, '.', ',')),
		utf8_decode($simbolo.number_format($reg[$i]['diferencia'], 2, '.', ','))));
        }
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
####################### FUNCION LISTAR ARQUEOS DE CAJAS POR FECHAS ######################

###################### FUNCION LISTAR MOVIMIENTOS EN CAJA POR FECHAS #####################
function TablaListarMovimientosxFechas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarMovimientosxFechas();
	
    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png"); 

	$this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+14, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()+8, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['documenhotel'] == '0' ? "" : $con[0]['documento'])." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(100,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

	$this->SetFont('Courier','B',14);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Cell(190,7,"LISTADO DE MOVIMIENTOS EN (CAJA ".$reg[0]['nrocaja'].": ".$reg[0]['nomcaja'].")",0,1,'C');
	$this->Cell(190,7,"Y FECHAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(10,8,'Nº',1,0,'C', True);
    $this->Cell(20,8,'TIPO',1,0,'C', True);
    $this->Cell(75,8,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(40,8,'MONTO',1,0,'C', True);
    $this->Cell(45,8,'MEDIO',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
	$this->SetWidths(array(10,20,75,40,45));

	/* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
	$this->SetFont('Courier','',10);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
	$this->Row(array($a++,utf8_decode($reg[$i]["tipomovimiento"]),utf8_decode($reg[$i]['descripcionmovimiento']),utf8_decode($simbolo.number_format($reg[$i]['montomovimiento'], 2, '.', ',')),utf8_decode($reg[$i]["mediopago"])));
        }
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(86,6,'RECIBIDO:____________________________',0,0,'');
    $this->Ln();
    $this->Cell(4,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(86,6,'',0,0,'');
    $this->Ln(4);
     }
#################### FUNCION LISTAR MOVIMIENTOS EN CAJAS POR FECHAS ######################

############################## REPORTES DE CAJAS DE VENTAS #############################































################################### REPORTES DE RESERVACIONES ##################################

########################## FUNCION TICKET RESERVACIONES ##############################
function TicketReservacion()
{  
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);

    $tra = new Login();
    $reg = $tra->ReservacionesPorId();

    if (file_exists("fotos/logo-admin.png")) {

    $logo = "./fotos/logo-admin.png";
    $this->Image($logo , 20, 3, 35, 15, "PNG");
    $this->Ln(8);

    }

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5, "TICKET DE RESERVACIÓN", 0, 0, 'C');
    $this->Ln(5);
  
    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['nomhotel'])), 0, 1, 'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$con[0]['documenhotel'] == '0' ? "" : "Nº ".$con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,portales(utf8_decode($con[0]['direchotel'])),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"OBLIGADO A LLEVAR CONTABILIDAD: ".utf8_decode($con[0]['llevacontabilidad']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"AMBIENTE: PRODUCCIÓN",0,1,'C');
    
    $this->SetX(2);
    $this->CellFitSpace(70,3,"EMISIÓN: NORMAL",0,1,'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);
    
    if($reg[0]['codcliente'] == '0'){

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(70,4,utf8_decode("A CONSUMIDOR FINAL"), 0, 1, 'J');   

    } else {

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$documento = ($reg[0]['documcliente'] == '0' ? "Nº DOC:" : "Nº ".$reg[0]['documento'].": ".$reg[0]['dnicliente']),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode($reg[0]['nomcliente'])),0,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode(getSubString($reg[0]['direccliente'],55))),0,'L');

    }

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(2);

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"Nro Ticket:  ", 0, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(35,4,utf8_decode($reg[0]['codreservacion']), 0, 1, 'R');

    if($reg[0]['codcaja'] == 1){
    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(18,4,"CAJERO:", 0, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(52,4,portales(utf8_decode($reg[0]['nombres'])), 0, 1, 'R');
    }

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"FECHA: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['fecharegistro']))), 0, 0, 'J');
    $this->CellFitSpace(35,4,"HORA: ".utf8_decode(date("H:i:s",strtotime($reg[0]['fecharegistro']))), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(35,4,"DESDE: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['reservacion_desde']))), 0, 0, 'J');
    $this->CellFitSpace(35,4,"HASTA: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['reservacion_hasta']))), 0, 0, 'R');
    $this->Ln();

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5,"DETALLES DE HABITACIONES", 0, 0, 'L');
    $this->Ln(6);

    $tra = new Login();
    $detalle = $tra->VerDetallesReservaciones();
    $cantidad = 0;
    $SubTotal = 0;
    $Articulos = 0;
    $a=1;
    for($i=0;$i<sizeof($detalle);$i++):
    //$SubTotal += $detalle[$i]['valortotal'];
    //$Articulos += $detalle[$i]['cantventa'];

    $this->SetX(2);
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(70,4,portales(utf8_decode(getSubString("#".$detalle[$i]['numhabitacion']." : ".$detalle[$i]["descriphabitacion"], 55))),0,1,'J');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,4,portales(utf8_decode("ADULTOS ".$detalle[$i]['adultos'])),0,0,'J');

    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,4,"NIÑOS ".$detalle[$i]['children'],0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(25,3,$simbolo.number_format($detalle[$i]["valortotal"], 2, '.', ','),0,0,'J');

    $this->SetFont('Courier','',8);
    $this->CellFitSpace(20,3,number_format($detalle[$i]["deschabitacion"], 2, '.', ',')."%",0,0,'C');

    $this->SetFont('Courier','',8);
    $this->CellFitSpace(25,3,$simbolo.number_format($detalle[$i]["valorneto"], 2, '.', ','),0,1,'R');
    $this->Ln(1);

    endfor;

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(22,4,"TIPO PAGO",0,0,'L');
    $this->Cell(48,4,utf8_decode($reg[0]['tipopago']),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(22,4,"SUBTOTAL",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]["subtotal"], 2, '.', ','),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(22,4,$impuesto == '' ? "IMPUESTO" : $impuesto." (".$reg[0]["iva"]."%):",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]["totaliva"], 2, '.', ','),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(22,4,"DESC (".number_format($reg[0]["descuento"], 2, '.', ',')."%)",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]['totaldescuento'], 2, '.', ','),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(22,4,"TOTAL",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]['totalpago'], 2, '.', ','),0,1,'R');

    ############# MUESTRO FORMA DE PAGO #############
    if($reg[0]['tipopago'] == "CONTADO"){

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(20,4,"PAGO",0,0,'L');
    $this->Cell(50,4,portales(utf8_decode($reg[0]['formapago'])),0,1,'R');

        if($reg[0]['codcaja'] == 1){
        $this->SetX(2);
        $this->SetFont('Courier','',9);
        $this->CellFitSpace(30,4,"SUMA DE SUS PAGOS",0,0,'L');
        $this->Cell(40,4,$simbolo.number_format($reg[0]['montopagado'], 2, '.', ','),0,1,'R');

        $this->SetX(2);
        $this->SetFont('Courier','',9);
        $this->CellFitSpace(30,4,"SU VUELTO",0,0,'L');
        $this->Cell(40,4,$simbolo.number_format($reg[0]['montodevuelto'], 2, '.', ','),0,1,'R');
        }
    }
    ############# MUESTRO FORMA DE PAGO #############

    ############# MUESTRO ABONOS Y PENDIENTE #############
    if($reg[0]['tipopago']=="CREDITO"){

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"ABONADO",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"PENDIENTE",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['totalpago']-$reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"VENCIMIENTO",0,0,'L');
    $this->Cell(40,4,utf8_decode(date("d-m-Y",strtotime($reg[0]["fechavencecredito"]))),0,1,'R');
    }
    ############# MUESTRO ABONOS Y PENDIENTE #############

    if($reg[0]['observaciones']!=""){
    ########################### OBSERVACIONES #############################
    $this->Ln(2);
    $this->SetX(2);  
    $this->SetFont('courier','B',8);
    $this->MultiCell(70,4,utf8_decode($reg[0]['observaciones']),0,1,'');
    $this->Ln(2);
    ########################### OBSERVACIONES #############################    
    }

    $this->Ln(2);
    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(25,4,"RESERVACIÓN:",0,0,'L');
    $this->CellFitSpace(45,4,utf8_decode($reg[0]['reservacion']),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['emailhotel'])),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(10,4,"TEL:",0,0,'L');
    $this->CellFitSpace(60,4,utf8_decode($con[0]['tlfhotel']),0,1,'L');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','BI',10);
    $this->SetFillColor(3, 3, 3);
    $this->CellFitSpace(70,3,"GRACIAS POR PREFERIRNOS",0,1,'C');
    $this->Ln(3);
}
########################## FUNCION TICKET RESERVACIONES ##############################

########################## FUNCION FACTURA RESERVACIONES #############################
function FacturaReservacion()
    {     
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);
        
    $tra = new Login();
    $reg = $tra->ReservacionesPorId();

    //Logo
    if (file_exists("fotos/logo-admin.png")) {
        $logo = "./fotos/logo-admin.png";
        $this->Image($logo , 15 ,11, 35 , 15 , "PNG");

    } else {

        $logo = "./assets/images/null.png";                         
        $this->Image($logo , 15 ,11, 55 , 15 , "PNG");  
    }                                      

############################ BLOQUE N° 1 FACTURA ###################################  
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 10, 190, 17, '1.5', '');
    
    $this->SetFillColor(229);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(98, 12, 12, 12, '1.5', 'F');

    $this->SetFillColor(229);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(98, 12, 12, 12, '1.5', '');

    $this->SetFont('courier','B',24);
    $this->SetXY(100.5, 15);
    $this->Cell(20, 5, 'R', 0 , 0);
    
    $this->SetFont('courier','B',11);
    $this->SetXY(124, 10);
    $this->Cell(34, 5, 'N° DE FACTURA ', 0, 0);
    $this->SetFont('courier','B',11);
    $this->SetXY(158, 10);
    $this->CellFitSpace(40, 5,utf8_decode($reg[0]['codreservacion']), 0, 0, "R");

    $this->SetFont('courier','B',9);
    $this->SetXY(124, 14);
    $this->Cell(34, 4, 'FECHA DE REGISTRO ', 0, 0);
    $this->SetFont('courier','',9);
    $this->SetXY(158, 14);
    $this->Cell(40, 4,utf8_decode(date("d-m-Y",strtotime($reg[0]['fecharegistro']))), 0, 0, "R");

    $this->SetFont('courier','B',9);
    $this->SetXY(124, 18);
    $this->Cell(34, 4, 'FECHA DE EMISIÓN', 0, 0);
    $this->SetFont('courier','',9);
    $this->SetXY(158, 18);
    $this->Cell(40, 4,utf8_decode(date("d-m-Y h:i:s")), 0, 0, "R");
    
    $this->SetFont('courier','B',9);
    $this->SetXY(124, 22);
    $this->Cell(34, 4, 'ESTADO DE PAGO', 0, 0);
    $this->SetFont('courier','B',9);
    $this->SetXY(158, 22);
    
    if($reg[0]['fechavencecredito']== '0000-00-00') { 
    $this->Cell(40, 4,utf8_decode($reg[0]['statuspago']), 0, 0, "R");
    } elseif($reg[0]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->Cell(40, 4,utf8_decode($reg[0]['statuspago']), 0, 0, "R");
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) { 
    $this->Cell(40, 4,utf8_decode("VENCIDA"), 0, 0, "R");
    }
############################### BLOQUE N° 1 FACTURA #############################    
    
############################### BLOQUE N° 2 HOTEL ##############################   
   //Bloque de datos de empresa
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 29, 190, 18, '1.5', '');
    //DATOS DE HOTEL LINEA 1
    $this->SetFont('courier','B',9);
    $this->SetXY(12, 30);
    $this->Cell(186, 4, 'DATOS DE HOTEL ', 0, 0);
    //DATOS DE HOTEL LINEA 1

    //DATOS DE HOTEL LINEA 2
    $this->SetFont('courier','B',8);
    $this->SetXY(12, 34);
    $this->Cell(24, 4, 'RAZÓN SOCIAL:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(36, 34);
    $this->CellFitSpace(66, 4,utf8_decode($con[0]['nomhotel']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(102, 34);
    $this->CellFitSpace(22, 4, 'Nº DE '.$documento = ($con[0]['documenhotel'] == '0' ? "REG.:" : $con[0]['documento'].":"), 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(124, 34);
    $this->CellFitSpace(28, 4,utf8_decode($con[0]['nrohotel']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(152, 34);
    $this->Cell(18, 4, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(170, 34);
    $this->Cell(28, 4,utf8_decode($con[0]['tlfhotel']), 0, 0);
    //DATOS DE HOTEL LINEA 2

    //DATOS DE HOTEL LINEA 3
    $this->SetFont('courier','B',8);
    $this->SetXY(12, 38);
    $this->Cell(24, 4, 'DIRECCIÓN:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(36, 38);
    $this->CellFitSpace(96, 4,utf8_decode($con[0]['direchotel']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(132, 38);
    $this->Cell(12, 4, 'EMAIL:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(144, 38);
    $this->Cell(54, 4,utf8_decode($con[0]['emailhotel']), 0, 0);
    //DATOS DE HOTEL LINEA 3

    //DATOS DE HOTEL LINEA 4
    $this->SetFont('courier','B',8);
    $this->SetXY(12, 42);
    $this->Cell(24, 4, 'RESPONSABLE:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(36, 42);
    $this->CellFitSpace(66, 4,utf8_decode($con[0]['nomgerente']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(102, 42);
    $this->CellFitSpace(22, 4, 'Nº DE '.$documento = ($con[0]['documgerente'] == '0' ? "DOC.:" : $con[0]['documento2'].":"), 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(124, 42);
    $this->CellFitSpace(28, 4,utf8_decode($con[0]['cedgerente']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(152, 42);
    $this->Cell(18, 4, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(170, 42);
    $this->Cell(28, 4,utf8_decode($tlf = ($con[0]['tlfgerente'] == '' ? "*********" : $con[0]['tlfgerente'])), 0, 0);
    //DATOS DE HOTEL LINEA 4
############################### BLOQUE N° 2 HOTEL ##############################   

############################### BLOQUE N° 3 CLIENTE ################################  
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 49, 190, 14, '1.5', '');

    $this->SetFont('courier','B',9);
    $this->SetXY(12, 50);
    $this->Cell(186, 4, 'DATOS DE CLIENTE ', 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(12, 54);
    $this->Cell(20, 4, 'NOMBRES:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(32, 54);
    $this->CellFitSpace(58, 4,utf8_decode($nombre = ($reg[0]['nomcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente'])), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(90, 54);
    $this->CellFitSpace(20, 4, 'Nº DE '.$documento = ($reg[0]['documcliente'] == '0' ? "DOC.:" : $reg[0]['documento'].":"), 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(110, 54);
    $this->CellFitSpace(24, 4,utf8_decode($nombre = ($reg[0]['dnicliente'] == '' ? "*********" : $reg[0]['dnicliente'])), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(134, 54);
    $this->Cell(12, 4, 'EMAIL:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(146, 54);
    $this->CellFitSpace(52, 4,utf8_decode($email = ($reg[0]['correocliente'] == '' ? "*********" : $reg[0]['correocliente'])), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(12, 58);
    $this->Cell(20, 4, 'DIRECCIÓN:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(32, 58);
    $this->CellFitSpace(124, 4,getSubString(utf8_decode($reg[0]['paiscliente']." - ".$reg[0]["ciudadcliente"]." ".$reg[0]['direccliente']), 70), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(156, 58);
    $this->Cell(20, 4, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(176, 58);
    $this->CellFitSpace(22, 4,utf8_decode($tlf = ($reg[0]['telefcliente'] == '' ? "*********" : $reg[0]['telefcliente'])), 0, 0); 
################################ BLOQUE N° 3 CLIENTE #################################  

################################ BLOQUE N° 4 #######################################   
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 68, 190, 180, '0', '');

    $this->SetFont('courier','B',9);
    $this->SetXY(10, 65);
    $this->SetTextColor(3,3,3);
    $this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
    $this->CellFitSpace(8, 8,"Nº", 1, 0, 'C', True);
    $this->CellFitSpace(20, 8,"Nº HABIT.", 1, 0, 'C', True);
    $this->CellFitSpace(20, 8,"Nº ADULTOS", 1, 0, 'C', True);
    $this->CellFitSpace(20, 8,"Nº NIÑOS", 1, 0, 'C', True);
    $this->CellFitSpace(25, 8,"DESDE", 1, 0, 'C', True);
    $this->CellFitSpace(25, 8,"HASTA", 1, 0, 'C', True);
    $this->CellFitSpace(30, 8,"V/TOTAL", 1, 0, 'C', True);
    $this->CellFitSpace(12, 8,"DESC %", 1, 0, 'C', True);
    $this->CellFitSpace(30, 8,"V/NETO", 1, 1, 'C', True);
################################# BLOQUE N° 4 #######################################  

################################# BLOQUE N° 5 ####################################### 
    $tra = new Login();
    $detalle = $tra->VerDetallesReservaciones();
    $SubTotal = 0;

    $this->SetWidths(array(8,20,20,20,25,25,30,12,30));

    $a=1;
    for($i=0;$i<sizeof($detalle);$i++){
    $SubTotal += $detalle[$i]['valorneto'];

    $this->SetX(10);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->RowFacture(array($a++,
        portales(utf8_decode($detalle[$i]["numhabitacion"])),
        utf8_decode($detalle[$i]["adultos"]),
        utf8_decode($detalle[$i]["children"]),
        utf8_decode(date("d-m-Y",strtotime($detalle[$i]['desde']))),
        utf8_decode(date("d-m-Y",strtotime($detalle[$i]['hasta']))),
        utf8_decode($simbolo.number_format($detalle[$i]["valortotal"], 2, '.', ',')),
        utf8_decode(number_format($detalle[$i]['deschabitacion'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','))));
       }
################################# BLOQUE N° 5 #######################################  

if($reg[0]['observaciones']!="0"){
########################### BLOQUE N° 6 #############################    
    $this->SetFont('courier','B',7);
    $this->SetXY(10, 240);
    $this->MultiCell(190,3,"OBSERVACIONES: ".utf8_decode($reg[0]['observaciones']),0,1,'');
    $this->Ln(4);
########################### BLOQUE N° 6 #############################    
}

########################### BLOQUE N° 7 #############################    
   $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 250, 108, 26, '1.5', '');

    $this->SetFont('courier','B',8);
    $this->SetXY(12, 250);
    $this->Cell(105, 4, 'INFORMACIÓN ADICIONAL', 0, 0, 'C');
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 254);
    $this->Cell(32, 3, 'NOMBRE DE CAJERO:', 0, 0);
    $this->SetXY(44, 254);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(73, 3,utf8_decode($reg[0]['codcaja'] == 0 ? "*********" : $reg[0]['nombres']), 0, 0);
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 257);
    $this->Cell(32, 3, 'TIPO DE PAGO:', 0, 0);
    $this->SetXY(44, 257);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(24, 3,utf8_decode($reg[0]['tipopago'] == "TARJETA" ? "TARJETA DE CREDITO" : $reg[0]['tipopago']), 0, 0);

    $this->SetFont('courier','B',7.5);
    $this->SetXY(68, 257);
    $this->Cell(22, 3, 'RESERVACIÓN:', 0, 0);
    $this->SetXY(90, 257);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(26, 3,utf8_decode($reg[0]['reservacion']), 0, 0);

    if($reg[0]['formapago']=="EFECTIVO"){

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 260);
    $this->Cell(32, 3, 'MONTO PAGADO:', 0, 0);
    $this->SetXY(44, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(26, 3,utf8_decode($simbolo.number_format($reg[0]["montopagado"], 2, '.', ',')), 0, 0);

        if($reg[0]["montodevuelto"]=="0.00"){

        $this->SetFont('courier','B',7.5);
        $this->SetXY(12, 263);
        $this->Cell(32, 3, 'DEBE ABONAR:', 0, 0);
        $this->SetXY(44, 263);
        $this->SetFont('courier','',7.5);
        $this->CellFitSpace(38, 3,utf8_decode($simbolo.number_format($reg[0]["totalpago"]-$reg[0]["montopagado"], 2, '.', ',')), 0, 0);
        $this->SetFont('courier','B',7.5);
        $this->SetXY(12, 267);
        $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');

        } else {

        $this->SetFont('courier','B',7.5);
        $this->SetXY(12, 263);
        $this->Cell(32, 3, 'MONTO DEVUELTO:', 0, 0);
        $this->SetXY(44, 263);
        $this->SetFont('courier','',7.5);
        $this->CellFitSpace(38, 3,utf8_decode($simbolo.number_format($reg[0]["montodevuelto"], 2, '.', ',')), 0, 0);
        
        $this->SetFont('courier','B',7.5);
        $this->SetXY(12, 267);
        $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');
        }
    
    } else if($reg[0]['formapago']=="CREDITO"){

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 260);
    $this->Cell(32, 3, 'FECHA VENCIMIENTO:', 0, 0);
    $this->SetXY(44, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(26, 3,utf8_decode($vence = ( $reg[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($reg[0]['fechavencecredito'])))), 0, 0);

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 263);
    $this->Cell(32, 3, 'DIAS VENCIDOS:', 0, 0);
    $this->SetXY(44, 263);
    
    if($reg[0]['fechavencecredito']== '0000-00-00') { 
    $this->CellFitSpace(38, 3,utf8_decode("0"), 0, 0);
    } elseif($reg[0]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->CellFitSpace(38, 3,utf8_decode("0"), 0, 0);
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) { 
    $this->CellFitSpace(38, 3,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito'])), 0, 0);
    }
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 267);
    $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');

    } else if($reg[0]['formapago']=="TARJETA"){

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 260);
    $this->Cell(32, 3, 'TIPO DE TARJETA:', 0, 0);
    $this->SetXY(44, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(24, 3,utf8_decode($reg[0]["tipotarjeta"]), 0, 0);

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 263);
    $this->Cell(32, 3, 'Nº DE TARJETA:', 0, 0);
    $this->SetXY(44, 263);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(38, 3,utf8_decode($reg[0]["nrotarjeta"]), 0, 0);

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 267);
    $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');

    } else if($reg[0]['formapago']=="CHEQUE"){

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 260);
    $this->Cell(32, 3, 'Nº DE CHEQUE', 0, 0);
    $this->SetXY(44, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(24, 3,utf8_decode($reg[0]["cheque"]), 0, 0);

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 263);
    $this->CellFitSpace(32, 3, 'NOMBRE DE BANCO:', 0, 0);
    $this->SetXY(44, 263);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(38, 3,utf8_decode($reg[0]["bancocheque"]), 0, 0); 
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 267);
    $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');
    
   } else {

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 260);
    $this->Cell(32, 3, 'Nº DE COMPROBANTE:', 0, 0);
    $this->SetXY(44, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(24, 3,utf8_decode($reg[0]["nrotransferencia"]), 0, 0);
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 264);
    $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');
}
########################### BLOQUE N° 7 #############################    

################################# BLOQUE N° 8 #######################################  
    //Bloque de Totales de factura
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(120, 250, 80, 26, '1.5', '');

    //Linea de membrete Nro 1
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 252);
    $this->CellFitSpace(36, 5, 'SUBTOTAL:', 0, 0);
    $this->SetXY(158, 252);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($SubTotal, 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 2
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 257);
    $this->CellFitSpace(36, 5,$impuesto == '' ? "TOTAL IMP." : "TOTAL ".$impuesto." (".$reg[0]["iva"]."%):", 0, 0);
    $this->SetXY(158, 257);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["totaliva"], 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 3
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 262);
    $this->CellFitSpace(36, 5, "DESC. GLOBAL (".$reg[0]["descuento"].'%):', 0, 0);
    $this->SetXY(158, 262);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["totaldescuento"], 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 4
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 267);
    $this->CellFitSpace(36, 5,'IMPORTE TOTAL:', 0, 0);
    $this->SetXY(158, 267);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["totalpago"], 2, '.', ',')), 0, 0, "R");

################################# BLOQUE N° 8 #######################################
}
########################## FUNCION FACTURA RESERVACIONES ##############################

########################## FUNCION LISTAR RESERVACIONES ##############################
function TablaListarReservaciones()
{
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarReservaciones();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE RESERVACIONES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(65,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'HABITACIONES',1,0,'C', True);
    $this->Cell(25,8,'ENTRADA',1,0,'C', True);
    $this->Cell(25,8,'SALIDA',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(22,8,'STATUS',1,0,'C', True);
    $this->Cell(28,8,'TIPO DE PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,40,65,30,25,25,35,22,28,45));

    $a=1;
    $Subtotal=0;
    $Descuento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $Subtotal+=$reg[$i]['subtotal'];
    $Descuento+=$reg[$i]['descuento'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["habitaciones"]),utf8_decode(date("d-m-Y",strtotime($reg[$i]['desde']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['hasta']))),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),$reg[$i]['tipopago'] == 'TARJETA' ? "TARJ. DE CRÉDITO" : $reg[$i]['tipopago'],utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
   
    $this->Cell(200,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR RESERVACIONES ##############################

########################## FUNCION LISTAR RESERVACIONES DIARIAS ##############################
function TablaListarReservacionesDiarias()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarReservacionesDiarias();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE RESERVACIONES DIARIAS DEL (DIA '.date("d-m-Y").")",0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(65,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'HABITACIONES',1,0,'C', True);
    $this->Cell(25,8,'ENTRADA',1,0,'C', True);
    $this->Cell(25,8,'SALIDA',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(22,8,'STATUS',1,0,'C', True);
    $this->Cell(28,8,'TIPO DE PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,40,65,30,25,25,35,22,28,45));

    $a=1;
    $Subtotal=0;
    $Descuento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $Subtotal+=$reg[$i]['subtotal'];
    $Descuento+=$reg[$i]['descuento'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["habitaciones"]),utf8_decode(date("d-m-Y",strtotime($reg[$i]['desde']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['hasta']))),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),$reg[$i]['tipopago'] == 'TARJETA' ? "TARJ. DE CRÉDITO" : $reg[$i]['tipopago'],utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
   
    $this->Cell(200,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR RESERVACIONES DIARIAS ##############################

########################## FUNCION LISTAR RESERVACIONES POR TARJETAS ##############################
function TablaListarReservacionesxTarjetas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarReservacionesxTarjetas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE RESERVACIONES CON TARJETAS DE CRÉDITO',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(70,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'HABITACIONES',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(30,8,'TARJETA',1,0,'C', True);
    $this->Cell(40,8,'Nº DE TARJETA',1,0,'C', True);
    $this->Cell(15,8,'EXPIRA',1,0,'C', True);
    $this->Cell(15,8,'CV',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,40,70,30,35,30,40,15,15,45));

    $a=1;
    $Subtotal=0;
    $Descuento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $Subtotal+=$reg[$i]['subtotal'];
    $Descuento+=$reg[$i]['descuento'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["habitaciones"]),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]['tipotarjeta']),utf8_decode($reg[$i]['nrotarjeta']),utf8_decode($reg[$i]["expira"]),utf8_decode($reg[$i]['codverifica']),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
   
    $this->Cell(155,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR RESERVACIONES POR TARJETAS ##############################

########################## FUNCION LISTAR RESERVACIONES POR CAJAS ##############################
function TablaListarReservacionesxCajas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarReservacionesxCajas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE RESERVACIONES EN (CAJA Nº: '.utf8_decode($reg[0]["nrocaja"].": ".$reg[0]["nomcaja"]).")",0,1,'C');
    $this->Cell(330,7,"Y FECHAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C'); 

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(65,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'HABITACIONES',1,0,'C', True);
    $this->Cell(25,8,'ENTRADA',1,0,'C', True);
    $this->Cell(25,8,'SALIDA',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(22,8,'STATUS',1,0,'C', True);
    $this->Cell(28,8,'TIPO DE PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,40,65,30,25,25,35,22,28,45));

    $a=1;
    $Subtotal=0;
    $Descuento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $Subtotal+=$reg[$i]['subtotal'];
    $Descuento+=$reg[$i]['descuento'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["habitaciones"]),utf8_decode(date("d-m-Y",strtotime($reg[$i]['desde']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['hasta']))),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),$reg[$i]['tipopago'] == 'TARJETA' ? "TARJ. DE CRÉDITO" : $reg[$i]['tipopago'],utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
   
    $this->Cell(200,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR RESERVACIONES POR CAJAS ##############################

########################## FUNCION LISTAR RESERVACIONES POR FECHAS ##############################
function TablaListarReservacionesxFechas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarReservacionesxFechas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE RESERVACIONES POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(65,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'HABITACIONES',1,0,'C', True);
    $this->Cell(25,8,'ENTRADA',1,0,'C', True);
    $this->Cell(25,8,'SALIDA',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(22,8,'STATUS',1,0,'C', True);
    $this->Cell(28,8,'TIPO DE PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,40,65,30,25,25,35,22,28,45));

    $a=1;
    $Subtotal=0;
    $Descuento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $Subtotal+=$reg[$i]['subtotal'];
    $Descuento+=$reg[$i]['descuento'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["habitaciones"]),utf8_decode(date("d-m-Y",strtotime($reg[$i]['desde']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['hasta']))),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),$reg[$i]['tipopago'] == 'TARJETA' ? "TARJ. DE CRÉDITO" : $reg[$i]['tipopago'],utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
   
    $this->Cell(200,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR RESERVACIONES POR FECHAS ##############################

########################## FUNCION LISTAR RESERVACIONES POR CLIENTES ########################
function TablaListarReservacionesxClientes()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarReservacionesxClientes();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+70, $this->GetY()+1, 28),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 28),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE RESERVACIONES DEL CLIENTE ('.utf8_decode($reg[0]['dnicliente'].": ".$reg[0]['nomcliente']).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(30,8,'HABITACIONES',1,0,'C', True);
    $this->Cell(25,8,'ENTRADA',1,0,'C', True);
    $this->Cell(25,8,'SALIDA',1,0,'C', True);
    $this->Cell(38,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(22,8,'STATUS',1,0,'C', True);
    $this->Cell(25,8,'RESERVACIÓN',1,0,'C', True);
    $this->Cell(40,8,'TIPO DE PAGO',1,0,'C', True);
    $this->Cell(25,8,'FECHA VENCE',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,40,30,25,25,38,22,25,40,25,45));

    $a=1;
    $Subtotal=0;
    $Descuento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $Subtotal+=$reg[$i]['subtotal'];
    $Descuento+=$reg[$i]['descuento'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]["habitaciones"]),utf8_decode(date("d-m-Y",strtotime($reg[$i]['desde']))),utf8_decode(date("d-m-Y",strtotime($reg[$i]['hasta']))),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),utf8_decode($reg[$i]["reservacion"]),$reg[$i]['tipopago'] == 'TARJETA' ? "TARJ. DE CRÉDITO" : $reg[$i]['tipopago'],utf8_decode($reg[$i]['fechavencecredito'] == '0000-00-00' ? "**********" :  date("d-m-Y",strtotime($reg[$i]['fechavencecredito']))),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
   
    $this->Cell(135,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(38,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }
    

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR RESERVACIONES POR CLIENTES ########################

################################### REPORTES DE RESERVACIONES ##################################





























################################### REPORTES DE VENTAS ##################################

########################## FUNCION TICKET VENTA ##############################
function TicketVenta()
{  
   
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == "" ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);

    $tra = new Login();
    $reg = $tra->VentasPorId();

    if (file_exists("fotos/logo-admin.png")) {

    $logo = "./fotos/logo-admin.png";
    $this->Image($logo , 20, 3, 35, 15, "PNG");
    $this->Ln(8);

    }
  
    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5, "TICKET DE VENTA", 0, 0, 'C');
    $this->Ln(5);
  
    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['nomhotel'])), 0, 1, 'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$con[0]['documenhotel'] == '0' ? "" : "Nº ".$con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,portales(utf8_decode($con[0]['direchotel'])),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"OBLIGADO A LLEVAR CONTABILIDAD: ".utf8_decode($con[0]['llevacontabilidad']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"AMBIENTE: PRODUCCIÓN",0,1,'C');
    
    $this->SetX(2);
    $this->CellFitSpace(70,3,"EMISIÓN: NORMAL",0,1,'C');


    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);
    
    if($reg[0]['codcliente'] == '0'){

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(70,4,utf8_decode("A CONSUMIDOR FINAL"), 0, 1, 'J');   

    } else {

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$documento = ($reg[0]['documcliente'] == '0' ? "Nº DOC:" : "Nº ".$reg[0]['documento'].": ".$reg[0]['dnicliente']),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode($reg[0]['nomcliente'])),0,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode(getSubString($reg[0]['direccliente'],55))),0,'L');

    }

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(2);

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"Nro Ticket:  ", 0, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(35,4,utf8_decode($reg[0]['codventa']), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(18,4,"CAJERO:", 0, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(52,4,portales(utf8_decode($reg[0]['nombres'])), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"FECHA: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['fechaventa']))), 0, 0, 'J');
    $this->CellFitSpace(35,4,"HORA: ".utf8_decode(date("H:i:s",strtotime($reg[0]['fechaventa']))), 0, 0, 'R');
    $this->Ln();

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5,"DETALLES DE PRODUCTOS", 0, 0, 'L');
    $this->Ln(5);

    $tra = new Login();
    $detalle = $tra->VerDetallesVentas();
    $cantidad = 0;
    $SubTotal = 0;
    $Articulos = 0;
    $a=1;
    for($i=0;$i<sizeof($detalle);$i++):
    $SubTotal += $detalle[$i]['valortotal'];
    $Articulos += $detalle[$i]['cantventa'];

    $this->SetX(2);
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,3,utf8_decode($detalle[$i]['cantventa'])." X ".$simbolo.number_format($detalle[$i]["precioventa"], 2, '.', ','),0,0,'J');

    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,3,$simbolo.number_format($detalle[$i]["valortotal"], 2, '.', ','),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(70,3,portales(utf8_decode(getSubString($detalle[$i]["producto"], 55))),0,1,'J');

    endfor;

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(22,4,"TIPO PAGO",0,0,'L');
    $this->Cell(48,4,utf8_decode($reg[0]['tipopago']),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(22,4,"SUBTOTAL",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]["subtotalivasi"]+$reg[0]["subtotalivano"], 2, '.', ','),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(22,4,"DESC (".number_format($reg[0]["descuento"], 2, '.', ',')."%)",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]['totaldescuento'], 2, '.', ','),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(22,4,"TOTAL",0,0,'L');
    $this->Cell(48,4,$simbolo.number_format($reg[0]['totalpago'], 2, '.', ','),0,1,'R');

    ############# MUESTRO FORMA DE PAGO #############
    if($reg[0]['tipopago'] == "CONTADO"){

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(20,4,"PAGO",0,0,'L');
    $this->Cell(50,4,portales(utf8_decode($reg[0]['mediopago'])),0,1,'R');

        if($reg[0]['codcaja'] == 1){
        $this->SetX(2);
        $this->SetFont('Courier','',9);
        $this->CellFitSpace(30,4,"SUMA DE SUS PAGOS",0,0,'L');
        $this->Cell(40,4,$simbolo.number_format($reg[0]['montopagado'], 2, '.', ','),0,1,'R');

        $this->SetX(2);
        $this->SetFont('Courier','',9);
        $this->CellFitSpace(30,4,"SU VUELTO",0,0,'L');
        $this->Cell(40,4,$simbolo.number_format($reg[0]['montodevuelto'], 2, '.', ','),0,1,'R');
        }
    }
    ############# MUESTRO FORMA DE PAGO #############

    ############# MUESTRO ABONOS Y PENDIENTE #############
    if($reg[0]['tipopago']=="CREDITO"){

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"ABONADO",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"PENDIENTE",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['totalpago']-$reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"VENCIMIENTO",0,0,'L');
    $this->Cell(40,4,utf8_decode(date("d-m-Y",strtotime($reg[0]["fechavencecredito"]))),0,1,'R');
    }
    ############# MUESTRO ABONOS Y PENDIENTE #############

    if($reg[0]['observaciones']!=""){
    ########################### OBSERVACIONES #############################
    $this->Ln(2);  
    $this->SetX(2);
    $this->SetFont('courier','B',8);
    $this->MultiCell(70,4,utf8_decode($reg[0]['observaciones']),0,1,'');
    $this->Ln(2);
    ########################### OBSERVACIONES #############################    
    }

    $this->Ln(2);
    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(30,4,"CANTIDAD TOTAL:",0,0,'L');
    $this->CellFitSpace(40,4,utf8_decode(number_format($Articulos, 2, '.', ',')),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['emailhotel'])),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(10,4,"TEL:",0,0,'L');
    $this->CellFitSpace(60,4,utf8_decode($con[0]['tlfhotel']),0,1,'L');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','BI',10);
    $this->SetFillColor(3, 3, 3);
    $this->CellFitSpace(70,3,"GRACIAS POR SU COMPRA",0,1,'C');
    $this->Ln(3);
}
########################## FUNCION TICKET VENTA ##############################

########################## FUNCION FACTURA VENTA (MITAD) #############################
function FacturaVenta()
{
    $logo = ( file_exists("./fotos/logo-admin.png") == "" ? "./assets/images/null.png" : "./fotos/logo-admin.png");

    $this->Image($logo, 10, 4.5, 24, 10, "PNG");

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == "" ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);

    $tra = new Login();
    $reg = $tra->VentasPorId();
        
    //Bloque datos de empresa
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(5, 15, 42, 25, '1.5', "");
    
    $this->SetFont('Courier','BI',8);
    $this->SetTextColor(3,3,3); // Establece el color del texto (en este caso es Negro)
    $this->SetXY(5, 15);
    $this->CellFitSpace(42, 5,utf8_decode($con[0]['nomhotel']), 0, 1); //Membrete Nro 1

    $this->SetX(5);
    $this->MultiCell(42,3,$this->SetFont('Courier','B',6).utf8_decode($con[0]['direchotel']),0,'L');

    /*$this->SetX(5);
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(42, 3,$con[0]['direchotel'], 0,1);*/

    $this->SetX(5);
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(42, 3,'Nº DE ACTIVIDAD: '.$con[0]['nroactividad'], 0,1);

    $this->SetX(5);
    $this->CellFitSpace(42, 3,'Nº TLF: '.utf8_decode($con[0]['tlfhotel']), 0,1);

    $this->SetX(5);
    $this->CellFitSpace(42, 3,utf8_decode($con[0]['emailhotel']), 0,1);

    $this->SetX(5);
    $this->CellFitSpace(42, 3,'OBLIGADO A LLEVAR CONTABILIDAD: '.utf8_decode($con[0]['llevacontabilidad']), 0 , 0); 
      
    //Bloque datos de factura
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(48, 5, 57, 35, '1.5', "");

    $this->SetFont('Courier','B',10);
    $this->SetXY(48, 4);
    $this->Cell(5, 7, 'FACTURA DE VENTA', 0 , 0);


    $this->SetFont('Courier','B',7);
    $this->SetXY(48, 7);
    $this->Cell(5, 7, 'Nº DE '.$documento = ($con[0]['documenhotel'] == '0' ? "REG.:" : $con[0]['documento'].":"), 0 , 0);
    $this->SetXY(78, 7);
    $this->CellFitSpace(28, 7,utf8_decode($con[0]['nrohotel']), 0, 0);

    $this->SetXY(48, 10);
    $this->SetFont('Courier','B',8);
    $this->Cell(5, 7, 'Nº DE FACTURA', 0 , 0);
    $this->SetXY(78, 10);
    $this->CellFitSpace(28, 7,utf8_decode($reg[0]['codventa']), 0, 0);

    $this->SetXY(48, 13);
    $this->SetFont('Courier','B',6);
    $this->Cell(5, 7,'NÚMERO DE AUTORIZACIÓN:', 0, 0);
    $this->SetXY(48, 16);
    $this->CellFitSpace(56, 7,utf8_decode($reg[0]['codautorizacion']), 0, 0);

    $this->SetXY(48, 19);
    $this->SetFont('Courier','B',6);
    $this->Cell(5, 7,'NÚMERO DE SERIE:', 0, 0);
    $this->SetXY(48, 22);
    $this->CellFitSpace(56, 7,utf8_decode($reg[0]['codserie']), 0, 0);

    $this->SetXY(48, 25);
    $this->SetFont('Courier','B',6);
    $this->Cell(5, 7,"FECHA DE AUTORIZACIÓN:", 0, 0);
    $this->SetXY(78, 25);
    $this->Cell(28, 7,$fecha = ($con[0]['fechaautorizacion'] == '0000-00-00' ? "" : date("d-m-Y",strtotime($con[0]['fechaautorizacion']))), 0, 0);

    $this->SetXY(48, 28);
    $this->SetFont('Courier','B',6);
    $this->Cell(5, 7,"FECHA DE VENTA:", 0, 0);
    $this->SetXY(78, 28);
    $this->Cell(28, 7,date("d-m-Y H:i:s",strtotime($reg[0]['fechaventa'])), 0, 0);


    $this->SetXY(48, 31);
    $this->SetFont('Courier','B',6);
    $this->Cell(5, 7,'AMBIENTE: ', 0 , 0);
    $this->SetXY(78, 31);
    $this->Cell(28, 7,'PRODUCCIÓN', 0 , 0);

    $this->SetXY(48, 34);
    $this->SetFont('Courier','B',6);
    $this->Cell(5, 7,'EMISIÓN: ', 0 , 0);
    $this->SetXY(78, 34);
    $this->Cell(28, 7,'NORMAL', 0 , 0);
     
    //Bloque datos de cliente
    $this->SetLineWidth(0.3);
    $this->SetFillColor(192);
    $this->RoundedRect(5, 41, 100, 10, '1.5', "");
    $this->SetFont('Courier','B',6);

    $this->SetXY(6, 40.2);
    $this->CellFitSpace(66, 5,'RAZÓN SOCIAL: '.utf8_decode($reg[0]['codcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente']), 0, 0);
    $this->CellFitSpace(32, 5,'Nº DE '.$documento = ($reg[0]['documcliente'] == '' ? "DOC: " : $reg[0]['documento'].": ").$dni = ($reg[0]['dnicliente'] == '' ? "**********" : $reg[0]['dnicliente']), 0, 0);

    $this->SetXY(6, 43.2);
    $this->CellFitSpace(66, 5,'DIRECCIÓN: '.utf8_decode($reg[0]['direccliente'] == '' ? "**********" : $reg[0]['direccliente']), 0, 0);
    $this->CellFitSpace(32, 5,'Nº DE TLF: '.($reg[0]['telefcliente'] == '' ? "**********" : $reg[0]['telefcliente']), 0, 0);

    $this->SetXY(6, 46.2);
    $this->CellFitSpace(92, 5,'EMAIL: '.utf8_decode($reg[0]['correocliente'] == '' ? "**********" : $reg[0]['correocliente']), 0, 0);

    $this->Ln(6);
    $this->SetX(5);
    $this->SetFont('Courier','B',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(5,3,'N°',1,0,'C', True);
    $this->Cell(50,3,'DESCRIPCIÓN',1,0,'C', True);
    $this->Cell(12,3,'CANTIDAD',1,0,'C', True);
    $this->Cell(14,3,'PRECIO',1,0,'C', True);
    $this->Cell(19,3,'IMPORTE',1,1,'C', True);
    
    $tra = new Login();
    $detalle = $tra->VerDetallesVentas();
    $cantidad = 0;
    $SubTotal = 0;

    $this->SetWidths(array(5,50,12,14,19));

    $a=1;
    for($i=0;$i<sizeof($detalle);$i++){ 
    $cantidad += $detalle[$i]['cantventa'];
    $valortotal = $detalle[$i]["precioventa"]*$detalle[$i]["cantventa"];
    $SubTotal += $detalle[$i]['valorneto'];

    $this->SetX(5);
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier',"",6);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->RowFacture(array($a++,portales(utf8_decode($detalle[$i]["producto"])),utf8_decode($detalle[$i]['cantventa']),utf8_decode(number_format($detalle[$i]["precioventa"], 2, '.', ',')),utf8_decode(number_format($detalle[$i]['valorneto'], 2, '.', ','))));
       
    }
     
    $this->Ln(1);
    $this->SetX(5);
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(59,3.5,'INFORMACIÓN ADICIONAL',1,0,'C');
    $this->Cell(2,3.5,"",0,0,'C');
    $this->SetFont('Courier','B',6);
    $this->CellFitSpace(20,3.5,'SUBTOTAL ',1,0,'L', True);
    $this->CellFitSpace(19,3.5,$simbolo.number_format($reg[0]["subtotalivasi"]+$reg[0]["subtotalivano"], 2, '.', ','),1,0,'R');
    $this->Ln();

    $this->SetX(5);
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','B',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(59,3.5,'Nº DE CAJA: '.utf8_decode($reg[0]['nrocaja']."-".$reg[0]['nomcaja']),1,0,'L');
    $this->Cell(2,3.5,"",0,0,'C');
    $this->CellFitSpace(20,3.5,'GRAVADO ('.number_format($reg[0]["iva"], 2, '.', ',').'%):',1,0,'L', True);
    $this->CellFitSpace(19,3.5,$simbolo.number_format($reg[0]["subtotalivasi"], 2, '.', ','),1,0,'R');
    $this->Ln();

    $this->SetX(5);
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','B',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(59,3.5,'CAJERO(A): '.utf8_decode($reg[0]['nombres']),1,0,'L');
    $this->Cell(2,3.5,"",0,0,'C');
    $this->CellFitSpace(20,3.5,'EXENTO (0%):',1,0,'L', True);
    $this->CellFitSpace(19,3.5,$simbolo.number_format($reg[0]["subtotalivano"], 2, '.', ','),1,0,'R');
    $this->Ln();

    $this->SetX(5);
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','B',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(59,3.5,'FECHA DE EMISIÓN: '.date("d-m-Y H:i:s"),1,0,'L');

    $this->Cell(2,3.5,"",0,0,'C');
    $this->CellFitSpace(20,3.5,$impuesto == '' ? "IMPUESTO" : "".$impuesto." (".number_format($reg[0]["iva"], 2, '.', ',')."%):",1,0,'L', True);
    $this->CellFitSpace(19,3.5,$simbolo.number_format($reg[0]["totaliva"], 2, '.', ','),1,0,'R');
    $this->Ln();

    $this->SetX(5);
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','B',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(59,3.5,'CONDICIÓN DE PAGO: '.utf8_decode($reg[0]['tipopago']),1,0,'L');
    $this->Cell(2,3.5,"",0,0,'C');
    $this->CellFitSpace(20,3.5,'DESC % ('.number_format($reg[0]["descuento"], 2, '.', ',').'%):',1,0,'L', True);
    $this->CellFitSpace(19,3.5,$simbolo.number_format($reg[0]["totaldescuento"], 2, '.', ','),1,0,'R');
    $this->Ln();

    $this->SetX(5);
    $this->SetFillColor(245,245,245); // establece el color del fondo de la celda (en este caso es AZUL
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','B',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(59,3.5,'FORMA DE PAGO: '.utf8_decode($medio = ($reg[0]['tipopago'] == 'CONTADO' ? $reg[0]['mediopago'] : "VENCIMIENTO: ".date("d-m-Y",strtotime($reg[0]['fechavencecredito'])))),1,0,'L');
    $this->Cell(2,3.5,"",0,0,'C');
    $this->CellFitSpace(20,3.5,'IMPORTE TOTAL:',1,0,'L', True);
    $this->CellFitSpace(19,3.5,$simbolo.number_format($reg[0]["totalpago"], 2, '.', ','),1,0,'R');
    $this->Ln(4);
    
    $this->SetX(5);
    $this->SetDrawColor(3,3,3);
    $this->SetFont('Courier','BI',6);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(100,2,utf8_decode(numtoletras(number_format($reg[0]['totalpago'], 2, '.', ''))),0,0,'L');
    $this->Ln();
}  
########################## FUNCION FACTURA VENTA (MITAD) ##############################

########################## FUNCION FACTURA VENTA (A4) #############################
function FacturaVenta2()
    {     
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);
        
    $tra = new Login();
    $reg = $tra->VentasPorId();

    //Logo
    if (file_exists("fotos/logo-admin.png")) {
    $logo = "./fotos/logo-admin.png";
    $this->Image($logo , 15 ,11, 35 , 15 , "PNG");

    } else {

    $logo = "./assets/images/null.png";                         
    $this->Image($logo , 15 ,11, 55 , 15 , "PNG");  
    }                                      

    ############################ BLOQUE N° 1 FACTURA ###################################  
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 10, 190, 17, '1.5', '');
    
    $this->SetFillColor(229);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(98, 12, 12, 12, '1.5', 'F');

    $this->SetFillColor(229);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(98, 12, 12, 12, '1.5', '');

    $this->SetFont('courier','B',24);
    $this->SetXY(100.5, 15);
    $this->Cell(20, 5, 'V', 0 , 0);
    
    $this->SetFont('courier','B',11);
    $this->SetXY(124, 10);
    $this->Cell(34, 5, 'N° DE FACTURA ', 0, 0);
    $this->SetFont('courier','B',11);
    $this->SetXY(158, 10);
    $this->CellFitSpace(40, 5,utf8_decode($reg[0]['codventa']), 0, 0, "R");

    $this->SetFont('courier','B',9);
    $this->SetXY(124, 14);
    $this->Cell(34, 4, 'FECHA DE VENTA ', 0, 0);
    $this->SetFont('courier','',9);
    $this->SetXY(158, 14);
    $this->Cell(40, 4,utf8_decode(date("d-m-Y",strtotime($reg[0]['fechaventa']))), 0, 0, "R");

    $this->SetFont('courier','B',9);
    $this->SetXY(124, 18);
    $this->Cell(34, 4, 'FECHA DE EMISIÓN', 0, 0);
    $this->SetFont('courier','',9);
    $this->SetXY(158, 18);
    $this->Cell(40, 4,utf8_decode(date("d-m-Y h:i:s")), 0, 0, "R");
    
    $this->SetFont('courier','B',9);
    $this->SetXY(124, 22);
    $this->Cell(34, 4, 'ESTADO DE PAGO', 0, 0);
    $this->SetFont('courier','B',9);
    $this->SetXY(158, 22);
    
    if($reg[0]['fechavencecredito']== '0000-00-00') { 
    $this->Cell(40, 4,utf8_decode($reg[0]['statusventa']), 0, 0, "R");
    } elseif($reg[0]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->Cell(40, 4,utf8_decode($reg[0]['statusventa']), 0, 0, "R");
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) { 
    $this->Cell(40, 4,utf8_decode("VENCIDA"), 0, 0, "R");
    }
    ############################### BLOQUE N° 1 FACTURA #############################    
    
    ############################### BLOQUE N° 2 HOTEL ##############################   
   //Bloque de datos de empresa
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 29, 190, 18, '1.5', '');
    //DATOS DE HOTEL LINEA 1
    $this->SetFont('courier','B',9);
    $this->SetXY(12, 30);
    $this->Cell(186, 4, 'DATOS DE HOTEL ', 0, 0);
    //DATOS DE HOTEL LINEA 1

    //DATOS DE HOTEL LINEA 2
    $this->SetFont('courier','B',8);
    $this->SetXY(12, 34);
    $this->Cell(24, 4, 'RAZÓN SOCIAL:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(36, 34);
    $this->CellFitSpace(66, 4,utf8_decode($con[0]['nomhotel']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(102, 34);
    $this->CellFitSpace(22, 4, 'Nº DE '.$documento = ($con[0]['documenhotel'] == '0' ? "REG.:" : $con[0]['documento'].":"), 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(124, 34);
    $this->CellFitSpace(28, 4,utf8_decode($con[0]['nrohotel']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(152, 34);
    $this->Cell(18, 4, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(170, 34);
    $this->Cell(28, 4,utf8_decode($con[0]['tlfhotel']), 0, 0);
    //DATOS DE HOTEL LINEA 2

    //DATOS DE HOTEL LINEA 3
    $this->SetFont('courier','B',8);
    $this->SetXY(12, 38);
    $this->Cell(24, 4, 'DIRECCIÓN:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(36, 38);
    $this->CellFitSpace(96, 4,utf8_decode($con[0]['direchotel']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(132, 38);
    $this->Cell(12, 4, 'EMAIL:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(144, 38);
    $this->Cell(54, 4,utf8_decode($con[0]['emailhotel']), 0, 0);
    //DATOS DE HOTEL LINEA 3

    //DATOS DE HOTEL LINEA 4
    $this->SetFont('courier','B',8);
    $this->SetXY(12, 42);
    $this->Cell(24, 4, 'RESPONSABLE:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(36, 42);
    $this->CellFitSpace(66, 4,utf8_decode($con[0]['nomgerente']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(102, 42);
    $this->CellFitSpace(22, 4, 'Nº DE '.$documento = ($con[0]['documgerente'] == '0' ? "DOC.:" : $con[0]['documento2'].":"), 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(124, 42);
    $this->CellFitSpace(28, 4,utf8_decode($con[0]['cedgerente']), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(152, 42);
    $this->Cell(18, 4, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(170, 42);
    $this->Cell(28, 4,utf8_decode($tlf = ($con[0]['tlfgerente'] == '' ? "*********" : $con[0]['tlfgerente'])), 0, 0);
    //DATOS DE HOTEL LINEA 4
    ############################### BLOQUE N° 2 HOTEL ##############################   

   ############################### BLOQUE N° 3 CLIENTE ################################  
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 49, 190, 14, '1.5', '');

    $this->SetFont('courier','B',9);
    $this->SetXY(12, 50);
    $this->Cell(186, 4, 'DATOS DE CLIENTE ', 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(12, 54);
    $this->Cell(20, 4, 'NOMBRES:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(32, 54);
    $this->CellFitSpace(58, 4,utf8_decode($nombre = ($reg[0]['nomcliente'] == '' ? "CONSUMIDOR FINAL" : $reg[0]['nomcliente'])), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(90, 54);
    $this->CellFitSpace(20, 4, 'Nº DE '.$documento = ($reg[0]['documcliente'] == '0' ? "DOC.:" : $reg[0]['documento'].":"), 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(110, 54);
    $this->CellFitSpace(24, 4,utf8_decode($nombre = ($reg[0]['dnicliente'] == '' ? "*********" : $reg[0]['dnicliente'])), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(134, 54);
    $this->Cell(12, 4, 'EMAIL:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(146, 54);
    $this->CellFitSpace(52, 4,utf8_decode($email = ($reg[0]['correocliente'] == '' ? "*********" : $reg[0]['correocliente'])), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(12, 58);
    $this->Cell(20, 4, 'DIRECCIÓN:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(32, 58);
    $this->CellFitSpace(124, 4,getSubString(utf8_decode($reg[0]['paiscliente']." - ".$reg[0]["ciudadcliente"]." ".$reg[0]['direccliente']), 70), 0, 0);

    $this->SetFont('courier','B',8);
    $this->SetXY(156, 58);
    $this->Cell(20, 4, 'N° DE TLF:', 0, 0);
    $this->SetFont('courier','',8);
    $this->SetXY(176, 58);
    $this->CellFitSpace(22, 4,utf8_decode($tlf = ($reg[0]['telefcliente'] == '' ? "*********" : $reg[0]['telefcliente'])), 0, 0); 
    ################################ BLOQUE N° 3 CLIENTE #################################  

    ################################ BLOQUE N° 4 #######################################   
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 68, 190, 180, '0', '');

    $this->SetFont('courier','B',9);
    $this->SetXY(10, 65);
    $this->SetTextColor(3,3,3);
    $this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
    $this->Cell(8, 8,"Nº", 1, 0, 'C', True);
    $this->Cell(50, 8,"DESCRIPCIÓN DE PRODUCTO", 1, 0, 'C', True);
    $this->Cell(35, 8,"CATEGORIA", 1, 0, 'C', True);
    $this->Cell(10, 8,"CANT", 1, 0, 'C', True);
    $this->Cell(20, 8,"P/UNIT", 1, 0, 'C', True);
    $this->Cell(20, 8,"V/TOTAL", 1, 0, 'C', True);
    $this->Cell(15, 8,"DESC %", 1, 0, 'C', True);
    $this->Cell(12, 8,$impuesto == '' ? "Impuesto" : $impuesto, 1, 0, 'C', True);
    $this->Cell(20, 8,"V/NETO", 1, 1, 'C', True);
    ################################# BLOQUE N° 4 #######################################  

    ################################# BLOQUE N° 5 ####################################### 
    $tra = new Login();
    $detalle = $tra->VerDetallesVentas();
    $cantidad = 0;
    $SubTotal = 0;

     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(8,50,35,10,20,20,15,12,20));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($detalle);$i++){ 
    $cantidad += $detalle[$i]['cantventa'];
    $valortotal = $detalle[$i]["precioventa"]*$detalle[$i]["cantventa"];
    $SubTotal += $detalle[$i]['valorneto'];

    $this->SetX(10);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->RowFacture(array($a++,
        portales(utf8_decode($detalle[$i]["producto"])),
        utf8_decode($detalle[$i]["nomcategoria"]),
        utf8_decode($detalle[$i]["cantventa"]),
        utf8_decode($simbolo.number_format($detalle[$i]['precioventa'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($detalle[$i]['valortotal'], 2, '.', ',')),
        utf8_decode(number_format($detalle[$i]['descproducto'], 2, '.', ',')),
        utf8_decode($detalle[$i]["ivaproducto"] == 'SI' ? $reg[0]["iva"]."%" : "(E)"),
        utf8_decode($simbolo.number_format($detalle[$i]['valorneto'], 2, '.', ','))));
    }
    ################################# BLOQUE N° 5 #######################################  


    if($reg[0]['observaciones']!=""){
    ########################### BLOQUE N° 6 #############################    
    $this->SetFont('courier','B',7);
    $this->SetXY(10, 240);
    $this->MultiCell(190,3,"OBSERVACIONES: ".utf8_decode($reg[0]['observaciones'] == '' ? "" : $reg[0]['observaciones']),0,1,'');
    $this->Ln(4);
    ########################### BLOQUE N° 6 #############################    
    }

    ########################### BLOQUE N° 7 #############################    
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(10, 250, 108, 26, '1.5', '');

    $this->SetFont('courier','B',8);
    $this->SetXY(12, 250);
    $this->Cell(105, 4, 'INFORMACIÓN ADICIONAL', 0, 0, 'C');
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 254);
    $this->Cell(32, 3, 'CANTIDAD PRODUCTOS:', 0, 0);
    $this->SetXY(44, 254);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(15, 3,utf8_decode($cantidad), 0, 0);
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(59, 254);
    $this->Cell(28, 3, 'TIPO DOCUMENTO:', 0, 0);
    $this->SetXY(87, 254);
    $this->SetFont('courier','',7.5);
    $this->Cell(30, 3,"FACTURA", 0, 0);

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 257);
    $this->Cell(32, 3, 'NOMBRE DE CAJERO:', 0, 0);
    $this->SetXY(44, 257);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(73, 3,utf8_decode($reg[0]['nombres']), 0, 0);
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 260);
    $this->Cell(32, 3, 'TIPO DE PAGO:', 0, 0);
    $this->SetXY(44, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(18, 3,utf8_decode($reg[0]['tipopago']), 0, 0);
    
   if($reg[0]['tipopago']=="CREDITO"){

   //Linea de membrete Nro 5
    $this->SetFont('courier','B',7.5);
    $this->SetXY(62, 260);
    $this->Cell(16, 3, 'F. VENC:', 0, 0);
    $this->SetXY(78, 260);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(20, 3,utf8_decode($vence = ( $reg[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($reg[0]['fechavencecredito'])))), 0, 0);
    
    //Linea de membrete Nro 6
    $this->SetFont('courier','B',7.5);
    $this->SetXY(98, 260);
    $this->Cell(10, 3, 'DIAS:', 0, 0);
    $this->SetXY(108, 260);
    $this->SetFont('courier','',7.5);
    
    if($reg[0]['fechavencecredito']== '0000-00-00') { 
    $this->CellFitSpace(9, 3,utf8_decode("0"), 0, 0);
    } elseif($reg[0]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->CellFitSpace(9, 3,utf8_decode("0"), 0, 0);
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) { 
    $this->CellFitSpace(9, 3,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito'])), 0, 0);
    }
   }
    
    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 263);
    $this->Cell(32, 3, 'MEDIO DE PAGO:', 0, 0);
    $this->SetXY(44, 263);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(38, 3,utf8_decode($variable = ($reg[0]['tipopago'] == 'CONTADO' ? $reg[0]['mediopago']."(".$simbolo.$reg[0]["montopagado"].")" : $reg[0]['formapago'])), 0, 0);

    if($reg[0]["montodevuelto"]=="0.00"){

    $this->SetFont('courier','B',7.5);
    $this->SetXY(82, 263);
    $this->Cell(18, 3, 'D. ABONAR:', 0, 0);
    $this->SetXY(100, 263);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(17, 3,utf8_decode($simbolo.number_format($reg[0]["totalpago"]-$reg[0]["montopagado"], 2, '.', ',')), 0, 0);

    } else {

    $this->SetFont('courier','B',7.5);
    $this->SetXY(82, 263);
    $this->Cell(18, 3, 'CAMBIO:', 0, 0);
    $this->SetXY(100, 263);
    $this->SetFont('courier','',7.5);
    $this->CellFitSpace(17, 3,utf8_decode($simbolo.$reg[0]['montodevuelto']), 0, 0);
    }

    $this->SetFont('courier','B',7.5);
    $this->SetXY(12, 267);
    $this->MultiCell(105,3,$this->SetFont('Courier','',7).utf8_decode(numtoletras($reg[0]['totalpago'])),0,'L');
    ########################### BLOQUE N° 7 #############################    

    ################################# BLOQUE N° 8 #######################################  
    //Bloque de Totales de factura
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.1);
    $this->RoundedRect(120, 250, 80, 26, '1.5', '');

    //Linea de membrete Nro 1
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 250);
    $this->CellFitSpace(36, 5, 'SUBTOTAL:', 0, 0);
    $this->SetXY(158, 250);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($SubTotal, 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 2
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 254);
    $this->CellFitSpace(36, 5, 'TOTAL GRAVADO ('.$reg[0]["iva"].'%):', 0, 0);
    $this->SetXY(158, 254);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["subtotalivasi"], 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 3
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 258);
    $this->CellFitSpace(36, 5, 'TOTAL EXENTO (0%):', 0, 0);
    $this->SetXY(158, 258);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["subtotalivano"], 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 4
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 262);
    $this->CellFitSpace(36, 5,$impuesto == '' ? "TOTAL IMP." : "TOTAL ".$impuesto." (".$reg[0]["iva"]."%):", 0, 0);
    $this->SetXY(158, 262);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["totaliva"], 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 5
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 266);
    $this->CellFitSpace(36, 5, "DESC. GLOBAL (".$reg[0]["descuento"].'%):', 0, 0);
    $this->SetXY(158, 266);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["totaldescuento"], 2, '.', ',')), 0, 0, "R");

    //Linea de membrete Nro 6
    $this->SetFont('courier','B',9);
    $this->SetXY(122, 270);
    $this->CellFitSpace(36, 5, 'IMPORTE TOTAL:', 0, 0);
    $this->SetXY(158, 270);
    $this->SetFont('courier','',9);
    $this->CellFitSpace(42, 5,utf8_decode($simbolo.number_format($reg[0]["totalpago"], 2, '.', ',')), 0, 0, "R");
    ################################# BLOQUE N° 8 #######################################
}
########################## FUNCION FACTURA VENTA (A4) ##############################

########################## FUNCION LISTAR VENTAS ##############################
function TablaListarVentas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarVentas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE VENTAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(70,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(30,8,'TOTAL GRAVADO',1,0,'C', True);
    $this->Cell(30,8,'TOTAL EXENTO',1,0,'C', True);
    $this->Cell(30,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(25,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,70,30,30,30,30,25,20,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalGravado=0;
    $TotalExento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalGravado+=$reg[$i]['subtotalivasi'];
    $TotalExento+=$reg[$i]['subtotalivano'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),utf8_decode($reg[$i]["tipopago"]),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));
        }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(70,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(30,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalGravado, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalExento, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR VENTAS ##############################

########################## FUNCION LISTAR VENTAS DIARIAS ##############################
function TablaListarVentasDiarias()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarVentasDiarias();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE VENTAS DIARIAS DEL (DIA '.date("d-m-Y").")",0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(70,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(30,8,'TOTAL GRAVADO',1,0,'C', True);
    $this->Cell(30,8,'TOTAL EXENTO',1,0,'C', True);
    $this->Cell(30,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(25,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,70,30,30,30,30,25,20,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalGravado=0;
    $TotalExento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalGravado+=$reg[$i]['subtotalivasi'];
    $TotalExento+=$reg[$i]['subtotalivano'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),utf8_decode($reg[$i]["tipopago"]),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));
        }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(70,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(30,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalGravado, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalExento, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }


    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR VENTAS DIARIAS ##############################

########################## FUNCION LISTAR VENTAS POR CAJAS ##############################
function TablaListarVentasxCajas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarVentasxCajas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE VENTAS EN (CAJA Nº: '.utf8_decode($reg[0]["nrocaja"].": ".$reg[0]["nomcaja"]).")",0,1,'C');
    $this->Cell(330,7,"Y FECHAS (DESDE ".date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C'); 

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(70,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(30,8,'TOTAL GRAVADO',1,0,'C', True);
    $this->Cell(30,8,'TOTAL EXENTO',1,0,'C', True);
    $this->Cell(30,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(25,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,70,30,30,30,30,25,20,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalGravado=0;
    $TotalExento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalGravado+=$reg[$i]['subtotalivasi'];
    $TotalExento+=$reg[$i]['subtotalivano'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),utf8_decode($reg[$i]["tipopago"]),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));
        }
      }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(70,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(30,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalGravado, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalExento, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR VENTAS POR CAJAS ##############################

########################## FUNCION LISTAR VENTAS POR FECHAS ##############################
function TablaListarVentasxFechas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarVentasxFechas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE VENTAS POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(70,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(30,8,'Nº ARTICULOS',1,0,'C', True);
    $this->Cell(30,8,'TOTAL GRAVADO',1,0,'C', True);
    $this->Cell(30,8,'TOTAL EXENTO',1,0,'C', True);
    $this->Cell(30,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(25,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'PAGO',1,0,'C', True);
    $this->Cell(45,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,70,30,30,30,30,25,20,45));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalArticulos=0;
    $TotalGravado=0;
    $TotalExento=0;
    $TotalImporte=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalGravado+=$reg[$i]['subtotalivasi'];
    $TotalExento+=$reg[$i]['subtotalivano'];
    $TotalImporte+=$reg[$i]['totalpago'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($reg[$i]["articulos"]),utf8_decode($simbolo.number_format($reg[$i]['subtotalivasi'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['subtotalivano'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),utf8_decode($reg[$i]["tipopago"]),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));
        }
      }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(70,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(30,5,utf8_decode($TotalArticulos),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalGravado, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalExento, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR VENTAS POR FECHAS ##############################

########################## FUNCION LISTAR DETALLES VENTAS POR FECHAS ##############################
function TablaListarDetallesVentasxFechas()
   {

    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == '' ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == '' ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarDetallesVentasxFechas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+79, $this->GetY()+1, 24),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 24),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO  DETALLES VENTAS POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(25,8,'CÓDIGO',1,0,'C', True);
    $this->Cell(60,8,'DESCRIPCIÓN DE PRODUCTO',1,0,'C', True);
    $this->Cell(30,8,'CATEGORIA',1,0,'C', True);
    $this->Cell(30,8,'PRECIO COMPRA',1,0,'C', True);
    $this->Cell(30,8,"PRECIO VENTA",1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(20,8,'VENDIDO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL VENTA',1,0,'C', True);
    $this->Cell(35,8,'TOTAL COMPRA',1,0,'C', True);
    $this->Cell(25,8,'GANANCIAS',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
    $this->SetWidths(array(15,25,60,30,30,30,25,20,35,35,25));

    $PrecioCompra=0;
    $PrecioVenta=0;
    $ExisteTotal=0;
    $VendidosTotal=0;
    $CompraTotal=0;
    $VentaTotal=0;
    $TotalGanancia=0;
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $PrecioCompra+=$reg[$i]['preciocompra'];
    $PrecioVenta+=$reg[$i]['precioventa'];
    $ExisteTotal+=$reg[$i]['existencia'];
    $VendidosTotal+=$reg[$i]['cantidad']; 

    $Descuento = $reg[$i]['descproducto']/100;
    $PrecioDescuento = $reg[$i]['precioventa']*$Descuento;
    $PrecioFinal = $reg[$i]['precioventa']-$PrecioDescuento;

    $CompraTotal+=$reg[$i]['preciocompra']*$reg[$i]['cantidad'];
    $VentaTotal+=$PrecioFinal*$reg[$i]['cantidad'];

    $SumVenta = $PrecioFinal*$reg[$i]['cantidad']; 
    $SumCompra = $reg[$i]['preciocompra']*$reg[$i]['cantidad'];
    $TotalGanancia+=$SumVenta-$SumCompra;

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($reg[$i]["codproducto"]),
        portales(utf8_decode($reg[$i]["producto"])),
        utf8_decode($reg[$i]['codcategoria'] == '0' ? "*****" : $reg[$i]['nomcategoria']),
        utf8_decode($simbolo.number_format($reg[$i]["preciocompra"], 2, '.', ',')),
        utf8_decode($simbolo.number_format($reg[$i]["precioventa"], 2, '.', ',')),
        utf8_decode($reg[$i]['existencia']),
        utf8_decode($reg[$i]['cantidad']),
        utf8_decode($simbolo.number_format($PrecioFinal*$reg[$i]['cantidad'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($reg[$i]['preciocompra']*$reg[$i]['cantidad'], 2, '.', ',')),
        utf8_decode($simbolo.number_format($SumVenta-$SumCompra, 2, '.', ','))));
  }
   }
   
    $this->Cell(130,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($PrecioCompra, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($PrecioVenta, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(25,5,utf8_decode($ExisteTotal),0,0,'L');
    $this->CellFitSpace(20,5,utf8_decode($VendidosTotal),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($VentaTotal, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($CompraTotal, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(25,5,utf8_decode($simbolo.number_format($TotalGanancia, 2, '.', ',')),0,0,'L');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR DETALLES VENTAS POR FECHAS ##############################

################################### REPORTES DE VENTAS ##################################



































############################### REPORTES DE CREDITOS ##################################

########################## FUNCION TICKET CREDITO EN RESERVACIONES ##############################
function TicketCreditoReservacion()
{  
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == "" ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);

    $tra = new Login();
    $reg = $tra->CreditosPorId();

    if (file_exists("fotos/logo-admin.png")) {

    $logo = "./fotos/logo-admin.png";
    $this->Image($logo , 20, 3, 35, 15, "PNG");
    $this->Ln(8);

    }
  
    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5, "TICKET CRÉDITO", 0, 0, 'C');
    $this->Ln(5);
  
    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['nomhotel'])), 0, 1, 'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$con[0]['documenhotel'] == '0' ? "" : "Nº ".$con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,portales(utf8_decode($con[0]['direchotel'])),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"OBLIGADO A LLEVAR CONTABILIDAD: ".utf8_decode($con[0]['llevacontabilidad']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"AMBIENTE: PRODUCCIÓN",0,1,'C');
    
    $this->SetX(2);
    $this->CellFitSpace(70,3,"EMISIÓN: NORMAL",0,1,'C');


    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$documento = ($reg[0]['documcliente'] == '0' ? "Nº DOC:" : "Nº ".$reg[0]['documento'].": ".$reg[0]['dnicliente']),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode($reg[0]['nomcliente'])),0,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode(getSubString($reg[0]['direccliente'],55))),0,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(2);

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"Nro Ticket:  ", 0, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(35,4,utf8_decode($reg[0]['codreservacion']), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"FECHA: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['fecharegistro']))), 0, 0, 'J');
    $this->CellFitSpace(35,4,"HORA: ".utf8_decode(date("H:i:s",strtotime($reg[0]['fecharegistro']))), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(33,4,"VENCE: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['fechavencecredito']))), 0, 0, 'J');
    if($reg[0]['fechavencecredito'] == '0000-00-00' || $reg[0]['fechavencecredito'] >= date("Y-m-d")) {
    $this->CellFitSpace(37,4,"DIAS VENC: ".utf8_decode("0"), 0, 0, 'R');  
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) {
    $this->CellFitSpace(37,4,"DIAS VENC: ".utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito'])), 0, 0, 'R'); 
    }
    $this->Ln();

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5,"DETALLES DE ABONOS", 0, 0, 'L');
    $this->Ln(5);

    $tra = new Login();
    $detalle = $tra->VerDetallesAbonos();
    if($detalle==""){
        echo "";      
    } else {
    $cantidad = 0;
    $SubTotal = 0;
    $a=1;
    for($i=0;$i<sizeof($detalle);$i++):

    $this->SetX(2);
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    
    $this->SetX(2);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(35,3,utf8_decode($detalle[$i]['nrocaja'].": ".$detalle[$i]['nomcaja']),0,0,'L');
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,3,$simbolo.utf8_decode(number_format($detalle[$i]['montoabono'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,3,utf8_decode(date("d-m-Y H:i:s",strtotime($detalle[$i]['fechaabono']))),0,1,'L');
    $this->Ln(1);

    endfor; 
    }

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'--------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(20,4,"TOTAL",0,0,'L');
    $this->Cell(50,4,$simbolo.utf8_decode(number_format($reg[0]['totalpago'], 2, '.', ',')),0,1,'R');  

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"ABONADO",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"PENDIENTE",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['totalpago']-$reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['emailhotel'])),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(10,4,"TEL:",0,0,'L');
    $this->CellFitSpace(60,4,utf8_decode($con[0]['tlfhotel']),0,1,'L');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','BI',10);
    $this->SetFillColor(3, 3, 3);
    $this->CellFitSpace(70,3,"GRACIAS POR SU ATENCIÓN",0,1,'C');
    $this->Ln(3);
}
########################## FUNCION TICKET CREDITO EN RESERVACIONES ##############################

########################## FUNCION LISTAR CREDITOS EN RESERVACIONES ##############################
function TablaListarCreditosReservaciones()
{
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarCreditosReservaciones();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+70, $this->GetY()+1, 28),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 28),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE CRÉDITOS EN RESERVACIONES',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(90,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(35,8,'TOTAL ABONO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL DEBE',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(50,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,40,90,35,35,35,30,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalImporte=0;
    $TotalAbono=0;
    $TotalDebe=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalImporte+=$reg[$i]['totalpago'];
    $TotalAbono+=$reg[$i]['abonototal'];
    $TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),
        utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));

        }
   
    $this->Cell(145,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalAbono, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalDebe, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
}
########################## FUNCION LISTAR CREDITOS EN RESERVACIONES ##############################










########################## FUNCION TICKET CREDITO EN VENTAS ##############################
function TicketCreditoVenta()
{  
    $imp = new Login();
    $imp = $imp->ImpuestosPorId();
    $impuesto = ($imp == "" ? "IMPUESTO" : $imp[0]['nomimpuesto']);
    $valor = ($imp == "" ? "0.00" : $imp[0]['valorimpuesto']);

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    $moneda = ($con[0]['moneda'] == "" ? "" : $con[0]['moneda']);

    $tra = new Login();
    $reg = $tra->CreditosPorId();

    if (file_exists("fotos/logo-admin.png")) {

    $logo = "./fotos/logo-admin.png";
    $this->Image($logo , 20, 3, 35, 15, "PNG");
    $this->Ln(8);

    }
  
    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5, "TICKET DE CRÉDITO", 0, 0, 'C');
    $this->Ln(5);
  
    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['nomhotel'])), 0, 1, 'C');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$con[0]['documenhotel'] == '0' ? "" : "Nº ".$con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,portales(utf8_decode($con[0]['direchotel'])),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"OBLIGADO A LLEVAR CONTABILIDAD: ".utf8_decode($con[0]['llevacontabilidad']),0,1,'C');

    $this->SetX(2);
    $this->CellFitSpace(70,3,"AMBIENTE: PRODUCCIÓN",0,1,'C');
    
    $this->SetX(2);
    $this->CellFitSpace(70,3,"EMISIÓN: NORMAL",0,1,'C');


    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(70,3,$documento = ($reg[0]['documcliente'] == '0' ? "Nº DOC:" : "Nº ".$reg[0]['documento'].": ".$reg[0]['dnicliente']),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode($reg[0]['nomcliente'])),0,'L');

    $this->SetX(2);
    $this->SetFont('Courier','B',9);
    $this->MultiCell(70,3,$this->SetFont('Courier','B',9).portales(utf8_decode(getSubString($reg[0]['direccliente'],55))),0,'L');


    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(2);

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"Nro Ticket:  ", 0, 0, 'J');
    $this->SetFont('Courier','B',9);
    $this->CellFitSpace(35,4,utf8_decode($reg[0]['codventa']), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(35,4,"FECHA: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['fechaventa']))), 0, 0, 'J');
    $this->CellFitSpace(35,4,"HORA: ".utf8_decode(date("H:i:s",strtotime($reg[0]['fechaventa']))), 0, 1, 'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(33,4,"VENCE: ".utf8_decode(date("d/m/Y",strtotime($reg[0]['fechavencecredito']))), 0, 0, 'J');
    if($reg[0]['fechavencecredito'] == '0000-00-00' || $reg[0]['fechavencecredito'] >= date("Y-m-d")) {
    $this->CellFitSpace(37,4,"DIAS VENC: ".utf8_decode("0"), 0, 0, 'R');  
    } elseif($reg[0]['fechavencecredito'] < date("Y-m-d")) {
    $this->CellFitSpace(37,4,"DIAS VENC: ".utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[0]['fechavencecredito'])), 0, 0, 'R'); 
    }
    $this->Ln();

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->SetFillColor(2,157,116);
    $this->Cell(70, 5,"DETALLES DE ABONOS", 0, 0, 'L');
    $this->Ln(5);

    $tra = new Login();
    $detalle = $tra->VerDetallesAbonos();
    if($detalle==""){
        echo "";      
    } else {
    $cantidad = 0;
    $SubTotal = 0;
    $a=1;
    for($i=0;$i<sizeof($detalle);$i++):

    $this->SetX(2);
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.2);
    $this->SetFont('Courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    
    $this->SetX(2);
    $this->SetFont('Courier','',8);
    $this->CellFitSpace(35,3,utf8_decode($detalle[$i]['nrocaja'].": ".$detalle[$i]['nomcaja']),0,0,'L');
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,3,$simbolo.utf8_decode(number_format($detalle[$i]['montoabono'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',8);
    $this->CellFitSpace(35,3,utf8_decode(date("d-m-Y H:i:s",strtotime($detalle[$i]['fechaabono']))),0,1,'L');
    $this->Ln(1);

    endfor; 
    }

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,3,'---------------------------',0,0,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(20,4,"TOTAL",0,0,'L');
    $this->Cell(50,4,$simbolo.utf8_decode(number_format($reg[0]['totalpago'], 2, '.', ',')),0,1,'R');  

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"ABONADO",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','B',10);
    $this->CellFitSpace(30,4,"PENDIENTE",0,0,'L');
    $this->Cell(40,4,$simbolo.utf8_decode(number_format($reg[0]['totalpago']-$reg[0]['creditopagado'], 2, '.', ',')),0,1,'R');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(70,4,portales(utf8_decode($con[0]['emailhotel'])),0,1,'L');

    $this->SetX(2);
    $this->SetFont('Courier','',9);
    $this->CellFitSpace(10,4,"TEL:",0,0,'L');
    $this->CellFitSpace(60,4,utf8_decode($con[0]['tlfhotel']),0,1,'L');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','B',12);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->SetX(2);
    $this->Cell(70,0.5,'---------------------------',0,1,'C');
    $this->Ln(3);

    $this->SetX(2);
    $this->SetFont('Courier','BI',10);
    $this->SetFillColor(3, 3, 3);
    $this->CellFitSpace(70,3,"GRACIAS POR SU ATENCIÓN",0,1,'C');
    $this->Ln(3);
}
########################## FUNCION TICKET CREDITO EN VENTAS ##############################

########################## FUNCION LISTAR CREDITOS EN VENTAS ##############################
function TablaListarCreditosVentas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->ListarCreditosVentas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+70, $this->GetY()+1, 28),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 28),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO GENERAL DE CRÉDITOS EN VENTAS',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(90,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(35,8,'TOTAL ABONO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL DEBE',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(50,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,40,90,35,35,35,30,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalImporte=0;
    $TotalAbono=0;
    $TotalDebe=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalImporte+=$reg[$i]['totalpago'];
    $TotalAbono+=$reg[$i]['abonototal'];
    $TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),
        utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));

        }
   
    $this->Cell(145,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalAbono, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalDebe, 2, '.', ',')),0,0,'L');
    $this->Ln();
      }

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR CREDITOS EN VENTAS ##############################








########################## FUNCION LISTAR CREDITOS POR CLIENTES ########################
function TablaListarCreditosxClientes()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarCreditosxClientes();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+70, $this->GetY()+1, 28),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 28),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    if(decrypt($_GET["url"])==1){

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO DE CRÉDITOS EN RESERVACIONES POR CLIENTES ',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(40,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(75,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(30,8,'TOTAL ABONO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL DEBE',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'DIAS VENC',1,0,'C', True);
    $this->Cell(50,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,40,75,35,30,35,30,20,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalImporte=0;
    $TotalAbono=0;
    $TotalDebe=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalImporte+=$reg[$i]['totalpago'];
    $TotalAbono+=$reg[$i]['abonototal'];
    $TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

    if($reg[$i]['fechavencecredito']== '0000-00-00'){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']);
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00"){
        $vencecredito = Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']);
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),utf8_decode($vencecredito),
        utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
      }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(80,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalAbono, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalDebe, 2, '.', ',')),0,0,'L');
    $this->Ln();

   } else {

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,10,'LISTADO DE CRÉDITOS EN VENTAS POR CLIENTES ',0,0,'C');

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(30,8,'TOTAL ABONO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL DEBE',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'DIAS VENC',1,0,'C', True);
    $this->Cell(50,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,35,30,35,30,20,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalImporte=0;
    $TotalAbono=0;
    $TotalDebe=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalImporte+=$reg[$i]['totalpago'];
    $TotalAbono+=$reg[$i]['abonototal'];
    $TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

    if($reg[$i]['fechavencecredito']== '0000-00-00'){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']);
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00"){
        $vencecredito = Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']);
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),utf8_decode($vencecredito),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));
        }
      }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(80,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalAbono, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalDebe, 2, '.', ',')),0,0,'L');
    $this->Ln();

   }
    

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR CREDITOS POR CLIENTES ########################

########################## FUNCION LISTAR CREDITOS POR FECHAS ##########################
function TablaListarCreditosxFechas()
   {

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = ($con[0]['simbolo'] == "" ? "" : $con[0]['simbolo']);
    
    $tra = new Login();
    $reg = $tra->BuscarCreditosxFechas();

    $logo = ( file_exists("./fotos/logo-pdf.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf.png");
    $logo2 = ( file_exists("./fotos/logo-pdf2.png") == "" ? "./assets/images/null.png" : "./fotos/logo-pdf2.png");

    $this->Ln(2);
    $this->SetFont('Courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,5,$this->Image($logo, $this->GetX()+70, $this->GetY()+1, 28),0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['nomhotel']),0,0,'C');
    $this->Cell(45,5,$this->Image($logo2, $this->GetX()-50, $this->GetY()+1, 28),0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,$con[0]['documenhotel'] == '0' ? "" : $con[0]['documento']." ".utf8_decode($con[0]['nrohotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['direchotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,"Nº DE TLF: ".utf8_decode($con[0]['tlfhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');

    $this->Ln();
    $this->Cell(45,5,"",0,0,'C');
    $this->Cell(240,5,utf8_decode($con[0]['emailhotel']),0,0,'C');
    $this->Cell(45,5,"",0,0,'C');
    $this->Ln(10);

    if(decrypt($_GET["url"])==1){

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE CRÉDITOS EN RESERVACIONES POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE RESERVACIÓN',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(30,8,'TOTAL ABONO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL DEBE',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'DIAS VENC',1,0,'C', True);
    $this->Cell(50,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,35,30,35,30,20,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalImporte=0;
    $TotalAbono=0;
    $TotalDebe=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalImporte+=$reg[$i]['totalpago'];
    $TotalAbono+=$reg[$i]['abonototal'];
    $TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

    if($reg[$i]['fechavencecredito']== '0000-00-00'){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']);
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00"){
        $vencecredito = Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']);
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codreservacion"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($reg[$i]["statuspago"]),utf8_decode($vencecredito),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fecharegistro'])))));
        }
      }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(80,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalAbono, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalDebe, 2, '.', ',')),0,0,'L');
    $this->Ln();

    } else {

    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(330,7,'LISTADO DE CRÉDITOS EN VENTAS POR FECHAS (DESDE '.date("d-m-Y", strtotime($_GET["desde"]))." HASTA ".date("d-m-Y", strtotime($_GET["hasta"])).")",0,0,'C');

    $this->Ln(10);
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(65,179,249); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->Cell(15,8,'Nº',1,0,'C', True);
    $this->Cell(35,8,'Nº DE VENTA',1,0,'C', True);
    $this->Cell(80,8,'DESCRIPCIÓN DE CLIENTE',1,0,'C', True);
    $this->Cell(35,8,'IMPORTE TOTAL',1,0,'C', True);
    $this->Cell(30,8,'TOTAL ABONO',1,0,'C', True);
    $this->Cell(35,8,'TOTAL DEBE',1,0,'C', True);
    $this->Cell(30,8,'STATUS',1,0,'C', True);
    $this->Cell(20,8,'DIAS VENC',1,0,'C', True);
    $this->Cell(50,8,'FECHA EMISIÓN',1,1,'C', True);

    if($reg==""){
    echo "";      
    } else {
 
     /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(15,35,80,35,30,35,30,20,50));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalImporte=0;
    $TotalAbono=0;
    $TotalDebe=0;

    for($i=0;$i<sizeof($reg);$i++){ 
    
    $TotalImporte+=$reg[$i]['totalpago'];
    $TotalAbono+=$reg[$i]['abonototal'];
    $TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

    if($reg[$i]['fechavencecredito']== '0000-00-00'){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = "0";
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']== "0000-00-00"){
        $vencecredito = Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']);
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d") && $reg[$i]['fechapagado']!= "0000-00-00"){
        $vencecredito = Dias_Transcurridos($reg[$i]['fechapagado'],$reg[$i]['fechavencecredito']);
    }

    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,utf8_decode($reg[$i]["codventa"]),utf8_decode($reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']),utf8_decode($simbolo.number_format($reg[$i]['totalpago'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($simbolo.number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ',')),utf8_decode($reg[$i]["statusventa"]),utf8_decode($vencecredito),utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])))));
        }
      }
   
    $this->Cell(50,5,'',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(80,5,'TOTAL GENERAL',0,0,'C', false);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalImporte, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(30,5,utf8_decode($simbolo.number_format($TotalAbono, 2, '.', ',')),0,0,'L');
    $this->CellFitSpace(35,5,utf8_decode($simbolo.number_format($TotalDebe, 2, '.', ',')),0,0,'L');
    $this->Ln();

    }
    

    $this->Ln(12); 
    $this->SetFont('courier','B',10);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO: '.utf8_decode($_SESSION["nombres"]),0,0,'');
    $this->Cell(125,6,'RECIBIDO:_____________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA: '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(125,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR CREDITOS POR FECHAS ##########################

############################### REPORTES DE CREDITOS ##################################



 // FIN Class PDF
}
?>