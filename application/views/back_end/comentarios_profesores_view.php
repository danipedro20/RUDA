<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php
if ($this->session->userdata('nombre')) {

    if (!function_exists('convertDateTimetoTimeAgo')) {

        function convertDateTimetoTimeAgo($datetime) {

            $date = str_replace("-", "", substr($datetime, 0, 10));
            $time = str_replace(":", "", substr($datetime, 11, 5));

            //Fecha estilo TimeAgo
            return "<script>document.write(moment('$date$time', 'YYYYMMDDHHmm').fromNow());</script>";
        }

    }
    ?>
    <section class="contenido">
        <script type="text/javascript" src="<?= base_url() ?>/assets/moment.js"></script>
        <h2><?= $entry->tar_descripcion ?></h2>
        Fecha de Creación: <?= $entry->tar_fechaasignacion ?><p></p>
        Fecha de entrega: <?= $entry->tar_fechaentrega ?><p></p>
        Archivo Adjunto: <?= $entry->tar_nombrearchivo ?><p></p>
        <br />


        <?php if ($this->session->userdata('nombre')) : ?>
            Tu comentario: 
            <form action="<?php echo base_url(); ?>backend/profesor_control/comentario/" method="post" enctype="multipart/form-data" >
                <?= form_hidden('idtarea', $this->uri->segment(4)) ?>
               <textarea name="comentario" id="comentario" cols="35" rows="10" required="" value="" maxlength="150"></textarea>
                <p><label for="userfile">Adjuntar Archivo:</label>
                    <input type="file" name="userfile"  id="userfile"/>
                    <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?></font>
                    <?= form_submit('submit', 'Enviar') ?>
            </form>
        <?php endif; ?>
        <P ALIGN=RIGHT><a href="<?php echo base_url() ?>backend/profesor_control/vertareas">Volver a Tareas</a></p>
        <?php
        if (!empty($comments)) {
            echo '<h3>Comentarios</h3>';
            foreach ($comments as $comment)
                if ($comment->autor == $this->session->userdata('nombre') and($comment->ruta_archivo)=='NULL') {
                    echo '<h4>' . $comment->autor . '</h4>' .
                    $comment->comentario . '<br/> <p>' .
                    convertDateTimetoTimeAgo($comment->fecha)
                    ?>
                    <p><a href="<?php echo base_url() . 'backend/profesor_control/eliminarcomentario/' . $comment->idcomentario ?>" onclick="return confirm('¿Estás seguro que desea eliminar este Comentario?')">Eliminar Comentario</a>
                        <?php
                    } elseif ($comment->autor != $this->session->userdata('nombre') and ($comment->ruta_archivo)=='NULL') {
                        echo '<h4>' . $comment->autor . '</h4>' .
                        $comment->comentario . '<br/> <p>' .
                        convertDateTimetoTimeAgo($comment->fecha) . '<hr />';
                    } elseif ($comment->autor != $this->session->userdata('nombre') and ($comment->ruta_archivo)!='NULL') {
                        echo '<h4>' . $comment->autor . '</h4>' .
                        $comment->comentario . '<br/> <p>' .
                        convertDateTimetoTimeAgo($comment->fecha)
                        ?>
                    <p><a href="<?php echo base_url() . 'backend/profesor_control/descargar/' . $comment->idcomentario ?>">Descargar Adjunto</a>
                        <?php
                    }elseif ($comment->autor == $this->session->userdata('nombre')and($comment->ruta_archivo)!='NULL') {
                        echo '<h4>' . $comment->autor . '</h4>' .
                        $comment->comentario . '<br/> <p>' .
                        convertDateTimetoTimeAgo($comment->fecha)
                        ?>
                         <p aling="right"><a href="<?php echo base_url() . 'backend/profesor_control/eliminarcomentario/' . $comment->idcomentario ?>" onclick="return confirm('¿Estás seguro que desea eliminar este Comentario?')">Eliminar Comentario</a>
                         <p aling="left"><a href="<?php echo base_url() . 'backend/profesor_control/descargar/' . $comment->idcomentario ?>">Descargar Adjunto</a>
                        <?php
                    }
            } else
                echo '<h3>Sin Comentarios!</h3>';
            ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

