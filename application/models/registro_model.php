<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Registro_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function very_user($user) {
        $consulta = $this->db->get_where('usuarios', array('usu_nombre' => $user));
        if ($consulta->num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_usuario() {
        $this->db->insert('usuarios', ARRAY
            ('usu_nombre' => $this->input->post('usunombre', TRUE),
              'usu_nrocedula' => $this->input->post('usunrocedula', TRUE),
             'usu_direccion' => $this->input->post('usudireccion', TRUE),
             'usu_telefono' => $this->input->post('usutelefono', TRUE),
             'usu_email' => $this->input->post('usuemail', TRUE),
             'idperfil' => '1',
             'idturno' => '1',
             'usu_password' => $this->input->post('usupassword', TRUE),
        ));
    }

}
