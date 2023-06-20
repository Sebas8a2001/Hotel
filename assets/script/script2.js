//SELECCIONAR/DESELECCIONAR TODOS LOS CHECKBOX
$(document).ready(function () {
  $("#checkTodos").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      //$("input[type='checkbox']:checked:enabled").prop('checked', $(this).prop("checked"));
  });
});

// FUNCION PARA LIMPIAR CHECKBOX ACTIVOS
function LimpiarCheckbox(){
$("input[type='checkbox']:checked:enabled").attr('checked',false); 
$("input[type='radio']:checked:enabled").attr('checked',false);
$('.combo').attr('disabled', 'disabled'); 
$('#muestradetallesreservacion').html(""); 
}

//BUSQUEDA EN CONSULTAS #1
$(document).ready(function () {
   (function($) {
       $('#FiltrarContenido').keyup(function () {
            var ValorBusqueda = new RegExp($(this).val(), 'i');
            $('.BusquedaRapida tr').hide();
             $('.BusquedaRapida tr').filter(function () {
                return ValorBusqueda.test($(this).text());
              }).show();
                })
      }(jQuery));
});

$(document.body).on('keyup', '[data-upper]', function toUpper() {
  this.value = this.value.toUpperCase();
});


//FUNCION PARA VALIDAR INGRESO DE TARJETA DE CREDITO
function ValidateCard() {
 if ($('#nrotarjeta').val() != "" && validatecardfunc() == false)
  swal("Oops", "POR FAVOR, INGRESA UN NUMERO DE TARJETA DE CREDITO VALIDA!", "error"); 
  $('#nrotarjeta').val("");
  $('#tarjeta').val("");
}

function validatecardfunc() {
 validcard = false;
 ret = stripNonNumbers ($("#nrotarjeta").val());
 //item = document.reservaciones.tipotarjeta.selectedIndex;
 //result = document.reservaciones.tipotarjeta.options[item].text;
 result = document.savereservaciones.tipotarjeta.value;
 if (result == "MASTERCARD") {
  if (ret.length == 16)
     validcard = true;
  if ((ret.substring (0, 2) >= "51") && (ret.substring (0, 2) <= "55"))
     validcard = true;
  else
     validcard = false;
 }
 if (result == "VISA") {
   if ((ret.length == 16) || (ret.length ==13))
      validcard = true;
   if (ret.substring (0, 1) != "4")
      validcard = false;
 }
 if (result == "AMERICAN EXPRESS") {
   if (ret.length == 15)
      validcard = true;
   if ((ret.substring (0, 2) != "34") && (ret.substring (0, 2) != "37"))
      validcard = false;
 }
 if (result == "DINERS CLUB") {
   if (ret.length == 14)
      validcard = true;
    if ((ret.substring (0, 2) != "30") && (ret.substring (0, 2) != "36") && (ret.substring (0, 2) != "38"))
      validcard = false;
 }
 if (result == "DISCOVER") {
   if (ret.length == 16)
      validcard = true;
   if (ret.substring (0, 4) != "6011")
      validcard = false;
 }
 return (validcard);
}

function stripNonNumbers (InString) {
 OutString="";
 for (Count=0; Count < InString.length; Count++) {
     TempChar=InString.substring (Count, Count+1);
     Strip = false;
     CharString="0123456789";
     for (Countx = 0; Countx < CharString.length; Countx++) {
       StripThis = CharString.substring(Countx, Countx+1)
       if (TempChar == StripThis) {
          Strip = true;
          break;
       }
     }
     if (Strip)
        OutString=OutString+TempChar;
 }
 return (OutString);
}






/////////////////////////////////// FUNCIONES DE FORMULARIO DE CONTACTO //////////////////////////////////////

// FUNCION PARA MOSTRAR MENSAJE DE CONTACTO EN VENTANA MODAL
function VerMensaje(codmensaje){

$('#muestramensajemodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaMensajeModal=si&codmensaje='+codmensaje;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestramensajemodal').empty();
                $('#muestramensajemodal').append(''+response+'').fadeIn("slow");
            }
      });
}

/////FUNCION PARA ELIMINAR MENSAJE DE CONTACTO 
function EliminarMensaje(codmensaje,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Mensaje de Contacto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#2f323e',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codmensaje="+codmensaje+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#mensajes').load("consultas.php?CargaMensajes=si");

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Mensaje de Contacto, no tienes los privilegios dentro del Sistema!", "error"); 

                }
            }
        })
    });
}








/////////////////////////////////// FUNCIONES DE USUARIOS //////////////////////////////////////

// FUNCION PARA MOSTRAR USUARIOS EN VENTANA MODAL
function VerUsuario(codigo){

$('#muestrausuariomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var dataString = 'BuscaUsuarioModal=si&codigo='+codigo;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrausuariomodal').empty();
                $('#muestrausuariomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR USUARIOS
function UpdateUsuario(codigo,dni,nombres,sexo,direccion,telefono,email,usuario,nivel,status,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveuser #codigo").val(codigo);
  $("#saveuser #dni").val(dni);
  $("#saveuser #nombres").val(nombres);
  $("#saveuser #sexo").val(sexo);
  $("#saveuser #direccion").val(direccion);
  $("#saveuser #telefono").val(telefono);
  $("#saveuser #email").val(email);
  $("#saveuser #usuario").val(usuario);
  $("#saveuser #nivel").val(nivel);
  $("#saveuser #status").val(status);
  $("#saveuser #proceso").val(proceso);
}


/////FUNCION PARA ELIMINAR USUARIOS 
function EliminarUsuario(codigo,dni,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Usuario?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codigo="+codigo+"&dni="+dni+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $("#usuarios").load("consultas.php?CargaUsuarios=si");
            $("#saveuser")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Usuario no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Usuarios, no eres el Administrador del Sistema!", "error"); 

                }

            }
        })
          /*.done(function(data) {
            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#estudiantes').load("consultas?CargaEstudiantes=si");
          })
          .error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
          });*/
    });
}













