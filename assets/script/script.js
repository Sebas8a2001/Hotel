/*Author: Ing. Ruben D. Chirinos R. Tlf: +58 0414-7225970, email: elsaiya@gmail.com


/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$(document).ready(function() {
						   
	 $("#loginform").validate({
        rules:
	    {
			select: { required: true, },
			usuario: { required: true, },
			password: { required: true, },
	    },
        messages:
	    {
		    select:{ required: "Seleccione Tipo de Usuario" },
		    usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Clave de Acceso" },
        },
	    submitHandler: function(form) {
                     
            var data = $("#loginform").serialize();
		    var formulario = $('#formulario').val();
				
			$.ajax({
			type : 'POST',
			url  : formulario+'.php',
			async : false,
			data : data,
			beforeSend: function()
			{	
				$("#login").fadeOut();
				
				 var n = noty({
                 text: "<span class='fa fa-refresh'></span> VERIFICANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 1000, });
                 //$("#btn-login").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(response)
			   {						
					if(response==1){ 
								 
						$("#login").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-out"></i> Acceder');
				    
					});
			   
	                } else if(response==2){
									 
						$("#login").fadeIn(1000, function(){
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS DATOS INGRESADOS NO EXISTEN, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-out"></i> Acceder');
				 
				        }); 
			   
					} else {
									  
							$("#login").fadeIn(1000, function(){
				
				 $("#btn-login").html('<i class="fa fa-sign-out"></i> Acceder');
				 setTimeout(' window.location.href = "panel"; ',500);
				 
				        });  
					}
			    }
		    });
			return false;
		}
	   /* login submit */
    });   
});


/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/
$(document).ready(function()
{ 
						   
	 $("#lockscreen").validate({
        rules:
	    {
			select: { required: true, },
			usuario: { required: true, },
			password: { required: true, },
	    },
        messages:
	    {
		    select:{ required: "Seleccione Tipo de Usuario" },
		    usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Clave de Acceso" },
        },
	    submitHandler: function(form) {
                     
            var data = $("#lockscreen").serialize();
		    //var formulario = $('#formulario').val();
				
			$.ajax({
			type : 'POST',
			url  : 'lockscreen.php',
			async : false,
			data : data,
			beforeSend: function()
			{	
				$("#login").fadeOut(1000);
				
				 var n = noty({
                 text: "<span class='fa fa-refresh'></span> VERIFICANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 1000, });
                 //$("#btn-login").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(response)
			   {						
					if(response==1){ 
								 
								    $("#login").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-out"></i> Acceder');
				    
					                                                 });
			   
	                             } else if(response==2){
									 
									 $("#login").fadeIn(1000, function(){
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS DATOS INGRESADOS NO EXISTEN, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-login").html('<i class="fa fa-sign-out"></i> Acceder');
				 
				                                                        }); 
			   
					              } else {
									  
									    $("#login").fadeIn(1000, function(){
				
				 $("#btn-login").html('<i class="fa fa-sign-out"></i> Acceder');
				 setTimeout(' window.location.href = "panel"; ',500);
				 
				        });  
					}
			    }
		    });
		    return false;
	    }
	   /* login submit */
    });    
});
/* FUNCION JQUERY PARA VALIDAR ACCESO DE USUARIOS*/



/* FUNCION JQUERY PARA RECUPERAR CONTRASE—A DE USUARIOS */	 
$(document).ready(function()
{ 
     /* validation */
	$("#recoverform").validate({
        rules:
	    {
			select: { required: true },
			email: { required: true, email: true },
	    },
        messages:
 	    {
			select:{ required: "Seleccione Tipo de Usuario" },
			email:{ required: "Ingrese su Correo Electr&oacute;nico", email: "Ingrese un Correo Electr&oacute;nico Valido" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#recoverform").serialize();
		var formulario = $('#formulario').val();
				
			$.ajax({
			type : 'POST',
		    url  : formulario+'.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#recover").fadeOut();
				$("#btn-recuperar").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(data)
					   {						
							if(data==1){
								
								$("#recover").fadeIn(1000, function(){ 
		
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'error',
             timeout: 5000, });
		     $("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar');
			    
				                                                 });																			
							}
							else if(data==2)
							{
								
				$("#recover").fadeIn(1000, function(){ 
		
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL CORREO INGRESADO NO FUE ENCONTRADO ACTUALMENTE...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'error',
             timeout: 5000, });
		     $("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar');
			    
				                                                 });
				
							} else {
									
								$("#recover").fadeIn(1000, function(){
									
			$("#recoverform")[0].reset();
			 var n = noty({
			 text: '<center> &nbsp; '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 8000, });
			 $("#btn-recuperar").html('<span class="fa fa-check-square-o"></span> Recuperar');	
			                                
							});
						}
					}
				});
			return false;
		}
	   /* form submit */
    });    
});
/*  FIN DE FUNCION PARA RECUPERAR CONTRASE—A DE USUARIOS */

 
/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASE—A */	 
$(document).ready(function()
{ 
								
     /* validation */
	 $("#updatepassword").validate({
      rules:
	  {
			usuario: {required: true },
			password: {required: true, minlength: 8 },  
            password2: {required: true, minlength: 8, equalTo: "#password" }, 
	   },
       messages:
	   {
            usuario:{ required: "Ingrese Usuario de Acceso" },
            password:{ required: "Ingrese su Nuevo Password", minlength: "Ingrese 8 caracteres como minimo" },
		    password2:{ required: "Repita su Nuevo Password", minlength: "Ingrese 8 caracteres como minimo", equalTo: "Este Password no coincide" },
           
       },
	   submitHandler: function(form) {
                     
                var data = $("#updatepassword").serialize();
				var id= $("#updatepassword").attr("data-id");
		        var codigo = id;
				
				$.ajax({
				type : 'POST',
				url  : 'password.php?codigo='+codigo,
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
						$("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				    
					                                                 });									
																				
								}
								else if(data==2)
								{
									
					    $("#error").fadeIn(1000, function(){ 
			
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO PUEDE USAR LA CLAVE ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
			     $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				    
					                                                 });
					
								} else {
										
						$("#error").fadeIn(1000, function(){
										
				 
				 $("#updatepassword")[0].reset();
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');	
				 setTimeout(' window.location.href = "logout"; ',5000);
				 
												                      });									
								             }
						    }
				});
				return false;
		}
	   /* form submit */
    });    
});
 /* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONTRASE—A */
 
  
 
  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR ENVIO DE CORREO EN CONTACTO */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#formcontact").validate({
      rules:
	  {
			name: { required: true },
			email: { required: true, email : true },
			phone: { required: true, digits : false },
			subject: { required: true },
			message: { required: true },
			captcha: { required: true },
	   },
       messages:
	   {
			name:{ required: "Ingrese Nombres y Apellidos" },
			email: { required: "Ingrese Correo Electr&oacute;nico", email: "Ingrese un Correo v&aacute;lido" },
			phone: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
            subject:{ required: "Ingrese Asunto de Mensaje" },
			message:{ required: "Ingrese Descripci&oacute;n de Mensaje" },
			captcha: { required: "Ingrese C&oacute;digo" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#formcontact").serialize();
				$.ajax({
				type : 'POST',
				url  : 'contact.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#msj_contact").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
						$("#msj_contact").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
				 $("#btn-submit").html('<span class="fa fa-send"></span> Enviar Mensaje');
				 
				                 }); 
																				
								}
					else if(data==2)
					{
								
				$("#msj_contact").fadeIn(1000, function(){ 
		
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL MENSAJE NO HA PODIDO SER ENVIADO, VERIFIQUE E INTENTE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'error',
             timeout: 5000 });
		     $("#btn-submit").html('<span class="fa fa-send"></span> Enviar Mensaje');
			    
				        });
				
					} else { 
								     
						$("#msj_contact").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#formcontact")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-send"></span> Enviar Mensaje');	
				                                
												                      });
							    }
					    }
			    });
		  return false;
	  }
	  /* form submit */	 
    });    
});
/* FUNCION JQUERY PARA VALIDAR ENVIO DE CORREO EN CONTACTO */
 
 
 
 
 
 
 
 
 









/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */	 
$(document).ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
        });

     /* validation */
	 $("#configuracion").validate({
      rules:
	  {
			documgerente: { required: true },
			cedgerente: { required: true, digits: true },
			nomgerente: { required: true, lettersonly: true },
			tlfgerente: { required: true, digits : false },
			direcgerente: { required: true },
			documenhotel: { required: true },
			nrohotel: { required: true, digits: true },
			nomhotel: { required: true },
			tlfhotel: { required: true, digits : false },
			direchotel: { required: true },
			emailhotel: { required: true, email : true },
			categoriahotel: { required: true },
			nroactividad: { required: true },
            iniciofactura: {required: true, digits : false },
			fechaautorizacion: { required: true },
			llevacontabilidad: { required: true },
			acerca: { required: true },
			metodopago: { required: true },
			dsctor: { required: true, number : true },
			dsctov: { required: true, number : true },
			codmoneda: { required: true },
			codmoneda2: { required: true },
	   },
       messages:
	   {
			documgerente:{ required: "Seleccione Tipo de Documento" },
			cedgerente:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos para N&deg; de Documento" },
			nomgerente:{ required: "Ingrese Nombre de Gerente", lettersonly: "Ingrese solo letras para Nombres" },
			tlfgerente: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
			direcgerente: { required: "Ingrese Direcci&oacute;n Domiciliaria" },
            documenhotel:{ required: "Seleccione Tipo de Documento" },
            nrohotel:{ required: "Ingrese N&deg; de Registro", digits: "Ingrese solo digitos para N&deg; de Registro" },
			nomhotel:{ required: "Ingrese Nombre de Instituci&oacute;n" },
			tlfhotel: { required: "Ingrese N&deg; de Tel&eacute;fono", digits: "Ingrese solo digitos para Tel&eacute;fono" },
			direchotel: { required: "Ingrese Direcci&oacute;n" },
			emailhotel: { required: "Ingrese Correo Electr&oacute;nico", email: "Ingrese un Correo v&aacute;lido" },
			categoriahotel:{ required: "Seleccione Categoria" },
			nroactividad:{ required: "Ingrese N&deg; de Actividad", digits: "Ingrese solo digitos para N&deg; de Actividad" },
			iniciofactura:{ required: "Ingrese N&deg; de Inicio de Factura", digits: "Ingrese solo digitos para N&deg; de Inicio de Fcatura" },
			fechaautorizacion:{ required: "Ingrese Fecha de Autorizaci&oacute;n" },
			llevacontabilidad:{ required: "Seleccione si lleva Contabilidad" },
			acerca: { required: "Ingrese Acerca de Hotel" },
			metodopago: { required: "Ingrese Metodos de Pagos" },
			dsctor:{ required: "Ingrese Descto Global para Resevaciones", number: "Ingrese solo digitos con 2 decimales" },
			dsctov:{ required: "Ingrese Descto Global para Ventas", number: "Ingrese solo digitos con 2 decimales" },
			codmoneda:{ required: "Seleccione Moneda Nacional" },
			codmoneda2:{ required: "Seleccione Moneda para Cambio" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#configuracion").serialize();
				var formData = new FormData($("#configuracion")[0]);
				var id= $("#configuracion").attr("data-id");
		        var id = id;
				
				$.ajax({
				type : 'POST',
				url  : 'configuracion.php?id='+id,
			    async : false,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#error").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
						$("#error").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'error',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				 
				                                                      }); 
																				
								} else { 
								     
						$("#error").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');	
				                                
												                      });
							    }
					    }
			    });
		  return false;
	  }
	  /* form submit */	
    });     
});
/* FIN DE  FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE CONFIGURACION GENERAL */
 
 
  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR REGISTRO DE USUARIOS */	 
$(document).ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
        });

     /* validation */
	 $("#saveuser").validate({
      rules:
	  {
			dni: { required: true, digits : true, minlength: 7 },
			nombres: { required: true, lettersonly: true },
			sexo: { required: true },
			direccion: { required: true },
			telefono: { required: true },
			email: { required: true, email: true },
			usuario: { required: true },
			password: {required: true, minlength: 8},  
            password2: {required: true, minlength: 8, equalTo: "#password"}, 
			nivel: { required: true },
			status: { required: true },
	   },
       messages:
	   {
            dni:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo d&iacute;gitos para N&deg; de Documento", minlength: "Ingrese 7 d&iacute;gitos como m&iacute;nimo" },
			nombres:{ required: "Ingrese Nombre de Usuario", lettersonly: "Ingrese solo letras para Nombres" },
            sexo:{ required: "Seleccione Sexo de Usuario" },
            direccion:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
            telefono:{ required: "Ingrese N&deg; de Tel&eacute;fono" },
			email:{ required: "Ingrese Email de Usuario", email: "Ingrese un Email V&aacute;lido" },
			usuario:{ required: "Ingrese Usuario de Acceso" },
			password:{ required: "Ingrese Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo" },
		    password2:{ required: "Repita Password de Acceso", minlength: "Ingrese 8 caracteres como m&iacute;nimo", equalTo: "Este Password no coincide" },
			nivel:{ required: "Seleccione Nivel de Acceso" },
			status:{ required: "Seleccione Status de Acceso" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#saveuser").serialize();
				var formData = new FormData($("#saveuser")[0]);
				
				$.ajax({
				type : 'POST',
				url  : 'usuarios.php',
			    async : false,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN USUARIO CON ESTE N&deg; DE DNI, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else if(data==3){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE CORREO ELECTR&Oacute;NICO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
											
									});
								}
								else if(data==4)
								{
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE USUARIO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');

									});
								}
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 15000, });
                 $('body').removeClass('modal-open');
                 $('#myModalUser').modal('hide');
				 $("#saveuser")[0].reset();
                 $("#proceso").val("save");	
		         $('#codusuario').val("");
				 $('#usuarios').html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#usuarios').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
				 setTimeout(function() {
				 	$('#usuarios').load("consultas?CargaUsuarios=si");
				 }, 200);

									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });	     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE USUARIOS */

 
 
 
 
 
 
 
 
 











