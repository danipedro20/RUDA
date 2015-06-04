<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asigcatedras_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/asigcatedras_model');
    }

    public function Asigcatedras() {
        $datos['titulo'] = 'Ruda - Asignar catedras a profesores';
        $datos['arrDatoscatedra'] = $this->asigcatedras_model->selcate();
        $datos['arrDatosprofe'] = $this->asigcatedras_model->selprofe();
        $datos['contenido'] = 'asigcatedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }


    public function editarcatedras() {
        $datos['titulo'] = 'Ruda - Editar Asignación de catedras a profesores';
        $datos['arrDatoscatedra'] = $this->asigcatedras_model->selcate();
        $datos['arrDatosprofe'] = $this->asigcatedras_model->selprofe();
        $datos['contenido'] = 'editarcatedraasig_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }
    public function eliminarcatedras() {
        $datos['titulo'] = 'Ruda - Eliminar Asignación de catedras a profesores';
        $datos['arrDatoscatedra'] = $this->asigcatedras_model->selcate();
        $datos['arrDatosprofe'] = $this->asigcatedras_model->selprofe();
        $datos['contenido'] = 'eliminarcatedraasig_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }


    public function successasignacion() {
        $datos['titulo'] = 'Plan de estudios';
        $datos['contenido'] = 'successasigcatedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function asignacion() {
        $this->asigcatedras_model->inserasignacion();
        redirect(base_url('/backend/asigcatedras_control/successasignacion/'));
    }

    public function editar_asigcatedra() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('cat_denominacion_nueva', 'Nombre de Catedra', 'trim|required|callback_catedraeditar_check');
            $this->form_validation->set_rules('cat_denominacion_vieja', 'Nombre', 'trim|required|callback_catedraedi_check');
            $this->form_validation->set_rules('SELprofe', 'Nombre de profesor', 'trim|required');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->editarcatedras();
            } else {
                $a=$_POST['SELprofe'];
                $b=$_POST['cat_denominacion_vieja'];
                $c=$_POST['cat_denominacion_nueva'];
                $insert = $this->asigcatedras_model->ediasigcatedra($a,$b,$c);
                 redirect(base_url('/backend/asigcatedras_control/successasignacion/'));
            }
        }
    }
    public function eliminar_catedras() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
             $this->form_validation->set_rules('cat_denominacion', 'Nombre de Catedra', 'trim|required|callback_catedraeli_check');
            $this->form_validation->set_rules('SELprofe', 'Nombre de profesor', 'trim|required');


            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->eliminarcatedras();
            } else {
                $a=$_POST['SELprofe'];
                $b=$_POST['cat_denominacion'];


                $insert = $this->asigcatedras_model->elimiasigcatedra($a,$b);
                redirect(base_url('/backend/asigcatedras_control/successasignacion/'));
            }
        }
    }

    function catedraedi_check($catedra) {
        $this->load->model('asigcatedras_model');
        if ($this->asigcatedras_model->catedraedi_check($catedra)) {
            $this->form_validation->set_message('catedraedi_check', 'La catedra' . " " . $catedra . " " . 'con el Profesor' . " " . $_POST['SELprofe'] . " " . 'no se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function catedraeditar_check($catedra) {
        $this->load->model('asigcatedras_model');
        if ($this->asigcatedras_model->catedraeditar_check($catedra)) {
            $this->form_validation->set_message('catedraeditar_check', 'La catedra' . " " . $catedra . " " . 'con el Profesor' . " " . $_POST['SELprofe'] . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function catedraeli_check($catedra) {
        $this->load->model('asigcatedras_model');
        if ($this->asigcatedras_model->catedraeli_check($catedra)) {
            $this->form_validation->set_message('catedraeli_check', 'La catedra' . " " . $catedra . " " . 'con el Profesor' . " " . $_POST['SELprofe'] . " " . 'no se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
