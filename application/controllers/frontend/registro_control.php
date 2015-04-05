<?php
<<<<<<< HEAD
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
=======
<<<<<<< HEAD
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
=======

>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
class Registro_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
        $this->load->model('frontend/registro_model');
    }

    public function registro() {
        $datos['titulo'] = 'Ruda - Registrarse';
        $datos['contenido'] = 'registro_view';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function successusu() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function insertarregi() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('usu_nrocedula', 'Nombre', 'trim|required|callback_cedula_check');
            $this->form_validation->set_rules('usu_direccion', 'Dirección', 'trim|required');
            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'trim|required');
            $this->form_validation->set_rules('usu_email', 'Email', 'trim|required|callback_email_check|valid_email');
            $this->form_validation->set_rules('idturno', 'Turno', 'required');
            $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');
            $this->form_validation->set_rules('pregunta', 'Email', 'trim|required');
            $this->form_validation->set_rules('respuesta', 'Contraseña', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->registro();
            } else {
                $a = $this->input->post('usu_nombre');
                $b = $this->input->post('usu_nrocedula');
                $c = $this->input->post('usu_direccion');
                $d = $this->input->post('usu_telefono');
                $e = $this->input->post('usu_email');
                $f = md5($this->input->post('usu_pass'));
                $k=  $this->input->post('idturno');
                $g = $this->input->post('pregunta');
                $h = md5($this->input->post('respuesta'));
                $insert = $this->registro_model->insregistro($a, $b, $c, $d, $e, $f,$k);
                $insert2 = $this->registro_model->inspregunta($g, $h, $e);
                   redirect(base_url('/frontend/registro_control/successusu/'));
                  
<<<<<<< HEAD
=======
=======

        $this->load->model('registro_model');
    }

    public function registro() {

        $datos['titulo'] = 'Ruda - Registrarse';
        $datos['contenido'] = 'registro_view';
        $datos['mensaje']='';
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function registro_very() {
        if ($this->input->post('submit_registro')) {
            $this->form_validation->set_rules('usunombre', 'Nombre', 'required|trim|callback_very_user');
            $this->form_validation->set_rules('usunrocedula', 'Número de cédula', 'required');
            $this->form_validation->set_rules('usudireccion', 'Dirección', 'required');
            $this->form_validation->set_rules('usutelefono', 'telefono', 'required');
            $this->form_validation->set_rules('usuemail', 'Correo', 'required');
            $this->form_validation->set_rules('usupassword', 'Password', 'required');
            $this->form_validation->set_message('very_user', 'El Usuario con ese  %s ya existe');
            if ($this->form_validation->run() != FALSE) {
                $this->registro_model->add_usuario();
                $datos['titulo'] = 'Ruda - Inicio Sesion';
                $datos['mensaje']='el usuario ha sido insertado correctamente';
                $datos['contenido'] = 'registro_view';
                $this->load->view('plantillas/plantilla', $datos);
            } else {
                $datos['titulo'] = 'Ruda - Inicio Sesion';
                $datos['contenido'] = 'registro_view';
                 $datos['mensaje']='el usuario NO  ha sido insertado correctamente';
                $this->load->view('plantillas/plantilla', $datos);
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
            }
        }
    }

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
    function username_check($nombre) {
        $this->load->model('registro_model');
        if($this->registro_model->username_check($nombre)){
            $this->form_validation->set_message('username_check','El Nombre'." ".$nombre." ".'ya se encuentra en la base de datos');
            return FALSE;
            }else{
                return TRUE;
            }
    }

    function cedula_check($cedula) {
        $this->load->model('registro_model');
        if($this->registro_model->cedula_check($cedula)){
            $this->form_validation->set_message('cedula_check','El Número de Cédula'." ".$cedula." ".'ya se encuentra en la base de datos');
            return FALSE;
            }else{
                return TRUE;
            }
    }

    function email_check($email) {
        $this->load->model('registro_model');
        if($this->registro_model->email_check($email)){
            $this->form_validation->set_message('email_check','El Correo'." ".$email." ".'ya se encuentra en la base de datos');
            return FALSE;
            }else{
                return TRUE;
            }
<<<<<<< HEAD
=======
=======
    public function very_user($user) {
        $variable = $this->registro_model->very_user($user);
        if ($variable == TRUE) {
            return FALSE;
        } else {
            return TRUE;
        }
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
    }

}
