<?php
//AQUI INICIA EL MODELADO DE LO QUE SE VA A PEDIR A LA BD DEL SISTEMA
class Carrera_model extends CI_Model {
    //Tambien inicializamos un constructor 
    public function __construct() {
        parent::__construct();
    }
    //Genera una lista de carreras
    function lista_carrera() {
        $consulta = $this->db->get('carreras');
        return $consulta->result();
    } 
}