/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CATEGORIAS */	 
$(document).ready(function()
{ 
     
     /* validation */
	 $("#savecategorias").validate({
      rules:
	  {
			nomcategoria: { required: true },
	   },
       messages:
	   {
            nomcategoria:{ required: "Ingrese Nombre de Categoria" },
       },
	   submitHandler: function(form) {
                     
               var data = $("#savecategorias").serialize();

				$.ajax({
				type : 'POST',
				url  : 'categorias.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA CATEGORIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																				
									});
								} 
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savecategorias")[0].reset();
                 $("#proceso").val("save");
				 $('#categorias').html("");		
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
				 $('#categorias').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#categorias').load("consultas?CargaCategorias=si");
                 }, 200);										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CATEGORIAS */

















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TIPOS DE DOCUMENTOS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savedocumentos").validate({
      rules:
	  {
			documento: { required: true },
			descripcion: { required: true },
	   },
       messages:
	   {
			documento:{ required: "Ingrese Nombre de Documento" },
            descripcion:{ required: "Ingrese Descripci&oacute;n de Documento" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savedocumentos").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'documentos.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}   
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE DOCUMENTO YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								 else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savedocumentos")[0].reset();
                 $("#proceso").val("save");
				 $('#documentos').html("");	
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#documentos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#documentos').load("consultas?CargaDocumentos=si");
                 }, 200);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });    	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TIPOS DE DOCUMENTOS */

















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TIPOS DE MONEDA */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savemonedas").validate({
      rules:
	  {
			moneda: { required: true },
			siglas: { required: true },
			simbolo: { required: true },
	   },
       messages:
	   {
			moneda:{ required: "Ingrese Nombre de Moneda" },
            siglas:{ required: "Ingrese Siglas de Moneda" },
            simbolo:{ required: "Ingrese Simbolo de Moneda" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savemonedas").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'monedas.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}   
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE MONEDA YA EXISTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								 else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savemonedas")[0].reset();
                 $("#proceso").val("save");
				 $('#monedas').html("");	
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#monedas').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#monedas').load("consultas?CargaMonedas=si");
                 }, 200);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });  	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TIPOS DE MONEDA */


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TIPOS DE CAMBIO */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savecambios").validate({
      rules:
	  {
			descripcioncambio: { required: true },
			montocambio:{ required: true, number : true},
			montocambio: { required: true },
			codmoneda: { required: true },
			fechacambio: { required: true },
	   },
       messages:
	   {
			descripcioncambio:{ required: "Ingrese Descripci&oacute;n de Cambio" },
			montocambio:{ required: "Ingrese Monto de Cambio", number: "Ingrese solo digitos con 2 decimales" },
			codmoneda:{ required: "Seleccione Tipo de Moneda" },
			fechacambio:{ required: "Ingrese Fecha de Registro" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savecambios").serialize();
				var montocambio = $('#montocambio').val();
	
	        if (montocambio==0.00 || montocambio==0) {
	            
				$("#montocambio").focus();
				$('#montocambio').css('border-color','#2cabe3');
				swal("Oops", "POR FAVOR INGRESE UN MONTO DE CAMBIO VALIDO!", "error");

	        } else {


				$.ajax({
				type : 'POST',
				url  : 'cambios.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}   
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN TIPO DE CAMBIO EN LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								 else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savecambios")[0].reset();
                 $("#proceso").val("save");
				 $('#cambios').html("");	
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#cambios').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#cambios').load("consultas?CargaCambios=si");
                 }, 200);
										
									});
								}
						   }
				});
				return false;
			   }
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TIPOS DE CAMBIO */



























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MEDIOS DE PAGOS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savemedios").validate({
      rules:
	  {
			mediopago: { required: true },
	   },
       messages:
	   {
			mediopago:{ required: "Ingrese Nombre de Medio de Pago" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savemedios").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'medios.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}   
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE ESTE MEDIO DE PAGO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savemedios")[0].reset();
                 $("#proceso").val("save");	
				 $('#mediospagos').html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#mediospagos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
				 setTimeout(function() {
				 	$('#mediospagos').load("consultas?CargaMediosPagos=si");
				 }, 200);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	
    });      
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE MEDIOS DE PAGOS */

 


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE IMPUESTOS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#saveimpuestos").validate({
      rules:
	  {
			nomimpuesto: { required: true },
			valorimpuesto: { required: true, number : true},
			statusimpuesto: { required: true },
			fechaimpuesto: { required: true },
	   },
       messages:
	   {
			nomimpuesto:{ required: "Ingrese Nombre de Impuesto" },
			valorimpuesto:{ required: "Ingrese Valor de Impuesto", number: "Ingrese solo digitos con 2 decimales" },
			statusimpuesto: { required: "Seleccione Status de Impuesto" },
			fechaimpuesto:{ required: "Ingrese Fecha de Registro" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#saveimpuestos").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'impuestos.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}   
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN IMPUESTO ACTIVO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==3){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> YA EXISTE UN IMPUESTO CON ESTE NOMBRE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								 else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#saveimpuestos")[0].reset();
				 $('#impuestos').html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#impuestos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
				 setTimeout(function() {
				 	$('#impuestos').load("consultas?CargaImpuestos=si");
				 }, 200);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE IMPUESTOS */


 

  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PERFIL */	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#saveperfil").validate({
      rules:
	  {
			nomperfil: { required: true },
			descperfil: { required: true },
	   },
       messages:
	   {
            nomperfil:{ required: "Ingrese Nombre de Perfil" },
			descperfil:{ required: "Ingrese Descripci&oacute;n de Perfil" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#saveperfil").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'acerca.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE PERFIL YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																				
									});
								} 
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#saveperfil")[0].reset();
                 $("#proceso").val("save");
				 $('#perfil').html("");		
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
				 $('#perfil').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#perfil').load("consultas?CargaPerfil=si");
                 }, 200);	
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */	
    });     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PERFIL */
  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TEMPORADAS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savetemporadas").validate({
      rules:
	  {
			temporada: { required: true },
			desde: { required: true, date : false},
			hasta: { required: true, date : false},
	   },
       messages:
	   {
            temporada:{ required: "Seleccione Temporada" },
			desde:{ required: "Ingrese Fecha Desde", date: "Ingrese Fecha Desde: YYYY-MM-DD" },
			hasta:{ required: "Ingrese Fecha Hasta", date: "Ingrese Fecha Hasta: YYYY-MM-DD" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savetemporadas").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'temporadas.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}   
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA FECHA DESDE YA SE ENCUENTRA ASIGNADA A UNA TEMPORADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA FECHA HASTA YA SE ENCUENTRA ASIGNADA A UNA TEMPORADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savetemporadas")[0].reset();
                 $("#proceso").val("save");	
				 $('#temporadas').html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
				 $('#temporadas').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
				 setTimeout(function() {
				 	$('#temporadas').load("consultas?CargaTemporadas=si");
				 }, 200);
										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TEMPORADAS */

  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR REGISTRO DE NOTICIAS */	 	 
$(document).ready(function()
{    

     /* validation */
	 $("#savenoticias").validate({
      rules:
	  {
			titulonoticia: { required: true },
			descripcnoticia: { required: true },
			statusnoticia: { required: true },
	   },
       messages:
	   {
            titulonoticia:{ required: "Ingrese Titulo de Noticia" },
			descripcnoticia:{ required: "Ingrese Descripci&oacute;n de Noticia" },
			statusnoticia:{ required: "Seleccione Status de Noticia" },
       },
	   submitHandler: function(form) {
                     
               var data = $("#savenoticias").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'noticias.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTA NOTICIA YA SE ENCUENTRA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																				
									});
								} 
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savenoticias")[0].reset();
                 $("#proceso").val("save");
				 $('#noticias').html("");		
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
				 $('#noticias').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#noticias').load("consultas?CargaNoticias=si");
                 }, 200);	
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });	    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE NOTICIAS */

  

 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TIPOS DE HABITACIONES */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savetipos").validate({
      rules:
	  {
			nomtipo: { required: true },
	   },
       messages:
	   {
            nomtipo:{ required: "Ingrese Tipo de Habitaci&oacute;n" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savetipos").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'tipos.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE TIPO DE HABITACION YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																				
									});
								} 
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savetipos")[0].reset();
                 $("#proceso").val("save");
				 $('#tipos').html("");		
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
				 $('#tipos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#tipos').load("consultas?CargaTipos=si");
                 }, 200);										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });	     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TIPOS DE HABITACIONES */


  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA VALIDAR REGISTRO DE TARIFA DE HABITACIONES */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savetarifas").validate({
      rules:
	  {
			codtipo: { required: true },
			baja: { required: true, number : true},
			media: { required: true, number : true},
			alta: { required: true, number : true},
	   },
       messages:
	   {
            codtipo:{ required: "Seleccione Tipo de Habitaci&oacute;n" },
			baja:{ required: "Ingrese Costo Bajo", number: "Ingrese solo digitos y decimales con puntos" },
			media:{ required: "Ingrese Costo Medio", number: "Ingrese solo digitos y decimales con puntos" },
			alta:{ required: "Ingrese Costo Alto", number: "Ingrese solo digitos y decimales con puntos" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#savetarifas").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'tarifas.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LOS COSTOS DE HABITACIONES DEBEN DE SER REALES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																				
									});
								}
								else if(data==3){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE TIPO DE HABITACION YA TIENE UNA TARIFA REGISTRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																				
									});
								} 
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#savetarifas")[0].reset();
                 $("#proceso").val("save");
				 $('#tarifas').html("");		
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
				 $('#tarifas').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
                 setTimeout(function() {
                 $('#tarifas').load("consultas?CargaTarifas=si");
                 }, 200);										
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });	      
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE TARIFA DE HABITACIONES */






















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE HABITACIONES */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savehabitacion").validate({
        rules:
	    {
			numhabitacion: { required: true },
			descriphabitacion: { required: true },
			piso: { required: true },
			vista: { required: true },
			maxadultos: { required: true },
			maxninos: { required: true },
			codtarifa: { required: true },
			deschabitacion: { required: true, number : true },
			statushab: { required: true },
			file: { required: true },
	    },
        messages:
	    {
			numhabitacion:{ required: "Ingrese N&deg; Habitaci&oacute;n" },
			descriphabitacion:{ required: "Ingrese Descripci&oacute;n de Habitaci&oacute;n" },
			piso:{ required: "Ingrese Piso de Habitaci&oacute;n" },
			vista:{ required: "Ingrese Vista de Habitaci&oacute;n" },
			maxadultos:{ required: "Seleccione N&deg; Maximo de Adultos" },
			maxninos:{ required: "Seleccione N&deg; Maximo de Ni&ntilde;os" },
			codtarifa:{ required: "Seleccione Costo de Habitaci&oacute;n" },
			deschabitacion:{ required: "Ingrese Descuento de Habitaci&oacute;n", number: "Ingrese solo digitos con 2 decimales" },
			statushab:{ required: "Seleccione Status de Habitaci&oacute;n" },
			file:{ required: "Realice la B&uacute;squeda de Imagen" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#savehabitacion").serialize();
		var formData = new FormData($("#savehabitacion")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'forhabitacion.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
								
							});
						}  
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> LOS ARCHIVOS CARGADOS NO SON IMAGENES ACEPTADAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																		
							});
						}
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ESTE N&deg DE HABITACI&Oacute;N YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
		 $("#savehabitacion")[0].reset();
		 $("#tabla").html('<div class="col-md-12"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="form-group has-feedback"><label class="control-label">Foto de Habitacion: <span class="symbol required"></span></label><div class="input-group"><div class="form-control" data-trigger="fileinput"><i class="fa fa-file-photo-o fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-info btn-file"><span class="fileinput-new"><i class="fa fa-cloud-upload"></i> Selecciona Archivo</span><span class="fileinput-exists"><i class="fa fa-file-photo-o"></i> Cambiar</span><input type="file" title="Por favor realice la busqueda de Imagen" class="btn btn-default btn-file" data-original-title="Subir Imagen" data-rel="tooltip" placeholder="Suba su Imagen" name="file[]" id="file"></span><a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Quitar</a></div><small><p>Para Subir la Foto debe tener en cuenta:<br> * La Imagen debe ser extension.jpeg,jpg<br> * La imagen no debe ser mayor de 200 KB</p></small></div></div></div>');
		 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */
    });    	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE HABITACIONES */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE HABITACIONES */	  
