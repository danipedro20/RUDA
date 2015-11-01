<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script Language="JavaScript">
    if (history.forward(-1)) {
        history.replace(history.forward(-1));
    }
</script>

<?php
switch ($token) {

    case 'CADUCADO':
        ?>
        <section class="contenido">
            <h1>La URL de recuperacion de contraseña ya ha caducado </h1>
            <h3>Favor vuelva a generar el pedido<a href="<?php echo base_url() ?>frontend/recuperacion_control/recuperarconcorreo">Aqui</a>
        </section>
        <?php
        break;


    case 'OK':
        ?>
        <section class="contenido">
            <fieldset>
                <h1>Recuperacion de Contraseña</h1>

                <form method="post" action=" <?php echo base_url(); ?>frontend/recuperacion_control/cambiar">
                    <input type="hidden" name="token"  required="" id="token"  value="<?php echo $this->uri->segment(4); ?>" />
                    <label name="lbl_usu_pass">Contraseña Nueva: </label>
                    <input type="password" name="usu_passnuevo" placeholder="Contraseña Nueva" required="" id="usu_passnuevo" value='<?php echo set_value('usu_passnuevo') ?>' />
                    <!-- este input lo usaremos como referencia para la validacion -->
                    <input type="hidden" name="Guardar" value="si" />
                    <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                    <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

                    <input type="submit" name="btningresar" value="Cambiar" />


                </form>

            </fieldset>
        </section>

        <?php
        break;
    case 'NO EXISTE':
        ?>
        <section class="contenido">
            <h1>La URL de recuperacion de contraseña ya ha sido utilizado o no existe</h1>
            <h3>Favor vuelva a generar el pedido <a href="<?php echo base_url() ?>frontend/recuperacion_control/recuperarconcorreo">Aqui</a> </h3>
        </section>
        <?php
        break;
}
?>
      