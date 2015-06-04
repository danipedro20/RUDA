<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">


        <fieldset>
            <h1>Editar Carreras</h1>
            <?php echo form_open("backend/carreras_control/editar_carrera") ?>

            <label name="lbl_car_denominacion">Nombre Actual  de la Carrera: </label>
            <input type="text" name="car_denominacion" placeholder="Nombre Actual de la carrera" required="" value='<?php echo set_value('car_denominacion') ?>' />
              <label name="lbl_car_denominacion">Nombre Nuevo de la Carrera: </label>
            <input type="text" name="nvo_car_denominacion" placeholder="Nombre Nuevo de la carrera" required="" value='<?php echo set_value('nvo_car_denominacion') ?>' />


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