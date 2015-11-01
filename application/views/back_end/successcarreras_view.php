<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">

        <?php if ($_SERVER['HTTP_REFERER'] == base_url('/backend/carreras_control/eliminarcarreras')) { ?>
            <h2>Se ha Eliminado  con Exito!!!</h2>
        <?php } elseif ($_SERVER['HTTP_REFERER'] == base_url('/backend/carreras_control/carreras')) { ?> 
            <h2>Se ha insertado con Exito!!!</h2>
        <P ALIGN=CENTER><a href="<?php echo base_url() ?>backend/carreras_control/carreras">Insertar otra carrera</a></p>
           
        <?php } elseif ($_SERVER['HTTP_REFERER'] == base_url('/backend/carreras_control/editarcarreras')) { ?> 
            <h2>Se ha Editado  con Exito!!!</h2> 
        <?php } ?>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

