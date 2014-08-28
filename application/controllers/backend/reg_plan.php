<?php

class Reg_plan extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('backend/reg_planmodel');
    }
    
    public function insertarplan(){
        $planestudio = array(
           'pla_denominacion'=>$this->input->post('inp_nombreplan')
        );
        if ( $this->backend->reg_planmodel->insplanmodel($planestudio) )
            redirect ('reg_plan');
          
    }
    public function RegistrarPlan() {
        
        $datos['titulo'] = 'Ruda - Plan';
        $datos['contenido'] = 'reg_planview';
        $this->load->view('plantillas/adplantilla', $datos);
            
    }
    
     
    
}

