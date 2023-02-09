<?php
class Edificio{
    private $cod_edif;
    private $nombre_edif;
    private $num_pisos;
    private $sede;


    public function __construct($cod_edif, $nombre_edif,$num_pisos,$sede)
    {
        $this->cod_edif = $cod_edif;
        $this->nombre_edif = $nombre_edif;
        $this->num_pisos = $num_pisos;
        $this->sede = $sede;
    }
    //GETTERS
    public function obtenerCod_edif(){
        return $this->cod_edif;
    }
    public function obtenerNombre_edif(){
        return $this->nombre_edif;
    }
    public function obtenerNum_pisos(){
        return $this->num_pisos;
    }
    public function obtenerSede(){
        return $this->sede;
    }
    //SETTER
    public function cambiarNum_pisos($num_pisos){
        return $this->num_pisos=$num_pisos;
    }
}