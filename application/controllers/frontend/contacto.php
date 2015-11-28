<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacto extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->library("email");
    }

    public function contacto_crear() {



        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('texto', 'Texto', 'xss_clean');

        if ($this->form_validation->run()) {
            //print_r($_POST);	
            
    
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
                $this->email->to('gestion.ruda@gmail.com');
                $this->email->subject('Contacto desde tu Web');
                $this->email->message('<h3> ' . $_POST['nombre'] . ' con Correo' . $_POST['correo'] . '  </h2><hr><br><br>
				Se ha puesto en contacto contigo y te a dicho ' . $_POST['texto'] .'');
                $this->email->send();        
            
            
            
            
            
            

            // echo $this->email->print_debugger();
            //redirect('views/front_end/emailsuccess.php');
            $datos['titulo'] = 'Ruda - Contacto';
            $datos['contenido'] = 'emailsuccess';
            $this->load->view('plantillas/plantilla', $datos);
        } else {
            $datos['titulo'] = 'Ruda - Contacto';
            $datos['contenido'] = 'contacto_view';
            $this->load->view('plantillas/plantilla', $datos);
        }
    }

}

?>