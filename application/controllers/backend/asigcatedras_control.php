<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asigcatedras_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/asigcatedras_model');
    }

    public function Asigcatedras() {
        $datos['titulo'] = 'Ruda - Asignar catedras a profesores';
        $datos['arrDatoscatedra'] = $this->asigcatedras_model->selcate();
        $datos['arrDatosprofe'] = $this->asigcatedras_model->selprofe();
        $datos['contenido'] = 'asigcatedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successasignacion() {
        $datos['titulo'] = 'Plan de estudios';
        $datos['contenido'] = 'lisasigacioncatedra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function asignacion() {
        $this->asigcatedras_model->inserasignacion();
        redirect(base_url('/backend/asigcatedras_control/successasignacion/'));
 
    }

}
