<?php

date_default_timezone_set('America/Asuncion');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reporte_tareas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

public function lista_tareas() {

        $query = $this->db->query("select * from tareas");
        return $query->result();
    }
}