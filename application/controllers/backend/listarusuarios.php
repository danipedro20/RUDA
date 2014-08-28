<?php

class Listarusuarios extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('backend/Carrera_model');
    }

    function listarusuario() {
        $datos['carreras'] = $this->Carrera_model->lista_carrera();
        $datos['titulo'] = 'Ruda - Gestion de Aula';
        $datos['contenido'] = 'listausuarioview';
        $this->load->view('plantillas/adplantilla', $datos);
    }
}

