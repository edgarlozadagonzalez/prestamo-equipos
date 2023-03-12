<?php
class Dispositivo{
    private $cod_disp;
    private $nombre_disp;
  


    public function __construct($cod_disp, $nombre_disp)
    {
        $this->cod_disp = $cod_disp;
        $this->nombre_disp = $nombre_disp;
       
    }
    //GETTERS
    public function obtenerCod_disp(){
        return $this->cod_disp;
    }
    public function obtenerNombre_disp(){
        return $this->nombre_disp;
    }
}