<?php

class Usuarios_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    
    public function index() {
        $datos['titulo'] = 'Ruda - Inicio Sesion';
        $datos['contenido'] = 'usuarios_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function inicio_very() {
        if ($this->input->post('submit_inicio')) {
            $this->form_validation->set_rules('usunombre', 'Nombre', 'required');
            $this->form_validation->set_rules('usupass', 'Password', 'required');
            if ($this->form_validation->run() != FALSE) {
                
            } else {
                $datos['titulo'] = 'Ruda - Inicio Sesion';
                $datos['contenido'] = 'usuarios_view';
                $this->load->view('plantillas/plantilla', $datos);
            }
        }
    }

}
