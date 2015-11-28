<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Nosotros extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function sobrenosotros() {
        $datos['titulo'] = 'Sobre Nosotros';
        $datos['contenido'] = 'nosotrosview';
        $this->load->view('plantillas/plantilla', $datos);
    }
}