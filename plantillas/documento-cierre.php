  <!-- Script LIBRERIAS: JQUERY, BOOSTRAP ,DATATABLE E ICONS -->
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>all.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>alertify.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>jszip.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>pdfmake.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>vfs_fonts.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>buttons.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>buttons.html5.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>buttons.print.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS_LIBRERIAS?>responsive.bootstrap.min.js"></script>

  <!-- Script FUNCIONALIDADES-->
  <script src="<?php echo RUTA_JS_FUNCIONES?>Rol.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Sala.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Edificio.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Equipo.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Facultad.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Dispositivo.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Prestamo.js"></script>
  <script src="<?php echo RUTA_JS_FUNCIONES?>Persona.js"></script>

  


  <script type="text/javascript">
    $(document).ready(function(){
      $('#roles').load('../gestores/gestor-roles.php');
      $('#salas').load('../gestores/gestor-salas.php');
      $('#edificios').load('../gestores/gestor-edificios.php');
      $('#equipos').load('../gestores/gestor-equipos.php');
      $('#facultades').load('../gestores/gestor-facultades.php');
      $('#dispositivos').load('../gestores/gestor-dispositivos.php');
      $('#prestamos').load('../gestores/gestor-prestamo.php');
      $('#equiposdisponibles').load('vistas/disponibles.php');
      $('#devolverequipo').load('../vistas/devolucion.php');
      $('#historialprestamo').load('../vistas/historial.php');
      $('#personas').load('../gestores/gestor-personas.php');
      $('#historial').load('../vistas/adminHistorial.php');
      $('#prestamosactivos').load('../vistas/prestamosactivos.php');
      $('#equiposaveriados').load('../vistas/equiposaveriados.php');

    });
  </script>
  </body>
</html>
