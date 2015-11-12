<?php

date_default_timezone_set('America/Asuncion');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reporte_tareas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function lista_tareas() {

        $query = $this->db->query("select ta.idtarea,ta.tar_descripcion,ta.tar_fechaasignacion,ta.tar_fechaentrega,ta.tar_puntostarea,ta.tar_nombrearchivo,cate.cat_denominacion,au.aul_denominacion,usu.usu_nombre,  if((`n`.`idtarea` <> 'null'),'Corregido','Sin Corregir') AS estado from tareas as ta 
join catedras as cate on ta.idcatedra=cate.idcatedra 
join aulas as au on ta.idaula=au.idaula
join usu_cate as usca on usca.idcatedra=cate.idcatedra
join usuarios as usu on usu.idusuario=usca.idusuario
left join notas_tarea as n on n.idtarea=ta.idtarea");
        return $query->result();
    }

}
