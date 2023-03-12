<?php
class RepositorioDispositivo
{

	public static function insertarDispositivo($conexion, $dispositivo)
	{

		$dispositivoInsertado = false;
		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO dispositivos (nombre_disp) 
				VALUES (:nombre_disp)";
				$sentencia = $conexion->prepare($sql);
				$nombre_disp = $dispositivo->obtenerNombre_disp();
				$sentencia->bindParam(':nombre_disp', $nombre_disp, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if (!empty($resultado)) {
					$dispositivoInsertado = true;
					echo $dispositivoInsertado;
				} else {
					$dispositivoInsertado = false;
					echo $dispositivoInsertado;
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $dispositivoInsertado; //true o false
	}
	public static function obtenerDispositivos($conexion)
	{
		$dispositivos = array();
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM dispositivos";
				$sentencia = $conexion->prepare($sql);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();

				if (count($resultado)) {
					foreach ($resultado as $fila) {
						$dispositivos[] = new Dispositivo(
							$fila['cod_disp'],
							$fila['nombre_disp']
						);
					}
				} else {
					print 'No hay dispositivos registrados';
				}
			} catch (PDOException $ex) {
				print "ERROR" . $ex->getMessage();
			}
		}
		return $dispositivos;
	}
	public static function obtenerDispositivoPorCodigo($conexion, $cod_disp)
	{
		$dispositivo = null;
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM dispositivos WHERE cod_disp= :cod_disp";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':cod_disp', $cod_disp, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetch();
				if (!empty($resultado)) {
					$dispositivo = new Dispositivo($resultado['cod_disp'], $resultado['nombre_disp']);
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $dispositivo;
	}
	public static function eliminarDispositivo($conexion, $cod_disp)
	{
		$dispositivoEliminado = null;
		if (isset($conexion)) {
			try {
				$sql2 = "SELECT * FROM equipos WHERE cod_disp = :cod_disp";
				$sentencia2 = $conexion->prepare($sql2);
				$sentencia2->bindParam(':cod_disp', $cod_disp, PDO::PARAM_STR);
				$sentencia2->execute();
				$resultado = $sentencia2->fetch();
				if (!empty($resultado)) {
					$dispositivoEliminado = 'El dispositivo no puede ser eliminado, hay equipos de este tipo';
					echo $dispositivoEliminado;
				} else {
					$sql = "DELETE FROM dispositivos WHERE cod_disp = :cod_disp";
					$sentencia = $conexion->prepare($sql);
					$sentencia->bindParam(':cod_disp', $cod_disp, PDO::PARAM_STR);
					$resultado = $sentencia->execute();
					if (!empty($resultado)) {
						$dispositivoEliminado = true;
						echo $dispositivoEliminado;
					} else {
						$dispositivoEliminado = false;
						echo $dispositivoEliminado;
					}
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $dispositivoEliminado;
	}

	public static function actualizarDispositivo($conexion, $dispositivo)
	{

		$dispositivoActualizado = false;
		if (isset($conexion)) {
			try {
				$sql = "UPDATE dispositivos SET nombre_disp = :nombre_dispU WHERE cod_disp = :cod_dispU";
				$sentencia = $conexion->prepare($sql);
				$cod_dispU = $dispositivo->obtenerCod_disp();
				$nombre_dispU = $dispositivo->obtenerNombre_disp();
				$sentencia->bindParam(':cod_dispU', $cod_dispU, PDO::PARAM_STR);
				$sentencia->bindParam(':nombre_dispU', $nombre_dispU, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if (!empty($resultado)) {
					$dispositivoActualizado = true;
					echo $dispositivoActualizado;
				} else {
					$dispositivoActualizado = false;
					echo $dispositivoActualizado;
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $dispositivoActualizado; //true o false
	}

	public static function NombreDispositivoexiste($conexion, $nombre_disp){

		$nombreExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT * FROM dispositivos WHERE UPPER(nombre_disp) LIKE UPPER(:nombre_disp)";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':nombre_disp', $nombre_disp, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$nombreExiste = true;
					echo 'El nombre del dispositivo ya se encuentra en uso';
				}
				else{
					$nombreExiste = false;
				}
			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}
		}
		return $nombreExiste;
	}
}
