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
 function carreras_check($carreras) {
        $this->db->where('car_denominacion', $carreras);
        $query = $this->db->get('carreras');

        if ($query->num_rows() > 0) {
            return TRUE;
} }
}
