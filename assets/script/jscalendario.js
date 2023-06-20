$(function () {
  $.datepicker.setDefaults($.datepicker.regional["es"]);
    $(".nacimiento").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     maxDate: 0,
     changeMonth: true,
     changeYear: true,
     yearRange: '1900:' + new Date().getFullYear()
  });
});


$('body').on('focus',".expira", function(){
   $(this).datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     //firstDay: 1,
     minDate: 0,
    //maxDate: 0,
    changeMonth: true,
    changeYear: true,
    yearRange: new Date().getFullYear() + ':2050'
  });
$('#ui-datepicker-div').appendTo($('.modal'));
});




$(function () {
    $(".calendario").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     maxDate: 0,
     changeMonth: true,
     changeYear: true,
     yearRange: '2019:2050'
   });
  $('#ui-datepicker-div').appendTo($('.modal'));
});




$(function () {
  $.datepicker.setDefaults($.datepicker.regional["es"]);
    $("#desde").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     changeMonth: true,
     changeYear: true,
     yearSuffix: '',
     onClose: function (selectedDate) {
      $("#hasta").datepicker("option", "minDate", selectedDate);
    }
  });

$("#hasta").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     changeMonth: true,
     changeYear: true,
     yearSuffix: '',
     onClose: function (selectedDate) {
      $("#desde").datepicker("option", "maxDate", selectedDate);
    }
  });
});


$(function () {
   $.datepicker.setDefaults($.datepicker.regional["es"]);
   $("#desde_r").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     minDate: 0,
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     changeMonth: true,
     changeYear: true,
     yearSuffix: '',
     onClose: function (selectedDate) {
      $("#hasta_r").datepicker("option", "minDate", selectedDate);
    }
  });

  $("#hasta_r").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     changeMonth: true,
     changeYear: true,
     yearSuffix: '',
     onClose: function (selectedDate) {
      $("#desde_r").datepicker("option", "maxDate", selectedDate);
    }
  });
});


$(function () {
   $.datepicker.setDefaults($.datepicker.regional["es"]);
   $("#a").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     minDate: 0,
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     changeMonth: true,
     changeYear: true,
     yearSuffix: '',
     onClose: function (selectedDate) {
      $("#b").datepicker("option", "minDate", selectedDate);
    }
  });

  $("#b").datepicker({
     closeText: 'Cerrar',
     prevText: '<Anterior',
     nextText: 'Siguiente>',
     currentText: 'Hoy',
     monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNames: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
     dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     changeMonth: true,
     changeYear: true,
     yearSuffix: '',
     onClose: function (selectedDate) {
      $("#a").datepicker("option", "maxDate", selectedDate);
    }
  });
});