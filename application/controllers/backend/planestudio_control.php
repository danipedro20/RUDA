<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Planestudio_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/planestudio_model');
        $this->load->library('pdf');
    }

    public function plan() {
        $datos['titulo'] = 'Ruda - Crear Plan de estudios';
        $datos['arrDatoscate'] = $this->planestudio_model->verlascatedras();

        $datos['contenido'] = 'plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function success_plan() {
        $datos['titulo'] = 'Ruda - Exitoso';
        $datos['contenido'] = 'sucess_plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_catedras_planes() {
        $datos['titulo'] = 'Plan de estudios';
        $datos['arrDatosplaca'] = $this->planestudio_model->selplacate();
        $datos['contenido'] = 'listar_planes_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function plan_estudio() {

        $a = $this->input->post('selplan');
        $b = $this->input->post('catedra');
        $c = $this->input->post('diascatedra');
        $this->planestudio_model->inserplan($a, $b, $c);
        redirect(base_url('/backend/planestudio_control/success_plan/'));
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
            $c = $this->input->post('diascatedra');


            $updatecatedras = $this->planestudio_model->editar_catedraplan($a, $b, $c);
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

    public function reporte_plan_catedra() {


        $plan = $this->planestudio_model->selplacate();

        // Creacion del PDF

        /*
         * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
         * heredó todos las variables y métodos de fpdf
         */
        ob_end_clean();

        $this->pdf = new Pdf();

        // Agregamos una página
        $this->pdf->AddPage();

        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetFont('Arial', 'B', 12);

        $this->pdf->Cell(40, 6, '', 0, 0, 'C');
        $this->pdf->Cell(100, 6, 'Lista de Planes/Catedras', 1, 0, 'C');
        $this->pdf->SetFillColor(200, 200, 200);
        $this->pdf->Ln(10);
        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 7);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */

        $this->pdf->Cell(15, 7, '#', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Plan Estudio', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(90, 7, 'Catedras', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Dias de Catedra', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($plan as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra


            $this->pdf->Cell(60, 5, utf8_decode($i->pla_denominacion), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(90, 5, utf8_decode($i->cat_denominacion), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode($i->diascatedra), 'TBLR', 0, 'C', 0);
            //Se agrega un salto de linea
            $this->pdf->Ln(5);
        }
        /*
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */
        $this->pdf->Output("Lista de Planes.pdf", 'I');
    }

}
