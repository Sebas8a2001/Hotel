$(function() {
           $("#busqueda").autocomplete({
           source: "class/busqueda_autocompleto.php?Busqueda_Cliente=si",
           minLength: 1,
           select: function(event, ui) { 
          $('#codcliente').val(ui.item.codcliente);
          $('#creditoinicial').val(ui.item.limitecredito);
          $('#montocredito').val(ui.item.creditodisponible);
          $('#creditodisponible').val(ui.item.creditodisponible);
          $('#TextCliente').text(ui.item.nomcliente);
          $('#TextCredito').text(ui.item.creditodisponible);
           }  
      });
 });


$(function() {
    $("#busquedainsumo").autocomplete({
        source: "class/busqueda_autocompleto.php?Busqueda_Insumo=si",
        minLength: 1,
        select: function(event, ui) {
            $('#codinsumo').val(ui.item.codinsumo);
            $('#insumo').val(ui.item.insumo);
            $('#codcategoria').val(ui.item.codcategoria);
            $('#precioventa').val(ui.item.precioventa);
            $('#existencia').val(ui.item.existencia);
            $('#ivainsumo').val(ui.item.ivainsumo);
            $('#descinsumo').val(ui.item.descinsumo);
            $('#fechaexpiracion').val(ui.item.fechaexpiracion);
            $('#codproveedor').val(ui.item.codproveedor);
        }
    });
});


$(function() {
    $("#buscakardexinsumo").autocomplete({
      source: "class/busqueda_autocompleto.php?Busqueda_Kardex_Insumo=si",
      minLength: 1,
      select: function(event, ui) {
        $('#codinsumo').val(ui.item.codinsumo);
      }
    });
});


 // FUNCION AUTOCOMPLETE
$(function() {

    $("#busquedatipo").keyup(function() {

        var tipo = $('select#tipoentrada').val();

        if (tipo == "") {

            $("#tipoentrada").focus();
            $('#tipoentrada').css('border-color', '#2cabe3');
            $("#busquedatipo").val("");
            swal("Oops", "POR FAVOR SELECCIONE EL TIPO DE ENTRADA!", "error");
            return false;

        } else if (tipo == "PRODUCTO") {

          $("#busquedatipo").autocomplete({
            source: "class/busqueda_autocompleto.php?Busqueda_Producto_Compra=si",
            minLength: 1,
            select: function(event, ui) {
              $('#codproducto').val(ui.item.codproducto);
              $('#producto').val(ui.item.producto);
              $('#codcategoria').val(ui.item.codcategoria);
              $('#categorias').val(ui.item.nomcategoria);
              $('#preciocompra').val(ui.item.preciocompra);
              $('#precioventa').val(ui.item.precioventa);
              $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.preciocompra : "0.00");
              $('#existencia').val(ui.item.existencia);
              $('#ivaproducto').val(ui.item.ivaproducto);
              $('#descproducto').val(ui.item.descproducto);
              $("#cantidad").focus();
            }
          });

          return false;

        } else if (tipo == "INSUMO") {

          $("#busquedatipo").autocomplete({
            source: "class/busqueda_autocompleto.php?Busqueda_Insumo=si",
            minLength: 1,
            select: function(event, ui) {
              $('#codproducto').val(ui.item.codinsumo);
              $('#producto').val(ui.item.insumo);
              $('#codcategoria').val(ui.item.codcategoria);
              $('#categorias').val(ui.item.nomcategoria);
              $('#preciocompra').val(ui.item.preciocompra);
              $('#precioventa').val(ui.item.precioventa);
              $('#precioconiva').val((ui.item.ivainsumo == "SI") ? ui.item.preciocompra : "0.00");
              $('#existencia').val(ui.item.existencia);
              $('#ivaproducto').val(ui.item.ivainsumo);
              $('#descproducto').val(ui.item.descinsumo);
              $("#cantidad").focus();
            }
          });

        }
    });
});


$(function() {
    $("#busquedaproducto").autocomplete({
        source: "class/busqueda_autocompleto.php?Busqueda_Producto_Venta=si",
        minLength: 1,
        select: function(event, ui) {
            $('#codproducto').val(ui.item.codproducto);
            $('#producto').val(ui.item.producto);
            $('#codcategoria').val(ui.item.codcategoria);
            $('#categorias').val(ui.item.nomcategoria);
            $('#preciocompra').val(ui.item.preciocompra);
            $('#precioventa').val(ui.item.precioventa);
            $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.precioventa : "0.00");
            $('#existencia').val(ui.item.existencia);
            $('#ivaproducto').val(ui.item.ivaproducto);
            $('#descproducto').val(ui.item.descproducto);
            $("#cantidad").val("1");
        }
    });
});

$(function() {
    $("#busquedaproductov").autocomplete({
        source: "class/busqueda_autocompleto.php?Busqueda_Producto_Venta=si",
        minLength: 1,
        select: function(event, ui) {
            $('#codproducto').val(ui.item.codproducto);
            $('#producto').val(ui.item.producto);
            $('#codcategoria').val(ui.item.codcategoria);
            $('#categorias').val(ui.item.nomcategoria);
            $('#preciocompra').val(ui.item.preciocompra);
            $('#precioventa').val(ui.item.precioventa);
            $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.precioventa : "0.00");
            $('#existencia').val(ui.item.existencia);
            $('#ivaproducto').val(ui.item.ivaproducto);
            $('#descproducto').val(ui.item.descproducto);
            $("#cantidad").focus();
        }
    });
});

// FUNCION AUTOCOMPLETE SEGUN TIPO BUSQUEDA
$(function() {
      $("#search_busqueda_pos").autocomplete({
      source: "class/busqueda_autocompleto.php?Busqueda_Producto_Venta=si",
      minLength: 1,
      select: function(event, ui) {
          $('#codproducto').val(ui.item.codproducto);
          $('#producto').val(ui.item.producto);
          $('#codcategoria').val(ui.item.codcategoria);
          $('#categorias').val(ui.item.nomcategoria);
          $('#preciocompra').val(ui.item.preciocompra);
          $('#precioventa').val(ui.item.precioventa);
          $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.precioventa : "0.00");
          $('#existencia').val(ui.item.existencia);
          $('#ivaproducto').val(ui.item.ivaproducto);
          $('#descproducto').val(ui.item.descproducto);
          $("#search_busqueda_pos").focus();
          setTimeout(function() {
              var e = jQuery.Event("keypress");
              e.which = 13;
              e.keyCode = 13;
              $("#search_busqueda_pos").trigger(e);
          }, 100);
        }
    });
});


$(function() {
    $("#buscakardexproducto").autocomplete({
      source: "class/busqueda_autocompleto.php?Busqueda_Kardex_Producto=si",
      minLength: 1,
      select: function(event, ui) {
        $('#codproducto').val(ui.item.codproducto);
      }
    });
});