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
      public function ediasigcatedra($a, $b,$c) {
           $this->db->select('idcatedra')
                ->where('cat_denominacion', $b);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $idvieja = $row['idcatedra'];
        
         $this->db->select('idcatedra')
                ->where('cat_denominacion', $c);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $idnueva = $row['idcatedra'];
          
              $this->db->select('idusuario')
                ->where('usu_nombre', $a);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $id = $row['idusuario'];
        
        $data = array(
            'idcatedra' => $idnueva,
        );

        $this->db->where('idcatedra', $idvieja);
         $this->db->where('idusuario', $id);
        $this->db->update('usu_cate', $data);
    }
      public function elimiasigcatedra($a,$b) {
         $this->db->select('idcatedra')
                ->where('cat_denominacion', $b);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $idcatedra = $row['idcatedra'];
          
              $this->db->select('idusuario')
                ->where('usu_nombre', $a);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $idusuario = $row['idusuario'];

        $this->db->where('idcatedra', $idcatedra);
         $this->db->where('idusuario', $idusuario);
        $this->db->delete('usu_cate');
    }
    

    function catedraedi_check($catedra) {
        $profe = $_POST['SELprofe'];
        $this->db->select('idcatedra')
                ->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $id = $row['idcatedra'];
       
        $this->db->select('idusuario')
                ->where('usu_nombre', $profe);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $idusu = $row['idusuario'];
       
        $this->db->where('idcatedra', $id);
         $this->db->where('idusuario', $idusu);
        $query = $this->db->get('usu_cate');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }
      function catedraeditar_check($catedra) {
        $profe = $_POST['SELprofe'];
        $this->db->select('idcatedra')
                ->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $id = $row['idcatedra'];
       
        $this->db->select('idusuario')
                ->where('usu_nombre', $profe);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $idusu = $row['idusuario'];
       
        $this->db->where('idcatedra', $id);
         $this->db->where('idusuario', $idusu);
        $query = $this->db->get('usu_cate');

        if ($query->num_rows()> 0) {
            return TRUE;
        }
    }
    function catedraeli_check($catedra) {
        $profe = $_POST['SELprofe'];
        $this->db->select('idcatedra')
                ->where('cat_denominacion', $catedra);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $id = $row['idcatedra'];
       
        $this->db->select('idusuario')
                ->where('usu_nombre', $profe);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $idusu = $row['idusuario'];
       
        $this->db->where('idcatedra', $id);
         $this->db->where('idusuario', $idusu);
        $query = $this->db->get('usu_cate');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

}
