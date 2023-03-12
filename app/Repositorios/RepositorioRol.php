<?php

class RepositorioRol{

    public static function insertarRol($conexion, $rol){

		$rolInsertado = false;
		if (isset($conexion)){
			try{
				$sql = "INSERT INTO roles (nombre_rol) 
				VALUES (:nombre_rol)";
				$sentencia = $conexion->prepare($sql);
				$nombre_rol = $rol->obtenerNombre_rol();
				$sentencia->bindParam(':nombre_rol', $nombre_rol, PDO::PARAM_STR);
				$resultado = $sentencia->execute();
				if(!empty($resultado)){
					$rolInsertado = true ;
					echo $rolInsertado;
			   }
			   else{
					$rolInsertado = false;
				   echo $rolInsertado;
			   }

			}
			catch(PDOException $e){
				print "ERROR". $e->getMessage();
			}
		}
		return $rolInsertado; //true o false
	}

	public static function obtenerRoles($conexion) {
        $roles = array();
            if(isset($conexion)){
                try {
                    $sql = "SELECT * FROM roles";
                    $sentencia = $conexion -> prepare($sql);
                    $sentencia ->execute();
                    $resultado = $sentencia->fetchAll();
    
                    if(count($resultado)){
                        foreach ($resultado as $fila) {
                            $roles[] = new Rol(
                                $fila['cod_rol'], $fila['nombre_rol']
                            );
                        }	
                    }else{
                        print 'No hay roles registrados';
                    }
                }catch (PDOException $ex) {
                    print "ERROR" .$ex->getMessage();
                }
            }
        return $roles;
    }

	public static function eliminarRol($conexion,$cod_rol){
		$rolEliminado = null;
		if (isset($conexion)) {
			try {
				$sql2 = "SELECT * FROM personas WHERE cod_rol = :cod_rol";
				$sentencia2 = $conexion->prepare($sql2);
                $sentencia2->bindParam(':cod_rol', $cod_rol, PDO::PARAM_STR);
                $sentencia2->execute();
                $resultado = $sentencia2->fetch();
                if (!empty($resultado)) {
                    $rolEliminado = 'El rol no puede ser eliminado, hay personas dependientes de este rol';
                    echo $rolEliminado;
                }else{
					$sql = "DELETE FROM roles WHERE cod_rol = :cod_rol";
					$sentencia = $conexion->prepare($sql);
					$sentencia->bindParam(':cod_rol', $cod_rol, PDO::PARAM_STR);
					$resultado= $sentencia->execute();
					if(!empty($resultado)){
						$rolEliminado = true ;
						echo $rolEliminado;
					}else{
							$rolEliminado = false;
							echo $rolEliminado;
					}
				}
		
			} catch (PDOException $e) {
				print "ERROR". $e -> getMessage();
			}
		}
		return $rolEliminado;
	}

	public static function actualizarRol($conexion, $rol){

		$rolActualizado = false;
		if (isset($conexion)){
			try{
				$sql = "UPDATE roles SET nombre_rol = :nombre_rolU WHERE cod_rol = :cod_rolU";
				$sentencia = $conexion->prepare($sql);
                $cod_rolU = $rol->obtenerCod_rol();
				$nombre_rolU = $rol->obtenerNombre_rol();
                $sentencia->bindParam(':cod_rolU', $cod_rolU, PDO::PARAM_STR);
				$sentencia->bindParam(':nombre_rolU', $nombre_rolU, PDO::PARAM_STR);
				$resultado= $sentencia->execute();
                if(!empty($resultado)){
					 $rolActualizado = true ;
                     echo $rolActualizado;
				}
				else{
					 $rolActualizado = false;
                    echo $rolActualizado;
				}
			}
			catch(PDOException $e){
				print "ERROR". $e->getMessage();
			}
		}
		return $rolActualizado; //true o false
	}


	public static function NombreRolexiste($conexion, $nombre_rol){

		$nombreExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT * FROM roles WHERE UPPER(nombre_rol) LIKE UPPER(:nombre_rol)";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':nombre_rol', $nombre_rol, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$nombreExiste = true;
					echo 'El nombre del rol ya se encuentra en uso';
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

?>