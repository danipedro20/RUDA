<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profesor_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('backend/profesor_model');
        $this->load->library('table');
        $this->load->library('pdf');
    }

    public function vertareas() {
        $datos['titulo'] = 'Ruda - Ver Tarea';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'ver_tareas_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function recuperacion() {
        $id = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Recuperacion';
        $datos['idusuario'] = $id;
        $datos['contenido'] = 'recuperacion_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function guardar_recuperacion() {

        $idusuario = $this->input->post('idusuario');
        $pregunta = $this->input->post('pregunta');
        $respuesta = md5($this->input->post('respuesta'));

        $insert = $this->profesor_model->insert_recuperacion($idusuario, $pregunta, $respuesta);

        redirect(base_url('/frontend/home/index/'));
    }

    public function listatareas() {
        $datos['titulo'] = 'Tareas';
        $datos['arrDatostar'] = $this->profesor_model->seltareas();
        $datos['contenido'] = 'listar_tareas_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function agenda() {
        $datos['titulo'] = 'Ruda - Agenda';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'agenda_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function tareas() {
        $datos['titulo'] = 'Ruda - Crear Tarea';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'crear_tareas_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function listaralumnos() {
        $datos['titulo'] = 'Ruda - Seleccione Catedra';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'lista_alumnos_catedra_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function listar_catedras_profesor() {
        $datos['titulo'] = 'Ruda - Seleccione Catedra';
        $datos['lista'] = $this->profesor_model->lista_catedras();
        $datos['contenido'] = 'listar_catedras_por_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function editar_listas_alumnos_con_rango() {
        $a = "";
        $datos['titulo'] = 'Ruda - Seleccione Datos';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'editar_lista_alumnos_rango_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function lista() {
        $a = "";
        $b = "";
        $c = "";
        $datos['titulo'] = 'Ruda - Seleccione Datos';
        $datos['arrDatosalum'] = $this->profesor_model->veralumnos();
        $datos['nombre'] = $this->profesor_model->nombrecatedra($a);
        $datos['asistencias'] = $this->profesor_model->verificar_lista($a, $b, $c);
        $datos['contenido'] = 'listar_alumnos_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function successtarea() {
        $datos['titulo'] = 'Insert Exitoso';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function accion() {
        $entry_id = $this->uri->segment(4);
        $this->profesor_model->descarga($entry_id);
    }

    public function insertarea() {
        if (isset($_POST['grabar']) and $_POST['grabar'] === 'si') {
            if ($_FILES['userfile']['tmp_name'] == "") {
                $this->form_validation->set_rules('tar_descripcion', 'Descripcion de la tarea', 'trim|required');
                $this->form_validation->set_rules('selCatedras', 'Seleccione una Catedra', 'trim');
                $this->form_validation->set_rules('fecha', 'Seleccione la Fecha', 'trim|required');
                $this->form_validation->set_rules('tar_puntostarea', 'Asigne los puntos ala tarea', 'required');
//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
                $this->form_validation->set_message('required', 'El %s es requerido');
                if ($this->form_validation->run() == FALSE) {
                    $this->creartareas();
                } else {

                    $z = 'NULL';
                    $a = 'NULL';
                    $c = $this->input->post('tar_puntostarea');
                    $d = $this->input->post('tar_descripcion');
                    $y = $this->input->post('catedra');
                    $x = $this->input->post('idturno');
                    $p = $this->input->post('aula');




                    $insert = $this->profesor_model->instareas($c, $d, $a, $z, $y, $p, $x);

                    redirect(base_url('backend/profesor_control/successtarea/'));
                }
            } else {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'pdf|jpg|png';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    $datos['error'] = $this->upload->display_errors();
                    $datos['arrDatos'] = $this->profesor_model->vercatedras();
                    $datos['contenido'] = 'creartareas_view';
                    $this->load->view('plantillas/profplantilla', $datos);
                } else {

//si existe el campo oculto llamado grabar creamos las validadciones
                    $this->form_validation->set_rules('tar_descripcion', 'Descripcion de la tarea', 'trim|required');
                    $this->form_validation->set_rules('selCatedras', 'Seleccione una Catedra', 'trim');
                    $this->form_validation->set_rules('fecha', 'Seleccione la Fecha', 'trim|required');
                    $this->form_validation->set_rules('tar_puntostarea', 'Asigne los puntos ala tarea', 'required');
//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
                    $this->form_validation->set_message('required', 'El %s es requerido');
                    if ($this->form_validation->run() == FALSE) {
                        $this->creartareas();
                    } else {
                        $succ = $this->upload->data();
                        $z = $succ['file_name'];
                        $a = $succ['full_path'];
                        $c = $this->input->post('tar_puntostarea');
                        $d = $this->input->post('tar_descripcion');
                        $y = $this->input->post('catedra');
                        $x = $this->input->post('idturno');
                        $p = $this->input->post('aula');




                        $insert = $this->profesor_model->instareas($c, $d, $a, $z, $y, $p, $x);

                        redirect(base_url('backend/profesor_control/successtarea/'));
                    }
                }
            }
        }
    }

