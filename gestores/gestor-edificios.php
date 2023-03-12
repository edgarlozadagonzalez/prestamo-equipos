<?php
      include_once '../app/config.php';
      include_once '../app/Conexion.php';
      include_once '../app/Entidades/Edificio.php';
      include_once '../app/Repositorios/RepositorioEdificio.php';
      Conexion::abrirConexion();
      $array_edificios= RepositorioEdificio::obtenerEdificios(Conexion::obtenerConexion());
?>
<div class="row parte-gestor-gen">
    <div class="col-md-12">
        <h2>Gestion de edificios</h2>
        <br>
        <caption>
        <button class="btn btn-primary" data-toggle="modal" data-target="#Edificionuevo">
                Agregar edificio
            <span class="glyphicon glyphicon-plus"></span>
        </button> 
        <a class="btn btn-success" href="<?php echo RUTA_GESTOR_EDIFICIO;?>" role="button"><i class="fas fa-sync-alt"></i> Actualizar</a>
        </caption>
        <br>
        <br>
    </div>
</div>
<div class="row parte-gestor-gen">
    <div class="col-md-12">
        <?php
        if(count($array_edificios)>0){
        ?>
        <table class="table table-condensed" id="tablaEdificios">
          <thead>
              <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Pisos</th>
                  <th>Sede</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
              <?php
              for ($i=0; $i < count($array_edificios) ; $i++) { 
                  $edificio = $array_edificios[$i];
                  $datos = $edificio->obtenerCod_edif() . "||" .
                            $edificio->obtenerNombre_edif() . "||" .
                            $edificio->obtenerNum_pisos() . "||" .
                            $edificio->obtenerSede();
               ?>
               <tr>
                <td><?php echo $edificio->obtenerCod_edif();?></td>
                <td><?php echo $edificio->obtenerNombre_edif();?></td>
                <td><?php echo $edificio->obtenerNum_pisos();?></td>
                <td><?php echo $edificio->obtenerSede();?></td>
                <td>
                  <button type="button" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#Edificioeditar" onclick="agregaFormEdificio('<?php echo $datos ?>')"></button>
                  <button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="preguntarSiNoEdif('<?php echo $edificio->obtenerCod_edif() ?>')">
                  </button>
              </td>
              </tr>
              <?php 
              }
              ?>
          </tbody>  
        </table>
        <?php
        }else {
        ?> <h3 class="text-center">No hay edificios ingresados</h3>
            <br>
            <br>
            <br>
            <?php
        }
        ?>
    </div>
</div>
<!-- Modal para nuevos edificios -->
<div class="modal fade" id="Edificionuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Edificio</h4>
      </div>
      <div class="modal-body">
        <label>Nombre</label>
        <input type="text" name="" id="nombre_edif" class="form-control input-sm">
        <label>Pisos</label>
        <input type="number" name="" id="num_pisos" class="form-control input-sm">
        <label>Sede</label>
        <input type="text" name="" id="sede" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-backdrop="false" id="aggEdificionuevo">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar edificios -->
<div class="modal fade" id="Edificioeditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Edificio</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="cod_edifU" name="cod_edifU">
        <label>Nombre</label>
        <input type="hidden" id="nombre_edifC" name="nombre_edifC">
        <input type="text" name="" id="nombre_edifU" class="form-control input-sm">
        <label>Pisos</label>
        <input type="number" name="" id="num_pisosU" class="form-control input-sm">
        <label>Sede</label>
        <input type="text" name="" id="sedeU" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-backdrop="false" id="Updateedificio">Agregar</button>
      </div>
    </div>
  </div>
</div>

<?php Conexion::cerrarConexion();?>

<!-- Script para crear edificios y actualizar -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#aggEdificionuevo').click(function() {
            agregarEdificio()
        });
        $('#Updateedificio').click(function() {
            actualizarEdificio()
        });
    });
</script>

