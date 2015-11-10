<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//AQUI INICIA EL CONTROLADOR DE LA PAGINA admin
class Adhome extends CI_Controller {

    //Se crea siempre un constructor al inicial un controlador
    public function __construct() {
        parent::__construct();
        $this->load->library("email");
        $this->load->model('backend/adhome_model');
        $this->load->library('pdf');
        //llamado al modelo
        //   $this->load->model('/backend/Perfil_model');
    }

    function index2() {
        $datos['titulo'] = 'Ruda - Administración';
        $datos['contenido'] = 'inicio_admin_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function verperfil() {
        $datos['titulo'] = 'Perfil';
        $datos['contenido'] = 'ver_perfil_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editarperfil() {
        $datos['titulo'] = 'Editar Perfil';
        $datos['contenido'] = 'editar_perfil_view';
        $this->load->view('plantillas/adplantilla', $datos);
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
                $editar = $this->adhome_model->editregistro($a, $c, $d, $e);
                $this->session->set_userdata('nombre', $_POST['usu_nombre']);
                $this->session->set_userdata('direccion', $_POST['usu_direccion']);
                $this->session->set_userdata('telefono', $_POST['usu_telefono']);
                $this->session->set_userdata('email', $_POST['usu_email']);
                redirect(base_url('/backend/adhome/verperfil/'));
            }
        }
    }

    function correo_check($correo) {
        $this->load->model('adhome_model');
        if ($this->adhome_model->correo_check($correo)) {
            $this->form_validation->set_message('correo_check', 'El Correo' . " " . $correo . " " . 'ya esta siendo utilizado');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function mostrar_alumnos() {
        $datos['titulo'] = 'Editar';
        $datos['alumnos'] = $this->adhome_model->lista_alumnos();
        $datos['contenido'] = 'editar_alumnos_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function listar_profesores() {
        $datos['titulo'] = 'Lista';
        $datos['lista'] = $this->adhome_model->lista_profesores();
        $datos['contenido'] = 'listar_profesores_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function insert_exitoso() {
        $datos['titulo'] = 'Existoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function mostrar_profesores() {
        $datos['titulo'] = 'Editar';
        $datos['alumnos'] = $this->adhome_model->profesores_alumnos();
        $datos['contenido'] = 'editar_alumnos_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function registrar_profesores() {
        $datos['titulo'] = 'Registrar Profesores';
        $datos['contenido'] = 'crear_profesores_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editar_alumnos() {
        $entry_id = $this->uri->segment(4);
        $datos['titulo'] = 'Editar';
        $datos['arrDatosaulas'] = $this->adhome_model->verlasaulas($entry_id);
        $datos['alum'] = $this->adhome_model->datos_alumnos($entry_id);
        $datos['contenido'] = 'editar_usuario_alumno_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function editar_datos() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'trim|required');
            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');
            if ($this->form_validation->run() == FALSE) {
                $this->editar_datos();
            } else {
                $a = $this->input->post('usu_nombre');
                $z = $this->input->post('idusuario');
                $b = $this->input->post('aula');
                $c = $this->input->post('carrera');
                $editarnombre = $this->adhome_model->editarnombre($a, $z);
                $editaraula = $this->adhome_model->editaraula($b, $z);
                redirect(base_url('/backend/adhome/mostrar_alumnos/'));
            }
        }
    }

    public function llenar() {

        if ($this->input->post('aula')) {
            $idaula = $this->input->post('aula');
            $carreras = $this->adhome_model->verlascarreras($idaula);
            foreach ($carreras as $au) {
                ?>
                <option value="<?php echo $au->id_carrera ?>"><?php echo $au->car_denominacion ?></option>

                <?php
            }
        }
    }

    public function insert_profesores() {

        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            //si existe el campo oculto llamado grabar creamos las validadciones
            $this->form_validation->set_rules('username', 'Nombre', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('usu_nrocedula', 'Nombre', 'trim|required|callback_cedula_check');
            $this->form_validation->set_rules('usu_direccion', 'Dirección', 'trim|required');
            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_check|valid_email');
            $this->form_validation->set_rules('usu_pass', 'Contraseña', 'trim|required');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            $this->form_validation->set_message('required', 'El %s es requerido');

            if ($this->form_validation->run() == FALSE) {
                $this->registar_profesores();
            } else {
                $a = $this->input->post('username');
                $b = $this->input->post('usu_nrocedula');
                $c = $this->input->post('usu_direccion');
                $d = $this->input->post('usu_telefono');
                $e = $this->input->post('email');
                $f = md5($this->input->post('usu_pass'));
                $g = $this->input->post('pregunta');
                $h = md5($this->input->post('respuesta'));
                $z = $this->input->post('usu_pass');

//                $this->db->select('usu_nombre')
//                        ->where('usu_nombre', $a);
//                $query1 = $this->db->get('inscripciones');
//                if ($query1->num_rows() > 0) {
                $insert = $this->adhome_model->insert_profesor($a, $b, $c, $d, $e, $f);
                //  $recuperacion = $this->adhome_model->insert_recuperacion($a, $g, $h);
                $enviar = $this->adhome_model->enviar_correo($a, $z, $e, $g);



//                    $insert2 = $this->registro_model->inspregunta($g, $h, $e);
                //enviar correo de solicitud
//                    $z = 'Solicitud De Suscripcion al Sistema RUDA';
//                    $n = 'Usted' . " " . $a . " " . 'solicita suscribirse al aula' . " " . $_POST['regisaula'] . " " . ' de la carrera ' . " " . $_POST['regiscarrera'] . " " . 'su pedido fue recibido coorectamente obtedra respuesta dentro de las 24 u 48 horas siguientes';
//
//                    $this->load->library('email');
//                    $this->email->from('gestiondeaularuda@gmail.com', 'Ruda Gestión de Aulas');
//                    $this->email->to("$e");
//                    $this->email->subject("$z");
//                    $this->email->message("$n");
//                    $this->email->send();
                redirect(base_url('/backend/adhome/insert_exitoso/'));

//                } else {
//                    redirect(base_url('/frontend/registro_control/registrofail/'));
            }
        }
    }

    public function agenda() {
        $datos['titulo'] = 'Ruda - Agenda';
        $datos['arrDatos'] = $this->adhome_model->aulas();
        $datos['contenido'] = 'agenda_admin_view';
        $this->load->view('plantillas/adplantilla', $datos);
    }

    public function reporte_alumnos() {


        $plan = $this->adhome_model->lista_alumnos();

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
        $this->pdf->SetTitle("Lista de Alumnos");
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
        $this->pdf->Cell(60, 7, 'Nombre', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Carrera', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Aula', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($plan as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra


            $this->pdf->Cell(60, 5, utf8_decode($i->usu_nombre), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(60, 5, utf8_decode($i->car_denominacion), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(60, 5, utf8_decode($i->aul_denominacion), 'TBLR', 0, 'C', 0);
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

    public function reporte_profesores() {
      
        $lista = $this->adhome_model->lista_profesores();

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
        $this->pdf->SetTitle("Lista de Profesores");
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
        $this->pdf->Cell(60, 7, 'Nombre', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Numero C.I', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Telefono', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($lista as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra


            $this->pdf->Cell(60, 5, utf8_decode($i->usu_nombre), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(60, 5, utf8_decode($i->usu_nrocedula), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(60, 5, utf8_decode($i->usu_telefono), 'TBLR', 0, 'C', 0);
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
        $this->pdf->Output("Lista de Profesores.pdf", 'I');
    }

}
