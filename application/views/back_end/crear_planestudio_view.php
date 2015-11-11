<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.css"/>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo base_url() ?>/assets/calendario/datapicker.js"></script>
      <script src="<?php echo base_url() ?>/assets/calendario/datapicker_fin.js"></script>
    <section class="contenido">


        <fieldset>
            <h1>Crear Plan de Estudio</h1>
            <?php echo form_open("backend/insplan_control/inserplan") ?>

            <label name="lbl_pla_denominacion">Nombre del Plan de Estudio: </label>
            <input type="text" name="pla_denominacion" placeholder="Nombre del Plan de Estudio" required="" maxlength="30" value='<?php echo set_value('pla_denominacion') ?>' />
            <label name="fecha">Fecha de Inicio:</label>
            <input type="text" id="fecha" required="" name="fecha"  placeholder="Fecha de Inicio" value='<?php echo set_value('tar_fecha entrega') ?>' />
            <label name="fecha">Fecha de Fin:</label>
            <input type="text" id="fecha_fin" required="" name="fecha_fin"  placeholder="Fecha Fin" value='<?php echo set_value('tar_fecha entrega') ?>' />

            <input type="hidden"  id="direccion" name="direccion"  value= <?php echo $_SERVER['HTTP_REFERER']; ?>  />

            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btnguardar" value="Guardar" />

            <?php echo form_close() ?> 

        </fieldset>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>