<?php
//formulario para registro de aula
class Reg_aula extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    function nueva_aula() {
        $datos['titulo'] = 'Ruda - Crear AULA';
        $datos['contenido'] = 'reg_aulaview';
        $this->load->view('plantillas/adplantilla', $datos);
        $this->load->helper('form');
    }

}

