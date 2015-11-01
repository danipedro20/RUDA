<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Baneo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selcorreo() {
        $query = $this->db->query("SELECT idusuario,usu_email FROM usuarios where idperfil='2' or idperfil='3'");
        return $query->result();
    }

    public function insbaneo($a,$c) {

        $fecha = date("Y-m-d", strtotime($_POST['fecha']));
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));
        $data = array(
            'bamotivo' => $c,
            'bafechainicio' => $fechahoy,
            'bafechafin' => $fecha,
            'idusuario' => $a,
            'baestado' => 'activo',
        );
        return $this->db->insert('baneo', $data);
    }

}
