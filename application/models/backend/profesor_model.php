<?php

date_default_timezone_set('America/Asuncion');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profesor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function vercatedras() {
        $a = $this->session->userdata('id');

        $query = $this->db->query("select DISTINCT catedras.idcatedra,catedras.cat_denominacion
from catedras  
join cate_plan on catedras.idcatedra=cate_plan.idcatedra
join plan_estudios on cate_plan.idplan=plan_estudios.idplan join aulas on plan_estudios.idplan=aulas.idplan join usu_cate on catedras.idcatedra=usu_cate.idcatedra join
usuarios on usu_cate.idusuario=usuarios.idusuario
 where  usuarios.idusuario='$a';");
        return $query->result();
    }

    public function instareas($c, $d, $a, $z, $y, $p) {




        $fecha = date("Y-m-d", strtotime($_POST['fecha']));
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));
        $data = array(
            'idcatedra' => $y,
            'tar_descripcion' => $d,
            'tar_fechaasignacion' => $fechahoy,
            'tar_fechaentrega' => $fecha,
            'tar_puntostarea' => $c,
            'tar_rutaarchivo' => $a,
            'tar_nombrearchivo' => $z,
            'idaula' => $p,
            'permalink' => $d,
        );
        return $this->db->insert('tareas', $data);
    }

    public function editregistro($a, $c, $d, $e) {
        $data = array(
            'usu_nombre' => $a,
            'usu_direccion' => $c,
            'usu_telefono' => $d,
            'usu_email' => $e
        );

        $this->db->where('idusuario', $this->session->userdata('id'));
        $this->db->update('usuarios', $data);
    }

    public function editinscrip($a) {
        $data = array(
            'usu_nombre' => $a,
        );

        $this->db->where('usu_nombre', $this->session->userdata('nombre'));
        $this->db->update('inscripciones', $data);
    }

    function correo_check($correo) {
        $this->db->select('usu_email')
                ->where('usu_email', $correo);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $ingresado = $row['usu_email'];
        if ($query->num_rows() > 0) {
            $this->db->select('usu_email')
                    ->where('idusuario', $this->session->userdata('id'));
            $query1 = $this->db->get('usuarios');
            $row = $query1->row_array();
            $actual = $row['usu_email'];

            if ($actual == $ingresado) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    public function verlasaulas() {
        $j = $this->session->userdata('id');
        $query = $this->db->query("select DISTINCT  aulas.idaula,aulas.aul_denominacion from aulas join plan_estudios
on aulas.idplan=plan_estudios.idplan join cate_plan on
plan_estudios.idplan=cate_plan.idplan join catedras on cate_plan.idcatedra=catedras.idcatedra join
usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios on usu_cate.idusuario=usuarios.idusuario where usuarios.idusuario='$j'");
        return $query->result();
    }

    public function verlascatedras() {
        $a = $this->session->userdata('id');
        $b = $this->input->post('selaula');
        $query = $this->db->query("select cate.idcatedra,cate.cat_denominacion
from aulas as au join plan_estudios  as plan on au.idplan=plan.idplan
join cate_plan as capa on capa.idplan=plan.idplan join 
catedras as cate on cate.idcatedra=capa.idcatedra join 
usu_cate as usca on usca.idcatedra=cate.idcatedra join 
usuarios as usu on usu.idusuario=usca.idusuario 
where au.idaula='$b' and usu.idusuario='$a';");
        return $query->result();
    }

    public function seltareas() {
        $z = $this->session->userdata('id');
        $k = $this->input->post('selaula2');
        $b = $this->input->post('selcatedra');
        $c = $this->input->post('ver_rango');
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));

        if ($c == 1) {
            $query = $this->db->query("select ta.idtarea,ta.tar_descripcion from tareas as ta join
catedras as cate on ta.idcatedra=cate.idcatedra join aulas as au on ta.idaula=au.idaula join usu_cate as usca on 
usca.idcatedra=cate.idcatedra join usuarios as usu on  usu.idusuario=usca.idusuario
where usu.idusuario='$z'and au.idaula='$k' and cate.idcatedra='$b' and ta.tar_fechaasignacion='$fechahoy';");
            return $query->result();
        } elseif ($c == 2) {
            $query = $this->db->query("select ta.idtarea,ta.tar_descripcion from tareas as ta join
catedras as cate on ta.idcatedra=cate.idcatedra join aulas as au on ta.idaula=au.idaula join usu_cate as usca on 
usca.idcatedra=cate.idcatedra join usuarios as usu on  usu.idusuario=usca.idusuario
where usu.idusuario='$z'and au.idaula='$k' and cate.idcatedra='$b' and ta.tar_fechaentrega>='$fechahoy';");
            return $query->result();
        } elseif ($c == 3) {
            $query = $this->db->query("select ta.idtarea,ta.tar_descripcion from tareas as ta join
catedras as cate on ta.idcatedra=cate.idcatedra join aulas as au on ta.idaula=au.idaula join usu_cate as usca on 
usca.idcatedra=cate.idcatedra join usuarios as usu on  usu.idusuario=usca.idusuario
where usu.idusuario='$z'and au.idaula='$k' and cate.idcatedra='$b'");
            return $query->result();
        }
    }

    public function descarga() {
        $this->load->helper('download');
        $c = $this->input->post('seltarea');


        $this->db->where('idtarea', $c)
                ->from('tareas');
        $query2 = $this->db->get();
        $query3 = $query2->row();
        $j = $query3->tar_rutaarchivo;
        $h = $query3->tar_nombrearchivo;


        $datos = file_get_contents("$j"); // Leer el contenido del archivo
        $nombre = "$h";

        force_download($nombre, $datos);
    }

    public function comentarios($id) {
        $this->db->where('idtarea', $id);

        return $this->db->get('comments')->result();
    }

    public function inscomentario($id, $au, $come, $fe) {
        $data = array(
            'idtarea' => $id,
            'autor' => $au,
            'comentario' => $come,
            'fecha' => $fe,
        );
        return $this->db->insert('comments', $data);
    }

    public function tareas($id) {
        $this->db->where('idtarea', $id);

        return $this->db->get('tareas')->row();
    }

}