//    public function liscatedras() {
//        $datos['titulo'] = 'Lista de catedras';
//        $datos['contenido'] = 'lista_catedras_view';
//        $this->load->view('plantillas/profplantilla', $datos);
//    }

    public function verperfil() {
        $datos['titulo'] = 'Perfil';
        $datos['contenido'] = 'ver_perfil_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function editarperfil() {
        $datos['titulo'] = 'Editar Perfil';
        $datos['contenido'] = 'editar_perfil_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function successedit() {
        $datos['titulo'] = 'Editar';
        $datos['contenido'] = 'successview';
        $this->load->view('plantillas/profplantilla', $datos);
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
                $a = $_POST['usu_nombre'];
                $c = $_POST['usu_direccion'];
                $d = $_POST['usu_telefono'];
                $e = $_POST['usu_email'];
                $editar = $this->profesor_model->editregistro($a, $c, $d, $e);
                // $inscreditar = $this->profesor_model->editinscrip($a);
                $this->session->set_userdata('nombre', $_POST['usu_nombre']);
                $this->session->set_userdata('direccion', $_POST['usu_direccion']);
                $this->session->set_userdata('telefono', $_POST['usu_telefono']);
                $this->session->set_userdata('email', $_POST['usu_email']);
                redirect(base_url('/backend/profesor_control/successedit/'));
            }
        }
    }

    function correo_check($correo) {
        $this->load->model('profesor_model');
        if ($this->profesor_model->correo_check($correo)) {
            $this->form_validation->set_message('correo_check', 'El Correo' . " " . $correo . " " . 'ya esta siendo utilizado');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function comentario() {
        if (empty($_FILES['userfile']['tmp_name'])) {
            $id = $this->input->post('idtarea');
            $au = $this->session->userdata('nombre');
            $come = $this->input->post('comentario');
            $fe = date('Y-m-d H:i:s');
            $ruta = 'NULL';
            $nombre = 'NULL';
            $insert = $this->profesor_model->inscomentario($id, $au, $come, $fe, $ruta, $nombre);
            redirect(base_url('backend/profesor_control/ver_comentarios/' . $id));
        } else {

            $config['upload_path'] = './assets/uploads/comentarios/';
            $config['allowed_types'] = 'pdf|jpg|png';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $entry_id = $this->uri->segment(4);
                $data['titulo'] = 'Comentarios';
                $data['entry'] = $this->profesor_model->tareas($entry_id);
                $data['comments'] = $this->profesor_model->comentarios($entry_id);
                $data['contenido'] = 'comentarios_profesores_view';
                $this->load->view('plantillas/profplantilla', $data);
            } else {
                $succ = $this->upload->data();
                $nombre = $succ['file_name'];
                $ruta = $succ['full_path'];
                $id = $this->input->post('idtarea');
                $au = $this->session->userdata('nombre');
                $come = $this->input->post('comentario');
                $fe = date('Y-m-d H:i:s');
                $insert = $this->profesor_model->inscomentario($id, $au, $come, $fe, $ruta, $nombre);
                redirect(base_url('backend/profesor_control/ver_comentarios/' . $id));
            }
        }
    }

    public function ver_comentarios() {
        $entry_id = $this->uri->segment(4);
        $data['titulo'] = 'Comentarios';
        $data['entry'] = $this->profesor_model->tareas($entry_id);
        $data['comments'] = $this->profesor_model->comentarios($entry_id);
        $data['contenido'] = 'comentarios_profesores_view';
        $this->load->view('plantillas/profplantilla', $data);
    }

    public function eliminarcomentario() {
        $a = $this->uri->segment(4);
        $idtarea = $this->profesor_model->obtener_id($a);
        $eliminar = $this->profesor_model->eliminar_comentario($a);
        redirect(base_url('backend/alumnos_control/ver_comentarios/' . $idtarea->idtarea));
    }

    public function descargar() {
        $entry_id = $this->uri->segment(4);
        $this->profesor_model->descargaadjunto($entry_id);
    }

    public function guardar_lista() {
        $hoy = date('d-m-Y');
        $total = count($this->input->post('catedra'));
        for ($i = 0; $i < $total; $i++) {
            $idusuario = $this->input->post('idusuario')[$i];
            $idcatedra = $this->input->post('catedra')[$i];
            $estado = $this->input->post('estado')[$i];
            $Justificacion = $this->input->post('justificacion')[$i];
            $aula = $this->input->post('aula')[$i];
            $fecha = date("Y-m-d", strtotime($hoy));
            $insert = $this->profesor_model->insert_asistencia($idusuario, $idcatedra, $estado, $Justificacion, $fecha, $aula);
        }
        redirect(base_url('/backend/profesor_control/listaralumnos/'));
    }

    public function editar_lista_alumnos() {
        $a = $this->uri->segment(4);
        $b = $this->uri->segment(5);
        $c = $this->uri->segment(6);
        $datos['titulo'] = 'Ruda - Seleccione Catedra';
        $datos['asistencias'] = $this->profesor_model->datos_lista($a, $b, $c);
        $datos['verificar'] = $this->profesor_model->verificar_lista($a, $b, $c);
        $datos['nombre'] = $this->profesor_model->nombrecatedra($a);
        $datos['contenido'] = 'editar_lista_alumnos_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function editar_lista_alumnos_rango() {
        $a = $this->input->post('catedra');
        $b = $this->input->post('aula');
        $c = $this->input->post('fecha');
        $datos['titulo'] = 'Ruda - Seleccione Catedra';
        $datos['asistencias'] = $this->profesor_model->datos_lista($a, $b, $c);
        $datos['verificar'] = $this->profesor_model->verificar_lista($a, $b, $c);
        $datos['nombre'] = $this->profesor_model->nombrecatedra($a);
        $datos['contenido'] = 'editar_lista_alumnos_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function editar_lista() {
        $hoy = date('d-m-Y');
        $total = count($this->input->post('catedra'));
        for ($i = 0; $i < $total; $i++) {
            $idusuario = $this->input->post('idusuario')[$i];
            $idcatedra = $this->input->post('catedra')[$i];
            $estado = $this->input->post('estado')[$i];
            $Justificacion = $this->input->post('justificacion')[$i];
            $fecha = $this->input->post('fecha')[$i];
            $aula = $this->input->post('aula')[$i];

            $insert = $this->profesor_model->editar_asistencia($idusuario, $idcatedra, $estado, $Justificacion, $fecha, $aula);
        }
        redirect(base_url('/backend/profesor_control/listaralumnos/'));
    }

    public function puntajes() {
        $a = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Dar Puntajes';
        $datos['idtarea'] = $a;
        $datos['lista'] = $this->profesor_model->lista_dar_puntajes($a);
        $datos['contenido'] = 'lista_dar_puntajes_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function editar_puntajes() {
        $a = $this->uri->segment(4);
        $datos['titulo'] = 'Ruda - Dar Puntajes';
        $datos['idtarea'] = $a;
        $datos['lista'] = $this->profesor_model->listar_puntaje($a);
        $datos['contenido'] = 'editar_puntajes_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function guardar_puntajes() {
        $total = count($this->input->post('idusuario'));
        for ($i = 0; $i < $total; $i++) {
            $idusuario = $this->input->post('idusuario')[$i];
            $idtarea = $this->input->post('tarea')[$i];
            $idcatedra = $this->input->post('catedra')[$i];
            $puntos = $this->input->post('tar_puntostarea')[$i];
            $puntos_logrados = $this->input->post('tar_puntoslogrados')[$i];
            $insert = $this->profesor_model->guardar_notas_tarea($idusuario, $idcatedra, $idtarea, $puntos, $puntos_logrados);
        }
        redirect(base_url('/backend/profesor_control/vertareas/'));
    }

    public function editar_puntaje() {
        $total = count($this->input->post('idusuario'));
        for ($i = 0; $i < $total; $i++) {
            $id = $this->input->post('id')[$i];
            $puntos_logrados = $this->input->post('tar_puntoslogrados')[$i];
            $insert = $this->profesor_model->editar_notas_tarea($id, $puntos_logrados);
        }
        redirect(base_url('/backend/profesor_control/vertareas/'));
    }

    public function notas_examenes() {

        $plan = $this->uri->segment(4);
        $catedra = $this->uri->segment(5);
        $aula = $this->uri->segment(6);
        $idtipo = $this->uri->segment(7);
        $id = $this->uri->segment(8);
        $datos['titulo'] = 'Ruda - Dar Puntajes';
        $datos['lista'] = $this->profesor_model->listar_alumnos_nota($plan, $catedra, $aula);
        $datos['nombre'] = $this->profesor_model->nombrecatedra($catedra);
        $datos['idtipo'] = $idtipo;
        $datos['id'] = $id;
        $datos['contenido'] = 'notas_examenes_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function editar_notas_examenes() {
        $plan = $this->uri->segment(4);
        $catedra = $this->uri->segment(5);
        $idtipo = $this->uri->segment(6);
        $datos['titulo'] = 'Ruda - Dar Puntajes';
        $datos['lista'] = $this->profesor_model->listar_notas_examen($plan, $catedra);
        $datos['nombre'] = $this->profesor_model->nombrecatedra($catedra);
        $datos['idtipo'] = $idtipo;
        $datos['contenido'] = 'editar_notas_examenes_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function llenar() {

        if ($this->input->post('aula')) {
            $id = $this->input->post('aula');
            $catedras = $this->profesor_model->verlascatedras($id);
            foreach ($catedras as $a) {
                ?>
                <option value="<?php echo $a->idcatedra ?>"><?php echo $a->cat_denominacion ?></option>

                <?php
            }
        }
    }

    public function guardar_notas_examenes() {

        $total = count($this->input->post('idusuario'));
        for ($i = 0; $i < $total; $i++) {
            $idtipo = $this->input->post('idtipo')[$i];
            if ($idtipo == 2) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->guardar_nota_parcial($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 3) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $consuta1 = $this->db->query("select * from notas_examenes where idcatedra='$idcatedra' and idplan='$idplan'and idusuario='$idusuario'");
                if ($consuta1->num_rows() > 0) {
                    $editar = $this->profesor_model->editar_nota_recuperatorio($idusuario, $idplan, $idcatedra, $logrados);
                } else {
                    $insertar = $this->profesor_model->guardar_nota_recuperatorio($idusuario, $idplan, $idcatedra, $logrados);
                }
            } elseif ($idtipo == 4) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->guardar_nota_primer_ordinario($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 5) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->guardar_nota_segundo_ordinario($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 6) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $consuta1 = $this->db->query("select * from notas_examenes where idcatedra='$idcatedra' and idplan='$idplan'and idusuario='$idusuario'");
                if ($consuta1->num_rows() > 0) {
                    $editar = $this->profesor_model->editar_nota_complementario($idusuario, $idplan, $idcatedra, $logrados);
                } else {
                    $insertar = $this->profesor_model->guardar_nota_complementario($idusuario, $idplan, $idcatedra, $logrados);
                }
            } elseif ($idtipo == 7) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $consuta1 = $this->db->query("select * from notas_examenes where idcatedra='$idcatedra' and idplan='$idplan'and idusuario='$idusuario'");
                if ($consuta1->num_rows() > 0) {
                    $editar = $this->profesor_model->editar_nota_extraordinario($idusuario, $idplan, $idcatedra, $logrados);
                } else {
                    $insertar = $this->profesor_model->guardar_nota_extraordinario($idusuario, $idplan, $idcatedra, $logrados);
                }
            } elseif ($idtipo == 8) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $consuta1 = $this->db->query("select * from notas_examenes where idcatedra='$idcatedra' and idplan='$idplan'and idusuario='$idusuario'");
                if ($consuta1->num_rows() > 0) {
                    echo $logrados = $this->input->post('logrados')[$i];

                    $editar = $this->profesor_model->editar_nota_mesa($idusuario, $idplan, $idcatedra, $logrados);
                } else {
                    $insertar = $this->profesor_model->guardar_nota_mesa($idusuario, $idplan, $idcatedra, $logrados);
                }
            }
        }
        redirect(base_url('/backend/profesor_control/listar_catedras_profesor/'));
    }

    public
            function editar_nota_examen() {

        $total = count($this->input->post('idusuario'));
        for ($i = 0; $i < $total; $i++) {
            $idtipo = $this->input->post('idtipo')[$i];
            if ($idtipo == 2) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_parcial($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 3) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_recuperatorio($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 4) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_primer_ordinario($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 5) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_segundo_ordinario($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 6) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_complementario($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 7) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_extraordinario($idusuario, $idplan, $idcatedra, $logrados);
            } elseif ($idtipo == 8) {
                $idusuario = $this->input->post('idusuario')[$i];
                $idplan = $this->input->post('idplan')[$i];
                $idcatedra = $this->input->post('idcatedra')[$i];
                $logrados = $this->input->post('logrados')[$i];
                $editar = $this->profesor_model->editar_nota_mesa($idusuario, $idplan, $idcatedra, $logrados);
            }
        }
        redirect(base_url('/backend/profesor_control/listar_catedras_profesor/'));
    }

    public function ver_notas_examenes() {
        $plan = $this->uri->segment(4);
        $catedra = $this->uri->segment(5);
        $datos['titulo'] = 'Ruda - Dar Puntajes';
        $datos['lista'] = $this->profesor_model->listar_notas_examen($plan, $catedra);
        $datos['nombre'] = $this->profesor_model->nombrecatedra($catedra);
        $datos['contenido'] = 'ver_notas_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function reporte() {
        $datos['titulo'] = 'Ruda - Agenda';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'asistencia_reporte_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function tarea_reporte() {
        $datos['titulo'] = 'Ruda - Agenda';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'tarea_reporte_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function generar_reporte_asistencia() {
        $a = $this->input->post('aula');
        $b = $this->input->post('catedra');
        $c = $this->input->post('mes');

        $asistencias = $this->profesor_model->generar_asistencias($a, $b, $c);

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
        $this->pdf->Cell(40, 7, 'Nombre', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(60, 7, 'Catedra', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Aula', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(20, 7, 'Estado', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Fecha', 'TBLR', 0, 'C', '1');
        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($asistencias as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $fecha = $i->asi_fecha;
            $this->pdf->Cell(40, 5, utf8_decode($i->usu_nombre), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(60, 5, utf8_decode($i->cat_denominacion), 'TBL', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode($i->aul_denominacion), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(20, 5, utf8_decode($i->asi_estado), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode(date("d-m-Y", strtotime($fecha))), 'TBLR', 0, 'C', 0);

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

    public function notas_reporte() {
        $datos['titulo'] = 'Ruda - Agenda';
        $datos['arrDatos'] = $this->profesor_model->verlasaulas();
        $datos['contenido'] = 'notas_reporte_profesor_view';
        $this->load->view('plantillas/profplantilla', $datos);
    }

    public function generar_reporte_tareas() {
        $a = $this->input->post('aula');
        $b = $this->input->post('catedra');
        $c = $this->input->post('mes');

        $tareas = $this->profesor_model->generar_tareas($a, $b, $c);

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
        $this->pdf->SetTitle("Lista de Tareas");
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
        $this->pdf->Cell(60, 7, 'Descripcion', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(40, 7, 'Fecha de Asig.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(40, 7, 'Fecha de Entreg.', 'TBLR', 0, 'C', '1');
        $this->pdf->Cell(30, 7, 'Estado', 'TBLR', 0, 'C', '1');

        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($tareas as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(15, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $fecha_asig = $i->tar_fechaasignacion;
            $fecha_entre = $i->tar_fechaentrega;
            $this->pdf->Cell(60, 5, utf8_decode($i->tar_descripcion), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(40, 5, utf8_decode(date("d-m-Y", strtotime($fecha_asig))), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(40, 5, utf8_decode(date("d-m-Y", strtotime($fecha_entre))), 'TBLR', 0, 'C', 0);
            $this->pdf->Cell(30, 5, utf8_decode($i->estado), 'TBLR', 0, 'C', 0);


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
        $this->pdf->Output("Lista de Tareas.pdf", 'I');
    }

    public function generar_reporte_notas() {
        $a = $this->input->post('aula');
        $catedra = $this->input->post('catedra');
        $p = $this->profesor_model->plan($a, $catedra);
        $plan = $p->idplan;

        $lista = $this->profesor_model->listar_notas_examen($plan, $catedra);
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
        $this->pdf->Cell(40, 7, 'Nombre', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Parcial', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Recup.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, '1er Ord.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, '2er Ord.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Nota Ord.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Ptos Compl.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Nota Compl.', 'TBL', 0, 'C', '1');
        $this->pdf->Cell(15, 7, 'Ptos Mesa', 'TBL', 0, 'C', '1');
         $this->pdf->Cell(15, 7, 'Nota Mesa', 'TBL', 0, 'C', '1');



        $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        $x = 1;

        foreach ($lista as $i) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            $this->pdf->Cell(8, 5, $x++, 'TBL', 0, 'C', 0);
            // Se imprimen los datos de cada Catedra

            $this->pdf->Cell(40, 5, utf8_decode($i->usu_nombre), 'TBLR', 0, 'C', 0);
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
                $this->pdf->Cell(15, 5, utf8_decode($i->complentario), 'TBLR', 0, 'C', 0);

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

}
