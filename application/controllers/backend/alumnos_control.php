<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnos_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->model('backend/alumnos_model');
     
        
    }

    public function successalumnosplan() {
        $datos['titulo'] = 'Plan de Estudio';
        $datos['contenido'] = 'lisaulasalumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }
  

    public function successalumnostareas() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatoscate'] = $this->alumnos_model->selcatedras();
        $datos['contenido'] = 'alumtarea_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }
     public function successalumnoslis() {
        $datos['titulo'] = 'Tareas';
         $datos['arrDatostar'] = $this->alumnos_model->seltareas();
        $datos['contenido'] = 'listareasalumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }
     public function Descargar_archivo() {
        $this->alumnos_model->descarga();
    }

}
