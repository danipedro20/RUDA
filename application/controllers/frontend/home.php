<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//AQUI INICIA EL CONTROLADOR DE LA PAGINA PRINCIPAL
class Home extends CI_Controller{
    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
       
        
    }
    //Este metodo esta llamando a la pagina principal el cual es la vista index
    function index() {
        
        $datos['titulo'] = 'Ruda - Gestion de Aula';
        $datos['contenido'] = 'index';
        $this->load->view('plantillas/plantilla', $datos);
       
    }
    
    
}  