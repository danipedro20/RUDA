<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insplan_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/plan_model');
    }

    public function planestudio() {
        $datos['titulo'] = 'Ruda - Crear Catedra';
        $datos['contenido'] = 'planestudio_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successplan() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'sucess_plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function inserplan() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('pla_denominacion', 'Nombre de Plan', 'trim|required|callback_plan_check');


            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->planestudio();
            } else {
                $a = $this->input->post('pla_denominacion');


                $insert = $this->plan_model->inseplan($a);
                if ($_POST['direccion'] == base_url('/backend/planestudio_control/plan')) {
                    redirect(base_url('/backend/planestudio_control/plan/'));
                } elseif ($_POST['direccion'] == base_url('/backend/reg_aula/nueva_aula')) {
                    redirect(base_url('/backend/reg_aula/nueva_aula'));
                } else {
                    redirect(base_url('/backend/insplan_control/successplan/'));
                }
            }
        }
    }

    function plan_check($plan) {
        $this->load->model('plan_model');
        if ($this->plan_model->plan_check($plan)) {
            $this->form_validation->set_message('plan_check', 'El plan de Estudio' . " " . $plan . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
