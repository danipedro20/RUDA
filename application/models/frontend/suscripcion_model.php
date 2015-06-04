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
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatoscarreras[htmlspecialchars($row->id_carrera, ENT_QUOTES)] = htmlspecialchars($row->car_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatoscarreras;
        }
    }

    public function listaraulas() {
        $a=$_POST['selcarrera'];

        $query = $this->db->query("select aulas.idaula, aulas.aul_denominacion
from aulas  join carreras on aulas.id_carrera=carreras.id_carrera where carreras.car_denominacion='$a' and aulas.aul_plazasdisponibles > 0;");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosaulas[htmlspecialchars($row->idaula, ENT_QUOTES)] = htmlspecialchars($row->aul_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatosaulas;
        }
    }
        public function generatetable() {
         return $this->db->query("select car_denominacion from carreras;");

}
}