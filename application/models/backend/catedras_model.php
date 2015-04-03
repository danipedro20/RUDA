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
} }
}
