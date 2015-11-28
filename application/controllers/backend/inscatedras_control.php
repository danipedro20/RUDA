<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inscatedras_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/catedras_model');
        $this->load->library('pdf');
    }

    public function catedra() {
        $datos['titulo'] = 'Ruda - Crear Catedra';
        $datos['contenido'] = 'crear_catedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_catedras_profesores() {
        $datos['titulo'] = 'Ruda - Lista';
        $datos['lista'] = $this->catedras_model->lista();
        $datos['contenido'] = 'listar_catedras_profesor_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_catedras() {
        $datos['titulo'] = 'Ruda - Lista';
        $datos['lista'] = $this->catedras_model->lista_catedras();
        $datos['contenido'] = 'listar_catedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editar_catedra() {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Editar Catedra';
        $datos['catedra'] = $this->catedras_model->catedra($id);
        $datos['contenido'] = 'editar_catedra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editar_catedras_profesores() {
        $idca = $this->uri->segment(4);
        $idusu = $this->uri->segment(5);
        $datos['titulo'] = 'Ruda - Editar Catedra/Profesor';
        $datos['profesores'] = $this->catedras_model->profesores();
        $datos['catedra_profesor'] = $this->catedras_model->catedra_profesor($idca, $idusu);
        $datos['contenido'] = 'editar_catedra_profesor_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function successcatedra() {
        $datos['titulo'] = ' Exitoso';
        $datos['contenido'] = 'successcatedra_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function insercatedra() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
//si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('cat_denominacion', 'Nombre de Catedra', 'trim|required|callback_catedra_check');
//     $this->form_validation->set_rules('cat_diascatedra', 'Dias de catera', 'trim|required');
//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->catedra();
            } else {
                $a = $this->input->post('cat_denominacion');
//      $b = $this->input->post('cat_diascatedra');


                $insert = $this->catedras_model->insecatedra($a);
                if ($_POST['dire'] == base_url('/backend/planestudio_control/plan')) {
                    redirect(base_url('/backend/planestudio_control/plan/'));
                } elseif ($_POST['dire'] == base_url('/backend/asigcatedras_control/asigcatedras')) {
                    redirect(base_url('/backend/asigcatedras_control/asigcatedras/'));
                } elseif ($_POST['dire'] == base_url('/backend/asigcatedras_control/editarcatedras')) {
                    redirect(base_url('/backend/asigcatedras_control/editarcatedras/'));
                } else {
                    redirect(base_url('/backend/inscatedras_control/successcatedra/'));
                }
            }
        }
    }

    public function eliminarasignacion() {
        $a = $this->uri->segment(4);
        $b = $this->uri->segment(5);
        $eliminar = $this->catedras_model->eliminar_asignacion($a, $b);
        redirect(base_url('/backend/inscatedras_control/listar_catedras_profesores/'));
    }

    public function eliminarcatedra() {
        $a = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Lista';
        $datos['error'] = $this->catedras_model->elimicatedra($a);
        $datos['lista'] = $this->catedras_model->lista_catedras();
        $datos['contenido'] = 'listar_catedras_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editarcatedra() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
//si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('cate_denominacion', 'Nombre de Catedra', 'trim|required');
///  $this->form_validation->set_rules('cat_diascatedra', 'Dias de catedra', 'trim|required');
//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->editar_catedra();
            } else {
                $a = $this->input->post('cate_denominacion');
//   $b = $this->input->post('selprofesor');
//  $c = $this->input->post('cat_diascatedra');
                $d = $this->input->post('idcatedra');


                $updatecatedras = $this->catedras_model->edicatedra($a, $d);
//   $updateusuario = $this->catedras_model->ediusuario($b, $d);
                redirect(base_url('/backend/inscatedras_control/listar_catedras/'));
            }
        }
    }

    public function editarcatedraprofesor() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
//si existe el campo oculto llamado grabar creamos las validadciones
//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE



            $b = $this->input->post('selprofesor');
            $d = $this->input->post('idcatedra');


            $updatecatedras = $this->catedras_model->editar_catedraprofesor($b, $d);
//   $updateusuario = $this->catedras_model->ediusuario($b, $d);
            redirect(base_url('/backend/inscatedras_control/listar_catedras_profesores/'));
        }
    }

    function catedra_check($catedra) {
        $this->load->model('catedras_model');
        if ($this->catedras_model->catedra_check($catedra)) {
            $this->form_validation->set_message('catedra_check', 'La catedra' . " " . $catedra . " " . 'ya se encuentra en la base de datos');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function reporte_catedras() {


        $catedras = $this->catedras_model->lista_catedras();

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
        $this->pdf->Cell(100, 6, 'Lista de Catedras', 1, 0, 'C');
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
        $this->pdf->Cell(100, 7, 'Descripcion', 'TBL', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($catedras as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $this->pdf->Cell(100, 5, utf8_decode($i->cat_denominacion), 'TBLR', 0, 'C', 0);

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
        $this->pdf->Output("Lista de Catedras.pdf", 'I');
    }

    public function reporte_catedra_profesor() {


        $catedras = $this->catedras_model->lista();

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
        $this->pdf->Cell(100, 6, 'Lista de Catedras/Pofesores', 1, 0, 'C');
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
        $this->pdf->Cell(80, 7, 'Profesor', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(100, 7, 'Catedra', 'TBL', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($catedras as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $this->pdf->Cell(80, 5, utf8_decode($i->usu_nombre), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(100, 5, utf8_decode($i->cat_denominacion), 'TBLR', 0, 'C', 0);


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
        $this->pdf->Output("Lista de Profesores/Catedras.pdf", 'I');
    }

}
