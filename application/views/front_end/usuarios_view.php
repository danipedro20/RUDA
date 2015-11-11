<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<section class="Ingreso">

    <fieldset>
        

        <form method="post" action=" <?php echo base_url(); ?>frontend/usuarios_control/ingreso">

            <h1>Ingreso al Sistema</h1>

            <label name="lbl_usu_email">Email: </label>
            <input type="text" name="usu_email" placeholder="Correo"  maxlength="30" required="" id="usu_email" value="<?php echo set_value('usu_email') ?>" />
            <label name="lbl_usu_pass">Contraseña: </label>
            <input type="password" name="usu_pass" placeholder="Contraseña"  maxlength="15" required="" id="usu_pass" value='<?php echo set_value('usu_pass') ?>' />
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="ingresar" value="si" />
            <P ALIGN=RIGHT><a href="<?php echo base_url() ?>frontend/recuperacion_control/formarecuperacion">¿Has olvidado tu contraseña?</a></p>
            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btningresar" value="Ingresar" /> <br>

            <a id="link_registrar" href="<?php echo base_url() ?>frontend/suscripcion_control/suscripcioncarreras">Registrarse</a>

        </form>


    </fieldset>
</section>