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
            <h1>Editar Plan de Estudio</h1>
            <form method="post">
<?php
$a= $_SERVER['HTTP_REFERER'];
 $rest = substr($a, 0, -1);
?>
                <label name="lbl_pla_denominacion">Plan de Estudio: </label>
                <input type="text" name="pla_denominacion" id="pla_denominacion" placeholder="Nombre Actual del Plan de Estudio" required="" value='<?php if($rest=='http://'.$_SERVER['HTTP_HOST'] .'/backend/insplan_control/editar_plan_estudio/'){ echo set_value('pla_denominacion');}else{ echo $plan->pla_denominacion;; } ?>' />
                <input type="hidden" name="idplan" id="idplan" required="" value='<?php if($rest=='http://'.$_SERVER['HTTP_HOST'] .'/backend/insplan_control/editar_plan_estudio/'){ echo $id;}else{ echo $plan->idplan;} ?>' />

                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/insplan_control/editar_planestudio"/>

                <input type="submit" name="cancelar" id="cancelar" value="Cancelar"  dir="<?php echo base_url(); ?>backend/insplan_control/listar_plan_estudios/" />

            </form>

        </fieldset>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
