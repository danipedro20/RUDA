<?php
class Perfil_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    function perfiles (){
        //Hacemos una prueba de traer de la db una lista de perfiles cargados
        $Consulta = $this->db->get ('perfiles');
        return $Consulta->result();
    }
    
    
}

