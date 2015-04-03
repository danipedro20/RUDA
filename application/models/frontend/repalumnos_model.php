<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Repalumnos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function repalum () {
         $this->db->where('idperfil', '3');
        $query = $this->db->get('usuarios');
        return $query->result();
}}