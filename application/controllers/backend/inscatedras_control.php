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

    public function elicatedra() {
        $datos['titulo'] = 'Ruda - Eliminar Catedra';
        $datos['contenido'] = 'eliminarcatedra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function edicatedra() {
        $datos['titulo'] = 'Ruda - Eliminar Catedra';
        $datos['contenido'] = 'editarcatedra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successcatedra() {
        $datos['titulo'] = ' Exitoso';
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
                if ($_POST['dire'] == base_url('/backend/planestudio_control/plan')) {
                    redirect(base_url('/backend/planestudio_control/plan/'));
                } elseif ($_POST['dire'] == base_url('/backend/asigcatedras_control/asigcatedras')) {

                    redirect(base_url('/backend/asigcatedras_control/asigcatedras/'));
                } else {
                    redirect(base_url('/backend/inscatedras_control/successcatedra/'));
                }
            }
        }
    }

    public function eliminarcatedra() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('cat_denominacion', 'Nombre de Catedra', 'trim|required|callback_catedraeli_check');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->elicatedra();
            } else {
                $a = $this->input->post('cat_denominacion');


                $insert = $this->catedras_model->elimicatedra($a);
                redirect(base_url('/backend/inscatedras_control/successcatedra/'));
            }
        }
    }

    public function editarcatedra() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('cate_denominacion', 'Nombre de Catedra', 'trim|required|callback_catedraedi_check');
              $this->form_validation->set_rules('cat_diascatedra', 'Dias de catera', 'trim|required');
                $this->form_validation->set_rules('nvo_cat_denominacion', 'Dias de catera', 'trim|required');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->edicatedra();
            } else {
                $a = $this->input->post('cate_denominacion');
                $b = $this->input->post('nvo_cat_denominacion');
                $c = $this->input->post('cat_diascatedra');


                $insert = $this->catedras_model->edicatedra($a, $b, $c);
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

    function catedraeli_check($catedra) {
        $this->load->model('catedras_model');
        if ($this->catedras_model->catedraeli_check($catedra)) {
            $this->form_validation->set_message('catedraeli_check', 'La catedra' . " " . $catedra . " " . 'no se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }
     function catedraedi_check($catedra) {
        $this->load->model('catedras_model');
        if ($this->catedras_model->catedraedi_check($catedra)) {
            $this->form_validation->set_message('catedraedi_check', 'La catedra' . " " . $catedra . " " . 'no se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
