<?php
include_once '../app/config.php';
include_once 'app/Conexion.php';
include_once 'app/Entidades/Persona.php';
include_once 'app/Repositorios/RepositorioPersona.php';
include_once 'app/Validadores/ValidadorLogin.php';
include_once 'app/ControlSesion.php';
include_once 'app/Redireccion.php';

Redireccion::PaginaLogica();

if (isset($_POST['login'])) {
	Conexion::abrirConexion();
	$validador = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::obtenerConexion());
	if($validador->obtenerError()==='' && !is_null($validador->obtenerPersona())){
		ControlSesion::iniciarSesion($validador->obtenerPersona()->obtenerCod_per(),
									$validador->obtenerPersona()->obtenerPri_nombre(),
									$validador->obtenerPersona()->obtenerCod_rol());
		if($_SESSION['cod_rol'] == $admin){
			Redireccion::redirigir(RUTA_ADMIN);
		}else{
			Redireccion::redirigir(RUTA_HOME);
		}
	}
}
$titulo = 'Iniciar sesión';
include_once 'plantillas/documento-declaracion.php';
include_once 'plantillas/navbar.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h2>Iniciar sesión</h2>
				</div>
				<div class="panel-body">
					<form role="form" method="POST" action="<?php echo RUTA_LOGIN ?>">
						<label for="email" class="sr-only">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email"
						<?php
						if(isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])){
							echo 'value='.$_POST['email'];
						}
						?>
						required >
						<br>
						<label for="clave" class="sr-only">Contraseña</label>
						<input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" required>
						<br>
						<?php
						if(isset($_POST['login'])){
							$validador->mostrar_error();
						}
						?>
						<button type="submit" name="login" class="btn btb-lg btn-primary btn-block">Ingresar</button>
					</form>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once 'plantillas/documento-cierre.php';
?>