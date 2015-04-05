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
 function plan_check($plan) {
        $this->db->where('pla_denominacion', $plan);
        $query = $this->db->get('plan_estudios');

        if ($query->num_rows() > 0) {
            return TRUE;
} }
}
