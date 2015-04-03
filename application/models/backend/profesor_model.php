<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profesor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function vercatedras() {
        $a = $this->session->userdata('id');
        $query = $this->db->query("select  catedras.idcatedra,catedras.cat_denominacion from usu_cate left join
catedras on usu_cate.idcatedra=catedras.idcatedra join usuarios on
usu_cate.idusuario=usuarios.idusuario where usu_cate.idusuario='$a'");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatos[htmlspecialchars($row->idcatedra, ENT_QUOTES)] = htmlspecialchars($row->cat_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatos;
        }
    }

    public function instareas($c, $d, $a, $z) {
        $this->db->select('idcatedra')
                ->where('cat_denominacion', $_POST['selCatedras']);
        $query = $this->db->get('catedras');
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $id = $row['idcatedra'];
            $fecha = date("Y-m-d", strtotime($_POST['fecha']));
            $hoy = date('d-m-Y');
            $fechahoy = date("Y-m-d", strtotime($hoy));
            $data = array(
                'idcatedra' => $id,
                'tar_descripcion' => $d,
                'tar_fechaasignacion' => $fechahoy,
                'tar_fechaentrega' => $fecha,
                'tar_puntostarea' => $c,
                'tar_rutaarchivo' => $a,
                'tar_nombrearchivo' => $z,
            );
            return $this->db->insert('tareas', $data);
        }
    }

}
