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
<section class="contenido">
    <h1>Recuperar contraseña por:</h1>
    <h2><a href="<?php echo base_url() ?>frontend/recuperacion_control/recuperacion">Pregunta Secreta</a></h2>
    <h2><a href="<?php echo base_url() ?>frontend/recuperacion_control/recuperarconcorreo">Dirección de Correo</a></h2>
   
</section>
