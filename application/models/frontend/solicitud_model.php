<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Solicitud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertsoli($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k) {
        $this->db->where('idaula', $j);
        $consulta = $this->db->get('aulas');
        $row = $consulta->row();
        $idturno = $row->idturno;
      $query = $this->db->query("CALL insertar_solicitudes('$a','$b','$c','$d','$e','$f','$g','$h',0,'$idturno','$j','$k','$i');");
        return $query->result();
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

        $this->db->where('idinscripcion', $id)
                ->from('inscripcion');
        $query = $this->db->get();
        $query = $query->row();
        echo $query->idaula;
        echo $query->idplan;


        $this->db->where('idaula', $query->idaula)
                ->where('idplan', $query->idplan)
                ->where('id_carrera', $query->id_carrera)
                ->where('idturno', $query->ins_turno)
                ->from('aulas');
        $query4 = $this->db->get();

        if ($query4->num_rows() > 0) {

            return 'CORRECTO';
        } else {
            return 'INCORRECTO';
        }
    }

    public function insertarregistro($id) {
        $this->db->where('idinscripcion', $id)
                ->from('inscripcion');
        $query = $this->db->get();
        $query = $query->row();
        $insert = $this->db->query("CALL insertar_usuarios('$query->ins_nombre','$query->ins_nrocedula','$query->ins_direccion','$query->ins_telefono','$query->ins_email','$query->ins_password',3);");
        return $insert->result();
    }

    public function insertarrecuperacion($id) {
        $this->db->where('idinscripcion', $id)
                ->from('inscripcion');
        $query2 = $this->db->get();
        $query2 = $query2->row();



        $this->db->select('idusuario')
                ->where('usu_nombre', $query2->ins_nombre);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $data = array(
            'recupregunta' => $query2->ins_pregunta,
            'recurespuesta' => $query2->ins_respuesta,
            'idusuario' => $row['idusuario']
        );
        return $this->db->insert('recuperacion', $data);
    }

    public function insertaraula($id) {

        $this->db->where('idinscripcion', $id)
                ->from('inscripcion');
        $query = $this->db->get();
        $query = $query->row();
        $this->db->select('idusuario')
                ->where('usu_nombre', $query->ins_nombre);
        $query3 = $this->db->get('usuarios');
        $row2 = $query3->row_array();
        $data = array(
            'idusuario' => $row2['idusuario'],
            'idaula' => $query->idaula,
        );
        return $this->db->insert('usu_au', $data);
    }

    public function lugaresaulas($id) {

        $this->db->where('idinscripcion', $id)
                ->from('inscripcion');
        $query = $this->db->get();
        $query = $query->row();

        $this->db->select('aul_plazasdisponibles')
                ->where('idaula', $query->idaula);
        $query2 = $this->db->get('aulas');
        $row = $query2->row_array();
        $lugares = $row['aul_plazasdisponibles'] - 1;
        $data = array(
            'aul_plazasdisponibles' => $lugares,
        );

        $this->db->where('idaula', $query->idaula);
        $this->db->update('aulas', $data);
    }

    public function eliminarsolicitud($id) {

        $this->db->where('idinscripcion', $id);
        $this->db->delete('inscripcion');
    }

    public function enviarcorreo($id) {

        $this->db->where('idinscripcion', $id)
                ->from('inscripcion');
        $query = $this->db->get();
        $query = $query->row();
        $email = $query->ins_email;

        $this->db->where('usu_nombre', $query->ins_nombre)
                ->where('usu_email', $query->ins_email)
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
            $this->email->message('<h2>' . $a . ' gracias tu solicitud ha sido recibida</h2><hr><br><br>
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

        $query = $this->db->query("select idinscripcion,ins_nombre from inscripcion where ins_visto='0';");
        return $query->result();
    }

    public function generatetablesolicitud() {
        $query = $this->db->query("select so.idinscripcion,so.ins_nombre,ca.car_denominacion, au.aul_denominacion, so.ins_turno from carreras as ca
join inscripcion as so on ca.id_carrera=so.id_carrera join aulas as au on au.idaula=so.idaula where so.ins_visto='0';");
        return $query->result();
    }

}
