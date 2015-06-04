<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catedras_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insecatedra($a, $b) {
        $data = array(
            'cat_denominacion' => $a,
            'cat_diascatedra' => $b,
        );
        return $this->db->insert('catedras', $data);
    }

    function catedra_check($catedra) {
        $this->db->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    function catedraeli_check($catedra) {
        $this->db->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

    function catedraedi_check($catedra) {
        $this->db->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

    public function elimicatedra($a) {
        $this->db->select('idcatedra')
                ->where('cat_denominacion', $a);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $id = $row['idcatedra'];

        $tablas = array('usu_cate', 'cate_plan', 'tareas', 'catedras');
        $this->db->where('idcatedra', $id);
        $this->db->delete($tablas);
    }

    public function edicatedra($a, $b,$c) {
        $data = array(
            'cat_denominacion' => $b,
            'cat_diascatedra' => $c,
        );

        $this->db->where('cat_denominacion', $a);
        $this->db->update('catedras', $data);
    }

}
