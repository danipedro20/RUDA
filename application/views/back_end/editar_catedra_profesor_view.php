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
            <h1>Editar Catedra/Profesor</h1>
            <form method="post">

                <label name="lbl_cat_denominacion">Nombre de Cátedra: </label>
                <input type="text" name="cate_denominacion" placeholder="Nombre Actual de catedra" required="" readonly="readonly" value='<?php echo $catedra_profesor->cat_denominacion; ?>' />
                <input type="hidden" name="idcatedra"  value='<?php echo $catedra_profesor->idcatedra; ?>' />
                
                <label for="lbl_profesor">Profesore: </label>
                <select name='selprofesor' id='selprofesor'>
                    <option value="<?php echo $catedra_profesor->idusuario ?>"><?php echo $catedra_profesor->usu_nombre ?></option>
                    <?php
                    foreach ($profesores as $i) :
                        if ($i->idusuario != $catedra_profesor->idusuario) {
                            ?>
                            <option value="<?php echo $i->idusuario ?>"><?php echo $i->usu_nombre ?>
                            </option><?php }endforeach; ?> 
                </select>
               
                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/inscatedras_control/editarcatedraprofesor"/>
                <input type="submit" name="cancelar" id="cancelar" value="Volver"  dir="<?php echo base_url(); ?>backend/planestudio_control/listar_catedras_planes"/>
            </form>

        </fieldset>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>