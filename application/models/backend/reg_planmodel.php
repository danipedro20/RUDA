<?php

class Reg_planmodel extends CI_Model{

  

    public function insplanmodel($planestudio){
        
        if ($this->db->insert('plan_estudios', $planestudio)) {
            return true;
        } 
        else {
            return false;
        }
    }
    
}

