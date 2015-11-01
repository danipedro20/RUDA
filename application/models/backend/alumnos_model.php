<?php

header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selcatedras() {
        $a = $this->session->userdata('id');
        $query = $this->db->query("select ca.idcatedra,ca.cat_denominacion  from usu_cate as cate
right join catedras as ca on ca.idcatedra=cate.idcatedra
left join usuarios as profesor on cate.idusuario=profesor.idusuario
left join cate_plan as capa on ca.idcatedra=capa.idcatedra
left join plan_estudios as pla on pla.idplan=capa.idplan
left join aulas as au on au.idplan=pla.idplan
left join carreras as car on car.id_carrera=au.id_carrera
left join usu_au as usca on usca.idaula=au.idaula
left join usuarios as alumno on usca.idusuario=alumno.idusuario
where alumno.idusuario='$a';");
        return $query->result();
    }

    public function lista_planes_alumnos() {
        $a = $this->session->userdata('id');

        $consulta = $this->db->query("select ca.cat_denominacion,profesor.usu_nombre,pla.pla_denominacion,au.aul_denominacion,car.car_denominacion,alumno.idusuario from usu_cate as cate
right join catedras as ca on ca.idcatedra=cate.idcatedra
left join usuarios as profesor on cate.idusuario=profesor.idusuario
left join cate_plan as capa on ca.idcatedra=capa.idcatedra
left join plan_estudios as pla on pla.idplan=capa.idplan
left join aulas as au on au.idplan=pla.idplan
left join carreras as car on car.id_carrera=au.id_carrera
left join usu_au as usca on usca.idaula=au.idaula
left join usuarios as alumno on usca.idusuario=alumno.idusuario
where alumno.idusuario='$a';");
        return $consulta->result();
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
            $query = $this->db->query("select tareas.idtarea, tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea,tareas.tar_nombrearchivo from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b' and tareas.tar_fechaasignacion='$fechahoy';");
            return $query->result();
        } elseif ($c == 2) {
            $query = $this->db->query("select tareas.idtarea, tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea,tareas.tar_nombrearchivo from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b' and tareas.tar_fechaentrega>='$fechahoy';");
            return $query->result();
        } elseif ($c == 3) {
            $query = $this->db->query("select  tareas.idtarea,tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea,tareas.tar_nombrearchivo from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b'");
            return $query->result();
        }
    }

    public function descarga($entry_id) {
        $this->load->helper('download');
        $c = $this->input->post('seltarea');

        $this->db->where('idtarea', $entry_id)
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

    public function inscomentario($id, $au, $come, $fe, $ruta, $nombre) {
        $data = array(
            'idtarea' => $id,
            'autor' => $au,
            'comentario' => $come,
            'fecha' => $fe,
            'ruta_archivo' => $ruta,
            'nombre_archivo' => $nombre,
        );
        return $this->db->insert('comments', $data);
    }

    public function tareas($id) {
        $this->db->where('idtarea', $id);

        return $this->db->get('tareas')->row();
    }

    public function obtener_id($a) {
        $this->db->where('idcomentario', $a);

        return $this->db->get('comments')->row();
    }

    public function eliminar_comentario($a) {
        $this->db->where('idcomentario', $a);
        $this->db->delete('comments');
    }

    public function descargaadjunto($entry_id) {
        $this->load->helper('download');


        $this->db->where('idcomentario', $entry_id)
                ->from('comments');
        $query2 = $this->db->get();
        $query3 = $query2->row();
        $j = $query3->ruta_archivo;
        $h = $query3->nombre_archivo;


        $datos = file_get_contents("$j"); // Leer el contenido del archivo
        $nombre = "$h";

        force_download($nombre, $datos);
    }

}
