<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<section class="contenido">

    <fieldset>
        <h1>Ingreso al Sistema</h1>

        <form method="post" action=" <?php echo base_url(); ?>frontend/usuarios_control/ingreso">


            <label name="lbl_usu_email">Email: </label>
            <input type="text" name="usu_email" placeholder="Correo" required="" id="usu_email" value="<?php echo set_value('usu_email') ?>" />
            <label name="lbl_usu_pass">Contraseña: </label>
            <input type="password" name="usu_pass" placeholder="Contraseña" required="" id="usu_pass" value='<?php echo set_value('usu_pass') ?>' />
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="ingresar" value="si" />
            <P ALIGN=RIGHT><a href="<?php echo base_url() ?>frontend/recuperacion_control/recuperacion">¿Has olvidado tu contraseña?</a></p>
            <P ALIGN=RIGHT><a href="<?php echo base_url() ?>frontend/verificacion_control/verificacion">¿Deseas cambiar tu contraseña?</a></p>
            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btningresar" value="Ingresar" />


        </form>

    </fieldset>
</section>




<<<<<<< HEAD
=======
=======
<section class="contenido">
        <form name="form_inicio"  action="<?= base_url(); ?>frontend/usuarios_control/logueo_very" method="POST" >
            <label for="Usuario">Usuario</label>
            <input type="text" name="usunombre" placeholder="Usuario" <br/>
            <label for="Contraseña">Contraseña</label>
            <input type="password" name="usupass"  placeholder="Password"/> <br/>
            <input type="submit"value="loguin"name="loguin"/>     

        </form>
   <br/>
        <?= validation_errors(); ?>


</section>
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
