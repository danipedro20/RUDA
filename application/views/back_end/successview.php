<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">

        <h2>Se ha insertado con Exito!!!</h2>
        <?php if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] . '/backend/adhome/registrar_profesores') { ?>
            <P ALIGN=CENTER><a href="<?php echo base_url() ?>backend/adhome/registrar_profesores">Insertar otro Profesor</a></p>
            <P ALIGN=CENTER><a href="<?php echo base_url() ?>backend/adhome/listar_profesores">Ir a Lista</a></p>
        <?php } if ($_SERVER['HTTP_REFERER'] == 'http://' . $_SERVER['HTTP_HOST'] .'/backend/baneo_control/baneo') { ?>
            <P ALIGN=CENTER><a href="<?php echo base_url() ?>backend/baneo_control/baneo">Insertar otro Registro</a></p>
           
        <?php } ?>

       

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>