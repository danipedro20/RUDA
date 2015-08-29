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
         $datos['generate'] = $this->suscripcion_model->generatetable();
        $datos['contenido'] = 'carrerasdisponibles_view';
        $this->load->view('plantillas/plantilla', $datos);
    }
    public function suscripcionaulas () {
        $datos['titulo'] = 'Ruda - Suscripcion';
        $datos['arrDatosaulas'] = $this->suscripcion_model->listaraulas();
         $datos['generateaulas'] = $this->suscripcion_model->generatetableaulas();
        $datos['contenido'] = 'aulascarrerasdisponibles_view';
        $this->load->view('plantillas/plantilla', $datos);
    }
 public function suscripcionsinaula () {
        $datos['titulo'] = 'Ruda - Suscripcion';
        $datos['contenido'] = 'carrerassinaulas_view';
        $this->load->view('plantillas/plantilla', $datos);
    }
    }