$(document).ready(function()
{ 
     /* validation */
	 $("#updatehabitacion").validate({
	    rules:
	    {
			numhabitacion: { required: true },
			descriphabitacion: { required: true },
			piso: { required: true },
			vista: { required: true },
			maxadultos: { required: true },
			maxninos: { required: true },
			codtarifa: { required: true },
			deschabitacion: { required: true, number : true },
			statushab: { required: true },
			file: { required: true },
	    },
        messages:
	    {
			numhabitacion:{ required: "Ingrese N&deg; Habitaci&oacute;n" },
			descriphabitacion:{ required: "Ingrese Descripci&oacute;n de Habitaci&oacute;n" },
			piso:{ required: "Ingrese Piso de Habitaci&oacute;n" },
			vista:{ required: "Ingrese Vista de Habitaci&oacute;n" },
			maxadultos:{ required: "Seleccione N&deg; Maximo de Adultos" },
			maxninos:{ required: "Seleccione N&deg; Maximo de Ni&ntilde;os" },
			codtarifa:{ required: "Seleccione Costo de Habitaci&oacute;n" },
			deschabitacion:{ required: "Ingrese Descuento de Habitaci&oacute;n", number: "Ingrese solo digitos con 2 decimales" },
			statushab:{ required: "Seleccione Status de Habitaci&oacute;n" },
			file:{ required: "Realice la B&uacute;squeda de Imagen" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#updatehabitacion").serialize();
		var formData = new FormData($("#updatehabitacion")[0]);
		var id= $("#updatehabitacion").attr("data-id");
        var codhabitacion = id;
		
		$.ajax({
		type : 'POST',
		url  : 'forhabitacion.php?h='+codhabitacion,
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
								
							});
						}  
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> LOS ARCHIVOS CARGADOS NO SON IMAGENES ACEPTADAS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																		
							});
						}
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ESTE N&deg DE HABITACI&Oacute;N YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'success',
         timeout: 5000, });
         $("#cargaimg").load("funciones.php?RecargaImg=si&h="+codhabitacion);
		 $("#tabla").html('<div class="col-md-12"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="form-group has-feedback"><label class="control-label">Foto de Habitacion: <span class="symbol required"></span></label><div class="input-group"><div class="form-control" data-trigger="fileinput"><i class="fa fa-file-photo-o fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-info btn-file"><span class="fileinput-new"><i class="fa fa-cloud-upload"></i> Selecciona Archivo</span><span class="fileinput-exists"><i class="fa fa-file-photo-o"></i> Cambiar</span><input type="file" title="Por favor realice la busqueda de Imagen" class="btn btn-default btn-file" data-original-title="Subir Imagen" data-rel="tooltip" placeholder="Suba su Imagen" name="file[]" id="file"></span><a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Quitar</a></div><small><p>Para Subir la Foto debe tener en cuenta:<br> * La Imagen debe ser extension.jpeg,jpg<br> * La imagen no debe ser mayor de 200 KB</p></small></div></div></div>');
		 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
		 setTimeout("location.href='habitaciones'", 5000);	
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR ACTUALIZACION DE HABITACIONES */




  
 
 
 
 
 
 
 
 
 










/* FUNCION JQUERY PARA CARGA MASIVA DE CLIENTES */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#cargaclientes").validate({
      rules:
	  {
			sel_file: { required: true },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#cargaclientes").serialize();
			var formData = new FormData($("#cargaclientes")[0]);
			
			$.ajax({
			type : 'POST',
			url  : 'clientes.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function()
			{	
				$("#carga").fadeOut();
				$("#btn-cliente").html('<i class="fa fa-spin fa-spinner"></i> Cargando ....');
			},
			success :  function(data)
					   {						
							if(data==1){
								
								$("#carga").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-cliente").html('<span class="fa fa-cloud-upload"></span> Cargar');
									
								});
							}  
							else if(data==2){
								
						   $("#carga").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE CLIENTES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-cliente").html('<span class="fa fa-cloud-upload"></span> Cargar');
																			
								});
							}
							else{
									
				$("#carga").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalCargaMasiva').modal('hide');

			 $("#cargaclientes")[0].reset();
			 $('#clientes').html("");
			 $('#divcliente').html("");
			 $("#btn-cliente").html('<span class="fa fa-cloud-upload"></span> Cargar');
			 $('#clientes').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#clientes').load("consultas?CargaClientes=si");
			 }, 200);
	
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });  
});
/*  FIN DE FUNCION PARA CARGA MASIVA DE CLIENTES */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CLIENTES */	 
$(document).ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
    });

     /* validation */
	 $("#savecliente").validate({
      rules:
	  {
			documcliente: { required: false },
			dnicliente: { required: true, digits : false },
			nomcliente: { required: true, lettersonly: true },
			paiscliente: { required: true },
			ciudadcliente: { required: true },
			direccliente: { required: true },
			telefcliente: { required: true, digits : false },
			correocliente: { required: true, email: true },
			limitecredito: { required: true, number : true},
	   },
       messages:
	   {
            documcliente:{ required: "Seleccione Tipo de Documento" },
            dnicliente:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos"  },
			nomcliente:{ required: "Ingrese Nombre de Cliente" },
			paiscliente:{ required: "Seleccione Pais donde Vive" },
			ciudadcliente:{ required: "Ingrese Ciudad donde Vive" },
			direccliente:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			telefcliente:{ required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos"  },
			correocliente:{ required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
			limitecredito:{ required: "Ingrese Limite de Cr&eacute;dito", number: "Ingrese solo digitos con 2 decimales" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#savecliente").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'clientes.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
									
								});
							}  
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE UN CLIENTE CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalCliente').modal('hide');
			 $("#savecliente")[0].reset();
             $("#proceso").val("save");
             $('#codcliente').val("");
			 $('#clientes').html("");		
			 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
			 $('#clientes').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             $('#clientes').load("consultas?CargaClientes=si");
             }, 200);										
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });	     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CLIENTES */




















/* FUNCION JQUERY PARA CARGA MASIVA DE PROVEEDORES */	 
$(document).ready(function()
{ 						
     /* validation */
	 $("#cargaproveedores").validate({
      rules:
	  {
			sel_file: { required: true },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#cargaproveedores").serialize();
			var formData = new FormData($("#cargaproveedores")[0]);
			
			$.ajax({
			type : 'POST',
			url  : 'proveedores.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function()
			{	
				$("#carga").fadeOut();
				$("#btn-proveedor").html('<i class="fa fa-spin fa-spinner"></i> Cargando ....');
			},
			success :  function(data)
					   {						
							if(data==1){
								
								$("#carga").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-proveedor").html('<span class="fa fa-cloud-upload"></span> Cargar');
									
								});
							}  
							else if(data==2){
								
						   $("#carga").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE PROVEEDORES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-proveedor").html('<span class="fa fa-cloud-upload"></span> Cargar');
																			
								});
							}
							else{
									
				$("#carga").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalCargaMasiva').modal('hide');
			 $("#cargaproveedores")[0].reset();
			 $('#proveedores').html("");
			 $('#divproveedor').html("");
			 $("#btn-proveedor").html('<span class="fa fa-cloud-upload"></span> Cargar');
			 $('#proveedores').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#proveedores').load("consultas?CargaProveedores=si");
			 }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });    
});
/*  FIN DE FUNCION PARA CARGA MASIVA DE PROVEEDORES */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PROVEEDORES */	  
$(document).ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
        });

     /* validation */
	 $("#saveproveedor").validate({
      rules:
	  {
			documproveedor: { required: false },
			cuitproveedor: { required: true, digits : false, minlength: 7 },
			nomproveedor: { required: true, lettersonly: true },
			tlfproveedor: { required: true },
			direcproveedor: { required: true },
			emailproveedor: { required: true, email: true },
			vendedor: { required: true, lettersonly: true },
			tlfvendedor: { required: true },
	   },
       messages:
	   {
			documproveedor:{ required: "Seleccione Tipo de Documento" },
			cuitproveedor:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo d&iacute;gitos para N&deg; de Documento", minlength: "Ingrese 7 d&iacute;gitos como m&iacute;nimo" },
            nomproveedor:{ required: "Ingrese Nombre de Proveedor", lettersonly: "Ingrese solo letras para Nombres" },
			tlfproveedor: { required: "Ingrese N&deg; de Tel&eacute;fono" },
			direcproveedor: { required: "Ingrese Direcci&oacute;n de Proveedor" },
			emailproveedor:{ required: "Ingrese Email de Proveedor", email: "Ingrese un Email V&aacute;lido" },
            vendedor:{ required: "Ingrese Nombre de Encargado", lettersonly: "Ingrese solo letras para Nombres" },
            tlfvendedor: { required: "Ingrese N&deg; de Tel&eacute;fono" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#saveproveedor").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'proveedores.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
									
								});
							}  
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE UN PROVEEDOR CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalProveedor').modal('hide');
			 $("#saveproveedor")[0].reset();
             $("#proceso").val("save");		
			 $('#proveedores').html("");
			 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
			 $('#proveedores').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#proveedores').load("consultas?CargaProveedores=si");
			 }, 200);
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });	     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PROVEEDORES */




















