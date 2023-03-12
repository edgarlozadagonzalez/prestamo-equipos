<?php
      include_once '../app/config.php';
      include_once '../app/Conexion.php';
      include_once '../app/Entidades/Equipo.php';
      include_once '../app/Entidades/Persona.php';
      include_once '../app/Entidades/Prestamo.php';
      include_once '../app/Repositorios/RepositorioEquipo.php';
      include_once '../app/Repositorios/RepositorioPersona.php';
      include_once '../app/Repositorios/RepositorioPrestamo.php';
      Conexion::abrirConexion();
      $array_prestamos = RepositorioPrestamo::obtenerPrestamos(Conexion::obtenerConexion());
      $array_personas = RepositorioPersona::obtenerPersonas(Conexion::obtenerConexion());
      $array_equipos= RepositorioEquipo::obtenerEquipos(Conexion::obtenerConexion());
?>
<div class="row parte-gestor-gen">
    <div class="col-md-12">
        <h2>Gestion de prestamos</h2>
        <br>
        <caption>
        <button class="btn btn-primary" data-toggle="modal" data-target="#Prestamonuevo">
                Agregar prestamo
            <span class="glyphicon glyphicon-plus"></span>
        </button> 
        <a class="btn btn-success" href="<?php echo RUTA_GESTOR_PRESTAMOS;?>" role="button">Actualizar</a>
        </caption>
        <br>
        <br>
    </div>
</div>
<div class="row parte-gestor-gen">
    <div class="col-md-12">
        <?php
        if(count($array_prestamos)>0){
        ?>
        <table class="table table-condensed" id="tablaPrestamos">
          <thead>
              <tr>
                  <th>Codigo</th>
                  <th>Fecha de prestamo</th>
                  <th>Fecha de devolucion</th>
                  <th>Numero de identificacion</th>
                  <th>Serial</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
              <?php
              for ($i=0; $i < count($array_prestamos) ; $i++) { 
                  $prestamo = $array_prestamos[$i];
                
                  $datos =  $prestamo->obtenerCod_pres(). "||" .
                            $prestamo->obtenerFecha_inicio(). "||" .
                            $prestamo->obtenerFecha_fin(). "||" .
                            $prestamo->obtenerCod_per(). "||" .
                            $prestamo->obtenerCod_equ();
               ?>
               <tr>
                <td><?php echo $prestamo->obtenerCod_pres();?></td>
                <td><?php echo $prestamo->obtenerFecha_inicio();?></td>
                <td><?php echo $prestamo->obtenerFecha_fin();?></td>
                <td><?php echo $prestamo->obtenerCod_per();?></td>
                <td><?php echo $prestamo->obtenerCod_equ();?></td>
                <td>
                  <button type="button" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#Prestamoeditar" onclick="agregaFormPrestamo('<?php echo $datos ?>')"></button>
                  <button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="preguntarSiNoPres('<?php echo $prestamo->obtenerCod_pres() ?>','<?php echo $prestamo->obtenerCod_equ() ?>')">
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
        ?> <h3 class="text-center">No hay prestamos ingresados</h3>
            <br>
            <br>
            <br>
            <?php
     }
        ?>
    </div>
</div>
<!-- Modal para nuevos prestamos -->
<div class="modal fade" id="Prestamonuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Prestamo</h4>
      </div>
      <div class="modal-body">
        <label>Fecha de prestamo</label>
        <input type="datetime-local" name="" id="fecha_inicio" class="form-control input-sm" required>
        <label>Fecha de devolucion</label>
        <input type="datetime-local" name="" id="fecha_fin" class="form-control input-sm">
        <label>Numero de identificacion</label>
        <input type="number" name="" id="cod_per" class="form-control input-sm" required>
        <label>Serial</label>
        <input type="text" name="" id="cod_equ" class="form-control input-sm" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-backdrop="false" id="aggPrestamonuevo">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar prestamos -->
<div class="modal fade" id="Prestamoeditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Prestamo</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="cod_pres" name="cod_fac">
      <label>Fecha de prestamo</label>
        <input type="datetime-local" name="" id="fecha_inicioU" class="form-control input-sm">
        <label>Fecha de devolucion</label>
        <input type="datetime-local" name="" id="fecha_finU" class="form-control input-sm">
        <label>Numero de identificacion</label>
        <input type="number" name="" id="cod_perU" class="form-control input-sm">
        <label>Serial</label>
        <input type="text" name="" id="cod_equU" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-backdrop="false" id="Updateprestamo">Agregar</button>
      </div>
    </div>
  </div>
</div>

<?php Conexion::cerrarConexion();?>

<!-- Script para crear prestamos y actualizar -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#aggPrestamonuevo').click(function() {
            agregarPrestamo();
        });
        $('#Updateprestamo').click(function() {
            actualizarPrestamo();
        });
    });
</script>

<!-- DATATABLE -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaPrestamos').DataTable({
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