<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#aula").change(function() {
                $("#aula option:selected").each(function() {
                    aula = $('#aula').val();
                    $.post("<?php echo base_url(); ?>backend/adhome/llenar", {
                        aula: aula
                    }, function(data) {
                        $("#carrera").html(data);
                    });
                });
            })
        });
    </script>
    <section class="contenido">

        <script>
            $(document).ready(function() {

                $("input[type=submit]").click(function() {
                    var accion = $(this).attr('dir');
                    $('form').attr('action', accion);
                    $('form').submit();
                });

            });
        </script>

        <form  method="post">

            <fieldset>
                <h2> Editar Datos</h2>
                <label for="lbl_Nommbre">Nombre: </label>
                <input type="text" name="usu_nombre" id="usu_nombre"  required=""  value='<?php echo $alum->usu_nombre; ?>'/>
                <input type="hidden" name="idusuario" id="usu_nombre"  required=""  value='<?php echo $alum->idusuario; ?>'/>

                <label for="lbl_aula">Aula: </label>
                <select name='aula' id='aula'>
                    <option value="<?php echo $alum->idaula ?>"><?php echo $alum->aul_denominacion ?>
                        <?php foreach ($arrDatosaulas as $au) : ?>
                        <option value="<?php echo $au->idaula ?>"><?php echo $au->aul_denominacion ?>
                        </option><?php endforeach; ?>
                </select> <p></p>
                <label for="lbl_carrera">Carrera: </label>
                <select name="carrera" id="carrera">
                    <option value="<?php echo $alum->idaula ?>"><?php echo $alum->car_denominacion ?>
                </select>






                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <!-- este input lo usaremos como referencia para la validacion -->

               <input type="hidden" name="grabar" value="si" />
                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/adhome/editar_datos"/>

                <input type="submit" name="cancelar" id="cancelar" value="Cancelar"  dir="<?php echo base_url(); ?>backend/adhome/mostrar_alumnos" />

            </fieldset>
        </form>
    </section>     


    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
