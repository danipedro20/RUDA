<?php

class Usuarios_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/usuarios_model');
    }

    public function index() {

        $datos['titulo'] = 'Ruda - Registrarse';
        $datos['mensaje'] = '';
        $datos['contenido'] = 'usuarios_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function logueo_very() {
        if ($this->input->post('loguin')) {
            $this->form_validation->set_rules('usunombre', 'Nombre', 'required');
            $this->form_validation->set_rules('usupass', 'Password', 'required');
            if ($this->form_validation->run() != FALSE) {
                $usuario=$this->input->post('usunombre');z
                 $this->usuarios_model->loguin($usuario,$password);
                    $datos['titulo'] = 'Ruda - Inicio Sesion';
                    $datos['mensaje'] = 'ha iniciado sesion';
                    $datos['contenido'] = 'usuarios_view';
                    $this->load->view('plantillas/plantilla', $datos);
                } else {
                    $datos['titulo'] = 'Ruda - Inicio Sesion';
                    $datos['mensaje'] = 'NO ha iniciado sesion';
                    $datos['contenido'] = 'usuarios_view';
                    $this->load->view('plantillas/plantilla', $datos);
                }
            }
        }
    }


