<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insplan_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/plan_model');
    }

    public function planestudio() {
        $datos['titulo'] = 'Ruda - Crear  Plan de Estudios';
        $datos['contenido'] = 'planestudio_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_plan_estudios() {
        $datos['titulo'] = 'Ruda - Crear  Plan de Estudios';
        $datos['plan'] = $this->plan_model->listar_planes();
        $datos['contenido'] = 'listar_plan_estudios_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editar_plan_estudio($b) {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Editar Plan de Estudios ';
        $datos['plan'] = $this->plan_model->editar_plan($id);
        $datos['id'] = $b;
        $datos['contenido'] = 'editar_plan_estudio_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

//        public function editarplanestudio() {
//        $id = $this->uri->segment(4);
//        $idca = $this->uri->segment(5);
//        $datos['titulo'] = 'Ruda - Editar Plan de Estudios ';
//        $datos['plan'] = $this->plan_model->plan_catedra($id, $idca);
//        $datos['catedra'] = $this->plan_model->lista_catedra();
//        $datos['contenido'] = 'editarplanestudio_view';
//        $this->load->view('plantillas/adplantilla', $datos);
//    }

    public function successplan() {
        $datos['titulo'] = 'Plan de Estudios';
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
                redirect(base_url('/backend/insplan_control/successplan/'));
            }
        }
    }

    public function editar_planestudio() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('pla_denominacion', 'Nombre de Plan ', 'trim|required|callback_editar_plan_check');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $b = $this->input->post('idplan');

                $this->editar_plan_estudio($b);
            } else {
                $a = $this->input->post('pla_denominacion');
                $b = $this->input->post('idplan');




                $insert = $this->plan_model->editarplanestudio($a, $b);
                // $insertplan = $this->plan_model->ediplan_catedra($b, $d);
                redirect(base_url('/backend/insplan_control/listar_plan_estudios/'));
            }
        }
    }

//    public function eliminar_planestudio_catedra() {
//        $a = $this->uri->segment(4);
//        $b = $this->uri->segment(5);
//
//
//        $eliminar = $this->plan_model->elimiplan_catedra($a, $b);
//        redirect(base_url('/backend/planestudio_control/success/'));
//    }

    public function eliminar_planestudio() {
        $a = $this->uri->segment(4);
        $eliminar = $this->plan_model->eliminarplan($a);
        redirect(base_url('/backend/insplan_control/listar_plan_estudios/'));
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

    function editar_plan_check($plan) {

        $this->load->model('plan_model');
        if ($this->plan_model->editarplan_check($plan)) {
            $this->form_validation->set_message('editar_plan_check', 'El plan de Estudio' . " " . $plan . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
