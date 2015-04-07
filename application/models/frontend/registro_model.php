<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Registro_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insregistro($a, $b, $c, $d, $e, $f,$k) {
        $data = array(
            'usu_nombre' => $a,
            'usu_nrocedula' => $b,
            'usu_direccion' => $c,
            'usu_telefono' => $d,
            'usu_email' => $e,
            'usu_password' => $f,
            'idperfil' => '1',
            'idturno' => $k,
        );
        return $this->db->insert('usuarios', $data);
    }

    public function inspregunta($g, $h, $e) {
        $this->db->select('idusuario')
                ->where('usu_email', $e);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $data = array(
            'recupregunta' => $g,
            'recurespuesta' => $h,
            'idusuario' => $row['idusuario']
        );
        return $this->db->insert('recuperacion', $data);
    }

    function username_check($nombre) {
        $this->db->where('usu_nombre', $nombre);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return TRUE;
} }

    function cedula_check($cedula) {
        $this->db->where('usu_nrocedula', $cedula);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return TRUE;
        } 
    }
     function email_check($email) {
        $this->db->where('usu_email', $email);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return TRUE;
        } 
    }

}