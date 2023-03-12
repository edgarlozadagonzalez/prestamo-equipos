<?php
class Sala{
    private $cod_sal;
    private $nombre_sal;
    private $num_piso;
    private $plataforma;
    private $cod_edif;


    public function __construct($cod_sal, $nombre_sal,$num_piso,$plataforma,$cod_edif)
    {
        $this->cod_sal = $cod_sal;
        $this->nombre_sal = $nombre_sal;
        $this->num_piso = $num_piso;
        $this->plataforma = $plataforma;
        $this->cod_edif = $cod_edif;    
    }
    //GETTERS
    public function obtenerCod_sal(){
        return $this->cod_sal;
    }
    public function obtenerNombre_sal(){
        return $this->nombre_sal;
    }
    public function obtenerNum_piso(){
        return $this->num_piso;
    }
    public function obtenerPlataforma(){
        return $this->plataforma;
    }
    public function obtenerCod_edif(){
        return $this->cod_edif;
    }
    //SETTER
    public function cambiarPlataforma($plataforma){
        return $this->plataforma=$plataforma;
    }
}