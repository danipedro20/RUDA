<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
         <?php $a=$_POST['selcarrera'];?>
        <h2> Aulas  Habilitadas para <?php echo $a ?> </h2>
        <?php
       
        $consulta = $this->db->query("select aulas.aul_denominacion,plan_estudios.pla_denominacion,aulas.aul_plazasdisponibles,turnos.tur_denominacion
from aulas join plan_estudios on aulas.idplan=plan_estudios.idplan join turnos on
aulas.idturno=turnos.idturno join carreras on aulas.id_carrera=carreras.id_carrera where carreras.car_denominacion='$a' and aulas.aul_plazasdisponibles > 0;");
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
        if ($consulta->num_rows()== 0) {
           redirect(base_url('/frontend/suscripcion_control/suscripcionsinaula/'));
        }else{

        $this->table->set_template($tmpl);
        $this->table->set_heading('Aula','Plan de Estudio','Plaza Disponible','Turno');
        echo $this->table->generate($consulta);}
        ?>
       <form action="<?php echo base_url(); ?>frontend/solicitud_control/solicitudregistro" method="post">
           <input type="hidden" id="aula" name="suscarrera"  value='<?php echo $_POST['selcarrera'] ?>' />
            <label name="lbl_idcatedra">Seleccione el aula:</label>
            <select   name="susaula"  id="chosen" data-placeholder="Seleccione aula"  required="" > 

                <?php
                foreach ($arrDatosaulas as $i => $aulas)
                    echo '<option values="', $i, '">', $aulas, '</option>';
                ?> 

            </select>

            <input type="submit" name="suscribir" value="Siguiente" />



        </form>
    </section>
