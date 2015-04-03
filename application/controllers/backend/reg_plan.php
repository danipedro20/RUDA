<?php
<<<<<<< HEAD
        if (!defined('BASEPATH'))
    exit('No direct script access allowed');
=======
>>>>>>> 587a410884994d81ace192363fd4848d379c6813

class Reg_plan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/reg_planmodel');
    }

    public function index2() {
        $datos['titulo'] = 'Ruda - Plan';
        $datos['contenido'] = 'reg_planview';
        $this->load->view('plantillas/adplantilla', $datos);
    }
      public function success() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/adplantilla', $datos);
    }  
    
    public function insertarplan() {
        
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('inp_nombreplan','Nombre de Plan','required|alpha');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            
            if ($this->form_validation->run() == FALSE)
        {
            $this->index2();
        }
        else
        {
            $nombreplan = $this->input->post('inp_nombreplan');
            $insert = $this->reg_planmodel->insplanmodel($nombreplan);
                        
            $this->success();
        }
//        if ($this->session->flashdata('Mensaje de Exito')):
//                $this->session->flashdata('Todo Fue Exitoso');
//                endif;
            //SI ALGO NO HA IDO BIEN NOS DEVOLVERÁ AL INDEX MOSTRANDO LOS ERRORES
//            if ($this->form_validation->run() == FALSE) {
//                $this->load->controller('backend/reg_plan');
//            } else {
//                //EN CASO CONTRARIO PROCESAMOS LOS DATOS
//                $nombreplan = $this->input->post('inp_nombreplan');
//                //ENVÍAMOS LOS DATOS AL MODELO CON LA SIGUIENTE LÍNEA
//                $insert = $this->reg_planmodel->insplanmodel($nombreplan);
//            }
        }
    }

    

}
