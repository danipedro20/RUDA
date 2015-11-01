<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recuperacion_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/recuperacion_model');
        $this->load->library('email');
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

    public function correopass() {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Recuperar';
        $datos['token'] = $this->recuperacion_model->verificartoken($id);
        $datos['contenido'] = 'recucorreo_view';
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

    public function recuperacion_pregunta() {
        $id = $this->input->post('usu_email');
        $datos['titulo'] = 'Ruda - Recuperacion';
        $datos['pregunta'] = $this->recuperacion_model->pregunta($id);
        $datos['contenido'] = 'cambio_pass_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function recuperacioncontra() {
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
    }

    public function correo() {

        //si existe el campo oculto llamado grabar creamos las validadciones
        $this->form_validation->set_rules('usu_email', 'Email', 'trim|required|callback_correo_check');

        //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
        $this->form_validation->set_message('required', 'El %s es requerido');

        if ($this->form_validation->run() == FALSE) {
            $this->recuperarconcorreo();
        } else {
            $a = $this->input->post('usu_email');
            $recuperacion = $this->recuperacion_model->datos($a);
            $b = $recuperacion->idusuario;
            $c = $recuperacion->usu_nombre;
            $cadena = $a . $b . $c . rand(1, 9999999) . date('Y-m-d');
            $token = sha1($cadena);
            $insert = $this->recuperacion_model->resetpass($b, $token);

            $correo = $this->recuperacion_model->enviarcorreo($token, $a);
            redirect(base_url('/frontend/solicitud_control/successusu/'));
        }
    }

    function cambiar() {
        $a = $this->input->post('token');
        $b = md5($this->input->post('usu_passnuevo'));
        $cambio = $this->recuperacion_model->actualizarpass($a, $b);
        $eliminar = $this->recuperacion_model->borrartoken($a);
        redirect(base_url('/frontend/usuarios_control/logueo/'));
    }

    function correo_check($a) {
        $this->load->model('recuperacion_model');
        if ($this->recuperacion_model->correo_check($a)) {
            $this->form_validation->set_message('correo_check', 'El correo' . " " . $a . " " . 'no esta vinculado a ninguna cuenta');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
