<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <?php if ($_SERVER['HTTP_REFERER'] == base_url('/backend/insplan_control/eliminarplanestudio')) { ?>
            <h2>Se ha Eliminado  con Exito!!!</h2>
        <?php } elseif ($_SERVER['HTTP_REFERER'] == base_url('/backend/insplan_control/planestudio')) { ?> 
            <h2>Se ha insertado con Exito!!!</h2>
            <P ALIGN=CENTER><a href="<?php echo base_url(); ?>backend/planestudio_control/plan">Agregar Catedras a un Plan de Estudio</a></p>
            <P ALIGN=CENTER><a href="<?php echo base_url(); ?>backend/insplan_control/planestudio">Insertar otro Plan de Estudio</a></p>

        <?php } elseif ($_SERVER['HTTP_REFERER'] == base_url('/backend/insplan_control/editarplanestudio')) { ?> 
            <h2>Se ha Editado  con Exito!!!</h2> 
        <?php } ?>


    </section>
<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
