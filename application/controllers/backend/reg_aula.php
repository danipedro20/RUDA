<?php
//formulario para registro de aula
class Reg_aula extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    function nueva_aula() {
        $datos['titulo'] = 'Ruda - Aulas';
        $datos['contenido'] = 'reg_aulaview';
        $this->load->view('plantillas/adplantilla', $datos);
    }

}

