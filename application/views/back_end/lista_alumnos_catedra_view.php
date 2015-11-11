<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
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
        <h1>Listar Alumnos </h1>
        <form action="<?php echo base_url(); ?>backend/profesor_control/lista" method="post">


            <label name="lbl_idcatedra">Seleccione el aula:</label>
            <select name='aula' id='aula'>
                <option value="">Seleccione un Aula
                    <?php foreach ($arrDatos as $catedra) : ?>
                    <option value="<?php echo $catedra->idaula ?>"><?php echo $catedra->aul_denominacion ?>
                    </option><?php endforeach; ?>
            </select> <p></p><p></p>
            <label name="lbl_idcatedra">Cátedra:</label>
            <select name='catedra' id='catedra'>

            </select>


            <input type="submit" name="btn" value="Ir a lista" />



        </form>

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>