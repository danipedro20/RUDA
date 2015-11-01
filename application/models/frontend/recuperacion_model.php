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

    function cambiopass($passnuevo, $respuesta) {
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

    function actualizarpass($a, $b) {
        $this->db->select('idusuario')
                ->where('token', $a);
        $query = $this->db->get('reset');
        $row = $query->row_array();



        $data = array(
            'usu_password' => $b,
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

    function correo_check($a) {
        $this->db->where('usu_email', $a);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() == 0) {
            return TRUE;
        }
    }

    public function datos($a) {
        $consulta = $this->db->query("select * from usuarios where usu_email='$a';");
        return $consulta->row();
    }

    public function verificartoken($id) {
        $consulta = $this->db->query("select * from reset where token='$id';");
        if ($consulta->num_rows() == 0) {
            return 'NO EXISTE';
        } elseif ($consulta->num_rows() == 1) {
            $consulta = $consulta->row();
            $hoy = date('d-m-Y');
            if (date('Y-m-d') <= $consulta->fecha) {
                return 'OK';
            } else {
                $this->db->where('token', $id);
                $this->db->delete('reset');
                return 'CADUCADO';
            }
        }
    }

    public function enviarcorreo($token, $a) {
        //configuracion para gmail
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'gestion.ruda@gmail.com',
            'smtp_pass' => 'gestionruda',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('Ruda Gestion de Aulas');
        $this->email->to($a);
        $this->email->subject('Bienvenido/a a RUDA');
        $this->email->message('<h2>Se registro un pedido de recuperacion de contraseña si fue usted favor acceda a ' . anchor(base_url() . 'frontend/recuperacion_control/correopass/' . $token, 'Aqui') . '<br><br> Si No ignore este correo');
        $this->email->send();
        var_dump($this->email->print_debugger());
    }

    public function resetpass($b, $token) {
        $data = array(
            'idusuario' => $b,
            'token' => $token,
            'fecha' => date('y-m-d'),
        );
        return $this->db->insert('reset', $data);
    }

    public function borrartoken($a) {
        $this->db->where('token', $a);
        $this->db->delete('reset');
    }
    public function pregunta($id){
         $this->db->where('usu_email', $id)
                ->from('usuarios');
        $query = $this->db->get();
        $query = $query->row();
        
        
        
		$this->db->where('idusuario',$query->idusuario);
		$pregunta = $this->db->get('recuperacion');
		if($pregunta->num_rows()>0)
		{
			return $pregunta->result();
		}
	}

}
