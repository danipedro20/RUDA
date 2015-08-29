<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($generatetabla->num_rows() > 0) { ?>
    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
        <h2> Solicitudes Pendientes</h2>
        <?php
        // $nueva_lista = $this->table->make_columns($consulta, 2);
        $plantilla = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">');

        $this->table->set_template($plantilla);
        $this->table->set_heading('Nombre', 'Carrera', 'Aula', 'Turno');

        echo $this->table->generate($generatetabla);
        ?>
        <form action="<?php echo base_url(); ?>frontend/solicitud_control/verificarsolicitud" method="post">
            <label name="lbl_idsolicitud">Solicitante:</label>
            <select name='selsolicitud' id='selsolicitud'><?php foreach ($arrDatossolicitudes as $dpto) : ?><option value=" <?php echo $dpto->idsolicitud
            ?> "><?php echo $dpto->sol_nombre ?></option><?php endforeach; ?></select>

            <input type="submit" name="suscribir" value="Verificar" />



        </form>
    </section>
    <?php
}else {
    redirect(base_url('/frontend/solicitud_control/sinsolicitud/'));
}
?>
 