
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">
        <h2 ALIGN = CENTER> Perfil del Usuario </h2>
        <h4 ALIGN = Left >Nombre de Usuario:  <?php echo $this->session->userdata('nombre'); ?> </h4>
        <h4 ALIGN = Left >Número de C.I:  <?php echo $this->session->userdata('cedula'); ?> </h4>
        <h4 ALIGN = Left >Direccion:  <?php echo $this->session->userdata('direccion'); ?> </h4>
        <h4 ALIGN = Left >Correo:  <?php echo $this->session->userdata('email'); ?> </h4>
        <h4 ALIGN = Left >Número de Teléfono:  <?php echo $this->session->userdata('telefono'); ?> </h4>
           <?php if ($this->session->userdata('perfil') == 1) { ?>
         <h4 ALIGN = left ><a href="<?php echo base_url() ?>backend/adhome/editarperfil/" >Editar Perfil</a></h4>

    <?php } elseif ($this->session->userdata('perfil') == 2) { ?>
        <h4 ALIGN = left ><a href="<?php echo base_url() ?>backend/profesor_control/editarperfil/" >Editar Perfil</a></h4>
    <?php  } ?>
          


    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
