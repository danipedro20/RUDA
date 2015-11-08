<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adhome_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function editregistro($a, $c, $d, $e) {
        $data = array(
            'usu_nombre' => $a,
            'usu_direccion' => $c,
            'usu_telefono' => $d,
            'usu_email' => $e
        );

        $this->db->where('idusuario', $this->session->userdata('id'));
        $this->db->update('usuarios', $data);
    }

    function correo_check($correo) {
        $this->db->select('usu_email')
                ->where('usu_email', $correo);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $ingresado = $row['usu_email'];
        if ($query->num_rows() > 0) {
            $this->db->select('usu_email')
                    ->where('idusuario', $this->session->userdata('id'));
            $query1 = $this->db->get('usuarios');
            $row = $query1->row_array();
            $actual = $row['usu_email'];

            if ($actual == $ingresado) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    public function lista_alumnos() {

        $query = $this->db->query("select usu.idusuario,usu.usu_nombre,car.car_denominacion,au.aul_denominacion from 
usuarios as usu join usu_au as usa on usu.idusuario=usa.idusuario join
aulas as au on usa.idaula=au.idaula join 
carreras as car on au.id_carrera=car.id_carrera where usu.idperfil='3';");
        return $query->result();
    }

    public function datos_alumnos($entry_id) {

        $query = $this->db->query("select usu.idusuario,usu.usu_nombre,car.id_carrera,car.car_denominacion,au.idaula,au.aul_denominacion from 
usuarios as usu join usu_au as usa on usu.idusuario=usa.idusuario join
aulas as au on usa.idaula=au.idaula join 
carreras as car on au.id_carrera=car.id_carrera where usu.idperfil='3' and usu.idusuario='$entry_id';");
        return $query->row();
    }

    public function verlascarreras($idaula) {
        $query2 = $this->db->query("select ca.id_carrera,ca.car_denominacion from carreras as ca join
aulas as au on ca.id_carrera=au.id_carrera where au.idaula='$idaula';");
        return $query2->result();
    }

    public function verlasaulas($entry_id) {
        $query2 = $this->db->query("select au.aul_denominacion,au.idaula,au.aul_denominacion from 
usuarios as usu join usu_au as usa on usu.idusuario=usa.idusuario join
aulas as au on usa.idaula=au.idaula join 
carreras as car on au.id_carrera=car.id_carrera where  usu.idusuario='$entry_id';");
        $row = $query2->row();

        $query = $this->db->query("select idaula,aul_denominacion from aulas where aul_denominacion <> '$row->aul_denominacion'");
        return $query->result();
    }

    public function editarnombre($a, $z) {
        $data = array(
            'usu_nombre' => $a,
        );

        $this->db->where('idusuario', $z);
        $this->db->update('usuarios', $data);
    }

    public function editaraula($b, $z) {
        $data = array(
            'idaula' => $b,
        );

        $this->db->where('idusuario', $z);
        $this->db->update('usu_au', $data);
    }

    public function insert_profesor($a, $b, $c, $d, $e, $f) {

        $data = array(
            'usu_nombre' => $a,
            'usu_nrocedula' => $b,
            'usu_direccion' => $c,
            'usu_telefono' => $d,
            'usu_email' => $e,
            'usu_password' => $f,
            'idperfil' => '2',
        );
        return $this->db->insert('usuarios', $data);
    }

//
//    public function insert_recuperacion($a, $g, $h) {
//
//        $this->db->select('idusuario')
//                ->where('usu_nombre', $a);
//        $query = $this->db->get('usuarios');
//        $row = $query->row_array();
//        $ingresado = $row['idusuario'];
//
//        $data = array(
//            'recupregunta' => $g,
//            'recurespuesta' => $h,
//            'idusuario' => $ingresado,
//        );
//        return $this->db->insert('recuperacion', $data);
//    }

    public function enviar_correo($a, $z, $e, $g) {

        $this->db->select('idusuario')
                ->where('usu_email', $e);
        $query = $this->db->get('usuarios');
        $row = $query->row_array();
        $ingresado = $row['idusuario'];
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
        $this->email->to($e);
        $this->email->subject('Bienvenido/a a RUDA');
        $this->email->message('<h2> Señor  ' . $a . ' su cuenta ha sido creada en el sistema </h2><hr><br><br>
				su contraseña es  ' . $z . ' puede cambiarla una vez que ingrese al Sistema para generar su pregunta de recuperacion  <a href="' . base_url() . 'backend/profesor_control/recuperacion/' . $ingresado . '">Aqui</a>'
                . ' una vez generado puede ingresar al sistema con su usuario  y contraseña  <a href="' . base_url() . 'frontend/usuarios_control/logueo">Aqui</a>');
        $this->email->send();
        var_dump($this->email->print_debugger());
    }

    public function aulas() {

        $query = $this->db->query("select * from aulas ");
        return $query->result();
    }

}
