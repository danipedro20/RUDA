<?php
 
class Usuario_registro extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function registro() {
       
        $datos['titulo'] = 'Ruda - Registrarse';
        $datos['contenido'] = 'registro_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

}
