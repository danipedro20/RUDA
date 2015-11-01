<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<section class="contenido">

    <fieldset>
        <h1>Recuperar Contraseña con Correo</h1>

        <form method="post" action=" <?php echo base_url(); ?>frontend/recuperacion_control/correo">


            <label name="lbl_usu_email">Email: </label>
            <input type="text" name="usu_email" placeholder="Correo" required="" id="usu_email" value="<?php echo set_value('usu_email') ?>" />
        
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="ingresar" value="si" />
            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btnenviar" value="Enviar Solicitud" />


        </form>

    </fieldset>
</section>