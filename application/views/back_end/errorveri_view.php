

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

    <h1>Contraseña o Email incorrecto</h1>
    <?php if ($this->session->userdata('perfil') == 1) { ?>
        <P ALIGN=CENTER><a href="<?php echo base_url(); ?>backend/verificacion_control/verificacionadmin">Volver a intentar</a></p>

    <?php } elseif ($this->session->userdata('perfil') == 2) { ?>
        <P ALIGN=CENTER><a href="<?php echo base_url(); ?>backend/verificacion_control/verificacionprofesor">Volver a intentar</a></p>
    <?php } elseif ($this->session->userdata('perfil') == 3) { ?>

        <P ALIGN=CENTER><a href="<?php echo base_url(); ?>backend/verificacion_control/verificacion">Volver a intentar</a></p>
    <?php } ?>
</section>
