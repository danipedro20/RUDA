<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
if ($this->session->userdata('nombre')) {
    ?>
    <meta http-equiv="Expires" content="0" /> 
    <meta http-equiv="Pragma" content="no-cache" />
    <script Language="JavaScript">
        if (history.forward(-1)) {
            history.replace(history.forward(-1));
        }
    </script>

    <section class="contenido">


        <fieldset>
            <h1>Cambio de Contraseña</h1>

            <form method="post" action=" <?php echo base_url(); ?>backend/verificacion_control/verificacioncontra">
                <label name="lbl_usu_pass">Contraseña: </label>
                <input type="password" name="usu_pass" placeholder="Contraseña"  required="" id="usu_pass" value='<?php echo set_value('usu_pass') ?>' />
                <label name="lbl_usu_pass">Contraseña Nueva: </label>
                <input type="password" name="usu_passnuevo" placeholder="Contraseña Nueva" required="" id="usu_passnuevo" value='<?php echo set_value('usu_passnuevo') ?>' />
                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="ingresar" value="si" />
                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

                <input type="submit" name="btningresar" value="Guardar Cambios" />


            </form>

        </fieldset>
    </section>

<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>