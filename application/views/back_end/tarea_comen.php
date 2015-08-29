<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">

        <h2><?= anchor(base_url() . 'backend/profesor_control/ver_comentarios/' . $this->input->post('seltarea'), 'Click para ver los Comentarios') ?></h2>

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
