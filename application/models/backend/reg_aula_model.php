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

   

    public function selalumno() {
        $query = $this->db->query('SELECT idusuario,usu_nombre FROM usuarios where idperfil=3');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosalumno[htmlspecialchars($row->idusuario, ENT_QUOTES)] = htmlspecialchars($row->usu_nombre, ENT_QUOTES);
            $query->free_result();
            return $arrDatosalumno;
        }
    }

    public function insaula($c, $d, $a) {
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
                );
                return $this->db->insert('aulas', $data);
            }
        }
    }

    function aula_check($aula) {
        $this->db->where('aul_denominacion', $aula);
        $query = $this->db->get('aulas');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    public function inserau_usu($c) {

        $this->db->select('idaula')
                ->where('aul_denominacion', $c);
        $query2 = $this->db->get('aulas');
        $row = $query2->row_array();
        $idaula = $row['idaula'];
        $a = $_POST['chosen'];
        foreach ($a as $indice => $valor) {

            $this->db->select('idusuario')
                    ->where('usu_nombre', $valor);
            $query4 = $this->db->get('usuarios');
            $row = $query4->row_array();
            $idusuario = $row['idusuario'];

            $sql2 = "INSERT IGNORE INTO usu_au (idusuario,idaula)
        VALUES (" . $this->db->escape($idusuario) . ", " . $this->db->escape($idaula) . ")";

            $this->db->query($sql2);
        }
    }

}
