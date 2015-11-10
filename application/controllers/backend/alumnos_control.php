<?php

header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnos_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('table');
        $this->load->model('backend/alumnos_model');
        $this->load->library('pdf');
    }

    public function listar_plan_por_alumno() {
        $datos['titulo'] = 'Plan de Estudio';
        $datos['plan'] = $this->alumnos_model->lista_planes_alumnos();
        $datos['contenido'] = 'lista_planes_por_alumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function verperfil() {
        $datos['titulo'] = 'Perfil';
        $datos['contenido'] = 'ver_perfil_alumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function editarperfil() {
        $datos['titulo'] = 'Editar Perfil';
        $datos['contenido'] = 'editar_perfil_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successalumnostareas() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatoscate'] = $this->alumnos_model->selcatedras();
        $datos['contenido'] = 'listar_tareas_alumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successalumnoslis() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatostar'] = $this->alumnos_model->seltareas();
        $datos['contenido'] = 'mostrar_tareas_alumnos_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function successedit() {
        $datos['titulo'] = 'Tareas';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function sintarea() {
        $datos['titulo'] = 'Tareas';
        $datos['contenido'] = 'sintareas_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function agenda() {
        $datos['titulo'] = 'Agenda';
        $datos['contenido'] = 'agendaalumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function Descargar_archivo() {
        $entry_id = $this->uri->segment(4);
        $this->alumnos_model->descarga($entry_id);
    }

    public function editar() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('usu_direccion', 'Dirección', 'trim|required');
            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'trim|required');
            $this->form_validation->set_rules('usu_email', 'Email', 'trim|required|valid_email|callback_correo_check');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->editarperfil();
            } else {
                $a = $this->input->post('usu_nombre');
                $c = $this->input->post('usu_direccion');
                $d = $this->input->post('usu_telefono');
                $e = $this->input->post('usu_email');
                $editar = $this->alumnos_model->editregistro($a, $c, $d, $e);
                $this->session->set_userdata('nombre', $_POST['usu_nombre']);
                $this->session->set_userdata('direccion', $_POST['usu_direccion']);
                $this->session->set_userdata('telefono', $_POST['usu_telefono']);
                $this->session->set_userdata('email', $_POST['usu_email']);
                redirect(base_url('/backend/alumnos_control/verperfil/'));
            }
        }
    }

    function correo_check($correo) {
        $this->load->model('alumnos_model');
        if ($this->alumnos_model->correo_check($correo)) {
            $this->form_validation->set_message('correo_check', 'El Correo' . " " . $correo . " " . 'ya esta siendo utilizado');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function ver_comentarios() {
        $entry_id = $this->uri->segment(4);
        $data['titulo'] = 'Comentarios';
        $data['entry'] = $this->alumnos_model->tareas($entry_id);
        $data['comments'] = $this->alumnos_model->comentarios($entry_id);
        $data['contenido'] = 'comen_alum_view';
        $this->load->view('plantillas/alumplantilla', $data);
    }

    public function comentario() {
        if (empty($_FILES['userfile']['tmp_name'])) {
            $id = $this->input->post('idtarea');
            $au = $this->session->userdata('nombre');
            $come = $this->input->post('comentario');
            $fe = date('Y-m-d H:i:s');
            $ruta = 'NULL';
            $nombre = 'NULL';
            $insert = $this->alumnos_model->inscomentario($id, $au, $come, $fe, $ruta, $nombre);
            redirect(base_url('backend/alumnos_control/ver_comentarios/' . $id));
        } else {

            $config['upload_path'] = './assets/uploads/comentarios/';
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $datos['error'] = $this->upload->display_errors();
                $entry_id = $this->uri->segment(4);
                $data['titulo'] = 'Comentarios';
                $data['entry'] = $this->alumnos_model->tareas($entry_id);
                $data['comments'] = $this->alumnos_model->comentarios($entry_id);
                $data['contenido'] = 'comen_alum_view';
                $this->load->view('plantillas/alumplantilla', $data);
            } else {
                $succ = $this->upload->data();
                $nombre = $succ['file_name'];
                $ruta = $succ['full_path'];
                $id = $this->input->post('idtarea');
                $au = $this->session->userdata('nombre');
                $come = $this->input->post('comentario');
                $fe = date('Y-m-d H:i:s');
                $insert = $this->alumnos_model->inscomentario($id, $au, $come, $fe, $ruta, $nombre);
                redirect(base_url('backend/alumnos_control/ver_comentarios/' . $id));
            }
        }
    }

    public function eliminarcomentario() {
        $a = $this->uri->segment(4);
        $idtarea = $this->alumnos_model->obtener_id($a);
        $eliminar = $this->alumnos_model->eliminar_comentario($a);
        redirect(base_url('backend/alumnos_control/ver_comentarios/' . $idtarea->idtarea));
    }

    public function descargar() {
        $entry_id = $this->uri->segment(4);
        $this->alumnos_model->descargaadjunto($entry_id);
    }

    public function ver_nota() {
        $idcatedra = $this->uri->segment(4);
        $idplan = $this->uri->segment(5);
        $datos['titulo'] = 'Notas';
        $datos['lista'] = $this->alumnos_model->listar_notas($idcatedra, $idplan);
        $datos['nombre'] = $this->alumnos_model->nombrecatedra($idcatedra);
        $datos['contenido'] = 'ver_notas_alumno_view';
        $this->load->view('plantillas/alumplantilla', $datos);
    }

    public function reporte_notas_alumno() {

        $lista = $this->alumnos_model->reportes_notas();
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
        $this->pdf->SetTitle("Lista de Notas");
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

        $this->pdf->Cell(8, 7, '#', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(40, 7, 'Catedra', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Parcial', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Recup.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, '1er Ord.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, '2er Ord.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Nota Ord.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Ptos Compl.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Nota Compl.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Ptos Mesa', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Nota Mesa', 'TBLR', 0, 'C', '1');



        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($lista as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(8, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $this->pdf->Cell(40, 5, utf8_decode($i->cat_denominacion), 'TBLR', 0, 'C', 0);
            if (!empty($i->parcial)) {
                $this->pdf->Cell(15, 5, utf8_decode($i->parcial), 'TBLR', 0, 'C', 0);
            } else {
                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
            } if (!empty($i->recuperatorio)) {
                $this->pdf->Cell(15, 5, utf8_decode($i->recuperatorio), 'TBLR', 0, 'C', 0);
            } else {
                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
            } if (!empty($i->primer_ordinario)) {
                $this->pdf->Cell(15, 5, utf8_decode($i->primer_ordinario), 'TBLR', 0, 'C', 0);
            } else {
                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
            }if (!empty($i->segundo_ordinario)) {
                $this->pdf->Cell(15, 5, utf8_decode($i->segundo_ordinario), 'TBLR', 0, 'C', 0);
            } else {
                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
            }
            if ($i->parcial >= $i->recuperatorio) {
                $puntos_parcial = $i->parcial;
            } else {
                $puntos_parcial = $i->recuperatorio;
            }
            if ($i->primer_ordinario >= $i->segundo_ordinario) {
                $puntos_ordinario = $i->primer_ordinario;
            } else {
                $puntos_ordinario = $i->segundo_ordinario;
            }
            $nota_ordinario = $puntos_parcial + $puntos_ordinario;
            if ((((empty($i->parcial)) ) and ((empty($i->recuperatorio)) )) or (((empty($i->primer_ordinario)) ) and ((empty($i->segundo_ordinario)) ))) {
                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
            } else {
                switch ($nota_ordinario) {
                    case $nota_ordinario >= 0 and $nota_ordinario <= 59:

                        $this->pdf->Cell(15, 5, utf8_decode('Nota 1'), 'TBLR', 0, 'C', 0);

                        break;
                    case $nota_ordinario >= 60 and $nota_ordinario <= 69:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 2'), 'TBLR', 0, 'C', 0);
                        break;

                    case $nota_ordinario >= 70 and $nota_ordinario <= 79:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 3'), 'TBLR', 0, 'C', 0);
                        break;
                    case $nota_ordinario >= 80 and $nota_ordinario <= 89:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 4'), 'TBLR', 0, 'C', 0);
                        break;
                    case $nota_ordinario >= 90 and $nota_ordinario <= 100:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 5'), 'TBLR', 0, 'C', 0);
                        break;
                }
            }
            if (!empty($i->complementario)) {
                $this->pdf->Cell(15, 5, utf8_decode($i->complementario), 'TBLR', 0, 'C', 0);

                switch ($i->complementario) {
                    case $i->complementario >= 0 and $i->complementario <= 59:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 1'), 'TBLR', 0, 'C', 0);

                        break;
                    case $i->complementario >= 60 and $i->complementario <= 69:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 2'), 'TBLR', 0, 'C', 0);
                        break;

                    case $i->complementario >= 70 and $i->complementario <= 79:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 3'), 'TBLR', 0, 'C', 0);
                        break;
                    case $i->complementario >= 80 and $i->complementario <= 89:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 4'), 'TBLR', 0, 'C', 0);
                        break;
                    case $i->complementario >= 90 and $i->complementario <= 100:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 5'), 'TBLR', 0, 'C', 0);
                        break;
                }
            } else {

                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
                $this->pdf->Cell(15, 5, utf8_decode('Sin Nota'), 'TBLR', 0, 'C', 0);
            }
            if (!empty($i->mesa_especial)) {
                $this->pdf->Cell(15, 5, utf8_decode($i->mesa_especial), 'TBLR', 0, 'C', 0);
                switch ($i->mesa_especial) {
                    case $i->mesa_especial >= 0 and $i->mesa_especial <= 59:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 1'), 'TBLR', 0, 'C', 0);
                        break;
                    case $i->mesa_especial >= 60 and $i->mesa_especial <= 69:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 2'), 'TBLR', 0, 'C', 0);
                        break;

                    case $i->mesa_especial >= 70 and $i->mesa_especial <= 79:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 3'), 'TBLR', 0, 'C', 0);
                        break;
                    case $i->mesa_especial >= 80 and $i->mesa_especial <= 89:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 4'), 'TBLR', 0, 'C', 0);
                        break;
                    case $i->mesa_especial >= 90 and $i->mesa_especial <= 100:
                        $this->pdf->Cell(15, 5, utf8_decode('Nota 5'), 'TBLR', 0, 'C', 0);
                        break;
                }
            } else {
                $this->pdf->Cell(15, 5, utf8_decode('Sin nota'), 'TBLR', 0, 'C', 0);
                $this->pdf->Cell(15, 5, utf8_decode('Sin nota'), 'TBLR', 0, 'C', 0);
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
        $this->pdf->Output("Lista de Notas.pdf", 'I');
    }

    public function reporte_asistencias_alumno() {

        $asistencias = $this->alumnos_model->reportes_asistencias();

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
        $this->pdf->SetTitle("Lista de Asistencias");
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
        $this->pdf->Cell(60, 7, 'Catedra', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Fecha', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(20, 7, 'Estado', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Justificacion', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($asistencias as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $fecha = $i->asi_fecha;
            $this->pdf->Cell(60, 5, utf8_decode($i->cat_denominacion), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode(date("d-m-Y", strtotime($fecha))), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(20, 5, utf8_decode($i->asi_estado), 'TBLR', 0, 'C', 0);
             $this->pdf->Cell(30, 5, utf8_decode($i->asi_justificacion), 'TBLR', 0, 'C', 0);


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
        $this->pdf->Output("Lista de Asistencias.pdf", 'I');
    }

}
