<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function login($usr, $pass) {

        $this->db->where('usu_email', $usr)
                ->where('usu_password', $pass)
                ->from('usuarios');
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            $query = $query->row();
            $this->session->set_userdata('nombre', $query->usu_nombre);
            $this->session->set_userdata('id', $query->idusuario);
            $this->session->set_userdata('perfil', $query->idperfil);

            if ($query->idperfil == 1) {
                return 'ADMIN';
            } elseif ($query->idperfil == 2) {
                return 'PROFE';
            } elseif ($query->idperfil == 3) {

                return 'ALUMNO';
            }
        } else {

            return FALSE;
        }
    }

    function verybaneo($email) {
        $this->db->where('usu_email', $email)
                ->from('baneo');
        $query = $this->db->get();
        $query = $query->row();
        $this->session->set_userdata('motivo', $query->bamotivo);
        $this->session->set_userdata('fechai', $query->bafechainicio);
        $this->session->set_userdata('fechaf', $query->bafechafin);


        $this->db->select('bafechafin')
                ->where('usu_email', $email)
                ->where('baestado', 'activo');
        $query = $this->db->get('baneo');

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $hoy = date('d-m-Y');
            $fecha = date("Y-m-d", strtotime($hoy));
            if ($row['bafechafin'] <= $fecha) {
                $data = array(
                    'baestado' => 'desactivado',
                );

                $this->db->where('usu_email', $email);
                $this->db->update('baneo', $data);
                return TRUE;
            }

            return FALSE;
        } else {

            return TRUE
            ;
        }
    }

}
