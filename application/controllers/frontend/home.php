<?php
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//AQUI INICIA EL CONTROLADOR DE LA PAGINA PRINCIPAL
class Home extends CI_Controller{
    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
       
<<<<<<< HEAD
=======
=======
//AQUI INICIA EL CONTROLADOR DE LA PAGINA PRINCIPAL
class Home extends CI_Controller {
    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
        
    }
    //Este metodo esta llamando a la pagina principal el cual es la vista index
    function index() {
        
        $datos['titulo'] = 'Ruda - Gestion de Aula';
        $datos['contenido'] = 'index';
        $this->load->view('plantillas/plantilla', $datos);
<<<<<<< HEAD
       
=======
<<<<<<< HEAD
       
=======
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
    }
    
    
}  