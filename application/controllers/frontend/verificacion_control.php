<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verificacion_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('frontend/verificacion_model');
        //$this->load->model('frontend/usuario_model');
    }

    public function verificacion() {
        $datos['titulo'] = 'Ruda - Ingreso';
        $datos['contenido'] = 'verificacioncontra_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitioerror() {
        $datos['titulo'] = 'Ruda - Error';
        $datos['contenido'] = 'errorveri_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitioactualizado() {
        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'actualizado_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function verificacioncontra() {

        //si existe el campo oculto llamado grabar creamos las validadciones
        $this->form_validation->set_rules('usu_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');
        $this->form_validation->set_rules('usu_passnuevo', 'La  Nueva Contraseña', 'trim|required');
        //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
        $this->form_validation->set_message('required', 'El %s es requerido');

        if ($this->form_validation->run() == FALSE) {
            $this->verificacion();
        } else {
            $email = $this->input->post('usu_email');
            $pass = md5($this->input->post('usu_pass'));
            $passnuevo = md5($this->input->post('usu_passnuevo'));
            $verificacion = $this->verificacion_model->verycontra($email, $pass);
            switch ($verificacion) {
                case TRUE:
                    $cambio = $this->verificacion_model->cambio($passnuevo,$email);
                   redirect(base_url('/frontend/verificacion_control/sitioactualizado/'));
                    break;
                case false:
                    redirect(base_url('/frontend/verificacion_control/sitioerror/'));
                    break;
            }
        }
    }

}
