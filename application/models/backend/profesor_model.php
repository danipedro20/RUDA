<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profesor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function vercatedras() {
        $a = $this->session->userdata('id');
        $b = $_POST['selAula'];
        $query = $this->db->query("select catedras.idcatedra,catedras.cat_denominacion
from catedras  
join cate_plan on catedras.idcatedra=cate_plan.idcatedra
join plan_estudios on cate_plan.idplan=plan_estudios.idplan join aulas on plan_estudios.idplan=aulas.idplan join usu_cate on catedras.idcatedra=usu_cate.idcatedra join
usuarios on usu_cate.idusuario=usuarios.idusuario
 where aulas.aul_denominacion='$b' and usuarios.idusuario='$a';");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatos[htmlspecialchars($row->idcatedra, ENT_QUOTES)] = htmlspecialchars($row->cat_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatos;
        }
    }

    public function veraulas() {
        $j = $this->session->userdata('id');
        $query = $this->db->query("select DISTINCT  aulas.idaula,aulas.aul_denominacion from aulas join plan_estudios
on aulas.idplan=plan_estudios.idplan join cate_plan on
plan_estudios.idplan=cate_plan.idplan join catedras on cate_plan.idcatedra=catedras.idcatedra join
usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios on usu_cate.idusuario=usuarios.idusuario where usuarios.idusuario='$j'");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatoaulas[htmlspecialchars($row->idaula, ENT_QUOTES)] = htmlspecialchars($row->aul_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatoaulas;
        }
    }

    public function instareas($c, $d, $a, $z) {
        
        $this->db->select('idaula')
                ->where('aul_denominacion', $_POST['aula']);
        $query = $this->db->get('aulas');
            $row = $query->row_array();
            $idau = $row['idaula'];
        
        
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
                'idaula' => $idau,
         
               
                
            );
            return $this->db->insert('tareas', $data);
        }
    }

}
