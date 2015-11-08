<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carreras_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/carreras_model');
           $this->load->library('pdf');
    }

    public function vercarreras() {
        $datos['titulo'] = 'Ruda - Ver Carreras';
        $datos['lista'] = $this->carreras_model->lista();
        $datos['contenido'] = 'listar_carreras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function carreras() {
        $datos['titulo'] = 'Ruda - Crear Carreras';
        $datos['contenido'] = 'carreras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editarcarreras() {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Crear Carreras';
        $datos['carrera'] = $this->carreras_model->carrera($id);
        $datos['contenido'] = 'editarcarrera_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successcarreras() {
        $datos['titulo'] = 'Ruda-Carreras';
        $datos['contenido'] = 'successcarreras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function insercarreras() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('car_denominacion', 'Nombre de la Carrera', 'trim|required|callback_carreras_check');


            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->carreras();
            } else {
                $a = $this->input->post('car_denominacion');
                $insert = $this->carreras_model->insecarreras($a);
                if ($_POST['dircarr'] == base_url('/backend/reg_aula/nueva_aula')) {
                    redirect(base_url('/backend/reg_aula/nueva_aula/'));
                } else {

                    redirect(base_url('/backend/carreras_control/successcarreras/'));
                }
            }
        }
    }

    public function editar_carrera() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('car_denominacion', 'Nombre de Carrera', 'trim|required|callback_carreraedi_check');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->editarcarreras();
            } else {
                $a = $this->input->post('car_denominacion');
                $b = $this->input->post('id_carrera');



                $insert = $this->carreras_model->edicarrera($a, $b);
                redirect(base_url('/backend/carreras_control/vercarreras/'));
            }
        }
    }

    public function eliminar_carrera() {


        $id = $this->uri->segment(4);


        $insert = $this->carreras_model->elimicarrera($id);
        redirect(base_url('/backend/carreras_control/vercarreras/'));
    }

    function carreras_check($carrera) {
        $this->load->model('carreras_model');
        if ($this->carreras_model->carreras_check($carrera)) {
            $this->form_validation->set_message('carreras_check', 'La Carrera' . " " . $carrera . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }
      public function reporte_carreras() {


        $plan = $this->carreras_model->lista();

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
        $this->pdf->SetTitle("Lista de Carreras");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetLineWidth(.3);
        $this->pdf->SetDrawColor(15, 0, 0);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetFillColor(200, 200, 200);

        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 12);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */

        $this->pdf->Cell(15, 7, '#', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Carreras', 'TBL', 0, 'C', '1');
       
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($plan as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBLR', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra
           

            $this->pdf->Cell(60, 5, utf8_decode($i->car_denominacion), 'TBLR', 0, 'C', 0);
           
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
        $this->pdf->Output("Lista de Carreras.pdf", 'I');
    }

}