/////////////////////////////////// FUNCIONES DE CATEGORIAS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR CATEGORIAS
function UpdateCategoria(codcategoria,nomcategoria,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savecategorias #codcategoria").val(codcategoria);
  $("#savecategorias #nomcategoria").val(nomcategoria);
  $("#savecategorias #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR CATEGORIAS 
function EliminarCategoria(codcategoria,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Categoria de Producto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcategoria="+codcategoria+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#categorias').load("consultas.php?CargaCategorias=si");
            $("#savecategorias")[0].reset();

          } else if(data==2) { 

             swal("Oops", "Esta Categoria no puede ser Eliminada, tiene registros relacionados!", "error"); 

           } else {  

             swal("Oops", "Usted no tiene Acceso para Eliminar Categorias de Productos, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE TIPOS DE DOCUMENTOS  //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TIPOS DE DOCUMENTOS
function UpdateDocumento(coddocumento,documento,descripcion,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savedocumentos #coddocumento").val(coddocumento);
  $("#savedocumentos #documento").val(documento);
  $("#savedocumentos #descripcion").val(descripcion);
  $("#savedocumentos #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TIPOS DE DOCUMENTOS 
function EliminarDocumento(coddocumento,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Tipo de Documento?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddocumento="+coddocumento+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#documentos').load("consultas?CargaDocumentos=si");
                  
          } else if(data==2){ 

             swal("Oops", "Este Documento no puede ser Eliminado, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Documentos, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE TIPOS DE MONEDA //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TIPOS DE MONEDA
function UpdateTipoMoneda(codmoneda,moneda,siglas,simbolo,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savemonedas #codmoneda").val(codmoneda);
  $("#savemonedas #moneda").val(moneda);
  $("#savemonedas #siglas").val(siglas);
  $("#savemonedas #simbolo").val(simbolo);
  $("#savemonedas #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TIPOS DE MONEDA 
function EliminarTipoMoneda(codmoneda,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Tipo de Moneda?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codmoneda="+codmoneda+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#monedas').load("consultas?CargaMonedas=si");
            $("#savemonedas")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Tipo de Moneda no puede ser Eliminado, tiene Tipos de Cambio relacionadas!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Tipos de Moneda, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE TIPOS DE CAMBIO  //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TIPOS DE CAMBIO
function UpdateTipoCambio(codcambio,descripcioncambio,montocambio,codmoneda,fechacambio,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savecambios #codcambio").val(codcambio);
  $("#savecambios #descripcioncambio").val(descripcioncambio);
  $("#savecambios #montocambio").val(montocambio);
  $("#savecambios #codmoneda").val(codmoneda);
  $("#savecambios #fechacambio").val(fechacambio);
  $("#savecambios #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TIPOS DE CAMBIO 
function EliminarTipoCambio(codcambio,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Tipo de Cambio?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcambio="+codcambio+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#cambios').load("consultas?CargaCambios=si");
            $("#savecambios")[0].reset();
                  
           } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Tipos de Cambio, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}










/////////////////////////////////// FUNCIONES DE MEDIOS DE PAGOS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR MEDIOS DE PAGOS
function UpdateMedio(codmediopago,mediopago,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savemedios #codmediopago").val(codmediopago);
  $("#savemedios #mediopago").val(mediopago);
  $("#savemedios #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR MEDIOS DE PAGOS 
function EliminarMedio(codmediopago,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Medio de Pago?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codmediopago="+codmediopago+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#mediospagos').load("consultas?CargaMediosPagos=si");
            $("#savemedios")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Medio de Pago no puede ser Eliminado, tiene Ventas relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Medios de Pagos, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE IMPUESTOS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR IMPUESTOS
function UpdateImpuesto(codimpuesto,nomimpuesto,valorimpuesto,statusimpuesto,fechaimpuesto,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveimpuestos #codimpuesto").val(codimpuesto);
  $("#saveimpuestos #nomimpuesto").val(nomimpuesto);
  $("#saveimpuestos #valorimpuesto").val(valorimpuesto);
  $("#saveimpuestos #statusimpuesto").val(statusimpuesto);
  $("#saveimpuestos #fechaimpuesto").val(fechaimpuesto);
  $("#saveimpuestos #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR IMPUESTOS
function EliminarImpuesto(codimpuesto,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Impuesto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codimpuesto="+codimpuesto+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#impuestos').load("consultas?CargaImpuestos=si");
                  
          } else if(data==2){ 

             swal("Oops", "Este Impuesto no puede ser Eliminado, se encuentra activo para Ventas!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Impuestos, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE PERFIL DE HOTEL //////////////////////////////////////

// FUNCION PARA ACTUALIZAR PERFIL DE HOTEL
function UpdatePerfil(codperfil,nomperfil,descperfil,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveperfil #codperfil").val(codperfil);
  $("#saveperfil #nomperfil").val(nomperfil);
  $("#saveperfil #descperfil").val(descperfil);
  $("#saveperfil #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR PERFIL DE HOTEL
function EliminarPerfil(codperfil,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Perfil del Hotel?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codperfil="+codperfil+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#perfil').load("consultas.php?CargaPerfil=si");
            $("#saveperfil")[0].reset();

           } else {  

             swal("Oops", "Usted no tiene Acceso para Eliminar Perfiles del Hotel, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}










/////////////////////////////////// FUNCIONES DE TEMPORADAS //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TEMPORADAS
function UpdateTemporada(codtemporada,temporada,desde,hasta,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savetemporadas #codtemporada").val(codtemporada);
  $("#savetemporadas #temporada").val(temporada);
  $("#savetemporadas #desde").val(desde);
  $("#savetemporadas #hasta").val(hasta);
  $("#savetemporadas #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TEMPORADAS 
function EliminarTemporada(codtemporada,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Temporada?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codtemporada="+codtemporada+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#temporadas').load("consultas?CargaTemporadas=si");
            $("#savetemporadas")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Temporada no puede ser Eliminada, tiene registros relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Temporadas, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}














/////////////////////////////////// FUNCIONES DE NOTICIAS //////////////////////////////////////

// FUNCION PARA MOSTRAR NOTICIA EN VENTANA MODAL
function VerNoticia(codnoticia){

$('#muestranoticiamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando información ......</center>');

var dataString = 'BuscaNoticiaModal=si&codnoticia='+codnoticia;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestranoticiamodal').empty();
                $('#muestranoticiamodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR NOTICIAS
function UpdateNoticia(codnoticia,titulonoticia,descripcnoticia,statusnoticia,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savenoticias #codnoticia").val(codnoticia);
  $("#savenoticias #titulonoticia").val(titulonoticia);
  $("#savenoticias #descripcnoticia").val(descripcnoticia);
  $("#savenoticias #statusnoticia").val(statusnoticia);
  $("#savenoticias #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR LOCALIDADES 
function EliminarNoticia(codnoticia,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Noticia?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codnoticia="+codnoticia+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#noticias').load("consultas.php?CargaNoticias=si");
            $("#savenoticias")[0].reset();
                  
           } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Noticias, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}














/////////////////////////////////// FUNCIONES DE TIPOS DE HABITACIONES //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TIPO DE HABITACION
function UpdateTipo(codtipo,nomtipo,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savetipos #codtipo").val(codtipo);
  $("#savetipos #nomtipo").val(nomtipo);
  $("#savetipos #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TIPO DE HABITACION 
function EliminarTipo(codtipo,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Tipo de Habitación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codtipo="+codtipo+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#tipos').load("consultas.php?CargaTipos=si");
            $("#savetipos")[0].reset();

          } else if(data==2) { 

             swal("Oops", "Este Tipo de Habitación no puede ser Eliminada, tiene Tarifas de Habitaciones relacionadas!", "error"); 

           } else {  

             swal("Oops", "Usted no tiene Acceso para Eliminar Tipos de Habitaciones, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE TARIFAS DE HABITACIONES //////////////////////////////////////

// FUNCION PARA ACTUALIZAR TARIFA DE HABITACION
function UpdateTarifa(codtarifa,codtipo,baja,media,alta,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savetarifas #codtarifa").val(codtarifa);
  $("#savetarifas #codtipo").val(codtipo);
  $("#savetarifas #baja").val(baja);
  $("#savetarifas #media").val(media);
  $("#savetarifas #alta").val(alta);
  $("#savetarifas #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR TARIFA DE HABITACION 
function EliminarTarifa(codtarifa,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Tarifa de Habitación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codtarifa="+codtarifa+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#tarifas').load("consultas.php?CargaTarifas=si");
            $("#savetarifas")[0].reset();

          } else if(data==2) { 

             swal("Oops", "Esta Tarifa de Habitación no puede ser Eliminada, tiene registros relacionados!", "error"); 

           } else {  

             swal("Oops", "Usted no tiene Acceso para Eliminar Tarifas de Habitaciones, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}


















/////////////////////////////////// FUNCIONES DE HABITACIONES //////////////////////////////////////

// FUNCION PARA MOSTRAR HABITACIONES EN VENTANA MODAL
function VerHabitacion(codhabitacion){

$('#muestrahabitacionmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaHabitacionModal=si&h='+codhabitacion;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrahabitacionmodal').empty();
                $('#muestrahabitacionmodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR HABITACIONES
function UpdateHabitacion(codhabitacion,numhabitacion) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Habitación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forhabitacion?h="+codhabitacion+"&numhabitacion="+numhabitacion;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR HABITACIONES 
function EliminarHabitacion(codhabitacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Habitación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codhabitacion="+codhabitacion+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#habitaciones').load("consultas.php?CargaHabitaciones=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Habitación no puede ser Eliminada, tiene Reservaciones relacionadas!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Habitaciones, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE CLIENTES //////////////////////////////////////

// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE CLIENTES
function CargaDivClientes(){

$('#divcliente').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');
                
var dataString = 'BuscaDivCliente=si';

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#divcliente').empty();
                $('#divcliente').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
           }
      });
}

// FUNCION PARA LIMPIAR DIV DE CARGA MASIVA DE CLIENTES
function ModalCliente(){
  $("#divcliente").html("");
}

// FUNCION PARA MOSTRAR CLIENTES EN VENTANA MODAL
function VerCliente(codcliente){

$('#muestraclientemodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaClienteModal=si&codcliente='+codcliente;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraclientemodal').empty();
                $('#muestraclientemodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR CLIENTES
function UpdateCliente(codcliente,documcliente,dnicliente,nomcliente,paiscliente,ciudadcliente,
  direccliente,telefcliente,correocliente,limitecredito,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savecliente #codcliente").val(codcliente);
  $("#savecliente #documcliente").val(documcliente);
  $("#savecliente #dnicliente").val(dnicliente);
  $("#savecliente #nomcliente").val(nomcliente);
  $("#savecliente #paiscliente").val(paiscliente);
  $("#savecliente #ciudadcliente").val(ciudadcliente);
  $("#savecliente #direccliente").val(direccliente);
  $("#savecliente #telefcliente").val(telefcliente);
  $("#savecliente #correocliente").val(correocliente);
  $("#savecliente #limitecredito").val(limitecredito);
  $("#savecliente #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR CLIENTES 
function EliminarCliente(codcliente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Cliente?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcliente="+codcliente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#clientes').load("consultas.php?CargaClientes=si");
            $("#savecliente")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Cliente no puede ser Eliminado, tiene Ventas relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Clientes, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA REINICIAR CLAVE DOCENTE 
function ReiniciarClave(codcliente,dnicliente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Reiniciar la Clave de Acceso de este Cliente?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Reiniciar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcliente="+codcliente+"&dnicliente="+dnicliente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Reiniciada!", "Su Clave de Acceso fue reiniciada con éxito al Nº de Documento de Identidad: !", "success");
                  
          } else { 

             swal("Oops", "No puedes Reiniciar Claves, No eres el Administrador del Sistema !", "error"); 

                }
            }
        })
    });
}













/////////////////////////////////// FUNCIONES DE PROVEEDORES //////////////////////////////////////

// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE PROVEEDORES
function CargaDivProveedores(){

$('#divproveedor').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');
                
var dataString = 'BuscaDivProveedor=si';

$.ajax({
          type: "GET",
          url: "funciones.php",
          data: dataString,
          success: function(response) {            
              $('#divproveedor').empty();
              $('#divproveedor').append(''+response+'').fadeIn("slow");
              //$('#'+parent).remove();
         }
    });
}

// FUNCION PARA LIMPIAR DIV DE CARGA MASIVA DE PROVEEDORES
function ModalProveedor(){
  $("#divproveedor").html("");
}

// FUNCION PARA MOSTRAR PROVEEDORES EN VENTANA MODAL
function VerProveedor(codproveedor){

$('#muestraproveedormodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaProveedorModal=si&codproveedor='+codproveedor;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraproveedormodal').empty();
                $('#muestraproveedormodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR PROVEEDORES
function UpdateProveedor(codproveedor,documproveedor,cuitproveedor,nomproveedor,tlfproveedor,
  direcproveedor,emailproveedor,vendedor,tlfvendedor,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveproveedor #codproveedor").val(codproveedor);
  $("#saveproveedor #documproveedor").val(documproveedor);
  $("#saveproveedor #cuitproveedor").val(cuitproveedor);
  $("#saveproveedor #nomproveedor").val(nomproveedor);
  $("#saveproveedor #tlfproveedor").val(tlfproveedor);
  $("#saveproveedor #direcproveedor").val(direcproveedor);
  $("#saveproveedor #emailproveedor").val(emailproveedor);
  $("#saveproveedor #vendedor").val(vendedor);
  $("#saveproveedor #tlfvendedor").val(tlfvendedor);
  $("#saveproveedor #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR PROVEEDORES 
function EliminarProveedor(codproveedor,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Proveedor?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codproveedor="+codproveedor+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#proveedores').load("consultas.php?CargaProveedores=si");
            $("#saveproveedor")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Proveedor no puede ser Eliminado, tiene Productos relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Proveedores, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}

















/////////////////////////////////// FUNCIONES DE ENTRADAS DE INSUMOS //////////////////////////////////////

// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE ENTRADA DE INSUMOS
function CargaDivInsumos(){

$('#divinsumo').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');
                
var dataString = 'BuscaDivInsumos=si';

$.ajax({
          type: "GET",
          url: "funciones.php",
          data: dataString,
          success: function(response) {            
              $('#divinsumo').empty();
              $('#divinsumo').append(''+response+'').fadeIn("slow");
              //$('#'+parent).remove();
         }
    });
}

// FUNCION PARA LIMPIAR DIV DE CARGA MASIVA DE INSUMOS
function ModalInsumo(){
  $("#divinsumo").html("");
}

// FUNCION PARA MOSTRAR ENTRADA DE INSUMOS EN VENTANA MODAL
function VerInsumo(codinsumo){

$('#muestrainsumomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaInsumoModal=si&codinsumo='+codinsumo;

$.ajax({
          type: "GET",
          url: "funciones.php",
          data: dataString,
          success: function(response) {            
              $('#muestrainsumomodal').empty();
              $('#muestrainsumomodal').append(''+response+'').fadeIn("slow");
              //$('#'+parent).remove();
          }
    });
}

// FUNCION PARA ACTUALIZAR INSUMOS
function UpdateInsumo(codinsumo,insumo,codcategoria,preciocompra,precioventa,existencia,minimo,ivainsumo,descinsumo,fechaexpiracion,codproveedor,lote,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveinsumo #codinsumo").val(codinsumo);
  $("#saveinsumo #nroinsumo").val(codinsumo);
  $("#saveinsumo #codinsumo").attr('disabled', true);
  $("#saveinsumo #insumo").val(insumo);
  $("#saveinsumo #codcategoria").val(codcategoria);
  $("#saveinsumo #preciocompra").val(preciocompra);
  $("#saveinsumo #precioventa").val(precioventa);
  $("#saveinsumo #existencia").val(existencia);
  $("#saveinsumo #stockminimo").val(minimo);
  $("#saveinsumo #ivainsumo").val(ivainsumo);
  $("#saveinsumo #descinsumo").val(descinsumo);
  $("#saveinsumo #fechaexpiracion").val(fechaexpiracion);
  $("#saveinsumo #codproveedor").val(codproveedor);
  $("#saveinsumo #lote").val(lote);
  $("#saveinsumo #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR INSUMOS 
function EliminarInsumo(codinsumo,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Insumo de Limpieza del Almacen?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codinsumo="+codinsumo+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#insumos').load("consultas.php?CargaInsumos=si");
            $("#saveinsumos")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Insumo de Limpieza no puede ser Eliminado, tiene Salidas relacionadas!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Insumos de Limpieza del Almacen, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE ENTRADA DE INSUMOS //////////////////////////////////////

// FUNCION PARA MOSTRAR ENTRADA DE INSUMOS EN VENTANA MODAL
function VerEntradaInsumo(codentrada){

$('#muestraentradainsumomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaEntradaInsumoModal=si&codentrada='+codentrada;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraentradainsumomodal').empty();
                $('#muestraentradainsumomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR ENTRADA DE INSUMOS
function UpdateEntradaInsumo(codentrada,codinsumo,busquedainsumo,precioentrada,cantentrada,fechaexpiracion,codproveedor,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#saveentradainsumos #codentrada").val(codentrada);
  $("#saveentradainsumos #codinsumo").val(codinsumo);
  $("#saveentradainsumos #busquedainsumo").val(busquedainsumo);
  $("#saveentradainsumos #precioentrada").val(precioentrada);
  $("#saveentradainsumos #cantentradabd").val(cantentrada);
  $("#saveentradainsumos #cantentrada").val(cantentrada);
  $("#saveentradainsumos #fechaexpiracion").val(fechaexpiracion);
  $("#saveentradainsumos #codproveedor").val(codproveedor);
  $("#saveentradainsumos #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR ENTRADA DE INSUMOS 
function EliminarEntradaInsumo(codentrada,codinsumo,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Entrada de Insumo del Almacen?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codentrada="+codentrada+"&codinsumo="+codinsumo+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#entradainsumos').load("consultas.php?CargaEntradaInsumos=si");
            $("#saveentradainsumos")[0].reset();
                  
           } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Entrada de Insumos de Limpieza del Almacen, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}












/////////////////////////////////// FUNCIONES DE SALIDA DE INSUMOS //////////////////////////////////////

// FUNCION PARA MOSTRAR SALIDA DE INSUMOS EN VENTANA MODAL
function VerSalidaInsumo(codsalida){

$('#muestrasalidainsumomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaSalidaInsumoModal=si&codsalida='+codsalida;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrasalidainsumomodal').empty();
                $('#muestrasalidainsumomodal').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA ACTUALIZAR SALIDA DE INSUMOS
function UpdateSalidaInsumo(codsalida,codinsumo,busquedainsumo,responsable,existencia,cantsalida,preciosalida,descsalida,ivasalida,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savesalidainsumos #codsalida").val(codsalida);
  $("#savesalidainsumos #codinsumo").val(codinsumo);
  $("#savesalidainsumos #busquedainsumo").val(busquedainsumo);
  $("#savesalidainsumos #responsable").val(responsable);
  $("#savesalidainsumos #existencia").val(existencia);
  $("#savesalidainsumos #cantsalidabd").val(cantsalida);
  $("#savesalidainsumos #cantsalida").val(cantsalida);
  $("#savesalidainsumos #precioventa").val(preciosalida);
  $("#savesalidainsumos #descinsumo").val(descsalida);
  $("#savesalidainsumos #ivainsumo").val(ivasalida);
  $("#savesalidainsumos #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR SALIDA DE INSUMOS 
function EliminarSalidaInsumo(codsalida,codinsumo,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Salida de Insumo del Almacen?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codsalida="+codsalida+"&codinsumo="+codinsumo+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#salidainsumos').load("consultas.php?CargaSalidaInsumos=si");
            $("#savesalidainsumos")[0].reset();
                  
          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Salida de Insumos de Limpieza del Almacen, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSQUEDA DE KARDEX POR INSUMOS DE LIMPIEZA
function BuscaKardeInsumos(){

$('#muestrakardexinsumo').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codinsumo = $("input#codinsumo").val();
var dataString = $("#kardexinsumo").serialize();
var url = 'funciones.php?BuscaKardexInsumo=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestrakardexinsumo').empty();
                $('#muestrakardexinsumo').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      }); 
}














/////////////////////////////////// FUNCIONES DE PRODUCTOS //////////////////////////////////////

// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE PRODUCTOS
function CargaDivProductos(){

$('#divproducto').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');
                
var dataString = 'BuscaDivProducto=si';

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#divproducto').empty();
                $('#divproducto').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
           }
      });
}

// FUNCION PARA LIMPIAR DIV DE CARGA MASIVA DE PRODUCTOS
function ModalProducto(){
  $("#divproducto").html("");
}

// FUNCION PARA MOSTRAR PRODUCTOS EN VENTANA MODAL
function VerProducto(codproducto){

$('#muestraproductomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaProductoModal=si&codproducto='+codproducto;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraproductomodal').empty();
                $('#muestraproductomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR PRODUCTOS
function UpdateProducto(codproducto) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar este Producto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forproducto?codproducto="+codproducto;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR PRODUCTOS 
function EliminarProducto(codproducto,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Producto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codproducto="+codproducto+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#productos').load("consultas.php?CargaProductos=si");
                  
          } else if(data==2){ 

             swal("Oops", "Este Producto no puede ser Eliminado, tiene Ventas relacionadas!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Productos, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA BUSQUEDA DE KARDEX POR PRODUCTOS
function BuscaKardexProductos(){

$('#muestrakardexproducto').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codproducto = $("input#codproducto").val();
var dataString = $("#kardexproducto").serialize();
var url = 'funciones.php?BuscaKardexProducto=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestrakardexproducto').empty();
                $('#muestrakardexproducto').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      }); 
}

// FUNCION PARA BUSQUEDA DE PRODUCTOS VENDIDOS
function BuscaProductosVendidos(){
    
$('#muestraproductosvendidos').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#productosvendidos").serialize();
var url = 'funciones.php?BuscaProductoVendidos=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestraproductosvendidos').empty();
                $('#muestraproductosvendidos').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      }); 
}


// FUNCION PARA BUSQUEDA DE PRODUCTOS POR MONEDA
function BuscaProductosxMoneda(){
    
$('#muestraproductosxmoneda').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codmoneda = $("input#codmoneda").val();
var dataString = $("#productosxmoneda").serialize();
var url = 'funciones.php?BuscaProductoxMoneda=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestraproductosxmoneda').empty();
                $('#muestraproductosxmoneda').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      }); 
}

// FUNCION PARA CARGAR PRODUCTOS POR CATEGORIAS EN VENTANA MODAL
function CargaProductos(){

$('#loadproductos').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var dataString = "CargarProductos=si";

$.ajax({
            type: "GET",
            url: "categorias_productos.php",
            data: dataString,
            success: function(response) {            
                $('#loadproductos').empty();
                $('#loadproductos').append(''+response+'').fadeIn("slow");
            }
      });
}











/////////////////////////////////// FUNCIONES DE COMPRAS //////////////////////////////////////

// FUNCION PARA MOSTRAR FORMA DE PAGO EN COMPRAS
function CargaFormaPagosCompras(){

  var valor = $("#tipocompra").val();

      if (valor === "" || valor === true) {
         
          $("#formacompra").attr('disabled', true);
          $("#fechavencecredito").attr('disabled', true);

      } else if (valor === "CONTADO" || valor === true) {
         
          $("#formacompra").attr('disabled', false);
          $("#fechavencecredito").attr('disabled', true);

      } else {

          $("#formacompra").attr('disabled', true);
          $("#fechavencecredito").attr('disabled', false);
      }
}

// FUNCION PARA MOSTRAR COMPRA PAGADA EN VENTANA MODAL
function VerCompraPagada(codcompra){

$('#muestracompramodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaCompraPagadaModal=si&codcompra='+codcompra;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestracompramodal').empty();
                $('#muestracompramodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA MOSTRAR COMPRA PENDIENTE EN VENTANA MODAL
function VerCompraPendiente(codcompra){

$('#muestracompramodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaCompraPendienteModal=si&codcompra='+codcompra;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestracompramodal').empty();
                $('#muestracompramodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR COMPRAS
function UpdateCompra(codcompra,proceso,status) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Compra de Producto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forcompra?codcompra="+codcompra+"&proceso="+proceso+"&status="+status;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

// FUNCION PARA AGREGAR DETALLES A COMPRAS
function AgregaDetalleCompra(codcompra,proceso) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Agregar Detalles de Productos a esta Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Continuar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forcompra?codcompra="+codcompra+"&proceso="+proceso;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}


/////FUNCION PARA ELIMINAR DETALLES DE COMPRAS PAGADAS EN VENTANA MODAL
function EliminarDetalleCompraPagadaModal(coddetallecompra,codcompra,codproveedor,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetallecompra="+coddetallecompra+"&codcompra="+codcompra+"&codproveedor="+codproveedor+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#muestracompramodal').load("funciones.php?BuscaCompraPagadaModal=si&codcompra="+codcompra); 
            $('#compras').load("consultas.php?CargaCompras=si");

          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Compras en este Módulo, realice la Eliminación completa de la Compra!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Compras, no eres el Administrador!", "error"); 

                }
            }
        })
    });
}


/////FUNCION PARA ELIMINAR DETALLES DE COMPRAS PENDIENTES EN VENTANA MODAL
function EliminarDetalleCompraPendienteModal(coddetallecompra,codcompra,codproveedor,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetallecompra="+coddetallecompra+"&codcompra="+codcompra+"&codproveedor="+codproveedor+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#muestracompramodal').load("funciones.php?BuscaCompraPendienteModal=si&codcompra="+codcompra); 
            $('#cuentasxpagar').load("consultas?CargaCuentasxPagar=si");

          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Compras en este Módulo, realice la Eliminación completa de la Compra!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Compras, no eres el Administrador!", "error"); 

                }
            }
        })
    });
}


/////FUNCION PARA ELIMINAR DETALLES DE COMPRAS EN ACTUALIZAR
function EliminarDetalleCompraUpdate(coddetallecompra,codcompra,codproveedor,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetallecompra="+coddetallecompra+"&codcompra="+codcompra+"&codproveedor="+codproveedor+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#detallescomprasupdate').load("funciones.php?MuestraDetallesComprasUpdate=si&codcompra="+codcompra); 
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Compras en este Módulo, realice la Eliminación completa de la Compra!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Compras, no eres el Administrador!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA ELIMINAR DETALLES DE COMPRAS EN AGREGAR
function EliminarDetalleCompraAgregar(coddetallecompra,codcompra,codproveedor,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetallecompra="+coddetallecompra+"&codcompra="+codcompra+"&codproveedor="+codproveedor+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#detallescomprasagregar').load("funciones.php?MuestraDetallesComprasAgregar=si&codcompra="+codcompra); 
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Compras en este Módulo, realice la Eliminación completa de la Compra!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Compras, no eres el Administrador!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA ELIMINAR COMPRAS 
function EliminarCompra(codcompra,codproveedor,status,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcompra="+codcompra+"&codproveedor="+codproveedor+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            if (status=="P") {
            $('#compras').load("consultas.php?CargaCompras=si");
            } else {
            $('#cuentasxpagar').load("consultas?CargaCuentasxPagar=si");
            }
            
          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Compras de Productos, no eres el Administrador!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA PAGAR FACTURA DE COMPRAS 
function PagarCompra(codcompra,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Pagar Esta Factura de Compra?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Pagar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcompra="+codcompra+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Factura Pagada!", "La Compra a sido Pagada con éxito!", "success");
            $('#cuentasxpagar').load("consultas.php?CargaCuentasxPagar=si");
                  
          } else { 

             swal("Oops", "Usted no tiene Acceso para Pagar Compras de Productos, no eres el Administrador!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA BUSQUEDA DE COMPRAS POR PROVEEDORES
function BuscarComprasxProveedores(){
                        
$('#muestracomprasxproveedores').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var codproveedor = $("select#codproveedor").val();
var dataString = $("#comprasxproveedores").serialize();
var url = 'funciones.php?BuscaComprasxProvedores=si';


$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestracomprasxproveedores').empty();
                $('#muestracomprasxproveedores').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
             }
      });
}


// FUNCION PARA BUSQUEDA DE COMPRAS POR FECHAS
function BuscarComprasxFechas(){
                        
$('#muestracomprasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#comprasxfechas").serialize();
var url = 'funciones.php?BuscaComprasxFechas=si';


$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestracomprasxfechas').empty();
                $('#muestracomprasxfechas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
             }
      });
}















/////////////////////////////////// FUNCIONES DE CAJAS DE VENTAS //////////////////////////////////////

// FUNCION PARA MOSTRAR CAJAS DE VENTAS EN VENTANA MODAL
function VerCaja(codcaja){

$('#muestracajamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaCajaModal=si&codcaja='+codcaja;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestracajamodal').empty();
                $('#muestracajamodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR CAJAS DE VENTAS
function UpdateCaja(codcaja,nrocaja,nomcaja,codigo,proceso) 
{
  // aqui asigno cada valor a los campos correspondientes
  $("#savecaja #codcaja").val(codcaja);
  $("#savecaja #nrocaja").val(nrocaja);
  $("#savecaja #nomcaja").val(nomcaja);
  $("#savecaja #codigo").val(codigo);
  $("#savecaja #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR CAJAS DE VENTAS 
function EliminarCaja(codcaja,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Caja para Ventas?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codcaja="+codcaja+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#cajas').load("consultas?CargaCajas=si");
            $("#savecaja")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Esta Caja para Venta no puede ser Eliminada, tiene Ventas relacionados!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Cajas para Ventas, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}


// FUNCION PARA MOSTRAR CAJAS POR SUCURSAL
function CargaCajas(codsucursal){

$('#codcaja').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');
                
var dataString = 'BuscaCajasxSucursal=si&codsucursal='+codsucursal;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#codcaja').empty();
                $('#codcaja').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
           }
      });
}

















/////////////////////////////////// FUNCIONES DE ARQUEOS DE CAJAS PARA VENTAS //////////////////////////////////////

// FUNCION PARA MOSTRAR ARQUEOS DE CAJAS PARA VENTAS EN VENTANA MODAL
function VerArqueo(codarqueo){

$('#muestraarqueomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaArqueoModal=si&codarqueo='+codarqueo;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraarqueomodal').empty();
                $('#muestraarqueomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR ARQUEOS DE CAJAS PARA VENTAS
function CerrarArqueo(codarqueo,nrocaja,responsable,montoinicial,ingresos,egresos,creditos,abonos,estimado,fechaapertura) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savecerrararqueo #codarqueo").val(codarqueo);
  $('label[id*="nrocaja"]').text(nrocaja);
  $("#savecerrararqueo #responsable").val(responsable);
  $("#savecerrararqueo #montoinicial").val(montoinicial);
  $("#savecerrararqueo #ingresos").val(ingresos);
  $("#savecerrararqueo #egresos").val(egresos);
  $("#savecerrararqueo #creditos").val(creditos);
  $("#savecerrararqueo #abonos").val(abonos);
  $("#savecerrararqueo #estimado").val(estimado);
  $("#savecerrararqueo #fechaapertura").val(fechaapertura);
}

//FUNCION PARA CALCULAR LA DIFERENCIA EN CIERRE DE CAJA
$(document).ready(function (){
  $('.cierrecaja').keyup(function (){
      
    var efectivo = $('input#dineroefectivo').val();
    var estimado = $('input#estimado').val();
            
    //REALIZO EL CALCULO Y MUESTRO LA DEVOLUCION
    total = parseFloat(efectivo - estimado);
    var original = parseFloat(total.toFixed(2));
    $("#diferencia").val(original.toFixed(2));
      
  });
});


// FUNCION PARA ACTUALIZAR ARQUEOS DE CAJAS PARA VENTAS
function UpdateArqueo(codarqueo,nrocaja,responsable,montoinicial,ingresos,egresos,creditos,abonos,estimado,dineroefectivo,diferencia,comentarios,fechaapertura,fechacierre) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#updatearqueo #codarqueo").val(codarqueo);
  $("#updatearqueo #responsable").val(responsable);
  $("#updatearqueo #montoinicial").val(montoinicial);
  $("#updatearqueo #ingresos").val(ingresos);
  $("#updatearqueo #egresos").val(egresos);
  $("#updatearqueo #creditos").val(creditos);
  $("#updatearqueo #abonos").val(abonos);
  $("#updatearqueo #estimado2").val(estimado);
  $("#updatearqueo #dineroefectivo2").val(dineroefectivo);
  $("#updatearqueo #diferencia2").val(diferencia);
  $("#updatearqueo #comentarios").val(comentarios);
  $("#updatearqueo #fechaapertura").val(fechaapertura);
  $("#updatearqueo #fechacierre").val(fechacierre);
}

//FUNCION PARA CALCULAR LA DIFERENCIA EN CIERRE DE CAJA
$(document).ready(function (){
  $('.updatecaja').keyup(function (){
      
    var efectivo = $('input#dineroefectivo2').val();
    var estimado = $('input#estimado2').val();
            
    //REALIZO EL CALCULO Y MUESTRO LA DEVOLUCION
    total = parseFloat(efectivo - estimado);
    var original = parseFloat(total.toFixed(2));
    $("#diferencia2").val(original.toFixed(2));
      
  });
});

//FUNCION PARA BUSQUEDA DE ARQUEOS DE CAJAS POR FECHAS PARA REPORTES
function BuscarArqueosxFechas(){
                  
$('#muestraarqueosxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codcaja = $("select#codcaja").val();
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#arqueosxfechas").serialize();
var url = 'funciones.php?BuscaArqueosxFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraarqueosxfechas').empty();
                $('#muestraarqueosxfechas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
               }
      }); 
}














/////////////////////////////////// FUNCIONES DE MOVIMIENTOS EN CAJAS DE VENTAS //////////////////////////////////////

// FUNCION PARA MOSTRAR MOVIMIENTO EN CAJAS DE VENTAS EN VENTANA MODAL
function VerMovimiento(codmovimiento){

$('#muestramovimientomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaMovimientoModal=si&codmovimiento='+codmovimiento;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestramovimientomodal').empty();
                $('#muestramovimientomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR MOVIMIENTOS EN CAJAS DE VENTAS
function UpdateMovimiento(codmovimiento,codcaja,tipomovimiento,descripcionmovimiento,montomovimiento,codmediopago,fechamovimiento,codarqueo,proceso) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savemovimiento #codmovimiento").val(codmovimiento);
  $("#savemovimiento #codcaja").val(codcaja);
  $("#savemovimiento #tipomovimiento").val(tipomovimiento);
  $("#savemovimiento #tipomovimientobd").val(tipomovimiento);
  $("#savemovimiento #descripcionmovimiento").val(descripcionmovimiento);
  $("#savemovimiento #montomovimiento").val(montomovimiento);
  $("#savemovimiento #montomovimientobd").val(montomovimiento);
  $("#savemovimiento #codmediopago").val(codmediopago);
  $("#savemovimiento #codmediopagobd").val(codmediopago);
  $("#savemovimiento #fecharegistro").val(fechamovimiento);
  $("#savemovimiento #codarqueo").val(codarqueo);
  $("#savemovimiento #proceso").val(proceso);
}

/////FUNCION PARA ELIMINAR MOVIMIENTOS EN CAJAS DE VENTAS 
function EliminarMovimiento(codmovimiento,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Movimiento en Caja para Ventas?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codmovimiento="+codmovimiento+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#movimientos').load("consultas?CargaMovimientos=si");
            $("#savemovimiento")[0].reset();
                  
          } else if(data==2){ 

             swal("Oops", "Este Movimiento en Caja para Venta no puede ser Eliminado, se encuentra Desactivado!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Movimiento en Cajas para Ventas, no eres el Administrador o Cajero del Sistema!", "error"); 

                }
            }
        })
    });
}

//FUNCION PARA BUSQUEDA DE MOVIMIENTOS DE CAJAS POR FECHAS PARA REPORTES
function BuscarMovimientosxFechas(){
                  
$('#muestramovimientosxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codcaja = $("select#codcaja").val();
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#movimientosxfechas").serialize();
var url = 'funciones.php?BuscaMovimientosxFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestramovimientosxfechas').empty();
                $('#muestramovimientosxfechas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
               }
      }); 
}


















/////////////////////////////////// FUNCIONES DE RESERVACIONES //////////////////////////////////////

// FUNCION PARA BUSCAR CLIENTES PARA RESERVACIONES EN WEB
function BuscarCliente(busqueda){
                        
$('#muestraclientes').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, verificando información ......</center>');

var dataString = 'BuscarClientes=si&busqueda='+busqueda;

$.ajax({
            type: "GET",
            url: "funciones_reservaciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraclientes').empty(); 
                $('#muestraclientes').append(''+response+'').fadeIn("slow");  
             }
      });
}

// FUNCION PARA MOSTRAR CONDICIONES DE PAGO EN EB
function CondicionesPagosWeb(busqueda_forma){

var dataString = 'BuscaCondicionPago=si&busqueda_forma='+busqueda_forma;

$.ajax({
            type: "GET",
            url: "funciones_reservaciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraformaspago').empty();
                $('#muestraformaspago').append(''+response+'').fadeIn("slow");
            }
      });
}


// FUNCION PARA BUSCAR HABITACIONES
function BuscarHabitaciones(){
                        
$('#muestrahabitaciones').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, verificando información ......</center>');
                
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var adultos = $("select#adultos").val();
var children = $("select#children").val();
var tipo = $("input#tipo").val();
var dataString = $("#savereservaciones").serialize();
var url = 'funciones_reservaciones.php?BuscarHabitaciones=si';


$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrahabitaciones').empty(); 
                $('#muestradetallesreservacion').html("");
                $('#muestrahabitaciones').append(''+response+'').fadeIn("slow");  
                //$('#'+parent).remove();
             }
      });
}

// FUNCION PARA BUSCAR HABITACIONES
function BuscarHabitacionesWeb(){
                        
$('#muestrahabitaciones').html('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, verificando información ......</center>');
                
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var adultos = $("select#adultos").val();
var children = $("select#children").val();
var tipo = $("input#tipo").val();
var dataString = $("#savereservacionesweb").serialize();
var url = 'funciones_reservaciones.php?BuscarHabitaciones=si';


$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrahabitaciones').empty(); 
                $('#muestradetallesreservacion').html("");
                $('#muestrahabitaciones').append(''+response+'').fadeIn("slow");  
             }
      });
}

// FUNCION PARA ACTIVAR COMBOBOX EN HABITACIONES
function ActivarCombo(indice){

    var check=document.getElementById('check_'+ indice);
    var combo1=document.getElementById('cantadultos_'+ indice);
    var combo2=document.getElementById('cantchildren_'+ indice);
 
  if(check.checked == true){
      combo1.disabled = false;
      combo2.disabled = false;
  } else {
      combo1.disabled = true;
      combo2.disabled = true;
  }
}

// FUNCION PARA LIMPIAR CAMPOS EN TABS
function CargaTab(busqueda_forma){

var dataString = 'BuscaTabsReservacion=si&busqueda_forma='+busqueda_forma;

$.ajax({
            type: "GET",
            url: "funciones_reservaciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestratabs').empty();
                $('#muestratabs').append(''+response+'').fadeIn("slow");
            }
      });
}

// FUNCION PARA LIMPIAR CAMPOS PARA RESERVACIONES
function LimpiarTabs(){

$('#montopagado').val("");
$('#montodevuelto').val("0.00");
$('#nrotarjeta').val("");
$('#tarjeta').val("");
$('#expira').val("");
$('#codverifica').val("");
$('#sel_file').val("");
$('#cheque').val("");
$('#fechavencecredito').val("");
$('#montoabono').val("0.00");
$('#observaciones').val("");
}

function EfectivoReserva(){

  if ($('input#txtTotal').val()==0.00 || $('input#txtTotal').val()==0) {
              
        $("#montopagado").val("");
        swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON LA VENTA DE PRODUCTOS!", "error");

        return false;
   
  } else {
      
      var montototal = $('input#txtTotal').val();
      var montopagado = $('input#montopagado').val();
      var montodevuelto = $('input#montodevuelto').val();
            
      //REALIZO EL CALCULO Y MUESTRO LA DEVOLUCION
      total=montopagado - montototal;
      var original=parseFloat(total.toFixed(2));

      $("#montodevuelto").val((montopagado == "" || montopagado == "0") ? "0.00" : original.toFixed(2));
      $("#devolucion").val((montopagado == "" || montopagado == "0") ? "0.00" : original.toFixed(2));
    }
}

// FUNCION PARA MOSTRAR RESERVACIONES EN VENTANA MODAL
function Prueba(check,desde,hasta){

      $(":checkbox").on('change', function() { 

     var group=[]; //DEFINED THE ARRAY 
     var mygroup = {}; // DEFINED THE OBJECT 
     $(':checkbox:checked').each(function(i){ 
       var val= this.value; 
       var id = this.id; 
       var desde = $("input#desde").val();
       var hasta = $("input#hasta").val();

     mygroup[id]=val; //PUSH VALUES TO THE OBJECT mygroup 
     var all = id+"="+val; 

      //alert("prueba " + all);

     group.push(all); // PUSH ALL CHECKBOX VALUES TO ARRAY 
     $.ajax({ type: "GET", 
      url: 'funciones.php?BuscaHabitacionesReservadas=si&check='+val+'&desde='+desde+'&hasta='+hasta, 
        //url: 'funciones.php?BuscaHabitacionesReservadas=si&check='+all+'&desde='+desde+'&hasta='+hasta, 
     data : mygroup, //TRIED WITH group and all also. Doesn't work. 
     success: function(data){ 
      $("#muestradetallesreservacion").html(data); 
        } 
      });
    }); 
  }); 
}



// FUNCION PARA MOSTRAR RESERVACIONES EN VENTANA MODAL
function VerReservacion(codreservacion){

$('#muestrareservacionmodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaReservacionModal=si&codreservacion='+codreservacion;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrareservacionmodal').empty();
                $('#muestrareservacionmodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

/////FUNCION PARA ACTIVAR RESERVACIONES PENDIENTES 
function ActivarReservacion(codreservacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de realizar la Activación de esta Reservación?",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Activar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codreservacion="+codreservacion+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Reservación Activada!", "La Reservación se ha Activado con éxito!", "success");
            $('#reservaciones').load("consultas.php?CargaReservaciones=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Reservación no puede ser Activada en la Fecha Actual, la Fecha de Entrada es Mayor a la Actual!", "error"); 

          } else {  

             swal("Oops", "Usted no tiene Acceso para activar Reservación de Habitaciones!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA CULMINAR RESERVACIONES PENDIENTES 
function CulminarReservacion(codreservacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de realizar la Culminación de esta Reservación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Culminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codreservacion="+codreservacion+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Reservación Culminada!", "La Reservación se ha Culminado con éxito!", "success");
            $('#reservaciones').load("consultas.php?CargaReservaciones=si");
                  
          } else if(data==2){ 

             swal("Oops", "Esta Reservación no puede ser Culminada en la Fecha Actual, la Fecha de Salida es Mayor a la Actual!", "error"); 

          } else { 

             swal("Oops", "Usted no tiene Acceso para Culminar Reservación de Habitaciones!", "error"); 

                }
            }
        })
    });
}

// FUNCION PARA ACTUALIZAR RESERVACIONES
function UpdateReservacion(codreservacion) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Reservación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "editreservacion?codreservacion="+codreservacion;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}

/////FUNCION PARA ELIMINAR DETALLES DE RESERVACIONES EN VENTANA MODAL
function EliminarDetalleReservacionModal(coddetallereservacion,codreservacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Reservación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetallereservacion="+coddetallereservacion+"&codreservacion="+codreservacion+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#muestrareservacionmodal').load("funciones.php?BuscaReservacionModal=si&codreservacion="+codreservacion); 
            $('#reservaciones').load("consultas.php?CargaReservaciones=si");    
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Reservación en este Módulo, realice la Eliminación completa de la Reservacion!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Reservaciones, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}


/////FUNCION PARA ELIMINAR DETALLES DE RESERVACIONES EN ACTUALIZAR
function EliminarDetalleReservacionUpdate(coddetallereservacion,codreservacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Reservación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetallereservacion="+coddetallereservacion+"&codreservacion="+codreservacion+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#detallesreservacionesupdate').load("funciones.php?MuestraDetallesReservacionesUpdate=si&codreservacion="+codreservacion);
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Reservación en este Módulo, realice la Eliminación completa de la Reservacion!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Reservaciones, no eres el Administrador del Sistema!", "error"); 

                }                
            }
        })
    });
}

/////FUNCION PARA ELIMINAR RESERVACIONES 
function EliminarReservacion(codreservacion,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Reservación?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codreservacion="+codreservacion+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#reservaciones').load("consultas.php?CargaReservaciones=si");
                  
          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Reservaciones, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}


//FUNCION PARA BUSQUEDA DE RESERVACIONES POR CAJAS Y FECHAS
function BuscarReservacionesxCajas(){
                  
$('#muestrareservacionesxcajas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codcaja = $("select#codcaja").val();
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#reservacionesxcajas").serialize();
var url = 'funciones.php?BuscaReservacionesxCajas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrareservacionesxcajas').empty();
                $('#muestrareservacionesxcajas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
               }
      }); 
}

// FUNCION PARA BUSQUEDA DE RESERVACIONES POR FECHAS
function BuscarReservacionesxFechas(){
                        
$('#muestrareservacionesxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#reservacionesxfechas").serialize();
var url = 'funciones.php?BuscaReservacionesxFechas=si';

$.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrareservacionesxfechas').empty();
                $('#muestrareservacionesxfechas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
             }
      });
}


//FUNCION PARA BUSQUEDA DE RESERVACIONES POR CLIENTES
function BuscarReservacionesxClientes(){
                  
$('#muestrareservacionesxclientes').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codcliente = $("input#codcliente").val();
var dataString = $("#reservacionesxclientes").serialize();
var url = 'funciones.php?BuscaReservacionesxClientes=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrareservacionesxclientes').empty();
                $('#muestrareservacionesxclientes').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
               }
      }); 
}

























/////////////////////////////////// FUNCIONES DE VENTAS //////////////////////////////////////

//FUNCION PARA CALCULAR DEVOLUCION DE MONTO
function CalculoDevolucion(){
      
    if ($('input#txtTotal').val()==0.00 || $('input#txtTotal').val()==0 || $('input#txtTotal').val()=="") {
              
        $("#montopagado").val("0.00");
        swal("Oops", "POR FAVOR AGREGUE DETALLES PARA CONTINUAR CON EL PROCESO DE REGISTRO!", "error");
        return false;
   
    } else {
      
    var montototal = $('input#txtTotal').val();
    var montopagado = $('input#montopagado').val();
    var montodevuelto = $('input#montodevuelto').val(); 
            
    //REALIZO EL CALCULO Y MUESTRO LA DEVOLUCION
    var sumtotal = parseFloat(montototal);
    var Sumatoria = parseFloat(sumtotal.toFixed(2));

    var sumpagado = parseFloat(montopagado);
    var subtotal= parseFloat(sumpagado);
    total = parseFloat(sumpagado) - parseFloat(sumtotal);
    var original = parseFloat(total.toFixed(2));

    $("#TextImporte").text((montopagado == "" || montopagado == "0" || montopagado == "0.00") ? Sumatoria.toFixed(2) : Sumatoria.toFixed(2));
    $("#txtImporte").val((montopagado == "" || montopagado == "0" || montopagado == "0.00") ? Sumatoria.toFixed(2) : Sumatoria.toFixed(2));
    $("#TextPagado").text((montopagado == "" || montopagado == "0" || montopagado == "0.00") ? sumtotal : sumpagado.toFixed(2));
    $("#TextCambio").text((montopagado == "" || montopagado == "0" || montopagado == "0.00") ? sumtotal : original.toFixed(2));
    $("#montodevuelto").val((montopagado == "" || montopagado == "0" || montopagado == "0.00") ? sumtotal : original.toFixed(2));
   }
}

// FUNCION PARA MOSTRAR CONDICIONES DE PAGO
function CargaCondicionesPagos(){
    
var tipopago = $('input:radio[name=tipopago]:checked').val();
var montototal = $('input#txtTotal').val();

var sumtotal = parseFloat(montototal);
var Sumatoria = parseFloat(sumtotal.toFixed(2));

$("#TextImporte").text(Sumatoria.toFixed(2));
$("#TextPagado").text(tipopago == "CREDITO" ? "0.00" : montototal);
$("#TextCambio").text("0.00");

var dataString = 'BuscaCondicionesPagos=si&tipopago='+tipopago+"&txtTotal="+montototal;

    $.ajax({
        type: "GET",
            url: "formas_pagos.php",
            data: dataString,
            success: function(response) {            
            $('#condiciones').empty();
            $('#condiciones').append(''+response+'').fadeIn("slow");                
        }
    });
}

// FUNCION PARA MOSTRAR CONDICIONES DE PAGO
function CargaMedioPago(codmediopago){

var dataString = 'MuestraMediosPagos=si&codmediopago='+codmediopago;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#mediopagos').empty();
                $('#mediopagos').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}



// FUNCION PARA CERRA CAJA EN VENTA
function CerrarCaja(){

$('#cierrecaja').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = "MuestraCajaVenta=si";

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#cierrecaja').empty();
                $('#cierrecaja').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA MOSTRAR VENTAS EN VENTANA MODAL
function VerVenta(codventa){

$('#muestraventamodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaVentaModal=si&codventa='+codventa;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraventamodal').empty();
                $('#muestraventamodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ACTUALIZAR VENTAS
function UpdateVenta(codventa,proceso) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Actualizar esta Venta de Producto?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Actualizar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forventa?codventa="+codventa+"&proceso="+proceso;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}


// FUNCION PARA AGREGAR DETALLES A VENTAS
function AgregaDetalleVenta(codventa,proceso) {

  swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Agregar Detalles de Productos a esta Venta?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Continuar",
          confirmButtonColor: "#3085d6"
        }, function(isConfirm) {
    if (isConfirm) {
      location.href = "forventa?codventa="+codventa+"&proceso="+proceso;
      // handle confirm
    } else {
      // handle all other cases
    }
  })
}


/////FUNCION PARA ELIMINAR DETALLES DE VENTAS EN VENTANA MODAL
function EliminarDetalleVentaModal(coddetalleventa,codventa,codcliente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Venta?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetalleventa="+coddetalleventa+"&codventa="+codventa+"&codcliente="+codcliente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#muestraventamodal').load("funciones.php?BuscaVentaModal=si&codventa="+codventa); 
            $('#ventas').load("consultas.php?CargaVentas=si");    
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Ventas en este Módulo, realice la Eliminación completa de la Venta!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Ventas, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}


/////FUNCION PARA ELIMINAR DETALLES DE VENTAS EN ACTUALIZAR
function EliminarDetalleVentaUpdate(coddetalleventa,codventa,codcliente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Venta?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetalleventa="+coddetalleventa+"&codventa="+codventa+"&codcliente="+codcliente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#detallesventasupdate').load("funciones.php?MuestraDetallesVentasUpdate=si&codventa="+codventa); 
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Ventas en este Módulo, realice la Eliminación completa de la Venta!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Ventas, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA ELIMINAR DETALLES DE VENTAS EN AGREGAR
function EliminarDetalleVentaAgregar(coddetalleventa,codventa,codcliente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar este Detalle de Venta?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "coddetalleventa="+coddetalleventa+"&codventa="+codventa+"&codcliente="+codcliente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#detallesventasagregar').load("funciones.php?MuestraDetallesVentasAgregar=si&codventa="+codventa); 
          
          } else if(data==2){ 

             swal("Oops", "No puede Eliminar todos los Detalles de Ventas en este Módulo, realice la Eliminación completa de la Venta!", "error"); 

          } else { 

             swal("Oops", "No tiene Acceso para Eliminar Detalles de Ventas, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}

/////FUNCION PARA ELIMINAR VENTAS 
function EliminarVenta(codventa,codcliente,tipo) {
        swal({
          title: "¿Estás seguro?", 
          text: "¿Estás seguro de Eliminar esta Venta?", 
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtonColor: '#d33',
          closeOnConfirm: false,
          confirmButtonText: "Eliminar",
          confirmButtonColor: "#3085d6"
        }, function() {
             $.ajax({
                  type: "GET",
                  url: "eliminar.php",
                  data: "codventa="+codventa+"&codcliente="+codcliente+"&tipo="+tipo,
                  success: function(data){

          if(data==1){

            swal("Eliminado!", "Datos eliminados con éxito!", "success");
            $('#ventas').load("consultas.php?CargaVentas=si");
                  
          } else { 

             swal("Oops", "Usted no tiene Acceso para Eliminar Ventas de Productos, no eres el Administrador del Sistema!", "error"); 

                }
            }
        })
    });
}


//FUNCION PARA BUSQUEDA DE VENTAS POR CAJAS Y FECHAS
function BuscarVentasxCajas(){
                  
$('#muestraventasxcajas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codcaja = $("select#codcaja").val();
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#ventasxcajas").serialize();
var url = 'funciones.php?BuscaVentasxCajas=si';

$.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraventasxcajas').empty();
                $('#muestraventasxcajas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
               }
      }); 
}

// FUNCION PARA BUSQUEDA DE VENTAS POR FECHAS
function BuscarVentasxFechas(){
                        
$('#muestraventasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#ventasxfechas").serialize();
var url = 'funciones.php?BuscaVentasxFechas=si';

$.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraventasxfechas').empty();
                $('#muestraventasxfechas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
             }
      });
}

// FUNCION PARA BUSQUEDA DE GANANCIAS VENTAS X FECHAS
function BuscaGananciasVentasxFechas(){
    
$('#muestradetallesventasxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codsucursal = $("#codsucursal").val();
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#detallesventasxfechas").serialize();
var url = 'funciones.php?BuscaDetallesVentasxFechas=si';

        $.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {
                $('#muestradetallesventasxfechas').empty();
                $('#muestradetallesventasxfechas').append(''+response+'').fadeIn("slow");
            }
      }); 
}
















/////////////////////////////////// FUNCIONES DE CREDITOS //////////////////////////////////////

// FUNCION PARA MOSTRAR VENTA DE CREDITO EN RESERVACIONES EN VENTANA MODAL
function VerCredito(codproceso,url){

$('#muestracreditomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaCreditoModal=si&codproceso='+codproceso+"&url="+url;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestracreditomodal').empty();
                $('#muestracreditomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ABONAR PAGO A CREDITOS EN RESERVACIONES
function AbonoCreditoReservacion(codcliente,codreservacion,dnicliente,nomcliente,nroreservacion,totalfactura,fechaventa,totaldebe,totalabono) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savepagoreservaciones #codcliente").val(codcliente);
  $("#savepagoreservaciones #codreservacion").val(codreservacion);
  $("#savepagoreservaciones #dnicliente").val(dnicliente);
  $("#savepagoreservaciones #nomcliente").val(nomcliente);
  $("#savepagoreservaciones #nroreservacion").val(nroreservacion);
  $("#savepagoreservaciones #totalfactura").val(totalfactura);
  $("#savepagoreservaciones #fechaventa").val(fechaventa);
  $("#savepagoreservaciones #totaldebe").val(totaldebe);
  $("#savepagoreservaciones #debe").val(totaldebe);
  $("#savepagoreservaciones #totalabono").val(totalabono);
  $("#savepagoreservaciones #abono").val(totalabono);
}

// FUNCION PARA MOSTRAR VENTA DE CREDITO EN VENTA EN VENTANA MODAL
function VerCreditoVenta(codventa,tipo){

$('#muestracreditomodal').html('<center><i class="fa fa-spin fa-spinner"></i> Cargando información, por favor espere....</center>');

var dataString = 'BuscaCreditoModal=si&codventa='+codventa+"&tipo="+tipo;

$.ajax({
            type: "GET",
                  url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestracreditomodal').empty();
                $('#muestracreditomodal').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
            }
      });
}

// FUNCION PARA ABONAR PAGO A CREDITOS EN VENTAS
function AbonoCreditoVenta(codcliente,codventa,dnicliente,nomcliente,nroventa,totalfactura,fechaventa,totaldebe,totalabono) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#savepagoventas #codcliente").val(codcliente);
  $("#savepagoventas #codventa").val(codventa);
  $("#savepagoventas #dnicliente").val(dnicliente);
  $("#savepagoventas #nomcliente").val(nomcliente);
  $("#savepagoventas #nroventa").val(nroventa);
  $("#savepagoventas #totalfactura").val(totalfactura);
  $("#savepagoventas #fechaventa").val(fechaventa);
  $("#savepagoventas #totaldebe").val(totaldebe);
  $("#savepagoventas #debe").val(totaldebe);
  $("#savepagoventas #totalabono").val(totalabono);
  $("#savepagoventas #abono").val(totalabono);
}

//FUNCION PARA BUSQUEDA DE CREDITOS POR CLIENTES Y FECHAS
function BuscarCreditosxClientes(){
                  
$('#muestracreditosxclientes').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var codcliente = $("input#codcliente").val();
var url = $("input#url").val();
var dataString = $("#creditosxclientes").serialize();
var url = 'funciones.php?BuscaCreditosxClientes=si';

$.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#muestracreditosxclientes').empty();
                $('#muestracreditosxclientes').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
               }
      }); 
}

// FUNCION PARA BUSQUEDA DE CREDITOS POR FECHAS
function BuscarCreditosxFechas(){
                        
$('#muestracreditosxfechas').html('<center><i class="fa fa-spin fa-spinner"></i> Procesando información, por favor espere....</center>');

var url = $("input#url").val();
var desde = $("input#desde").val();
var hasta = $("input#hasta").val();
var dataString = $("#creditosxfechas").serialize();
var url = 'funciones.php?BuscaCreditosxFechas=si';

$.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#muestracreditosxfechas').empty();
                $('#muestracreditosxfechas').append(''+response+'').fadeIn("slow");
                //$('#'+parent).remove();
             }
      });
}
