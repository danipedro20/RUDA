<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
    <script>
        $(document).ready(function() {

            $("input[type=submit]").click(function() {
                var accion = $(this).attr('dir');
                $('form').attr('action', accion);
                $('form').submit();
            });

        });
    </script>

    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
        <h2> Lista de Tareas</h2>
        <?php
        $z = $this->session->userdata('id');

        $consulta = $this->db->query("select aulas.idaula from aulas join usu_au on
aulas.idaula=usu_au.idaula join usuarios on usuarios.idusuario=usu_au.idusuario where usuarios.idusuario='$z';");
        $fila = $consulta->row_array();
        $k = $fila['idaula'];
        $b = $this->input->post('selcatedra');
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));
        $c = $this->input->post('ver_rango');
        if ($c == 1) {
            $consulta1 = $this->db->query("select tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b' and tareas.tar_fechaasignacion='$fechahoy';");
            if ($consulta1->num_rows() == 0) {
                redirect(base_url('/backend/alumnos_control/sintarea/'));
            } else {

                $tmpl = array(
                    'table_open' => '<table border="1" cellpadding="4" cellspacing="10">',
                    'heading_row_start' => '<tr>',
                    'heading_row_end' => '</tr>',
                    'heading_cell_start' => '<th>',
                    'heading_cell_end' => '</th>',
                    'row_start' => '<tr>',
                    'row_end' => '</tr>',
                    'cell_start' => '<td>',
                    'cell_end' => '</td>',
                    'row_alt_start' => '<tr>',
                    'row_alt_end' => '</tr>',
                    'cell_alt_start' => '<td>',
                    'cell_alt_end' => '</td>',
                    'table_close' => '</table>'
                );
                $this->table->set_template($tmpl);
                $this->table->set_heading('Descripcion', 'Fecha de Creación', 'Fecha de Entrega', 'Puntos Asignados');
                echo $this->table->generate($consulta1);
            }
        } elseif ($c == 2) {
            $consulta1 = $this->db->query("select tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b' and tareas.tar_fechaentrega>='$fechahoy';");
            if ($consulta1->num_rows() == 0) {
                redirect(base_url('/backend/alumnos_control/sintarea/'));
            } else {

                $tmpl = array(
                    'table_open' => '<table border="1" cellpadding="4" cellspacing="10">',
                    'heading_row_start' => '<tr>',
                    'heading_row_end' => '</tr>',
                    'heading_cell_start' => '<th>',
                    'heading_cell_end' => '</th>',
                    'row_start' => '<tr>',
                    'row_end' => '</tr>',
                    'cell_start' => '<td>',
                    'cell_end' => '</td>',
                    'row_alt_start' => '<tr>',
                    'row_alt_end' => '</tr>',
                    'cell_alt_start' => '<td>',
                    'cell_alt_end' => '</td>',
                    'table_close' => '</table>'
                );
                $this->table->set_template($tmpl);
                $this->table->set_heading('Descripcion', 'Fecha de Creación', 'Fecha de Entrega', 'Puntos Asignados');
                echo $this->table->generate($consulta1);
            }
        } elseif ($c == 3) {
            $consulta1 = $this->db->query("select tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$b'");
            if ($consulta1->num_rows() == 0) {
                redirect(base_url('/backend/alumnos_control/sintarea/'));
            } else {

                $tmpl = array(
                    'table_open' => '<table border="1" cellpadding="4" cellspacing="10">',
                    'heading_row_start' => '<tr>',
                    'heading_row_end' => '</tr>',
                    'heading_cell_start' => '<th>',
                    'heading_cell_end' => '</th>',
                    'row_start' => '<tr>',
                    'row_end' => '</tr>',
                    'cell_start' => '<td>',
                    'cell_end' => '</td>',
                    'row_alt_start' => '<tr>',
                    'row_alt_end' => '</tr>',
                    'cell_alt_start' => '<td>',
                    'cell_alt_end' => '</td>',
                    'table_close' => '</table>'
                );
                $this->table->set_template($tmpl);
                $this->table->set_heading('Descripcion', 'Fecha de Creación', 'Fecha de Entrega', 'Puntos Asignados');
                echo $this->table->generate($consulta1);
            }
        }
        ?>
        <form  method="post">
            <label name="lbl_idcatedra">Seleccione  la Tarea:</label>
            <select name='seltarea' id='seltarea' style="width: 300px;"><?php foreach ($arrDatostar as $tarea) : ?>
                    <option value="<?php echo $tarea->idtarea ?>"><?php echo $tarea->tar_descripcion ?>
                    </option><?php endforeach; ?>
            </select>
             <input type="submit" name="Descargar" id="Descargar" value="Descargar Archivos"  dir="<?php echo base_url(); ?>backend/alumnos_control/descargar_archivo"/>
            <input type="submit" name="comentarios" id="comentarios" value="Ver Comentarios"  dir="<?php echo base_url(); ?>backend/alumnos_control/comen" />



        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>