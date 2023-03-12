<?php
class Rol
{
    private $cod_rol;
    private $nombre_rol;



    public function __construct($cod_rol, $nombre_rol)
    {
        $this->cod_rol = $cod_rol;
        $this->nombre_rol = $nombre_rol;
    }
    //GETTERS
    public function obtenerCod_rol(){
        return $this->cod_rol;
    }
    public function obtenerNombre_rol(){
        return $this->nombre_rol;
    }
    //SETTERS
    public function cambiarNombre_rol($nombre_rol){
        return $this->nombre_rol=$nombre_rol;
    }
}