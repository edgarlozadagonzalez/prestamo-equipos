<?php

class RepositorioSala
{

	public static function insertarSala($conexion, $sala)
	{

		$salaInsertada = false;
		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO salas (nombre_sal, num_piso, plataforma, cod_edif) 
				VALUES (:nombre_sal, :num_piso, :plataforma, :cod_edif)";
				$sentencia = $conexion->prepare($sql);
				$nombre_sal = $sala->obtenerNombre_sal();
				$num_piso = $sala->obtenerNum_piso();
				$plataforma = $sala->obtenerPlataforma();
				$cod_edif = $sala->obtenerCod_edif();
				$sentencia->bindParam(':nombre_sal', $nombre_sal, PDO::PARAM_STR);
				$sentencia->bindParam(':num_piso', $num_piso, PDO::PARAM_STR);
				$sentencia->bindParam(':plataforma', $plataforma, PDO::PARAM_STR);
				$sentencia->bindParam(':cod_edif', $cod_edif, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if (!empty($resultado)) {
					$salaInsertada = true;
					echo $salaInsertada;
				} else {
					$salaInsertada = false;
					echo $salaInsertada;
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $salaInsertada; //true o false
	}

	public static function actualizarSala($conexion, $sala)
	{

		$salaActualizada = false;
		if (isset($conexion)) {
			try {
				$sql = "UPDATE salas SET nombre_sal = :nombre_salU, num_piso = :num_pisoU, 
                        plataforma = :plataformaU, cod_edif=:cod_edifU WHERE cod_sal = :cod_salU";
				$sentencia = $conexion->prepare($sql);
				$cod_salU = $sala->obtenerCod_sal();
				$nombre_salU = $sala->obtenerNombre_sal();
				$num_pisoU = $sala->obtenerNum_piso();
				$plataformaU = $sala->obtenerPlataforma();
				$cod_edifU = $sala->obtenerCod_edif();
				$sentencia->bindParam(':cod_salU', $cod_salU, PDO::PARAM_STR);
				$sentencia->bindParam(':nombre_salU', $nombre_salU, PDO::PARAM_STR);
				$sentencia->bindParam(':num_pisoU', $num_pisoU, PDO::PARAM_STR);
				$sentencia->bindParam(':plataformaU', $plataformaU, PDO::PARAM_STR);
				$sentencia->bindParam(':cod_edifU', $cod_edifU, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if (!empty($resultado)) {
					$salaActualizada = true;
					echo $salaActualizada;
				} else {
					$salaActualizada = false;
					echo $salaActualizada;
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $salaActualizada; //true o false
	}
	public static function Contar($conexion, $sql)
	{
		$total_conteo = null;

		if (isset($conexion)) {
			try {
				$sentencia = $conexion->prepare($sql);
				$sentencia->execute();
				$resultado = $sentencia->fetch();
				$total_conteo = $resultado['total'];
			} catch (PDOException $ex) {
				print 'ERROR' . $ex->getMessage();
			}
		}

		return $total_conteo;
	}

	public static function obtenerSalas($conexion)
	{
		$salas = array();
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM salas";
				$sentencia = $conexion->prepare($sql);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();

				if (count($resultado)) {
					foreach ($resultado as $fila) {
						$salas[] = new Sala(
							$fila['cod_sal'],
							$fila['nombre_sal'],
							$fila['num_piso'],
							$fila['plataforma'],
							$fila['cod_edif']
						);
					}
				} else {
					print 'No hay salas registradas';
				}
			} catch (PDOException $ex) {
				print "ERROR" . $ex->getMessage();
			}
		}
		return $salas;
	}

	public static function obtenerSalaPorCodigo($conexion, $cod_sal)
	{
		$sala = array();
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM salas WHERE cod_sal = :cod_sal";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':cod_sal', $cod_sal, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetch();
				if (!empty($resultado)) {
					$sala = new Sala(
						$resultado['cod_sal'],
						$resultado['nombre_sal'],
						$resultado['num_piso'],
						$resultado['plataforma'],
						$resultado['cod_edif']
					);
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $sala;
	}

	public static function eliminarSala($conexion, $cod_sal)
	{
		$salaEliminada = null;
		if (isset($conexion)) {
			try {
				$sql2 = "SELECT * FROM equipos WHERE cod_sal = :cod_sal";
				$sentencia2 = $conexion->prepare($sql2);
				$sentencia2->bindParam(':cod_sal', $cod_sal, PDO::PARAM_STR);
				$sentencia2->execute();
				$resultado = $sentencia2->fetch();
				if (!empty($resultado)) {
					$salaEliminada = 'Imposible eliminar, traslade los equipos a otra sala.';
					echo $salaEliminada;
				} else {
					$sql = "DELETE FROM salas WHERE cod_sal = :cod_sal";
					$sentencia = $conexion->prepare($sql);
					$sentencia->bindParam(':cod_sal', $cod_sal, PDO::PARAM_STR);
					$resultado = $sentencia->execute();
					if (!empty($resultado)) {
						$salaEliminada = true;
						echo $salaEliminada;
					} else {
						$salaEliminada = false;
						echo $salaEliminada;
					}
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $salaEliminada;
	}


	public static function NombreSalaexiste($conexion, $nombre_sal)
	{

		$nombreExiste = true;

		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM salas WHERE UPPER(nombre_sal) LIKE UPPER(:nombre_sal)";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':nombre_sal', $nombre_sal, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if (count($resultado)) {
					$nombreExiste = true;
					echo 'El nombre de la sala ya se encuentra en uso';
				} else {
					$nombreExiste = false;
				}
			} catch (PDOException $e) {
				print "ERROR " . $e->getMessage();
			}
		}
		return $nombreExiste;
	}
}
