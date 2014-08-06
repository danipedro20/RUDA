<?php
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Carrera_model');
    }
    //Este metodo esta llamando a la pagina principal el cual es la vista index
    function index() {
        $datos['carreras'] = $this->Carrera_model->lista_usuario();
        $datos['titulo'] = 'Ruda - Gestion de Aula';
        $datos['contenido'] = 'index';
        $this->load->view('plantillas/plantilla', $datos);
    }
    
    
}