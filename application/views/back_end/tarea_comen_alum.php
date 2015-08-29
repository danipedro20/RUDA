<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">

	<?php if (!empty($comentarios)) : ?>
		<?php foreach($comentarios as $entry) : ?>
			<h2><?=anchor(base_url().'backend/profesor_control/ver_comentarios/'.$entry->idtarea,$entry->tar_descripcion)?></h2>
			<br />
		<?php endforeach; ?>
	<?php else : ?>
		<h1>sin tareas</h1>
	<?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
