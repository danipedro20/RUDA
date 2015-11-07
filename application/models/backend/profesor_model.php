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

    public function instareas($c, $d, $a, $z, $y, $p, $x) {




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
        $query = $this->db->query("select DISTINCT  aulas.idaula,aulas.aul_denominacion from aulas 
join plan_estudios on aulas.idplan=plan_estudios.idplan 
join cate_plan on plan_estudios.idplan=cate_plan.idplan 
join catedras on cate_plan.idcatedra=catedras.idcatedra 
join usu_cate on usu_cate.idcatedra=catedras.idcatedra 
join usuarios on usu_cate.idusuario=usuarios.idusuario 
where usuarios.idusuario='$j'");
        return $query->result();
    }

    public function verlascatedras($id) {
        $a = $this->session->userdata('id');
        $query = $this->db->query("select DISTINCT ca.idcatedra,ca.cat_denominacion
from catedras as ca  
join cate_plan as capa on ca.idcatedra=capa.idcatedra
join plan_estudios as plan on capa.idplan=plan.idplan
join aulas as au on plan.idplan=au.idplan
join usu_cate as usca on ca.idcatedra=usca.idcatedra 
join usuarios as usu on usca.idusuario=usu.idusuario
where au.idaula='$id' and usca.idusuario='$a';");
        return $query->result();
    }

    public function seltareas() {
        $z = $this->session->userdata('id');
        $k = $this->input->post('aula');
        $b = $this->input->post('catedra');
        $c = $this->input->post('ver_rango');
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));

        if ($c == 2) {
            $query = $this->db->query("select ta.idtarea,ta.tar_descripcion,ta.tar_fechaasignacion,ta.tar_fechaentrega,ta.tar_puntostarea,ta.tar_nombrearchivo from tareas as ta 
join catedras as cate on ta.idcatedra=cate.idcatedra 
join aulas as au on ta.idaula=au.idaula join usu_cate as usca on  usca.idcatedra=cate.idcatedra 
join usuarios as usu on  usu.idusuario=usca.idusuario
where usu.idusuario='$z'and au.idaula='$k' and cate.idcatedra='$b' and ta.tar_fechaentrega>='$fechahoy';");
            return $query->result();
        } elseif ($c == 3) {
            $query = $this->db->query("select ta.idtarea,ta.tar_descripcion,ta.tar_fechaasignacion,ta.tar_fechaentrega,ta.tar_puntostarea,ta.tar_nombrearchivo from tareas as ta 
join catedras as cate on ta.idcatedra=cate.idcatedra 
join aulas as au on ta.idaula=au.idaula join usu_cate as usca on usca.idcatedra=cate.idcatedra 
join usuarios as usu on  usu.idusuario=usca.idusuario
where usu.idusuario='$z'and au.idaula='$k' and cate.idcatedra='$b'");
            return $query->result();
        }
    }

    public function descarga($entry_id) {
        $this->load->helper('download');


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

    public function veralumnos() {
        $a = $this->input->post('catedra');
        $b = $this->input->post('aula');

        $consulta = $this->db->query("select alumno.idusuario,alumno.usu_nombre, alumno.usu_nrocedula,catedras.cat_denominacion,au.idaula,au.aul_denominacion from aulas as au 
left join carreras on au.id_carrera=carreras.id_carrera
join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra 
join usu_au on usu_au.idaula=au.idaula 
join usuarios as alumno on usu_au.idusuario=alumno.idusuario
join usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios as profesor on usu_cate.idusuario=profesor.idusuario
join catedras as cate on usu_cate.idcatedra=cate.idcatedra
where catedras.idcatedra='$a' and au.idaula='$b';");
        return $consulta->result();
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

    public function eliminar_comentario($a) {
        $this->db->where('idcomentario', $a);
        $this->db->delete('comments');
    }

    public function obtener_id($a) {
        $this->db->where('idcomentario', $a);

        return $this->db->get('comments')->row();
    }

    public function insert_asistencia($idusuario, $idcatedra, $estado, $Justificacion, $fecha, $aula) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'asi_fecha' => $fecha,
            'asi_estado' => $estado,
            'asi_justificacion' => $Justificacion,
            'idaula' => $aula,
        );
        return $this->db->insert('asistencias', $data);
    }

    public function editar_asistencia($idusuario, $idcatedra, $estado, $Justificacion, $fecha, $aula) {
        $data = array(
            'asi_estado' => $estado,
            'asi_justificacion' => $Justificacion,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idaula', $aula);
        $this->db->where('asi_fecha', $fecha);
        $this->db->update('asistencias', $data);
    }

    public function verificar_lista($a, $b, $c) {
        if (empty($a)) {
            $a = $this->input->post('catedra');
            $b = $this->input->post('aula');
            $hoy = date('d-m-Y');
            $fechahoy = date("Y-m-d", strtotime($hoy));

            $consulta = $this->db->query("select * from asistencias where idcatedra='$a' and asi_fecha >='$fechahoy' and idaula='$b';");
            return $consulta->row();
        } else {
            $consulta = $this->db->query("select distinct asi.idaula,asi.idcatedra,asi.asi_fecha,ca.cat_denominacion from asistencias as asi 
join catedras as ca on asi.idcatedra=ca.idcatedra 
where asi.idcatedra='$a' and asi_fecha='$c' and asi.idaula='$b';");
            return $consulta->row();
        }
    }

    public function datos_lista($a, $b, $c) {
        $consulta = $this->db->query("select asi.idaula,asi.idcatedra,asi.idusuario,asi.asi_estado,asi.asi_justificacion,usu.usu_nombre,usu.usu_nrocedula,asi_fecha from asistencias as asi 
join catedras as ca on asi.idcatedra=ca.idcatedra 
join usuarios as usu on usu.idusuario=asi.idusuario 
where asi.idcatedra='$a' and asi.asi_fecha='$c' and asi.idaula='$b';");
        return $consulta->result();
    }

    public function lista_dar_puntajes($a) {
        $consulta = $this->db->query("select distinct ta.idtarea,ta.tar_descripcion,ta.tar_puntostarea,alum.idusuario,alum.usu_nombre,alum.usu_nrocedula,cate.idcatedra from tareas as ta 
join catedras as cate on ta.idcatedra=cate.idcatedra 
join aulas as au on ta.idaula=au.idaula 
join usu_cate as usca on 
usca.idcatedra=cate.idcatedra 
join usuarios as usu on  usu.idusuario=usca.idusuario 
join usu_au as usau on usau.idaula=au.idaula 
join usuarios as alum on alum.idusuario=usau.idusuario
where ta.idtarea='$a';");
        return $consulta->result();
    }

    public function nombrecatedra($a) {

        if (empty($a)) {
            $p = $this->input->post('idcatedra');
            $this->db->where('idcatedra', $p);

            return $this->db->get('catedras')->row();
        } else {
            $this->db->where('idcatedra', $a);

            return $this->db->get('catedras')->row();
        }
    }

    public function guardar_notas_tarea($idusuario, $idcatedra, $idtarea, $puntos, $puntos_logrados) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'puntos_asignados' => $puntos,
            'puntos_logrados' => $puntos_logrados,
            'idtarea' => $idtarea,
        );
        return $this->db->insert('notas_tarea', $data);
    }

    public function listar_puntaje($a) {
        $consulta = $this->db->query("select n.id,n.idusuario,usu.usu_nombre,usu.usu_nrocedula,ta.tar_descripcion,n.puntos_asignados,n.puntos_logrados,n.idtarea,n.idcatedra from notas_tarea as n
join usuarios as usu on usu.idusuario=n.idusuario 
join tareas as ta on n.idtarea=ta.idtarea
where ta.idtarea='$a';");
        return $consulta->result();
    }

    public function editar_notas_tarea($id, $puntos_logrados) {
        $data = array(
            'puntos_logrados' => $puntos_logrados,
        );

        $this->db->where('id', $id);
        $this->db->update('notas_tarea', $data);
    }

    public function lista_catedras() {
        $j = $this->session->userdata('id');
        $query = $this->db->query("select capa.diascatedra,ca.cat_denominacion,profesor.usu_nombre,pla.pla_denominacion,au.aul_denominacion,car.car_denominacion,ca.idcatedra,pla.idplan,au.idaula from usu_cate as cate
right join catedras as ca on ca.idcatedra=cate.idcatedra
left join usuarios as profesor on cate.idusuario=profesor.idusuario
left join cate_plan as capa on ca.idcatedra=capa.idcatedra
left join plan_estudios as pla on pla.idplan=capa.idplan
left join aulas as au on au.idplan=pla.idplan
left join carreras as car on car.id_carrera=au.id_carrera
where profesor.idusuario='$j'");
        return $query->result();
    }

    public function listar_alumnos_nota($plan, $catedra, $aula) {
        $j = $this->session->userdata('id');
        $query = $this->db->query("select ca.cat_denominacion,alumno.usu_nombre,alumno.idusuario,pla_denominacion,au.aul_denominacion,ca.idcatedra,pla.idplan,au.idaula,alumno.usu_nrocedula from usu_cate as cate
right join catedras as ca on ca.idcatedra=cate.idcatedra
left join usuarios as profesor on cate.idusuario=profesor.idusuario
left join cate_plan as capa on ca.idcatedra=capa.idcatedra
left join plan_estudios as pla on pla.idplan=capa.idplan
left join aulas as au on au.idplan=pla.idplan
left join carreras as car on car.id_carrera=au.id_carrera
left join usu_au as usau on au.idaula=usau.idaula
left join usuarios as alumno on alumno.idusuario=usau.idusuario
where profesor.idusuario='$j' and pla.idplan='$plan' and ca.idcatedra='$catedra' and au.idaula='$aula';");
        return $query->result();
    }

    public function guardar_nota_parcial($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'idplan' => $idplan,
            'parcial' => $logrados,
        );
        return $this->db->insert('notas_examenes', $data);
    }

    public function editar_nota_parcial($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'parcial' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function guardar_nota_recuperatorio($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'idplan' => $idplan,
            'recuperatorio' => $logrados,
        );
        return $this->db->insert('notas_examenes', $data);
    }

    public function editar_nota_recuperatorio($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'recuperatorio' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function guardar_nota_primer_ordinario($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'primer_ordinario' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function guardar_nota_segundo_ordinario($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'segundo_ordinario' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function guardar_nota_complementario($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'idplan' => $idplan,
            'complementario' => $logrados,
        );
        return $this->db->insert('notas_examenes', $data);
    }

    public function editar_nota_complementario($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'complementario' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function guardar_nota_extraordinario($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'idplan' => $idplan,
            'extraordinario' => $logrados,
        );
        return $this->db->insert('notas_examenes', $data);
    }

    public function editar_nota_extraordinario($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'extraordinario' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function guardar_nota_mesa($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'idusuario' => $idusuario,
            'idcatedra' => $idcatedra,
            'idplan' => $idplan,
            'mesa_especial' => $logrados,
        );
        return $this->db->insert('notas_examenes', $data);
    }

    public function editar_nota_mesa($idusuario, $idplan, $idcatedra, $logrados) {
        $data = array(
            'mesa_especial' => $logrados,
        );

        $this->db->where('idusuario', $idusuario);
        $this->db->where('idcatedra', $idcatedra);
        $this->db->where('idplan', $idplan);
        $this->db->update('notas_examenes', $data);
    }

    public function listar_notas_examen($plan, $catedra) {
        $query = $this->db->query("select n.idusuario,usu.usu_nombre,usu.usu_nrocedula,n.idcatedra,n.idplan,n.parcial,n.recuperatorio,n.primer_ordinario,n.segundo_ordinario,n.complementario,n.extraordinario,n.mesa_especial
from notas_examenes as n join usuarios as usu on n.idusuario=usu.idusuario where n.idcatedra='$catedra' and n.idplan='$plan';");
        return $query->result();
    }

}
