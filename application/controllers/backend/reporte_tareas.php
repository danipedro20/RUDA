<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Reporte_tareas extends CI_Controller {

            public function __construct() {
                parent::__construct();
                $this->load->model('backend/reporte_tareas_model');
                $this->load->library('table');
                $this->load->library('pdf');
            }

             public function listar_tareas() {
        $datos['titulo'] = 'Lista de Tareas';
        $datos['lista'] = $this->reporte_tareas_model->lista_tareas();
        $datos['contenido'] = 'reporte_tareas_view';
        $this->load->view('plantillas/adplantilla', $datos);
        }

            
    }
