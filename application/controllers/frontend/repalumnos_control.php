<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Repalumnos_control  extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
         // Se carga el modelo alumno
        $this->load->model('frontend/repalumnos_model');
        // Se carga la libreria fpdf
        $this->load->library('pdf');
    }


    public function reporalumno() {
 
        $alumnos = $this->repalumnos_model->repalum();

        // Creacion del PDF

        /*
         * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
         * heredó todos las variables y métodos de fpdf
         */
        ob_end_clean ();

        $this->pdf = new Pdf();
        // Agregamos una página
        $this->pdf->AddPage();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();

        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
        $this->pdf->SetTitle("Lista de Alunmnos");
        $this->pdf->SetLeftMargin(15);
         $this->pdf->SetLineWidth(.3);
         $this->pdf->SetDrawColor(15,0,0);
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

        $this->pdf->Cell(15, 7, 'NUM', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(50, 7, 'Nombre', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(50, 7, 'Nro de cedula', 'TBLR', 0, 'C', '1');
         $this->pdf->Cell(50, 7, 'Email', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;
        foreach ($alumnos as $alumno) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra
            $this->pdf->Cell(50, 5, $alumno->usu_nombre, 'TBL', 0, 'C', 0);
            $this->pdf->Cell(50, 5, $alumno->usu_nrocedula, 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(50, 5, $alumno->usu_email, 'TBLR', 0, 'C', 0);
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
        $this->pdf->Output("Lista de Alumnos.pdf", 'I');
    }

}
