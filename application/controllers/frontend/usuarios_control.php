<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('frontend/usuario_model');


        //$this->load->model('frontend/usuario_model');
    }

    public function logueo() {
        $datos['titulo'] = 'Ruda - Ingreso';
        $datos['contenido'] = 'usuarios_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitioadmin() {
        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'inicio_admin_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    function sitiobaneo() {
        $datos['titulo'] = 'Ruda - SecciÃ³n AdministraciÃ³n';
        $datos['contenido'] = 'baneado_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitioerror() {
        $datos['titulo'] = 'Ruda - Error';
        $datos['contenido'] = 'error_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    function sitioalumno() {
        $datos['titulo'] = 'Ruda - Sección Alumno';
        $datos['contenido'] = 'adindex';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    function sitioprofesor() {
        $datos['titulo'] = 'Ruda - Sección Profesor';
        $datos['contenido'] = 'inicio_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function ingreso() {

        //si existe el campo oculto llamado grabar creamos las validadciones
        $this->form_validation->set_rules('usu_email', 'Email', 'trim|required');
        $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');

        //SI HAY ALGÃšNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
        $this->form_validation->set_message('required', 'El %s es requerido');

        if ($this->form_validation->run() == FALSE) {
            $this->logueo();
        } else {
            $email = $this->input->post('usu_email');
            $very = $this->usuario_model->verybaneo($email);
            switch ($very) {
                case TRUE:

                    $usr = $this->input->post('usu_email');
                    $pass = md5($this->input->post('usu_pass'));
                    $ingreso = $this->usuario_model->login($usr, $pass);
                    switch ($ingreso) {
                        case 'ALUMNO':
                            redirect(base_url('/frontend/usuarios_control/sitioalumno/'));
                            break;
                        case 'ADMIN':
                            redirect(base_url('/frontend/usuarios_control/sitioadmin/'));
                            break;
                        case 'PROFE':
                            redirect(base_url('/frontend/usuarios_control/sitioprofesor/'));
                            break;
                        case false:
                            redirect(base_url('/frontend/usuarios_control/sitioerror/'));
                            break;
                    }
                    break;
                case false:
                    redirect(base_url('/frontend/usuarios_control/sitiobaneo/'));
                    break;
            }
        }
    }

    public function cerrar() {
        $this->session->sess_destroy();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        redirect(base_url('/frontend/home/index'));
    }

}
