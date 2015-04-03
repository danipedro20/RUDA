<?php

class Reg_usuario extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function registrousuario(){
        
        $datos['titulo'] = 'Ruda - Registrar Usuario';
        $datos['contenido'] = 'reg_usuarioview';
        $this->load->view('plantillas/adplantilla', $datos);
        
    }
    
    
    
}
