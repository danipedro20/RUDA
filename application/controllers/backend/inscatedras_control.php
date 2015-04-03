<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inscatedras_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/catedras_model');
    }

    public function catedra() {
        $datos['titulo'] = 'Ruda - Crear Catedra';
        $datos['contenido'] = 'catedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successcatedra() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successcatedra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function insercatedra() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('cat_denominacion', 'Nombre de Catedra', 'trim|required|callback_catedra_check');
            $this->form_validation->set_rules('cat_diascatedra', 'Dias de catera', 'trim|required');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->catedra();
            } else {
                $a = $this->input->post('cat_denominacion');
                $b = $this->input->post('cat_diascatedra');

                $insert = $this->catedras_model->insecatedra($a, $b);

                redirect(base_url('/backend/inscatedras_control/successcatedra/'));
            }
        }
    }

    function catedra_check($catedra) {
        $this->load->model('catedras_model');
        if ($this->catedras_model->catedra_check($catedra)) {
            $this->form_validation->set_message('catedra_check', 'La catedra' . " " . $catedra . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
