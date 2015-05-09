<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<section class="contenido">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
    <h2> Carreras Habilitadas</h2>
    <?php
    // $nueva_lista = $this->table->make_columns($consulta, 2);
    $plantilla = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">');

    $this->table->set_template($plantilla);
    $this->table->set_heading('Carreras');

    echo $this->table->generate($generate);
    ?>
    <form action="<?php echo base_url(); ?>frontend/suscripcion_control/suscripcionaulas" method="post">
        <label name="lbl_idcatedra">Carrera:</label>
        <select  class="chosen"   name="selcarrera"  id="chosen" data-placeholder="Seleccione la carrera"  required="" > 

            <?php
            foreach ($arrDatoscarreras as $i => $carreras)
                echo '<option values="', $i, '">', $carreras, '</option>';
            ?> 

        </select>

        <input type="submit" name="suscribir" value="Suscribirse" />



    </form>
</section>
