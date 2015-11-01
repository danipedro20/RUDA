<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_aula extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/reg_aula_model');
    }

    function nueva_aula() {
        $datos['titulo'] = 'Ruda - Aulas';
        $datos['arrDatosplanes'] = $this->reg_aula_model->selplanes();
        $datos['arrDatoscarreras'] = $this->reg_aula_model->selcarreras();
        $datos['contenido'] = 'reg_aulaview';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    function editaraula() {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Aulas';
        $datos['aulas'] = $this->reg_aula_model->aula($id);
        $datos['arrDatosplanes'] = $this->reg_aula_model->selplanes();
        $datos['arrDatoscarreras'] = $this->reg_aula_model->selcarreras();
        $datos['contenido'] = 'editaraula_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successaula() {
        $datos['titulo'] = 'Aulas';
        $datos['contenido'] = 'success_aula_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_aulas() {
        $datos['titulo'] = 'Aulas';
        $datos['lista'] = $this->reg_aula_model->lista();
        $datos['contenido'] = 'listar_aulas_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function inseraula() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {

//si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('aul_denominacion', 'Descripcion del Aula', 'trim|required');
            $this->form_validation->set_rules('aul_plazahabilitada', 'Plazas Habilitadas', 'trim|required');
            $this->form_validation->set_rules('selcarrera', 'Seleccione la Carrera', 'required');
            $this->form_validation->set_rules('idturno', 'Seleccione el Turno', 'required');
            $this->form_validation->set_rules('selplan', 'Seleccione el Plan de Estudios', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->nueva_aula();
            } else {
                $a = $this->input->post('aul_denominacion');
                $b = $this->input->post('aul_plazahabilitada');
                $c = $this->input->post('idturno');
                $d = $this->input->post('selplan');
                $e = $this->input->post('selcarrera');

                $insert = $this->reg_aula_model->insaula($a, $b, $c, $d,$e);
                redirect(base_url('backend/reg_aula/listar_aulas/'));
            }
        }
    }

    public function editar_aula() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {

//si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('aul_denominacion', 'Descripcion del Aula', 'trim|required');
            $this->form_validation->set_rules('aul_plazashabilitadas', 'Plazas Habilitadas', 'trim|required');
            $this->form_validation->set_rules('selcarrera', 'Seleccione la Carrera', 'required');
            $this->form_validation->set_rules('idturno', 'Seleccione el Turno', 'required');
            $this->form_validation->set_rules('selplan', 'Seleccione el Plan de Estudios', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->editaraula();
            } else {
                $a = $this->input->post('aul_denominacion');
                $b = $this->input->post('selcarrera');
                $c = $this->input->post('selplan');
                $d = $this->input->post('aul_plazashabilitadas');
                $e = $this->input->post('idturno');
                $f = $this->input->post('idaula');
                $g = $this->input->post('aul_plazasdisponibles');


                $insert = $this->reg_aula_model->ediaula($a, $b, $c, $d, $e, $f, $g);
                redirect(base_url('backend/reg_aula/listar_aulas/'));
            }
        }
    }

    public function eliminar_aula() {
        $a = $this->uri->segment(4);
        $eliminar = $this->reg_aula_model->elimiaula($a);
        redirect(base_url('backend/reg_aula/listar_aulas/'));
    }

}
