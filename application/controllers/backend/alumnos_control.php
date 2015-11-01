<?php

header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnos_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->model('backend/alumnos_model');
    }

    public function listar_plan_por_alumno() {
        $datos['titulo'] = 'Plan de Estudio';
         $datos['plan'] = $this->alumnos_model->lista_planes_alumnos();
        $datos['contenido'] = 'lista_planes_por_alumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function verperfil() {
        $datos['titulo'] = 'Perfil';
        $datos['contenido'] = 'ver_perfil_alumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function editarperfil() {
        $datos['titulo'] = 'Editar Perfil';
        $datos['contenido'] = 'editar_perfil_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successalumnostareas() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatoscate'] = $this->alumnos_model->selcatedras();
        $datos['contenido'] = 'listar_tareas_alumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successalumnoslis() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatostar'] = $this->alumnos_model->seltareas();
        $datos['contenido'] = 'mostrar_tareas_alumnos_view';
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
        $entry_id = $this->uri->segment(4);
        $this->alumnos_model->descarga($entry_id);
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
                $a = $this->input->post('usu_nombre');
                $c = $this->input->post('usu_direccion');
                $d = $this->input->post('usu_telefono');
                $e = $this->input->post('usu_email');
                $editar = $this->alumnos_model->editregistro($a, $c, $d, $e);
                $this->session->set_userdata('nombre', $_POST['usu_nombre']);
                $this->session->set_userdata('direccion', $_POST['usu_direccion']);
                $this->session->set_userdata('telefono', $_POST['usu_telefono']);
                $this->session->set_userdata('email', $_POST['usu_email']);
                redirect(base_url('/backend/alumnos_control/verperfil/'));
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

    public function ver_comentarios() {
        $entry_id = $this->uri->segment(4);
        $data['titulo'] = 'Comentarios';
        $data['entry'] = $this->alumnos_model->tareas($entry_id);
        $data['comments'] = $this->alumnos_model->comentarios($entry_id);
        $data['contenido'] = 'comen_alum_view';
        $this->load->view('plantillas/alumplantilla', $data);
    }

    public function comentario() {
        if (empty($_FILES['userfile']['tmp_name'])) {
            $id = $this->input->post('idtarea');
            $au = $this->session->userdata('nombre');
            $come = $this->input->post('comentario');
            $fe = date('Y-m-d H:i:s');
            $ruta = 'NULL';
            $nombre = 'NULL';
            $insert = $this->alumnos_model->inscomentario($id, $au, $come, $fe, $ruta, $nombre);
            redirect(base_url('backend/alumnos_control/ver_comentarios/' . $id));
        } else {

            $config['upload_path'] = './assets/uploads/comentarios/';
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $datos['error'] = $this->upload->display_errors();
                $entry_id = $this->uri->segment(4);
                $data['titulo'] = 'Comentarios';
                $data['entry'] = $this->alumnos_model->tareas($entry_id);
                $data['comments'] = $this->alumnos_model->comentarios($entry_id);
                $data['contenido'] = 'comen_alum_view';
                $this->load->view('plantillas/alumplantilla', $data);
            } else {
                $succ = $this->upload->data();
                $nombre = $succ['file_name'];
                $ruta = $succ['full_path'];
                $id = $this->input->post('idtarea');
                $au = $this->session->userdata('nombre');
                $come = $this->input->post('comentario');
                $fe = date('Y-m-d H:i:s');
                $insert = $this->alumnos_model->inscomentario($id, $au, $come, $fe, $ruta, $nombre);
                redirect(base_url('backend/alumnos_control/ver_comentarios/' . $id));
            }
        }
    }

    public function eliminarcomentario() {
        $a = $this->uri->segment(4);
        $idtarea = $this->alumnos_model->obtener_id($a);
        $eliminar = $this->alumnos_model->eliminar_comentario($a);
        redirect(base_url('backend/alumnos_control/ver_comentarios/' . $idtarea->idtarea));
    }

    public function descargar() {
        $entry_id = $this->uri->segment(4);
        $this->alumnos_model->descargaadjunto($entry_id);
    }

}
