<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verificacion_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/verificacion_model');
        //$this->load->model('frontend/usuario_model');
    }

    public function verificacion() {
        $datos['titulo'] = 'Ruda - Cambio Contraseña';
        $datos['contenido'] = 'verificacioncontra_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    function sitioerror() {
        $datos['titulo'] = 'Ruda - Error';
        $datos['contenido'] = 'errorveri_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    function sitioactualizado() {
        $datos['titulo'] = 'Ruda - Actualizado';
        $datos['contenido'] = 'actualizado_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function verificacionprofesor() {
        $datos['titulo'] = 'Ruda - Cambio Contraseña';
        $datos['contenido'] = 'verificacioncontra_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    function sitioerrorprofesor() {
        $datos['titulo'] = 'Ruda - Error';
        $datos['contenido'] = 'errorveri_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    function sitioactualizadoprofesor() {
        $datos['titulo'] = 'Ruda - Actualizado';
        $datos['contenido'] = 'actualizado_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function verificacionadmin() {
        $datos['titulo'] = 'Ruda - Cambio Contraseña';
        $datos['contenido'] = 'verificacioncontra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    function sitioerroradmin() {
        $datos['titulo'] = 'Ruda - Error';
        $datos['contenido'] = 'errorveri_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    function sitioactualizadoadmin() {
        $datos['titulo'] = 'Ruda - Actualizado';
        $datos['contenido'] = 'actualizado_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function verificacioncontra() {

        //si existe el campo oculto llamado grabar creamos las validadciones
        $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');
        $this->form_validation->set_rules('usu_passnuevo', 'La  Nueva Contraseña', 'trim|required');
        //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
        $this->form_validation->set_message('required', 'El %s es requerido');

        if ($this->form_validation->run() == FALSE) {
            $this->verificacion();
        } else {

            $pass = md5($this->input->post('usu_pass'));
            $passnuevo = md5($this->input->post('usu_passnuevo'));
            $email = $this->session->userdata('correo');
            $verificacion = $this->verificacion_model->verycontra($email, $pass);
            switch ($verificacion) {
                case TRUE:
                    $cambio = $this->verificacion_model->cambio($passnuevo, $email);
                    if ($this->session->userdata('perfil') == 1) {
                        redirect(base_url('/backend/verificacion_control/sitioactualizadoadmin/'));
                    } elseif ($this->session->userdata('perfil') == 2) {
                        redirect(base_url('/backend/verificacion_control/sitioactualizadoprofesor/'));
                    } elseif ($this->session->userdata('perfil') == 3) {

                        redirect(base_url('/backend/verificacion_control/sitioactualizado/'));
                    }
                    break;
                case false:

                    if ($this->session->userdata('perfil') == 1) {
                        redirect(base_url('/backend/verificacion_control/sitioerroradmin/'));
                    } elseif ($this->session->userdata('perfil') == 2) {
                        redirect(base_url('/backend/verificacion_control/sitioerrorprofesor/'));
                    } elseif ($this->session->userdata('perfil') == 3) {

                        redirect(base_url('/backend/verificacion_control/sitioerror/'));
                    }

                    break;
            }
           
        }
    }

}
