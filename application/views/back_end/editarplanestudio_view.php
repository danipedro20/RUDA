<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">


        <fieldset>
            <h1>Editar Plan de Estudio</h1>
            <?php echo form_open("backend/insplan_control/editar_planestudio") ?>

            <label name="lbl_pla_denominacion">Nombre Actual del Plan de Estudio: </label>
            <input type="text" name="pla_denominacion" placeholder="Nombre Actual del Plan de Estudio" required="" value='<?php echo set_value('pla_denominacion') ?>' />
               <label name="lbl_pla_denominacion">Nombre Nuevo del Plan de Estudio: </label>
            <input type="text" name="nvo_pla_denominacion" placeholder="Nombre Nuevo del Plan de Estudio" required="" value='<?php echo set_value('nvo_pla_denominacion') ?>' />
          
          

            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btnguardar" value="Guardar Cambios" />

            <?php echo form_close() ?> 

        </fieldset>
    </section>
<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>