/* FUNCION JQUERY PARA CARGA MASIVA DE INSUMOS */	 
$(document).ready(function()
{ 						
     /* validation */
	 $("#cargainsumos").validate({
      rules:
	  {
			sel_file: { required: true },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#cargainsumos").serialize();
			var formData = new FormData($("#cargainsumos")[0]);
			
			$.ajax({
			type : 'POST',
			url  : 'insumos.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function()
			{	
				$("#carga").fadeOut();
				$("#btn-insumos").html('<i class="fa fa-spin fa-spinner"></i> Cargando ....');
			},
			success :  function(data)
					   {						
							if(data==1){
								
								$("#carga").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-insumos").html('<span class="fa fa-cloud-upload"></span> Cargar');
									
								});
							}  
							else if(data==2){
								
						   $("#carga").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE INSUMOS DE LIMPIEZA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-insumos").html('<span class="fa fa-cloud-upload"></span> Cargar');
																			
								});
							}
							else{
									
				$("#carga").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalCargaMasiva').modal('hide');
			 $("#cargainsumos")[0].reset();
			 $('#insumos').html("");
			 $('#divinsumo').html("");
			 $("#btn-insumos").html('<span class="fa fa-cloud-upload"></span> Cargar');
			 $('#insumos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#insumos').load("consultas?CargaInsumos=si");
			 }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });   
});
/*  FIN DE FUNCION PARA CARGA MASIVA DE INSUMOS */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE INSUMOS */	  
$(document).ready(function()
{ 
     /* validation */
	 $("#saveinsumo").validate({
      rules:
	  {
			codinsumo: { required: true },
			insumo: { required: true },
			codcategoria: { required: true },
			preciocompra: { required: false, number : true},
			precioventa: { required: true, number : true},
			existencia: { required: true, digits : true },
			stockminimo: { required: false, digits : true },
			ivainsumo: { required: true },
			descinsumo: { required: true, number : true },
			fechaexpiracion: { required: false },
			codproveedor: { required: false },
			lote: { required: false },
	   },
       messages:
	   {
			codinsumo: { required: "Ingrese C&oacute;digo de Insumo" },
			insumo:{ required: "Ingrese Nombre o Descripci&oacute;n" },
			codcategoria:{ required: "Seleccione Categoria" },
			preciocompra:{ required: "Ingrese Precio de Compra", number: "Ingrese solo digitos con 2 decimales" },
			precioventa:{ required: "Ingrese Precio de Venta", number: "Ingrese solo digitos con 2 decimales" },
			existencia:{ required: "Ingrese Existencia de Insumo", digits: "Ingrese solo digitos" },
            stockminimo:{ required: "Ingrese Stock Minimo", digits: "Ingrese solo digitos" },
			ivainsumo:{ required: "Seleccione Impuesto de Insumo" },
			descinsumo:{ required: "Ingrese Descuento de Insumo", number: "Ingrese solo digitos con 2 decimales" },
			fechaexpiracion: { required: "Ingrese Fecha de Expiraci&oacute;n" },
			codproveedor: { required: "Seleccione Proveedor" },
			lote:{ required: "Ingrese Lote" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#saveinsumo").serialize();

			var cant = $('#existencia').val();
			cantidad    = parseInt(cant);

        if (cantidad=="" || cantidad==0) {
            
			$("#existencia").focus();
			$('#existencia').val("");
			$('#existencia').css('border-color','#2cabe3');
			swal("Oops", "INGRESE UNA CANTIDAD VALIDA PARA EXISTENCIA EN ALMACEN DE INSUMOS!", "error");
     
            return false;
 
        } else {
			
			$.ajax({
			type : 'POST',
			url  : 'insumos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
									
								});
							}  
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE INSUMO DE LIMPIEZA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalInsumos').modal('hide');
			 $("#saveinsumo")[0].reset();
             $("#proceso").val("save");		
			 $('#insumos').html("");
			 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
			 $('#insumos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#insumos').load("consultas?CargaInsumos=si");
			 }, 200);
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE INSUMOS */




















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE SALIDA DE INSUMOS */	  
$(document).ready(function()
{ 
     /* validation */
	 $("#savesalidainsumos").validate({
      rules:
	  {
			codinsumo: { required: true },
			busquedainsumo: { required: true },
			responsable: { required: true },
			cantsalida: { required: true, digits : true },
	   },
       messages:
	   {
			codinsumo: { required: "Ingrese C&oacute;digo de Producto" },
			busquedainsumo:{ required: "Realice la B&uacute;squeda del Insumo correctamente" },
			responsable:{ required: "Ingrese Nombre de Responsable" },
			cantsalida:{ required: "Ingrese Cantidad de Salida", digits: "Ingrese solo digitos" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#savesalidainsumos").serialize();

			var cant = $('#cantsalida').val();
			var existencia = $('#existencia').val();
			cantidad    = parseInt(cant);

        if (cantidad=="" || cantidad==0) {
            
			$("#cantsalida").focus();
			$('#cantsalida').val("");
			$('#cantsalida').css('border-color','#2cabe3');
			swal("Oops", "INGRESE UNA CANTIDAD VALIDA PARA SALIDA DE INSUMOS DE LIMPIEZA!", "error");
     
            return false;
 
        } else {
			
			$.ajax({
			type : 'POST',
			url  : 'salida_insumos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> REALICE LA B&Uacute;SQUEDA DEL INSUMO CORRECTAMENTE...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
									
								});
							} 
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA CANTIDAD DE SALIDA DE INSUMOS NO PUEDE SER MAYOR QUE LA EXISTENCIA EN ALMACEN, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							}
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ERROR! NO PUEDE REALIZAR EL CAMBIO DE INSUMO DE LIMPIEZA COMO ACTUALIZACI&OacuteN, DEBER&Aacute DE ELIMINAR ESTA SALIDA, Y REALIZAR UN NUEVO REGISTRO DE SALIDA POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalSalida').modal('hide');
			 $("#savesalidainsumos")[0].reset();
             $("#proceso").val("save");		
			 $('#salidainsumos').html("");
			 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
			 $('#salidainsumos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#salidainsumos').load("consultas?CargaSalidaInsumos=si");
			 }, 200);
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */	
    });    
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE SALIDA DE INSUMOS */




















/* FUNCION JQUERY PARA CARGA MASIVA DE PRODUCTOS */	 
$(document).ready(function()
{ 
								
     /* validation */
	 $("#cargaproductos").validate({
      rules:
	  {
			sel_file: { required: true },
	   },
       messages:
	   {
            sel_file:{ required: "Por favor Seleccione Archivo para Cargar" },
       },
	   submitHandler: function(form) {
                     
        var data = $("#cargaproductos").serialize();
		var formData = new FormData($("#cargaproductos")[0]);
		
		$.ajax({
		type : 'POST',
		url  : 'productos.php',
	    async : false,
		data : formData,
		//necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
		beforeSend: function()
		{	
			$("#carga").fadeOut();
			$("#btn-producto").html('<i class="fa fa-spin fa-spinner"></i> Cargando ....');
		},
		success :  function(data)
				   {						
						if(data==1){
							
							$("#carga").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> NO SE HA SELECCIONADO NINGUN ARCHIVO PARA CARGAR, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-producto").html('<span class="fa fa-cloud-upload"></span> Cargar');
								
							});
						}  
						else if(data==2){
							
					   $("#carga").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> ERROR! ARCHIVO INVALIDO PARA LA CARGA MASIVA DE PRODUCTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-producto").html('<span class="fa fa-cloud-upload"></span> Cargar');
																		
							});
						}
						else{
								
			$("#carga").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('body').removeClass('modal-open');
         $('#myModalCargaMasiva').modal('hide');
		 $("#cargaproductos")[0].reset();
         $('#productos').html("");
		 $('#divproducto').html("");
		 $("#btn-producto").html('<span class="fa fa-cloud-upload"></span> Cargar');
		 $('#productos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
		 setTimeout(function() {
		 	$('#productos').load("consultas?CargaProductos=si");
		 }, 200);
								
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */
    });    
});
/*  FIN DE FUNCION PARA CARGA MASIVA DE PRODUCTOS */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PRODUCTOS */	  
$(document).ready(function()
{ 
     /* validation */
	 $("#saveproductos").validate({
	  rules:
	  {
			codproducto: { required: true },
			producto: { required: true },
			codcategoria: { required: false },
			preciocompra: { required: true, number : true},
			precioventa: { required: true, number : true},
			existencia: { required: true, digits : true },
			stockminimo: { required: true, digits : true },
			stockmaximo: { required: true, digits : true },
			ivaproducto: { required: true },
			descproducto: { required: true, number : true },
			codigobarra: { required: false },
			fechaelaboracion: { required: false },
			fechaexpiracion: { required: false },
			codproveedor: { required: true },
			lote: { required: false },
	   },
       messages:
	   {
			codproducto: { required: "Ingrese C&oacute;digo de Producto" },
			producto:{ required: "Ingrese Nombre o Descripci&oacute;n" },
			codcategoria:{ required: "Seleccione Categoria" },
			preciocompra:{ required: "Ingrese Precio de Compra de Producto", number: "Ingrese solo digitos con 2 decimales" },
			precioventa:{ required: "Ingrese Precio de Venta de Producto", number: "Ingrese solo digitos con 2 decimales" },
			existencia:{ required: "Ingrese Existencia de Producto", digits: "Ingrese solo digitos" },
            stockminimo:{ required: "Ingrese Stock Minimo", digits: "Ingrese solo digitos" },
            stockmaximo:{ required: "Ingrese Stock Maximo", digits: "Ingrese solo digitos" },
			ivaproducto:{ required: "Seleccione Impuesto de Producto" },
			descproducto:{ required: "Ingrese Descuento de Producto", number: "Ingrese solo digitos con 2 decimales" },
			codigobarra: { required: "Ingrese C&oacute;digo de Barra" },
			fechaelaboracion: { required: "Ingrese Fecha de Elaboraci&oacute;n" },
			fechaexpiracion: { required: "Ingrese Fecha de Expiraci&oacute;n" },
			codproveedor: { required: "Seleccione Proveedor" },
			lote:{ required: "Ingrese N&deg; de Lote" },
       },
	   submitHandler: function(form) {
                     
                var data = $("#saveproductos").serialize();
				var formData = new FormData($("#saveproductos")[0]);

				var cant = $('#existencia').val();
				var compra = $('#preciocompra').val();
				var venta = $('#precioventa').val();
				cantidad    = parseInt(cant);
	
	        if (venta==0.00 || venta==0) {
	            
				$("#precioventa").focus();
				$('#precioventa').val("");
				$('#precioventa').css('border-color','#2cabe3');
				swal("Oops", "INGRESE UN COSTO VALIDO PARA EL PRECIO DE VENTA DE PRODUCTO!", "error");
         
                return false;

            } else if (parseFloat(compra) > parseFloat(venta)) {
	            
				$("#precioventa").focus();
				$("#preciocompra").focus();
				$('#precioventa').css('border-color','#2cabe3');
				$('#preciocompra').css('border-color','#2cabe3');
				swal("Oops", "EL PRECIO DE COMPRA NO PUEDE SER MAYOR QUE EL PRECIO DE VENTA DEL PRODUCTO!", "error");
         
                return false;
		
			} else  if (cantidad=="" || cantidad==0) {
	            
				$("#existencia").focus();
				$('#existencia').val("");
				$('#existencia').css('border-color','#2cabe3');
				swal("Oops", "INGRESE UNA CANTIDAD VALIDA PARA EXISTENCIA EN ALMACEN DE PRODUCTO!", "error");
         
                return false;
	 
	        } else {
				
				$.ajax({
				type : 'POST',
				url  : 'forproducto.php',
			    async : false,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE PRODUCTO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });
				 $("#saveproductos")[0].reset();
				 $("#modelos").html("");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
									});
								}
						   }
				});
				return false;
			}
		}
	   /* form submit */
    });	     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PRODUCTOS */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE PRODUCTOS */	  
$(document).ready(function()
{ 
     /* validation */
	 $("#updateproductos").validate({
	  rules:
	  {
			codproducto: { required: true },
			producto: { required: true },
			codcategoria: { required: false },
			preciocompra: { required: true, number : true},
			precioventa: { required: true, number : true},
			existencia: { required: true, digits : true },
			stockminimo: { required: true, digits : true },
			stockmaximo: { required: true, digits : true },
			ivaproducto: { required: true, },
			descproducto: { required: true, number : true },
			codigobarra: { required: false },
			fechaelaboracion: { required: false },
			fechaexpiracion: { required: false },
			codproveedor: { required: true },
			lote: { required: false },
	   },
       messages:
	   {
			codproducto: { required: "Ingrese C&oacute;digo de Producto" },
			producto:{ required: "Ingrese Nombre o Descripci&oacute;n" },
			codcategoria:{ required: "Seleccione Categoria" },
			preciocompra:{ required: "Ingrese Precio de Compra de Producto", number: "Ingrese solo digitos con 2 decimales" },
			precioventa:{ required: "Ingrese Precio de Venta de Producto", number: "Ingrese solo digitos con 2 decimales" },
			existencia:{ required: "Ingrese Cantidad o Existencia de Producto", digits: "Ingrese solo digitos" },
            stockminimo:{ required: "Ingrese Stock Minimo", digits: "Ingrese solo digitos" },
            stockmaximo:{ required: "Ingrese Stock Maximo", digits: "Ingrese solo digitos" },
			ivaproducto:{ required: "Seleccione Impuesto de Producto" },
			descproducto:{ required: "Ingrese Descuento de Producto", number: "Ingrese solo digitos con 2 decimales" },
			codigobarra: { required: "Ingrese C&oacute;digo de Barra" },
			fechaelaboracion: { required: "Ingrese Fecha de Elaboraci&oacute;n" },
			fechaexpiracion: { required: "Ingrese Fecha de Expiraci&oacute;n" },
			codproveedor: { required: "Seleccione Proveedor" },
			lote:{ required: "Ingrese N&deg; de Lote" },
       },
	   submitHandler: function(form) {
                     
               var data = $("#updateproductos").serialize();
				var formData = new FormData($("#updateproductos")[0]);
				var id= $("#updateproductos").attr("data-id");
		        var codproducto = id;

				var cant = $('#existencia').val();
				var compra = $('#preciocompra').val();
				var venta = $('#precioventa').val();
				cantidad    = parseInt(cant);
	
	        if (venta==0.00 || venta==0) {
	            
				$("#precioventa").focus();
				$('#precioventa').val("");
				$('#precioventa').css('border-color','#2cabe3');
				swal("Oops", "INGRESE UN COSTO VALIDO PARA EL PRECIO DE VENTA DE PRODUCTO!", "error");

                return false;

            } else if (parseFloat(compra) > parseFloat(venta)) {
	            
				$("#precioventa").focus();
				$("#preciocompra").focus();
				$('#precioventa').css('border-color','#2cabe3');
				$('#preciocompra').css('border-color','#2cabe3');
				swal("Oops", "EL PRECIO DE COMPRA NO PUEDE SER MAYOR QUE EL PRECIO DE VENTA DEL PRODUCTO!", "error");
         
                return false;
		
			} else  if (cantidad=="" || cantidad==0) {
	            
				$("#existencia").focus();
				$('#existencia').val("");
				$('#existencia').css('border-color','#2cabe3');
				swal("Oops", "INGRESE UNA CANTIDAD VALIDA PARA EXISTENCIA EN ALMACEN DE PRODUCTO!", "error");
         
                return false;
	
	 
	        } else {
				
				$.ajax({
				type : 'POST',
				url  : 'forproducto.php?codproducto='+codproducto,
			    async : false,
				data : formData,
				//necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE PRODUCTO YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								}
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'success',
                 timeout: 5000, });
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				 setTimeout("location.href='productos'", 5000);	
									});
								}
						   }
				});
				return false;
			}
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR ACTUALIZACION DE PRODUCTOS */

















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE COMPRAS */	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savecompras").validate({
      rules:
	  {
			codcompra: { required: true },
			fechaemision: { required: true },
			fecharecepcion: { required: true },
			codproveedor: { required: true },
			tipocompra: { required: true },
			formacompra: { required: true },
			fechavencecredito: { required: true },
	   },
       messages:
	   {
            codcompra:{ required: "Ingrese N&deg; de Compra" },
			fechaemision:{ required: "Ingrese Fecha de Emisi&oacute;n" },
			fecharecepcion:{ required: "Ingrese Fecha de Recepci&oacute;n" },
			codproveedor:{ required: "Seleccione Proveedor" },
			tipocompra:{ required: "Seleccione Tipo Compra" },
			formacompra:{ required: "Seleccione Forma de Pago" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#savecompras").serialize();
		    var nuevaFila ="<tr>"+"<td class='text-center' colspan=9><h4>NO HAY DETALLES AGREGADOS</h4></td>"+"</tr>";
		    var total = $('#txtTotal').val();
	
	        if (total==0.00) {
	            
	           $("#busquedaproductoc").focus();
               $('#busquedaproductoc').css('border-color','#2cabe3');
	           swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA COMPRA DE PRODUCTOS!", "error");
       
               return false;
	 
	        } else {
				
				$.ajax({
				type : 'POST',
				url  : 'forcompra.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LA FECHA DE VENCIMIENTO DE COMPRA A CREDITO, NO PUEDE SER MENOR QUE LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								} 
								else if(data==3){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA COMPRAS DE PRODUCTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								} 
								else if(data==4){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> ESTE CODIGO DE COMPRA YA SE ENCUENTRA REGISTRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																				
									});
								}
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 8000, });
				 $("#savecompras")[0].reset();
				 $("#carrito tbody").html("");
				 $(nuevaFila).appendTo("#carrito tbody");
				 $("#lblsubtotal").text("0.00");
				 $("#lblsubtotal2").text("0.00");
				 $("#lbliva").text("0.00");
				 $("#lbldescuento").text("0.00");
				 $("#lbltotal").text("0.00");
				 $("#txtsubtotal").val("0.00");
				 $("#txtsubtotal2").val("0.00");
				 $("#txtIva").val("0.00");
				 $("#txtDescuento").val("0.00");
				 $("#txtTotal").val("0.00");
				 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');	
										
									});
								}
						   }
				});
				return false;
			 }
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE COMPRAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE COMPRAS */	 
$(document).ready(function()
{ 
     /* validation */
$("#updatecompras").validate({
       rules:
	  {
			codcompra: { required: true },
			fechaemision: { required: true },
			fecharecepcion: { required: true },
			codproveedor: { required: true },
			tipocompra: { required: true },
			formacompra: { required: true },
			fechavencecredito: { required: true },
	   },
       messages:
	   {
            codcompra:{ required: "Ingrese N&deg; de Compra" },
			fechaemision:{ required: "Ingrese Fecha de Emisi&oacute;n" },
			fecharecepcion:{ required: "Ingrese Fecha de Recepci&oacute;n" },
			codproveedor:{ required: "Seleccione Proveedor" },
			tipocompra:{ required: "Seleccione Tipo Compra" },
			formacompra:{ required: "Seleccione Forma de Pago" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
       },
	   submitHandler: function(form) {

			var data = $("#updatecompras").serialize();
            var id= $("#updatecompras").attr("data-id");
            var codcompra = $('#compra').val();
            var status = $('#status').val();

				$.ajax({
				type : 'POST',
				url  : 'forcompra.php',
				async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-update").html('<i class="fa fa-refresh"></i> Verificando...');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> LA FECHA DE VENCIMIENTO DE COMPRA A CREDITO, NO PUEDE SER MENOR QUE LA FECHA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								} 
								else if(data==3){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> NO DEBEN DE EXISTIR DETALLES DE COMPRAS CON CANTIDAD IGUAL A CERO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
																				
									});
								} 
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 8000, });
				 $('#detallescomprasupdate').load("funciones.php?MuestraDetallesComprasUpdate=si&codcompra="+codcompra); 
				 $("#btn-update").html('<span class="fa fa-edit"></span> Actualizar');
				 if (status=="P") {
				 	setTimeout("location.href='compras'", 5000);
				 } else {
				 	setTimeout("location.href='cuentasxpagar'", 5000);
				 }
									});
								}
						   },
                error: function () {
                       $("#save").text("Ha ocurrido un error!");
                }
			});
				return false;
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR ACTUALIZACION DE COMPRAS */ 




















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CAJAS PARA VENTAS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savecaja").validate({
      rules:
	  {
			nrocaja: { required: true },
			nomcaja: { required: true },
			codigo: { required: true },
	   },
       messages:
	   {
			serie:{ required: "Ingrese Secuencia de Serie", digits: "Ingrese solo digitos", maxlength: "Ingrese 6 digitos como m&aacute;ximo" },
            nrocaja:{ required: "Ingrese N&deg; de Caja" },
            nomcaja:{ required: "Ingrese Nombre de Caja" },
			codigo:{ required: "Seleccione Responsable de Caja" },
       },
	   submitHandler: function(form) {
                     
           var data = $("#savecaja").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'cajas.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				$("#btn-submit").html('<i class="fa fa-refresh"></i> Verificando...');
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
									
								});
							} 
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE N&deg; DE CAJA YA SE ENCUENTRA ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE NOMBRE DE CAJA YA SE ENCUENTRA ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							}
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE USUARIO YA TIENE UNA CAJA ASIGNADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalCaja').modal('hide');
			 $("#savecaja")[0].reset();
             $("#proceso").val("save");
			 $('#cajas').html("");
			 $("#btn-submit").html('<span class="fa fa-save"></span> Guardar');
			 $('#cajas').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#cajas').load("consultas?CargaCajas=si");
			 }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CAJAS PARA VENTAS */


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE ARQUEO DE CAJAS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savearqueo").validate({
      rules:
	  {
			codcaja: { required: true },
			fecharegistro: { required: true },
			montoinicial: { required: true, number : true},
	   },
       messages:
	   {
			codcaja: { required: "Seleccione Caja para Arqueo" },
			fecharegistro:{ required: "Ingrese Hora de Apertura", number: "Ingrese solo digitos con 2 decimales" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
       },
	   submitHandler: function(form) {
                     
           var data = $("#savearqueo").serialize();
			
			$.ajax({
			type : 'POST',
			url  : 'arqueos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> YA EXISTE UN ARQUEO DE ESTA CAJA DE COBRO ACTUALMENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalArqueo').modal('hide');
			 $("#savearqueo")[0].reset();
			 $('#arqueos').html("");
			 $("#btn-submit").attr('disabled', false);
			 $('#arqueos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#arqueos').load("consultas?CargaArqueos=si");
			 }, 200);
									
								});
							}
					   }
			});
			return false;
		}
	   /* form submit */
    });	     
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE ARQUEO DE CAJAS */

