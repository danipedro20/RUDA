<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//AQUI INICIA EL MODELADO DE LO QUE SE VA A PEDIR A LA BD DEL SISTEMA
class Suscripcion_model extends CI_Model {

    //Tambien inicializamos un constructor 
    public function __construct() {
        parent::__construct();
    }

    //lista las carreras disponibles
    public function listarcarreras() {

        $query = $this->db->query("select id_carrera,car_denominacion from carreras");
        return $query->result();
    }

    public function listaraulas() {
        $a = $this->input->post('selcarreras');
        $query = $this->db->query("select aulas.idaula, aulas.aul_denominacion
from aulas  join carreras on aulas.id_carrera=carreras.id_carrera where carreras.id_carrera='$a' and aulas.aul_plazasdisponibles > 0;");
        return $query->result();
    }

        public function listar($id) {
       $query = $this->db->query("select aulas.idaula,aulas.aul_denominacion,plan_estudios.idplan,plan_estudios.pla_denominacion,aulas.aul_plazasdisponibles,aulas.idturno
from aulas join plan_estudios on aulas.idplan=plan_estudios.idplan  join carreras on aulas.id_carrera=carreras.id_carrera where carreras.id_carrera='$id' and aulas.aul_plazasdisponibles > 0;");
        return $query->result();
    }


}
