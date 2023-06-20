//FUNCION PARA AGREGAR Y ELIMINAR CAMPOS DINAMICAMENTE

    var cont=1;
    
    //FUNCION AGREGA CAPACIDAD
    function Add()  //Esta la funcion que agrega las filas segunda parte :
   {
    cont++;
    //autocompletar//
    var indiceFila=1;
    myNewRow = document.getElementById('tabla').insertRow(-1);
    myNewRow.id=indiceFila;
    myNewCell=myNewRow.insertCell(-1);
    myNewCell.innerHTML='<div class="col-md-12"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="form-group has-feedback"><label class="control-label">Foto de Habitación: <span class="symbol required"></span></label><div class="input-group"><div class="form-control" data-trigger="fileinput"><i class="fa fa-file-photo-o fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-info btn-file"><span class="fileinput-new"><i class="fa fa-cloud-upload"></i> Selecciona Archivo</span><span class="fileinput-exists"><i class="fa fa-file-photo-o"></i> Cambiar</span><input type="file" title="Por favor realice la busqueda de Imagen" class="btn btn-default btn-file" data-original-title="Subir Imagen" data-rel="tooltip" placeholder="Suba su Imagen" name="file[]" id="file"></span><a href="#" class="input-group-addon btn btn-dark fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Quitar</a></div><small><p>Para Subir la Foto debe tener en cuenta:<br> * La Imagen debe ser extension.jpeg,jpg<br> * La imagen no debe ser mayor de 200 KB</p></small></div></div></div>';
    indiceFila++;
    }

    //FUNCION BORRAR CAPACIDAD
    function Delete() {
        var table = document.getElementById('tabla');
        if(table.rows.length > 1)
        {
        table.deleteRow(table.rows.length -1);
        cont--;
        }
    }

    ////////////FUNCION ASIGNA VALOR DE CONT PARA EL FOR DE MOSTRAR DATOS MP-MOD-TT////////
    function asigna() {
       valor=document.form.var_cont.value=cont;
    }

$(document).ready(function () {
                var doc = $(document);
                $('a.add-type').die('click').live('click', function (e) {
                    e.preventDefault();
                    var content = $('#type-container .type-row'),
                        element = null;
                    for (var i = 0; i < 1; i++) {
                        element = content.clone();
                        var type_div = 'teams_' + now();
                        element.attr('id', type_div);
                        element.find('.remove-type').attr('targetDiv', type_div);
                        element.appendTo('#type_container');

                    }
                });

                $(".remove-type").die('click').live('click', function (e) {
                    //var didConfirm = confirm("Are you sure You want to delete");
                    //if (didConfirm == true) {
                        var id = $(this).attr('data-id');
                        var targetDiv = $(this).attr('targetDiv');
                        //if (id == 0) {
                        //var trID = jQuery(this).parents("tr").attr('id');
                        $('#' + targetDiv).remove();
                        // }
                        //return true;
                    //} else {
                        //return false;
                    //}
                });

            });