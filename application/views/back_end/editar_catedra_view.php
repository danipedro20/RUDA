<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

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

        <fieldset>
            <h1>Editar Catedra</h1>
            <form method="post">

                <label name="lbl_cat_denominacion">Catedra: </label>
                <input type="text" name="cate_denominacion" placeholder="Nombre Actual de catedra" required="" value='<?php echo $catedra->cat_denominacion; ?>' />
                <input type="hidden" name="idcatedra"  value='<?php echo $catedra->idcatedra; ?>' />
<!--                <label name="lbl_cat_denominacion">Dia de Catedra: </label>
                <input type="text" name="cat_diascatedra" placeholder="Dias de catedra" required="" value='<?php echo $catedra->cat_diascatedra; ?>' />-->

                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/inscatedras_control/editarcatedra"/>
                <input type="submit" name="cancelar" id="cancelar" value="Volver"  dir="<?php echo base_url(); ?>backend/inscatedras_control/listar_catedras"/>
            </form>

        </fieldset>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>