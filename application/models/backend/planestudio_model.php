<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Planestudio_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selplan() {
        $query = $this->db->query('SELECT idplan,pla_denominacion FROM plan_estudios');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosplan[htmlspecialchars($row->idplan, ENT_QUOTES)] = htmlspecialchars($row->pla_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatosplan;
        }
    }

    public function selcatedras() {
        $query = $this->db->query('SELECT idcatedra,cat_denominacion FROM catedras');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatoscate[htmlspecialchars($row->idcatedra, ENT_QUOTES)] = htmlspecialchars($row->cat_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatoscate;
        }
    }
    public function inserplan() {
        
        $b = $_POST['SELplan'];
        $this->db->select('idplan')
                ->where('pla_denominacion', $b);
        $query = $this->db->get('plan_estudios');
        $row = $query->row_array();
        $idplan = $row['idplan'];

        $a = $_POST['chosen'];
        foreach ($a as $indice => $valor) {

            $this->db->select('idcatedra')
                    ->where('cat_denominacion', $valor);
            $query = $this->db->get('catedras');
            $row = $query->row_array();
             $id = $row['idcatedra'];
         
            $sql = "INSERT IGNORE INTO cate_plan (idcatedra,idplan)
        VALUES (" . $this->db->escape($id) . ", " . $this->db->escape($idplan) . ")";

            $this->db->query($sql);
          
        }
    }
}
