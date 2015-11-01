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
            <h1>Editar Catedra/Plan</h1>
            <form method="post">

                <label name="lbl_cat_denominacion">Nombre Actual de Catedra: </label>
                <input type="text" name="cate_denominacion" placeholder="Nombre Actual de catedra" required="" readonly="readonly" value='<?php echo $catedra_plan->cat_denominacion; ?>' />
                <input type="hidden" name="idcatedra"  value='<?php echo $catedra_plan->idcatedra; ?>' />
                <label for="lbl_profesor">Plan De Estudio: </label>
                <select name='selplan' id='selplan'>
                    <option value="<?php echo $catedra_plan->idplan ?>"><?php echo $catedra_plan->pla_denominacion ?></option>
                  <?php
                    foreach ($planes as $i) :
                        if ($i->idplan != $catedra_plan->idplan) {
                            ?>
                            <option value="<?php echo $i->idplan ?>"><?php echo $i->pla_denominacion ?>
                            </option><?php }endforeach; ?> 
                </select>


                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/planestudio_control/editarcatedraplan"/>
                <input type="submit" name="cancelar" id="cancelar" value="Volver"  dir="<?php echo base_url(); ?>backend/planestudio_control/listar_catedras_planes"/>
            </form>

        </fieldset>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>