<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Verificacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function verycontra($email, $pass) {

        $this->db->where('usu_email', $email)
                ->where('usu_password', $pass);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

    function cambio($passnuevo,$email) {
        $data = array(
            'usu_password' => $passnuevo,
        );

        $this->db->where('usu_email', $email);
        $this->db->update('usuarios', $data);
    }

}
