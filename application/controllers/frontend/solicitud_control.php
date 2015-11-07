<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Solicitud_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->library("email");
        $this->load->model('frontend/solicitud_model');
    }

    public function solicitudregistro() {
        $datos['titulo'] = 'Ruda - Registrarse';
        $datos['idaula'] = $this->uri->segment(4);
        $datos['idcarrera'] = $this->uri->segment(5);
        $datos['idplan'] = $this->uri->segment(6);
        $datos['contenido'] = 'solicitud_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

//    public function inscripcion() {
//        $datos['titulo'] = 'Ruda - Inscripcion';
//        $datos['arrDatoscarreras'] = $this->registro_model->selcarreras();
//        $datos['contenido'] = 'inscripcion_view';
//        $this->load->view('plantillas/plantilla', $datos);
//    }
//    public function registrofail() {
//        $datos['titulo'] = 'Ruda - Inscripcion';
//        $datos['contenido'] = 'registrofail_view';
//        $this->load->view('plantillas/plantilla', $datos);
//    }
    public function comprobar_usuario_ajax() {
        $username = $this->input->post('username');
        $comprobar_username = $this->solicitud_model->verifica_username($username);
        if ($comprobar_username == $username) {
            $this->form_validation->set_message('comprobar_usuario_ajax', '%s: ya existe en la base de datos');
            return FALSE;
        } else {
            echo '<div style="display:none">1</div>';
            return TRUE;
        }
    }

    public function comprobar_email_ajax() {
        $email = $this->input->post('email');
        $comprobar_email = $this->solicitud_model->verifica_email($email);
        if ($comprobar_email == $email) {
            $this->form_validation->set_message('comprobar_email_ajax', '%s: ya existe en la base de datos');
            return FALSE;
        } else {
            echo '<div style="display:none">1</div>';
            return TRUE;
        }
    }

    public function comprobar_cedula_ajax() {
        $cedula = $this->input->post('usu_nrocedula');
        $comprobar_cedula = $this->solicitud_model->verifica_cedula($cedula);
        if ($comprobar_cedula == $cedula) {
            $this->form_validation->set_message('comprobar_cedula_ajax', '%s: ya existe en la base de datos');
            return FALSE;
        } else {
            echo '<div style="display:none">1</div>';
            return TRUE;
        }
    }

    public function successusu() {
        $datos['titulo'] = 'solicitud Exitosa';
        $datos['contenido'] = 'solicitudsuccess';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function solicitudaceptada() {
        $datos['titulo'] = 'solicitud Aceptada';
        $datos['contenido'] = 'solverificacionexitosa_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function sinsolicitud() {
        $datos['titulo'] = 'solicitud Exitosa';
        $datos['contenido'] = 'sinsolicitud_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function solicitudrechazada() {
        $datos['titulo'] = 'solicitud Rechazada';
        $datos['contenido'] = 'solverificacionerror_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function insertsolicitud() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('username', 'Nombre', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('usu_nrocedula', 'Nombre', 'trim|required|callback_cedula_check');
            $this->form_validation->set_rules('usu_direccion', 'Dirección', 'trim|required');
            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_check|valid_email');
            $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');
            $this->form_validation->set_rules('pregunta', 'Email', 'trim|required');
            $this->form_validation->set_rules('respuesta', 'Contraseña', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->solicitudregistro();
            } else {
                $a = $this->input->post('username');
                $b = $this->input->post('usu_nrocedula');
                $c = $this->input->post('usu_direccion');
                $d = $this->input->post('usu_telefono');
                $e = $this->input->post('email');
                $f = md5($this->input->post('usu_pass'));
                $g = $this->input->post('pregunta');
                $h = md5($this->input->post('respuesta'));
                $i = $this->input->post('idcarrera');
                $j = $this->input->post('idaula');
                $k = $this->input->post('idplan');

//                $this->db->select('usu_nombre')
//                        ->where('usu_nombre', $a);
//                $query1 = $this->db->get('inscripciones');
//                if ($query1->num_rows() > 0) {
                $insert = $this->solicitud_model->insertsoli($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);


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
                $this->email->message('<h2>' . $a . ' gracias enviar tu solicitud  a RUDA</h2><hr><br><br>
				Tu solicitud a sido recibida por el administrador tendras respuesta en las siguientes 24 u 48 horas');
                $this->email->send();
                var_dump($this->email->print_debugger());
//                    $insert2 = $this->registro_model->inspregunta($g, $h, $e);
                //enviar correo de solicitud
//                    $z = 'Solicitud De Suscripcion al Sistema RUDA';
//                    $n = 'Usted' . " " . $a . " " . 'solicita suscribirse al aula' . " " . $_POST['regisaula'] . " " . ' de la carrera ' . " " . $_POST['regiscarrera'] . " " . 'su pedido fue recibido coorectamente obtedra respuesta dentro de las 24 u 48 horas siguientes';
//
//                    $this->load->library('email');
//                    $this->email->from('gestiondeaularuda@gmail.com', 'Ruda Gestión de Aulas');
//                    $this->email->to("$e");
//                    $this->email->subject("$z");
//                    $this->email->message("$n");
//                    $this->email->send();
                redirect(base_url('/frontend/solicitud_control/successusu/'));

//                } else {
//                    redirect(base_url('/frontend/registro_control/registrofail/'));
            }
        }
    }

//    public function insertarinscri() {
//
//        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
//            //si existe el campo oculto llamado grabar creamos las validadciones
//            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required');
//            $this->form_validation->set_rules('selCarreras', 'Carreras', 'required');
//            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
//            $this->form_validation->set_message('required', 'El %s es requerido');
//
//            if ($this->form_validation->run() == FALSE) {
//                $this->registro();
//            } else {
//                $a = $this->input->post('usu_nombre');
//                $k = $this->input->post('idturno');
//                $insert = $this->registro_model->insinscri($a, $k);
//
//                redirect(base_url('/frontend/registro_control/registro/'));
//            }
//        }
//    }

    function username_check($nombre) {
        $this->load->model('solicitud_model');
        if ($this->solicitud_model->username_check($nombre)) {
            $this->form_validation->set_message('username_check', 'El Nombre' . " " . $nombre . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function cedula_check($cedula) {
        $this->load->model('solicitud_model');
        if ($this->solicitud_model->cedula_check($cedula)) {
            $this->form_validation->set_message('cedula_check', 'El Número de Cédula' . " " . $cedula . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function email_check($email) {
        $this->load->model('solicitud_model');
        if ($this->solicitud_model->email_check($email)) {
            $this->form_validation->set_message('email_check', 'El Correo' . " " . $email . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function versolicitudes() {
        $datos['titulo'] = 'Ruda - Solicitudes';
        $datos['arrDatossolicitudes'] = $this->solicitud_model->listarsolicitud();
        $datos['generatetabla'] = $this->solicitud_model->generatetablesolicitud();
        $datos['contenido'] = 'versolicitudes_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function verificarsolicitud() {
        $id = $this->uri->segment(4);
        $ingreso = $this->solicitud_model->verificardatos($id);
        switch ($ingreso) {
            case 'CORRECTO':
                $registro = $this->solicitud_model->insertarregistro($id);
                $recuperacion = $this->solicitud_model->insertarrecuperacion($id);
                $registroaula = $this->solicitud_model->insertaraula($id);
                $lugaresaula = $this->solicitud_model->lugaresaulas($id);
                $correo = $this->solicitud_model->enviarcorreo($id);
                $eliminar = $this->solicitud_model->eliminarsolicitud($id);


                redirect(base_url('/frontend/solicitud_control/solicitudaceptada/'));
                break;
            case 'INCORRECTO':
                //  echo  $id = $this->uri->segment(4);
                $correo = $this->solicitud_model->enviarcorreo($id);
                $eliminar = $this->solicitud_model->eliminarsolicitud($id);

                redirect(base_url('/frontend/solicitud_control/solicitudrechazada/'));
                break;
        }
    }

}
