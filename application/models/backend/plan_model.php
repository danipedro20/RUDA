<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function inseplan($a) {
        $data = array(
            'pla_denominacion' => $a,
        );
        return $this->db->insert('plan_estudios', $data);
    }

    public function ediplanestudio($a, $b) {
        $data = array(
            'pla_denominacion' => $b,
        );

        $this->db->where('pla_denominacion', $a);
        $this->db->update('plan_estudios', $data);
    }
        public function elimiplanestudios($a) {
        $this->db->select('idplan')
                ->where('pla_denominacion', $a);
        $query = $this->db->get('plan_estudios');
        $row = $query->row_array();
        $id = $row['idplan'];

        $tablas = array('aulas', 'cate_plan', 'plan_estudios');
        $this->db->where('idplan', $id);
        $this->db->delete($tablas);
    }    

    function plan_check($plan) {
        $this->db->where('pla_denominacion', $plan);
        $query = $this->db->get('plan_estudios');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    function planeditar_check($plan) {
        $this->db->where('pla_denominacion', $plan);
        $query = $this->db->get('plan_estudios');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }
     function planeliminar_check($plan) {
        $this->db->where('pla_denominacion', $plan);
        $query = $this->db->get('plan_estudios');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

}
