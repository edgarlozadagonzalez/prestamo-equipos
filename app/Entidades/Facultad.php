<?php
class Facultad{
    private $cod_fac;
    private $nombre_fac;



    public function __construct($cod_fac, $nombre_fac)
    {
        $this->cod_fac = $cod_fac;
        $this->nombre_fac = $nombre_fac;
    }
    //GETTERS
    public function obtenerCod_fac(){
        return $this->cod_fac;
    }
    public function obtenerNombre_fac(){
        return $this->nombre_fac;
    }
    //SETTERS
    public function cambiarNombre_fac($nombre_fac){
        return $this->nombre_fac=$nombre_fac;
    }
}
