<?php

class Reg_planmodel extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function insplanmodel($nombreplan){
      $data = array(
            
            'pla_denominacion' => $nombreplan
      );
      return $this->db->insert('plan_estudios',$data);
      
    }
    
}

