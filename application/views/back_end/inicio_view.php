
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">
       
            <h1> Sección en Construcción </h1>
            <h3 ALIGN = CENTER > Bienvenido:  <?php echo $this->session->userdata('nombre'); ?> </h3>
            <h3 ALIGN = CENTER > Perfil:  <?php echo $this->session->userdata('perfil'); ?> </h3>
            <h3 ALIGN = CENTER > id:  <?php echo$this->session->userdata('id');; ?> </h3>


        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
