<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<section class="contenido">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>

    <h2> Aulas  Habilitadas </h2>
    <?php
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
    if ($generateaulas->num_rows() == 0) {
        redirect(base_url('/frontend/suscripcion_control/suscripcionsinaula/'));
    } else {

        $this->table->set_template($tmpl);
        $this->table->set_heading('Aula', 'Plan de Estudio', 'Plaza Disponible', 'Turno');
        echo $this->table->generate($generateaulas);
    }
    ?>
    <form action="<?php echo base_url(); ?>frontend/solicitud_control/solicitudregistro" method="post">
        <input type="hidden" id="suscarreras" name="suscarreras"  value='<?php echo $this->input->post('selcarreras'); ?>' />
        <label name="lbl_idcatedra">Seleccione el aula:</label>
             <select name='susaulas' id='susaulas'><?php foreach ($arrDatosaulas as $dpto) : ?><option value=" <?php echo $dpto->idaula
        ?> "><?php echo $dpto->aul_denominacion ?></option><?php endforeach; ?></select>

        <input type="submit" name="suscribir" value="Siguiente" />



    </form>
</section>
