<?php
include_once '../app/config.php';
include_once '../app/ControlSesion.php';
?>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Este boton despliega la barra de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if (ControlSesion::sesionIniciada() && $_SESSION['cod_rol'] == $admin) { ?>
                <a class="navbar-brand" href="<?php echo RUTA_ADMIN ?>"><i class="fas fa-user-shield"></i> Admin TiC</a>
            <?php } else if (ControlSesion::sesionIniciada() && $_SESSION['cod_rol'] !== $admin) { ?>
                <a class="navbar-brand" href="<?php echo RUTA_HOME ?>"><span class="glyphicon glyphicon-home" aris-hidden="true"></span> Centro TiC</a>
            <?php } if(!ControlSesion::sesionIniciada()){ ?>
                <a class="navbar-brand" href="<?php echo RUTA_LOGIN ?>"><span class="glyphicon glyphicon-log-in" aris-hidden="true"></span> Login TiC</a>
            <?php }?>
            </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                //USUARIO ADMIN 
                if (ControlSesion::sesionIniciada() && $_SESSION['cod_rol'] == $admin) {?>
                    <li>
                        <a href="#">
                            <i class="fas fa-user-secret"></i>
                            <?php
                            echo $_SESSION['nombre_usuario'];
                            ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria_expanded="false">
                            <span class="glyphicon glypichon-deshboard" aria-hidden="true"></span><i class="fas fa-folder-open"></i> Extras
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo RUTA_HISTORIAL;?>"><i class="fas fa-history"></i> Historial de prestamos</a>
                            </li>
                            <li>
                                <a href="<?php echo RUTA_EQUIPOS_AVERIADOS;?>"><i class="fas fa-laptop-medical"></i> Equipos averiados</a>
                            </li>
                            <li>
                                <a href="<?php echo RUTA_PRESTAMOS_ACTIVOS; ?>"><i class="fas fa-clipboard-list"></i> Prestamos activos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_LOGOUT ?>">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar sesión
                        </a>
                    </li>
                <?php
                //Usuario estandar
                }else if(ControlSesion::sesionIniciada() && $_SESSION['cod_rol'] !== $admin) {
                ?>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php
                            echo $_SESSION['nombre_usuario'];
                            ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria_expanded="false">
                            <span class="glyphicon glypichon-deshboard" aria-hidden="true"></span> Opciones
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo RUTA_DEVOLUCION;?>">Devolver equipo</a>
                            </li>
                            <li>
                                <a href="<?php echo RUTA_HISTORIAL_PRESTAMO;?>">Historial prestamos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_LOGOUT ?>">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar sesión
                        </a>
                    </li>
                <?php
                }if(!ControlSesion::sesionIniciada()) {
                    Conexion::abrirConexion();
                    $total_personas = RepositorioPersona::obtener_numero_personas(Conexion::obtenerConexion());
                    Conexion::cerrarConexion();
                ?>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php
                            echo $total_personas;
                            ?>
                        </a>
                    </li>
                    <li><a href="<?php echo RUTA_REGISTRO ?>"><i class="fas fa-user-plus"></i> Registro</a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>