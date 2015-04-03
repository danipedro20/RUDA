<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Repmaterias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function repmate() {
        $b = $this->session->userdata('nombre');
        $catedras = $this->db->query("select catedras.idcatedra,catedras.cat_denominacion,catedras.cat_diascatedra
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
 join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  join usu_au on
usu_au.idaula=au.idaula  join usuarios as alumno on usu_au.idusuario=alumno.idusuario
join usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios as profesor on usu_cate.idusuario=profesor.idusuario
 join catedras as cate on usu_cate.idcatedra=cate.idcatedra
    where alumno.usu_nombre='$b';");
        return $catedras->result();
    }

}
