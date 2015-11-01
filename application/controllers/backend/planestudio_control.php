<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Planestudio_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/planestudio_model');
    }

    public function plan() {
        $datos['titulo'] = 'Ruda - Crear Plan de estudios';
        $datos['arrDatoscate'] = $this->planestudio_model->selcatedras();
        $datos['arrDatosplan'] = $this->planestudio_model->selplan();
        $datos['contenido'] = 'plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_catedras_planes() {
        $datos['titulo'] = 'Plan de estudios';
        $datos['arrDatosplaca'] = $this->planestudio_model->selplacate();
        $datos['contenido'] = 'listar_planes_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function plan_estudio() {

        $a = $this->input->post('plan');
        $b = $this->input->post('catedra');
        $this->planestudio_model->inserplan($a, $b);
        redirect(base_url('/backend/planestudio_control/listar_catedras_planes/'));
    }

    public function editar_catedras_planes() {
        $idca = $this->uri->segment(4);
        $idpla = $this->uri->segment(5);
        $datos['titulo'] = 'Ruda - Editar Catedra/Plan';
        $datos['planes'] = $this->planestudio_model->planes();
        $datos['catedra_plan'] = $this->planestudio_model->catedra_plan($idca, $idpla);
        $datos['contenido'] = 'editar_catedra_plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function llenar() {

        if ($this->input->post('plan')) {
            $id = $this->input->post('plan');
            $catedras = $this->planestudio_model->verlascatedras($id);
            foreach ($catedras as $a) {
                ?>
                <option value="<?php echo $a->idcatedra ?>"><?php echo $a->cat_denominacion ?></option>

                <?php
            }
        }
    }

    public function editarcatedraplan() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE



            $a = $this->input->post('selplan');
            $b = $this->input->post('idcatedra');


            $updatecatedras = $this->planestudio_model->editar_catedraplan($a, $b);
            //   $updateusuario = $this->catedras_model->ediusuario($b, $d);
            redirect(base_url('/backend/planestudio_control/listar_catedras_planes/'));
        }
    }
        public function eliminarasignacion() {
        $a = $this->uri->segment(4);
        $b = $this->uri->segment(5);
        $eliminar = $this->planestudio_model->eliminar_asignacion($a, $b);
        redirect(base_url('/backend/planestudio_control/listar_catedras_planes/'));
    }


}
