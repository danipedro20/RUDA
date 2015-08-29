<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Solicitud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertsoli($a, $b, $c, $d, $e, $f, $g, $h, $i, $j) {
        $this->db->where('aul_denominacion', $j);
        $consulta = $this->db->get('aulas');
        $row = $consulta->row();
        $idturno = $row->idturno;

        $this->db->where('idturno', $idturno);
        $consulta = $this->db->get('turnos');
        $row = $consulta->row();
        $turno = $row->tur_denominacion;

        $data = array(
            'sol_nombre' => $a,
            'sol_nrocedula' => $b,
            'sol_direccion' => $c,
            'sol_telefono' => $d,
            'sol_email' => $e,
            'sol_password' => $f,
            'sol_pregunta' => $g,
            'sol_respuesta' => $h,
            'sol_carrera' => $i,
            'sol_aula' => $j,
            'sol_turno' => $turno,
            'sol_visto' => '0',
        );
        return $this->db->insert('solicitud', $data);
    }

    public function verifica_username($username) {
        $this->db->where('usu_nombre', $username);
        $consulta = $this->db->get('usuarios');
        if ($consulta->num_rows() == 1) {
            $row = $consulta->row();
            return $row->username;
        }
    }

    public function verifica_email($email) {
        $this->db->where('usu_email', $email);
        $consulta = $this->db->get('usuarios');
        if ($consulta->num_rows() == 1) {
            $row = $consulta->row();
            return $row->usu_email;
        }
    }

    public function verifica_cedula($cedula) {
        $this->db->where('usu_nrocedula', $cedula);
        $consulta = $this->db->get('usuarios');
        if ($consulta->num_rows() == 1) {
            $row = $consulta->row();
            return $row->usu_nrocedula;
        }
    }

    function verificardatos($id) {

        $this->db->where('idsolicitud', $id)
                ->from('solicitud');
        $query = $this->db->get();
        $query = $query->row();
        echo $query->sol_nombre;
        echo $query->sol_carrera;
        echo $query->sol_turno;
        $this->db->where('usu_nombre', $query->sol_nombre)
                ->from('inscripciones');
        $query4 = $this->db->get();

        if ($query4->num_rows() > 0) {
            $query4 = $query4->row();
            echo $query4->usu_nombre;
            echo $query4->id_carrera;
            echo $query4->idturno;
            if (($query->sol_nombre == $query4->usu_nombre) and ($query->sol_carrera == $query4->id_carrera) and ($query->sol_turno == $query4->idturno)) {
                return 'CORRECTO';
            } elseif (($query->sol_nombre != $query4->usu_nombre) or ($query->sol_carrera != $query4->id_carrera) or ($query->sol_turno != $query4->idturno)) {
                return 'INCORRECTO';
            }
        } else {
            return 'INCORRECTO';
        }
    }

    public function insertarregistro($id) {
        $this->db->where('idsolicitud', $id)
                ->from('solicitud');
        $query = $this->db->get();
        $query = $query->row();
        $data = array(
            'usu_nombre' => $query->sol_nombre,
            'usu_nrocedula' => $query->sol_nrocedula,
            'usu_direccion' => $query->sol_direccion,
            'usu_telefono' => $query->sol_telefono,
            'usu_email' => $query->sol_email,
            'usu_password' => $query->sol_password,
            'idperfil' => '3',
        );
        return $this->db->insert('usuarios', $data);
    }

    public function insertarrecuperacion($id) {
        $this->db->where('idsolicitud', $id)
                ->from('solicitud');
        $query2 = $this->db->get();
        $query2 = $query2->row();



        $this->db->select('idusuario')
                ->where('usu_nombre', $query2->sol_nombre);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $data = array(
            'recupregunta' => $query2->sol_pregunta,
            'recurespuesta' => $query2->sol_respuesta,
            'idusuario' => $row['idusuario']
        );
        return $this->db->insert('recuperacion', $data);
    }

    public function insertaraula($id) {

        $this->db->where('idsolicitud', $id)
                ->from('solicitud');
        $query = $this->db->get();
        $query = $query->row();
        $this->db->select('idusuario')
                ->where('usu_nombre', $query->sol_nombre);
        $query3 = $this->db->get('usuarios');
        $row2 = $query3->row_array();
        $data = array(
            'idusuario' => $row2['idusuario'],
            'idaula' => $query->sol_aula,
        );
        return $this->db->insert('usu_au', $data);
    }

    public function lugaresaulas($id) {

        $this->db->where('idsolicitud', $id)
                ->from('solicitud');
        $query = $this->db->get();
        $query = $query->row();

        $this->db->select('aul_plazasdisponibles')
                ->where('idaula', $query->sol_aula);
        $query2 = $this->db->get('aulas');
        $row = $query2->row_array();
        $lugares = $row['aul_plazasdisponibles'] - 1;
        $data = array(
            'aul_plazasdisponibles' => $lugares,
        );

        $this->db->where('aul_denominacion', $query->sol_aula);
        $this->db->update('aulas', $data);
    }

    public function eliminarsolicitud($id) {

        $this->db->where('idsolicitud', $id);
        $this->db->delete('solicitud');
    }

    public function enviarcorreo($id) {

        $this->db->where('idsolicitud', $id)
                ->from('solicitud');
        $query = $this->db->get();
        $query = $query->row();
        $email = $query->sol_email;

        $this->db->where('usu_nombre', $query->sol_nombre)
                ->where('usu_email', $query->sol_email)
                ->from('usuarios');
        $query2 = $this->db->get();


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


        if ($query2->num_rows() == 1) {

            $this->email->initialize($config);
            $this->email->from('Ruda Gestion de Aulas');
            $this->email->to($email);
            $this->email->subject('Bienvenido/a a RUDA');
            $this->email->message('<h2>' . $query->sol_nombre . ' gracias tu solicitud ha sido recibida</h2><hr><br><br>
				Los datos enviados  corresponden a los datos que tenemos sobre ti podes acceder con tu usuario y contraseña  
                                <a href="' . base_url() . 'frontend/usuarios_control/logueo">aqui</a>');
            $this->email->send();
            var_dump($this->email->print_debugger());
        } else {
            $this->email->initialize($config);
            $this->email->from('Ruda Gestion de Aulas');
            $this->email->to($email);
            $this->email->subject('Bienvenido/a a RUDA');
            $this->email->message('<h2>' . $a . ' gracias tu solicitud ha sido recibida</h2><hr><br><br>
				Los datos enviados no corresponde a los datos que tenemos sonbre ti. Tu solicitud a sido rechazada');
            $this->email->send();
            var_dump($this->email->print_debugger());
        }
    }

//    public function insinscri($a,$k) {
//        $this->db->select('id_carrera')
//                ->where('car_denominacion', $_POST['selCarreras']);
//        $query1 = $this->db->get('carreras');
//        $row = $query1->row_array();
//        $id = $row['id_carrera'];
//        $hoy = date('d-m-Y');
//        $fechahoy = date("Y-m-d", strtotime($hoy));
//        $data = array(
//            'usu_nombre' => $a,
//            'id_carrera' => $id,
//            'ins_fechainscripcion' => $fechahoy,
//             'idturno' => $k,
//           
//        );
//        return $this->db->insert('inscripciones', $data);
//    }
//    public function inspregunta($g, $h, $e) {
//        $this->db->select('idusuario')
//                ->where('usu_email', $e);
//        $query = $this->db->get('usuarios');
//        $row = $query->row_array();
//        $data = array(
//            'recupregunta' => $g,
//            'recurespuesta' => $h,
//            'idusuario' => $row['idusuario']
//        );
//        return $this->db->insert('recuperacion', $data);
//    }
//
    function username_check($nombre) {
        $this->db->where('usu_nombre', $nombre);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

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

//lista las carreras disponibles
    public function listarsolicitud() {

        $query = $this->db->query("select idsolicitud,sol_nombre from solicitud where sol_visto='0';");
        return $query->result();
    }

    public function generatetablesolicitud() {
        return $this->db->query("select so.sol_nombre,ca.car_denominacion, au.aul_denominacion, tu.tur_denominacion from carreras as ca
join solicitud as so on ca.id_carrera=so.sol_carrera join aulas as au on au.idaula=so.sol_aula join turnos as tu
on  tu.idturno=so.sol_turno where so.sol_visto='0';");
    }

}
