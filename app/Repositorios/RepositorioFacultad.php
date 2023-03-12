<?php

class RepositorioFacultad
{

	public static function insertarFacultad($conexion, $facultad)
	{

		$facultadInsertada = false;
		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO facultades (nombre_fac) 
				VALUES (:nombre_fac)";
				$sentencia = $conexion->prepare($sql);
				$nombre_fac = $facultad->obtenerNombre_fac();
				$sentencia->bindParam(':nombre_fac', $nombre_fac, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if (!empty($resultado)) {
					$facultadInsertada  = true;
					echo $facultadInsertada;
				} else {
					$facultadInsertada  = false;
					echo $facultadInsertada;
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $facultadInsertada; //true o false
	}

	public static function obtenerFacultades($conexion)
	{
		$facultades = array();
		try {
			$sql = "SELECT * from facultades ";
			$sentencia = $conexion->prepare($sql);
			$sentencia->execute();
			$resultado = $sentencia->fetchAll();
			if (count($resultado)) {
				foreach ($resultado as $fila) {
					$facultades[] = new Facultad(
						$fila['cod_fac'],
						$fila['nombre_fac']
					);
				}
			} else {
				print 'No hay facultades registradas';
			}
		} catch (PDOException $e) {
			print "ERROR" . $e->getMessage();
		}
		return $facultades;
	}

	public static function eliminarFacultad($conexion, $cod_fac)
	{
		$facultadEliminada = null;
		if (isset($conexion)) {
			try {
				$sql2 = "SELECT * FROM personas WHERE cod_fac = :cod_fac";
				$sentencia2 = $conexion->prepare($sql2);
				$sentencia2->bindParam(':cod_fac', $cod_fac, PDO::PARAM_STR);
				$sentencia2->execute();
				$resultado = $sentencia2->fetch();
				if (!empty($resultado)) {
					$facultadEliminada = 'La facultad no puede ser eliminada, hay personas en esta facultad';
					echo $facultadEliminada;
				} else {
					$sql = "DELETE FROM facultades WHERE cod_fac = :cod_fac";
					$sentencia = $conexion->prepare($sql);
					$sentencia->bindParam(':cod_fac', $cod_fac, PDO::PARAM_STR);
					$resultado = $sentencia->execute();
					if (!empty($resultado)) {
						$facultadEliminada = true;
						echo $facultadEliminada;
					} else {
						$facultadEliminada = false;
						echo $facultadEliminada;
					}
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $facultadEliminada;
	}

	public static function actualizarFacultad($conexion, $facultad)
	{

		$facultadActualizada = false;
		if (isset($conexion)) {
			try {
				$sql = "UPDATE facultades SET nombre_fac = :nombre_facU WHERE cod_fac = :cod_facU";
				$sentencia = $conexion->prepare($sql);
				$cod_facU = $facultad->obtenerCod_fac();
				$nombre_facU = $facultad->obtenerNombre_fac();
				$sentencia->bindParam(':cod_facU', $cod_facU, PDO::PARAM_STR);
				$sentencia->bindParam(':nombre_facU', $nombre_facU, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if (!empty($resultado)) {
					$facultadActualizada = true;
					echo $facultadActualizada;
				} else {
					$facultadActualizada = false;
					echo $facultadActualizada;
				}
			} catch (PDOException $e) {
				print "ERROR" . $e->getMessage();
			}
		}
		return $facultadActualizada; //true o false
	}
	public static function NombreFacultadexiste($conexion, $nombre_fac){

		$nombreExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT * FROM facultades WHERE UPPER(nombre_fac) LIKE UPPER(:nombre_fac)";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':nombre_fac', $nombre_fac, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$nombreExiste = true;
					echo 'El nombre de la facultad ya se encuentra en uso';
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
