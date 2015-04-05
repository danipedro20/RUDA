<?php
<<<<<<< HEAD
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
=======
<<<<<<< HEAD
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
=======
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
//AQUI INICIA EL MODELADO DE LO QUE SE VA A PEDIR A LA BD DEL SISTEMA
class Carrera_model extends CI_Model {
    //Tambien inicializamos un constructor 
    public function __construct() {
        parent::__construct();
    }
    //Genera una lista de carreras
    function lista_usuario() {
        $consulta = $this->db->get('carreras');
        return $consulta->result();
    } 
}

