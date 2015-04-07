<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Success extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index2() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/adplantilla', $datos);
    }
}