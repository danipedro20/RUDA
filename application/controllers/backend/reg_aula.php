<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_aula extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/reg_aula_model');
        // Se carga la libreria fpdf
        $this->load->library('pdf');
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

                $insert = $this->reg_aula_model->insaula($a, $b, $c, $d, $e);
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

    public function reporte_aulas() {


        $aulas = $this->reg_aula_model->lista();

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
        $this->pdf->Cell(100, 6, 'Lista de Aulas', 1, 0, 'C');
        $this->pdf->SetFillColor(200, 200, 200);
        $this->pdf->Ln(10);

//        $this->pdf->SetTitle("Lista de Aulas");
//        $this->pdf->SetLeftMargin(15);
//        $this->pdf->SetLineWidth(.3);
//        $this->pdf->SetDrawColor(15, 0, 0);
//        $this->pdf->SetRightMargin(15);
//        $this->pdf->SetTextColor(0);
//        $this->pdf->SetFillColor(200, 200, 200);

        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 7);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */
$des='Descripción';
        $this->pdf->Cell(15, 7, '#', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(30, 7,utf8_decode($des), 'TBL', 0, 'C', '1');
        $this->pdf->Cell(40, 7, 'Carrera', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Plan de Estudio', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Turno', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($aulas as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra
            $this->pdf->Cell(30, 5, utf8_decode($i->aul_denominacion), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(40, 5, utf8_decode($i->car_denominacion), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(60, 5, utf8_decode($i->pla_denominacion), 'TBLR', 0, 'C', 0);
            if ($i->idturno == 'M') {
                $ma='Mañana';
                $this->pdf->Cell(30, 5,utf8_decode($ma), 'TBLR', 0, 'C', 0);
            } elseif ($i->idturno == 'T') {
                $this->pdf->Cell(30, 5, 'Tarde', 'TBLR', 0, 'C', 0);
            } elseif ($i->idturno == 'N') {
                $this->pdf->Cell(30, 5, 'Noche', 'TBLR', 0, 'C', 0);
            }

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
        $this->pdf->Output("Lista de Aulas.pdf", 'I');
    }

}
