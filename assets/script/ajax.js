function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}



//FUNCION PARA VALIDAR RUC Y CEDULA ECUAORIANA
validarDocumento  = function() {          
   
      pais = document.getElementById('paiscliente').value;
	  numero = document.getElementById('cedcliente').value;
	  
	  if(pais!="EC" || pais==true) {
	  
   //alert ("CHINGA TU MADRE EXTRANJERO")
   return false;
} 
else {
	  
      var suma = 0;      
      var residuo = 0;      
      var pri = false;      
      var pub = false;            
      var nat = false;      
      var numeroProvincias = 22;                  
      var modulo = 11;
                  
      /* Verifico que el campo no contenga letras */                  
      var ok=1;
      for (i=0; i<numero.length && ok==1 ; i++){
         var n = parseInt(numero.charAt(i));
         if (isNaN(n)) ok=0;
      }
      if (ok==0){
         alert("NO PUEDE INGRESAR CARACTERES EN EL NUMERO DE IDENTIFICACION.");
		 document.getElementById('cedcliente').value="";
         return false;
      }
                  
      if (numero.length < 10 ){              
         alert('EL NUMERO DE IDENTIFICACION INGRESADO ES INVALIDO.');  
		 document.getElementById('cedcliente').value="";                
         return false;
      }
     
      /* Los primeros dos digitos corresponden al codigo de la provincia */
      provincia = numero.substr(0,2);      
      if (provincia < 1 || provincia > numeroProvincias){           
         alert('EL CODIGO DE LA PROVINCIA (DOS PRIMEROS DIGITOS) ES INVALIDO.');
		 document.getElementById('cedcliente').value="";
		 return false;       
      }

      /* Aqui almacenamos los digitos de la cedula en variables. */
      d1  = numero.substr(0,1);         
      d2  = numero.substr(1,1);         
      d3  = numero.substr(2,1);         
      d4  = numero.substr(3,1);         
      d5  = numero.substr(4,1);         
      d6  = numero.substr(5,1);         
      d7  = numero.substr(6,1);         
      d8  = numero.substr(7,1);         
      d9  = numero.substr(8,1);         
      d10 = numero.substr(9,1);                
         
      /* El tercer digito es: */                           
      /* 9 para sociedades privadas y extranjeros   */         
      /* 6 para sociedades publicas */         
      /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 

      if (d3==7 || d3==8){           
         alert('EL TERCER DIGITO INGRESADO ES INVALIDO.');
		 document.getElementById('cedcliente').value="";
         return false;
      }         
         
      /* Solo para personas naturales (modulo 10) */         
      if (d3 < 6){           
         nat = true;            
         p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
         p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
         p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
         p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
         p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
         p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
         p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
         p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
         p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
         modulo = 10;
      }         

      /* Solo para sociedades publicas (modulo 11) */                  
      /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
      else if(d3 == 6){           
         pub = true;             
         p1 = d1 * 3;
         p2 = d2 * 2;
         p3 = d3 * 7;
         p4 = d4 * 6;
         p5 = d5 * 5;
         p6 = d6 * 4;
         p7 = d7 * 3;
         p8 = d8 * 2;            
         p9 = 0;            
      }         
         
      /* Solo para entidades privadas (modulo 11) */         
      else if(d3 == 9) {           
         pri = true;                                   
         p1 = d1 * 4;
         p2 = d2 * 3;
         p3 = d3 * 2;
         p4 = d4 * 7;
         p5 = d5 * 6;
         p6 = d6 * 5;
         p7 = d7 * 4;
         p8 = d8 * 3;
         p9 = d9 * 2;            
      }
                
      suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
      residuo = suma % modulo;                                         

      /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
      digitoVerificador = residuo==0 ? 0: modulo - residuo;                

      /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/                         
      if (pub==true){           
         if (digitoVerificador != d9){                          
            alert('EL RUC DE LA EMPRESA DEL SECTOR PUBLICO ES INCORRECTO.'); 
			document.getElementById('cedcliente').value="";
            return false;
         }                  
         /* El ruc de las empresas del sector publico terminan con 0001*/         
         if ( numero.substr(9,4) != '0001' ){                    
            alert('EL RUC DE LA EMPRESA DEL SECTOR PUBLICO DEBE TERMINAR CON 0001.');
			document.getElementById('cedcliente').value="";
            return false;
         }
      }         
      else if(pri == true){         
         if (digitoVerificador != d10){                          
            alert('EL RUC DE LA EMPRESA DEL SECTOR PRIVADO ES INCORRECTO.');
			document.getElementById('cedcliente').value="";
            return false;
         }         
         if ( numero.substr(10,3) != '001' ){                    
            alert('EL RUC DE LA EMPRESA DEL SECTOR PRIVADO DEBE TERMINAR CON 001.');
			document.getElementById('cedcliente').value="";
            return false;
         }
      }      

      else if(nat == true){         
         if (digitoVerificador != d10){                          
            alert('EL NUMERO DE CEDULA DE LA PERSONA NATURAL ES INCORRECTO.');
			document.getElementById('cedcliente').value="";
            return false;
         }         
         if (numero.length >10 && numero.substr(10,3) != '001' ){                    
            alert('EL RUC DE LA PERSONA NATURAL DEBE TERMINAR CON 001.');
			document.getElementById('cedcliente').value="";
            return false;
         }
      }      
      return true;   
   }            
}







