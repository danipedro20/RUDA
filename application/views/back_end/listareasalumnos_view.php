<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
        <h2> Lista de Tareas</h2>
        <?php
        $z = $this->session->userdata('id');

        $consulta = $this->db->query("select aulas.idaula from aulas join usu_au on
aulas.idaula=usu_au.idaula join usuarios on usuarios.idusuario=usu_au.idusuario where usuarios.idusuario='$z';");
        $fila = $consulta->row_array();
        $k = $fila['idaula'];



        $b = $_POST['SEL'];
        $this->db->select('idcatedra')
                ->where('cat_denominacion', $b);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $id = $row['idcatedra'];


        $this->db->select('idcatedra')
                ->where('cat_denominacion', $b);
        $query = $this->db->get('catedras');
        $row = $query->row_array();
        $id = $row['idcatedra'];
        $consulta = $this->db->query("select tareas.tar_descripcion,tareas.tar_fechaasignacion,tareas.tar_fechaentrega,tareas.tar_puntostarea from tareas join
catedras on tareas.idcatedra=catedras.idcatedra join aulas on tareas.idaula=aulas.idaula join 
usu_au on aulas.idaula=usu_au.idaula join usuarios on usu_au.idusuario=usuarios.idusuario where usuarios.idusuario='$z' and aulas.idaula='$k' and catedras.idcatedra='$id';");
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
        if ($consulta->num_rows() == 0) {
            redirect(base_url('/backend/alumnos_control/sintarea/'));
        } else {

            $this->table->set_template($tmpl);
            $this->table->set_heading('Descripcion', 'Fecha de Creación', 'Fecha de Entrega', 'Puntos Asignados');
            echo $this->table->generate($consulta);
        }
        ?>
        <form action="<?php echo base_url(); ?>backend/alumnos_control/descargar_archivo" method="post">
            <label name="lbl_idcatedra">Seleccione  la Tarea:</label>
            <select   class="chosen"   name="SELtarea"  id="chosen" data-placeholder="Seleccione la Tarea"  required="" style="width: 200px;"> 

                <?php
                foreach ($arrDatostar as $i => $tar)
                    echo '<option values="', $i, '">', $tar, '</option>';
                ?> 

            </select>

            <input type="submit" name="btnguardarplan" value="Descargar Archivo" />



        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>