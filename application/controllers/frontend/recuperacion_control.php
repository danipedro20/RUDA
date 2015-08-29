<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recuperacion_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/recuperacion_model');
        //$this->load->model('frontend/usuario_model');
    }

    public function recuperacion() {
        $datos['titulo'] = 'Ruda - Ingreso';
        $datos['contenido'] = 'recuperacion_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function formarecuperacion() {
        $datos['titulo'] = 'Ruda - Recuperar';
        $datos['contenido'] = 'formaderecuperacion_view';
        $this->load->view('plantillas/plantilla', $datos);
    }
      public function recuperarconcorreo() {
        $datos['titulo'] = 'Ruda - Recuperar';
        $datos['contenido'] = 'recuperarconcorreo_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitionorecuperado() {
        $datos['titulo'] = 'Ruda - Error';
        $datos['contenido'] = 'recufail_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitiorecuperado() {
        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'recuexitoso_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function recuperacioncontra() {

        //si existe el campo oculto llamado grabar creamos las validadciones
        $this->form_validation->set_rules('pregunta', 'Pregunta Secreta', 'trim|required');
        $this->form_validation->set_rules('usu_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('respuesta', 'Respuesta Secreta', 'trim|required');
        $this->form_validation->set_rules('usu_passnuevo', 'Contraseña Nueva', 'trim|required');

        //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
        $this->form_validation->set_message('required', 'El %s es requerido');

        if ($this->form_validation->run() == FALSE) {
            $this->recuperacion();
        } else {
            $email = $this->input->post('usu_email');
            $chequeo = $this->recuperacion_model->chequeoemail($email);
            switch ($chequeo) {
                case TRUE:
                    $pregunta = $this->input->post('pregunta');
                    $respuesta = md5($this->input->post('respuesta'));
                    $passnuevo = md5($this->input->post('usu_passnuevo'));
                    $recuperacion = $this->recuperacion_model->veryrecuperacion($pregunta, $respuesta);
                    switch ($recuperacion) {
                        case TRUE:
                            $cambio = $this->recuperacion_model->cambiopass($passnuevo, $respuesta);
                            redirect(base_url('/frontend/recuperacion_control/sitiorecuperado/'));
                            break;
                        case false:
                            redirect(base_url('/frontend/recuperacion_control/sitionorecuperado/'));
                            break;
                    }
                    break;
                case FALSE:

                    redirect(base_url('/frontend/recuperacion_control/sitionorecuperado/'));
            }
        }
    }

}
