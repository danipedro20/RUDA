<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insplan_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/plan_model');
        $this->load->library('pdf');
    }

    public function planestudio() {
        $datos['titulo'] = 'Ruda - Crear  Plan de Estudios';
        $datos['contenido'] = 'crear_planestudio_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_plan_estudios() {
        $datos['titulo'] = 'Ruda - Crear  Plan de Estudios';
        $datos['plan'] = $this->plan_model->listar_planes();
        $datos['contenido'] = 'listar_plan_estudios_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editar_plan_estudio($b) {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Editar Plan de Estudios ';
        $datos['plan'] = $this->plan_model->editar_plan($id);
        $datos['id'] = $b;
        $datos['contenido'] = 'editar_plan_estudio_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

//        public function editarplanestudio() {
//        $id = $this->uri->segment(4);
//        $idca = $this->uri->segment(5);
//        $datos['titulo'] = 'Ruda - Editar Plan de Estudios ';
//        $datos['plan'] = $this->plan_model->plan_catedra($id, $idca);
//        $datos['catedra'] = $this->plan_model->lista_catedra();
//        $datos['contenido'] = 'editarplanestudio_view';
//        $this->load->view('plantillas/adplantilla', $datos);
//    }

    public function successplan() {
        $datos['titulo'] = 'Plan de Estudios';
        $datos['contenido'] = 'sucess_plan_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function inserplan() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('pla_denominacion', 'Nombre de Plan', 'trim|required|callback_plan_check');


            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->planestudio();
            } else {
                $a = $this->input->post('pla_denominacion');
                $fecha = date("Y-m-d", strtotime($_POST['fecha']));
                $fecha_fin = date("Y-m-d", strtotime($_POST['fecha_fin']));

                $insert = $this->plan_model->inseplan($a, $fecha, $fecha_fin);
                redirect(base_url('/backend/insplan_control/successplan/'));
            }
        }
    }

    public function editar_planestudio() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('pla_denominacion', 'Nombre de Plan ', 'trim|required|callback_editar_plan_check');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $b = $this->input->post('idplan');

                $this->editar_plan_estudio($b);
            } else {
                $a = $this->input->post('pla_denominacion');
                $fecha = date("Y-m-d", strtotime($_POST['fecha']));
                $fecha_fin = date("Y-m-d", strtotime($_POST['fecha_fin']));
                $b = $this->input->post('idplan');




                $insert = $this->plan_model->editarplanestudio($a, $b, $fecha, $fecha_fin);
                // $insertplan = $this->plan_model->ediplan_catedra($b, $d);
                redirect(base_url('/backend/insplan_control/listar_plan_estudios/'));
            }
        }
    }

//    public function eliminar_planestudio_catedra() {
//        $a = $this->uri->segment(4);
//        $b = $this->uri->segment(5);
//
//
//        $eliminar = $this->plan_model->elimiplan_catedra($a, $b);
//        redirect(base_url('/backend/planestudio_control/success/'));
//    }

    public function eliminar_planestudio() {
        $a = $this->uri->segment(4);
        $eliminar = $this->plan_model->eliminarplan($a);
        redirect(base_url('/backend/insplan_control/listar_plan_estudios/'));
    }

    function plan_check($plan) {

        $this->load->model('plan_model');
        if ($this->plan_model->plan_check($plan)) {
            $this->form_validation->set_message('plan_check', 'El plan de Estudio' . " " . $plan . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function editar_plan_check($plan) {

        $this->load->model('plan_model');
        if ($this->plan_model->editarplan_check($plan)) {
            $this->form_validation->set_message('editar_plan_check', 'El plan de Estudio' . " " . $plan . " " . 'ya se encuentra en la base de datos');
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function reporte_planes() {


        $plan = $this->plan_model->listar_planes();

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
        $this->pdf->SetTitle("Lista de Planes");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetLineWidth(.3);
        $this->pdf->SetDrawColor(15, 0, 0);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetTextColor(0);
        $this->pdf->SetFillColor(200, 200, 200);

        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 7);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */

        $this->pdf->Cell(15, 7, '#', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(100, 7, 'Descripcion', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Fecha Inicio', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Fecha Fin', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($plan as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra
            $fechainicio = $i->pla_fechainicio;
            $fechafin= $i->pla_fechafin; 
            
            $this->pdf->Cell(100, 5, utf8_decode($i->pla_denominacion), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode( date("d-m-Y", strtotime($fechainicio))), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode(date("d-m-Y", strtotime($fechafin) )), 'TBLR', 0, 'C', 0);
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
