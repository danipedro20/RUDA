<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//AQUI INICIA EL CONTROLADOR DE LA PAGINA admin
class Adhome extends CI_Controller {

    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
        $this->load->model('backend/adhome_model');
        //llamado al modelo
        //   $this->load->model('/backend/Perfil_model');
    }

    function index2() {


        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'inicioadmin_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }
  public function verperfil() {
        $datos['titulo'] = 'Perfil';
        $datos['contenido'] = 'perfil_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editarperfil() {
        $datos['titulo'] = 'Editar Perfil';
        $datos['contenido'] = 'ediperfil_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }
     public function successedit() {
        $datos['titulo'] = 'Editar';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/adplantilla', $datos);
    }
    public function editar() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('usu_direccion', 'Dirección', 'trim|required');
            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'trim|required');
            $this->form_validation->set_rules('usu_email', 'Email', 'trim|required|valid_email|callback_correo_check');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->editarperfil();
            } else {
                $a = $_POST['usu_nombre'];
                $c = $_POST['usu_direccion'];
                $d = $_POST['usu_telefono'];
                $e = $_POST['usu_email'];
                $editar = $this->adhome_model->editregistro($a, $c, $d, $e);
                $inscreditar = $this->adhome_model->editinscrip($a);
                $this->session->set_userdata('nombre', $_POST['usu_nombre']);
                $this->session->set_userdata('direccion', $_POST['usu_direccion']);
                $this->session->set_userdata('telefono', $_POST['usu_telefono']);
                $this->session->set_userdata('email', $_POST['usu_email']);
                redirect(base_url('/backend/adhome/successedit/'));
            }
        }
    }
     function correo_check($correo) {
        $this->load->model('adhome_model');
        if ($this->adhome_model->correo_check($correo)) {
            $this->form_validation->set_message('correo_check', 'El Correo' . " " . $correo . " " . 'ya esta siendo utilizado');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
