<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suscripcion_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->model('frontend/suscripcion_model');
        //$this->load->model('frontend/usuario_model');
    }

    public function suscripcioncarreras() {
        $datos['titulo'] = 'Ruda - Suscripcion';
        $datos['arrDatoscarreras'] = $this->suscripcion_model->listarcarreras();
        $datos['contenido'] = 'carrerasdisponibles_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function suscripcionaulas() {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Suscripcion';
        $datos['listaaulas'] = $this->suscripcion_model->listar($id);
        $datos['id'] = $this->uri->segment(4);
        $datos['contenido'] = 'aulascarrerasdisponibles_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

}
