<?php
<<<<<<< HEAD
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
=======

>>>>>>> 587a410884994d81ace192363fd4848d379c6813
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

