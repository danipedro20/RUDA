<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

    public function inscripcion() {
        $datos['titulo'] = 'Ruda - Inscripcion';
        $datos['arrDatoscarreras'] = $this->registro_model->selcarreras();
        $datos['contenido'] = 'inscripcion_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function registrofail() {
        $datos['titulo'] = 'Ruda - Inscripcion';
        $datos['contenido'] = 'registrofail_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function successusu() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function insertarregi() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('usu_nrocedula', 'Nombre', 'trim|required|callback_cedula_check');
            $this->form_validation->set_rules('usu_direccion', 'Dirección', 'trim|required');
            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'trim|required');
            $this->form_validation->set_rules('usu_email', 'Email', 'trim|required|callback_email_check|valid_email');
            $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');
            $this->form_validation->set_rules('pregunta', 'Email', 'trim|required');
            $this->form_validation->set_rules('respuesta', 'Contraseña', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->registro();
            } else {
                $a = $this->input->post('usu_nombre');
                $b = $this->input->post('usu_nrocedula');
                $c = $this->input->post('usu_direccion');
                $d = $this->input->post('usu_telefono');
                $e = $this->input->post('usu_email');
                $f = md5($this->input->post('usu_pass'));
                $g = $this->input->post('pregunta');
                $h = md5($this->input->post('respuesta'));
                $this->db->select('usu_nombre')
                        ->where('usu_nombre', $a);
                $query1 = $this->db->get('inscripciones');
                if ($query1->num_rows() > 0) {
                    $insert = $this->registro_model->insregistro($a, $b, $c, $d, $e, $f);
                    $insert2 = $this->registro_model->inspregunta($g, $h, $e);
                    redirect(base_url('/frontend/registro_control/successusu/'));
                } else {
                     redirect(base_url('/frontend/registro_control/registrofail/'));
                    
                }
            }
        }
    }

    public function insertarinscri() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('selCarreras', 'Carreras', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->registro();
            } else {
                $a = $this->input->post('usu_nombre');
                $k = $this->input->post('idturno');
                $insert = $this->registro_model->insinscri($a, $k);

                redirect(base_url('/frontend/registro_control/registro/'));
            }
        }
    }

    function username_check($nombre) {
        $this->load->model('registro_model');
        if ($this->registro_model->username_check($nombre)) {
            $this->form_validation->set_message('username_check', 'El Nombre' . " " . $nombre . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function cedula_check($cedula) {
        $this->load->model('registro_model');
        if ($this->registro_model->cedula_check($cedula)) {
            $this->form_validation->set_message('cedula_check', 'El Número de Cédula' . " " . $cedula . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function email_check($email) {
        $this->load->model('registro_model');
        if ($this->registro_model->email_check($email)) {
            $this->form_validation->set_message('email_check', 'El Correo' . " " . $email . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