/* FUNCION JQUERY PARA VALIDAR CERRAR ARQUEO DE CAJAS  */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#savecerrararqueo").validate({
      rules:
	  {
			fecharegistro: { required: true },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
			comentarios: { required: false },
	   },
       messages:
	   {
			fecharegistro:{ required: "Ingrese Hora de Apertura", number: "Ingrese solo digitos con 2 decimales" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
			comentarios: { required: "Ingrese Observaci&oacute;n de Cierre" },
       },
	   submitHandler: function(form) {
	   			
		var data = $("#savecerrararqueo").serialize();
		var dineroefectivo = $('#dineroefectivo').val();

        if (dineroefectivo==0.00 || dineroefectivo==0) {
            
			$("#dineroefectivo").focus();
			$('#dineroefectivo').val("");
			$('#dineroefectivo').css('border-color','#ff7676');
			swal("Oops", "POR FAVOR INGRESE UN MONTO VALIDO PARA EFECTIVO DISPONIBLE EN CAJA!", "error");
     
            return false;
 
        } else {
			
			$.ajax({
			type : 'POST',
			url  : 'arqueos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-cerrar").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-cerrar").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR INGRESE UN MONTO VALIDO PARA EFECTIVO DISPONIBLE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-cerrar").attr('disabled', false);
																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('#myModalCerrarCaja').modal('hide');
			 $("#savecerrararqueo")[0].reset();
			 $('#arqueos').html("");
			 $("#btn-cerrar").attr('disabled', false);
			 $('#arqueos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             	$('#arqueos').load("consultas?CargaArqueos=si");
             }, 200);
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR CERRAR ARQUEO DE CAJAS */

/* FUNCION JQUERY PARA VALIDAR ACTUALIZAR ARQUEO DE CAJAS  */	 
$('document').ready(function()
{ 
     /* validation */
	 $("#updatearqueo").validate({
      rules:
	  {
			fecharegistro: { required: true },
			montoinicial: { required: true, number : true},
			dineroefectivo: { required: true, number : true},
			comentarios: { required: false },
	   },
       messages:
	   {
			fecharegistro:{ required: "Ingrese Hora de Apertura", number: "Ingrese solo digitos con 2 decimales" },
			montoinicial:{ required: "Ingrese Monto Inicial", number: "Ingrese solo digitos con 2 decimales" },
			dineroefectivo:{ required: "Ingrese Monto en Efectivo", number: "Ingrese solo digitos con 2 decimales" },
			comentarios: { required: "Ingrese Observaci&oacute;n de Cierre" },
       },
	   submitHandler: function(form) {
	   			
		var data = $("#updatearqueo").serialize();
		var dineroefectivo = $('#dineroefectivo2').val();

        if (dineroefectivo==0.00 || dineroefectivo==0) {
            
			$("#dineroefectivo2").focus();
			$('#dineroefectivo2').val("");
			$('#dineroefectivo2').css('border-color','#ff7676');
			swal("Oops", "POR FAVOR INGRESE UN MONTO VALIDO PARA EFECTIVO DISPONIBLE EN CAJA!", "error");
     
            return false;
 
        } else {
			
			$.ajax({
			type : 'POST',
			url  : 'arqueos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-update").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-update").attr('disabled', false);
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR INGRESE UN MONTO VALIDO PARA EFECTIVO DISPONIBLE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
             $("#btn-update").attr('disabled', false);																			
								});
							}
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('#myModalUpdateArqueo').modal('hide');
			 $("#updatearqueo")[0].reset();
			 $('#arqueos').html("");
			 $("#btn-update").attr('disabled', false);			 
			 $('#arqueos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
             setTimeout(function() {
             	$('#arqueos').load("consultas?CargaArqueos=si");
             }, 200);
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR ACTUALIZAR ARQUEO DE CAJAS */


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MOVIMIENTOS EN CAJAS */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savemovimiento").validate({
      rules:
	  {
			codcaja: { required: true },
			tipomovimiento: { required: true },
			descripcionmovimiento: { required: true },
			montomovimiento: { required: true, number : true },
			codmediopago: { required: true },
	   },
       messages:
	   {
			codcaja:{ required: "Seleccione Caja" },
            tipomovimiento:{ required: "Seleccione Tipo de Movimiento" },
			descripcionmovimiento:{ required: "Ingrese Descripci&oacute;n de Movimiento" },
			montomovimiento:{ required: "Ingrese Monto de Movimiento", number: "Ingrese solo digitos con 2 decimales" },
			codmediopago:{ required: "Seleccione Medio de Pago" },
       },
	   submitHandler: function(form) {
                     
           var data = $("#savemovimiento").serialize();
			var monto = $('#montomovimiento').val();

        if (monto==0.00 || monto==0) {
            
			$("#montomovimiento").focus();
			$('#montomovimiento').val("");
			$('#montomovimiento').css('border-color','#2cabe3');
			swal("Oops", "POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO EN CAJA!", "error");

            return false;

        } else {
			
			$.ajax({
			type : 'POST',
			url  : 'movimientos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR INGRESE UN MONTO VALIDO PARA MOVIMIENTO EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}   
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO PUEDE REALIZAR CAMBIO EN EL TIPO Y MEDIO DE MOVIMIENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTA CAJA NO SE ENCUENTRA ABIERTA PARA REALIZAR MOVIMIENTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==5){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL MOVIMIENTO DE EGRESO DEBE DE SER SOLO EFECTIVO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL MONTO A RETIRAR EN EFECTIVO NO EXISTE EN CAJA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==7){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> ESTE MOVIMIENTO NO PUEDE SER ACTUALIZADO, EL ARQUEO DE CAJA ASOCIADO SE ENCUENTRA CERRADO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							} 
							 else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalMovimiento').modal('hide');
			 $("#savemovimiento")[0].reset();
             $("#proceso").val("save");	
			 $('#movimientos').html("");
			 $("#btn-submit").attr('disabled', false);
			 $('#movimientos').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 	$('#movimientos').load("consultas?CargaMovimientos=si");
			 }, 200);
									
								});
							}
					   }
				});
				return false;
			}		}
	   /* form submit */
    });	
      
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE MOVIMIENTOS EN CAJAS */




























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CLIENTES EN RESERVACIONES */	  
$(document).ready(function()
{ 
        jQuery.validator.addMethod("lettersonly", function(value, element) {
          return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
        });

     /* validation */
	 $("#clientereservacion").validate({
        rules:
	    {
			documcliente: { required: false },
			dnicliente: { required: true, digits : false },
			nomcliente: { required: true, lettersonly: true },
			paiscliente: { required: true },
			ciudadcliente: { required: true },
			direccliente: { required: true },
			telefcliente: { required: true, digits : false },
			correocliente: { required: true, email: true },
			limitecredito: { required: true, number : true},
	    },
        messages:
	    {
            documcliente:{ required: "Seleccione Tipo de Documento" },
            dnicliente:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos"  },
			nomcliente:{ required: "Ingrese Nombre de Cliente" },
			paiscliente:{ required: "Seleccione Pais donde Vive" },
			ciudadcliente:{ required: "Ingrese Ciudad donde Vive" },
			direccliente:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			telefcliente:{ required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos"  },
			correocliente:{ required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
			limitecredito:{ required: "Ingrese Limite de Cr&eacute;dito", number: "Ingrese solo digitos con 2 decimales" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#clientereservacion").serialize();
		
		$.ajax({
		type : 'POST',
		url  : 'foreservacion.php',
	    async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-cliente").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-cliente").attr('disabled', false);
								
							});
						}  
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UN CLIENTE CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-cliente").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('#myModalCliente').modal('hide');
		 $("#clientereservacion")[0].reset();
		 $("#btn-cliente").attr('disabled', false);
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */
    });	
      
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CLIENTES EN RESERVACIONES */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE RESERVACIONES */	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savereservaciones").validate({
      rules:
	  {
			desde: { required: true, date : true },
			hasta: { required: true, date : true },
			busqueda: { required: false },
			status: { required: true },
			tipodocumento: { required: true },
			montopagado: { required: true },
			nrotarjeta: { required: true, creditcard: true },
			tipotarjeta: { required: true },
			expira: { required: true  },
			codverifica: { required: true, digits : true, minlength: 3, maxlength: 4},
			nrotransferencia: { required: true },
			cheque: { required: true },
			bancocheque: { required: true },
			fechavencecredito: { required: true },
			montoabono: { required: true },
			observaciones: { required: false },
	   },
       messages:
	   {
            desde:{ required: "Ingrese Fecha de Entrada", date: "Ingrese fecha Valida"  },
			hasta:{ required: "Ingrese Fecha de Salida", date: "Ingrese fecha Valida"  },
			busqueda:{ required: "Realice la B&uacute;squeda del Cliente correctamente" },
			status:{ required: "Seleccione Status" },
			tipodocumento:{ required: "Seleccione Tipo de Documento" },
			montopagado:{ required: "Ingrese Monto Pagado" },
            nrotarjeta:{ required: "Ingrese N&deg; de Tarjeta de Cr&eacute;dito v&aacute;lida", creditcard: "Por favor, introduzca un N&deg; de Tarjeta de Cr&eacute;dito v&aacute;lida" },
			tipotarjeta:{ required: "Ingrese Tipo de Tarjeta de Cr&eacute;dito" },
			expira:{ required: "Ingrese Fecha de Expiraci&oacute;n" },
            codverifica:{ required: "Ingrese C&oacute;digo de Verificaci&oacute;n", digits: "Ingrese solo digitos", minlength: "Ingrese 4 digitos como minimo", maxlength: "Ingrese 4 digitos como maximo" },
			nrotransferencia:{ required: "Ingrese N&deg; de Transferencia o Recibo" },
			cheque:{ required: "Ingrese N&deg; de Cheque" },
			bancocheque:{ required: "Ingrese Nombre de Banco de Cheque" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{ required: "Ingrese Monto de Abono" },
			observaciones: { required: "Ingrese Observaciones de Pago" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#savereservaciones").serialize();
			var formData = new FormData($("#savereservaciones")[0]);
		    var Cliente = $('#codcliente').val();
		    var TotalPago = $('#txtTotal').val();
		    var TotalAbono = $('#montoabono').val();
		    var CreditoInicial = $('#creditoinicial').val();
		    var CreditoDisponible = $('#creditodisponible').val();
		    var TipoPago = $('#tipopago').val();

		if (Cliente == "") {
	            
            swal("Oops", "POR FAVOR ASIGNE UN CLIENTE A ESTA RESERVACION!", "error");

            return false;
	 
	    } else if (TotalPago==0.00) {
	            
            swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA RESERVACION!", "error");

            return false;
	 
	    } else if (TipoPago=="TARJETA" && validatecardfunc() == false) {
	            
	        $("#nrotarjeta").focus();
	        $('#tarjeta').val("");
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "POR FAVOR, INGRESA UN NUMERO DE TARJETA DE CREDITO VALIDA, VERIFIQUE POR FAVOR!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && CreditoInicial!="0.00" && parseFloat(TotalPago-TotalAbono) > parseFloat(CreditoDisponible)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA RESERVACIONES, VERIFIQUE Y CANCELE SUS DEUDAS POR FAVOR!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && parseFloat(TotalAbono) >= parseFloat(TotalPago)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR!", "error");

            return false;
	 
	    } else {
	 				
			$.ajax({
			type : 'POST',
			url  : 'foreservacion.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA REALIZAR RESERVACIONES, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA RESERVACIONES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE CARGAR LA IMAGEN DEL COMPROBANTE DE TRANSFERENCIA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==5){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA IMAGEN CARGADA DEBE DE TENER FORMATO JPEG O JPG, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}


							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE INGRESAR UN NUMERO DE TARJETA DE CREDITO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==7){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL CODIGO DE VERIFICACION PARA LA TARJETA AMERICAN EXPRESS, DEBE DE CONTENER 4 DIGITOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==8){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL CODIGO DE VERIFICACION PARA LAS TARJETAS VISA, MASTERCARD Y DINERS, DEBE DE CONTENER 3 DIGITOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==9){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL NUMERO DE TARJETA INGRESADO ES INVALIDO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==10){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA FECHA DE VENCIMIENTO DE CREDITO NO PUEDER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==11){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR ASIGNE UN CLIENTE A ESTA RESERVACION A CREDITO PARA CONTROL DE ABONOS DEL MISMO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==12){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA RESERVACIONES, VERIFIQUE SU CREDITO DISPONIBLE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==13){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
		    $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 8000, });
			 $("#savereservaciones")[0].reset();
			 $("#muestrahabitaciones").html("");
			 $("#muestradetallesreservacion").html("");
		     $("#btn-submit").attr('disabled', false);	
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE RESERVACIONES */





























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CLIENTES EN RESERVACIONES EN PAGINA */	  
$(document).ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
       return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
    });

     /* validation */
	 $("#clientesweb").validate({
        rules:
	    {
			documcliente: { required: false },
			dnicliente: { required: true, digits : false },
			nomcliente: { required: true, lettersonly: true },
			paiscliente: { required: true },
			ciudadcliente: { required: true },
			direccliente: { required: true },
			telefcliente: { required: true, digits : false },
			correocliente: { required: true, email: true },
			limitecredito: { required: true, number : true},
	    },
        messages:
	    {
            documcliente:{ required: "Seleccione Tipo de Documento" },
            dnicliente:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos"  },
			nomcliente:{ required: "Ingrese Nombre de Cliente" },
			paiscliente:{ required: "Seleccione Pais donde Vive" },
			ciudadcliente:{ required: "Ingrese Ciudad donde Vive" },
			direccliente:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
			telefcliente:{ required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos"  },
			correocliente:{ required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
			limitecredito:{ required: "Ingrese Limite de Cr&eacute;dito", number: "Ingrese solo digitos con 2 decimales" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#clientesweb").serialize();
	    var dnicliente = $('#dnicliente').val();
		$("#busqueda").val(dnicliente);
		
		$.ajax({
		type : 'POST',
		url  : 'booking.php',
	    async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-cliente").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-cliente").attr('disabled', false);
								
							});
						}  
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UN CLIENTE CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-cliente").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('#myModalCliente').modal('hide');
		 $("#clientesweb")[0].reset();
		 $("#search_button").trigger("click");
		 $("#btn-cliente").attr('disabled', false);
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */
    });	
      
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CLIENTES EN RESERVACIONES EN PAGINA */


/* FUNCION JQUERY PARA VALIDAR REGISTRO DE RESERVACIONES EN PAGINA*/	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savereservacionesweb").validate({
      rules:
	  {
			desde: { required: true, date : true },
			hasta: { required: true, date : true },
			busqueda: { required: true },
			status: { required: true },
			tipodocumento: { required: true },
			montopagado: { required: true },
			nrotarjeta: { required: true, creditcard: true },
			tipotarjeta: { required: true },
			expira: { required: true  },
			codverifica: { required: true, digits : true, minlength: 3, maxlength: 4},
			nrotransferencia: { required: true },
			cheque: { required: true },
			bancocheque: { required: true },
			fechavencecredito: { required: true },
			montoabono: { required: true },
			observaciones: { required: false },
	   },
       messages:
	   {
            desde:{ required: "Ingrese Fecha de Entrada", date: "Ingrese fecha Valida"  },
			hasta:{ required: "Ingrese Fecha de Salida", date: "Ingrese fecha Valida"  },
			busqueda:{ required: "Realice la B&uacute;squeda del Cliente correctamente" },
			status:{ required: "Seleccione Status" },
			tipodocumento:{ required: "Seleccione Tipo de Documento" },
			montopagado:{ required: "Ingrese Monto Pagado" },
            nrotarjeta:{ required: "Ingrese N&deg; de Tarjeta de Cr&eacute;dito v&aacute;lida", creditcard: "Por favor, introduzca un N&deg; de Tarjeta de Cr&eacute;dito v&aacute;lida" },
			tipotarjeta:{ required: "Ingrese Tipo de Tarjeta de Cr&eacute;dito" },
			expira:{ required: "Ingrese Fecha de Expiraci&oacute;n" },
            codverifica:{ required: "Ingrese C&oacute;digo de Verificaci&oacute;n", digits: "Ingrese solo digitos", minlength: "Ingrese 4 digitos como minimo", maxlength: "Ingrese 4 digitos como minimo" },
			nrotransferencia:{ required: "Ingrese N&deg; de Transferencia o Recibo" },
			cheque:{ required: "Ingrese N&deg; de Cheque" },
			bancocheque:{ required: "Ingrese Nombre de Banco de Cheque" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{ required: "Ingrese Monto de Abono" },
			observaciones: { required: "Ingrese Observaciones de Pago" },
       },
	   submitHandler: function(form) {
                     
            var data = $("#savereservacionesweb").serialize();
			var formData = new FormData($("#savereservacionesweb")[0]);
		    var Cliente = $('#codcliente').val();
		    var TotalPago = $('#txtTotal').val();
		    var TotalAbono = $('#montoabono').val();
		    var CreditoInicial = $('#creditoinicial').val();
		    var CreditoDisponible = $('#creditodisponible').val();
		    var TipoPago = $('#tipopago').val();
		    var Url = $('#url').val();

		if (Cliente == "") {
	            
            swal("Oops", "POR FAVOR ASIGNE UN CLIENTE A ESTA RESERVACION!", "error");

            return false;
	 
	    } else if (TotalPago==0.00) {
	            
            swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA RESERVACION!", "error");

            return false;
	 
	    } else if (Url=="1" && TipoPago=="TARJETA" && validatecardfunc() == false) {
	            
	        $("#nrotarjeta").focus();
	        $('#tarjeta').val("");
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "POR FAVOR, INGRESA UN NUMERO DE TARJETA DE CREDITO VALIDA, VERIFIQUE POR FAVOR!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && CreditoInicial!="0.00" && parseFloat(TotalPago-TotalAbono) > parseFloat(CreditoDisponible)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA RESERVACIONES, VERIFIQUE Y CANCELE SUS DEUDAS POR FAVOR!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && parseFloat(TotalAbono) >= parseFloat(TotalPago)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR!", "error");

            return false;
	 
	    } else {
	 				
			$.ajax({
			type : 'POST',
			url  : 'booking.php',
		    async : false,
			data : formData,
			//necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA REALIZAR RESERVACIONES, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA RESERVACIONES, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE CARGAR LA IMAGEN DEL COMPROBANTE DE TRANSFERENCIA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==5){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA IMAGEN CARGADA DEBE DE TENER FORMATO JPEG O JPG, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}


							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE INGRESAR UN NUMERO DE TARJETA DE CREDITO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==7){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL CODIGO DE VERIFICACION PARA LA TARJETA AMERICAN EXPRESS, DEBE DE CONTENER 4 DIGITOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==8){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL CODIGO DE VERIFICACION PARA LAS TARJETAS VISA, MASTERCARD Y DINERS, DEBE DE CONTENER 3 DIGITOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==9){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL NUMERO DE TARJETA INGRESADO ES INVALIDO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==10){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA FECHA DE VENCIMIENTO DE CREDITO NO PUEDER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==11){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR ASIGNE UN CLIENTE A ESTA RESERVACION A CREDITO PARA CONTROL DE ABONOS DEL MISMO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==12){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA RESERVACIONES, VERIFIQUE SU CREDITO DISPONIBLE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==13){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 8000, });
			 $("#savereservacionesweb")[0].reset();
			 $("#muestrahabitaciones").html("");
			 $("#muestradetallesreservacion").html("");
			 $('html, body').animate({scrollTop:0}, 1000);
			 $("#btn-submit").attr('disabled', false);
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    });   	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE RESERVACIONES EN PAGINA */


















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CLIENTES EN VENTAS */	  
$(document).ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
    });

 /* validation */
 $("#clientepos").validate({
  rules:
  {
		documcliente: { required: false },
		dnicliente: { required: true, digits : false },
		nomcliente: { required: true, lettersonly: true },
		paiscliente: { required: true },
		ciudadcliente: { required: true },
		direccliente: { required: true },
		telefcliente: { required: true, digits : false },
		correocliente: { required: true, email: true },
		limitecredito: { required: true, number : true},
   },
   messages:
   {
        documcliente:{ required: "Seleccione Tipo de Documento" },
        dnicliente:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos"  },
		nomcliente:{ required: "Ingrese Nombre de Cliente" },
		paiscliente:{ required: "Seleccione Pais donde Vive" },
		ciudadcliente:{ required: "Ingrese Ciudad donde Vive" },
		direccliente:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
		telefcliente:{ required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos"  },
		correocliente:{ required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
		limitecredito:{ required: "Ingrese Limite de Cr&eacute;dito", number: "Ingrese solo digitos con 2 decimales" },
   },
	   submitHandler: function(form) {
                     
       var data = $("#clientepos").serialize();
		
		$.ajax({
		type : 'POST',
		url  : 'pos.php',
	    async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-cliente").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-cliente").attr('disabled', false);
								
							});
						}  
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UN CLIENTE CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-cliente").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('#myModalCliente').modal('hide');
		 $("#clientepos")[0].reset();
		 $("#btn-cliente").attr('disabled', false);
							});
						}
				   }
		});
		return false;
		}
	   /* form submit */
	});
    	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CLIENTES EN POS */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE VENTAS EN POS */	 	 
