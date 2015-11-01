<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('assets/uploads/Desert.jpg',10,8,22);
            $this->SetFont('Arial','B',20);
            $this->Cell(30);
            $this->Cell(120,10,'RUDA',0,0,'C');
            $this->Ln('7');
            $this->SetFont('Arial','B',15);
            $this->Cell(30);
            $this->Cell(120,10,'Sistema de Gestion de Aula',0,0,'C');
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>;