<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function inseplan($a, $fecha, $fecha_fin) {
        $data = array(
            'pla_denominacion' => $a,
            'pla_fechainicio' => $fecha,
            'pla_fechafin' => $fecha_fin,
        );
        return $this->db->insert('plan_estudios', $data);
    }

    public function editarplanestudio($a, $b, $fecha, $fecha_fin) {
        $data = array(
            'pla_denominacion' => $a,
            'pla_fechainicio' => $fecha,
            'pla_fechafin' => $fecha_fin,
        );

        $this->db->where('idplan', $b);
        $this->db->update('plan_estudios', $data);
    }

    public function ediplan_catedra($b, $d) {

        $data = array(
            'idcatedra' => $d,
        );


        $this->db->where('idplan', $b);
        $this->db->update('cate_plan', $data);
    }

    public function elimiplan_catedra($a, $b) {
        $this->db->where('idplan', $a);
        $this->db->where('idcatedra', $b);
        $this->db->delete('cate_plan');
    }

    public function eliminarplan($a) {
        $this->db->where('idplan', $a);
        $this->db->delete('plan_estudios');
        if ($this->db->_error_message()) {
            return $data = 'Atencion!!! Nose puede borrar este Plan';
        }
    }

    function plan_check($plan) {
        $this->db->where('pla_denominacion', $plan);
        $query = $this->db->get('plan_estudios');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    public function editar_plan($id) {
        $consulta = $this->db->query("select *from plan_estudios where idplan='$id';");
        return $consulta->row();
    }

    public function lista_catedra() {
        $consulta = $this->db->query("select * from catedras;");
        return $consulta->result();
    }

    public function listar_planes() {
        $consulta = $this->db->query("select * from plan_estudios;");
        return $consulta->result();
    }

    function editarplan_check($plan) {
        $this->db->select('pla_denominacion')
                ->where('pla_denominacion', $plan);
        $query = $this->db->get('plan_estudios');
        $row = $query->row();
        $ingresado = $row->pla_denominacion;
        if ($query->num_rows() > 0) {
            $consulta = $this->db->query("select * from plan_estudios;");
            $array = $consulta->result();
            foreach ($array as $i) :
                if ($ingresado == $i->pla_denominacion) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            endforeach;
        } else {
            return FALSE;
        }
    }

}