<!-- DATATABLE -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaEdificios').DataTable({
            "language": {
                "aria": {
                    "sortAscending": "Activar para ordenar la columna de manera ascendente",
                    "sortDescending": "Activar para ordenar la columna de manera descendente"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                    "fillHorizontal": "Rellenar celdas horizontalmente",
                    "fillVertical": "Rellenar celdas verticalmente"
                },
                "buttons": {
                    "collection": "Colección",
                    "colvis": "Visibilidad",
                    "colvisRestore": "Restaurar visibilidad",
                    "copy": "Copiar",
                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                    "copySuccess": {
                        "1": "Copiada 1 fila al portapapeles",
                        "_": "Copiadas %d fila al portapapeles"
                    },
                    "copyTitle": "Copiar al portapapeles",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todas las filas",
                        "_": "Mostrar %d filas"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir"
                },
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "infoThousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchBuilder": {
                    "add": "Añadir condición",
                    "button": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condición",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangría",
                    "title": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "value": "Valor",
                    "conditions": {
                        "date": {
                            "after": "Después",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "not": "Diferente de",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "gt": "Mayor a",
                            "gte": "Mayor o igual a",
                            "lt": "Menor que",
                            "lte": "Menor o igual a",
                            "not": "Diferente de",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vacío",
                            "endsWith": "Termina con",
                            "equals": "Igual a",
                            "not": "Diferente de",
                            "startsWith": "Inicia con",
                            "notEmpty": "No vacío"
                        },
                        "array": {
                            "equals": "Igual a",
                            "empty": "Vacío",
                            "contains": "Contiene",
                            "not": "Diferente",
                            "notEmpty": "No vacío",
                            "without": "Sin"
                        }
                    },
                    "data": "Datos"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de búsqueda",
                        "_": "Paneles de búsqueda (%d)"
                    },
                    "count": "{total}",
                    "emptyPanes": "Sin paneles de búsqueda",
                    "loadMessage": "Cargando paneles de búsqueda",
                    "title": "Filtros Activos - %d",
                    "countFiltered": "{shown} ({total})"
                },
                "select": {
                    "cells": {
                        "1": "1 celda seleccionada",
                        "_": "$d celdas seleccionadas"
                    },
                    "columns": {
                        "1": "1 columna seleccionada",
                        "_": "%d columnas seleccionadas"
                    }
                },
                "thousands": ",",
                "datetime": {
                    "previous": "Anterior",
                    "hours": "Horas",
                    "minutes": "Minutos",
                    "seconds": "Segundos",
                    "unknown": "-",
                    "amPm": [
                        "am",
                        "pm"
                    ],
                    "next": "Siguiente",
                    "months": {
                        "0": "Enero",
                        "1": "Febrero",
                        "10": "Noviembre",
                        "11": "Diciembre",
                        "2": "Marzo",
                        "3": "Abril",
                        "4": "Mayo",
                        "5": "Junio",
                        "6": "Julio",
                        "7": "Agosto",
                        "8": "Septiembre",
                        "9": "Octubre"
                    },
                    "weekdays": [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado"
                    ]
                },
                "editor": {
                    "close": "Cerrar",
                    "create": {
                        "button": "Nuevo",
                        "title": "Crear Nuevo Registro",
                        "submit": "Crear"
                    },
                    "edit": {
                        "button": "Editar",
                        "title": "Editar Registro",
                        "submit": "Actualizar"
                    },
                    "remove": {
                        "button": "Eliminar",
                        "title": "Eliminar Registro",
                        "submit": "Eliminar",
                        "confirm": {
                            "_": "¿Está seguro que desea eliminar %d filas?",
                            "1": "¿Está seguro que desea eliminar 1 fila?"
                        }
                    },
                    "multi": {
                        "title": "Múltiples Valores",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga click o toque aquí, de lo contrario conservarán sus valores individuales."
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\"> Más información<\/a>)."
                    }
                },
                "decimal": ".",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando de _START_ al _END_ de  _TOTAL_ registros",
                "zeroRecords": "No se encontraron coincidencias"
            },
            responsive: "true",
            dom: 'Bfrtip',
            buttons: [
                {extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                titleAttr: 'Exportar a Excel',
                className:'btb btn-success'
                },
                {extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                className:'btb btn-danger'
                },
                {extend: 'csvHtml5',
                text: '<i class="fas fa-file-csv"></i>',
                titleAttr: 'Exportar a CSV',
                className:'btb btn-success'
                },
                {extend: 'copyHtml5',
                text: '<i class="fas fa-copy"></i>',
                titleAttr: 'copiar',
                className:'btb btn-info'
                }
            ]
        });
    });
</script>