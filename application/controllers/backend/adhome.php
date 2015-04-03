<?php
<<<<<<< HEAD

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//AQUI INICIA EL CONTROLADOR DE LA PAGINA admin
class Adhome extends CI_Controller {

    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
       
        //llamado al modelo
        //   $this->load->model('/backend/Perfil_model');
    }

    function index2() {


=======
//AQUI INICIA EL CONTROLADOR DE LA PAGINA admin
class Adhome extends CI_Controller {
    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
        //llamado al modelo
        $this->load->model('/backend/Perfil_model');
    }
    
    function index2() {

        $datos['perfiles'] = $this->Perfil_model->perfiles();
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'adindex';
        $this->load->view('plantillas/adplantilla', $datos);
    }

<<<<<<< HEAD
}
=======
}  
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
