<?php

class Usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function loguin($usuario, $password) {
        $this->db->where('usu_nombre', $usuario)
                ->where('usu_password', $password)
                ->from('usuarios');
        $consulta = $this->db->get();
        if ($consulta->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
