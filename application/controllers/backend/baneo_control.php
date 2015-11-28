<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Baneo_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/baneo_model');
    }

    public function baneo() {
        $datos['titulo'] = 'Suspención de cuenta';
        $datos['arrDatosusuario'] = $this->baneo_model->selcorreo();
        $datos['contenido'] = 'regbaneo_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successbaneo() {
        $datos['titulo'] = 'Registro Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function inserbaneo() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {

            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('bamotivo', 'Motivo de Suspención', 'trim|required');
            $this->form_validation->set_rules('idusuario', 'Seleccione una Correo', 'trim');
            $this->form_validation->set_rules('fecha', 'Seleccione la Fecha', 'trim|required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->baneo();
            } else {
                $a = $this->input->post('usuario');
                $c = $this->input->post('bamotivo');

               $insert = $this->baneo_model->insbaneo($a, $c);
             redirect(base_url('backend/baneo_control/successbaneo/'));
            }
        }
    }

    public function autocompletar() {
        //si es una petición ajax y existe una variable post
        //llamada info dejamos pasar
        if ($this->input->is_ajax_request() && $this->input->post('info')) {

            $abuscar = $this->security->xss_clean($this->input->post('info'));

            $search = $this->baneo_model->buscador($abuscar);

            //si search es distinto de false significa que hay resultados
            //y los mostramos con un loop foreach
            if ($search !== FALSE) {

                foreach ($search as $fila) {
                    ?>

                    <p><a href=""><?php echo $fila->usu_email ?></a></p>

                    <?php
                }

                //en otro caso decimos que no hay resultados
            } else {
                ?>

                <p><?php echo 'No hay resultados' ?></p>

                <?php
            }
        }
    }

}
