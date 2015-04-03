<?php
//AQUI INICIA EL CONTROLADOR DE LA PAGINA admin
class Adhome extends CI_Controller {
    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
        //llamado al modelo
        $this->load->model('/admin/Perfil_model');
    }
    
    function index2() {
       //echo 'hola mundo';
        $datos['perfiles'] = $this->Perfil_model->perfiles();
        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'adindex';
        $this->load->view('plantillas/adplantilla', $datos);
    }

}  