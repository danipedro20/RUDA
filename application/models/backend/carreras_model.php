<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carreras_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insecarreras($a) {
        $data = array(
            'car_denominacion' => $a,
        );
        return $this->db->insert('carreras', $data);
    }

    public function edicarrera($a, $b) {
        $data = array(
            'car_denominacion' => $a,
        );

        $this->db->where('id_carrera', $b);
        $this->db->update('carreras', $data);
    }

    public function elimicarrera($id) {
        $this->db->where('id_carrera', $id);
        $this->db->delete('carreras');
        if ($this->db->_error_message()) {
            return $data = 'Atencion!!! Nose puede borrar esta Carrera';
        }
    }

    public function lista() {
        $consulta = $this->db->query("select * from carreras;");
        return $consulta->result();
    }

    public function carrera($id) {
        $consulta = $this->db->query("select * from carreras where id_carrera='$id';");
        return $consulta->row();
    }

    function carreras_check($carreras) {
        $this->db->where('car_denominacion', $carreras);
        $query = $this->db->get('carreras');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

}
