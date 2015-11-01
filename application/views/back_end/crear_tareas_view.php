<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.css"/>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>/assets/calendario/datapicker.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#aula").change(function() {
                    $("#aula option:selected").each(function() {
                        aula = $('#aula').val();
                        $.post("<?php echo base_url() ?>backend/profesor_control/llenar", {
                            aula: aula
                        }, function(data) {
                            $("#catedra").html(data);
                        });
                    });
                })
            });
        </script>

        <fieldset>
            <h1>Crear tarea</h1>
            <form action="<?php echo base_url(); ?>backend/profesor_control/insertarea" method="post" enctype="multipart/form-data" >

                <label name="lbl_tar_descripcion">Descripción de la Tarea:</label>
                <textarea name="tar_descripcion" id="tar_descripcion" cols="35" rows="10" required="" value='<?php echo set_value('tar_descripcion') ?>'></textarea>
                <label name="lbl_idcatedra">Seleccione el aula:</label>
                <select name='aula' id='aula'>
                    <option value="">Seleccione un Aula
                        <?php foreach ($arrDatos as $i) : ?>
                        <option value="<?php echo $i->idaula ?>"><?php echo $i->aul_denominacion ?>
                        </option><?php endforeach; ?>
                </select>
                <label name="lbl_idcatedra">Catedra:</label>
                <select name='catedra' id='catedra' required="">

                </select><p></p>

                <label name="fecha">Fecha de entrega:</label>
                <input type="text" id="fecha" required="" name="fecha"  placeholder="Fecha de entrega" value='<?php echo set_value('tar_fecha entrega') ?>' />

                <label name="lbl_puntostarea">Puntos de la Tarea: </label>
                <input type="text" name="tar_puntostarea" placeholder="Puntos de la tarea" required="" value='<?php echo set_value('tar_puntostarea') ?>' />
                <label for="userfile">Archivo Adjunto:</label>
                <input type="file" name="userfile"  id="userfile"/>


                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'>      <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></font>

                <input type="submit" name="btnguardarplan" value="Guardar" />


            </form>

        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
