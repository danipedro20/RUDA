<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_aula_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selplanes() {
        $query = $this->db->query('SELECT idplan,pla_denominacion FROM plan_estudios');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosplan[htmlspecialchars($row->idplan, ENT_QUOTES)] = htmlspecialchars($row->pla_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatosplan;
        }
    }

    public function selcarreras() {
        $query = $this->db->query('SELECT id_carrera,car_denominacion FROM carreras');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosplan[htmlspecialchars($row->id_carrera, ENT_QUOTES)] = htmlspecialchars($row->car_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatosplan;
        }
    }

    public function insaula($c, $d, $a, $e) {
        $this->db->select('id_carrera')
                ->where('car_denominacion', $_POST['selCarreras']);
        $query1 = $this->db->get('carreras');
        if ($query1->num_rows() > 0) {
            $row = $query1->row_array();
            $id = $row['id_carrera'];
            $this->db->select('idplan')
                    ->where('pla_denominacion', $_POST['selplanes']);
            $query = $this->db->get('plan_estudios');
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                $idplan = $row['idplan'];
                $data = array(
                    'aul_denominacion' => $c,
                    'aul_plazasdisponibles' => $d,
                    'aul_plazashabilitadas' => $a,
                    'id_carrera' => $id,
                    'idplan' => $idplan,
                    'idturno' => $e,
                );
                return $this->db->insert('aulas', $data);
            }
        }
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
