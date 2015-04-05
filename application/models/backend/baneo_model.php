<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Baneo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function selcorreo() {
        $query = $this->db->query("SELECT idusuario,usu_email FROM usuarios where idperfil='2' or idperfil='3'");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                $arrDatosplan[htmlspecialchars($row->idusuario, ENT_QUOTES)] = htmlspecialchars($row->usu_email, ENT_QUOTES);
            $query->free_result();
            return $arrDatosplan;
        }
    }
  public function insbaneo($c) {
    
           $k=$_POST['selcorreo'];
            $fecha =date("Y-m-d", strtotime($_POST['fecha']));
             $hoy = date('d-m-Y');
            $fechahoy = date("Y-m-d", strtotime($hoy));
            $data = array(
                'bamotivo' => $c,
                'bafechainicio' => $fechahoy,
                'bafechafin' => $fecha,
                'usu_email' => $k,
                'baestado' => 'activo',
                          );
            return $this->db->insert('baneo', $data);
        }
    }

