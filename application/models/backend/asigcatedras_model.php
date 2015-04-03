<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asigcatedras_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selprofe() {
        $query = $this->db->query("SELECT idusuario,usu_nombre FROM usuarios where idperfil='2';");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosplan[htmlspecialchars($row->idusuario, ENT_QUOTES)] = htmlspecialchars($row->usu_nombre, ENT_QUOTES);
            $query->free_result();
            return $arrDatosplan;
        }
    }

    public function selcate() {
        $query = $this->db->query('SELECT idcatedra,cat_denominacion FROM catedras');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatoscate[htmlspecialchars($row->idcatedra, ENT_QUOTES)] = htmlspecialchars($row->cat_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatoscate;
        }
    }

    public function inserasignacion() {

        $b = $_POST['SELprofe'];
        $this->db->where('usu_nombre', $b)
                ->from('usuarios');
        $query = $this->db->get();

        $query = $query->row();
        $j = $query->idusuario;


        $a = $_POST['chosen'];
        foreach ($a as $indice => $valor) {
            $this->db->select('idcatedra')
                    ->where('cat_denominacion', $valor);
            $query = $this->db->get('catedras');
            $row = $query->row_array();
             $id = $row['idcatedra'];



            $sql = "INSERT IGNORE INTO usu_cate (idusuario,idcatedra)
        VALUES (" . $this->db->escape($j) . ", " . $this->db->escape($id) . ")";

            $this->db->query($sql);
        }
    }

}
