<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Planestudio_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/planestudio_model');
    }

    public function plan() {
        $datos['titulo'] = 'Ruda - Crear Plan de estudios';
        $datos['arrDatoscate'] = $this->planestudio_model->selcatedras();
        $datos['arrDatosplan'] = $this->planestudio_model->selplan();
        $datos['contenido'] = 'plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function success() {
        $datos['titulo'] = 'Plan de estudios';
        $datos['contenido'] = 'lisplan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function plan_estudio() {
        $this->planestudio_model->inserplan();
        redirect(base_url('/backend/planestudio_control/success/'));
 
    }

}