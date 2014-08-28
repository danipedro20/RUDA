<?php

class Registro_control extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('frontend/registro_model');
    }

    public function registro() {

        $datos['titulo'] = 'Ruda - Registrarse';
        $datos['contenido'] = 'registro_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function registro_very() {
        if ($this->input->post('submit_registro')) {
            $this->form_validation->set_rules('usunombre', 'Nombre', 'required|trim|callback_very_user');
            $this->form_validation->set_rules('usunrocedula', 'Número de cédula', 'required');
            $this->form_validation->set_rules('usudireccion', 'Dirección', 'required');
            $this->form_validation->set_rules('usutelefono', 'telefono', 'required');
            $this->form_validation->set_rules('usuemail', 'Correo', 'required');
            $this->form_validation->set_rules('usupassword', 'Password', 'required');
            $this->form_validation->set_message('very_user', 'El Usuario con ese  %s ya existe');
            if ($this->form_validation->run() != FALSE) {
                $this->registro_model->add_usuario();
                $data = array('mensaje' => 'El Usuario se ha Registrado');
                $datos['titulo'] = 'Ruda - Inicio Sesion';
                $datos['contenido'] = 'registro_view';
                $this->load->view('plantillas/plantilla', $data, $datos);
            } else {
                $datos['titulo'] = 'Ruda - Inicio Sesion';
                $datos['contenido'] = 'registro_view';
                $this->load->view('plantillas/plantilla', $datos);
            }
        }
    }

    public function very_user($user) {
        $variable = $this->registro_model->very_user($user);
        if ($variable == TRUE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
