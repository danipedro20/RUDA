<?php

class Carrera_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    //Genera una lista de carreras
    function lista_usuario() {
        $consulta = $this->db->get('carreras');
        return $consulta->result();
    } 
}

