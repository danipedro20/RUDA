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
        return $query->result();
    }

    public function seltareas() {
        $z = $this->session->userdata('id');
        $l = $this->session->userdata('turno');
        $consulta = $this->db->query("select aulas.idaula from aulas join usu_au on
aulas.idaula=usu_au.idaula join usuarios on usuarios.idusuario=usu_au.idusuario where usuarios.idusuario='$z';");
        $fila = $consulta->row_array();
        $k = $fila['idaula'];
        $b = $this->input->post('selcatedra');
        $c = $this->input->post('ver_rango');
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));

        if ($c == 1) {
            $query = $this->db->query("select tareas.idtarea, tareas.tar_descripcion,tareas.tar_fechaasignacion from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b' and tareas.tar_fechaasignacion='$fechahoy';");
            return $query->result();
        } elseif ($c == 2) {
            $query = $this->db->query("select tareas.idtarea, tareas.tar_descripcion,tareas.tar_fechaentrega from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b' and tareas.tar_fechaentrega>='$fechahoy';");
            return $query->result();
        } elseif ($c == 3) {
            $query = $this->db->query("select  tareas.idtarea,tareas.tar_descripcion from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b'");
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
     public function selta() {
        $c = $this->input->post('seltarea');
        $query = $this->db->query("select * from tareas where idtarea='$c';");
        return $query->result();
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
