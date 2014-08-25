<?php

class Usuarios_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $datos['titulo'] = 'Ruda - Inicio Sesion';
        $datos['contenido'] = 'usuarios_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

}
