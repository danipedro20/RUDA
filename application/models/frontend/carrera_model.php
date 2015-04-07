<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//AQUI INICIA EL MODELADO DE LO QUE SE VA A PEDIR A LA BD DEL SISTEMA
class Carrera_model extends CI_Model {
    //Tambien inicializamos un constructor 
    public function __construct() {
        parent::__construct();
    }
    //Genera una lista de carreras
    function lista_usuario() {
        $consulta = $this->db->get('carreras');
        return $consulta->result();
    } 
}