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
            'car_denominacion' => $b,
        );

        $this->db->where('car_denominacion', $a);
        $this->db->update('carreras', $data);
    }
     public function elimicarrera($a) {
        $this->db->select('id_carrera')
                ->where('car_denominacion', $a);
        $query = $this->db->get('carreras');
        $row = $query->row_array();
        $id = $row['id_carrera'];

        $tablas = array('aulas', 'inscripciones', 'carreras');
        $this->db->where('id_carrera', $id);
        $this->db->delete($tablas);
    }
    
    function carreras_check($carreras) {
        $this->db->where('car_denominacion', $carreras);
        $query = $this->db->get('carreras');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }
       function carreraedi_check($carrera) {
        $this->db->where('car_denominacion', $carrera);
        $query = $this->db->get('carreras');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

function carreraeli_check($carrera) {
        $this->db->where('car_denominacion', $carrera);
        $query = $this->db->get('carreras');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

}
