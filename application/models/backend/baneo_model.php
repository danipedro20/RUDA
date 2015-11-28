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

    public function insbaneo($a, $c) {
        $query = $this->db->query("SELECT * FROM usuarios where usu_email='$a'");
        $row = $query->row();
        $fecha = date("Y-m-d", strtotime($_POST['fecha']));
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));
        $data = array(
            'bamotivo' => $c,
            'bafechainicio' => $fechahoy,
            'bafechafin' => $fecha,
            'idusuario' => $row->idusuario,
            'baestado' => 'activo',
        );
        return $this->db->insert('baneo', $data);
    }

    public function buscador($abuscar) {
        //usamos after para decir que empiece a buscar por
        //el principio de la cadena
        //ej SELECT localidad from localidades_es 
        //WHERE localidad LIKE '%$abuscar' limit 12
        $this->db->select('usu_email');

        $this->db->like('usu_email', $abuscar, 'after');

        $resultados = $this->db->get('usuarios', 12);

        //si existe algún resultado lo devolvemos
        if ($resultados->num_rows() > 0) {

            return $resultados->result();

            //en otro caso devolvemos false
        } else {

            return FALSE;
        }
    }

}
