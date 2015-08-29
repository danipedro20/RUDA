<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnos_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->model('backend/alumnos_model');
    }

    public function successalumnosplan() {
        $datos['titulo'] = 'Plan de Estudio';
        $datos['contenido'] = 'lisaulasalumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function verperfil() {
        $datos['titulo'] = 'Perfil';
        $datos['contenido'] = 'perfilalum_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function editarperfil() {
        $datos['titulo'] = 'Editar Perfil';
        $datos['contenido'] = 'ediperfil_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successalumnostareas() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatoscate'] = $this->alumnos_model->selcatedras();
        $datos['contenido'] = 'alumtarea_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successalumnoslis() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatostar'] = $this->alumnos_model->seltareas();
        $datos['contenido'] = 'listareasalumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successedit() {
        $datos['titulo'] = 'Tareas';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/alumplantilla', $datos);
    }
    
    public function sintarea() {
        $datos['titulo'] = 'Tareas';
        $datos['contenido'] = 'sintareas_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }
      public function agenda() {
        $datos['titulo'] = 'Agenda';
        $datos['contenido'] = 'agendaalumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }


    public function Descargar_archivo() {
        $this->alumnos_model->descarga();
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
                $editar = $this->alumnos_model->editregistro($a, $c, $d, $e);
                $inscreditar = $this->alumnos_model->editinscrip($a);
                $this->session->set_userdata('nombre', $_POST['usu_nombre']);
                $this->session->set_userdata('direccion', $_POST['usu_direccion']);
                $this->session->set_userdata('telefono', $_POST['usu_telefono']);
                $this->session->set_userdata('email', $_POST['usu_email']);
                redirect(base_url('/backend/alumnos_control/successedit/'));
            }
        }
    }
     function correo_check($correo) {
        $this->load->model('alumnos_model');
        if ($this->alumnos_model->correo_check($correo)) {
            $this->form_validation->set_message('correo_check', 'El Correo' . " " . $correo . " " . 'ya esta siendo utilizado');
            return FALSE;
        } else {
            return TRUE;
        }
    }
     public function comen() {
        $datos['titulo'] = 'Comentarios';
        $datos['comentarios'] = $this->alumnos_model->selta();
        $datos['contenido'] = 'tarea_comen_alum';
        $this->load->view('plantillas/alumplantilla', $datos);
    }
    public function ver_comentarios() {
        $entry_id = $this->uri->segment(4);
        $data['titulo'] = 'Comentarios';
        $data['entry'] = $this->alumnos_model->tareas($entry_id);
        $data['comments'] = $this->alumnos_model->comentarios($entry_id);
        $data['contenido'] = 'comen_alum_view';
        $this->load->view('plantillas/profplantilla', $data);
    }
       public function comentario() {
        $id = $this->input->post('idtarea');
        $au = $this->session->userdata('nombre');
        $come = $this->input->post('comentario');
        $fe = date('Y-m-d H:i:s');
        $insert = $this->alumnos_model->inscomentario($id, $au, $come, $fe);
        redirect(base_url('backend/profesor_control/ver_comentarios/' . $id));
    }

}
