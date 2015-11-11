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
            <h1>Generar Reportes de Asistencias</h1>
            <form action="<?php echo base_url(); ?>backend/profesor_control/generar_reporte_tareas" method="post" target="_blank">
                <label name="lbl_idcatedra">Seleccione el aula:</label>
                <select name='aula' id='aula'>
                    <option value="">Seleccione un Aula
                        <?php foreach ($arrDatos as $i) : ?>
                        <option value="<?php echo $i->idaula ?>"><?php echo $i->aul_denominacion ?>
                        </option><?php endforeach; ?>
                </select>
                <label name="lbl_idcatedra">Cátedra:</label>
                <select name='catedra' id='catedra' required="">

                </select><p></p>

                <label name="fecha">Mes:</label>
                <select name='mes' id='mes'>
                    <option value="">Seleccione un mes
                    <option value="1">Enero
                    <option value="2">Febrero
                    <option value="3">Marzo
                    <option value="4">Abril
                    <option value="5">Mayo
                    <option value="6">Junio
                    <option value="7">Julio
                    <option value="8">Agosto
                    <option value="9">Septiembre
                    <option value="10">Octubre
                    <option value="11">Noviembre
                    <option value="12">Diciembre

                    </option>
                </select>


                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'>      <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></font>

                <input type="submit" name="btnguardarplan"   value="Ir" />


            </form>

        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
