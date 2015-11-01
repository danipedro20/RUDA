<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Planestudio_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selplan() {
        $query = $this->db->query('SELECT idplan,pla_denominacion FROM plan_estudios');
        return $query->result();
    }

    public function selcatedras() {
        $query = $this->db->query('SELECT idcatedra,cat_denominacion FROM catedras');
        return $query->result();
    }

    public function inserplan($a, $b) {

        $data = array(
            'idplan' => $a,
            'idcatedra' => $b,
        );
        return $this->db->insert('cate_plan', $data);
    }

    public function selplacate() {
        $consulta = $this->db->query("select plan_estudios.idplan,plan_estudios.pla_denominacion,catedras.idcatedra,catedras.cat_denominacion from cate_plan inner join catedras on
cate_plan.idcatedra=catedras.idcatedra inner join plan_estudios on
cate_plan.idplan=plan_estudios.idplan");
        return $consulta->result();
    }

    public function verlascatedras($id) {
        $query = $this->db->query("select ca.idcatedra,ca.cat_denominacion from cate_plan as cate right join catedras as ca on
ca.idcatedra=cate.idcatedra where cate.idcatedra is null;");

        return $query->result();
    }
      public function planes() {
        $consulta = $this->db->query("select * from plan_estudios;");
        return $consulta->result();
    }

    public function catedra_plan($idca, $idpla) {
        $consulta = $this->db->query("select ca.idcatedra,ca.cat_denominacion,pla.idplan,pla.pla_denominacion from catedras as ca join
cate_plan as capla on  capla.idcatedra=ca.idcatedra join plan_estudios as pla  on capla.idplan=pla.idplan where ca.idcatedra='$idca' and pla.idplan='$idpla'");
        return $consulta->row();
    }
      public function editar_catedraplan($a,$b) {

        $data = array(
            'idplan' => $a,
        );

        $this->db->where('idcatedra', $b);
        $this->db->update('cate_plan', $data);
    }
       public function eliminar_asignacion($a, $b) {
        $this->db->where('idcatedra', $a);
        $this->db->where('idplan', $b);
        $this->db->delete('cate_plan');
    }

}
