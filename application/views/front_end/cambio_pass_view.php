<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script src="<?php echo base_url(); ?>assets/front_end/jquery/jquery.js"></script>
<script Language="JavaScript">
    if (history.forward(-1)) {
        history.replace(history.forward(-1));
    }
</script>
<section class="contenido">
    <fieldset>
        <?php if (!empty($pregunta)) : ?>


            <h1>Recuperacion de Contraseña</h1>

            <form method="post" action=" <?php echo base_url(); ?>frontend/recuperacion_control/recuperacioncontra">
                <label name="lbl_pregunta">Pregunta Secreta: </label>
                <?php foreach ($pregunta as $i) : ?>
                    <input type="text" name="recupregunta" placeholder="Pregunta Secreta" required="" id="recupregunta"  value='<?php echo $i->recupregunta; ?>' readonly="readonly"/>

                <?php endforeach; ?>


                <label name="lbl_respuesta">Respuesta Secreta: </label>
                <input type="text" name="respuesta" placeholder="Respuesta Secreta"  maxlength="15" required="" id="respuesta" value='<?php echo set_value('respuesta') ?>' />
                <label name="lbl_usu_pass">Contraseña Nueva: </label>
                <input type="password" name="usu_passnuevo" placeholder="Contraseña Nueva"  maxlength="15" required="" id="usu_passnuevo" value='<?php echo set_value('usu_passnuevo') ?>' />
                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="ingresar" value="si" />
                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

                <input type="submit" name="btningresar" value="Ingresar" />


            </form>
        <?php else : ?>
            <h2>No Tiene ningun correo asociado al sistema verifique su correo y vuelva a intentarlo 
            <a href="<?php echo base_url() ?>frontend/recuperacion_control/recuperacion">Aqui</a> </h2>
            
        <?php endif; ?>


    </fieldset>
</section>