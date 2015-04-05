<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selcatedras() {
        $a = $this->session->userdata('nombre');
        $query = $this->db->query("select catedras.idcatedra,catedras.cat_denominacion
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
 join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  join usu_au on
usu_au.idaula=au.idaula  join usuarios as alumno on usu_au.idusuario=alumno.idusuario
join usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios as profesor on usu_cate.idusuario=profesor.idusuario
 join catedras as cate on usu_cate.idcatedra=cate.idcatedra
    where alumno.usu_nombre='$a';");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatoscate[htmlspecialchars($row->idcatedra, ENT_QUOTES)] = htmlspecialchars($row->cat_denominacion, ENT_QUOTES);
            $query->free_result();
            return $arrDatoscate;
        }
    }

    public function seltareas() {
        $b = $_POST['SEL'];

        $this->db->select('idcatedra')
                ->where('cat_denominacion', $b);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $idtar = $row['idcatedra'];

        $query = $this->db->query("select tareas.idtarea,tareas.tar_descripcion from tareas 
left join catedras on tareas.idcatedra=catedras.idcatedra where catedras.idcatedra='$idtar'");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatostarea[htmlspecialchars($row->idtarea, ENT_QUOTES)] = htmlspecialchars($row->tar_descripcion, ENT_QUOTES);
            $query->free_result();
            return $arrDatostarea;
        }
    }

    public function descarga() {
        $this->load->helper('download');
        $c = $_POST['SELtarea'];

        $this->db->select('idtarea')
                ->where('tar_descripcion', $c);
        $query = $this->db->get('tareas');
        $row = $query->row_array();
        $idtar = $row['idtarea'];


        $this->db->where('idtarea', $idtar)
                ->from('tareas');
        $query2 = $this->db->get();
        $query3 = $query2->row();
      $j= $query3->tar_rutaarchivo;
      $h=$query3->tar_nombrearchivo;
    

        $datos = file_get_contents("$j"); // Leer el contenido del archivo
        $nombre = "$h";

        force_download($nombre, $datos);
    }

}
