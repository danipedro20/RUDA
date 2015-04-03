<?php

class Recuperacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function veryrecuperacion($pregunta, $respuesta) {

        $this->db->where('recupregunta', $pregunta)
                ->where('recurespuesta', $respuesta);
        $query = $this->db->get('recuperacion');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

    function cambiopass($passnuevo,$respuesta) { 
          $this->db->select('idusuario')
                ->where('recurespuesta', $respuesta);
        $query = $this->db->get('recuperacion'); 
        $row = $query->row_array();
        $data = array(
            'usu_password' => $passnuevo,
        );

        $this->db->where('idusuario', $row['idusuario']);
        $this->db->update('usuarios', $data);
    }

    function chequeoemail($email) {

        $this->db->where('usu_email', $email);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {

            return FALSE;
        }
    }
    
    
}
