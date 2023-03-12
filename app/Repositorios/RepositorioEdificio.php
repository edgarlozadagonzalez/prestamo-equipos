<?php
class RepositorioEdificio
{

    public static function insertarEdificio($conexion, $edificio)
    {

        $edificioInsertado = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO edificios (nombre_edif, num_pisos, sede) 
				VALUES (:nombre_edif, :num_pisos, :sede)";
                $sentencia = $conexion->prepare($sql);
                $nombre_edif = $edificio->obtenerNombre_edif();
                $num_pisos = $edificio->obtenerNum_pisos();
                $sede = $edificio->obtenerSede();
                $sentencia->bindParam(':nombre_edif', $nombre_edif, PDO::PARAM_STR);
                $sentencia->bindParam(':num_pisos', $num_pisos, PDO::PARAM_STR);
                $sentencia->bindParam(':sede', $sede, PDO::PARAM_STR);
                $resultado = $sentencia->execute();
                if (!empty($resultado)) {
                    $edificioInsertado = true;
                    echo $edificioInsertado;
                } else {
                    $edificioInsertado = false;
                    echo $edificioInsertado;
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $edificioInsertado; //true o false
    }
    public static function obtenerEdificios($conexion)
    {
        $edificios = array();
        try {
            $sql = "SELECT * from edificios ";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            if (count($resultado)) {
                foreach ($resultado as $fila) {
                    $edificios[] = new Edificio($fila['cod_edif'], $fila['nombre_edif'], $fila['num_pisos'], $fila['sede']);
                }
            } else {
                print 'No hay edificios registrados';
            }
        } catch (PDOException $e) {
            print "ERROR" . $e->getMessage();
        }
        return $edificios;
    }
    public static function obtenerEdificioPorCodigo($conexion, $cod_edif)
    {
        $edificio = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM edificios WHERE cod_edif = :cod_edif";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':cod_edif', $cod_edif, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                if (!empty($resultado)) {
                    $edificio = new Edificio($resultado['cod_edif'], $resultado['nombre_edif'], $resultado['num_pisos'], $resultado['sede']);
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $edificio;
    }
    public static function eliminarEdificio($conexion, $cod_edif)
    {
        $edificioEliminado = null;
        if (isset($conexion)) {
            try {
                $sql2 = "SELECT * FROM salas WHERE cod_edif = :cod_edif";
                $sentencia2 = $conexion->prepare($sql2);
                $sentencia2->bindParam(':cod_edif', $cod_edif, PDO::PARAM_STR);
                $sentencia2->execute();
                $resultado = $sentencia2->fetch();
                if (!empty($resultado)) {
                    $edificioEliminado = 'Imposible eliminar, el edificio tiene salas.';
                    echo $edificioEliminado;
                } else {
                    $sql = "DELETE FROM edificios WHERE cod_edif = :cod_edif";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':cod_edif', $cod_edif, PDO::PARAM_STR);
                    $resultado = $sentencia->execute();
                    if (!empty($resultado)) {
                        $edificioEliminado = true;
                        echo $edificioEliminado;
                    } else {
                        $edificioEliminado = false;
                        echo $edificioEliminado;
                    }
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $edificioEliminado;
    }

    public static function actualizarEdificio($conexion, $edificio)
    {

        $edificioActualizado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE edificios SET nombre_edif = :nombre_edifU, num_pisos = :num_pisosU, 
                        sede = :sedeU WHERE cod_edif = :cod_edifU";
                $sentencia = $conexion->prepare($sql);
                $cod_edifU = $edificio->obtenerCod_edif();
                $nombre_edifU = $edificio->obtenerNombre_edif();
                $num_pisosU = $edificio->obtenerNum_pisos();
                $sedeU = $edificio->obtenerSede();
                $sentencia->bindParam(':cod_edifU', $cod_edifU, PDO::PARAM_STR);
                $sentencia->bindParam(':nombre_edifU', $nombre_edifU, PDO::PARAM_STR);
                $sentencia->bindParam(':num_pisosU', $num_pisosU, PDO::PARAM_STR);
                $sentencia->bindParam(':sedeU', $sedeU, PDO::PARAM_STR);
                $resultado = $sentencia->execute();
                if (!empty($resultado)) {
                    $edificioActualizado = true;
                    echo $edificioActualizado;
                } else {
                    $edificioActualizado = false;
                    echo $edificioActualizado;
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $edificioActualizado; //true o false
    }

    public static function NombreEdificioexiste($conexion, $nombre_edif)
    {

        $nombreExiste = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM edificios WHERE UPPER(nombre_edif) LIKE UPPER(:nombre_edif)";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre_edif', $nombre_edif, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    $nombreExiste = true;
                    echo 'El nombre del edificio ya se encuentra en uso';
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
