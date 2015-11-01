<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_aula_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selplanes() {
        $query = $this->db->query('SELECT idplan,pla_denominacion FROM plan_estudios');
        return $query->result();
    }

    public function selcarreras() {
        $query = $this->db->query('SELECT id_carrera,car_denominacion FROM carreras');
        return $query->result();
    }

    public function insaula($a,$b,$c,$d,$e) {
                $data = array(
                    'aul_denominacion' => $a,
                    'aul_plazasdisponibles' => $b,
                    'aul_plazashabilitadas' => $b,
                    'id_carrera' => $e,
                    'idplan' => $d,
                    'idturno' => $c,
                );
                return $this->db->insert('aulas', $data);
            }
      public function usu_au($a,$e) {
           $this->db->select('idaula')
                ->where('aul_denominacion', $a);
        $query = $this->db->get('aulas');
        $row = $query->row_array();
        $aula = $row['idaula'];
               
          $data = array(
                    'idaula' => $aula,
                    'idturno' => $e,
                );
                return $this->db->insert('tur_aulas', $data);
            }

    public function ediaula($a, $b, $c, $d, $e, $f, $g) {

        $data = array(
            'aul_denominacion' => $a,
            'aul_plazasdisponibles' => $g,
            'aul_plazashabilitadas' => $d,
            'id_carrera' => $b,
            'idplan' => $c,
            'idturno' => $e,
        );

        $this->db->where('idaula', $f);
        $this->db->update('aulas', $data);
    }

    public function elimiaula($a){

        $tablas = array('usu_au', 'aulas','tareas');
        $this->db->where('idaula', $a);
        $this->db->delete($tablas);
    }


    public function lista() {
        $query = $this->db->query("select aulas.idaula,aulas.aul_denominacion,carreras.car_denominacion,plan_estudios.pla_denominacion,aulas.idturno
from aulas inner join carreras on aulas.id_carrera=carreras.id_carrera
inner join plan_estudios on aulas.idplan=plan_estudios.idplan;");
        return $query->result();
    }

    public function aula($id) {
        $query = $this->db->query("select au.idaula,au.aul_plazasdisponibles,au.aul_denominacion,au.aul_plazashabilitadas,ca.id_carrera,ca.car_denominacion,pla.idplan,pla.pla_denominacion,au.idturno
from aulas as au join carreras as ca on au.id_carrera=ca.id_carrera join plan_estudios as pla on au.idplan=pla.idplan where  au.idaula='$id';");
        return $query->row();
    }


//    function aula_check($aula) {
//        $this->db->where('aul_denominacion', $aula);
//        $query = $this->db->get('aulas');
//
//        if ($query->num_rows() > 0) {
//            return TRUE;
//        }
//    }
//
}