$('document').ready(function()
{ 
     /* validation */
	 $("#savepos").validate({
        rules:
	    {
			busqueda: { required: false },
			tipodocumento: { required: true },
			tipopago: { required: true },
			codmediopago: { required: true },
			montopagado: { required: true },
			fechavencecredito: { required: true },
			montoabono: { required: true },
			observaciones: { required: false },
	    },
        messages:
	    {
            busqueda:{ required: "Realice la B&uacute;squeda del Cliente correctamente" },
			tipodocumento:{ required: "Seleccione Tipo de Documento" },
			tipopago:{ required: "Seleccione Condici&oacute;n de Pago" },
			codmediopago:{ required: "Seleccione Forma de Pago" },
			montopagado:{ required: "Ingrese Monto Pagado" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{ required: "Ingrese Monto de Abono" },
			observaciones: { required: "Ingrese Observaciones en Venta" },
        },
	    submitHandler: function(form) {
	   			
			var data = $("#savepos").serialize();
		    var nuevaFila ="<tr class='warning-element' style='border-left: 2px solid #2cabe3 !important; background: #c2e6f5;'>"+"<td class='text-center' colspan=9><h4>NO HAY DETALLES AGREGADOS</h4></td>"+"</tr>";
		    var TotalPago = $('#txtTotal').val();
		    var TotalAbono = $('#montoabono').val();
		    var CreditoInicial = $('#creditoinicial').val();
		    var CreditoDisponible = $('#creditodisponible').val();
		    var TipoPago = $('input:radio[name=tipopago]:checked').val();

		if (TotalPago==0.00) {
	            
	        $("#search_producto").focus();
            $('#search_producto').css('border-color','#ff7676');
            swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA VENTA DE PRODUCTOS!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && CreditoInicial!="0.00" && parseFloat(TotalPago-TotalAbono) > parseFloat(CreditoDisponible)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#ff7676');
            swal("Oops", "SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS EN ESTA SUCURSAL, VERIFIQUE Y CANCELE SUS DEUDAS POR FAVOR!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && parseFloat(TotalAbono) >= parseFloat(TotalPago)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#ff7676');
            swal("Oops", "EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR!", "error");

            return false;
	 
	    } else {
	 				
			$.ajax({
			type : 'POST',
			url  : 'pos.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA REALIZAR VENTAS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA VENTAS DE PRODUCTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA CANTIDAD SOLICITADA DE PRODUCTOS, NO EXISTE EN ALMACEN, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==5){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR ASIGNE UN CLIENTE A ESTA VENTA DE CREDITO PARA CONTROL DE ABONOS DEL MISMO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA FECHA DE VENCIMIENTO DE CREDITO NO PUEDER SER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==7){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE SU CREDITO DISPONIBLE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
	         $("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 8000, });
			 $("#savepos")[0].reset();
             $("#codcliente").val("0");
             $('#myModalPago').modal('hide');
			 $("#carrito tbody").html("");
			 $(nuevaFila).appendTo("#carrito tbody");
			 $("#lblsubtotal").text("0.00");
			 $("#lblsubtotal2").text("0.00");
			 $("#lbliva").text("0.00");
			 $("#lbldescuento").text("0.00");
			 $("#lbltotal").text("0.00");
             $("#TextImporte").text("0.00");
             $("#TextPagado").text("0.00");
             $("#TextCambio").text("0.00");
			 $("#txtsubtotal").val("0.00");
			 $("#txtsubtotal2").val("0.00");
			 $("#txtIva").val("0.00");
			 $("#txtDescuento").val("0.00");
			 $("#txtTotal").val("0.00");
			 $("#txtTotalCompra").val("0.00");	
			 $("#buttonpago").attr('disabled', true);
             $("#condiciones").load("formas_pagos.php?BuscaCondicionesPagos=si&tipopago=CONTADO&txtTotal=0.00");
			 $("#mediopagos").html("");
             $("#loadproductos").html("");
             $('#loading').load("familias_productos?CargarProductos=si&url=pos"); 
	         $("#btn-submit").attr('disabled', false);
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    }); 	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE VENTAS EN POS */





















/* FUNCION JQUERY PARA VALIDAR REGISTRO DE CLIENTES EN VENTAS */	  
$(document).ready(function()
{ 
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-ZÒ—·ÈÌÛ˙¡…Õ”⁄,. ]+$/i.test(value);
    });

 /* validation */
 $("#clienteventa").validate({
  rules:
  {
		documcliente: { required: false },
		dnicliente: { required: true, digits : false },
		nomcliente: { required: true, lettersonly: true },
		paiscliente: { required: true },
		ciudadcliente: { required: true },
		direccliente: { required: true },
		telefcliente: { required: true, digits : false },
		correocliente: { required: true, email: true },
		limitecredito: { required: true, number : true},
   },
   messages:
   {
        documcliente:{ required: "Seleccione Tipo de Documento" },
        dnicliente:{ required: "Ingrese N&deg; de Documento", digits: "Ingrese solo digitos"  },
		nomcliente:{ required: "Ingrese Nombre de Cliente" },
		paiscliente:{ required: "Seleccione Pais donde Vive" },
		ciudadcliente:{ required: "Ingrese Ciudad donde Vive" },
		direccliente:{ required: "Ingrese Direcci&oacute;n Domiciliaria" },
		telefcliente:{ required: "Ingrese Telefono de Cliente", digits: "Ingrese solo digitos"  },
		correocliente:{ required: "Ingrese Email de Cliente", email: "Ingrese un Email Valido" },
		limitecredito:{ required: "Ingrese Limite de Cr&eacute;dito", number: "Ingrese solo digitos con 2 decimales" },
   },
	   submitHandler: function(form) {
                     
       var data = $("#clienteventa").serialize();
		
		$.ajax({
		type : 'POST',
		url  : 'forventa.php',
	    async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-cliente").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
	    $("#btn-cliente").attr('disabled', false);
								
							});
						}  
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> YA EXISTE UN CLIENTE CON ESTE N&deg; DE DOCUMENTO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
	    $("#btn-cliente").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('#myModalCliente').modal('hide');
		 $("#clienteventa")[0].reset();
	     $("#btn-cliente").attr('disabled', false);
							});
						}
				   }
		});
		return false;
		}
	   /* form submit */
	});	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE CLIENTES EN VENTAS */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE VENTAS */	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#saveventas").validate({
        rules:
	    {
			busqueda: { required: false },
			tipodocumento: { required: true },
			tipopago: { required: true },
			codmediopago: { required: true },
			montopagado: { required: true },
			fechavencecredito: { required: true },
			montoabono: { required: true },
			observaciones: { required: false },
	    },
        messages:
	    {
            busqueda:{ required: "Realice la B&uacute;squeda del Cliente correctamente" },
			tipodocumento:{ required: "Seleccione Tipo de Documento" },
			tipopago:{ required: "Seleccione Condici&oacute;n de Pago" },
			codmediopago:{ required: "Seleccione Forma de Pago" },
			montopagado:{ required: "Ingrese Monto Pagado" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{ required: "Ingrese Monto de Abono" },
			observaciones: { required: "Ingrese Observaciones en Venta" },
        },
	    submitHandler: function(form) {
                     
            var data = $("#saveventas").serialize();
		    var nuevaFila ="<tr>"+"<td class='text-center' colspan=9><h4>NO HAY DETALLES AGREGADOS</h4></td>"+"</tr>";
		    var TotalPago = $('#txtTotal').val();
		    var TotalAbono = $('#montoabono').val();
		    var CreditoInicial = $('#creditoinicial').val();
		    var CreditoDisponible = $('#creditodisponible').val();
		    var TipoPago = $('input:radio[name=tipopago]:checked').val();

		if (TotalPago==0.00) {
	            
	        $("#busquedaproductov").focus();
            $('#busquedaproductov').css('border-color','#2cabe3');
            swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA VENTA DE PRODUCTOS!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && CreditoInicial!="0.00" && parseFloat(TotalPago-TotalAbono) > parseFloat(CreditoDisponible)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS EN ESTA SUCURSAL, VERIFIQUE Y CANCELE SUS DEUDAS POR FAVOR!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && parseFloat(TotalAbono) >= parseFloat(TotalPago)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR!", "error");

            return false;
	 
	    } else {
	 				
			$.ajax({
			type : 'POST',
			url  : 'forventa.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA REALIZAR VENTAS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							} 
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA VENTAS DE PRODUCTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA FECHA DE VENCIMIENTO DE CREDITO NO PUEDER SER MENOR QUE LA ACTUAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==5){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR ASIGNE UN CLIENTE A ESTA VENTA DE CREDITO PARA CONTROL DE ABONOS DEL MISMO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS EN ESTA SUCURSAL, VERIFIQUE SU CREDITO DISPONIBLE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							}  
							else if(data==7){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL ABONO DE CREDITO NO PUEDE SER MAYOR O IGUAL QUE EL PAGO TOTAL, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else if(data==8){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA CANTIDAD SOLICITADA DE PRODUCTOS, NO EXISTE EN ALMACEN, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
            $("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 8000, });
			 $("#saveventas")[0].reset();
             $("#codcliente").val("0");
             $('#myModalPago').modal('hide');
			 $("#carrito tbody").html("");
			 $(nuevaFila).appendTo("#carrito tbody");
			 $("#lblsubtotal").text("0.00");
			 $("#lblsubtotal2").text("0.00");
			 $("#lbliva").text("0.00");
			 $("#lbldescuento").text("0.00");
			 $("#lbltotal").text("0.00");
             $("#TextImporte").text("0.00");
             $("#TextPagado").text("0.00");
             $("#TextCambio").text("0.00");
			 $("#txtsubtotal").val("0.00");
			 $("#txtsubtotal2").val("0.00");
			 $("#txtIva").val("0.00");
			 $("#txtDescuento").val("0.00");
			 $("#txtTotal").val("0.00");
			 $("#txtTotalCompra").val("0.00");	
			 $("#buttonpago").attr('disabled', true);
             $("#condiciones").load("formas_pagos.php?BuscaCondicionesPagos=si&tipopago=CONTADO&txtTotal=0.00");
			 $("#mediopagos").html("");
             $("#loadproductos").html(""); 
            $("#btn-submit").attr('disabled', false);
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    });	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE VENTAS */


/* FUNCION JQUERY PARA VALIDAR ACTUALIZACION DE VENTAS */	 
$(document).ready(function()
{ 
     /* validation */
    $("#updateventas").validate({
        rules:
	    {
			busqueda: { required: false },
			tipodocumento: { required: true },
			tipopago: { required: true },
			codmediopago: { required: true },
			montopagado: { required: false },
			fechavencecredito: { required: true },
			montoabono: { required: false },
	    },
        messages:
	    {
            busqueda:{ required: "Realice la B&uacute;squeda del Cliente correctamente" },
			tipodocumento:{ required: "Seleccione Tipo de Documento" },
			tipopago:{ required: "Seleccione Condici&oacute;n de Pago" },
			codmediopago:{ required: "Seleccione Forma de Pago" },
			montopagado:{ required: "Ingrese Monto Pagado" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{ required: "Ingrese Monto de Abono" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#updateventas").serialize();
        var id= $("#updateventas").attr("data-id");
        var codventa = $('#venta').val();
			
		$.ajax({
		type : 'POST',
		url  : 'forventa.php',
	    async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-update").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA ACTUALIZAR VENTAS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").attr('disabled', false);
								
							});
						} 
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> EL ARQUEO DE CAJA ASOCIADO A ESTA VENTA, SE ENCUENTRA CERRADA, REALICE UNA NUEVA VENTA POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").attr('disabled', false);
																		
							});
						} 
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").attr('disabled', false);
																		
							});
						}  
						else if(data==4){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA VENTAS AL CLIENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").attr('disabled', false);
																		
							});
						} 
						else if(data==5){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> LA CANTIDAD SOLICITADA DE PRODUCTOS, NO EXISTE EN ALMACEN, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").attr('disabled', false);
																		
							});
						}
						else if(data==6){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-update").attr('disabled', false);
																		
							});
						}  
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 8000, });
		 $('#detallesventasupdate').load("funciones.php?MuestraDetallesVentasUpdate=si&codventa="+codventa); 
		 $("#btn-update").attr('disabled', false);
		 setTimeout("location.href='ventas'", 15000);											
							});
						}
				   }
			});
			return false;
		}
	   /* form submit */
    });	 
});
/*  FIN DE FUNCION PARA VALIDAR ACTUALIZACION DE VENTAS */


