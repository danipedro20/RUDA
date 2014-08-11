<?php
//AQUI INICIA EL CONTROLADOR DE LA PAGINA PRINCIPAL
class Adhome extends CI_Controller {
    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
        //llamado al modelo
        //$this->load->model('Carrera_model');
    }
    
    function index2() {
       echo 'hola mundo';
    }
       
}  