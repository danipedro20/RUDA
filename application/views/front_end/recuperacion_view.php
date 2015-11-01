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
    <h1>Recuperacion de Contraseña por pregunta Secreta</h1>

    <form method="post" action=" <?php echo base_url(); ?>frontend/recuperacion_control/recuperacion_pregunta">
        <label name="lbl_usu_email">Email: </label>
        <input type="email" name="usu_email" placeholder="Email" required="" id="usu_email" />
      
        <input type="hidden" name="ingresar" value="si" />
        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btningresar" value="Ingresar" />


    </form>

</fieldset>
</section>