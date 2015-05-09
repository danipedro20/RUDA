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

    public function successaula() {
        $datos['titulo'] = 'Aulas';
        $datos['contenido'] = 'lisaulas_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function inseraula() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
           
//si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('aul_denominacion', 'Descripcion del Aula', 'trim|required');
            $this->form_validation->set_rules('aul_plazadisponible', 'Plazas Disponibles', 'trim');
            $this->form_validation->set_rules('aul_plazahabilitada', 'Plazas Habilitadas', 'trim|required');
            $this->form_validation->set_rules('selCarreras', 'Seleccione la Carrera', 'required');
            $this->form_validation->set_rules('idturno', 'Seleccione el Turno', 'required');
            $this->form_validation->set_rules('selplanes', 'Seleccione el Plan de Estudios', 'required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->nueva_aula();
            } else {
                $c = $this->input->post('aul_denominacion');
                $d = $this->input->post('aul_plazadisponible');
                $a = $this->input->post('aul_plazahabilitada');
                $e=$this->input->post('idturno');
                
                $insert = $this->reg_aula_model->insaula($c, $d, $a,$e);
                redirect(base_url('backend/reg_aula/successaula/'));
            }
        }
    }
   

}
