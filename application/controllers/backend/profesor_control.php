<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profesor_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
    $this->load->model('backend/profesor_model');
      $this->load->library('table');
    }
       

    public function creartareas() {
        $datos['titulo'] = 'Ruda - Crear Tarea';
        $datos['arrDatos'] = $this->profesor_model->vercatedras();
        $datos['contenido'] = 'tareas_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }
       public function listaralumnos() {
        $datos['titulo'] = 'Ruda - Seleccione Catedra';
        $datos['arrDatosc'] = $this->profesor_model->vercatedras();
        $datos['contenido'] = 'profesorcatedras_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }
     public function lista() {
        $datos['titulo'] = 'Ruda - Seleccione Catedra';
        $datos['contenido'] = 'listaalumnos_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function successtarea() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function insertarea() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'pdf|jpg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $datos['error'] = $this->upload->display_errors();
                $datos['arrDatos'] = $this->profesor_model->vercatedras();
                $datos['contenido'] = 'tareas_view';
                $this->load->view('plantillas/profplantilla', $datos);
            } else {

                //si existe el campo oculto llamado grabar creamos las validadciones
                $this->form_validation->set_rules('tar_descripcion', 'Descripcion de la tarea', 'trim|required');
                $this->form_validation->set_rules('selCatedras', 'Seleccione una Catedra', 'trim');
                $this->form_validation->set_rules('fecha', 'Seleccione la Fecha', 'trim|required');
                $this->form_validation->set_rules('tar_puntostarea', 'Asigne los puntos ala tarea', 'required');
                //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
                $this->form_validation->set_message('required', 'El %s es requerido');
                if ($this->form_validation->run() == FALSE) {
                    $this->creartareas();
                } else {
                    $succ = $this->upload->data();
                    $z = $succ['file_name'];
                    $a = $succ['full_path'];
                    $c = $this->input->post('tar_puntostarea');
                    $d = $this->input->post('tar_descripcion');
                    $insert = $this->profesor_model->instareas($c, $d, $a, $z);
                    redirect(base_url('backend/profesor_control/successtarea/'));
                }
            }
        }
    }
      public function liscatedras() {
        $datos['titulo'] = 'Lista de catedras';
        $datos['contenido'] = 'liscatedras_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }


}