/* FUNCION JQUERY PARA VALIDAR AGREGAR DETALLES A VENTAS */	 
$(document).ready(function()
{ 
    /* validation */
    $("#agregaventas").validate({
        rules:
	    {
			busqueda: { required: false },
			tipodocumento: { required: true },
			tipopago: { required: true },
			codmediopago: { required: true },
			montopagado: { required: false },
			fechavencecredito: { required: true },
			montoabono: { required: false },
	    },
        messages:
	    {
            busqueda:{ required: "Realice la B&uacute;squeda del Cliente correctamente" },
			tipodocumento:{ required: "Seleccione Tipo de Documento" },
			tipopago:{ required: "Seleccione Condici&oacute;n de Pago" },
			codmediopago:{ required: "Seleccione Forma de Pago" },
			montopagado:{ required: "Ingrese Monto Pagado" },
			fechavencecredito:{ required: "Ingrese Fecha Vence Cr&eacute;dito" },
			montoabono:{ required: "Ingrese Monto de Abono" },
        },
	    submitHandler: function(form) {
                     
            var data = $("#agregaventas").serialize();
            var nuevaFila ="<tr>"+"<td class='text-center' colspan=9><h4>NO HAY DETALLES AGREGADOS</h4></td>"+"</tr>";
            var id= $("#agregaventas").attr("data-id");
            var codventa = $('#venta').val();
		    var TotalPago = $('#txtTotal').val();
		    var CreditoInicial = $('#creditoinicial').val();
		    var CreditoDisponible = $('#creditodisponible').val();
		    var TipoPago = $('input:radio[name=tipopago]:checked').val();

		if (TotalPago==0.00) {
	            
	        $("#busquedaproductov").focus();
            $('#busquedaproductov').css('border-color','#2cabe3');
            swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA VENTA DE PRODUCTOS!", "error");

            return false;
	 
	    } else if (TipoPago=="CREDITO" && CreditoInicial!="0.00" && parseFloat(TotalPago) > parseFloat(CreditoDisponible)) {
	            
	        $("#TotalAbono").focus();
            $('#TotalAbono').css('border-color','#2cabe3');
            swal("Oops", "SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS EN ESTA SUCURSAL, VERIFIQUE Y CANCELE SUS DEUDAS POR FAVOR!", "error");

            return false;
	 
	    } else {
				
			$.ajax({
			type : 'POST',
			url  : 'forventa.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-agregar").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA AGREGAR DETALLES A VENTAS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
									
								});
							}  
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL ARQUEO DE CAJA ASOCIADO A ESTA VENTA, SE ENCUENTRA CERRADA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
																			
								});
							}  
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA VENTAS AL CLIENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
																			
								});
							}  
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO HA INGRESADO DETALLES PARA VENTAS AL CLIENTE, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
																			
								});
							}  
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> SE HA EXCEDIDO DEL LIMITE DE CREDITO PARA COMPRAS DE PRODUCTOS EN ESTA SUCURSAL, VERIFIQUE SU CREDITO DISPONIBLE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
																			
								});
							}   
							else if(data==4){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> NO DEBEN DE EXISTIR DETALLES DE VENTAS CON CANTIDAD IGUAL A CERO, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
																			
								});
							} 
							else if(data==6){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> LA CANTIDAD SOLICITADA DE PRODUCTOS, NO EXISTE EN ALMACEN, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-agregar").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 8000, });
			 $("#agregaventas")[0].reset();
			 $("#carrito tbody").html("");
			 $(nuevaFila).appendTo("#carrito tbody");
			 $("#lblsubtotal").text("0.00");
			 $("#lblsubtotal2").text("0.00");
			 $("#lbliva").text("0.00");
			 $("#lbldescuento").text("0.00");
			 $("#lbltotal").text("0.00");
             $("#TextImporte").text("0.00");
             $("#TextPagado").text("0.00");
             $("#TextCambio").text("0.00");
			 $("#txtsubtotal").val("0.00");
			 $("#txtsubtotal2").val("0.00");
			 $("#txtIva").val("0.00");
			 $("#txtDescuento").val("0.00");
			 $("#txtTotal").val("0.00");
			 $("#txtTotalCompra").val("0.00");		 
			 $('#detallesventasagregar').load("funciones.php?MuestraDetallesVentasAgregar=si&codventa="+codventa);  
             $("#loadproductos").load("funciones.php?prod_familias=si");
		     $("#btn-agregar").attr('disabled', false);
			 setTimeout("location.href='ventas'", 15000);	
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */	
    });
});
/* FUNCION JQUERY PARA VALIDAR AGREGAR DETALLES A VENTAS */	 





























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PAGOS A CREDITOS EN RESERVACIONES */	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savepagoreservaciones").validate({
        rules:
	    {
			codcliente: { required: false },
			montoabono: { required: true, number : true},
	    },
        messages:
	    {
            codcliente:{ required: "Por favor seleccione al Cliente correctamente" },
			montoabono:{ required: "Ingrese Monto de Abono", number: "Ingrese solo digitos con 2 decimales" },
        },
	    submitHandler: function(form) {
                     
            var data = $("#savepagoreservaciones").serialize();
		    var codcaja = $('#codcaja').val();
		    var codcliente = $('#codcliente').val();
		    var montoabono = $('#montoabono').val();

		if (codcaja=='') {
	            
            swal("Oops", "POR FAVOR DEBE DE REALIZAR EL ARQUEO DE SU CAJA PARA PROCESAR ABONOS DE CREDITOS!", "error");

            return false;
	 
	    } else if (codcliente=='') {
	            
            swal("Oops", "POR FAVOR SELECCIONE LA FACTURA ABONAR CORRECTAMENTE!", "error");

            return false;
	 
	    } else if (montoabono==0.00) {
	            
	        $("#montoabono").focus();
            $('#montoabono').css('border-color','#2cabe3');
            swal("Oops", "POR FAVOR INGRESE UN MONTO DE ABONO VALIDO!", "error");

            return false;
	 
	    } else {
				
		$.ajax({
		type : 'POST',
		url  : 'creditosxreservaciones.php',
	    async : false,
		data : data,
		beforeSend: function()
		{	
			$("#save").fadeOut();
			var n = noty({
			text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
			theme: 'defaultTheme',
			layout: 'center',
			type: 'information',
			timeout: 1000, });
			$("#btn-submit").attr('disabled', true);
		},
		success :  function(data)
				   {						
						if(data==1){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA REALIZAR VENTAS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").attr('disabled', false);
								
							});
						}   
						else if(data==2){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").attr('disabled', false);
																		
							});
						}    
						else if(data==3){
							
			$("#save").fadeIn(1000, function(){
							
		 var n = noty({
         text: "<span class='fa fa-warning'></span> EL MONTO ABONADO NO PUEDE SER MAYOR AL TOTAL DE FACTURA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
         theme: 'defaultTheme',
         layout: 'center',
         type: 'warning',
         timeout: 5000, });
		$("#btn-submit").attr('disabled', false);
																		
							});
						}
						else{
								
			$("#save").fadeIn(1000, function(){
								
		 var n = noty({
		 text: '<center> '+data+' </center>',
         theme: 'defaultTheme',
         layout: 'center',
         type: 'information',
         timeout: 5000, });
         $('body').removeClass('modal-open');
         $('#myModalPago').modal('hide');
		 $("#savepagoreservaciones")[0].reset();
	     $("#btn-submit").attr('disabled', false);	
		 $('#creditosreservaciones').html("");
		 $('#creditosreservaciones').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
		 setTimeout(function() {
		 $('#creditosreservaciones').load("consultas?CargaCreditosReservaciones=si");
		 }, 200);
								
							});
						}
				   }
				});
				return false;
			}
		}
	   /* form submit */
    });
    	   
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PAGOS A CREDITOS EN RESERVACIONES */