//FUNCION PARA VALIDAR TARJETA DE CREDITO
function validatecreditcard() {

  var request;

  try { request= new XMLHttpRequest(); } 
  catch (tryMicrosoft) {
    try { request= new ActiveXObject("Msxml2.XMLHTTP"); }
    catch (otherMicrosoft) {
      try { request= new ActiveXObject("Microsoft.XMLHTTP"); }
      catch (failed) { request= null; }
  }
}

  var url= "class/cardvalidation.php";
  var cardnumber= document.getElementById("nrotarjeta").value;
  //var expirationdate= document.getElementById("expirationdate_entered").value;
  //var securitycode= document.getElementById("securitycode_entered").value;
  var vars= "creditcardnumber="+cardnumber;
  request.open("POST", url, true);

  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  request.onreadystatechange= function() {
    if (request.readyState == 4 && request.status == 200) {
      var return_data=  request.responseText;
      document.getElementById("tipotarjeta").value= return_data;
      document.getElementById("tarjeta").value= return_data;
    }
}
  request.send(vars);
}


//FUNCION QUE MUESTRA HABITACIONES RESERVADAS
function RevisaReserva(check,desde,hasta,tipo){

	var muestra = document.getElementById('muestradetallesreservacion');

					var elementos = document.getElementsByName("check[]");
					var cont = 0; 
					for (var x=0; x < elementos.length; x++) {
					 if (elementos[x].checked) {
					  cont = cont + 1;
					 }
				}
					 if(cont > 0) {
					texto = []; 
					for (x=0;x<elementos.length;x++){
					if (elementos[x].checked==true) {
					texto.push(elementos[x].value);
				}
		} 
		//document.forms['miformulario']['destinook'].value = texto.split(","); 
		ajax=objetoAjax();
		ajax.open("GET", "funciones_reservaciones.php?BuscaHabitacionesReservadas=si&check="+texto+"&desde="+desde+"&hasta="+hasta+"&tipo="+tipo);
		ajax.onreadystatechange=function() {
				if (ajax.readyState==1 || ajax.readyState==2 || ajax.readyState==3) {
				muestra.innerHTML = "<center><i class='fa fa-spin fa-spinner'></i> Cargando información, por favor espere....</center>";
			}
			if (ajax.readyState==4) {
				var resul=ajax.responseText
				muestra.innerHTML = resul											
			}
		}
		ajax.send(null);		
					 
           } else {

            swal("Oops", "POR FAVOR DEBE SELECCIONAR AL MENOS UNA HABITACION!", "error");
				}
}