<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carreras_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/carreras_model');
    }

    public function carreras() {
        $datos['titulo'] = 'Ruda - Crear Carreras';
        $datos['contenido'] = 'carreras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successcarreras() {
        $datos['titulo'] = 'Plan de estudios';
        $datos['contenido'] = 'successcarreras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function insercarreras() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('car_denominacion', 'Nombre de la Carrera', 'trim|required|callback_carreras_check');


            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->carreras();
            } else {
                $a = $this->input->post('car_denominacion');
                $insert = $this->carreras_model->insecarreras($a);
                redirect(base_url('/backend/carreras_control/successcarreras/'));
            }
        }
    }

    function carreras_check($carrera) {
        $this->load->model('carreras_model');
        if ($this->carreras_model->carreras_check($carrera)) {
            $this->form_validation->set_message('carreras_check', 'La Carrera' . " " . $carrera . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}