/* FUNCION JQUERY PARA VALIDAR REGISTRO DE PAGOS A CREDITOS EN VENTAS */	 	 
$(document).ready(function()
{ 
     /* validation */
	 $("#savepagoventas").validate({
        rules:
	    {
			codcliente: { required: false },
			montoabono: { required: true, number : true},
	    },
        messages:
	    {
            codcliente:{ required: "Por favor seleccione al Cliente correctamente" },
			montoabono:{ required: "Ingrese Monto de Abono", number: "Ingrese solo digitos con 2 decimales" },
        },
	    submitHandler: function(form) {
                     
        var data = $("#savepagoventas").serialize();
	    var codcaja = $('#codcaja').val();
	    var codcliente = $('#codcliente').val();
	    var montoabono = $('#montoabono').val();

		if (codcaja=='') {
	            
            swal("Oops", "POR FAVOR DEBE DE REALIZAR EL ARQUEO DE SU CAJA PARA PROCESAR ABONOS DE CREDITOS!", "error");

            return false;
	 
	    } else if (codcliente=='') {
	            
            swal("Oops", "POR FAVOR SELECCIONE LA FACTURA ABONAR CORRECTAMENTE!", "error");

            return false;
	 
	    } else if (montoabono==0.00) {
	            
	        $("#montoabono").focus();
            $('#montoabono').css('border-color','#2cabe3');
            swal("Oops", "POR FAVOR INGRESE UN MONTO DE ABONO VALIDO!", "error");

            return false;
	 
	    } else {
				
			$.ajax({
			type : 'POST',
			url  : 'creditosxventas.php',
		    async : false,
			data : data,
			beforeSend: function()
			{	
				$("#save").fadeOut();
				var n = noty({
				text: "<span class='fa fa-refresh'></span> PROCESANDO INFORMACI&Oacute;N, POR FAVOR ESPERE......",
				theme: 'defaultTheme',
				layout: 'center',
				type: 'information',
				timeout: 1000, });
				$("#btn-submit").attr('disabled', true);
			},
			success :  function(data)
					   {						
							if(data==1){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> DEBE DE REALIZAR EL ARQUEO DE SU CAJA ASIGNADA PARA REALIZAR VENTAS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
									
								});
							}   
							else if(data==2){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}    
							else if(data==3){
								
				$("#save").fadeIn(1000, function(){
								
			 var n = noty({
             text: "<span class='fa fa-warning'></span> EL MONTO ABONADO NO PUEDE SER MAYOR AL TOTAL DE FACTURA, VERIFIQUE NUEVAMENTE POR FAVOR ...!",
             theme: 'defaultTheme',
             layout: 'center',
             type: 'warning',
             timeout: 5000, });
			$("#btn-submit").attr('disabled', false);
																			
								});
							}
							else{
									
				$("#save").fadeIn(1000, function(){
									
			 var n = noty({
			 text: '<center> '+data+' </center>',
             theme: 'defaultTheme',
             layout: 'center',
             type: 'information',
             timeout: 5000, });
             $('body').removeClass('modal-open');
             $('#myModalPago').modal('hide');
			 $("#savepagoventas")[0].reset();
			 $("#btn-submit").attr('disabled', false);
			 $('#creditosventas').html("");
			 $('#creditosventas').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
			 setTimeout(function() {
			 $('#creditosventas').load("consultas?CargaCreditosVentas=si");
			 }, 200);
									
								});
							}
					   }
				});
				return false;
			}
		}
	   /* form submit */
    });
});
/*  FIN DE FUNCION PARA VALIDAR REGISTRO DE PAGOS A CREDITOS EN VENTAS */

























/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MENSAJES EN CHAT */	 
$(document).ready(function()
{ 
     /* validation */
	 $("#inbox").validate({
      rules:
	  {
			respuesta: { required: true },
			mensaje: { required: true },
	   },
       messages:
	   {
			respuesta:{ required: "Seleccione Cliente" },
			mensaje:{ required: "Ingrese su Mensaje" },
       },
	   submitHandler: function(form) {
                     
               var data = $("#inbox").serialize();
				
				$.ajax({
				type : 'POST',
				url  : 'chat.php',
			    async : false,
				data : data,
				beforeSend: function()
				{	
					$("#save").fadeOut();
					$("#btn-submit").html('<i class="fa fa-refresh"></i>');
				},
				success :  function(data)
						   {						
								if(data==1){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> POR FAVOR DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS, VERIFIQUE NUEVAMENTE POR FAVOR...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-paper-plane"></span>');
										
									});
								}  
								else if(data==2){
									
					$("#save").fadeIn(1000, function(){
									
				 var n = noty({
                 text: "<span class='fa fa-warning'></span> TU MENSAJE NO PUDO ENVIARSE POR NO SER CLIENTE ACTIVO, DEBE DE TENER UNA RESERVACION ACTIVA PARA PODER ENVIAR MENSAJES AL CHAT ...!",
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'warning',
                 timeout: 5000, });
				$("#btn-submit").html('<span class="fa fa-paper-plane"></span>');
																				
									});
								}   
								else{
										
					$("#save").fadeIn(1000, function(){
										
				 /*var n = noty({
				 text: '<center> '+data+' </center>',
                 theme: 'defaultTheme',
                 layout: 'center',
                 type: 'information',
                 timeout: 5000, });*/
				 $("#inbox")[0].reset();
				 $("#btn-submit").html('<span class="fa fa-paper-plane"></span>');
				 $(".chat-list").load("funciones.php?CargaChat=si");
				 $(".chat-box").animate({ scrollTop: $('.chat-box').prop("scrollHeight")}, "fast");
				
									});
								}
						   }
				});
				return false;
		}
	   /* form submit */
    });	
});
/* FUNCION JQUERY PARA VALIDAR REGISTRO DE MENSAJES EN CHAT */