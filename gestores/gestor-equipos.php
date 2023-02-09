<?php
      include_once '../app/config.php';
      include_once '../app/Conexion.php';
      include_once '../app/Entidades/Sala.php';
      include_once '../app/Entidades/Dispositivo.php';
      include_once '../app/Entidades/Equipo.php';
      include_once '../app/Repositorios/RepositorioSala.php';
      include_once '../app/Repositorios/RepositorioEquipo.php';
      include_once '../app/Repositorios/RepositorioDispositivo.php';
      Conexion::abrirConexion();
      $array_salas = RepositorioSala::obtenerSalas(Conexion::obtenerConexion());
      $array_equipos= RepositorioEquipo::obtenerEquipos(Conexion::obtenerConexion());
      $array_dispositivos=RepositorioDispositivo::obtenerDispositivos(Conexion::obtenerConexion());
?>
<div class="row parte-gestor-gen">
    <div class="col-md-12">
        <h2>Gestion de equipos</h2>
        <br>
        <caption>
        <button class="btn btn-primary" data-toggle="modal" data-target="#Equiponuevo">
                Agregar equipo
            <span class="glyphicon glyphicon-plus"></span>
        </button> 
        <a class="btn btn-success" href="<?php echo RUTA_GESTOR_EQUIPOS;?>" role="button"><i class="fas fa-sync-alt"></i> Actualizar</a>
        </caption>
        <br>
        <br>
    </div>
</div>
<div class="row parte-gestor-gen">
    <div class="col-md-12">
        <?php
        if(count($array_equipos)>0){
        ?>
        <table class="table table-condensed" id="tablaEquipos">
          <thead>
              <tr>
                  <th>Codigo</th>
                  <th>Marca</th>
                  <th>Valor</th>
                  <th>Estado</th>
                  <th>Descripcion</th>
                  <th>Sala</th>
                  <th>Dispositivo</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
              <?php
              for ($i=0; $i < count($array_equipos) ; $i++) { 
                  $equipo = $array_equipos[$i];
                  if($equipo->obtenerEstado()>0){
                    $estado='Disponible';
                  }else{ 
                    $estado = 'No Disponible';
                  }
                  $datos = $equipo->obtenerCod_equ() . "||" .
                            $equipo->obtenerMarca() . "||" .
                            $equipo->obtenerValor() . "||" .
                            $equipo->obtenerEstado() . "||" .
                            $equipo->obtenerDescripcion() . "||" .
                            $equipo->obtenerCod_sal() . "||" .
                            $equipo->obtenerCod_disp();
               ?>
               <tr>
                <td><?php echo $equipo->obtenerCod_equ();?></td>
                <td><?php echo $equipo->obtenerMarca();?></td>
                <td><?php echo '$'.$equipo->obtenerValor();?></td>
                <td><?php echo $estado?></td>
                <td><?php echo $equipo->obtenerDescripcion();?></td>
                <td><?php $sala = RepositorioSala::obtenerSalaPorCodigo(Conexion::obtenerConexion(), $equipo->obtenerCod_sal());
                       echo $sala->obtenerNombre_sal(); 
                ?></td>
                <td><?php $dispositivo = RepositorioDispositivo::obtenerDispositivoPorCodigo(Conexion::obtenerConexion(), $equipo->obtenerCod_disp());
                       echo $dispositivo->obtenerNombre_disp(); 
                ?></td>
                <td>
                  <button type="button" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#Equipoeditar" onclick="agregaFormEquipo('<?php echo $datos ?>')"></button>
                  <button type="button" class="btn btn-danger glyphicon glyphicon-remove" onclick="preguntarSiNoEqu('<?php echo $equipo->obtenerCod_equ() ?>')">
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
        ?> <h3 class="text-center">No hay equipos ingresados</h3>
            <br>
            <br>
            <br>
            <?php
        }
        ?>
    </div>
</div>
<!-- Modal para nuevos equipos -->
<div class="modal fade" id="Equiponuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ingresar Equipo</h4>
      </div>
      <div class="modal-body">
        <label>Serial</label>
        <input type="text" name="" id="cod_equ" class="form-control input-sm">
        <label>Marca</label>
        <input type="text" name="" id="marca" class="form-control input-sm">
        <label>Valor</label>
        <input type="number" name="" id="valor" class="form-control input-sm">
        <label>Descripcion</label>
        <input type="text" name="" id="descripcion" class="form-control input-sm">
        <label>Dispositivo</label>
        <select class="form-control" id="cod_disp" name="cod_disp">
            <option value="0">Seleccionar Dispositivo</option>
            <?php foreach ($array_dispositivos as $row) { ?>
            <option value="<?php echo $dispositivo =$row->obtenerCod_disp(); ?>"><?php echo $dispositivo =$row->obtenerNombre_disp(); ?>
            </option>
            <?php } ?>
        </select>
        <label>Estado</label>
        <select class="form-control" id="estado" name="estado">
                <option value="">Seleccionar Estado</option>
                <option value="0">No Disponible</option>
                <option value="1">Disponible</option>
        </select>
        <label>Sala</label>
        <select class="form-control" id="cod_sal" name="cod_sal">
                <option value="0">Seleccionar Sala</option>
                <?php foreach ($array_salas as $row) { ?>
                 <option value="<?php echo $row->obtenerCod_sal(); ?>"><?php echo $row->obtenerNombre_sal(); ?>
                </option>
                <?php } ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-backdrop="false" id="aggEquiponuevo">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para editar equipos -->
<div class="modal fade" id="Equipoeditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Equipo</h4>
      </div>
      <div class="modal-body">
        <label>Serial</label>
        <input type="text" name="" id="cod_equU" class="form-control input-sm">
        <label>Marca</label>
        <input type="text" name="" id="marcaU" class="form-control input-sm">
        <label>Valor</label>
        <input type="number" name="" id="valorU" class="form-control input-sm">
        <label>Descripcion</label>
        <input type="text" name="" id="descripcionU" class="form-control input-sm">
        <label>dispositivo</label>
        <select class="form-control" id="cod_dispU" name="cod_dispU">
            <option value="0">Seleccionar dispositivo</option>
            <?php foreach ($array_dispositivos as $row) { ?>
            <option value="<?php echo $dispositivo =$row->obtenerCod_disp(); ?>"><?php echo $dispositivo =$row->obtenerNombre_disp(); ?>
            </option>
            <?php } ?>
        </select>
        <label>Estado</label>
        <select class="form-control" id="estadoU" name="estadoU">
                <option value="">Seleccionar Estado</option>
                <option value="0">No Disponible</option>
                <option value="1">Disponible</option>
        </select>
        <label>Sala</label>
        <select class="form-control" id="cod_salU" name="cod_salU">
                <option value="0">Seleccionar Sala</option>
                <?php foreach ($array_salas as $row) { ?>
                 <option value="<?php echo $row->obtenerCod_sal(); ?>"><?php echo $row->obtenerNombre_sal(); ?>
                </option>
                <?php } ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-backdrop="false" id="Updateequipo">Agregar</button>
      </div>
    </div>
  </div>
</div>

<?php Conexion::cerrarConexion();?>

<!-- Script para crear equipos y actualizar -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#aggEquiponuevo').click(function() {
            agregarEquipo();
        });
        $('#Updateequipo').click(function() {
            actualizarEquipo();
        });
    });
</script>

<!-- DATATABLE -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaEquipos').DataTable({
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