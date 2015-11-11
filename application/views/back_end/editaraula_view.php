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
            <h2> Editar Aula</h2>
            <form method="post">
                <label for="lbl_aulanombre">Nombre : </label>
                <input type="text" name="aul_denominacion" id="inp_nombreaula"  maxlength="30" required=""  value='<?php echo $aulas->aul_denominacion; ?>'/>
                <input type="hidden" name="idaula" id="idaula" value='<?php echo $aulas->idaula; ?>'/>
                <label for="lbl_plazahabilitada">Plaza Habilitadas: </label>
                <input type="text" name="aul_plazashabilitadas" id="aul_plazashabilitadas"  maxlength="2" required="required" value='<?php echo $aulas->aul_plazashabilitadas; ?>'/>
                <label for="lbl_plazadisponibles">Plaza Disponibles: </label>
                <input type="text" name="aul_plazasdisponibles" id="aul_plazasdisponibles"  maxlength="2" required="required" value='<?php echo $aulas->aul_plazasdisponibles; ?>'/>
                <label for="lbl_carrera">Carrera: </label>
                <select name='selcarrera' id='selcarrera'>
                    <option value="<?php echo $aulas->id_carrera ?>"><?php echo $aulas->car_denominacion ?></option>
                    <?php
                    foreach ($arrDatoscarreras as $car) :
                        if ($car->id_carrera != $aulas->id_carrera) {
                            ?>
                            <option value="<?php echo $car->id_carrera; ?>"><?php echo $car->car_denominacion; ?>

                            </option><?php }endforeach; ?>
                </select>
                <a href="<?php echo base_url() ?>backend/carreras_control/carreras/">Insertar carrera</a>

                <label for="lbl_plan">Plan de Estudio: </label>
                <select name='selplan' id='selplan'>
                    <option value="<?php echo $aulas->idplan ?>"><?php echo $aulas->pla_denominacion ?></option>
                    <?php
                    foreach ($arrDatosplanes as $pla) :
                        if ($pla->idplan != $aulas->idplan) {
                            ?>
                            <option value="<?php echo $pla->idplan ?>"><?php echo $pla->pla_denominacion ?>
                            </option><?php }endforeach; ?>    </select>
                <a href="<?php echo base_url() ?>backend/insplan_control/planestudio/">Insertar Plan</a>
                <p></p><p></p>
                <label for="idturno">Turno:</label>
                <select    name="idturno"  id="idturno" required="" > 
                    <option value="M" <?php echo set_select('idturno', 'M'); ?>>MAÑANA</option>
                    <option value="T" <?php echo set_select('idturno', 'T'); ?>>TARDE</option>
                    <option value="N" <?php echo set_select('idturno', 'N'); ?>>NOCHE</option>
                </select> 


                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />
                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/reg_aula/editar_aula"/>
                <input type="submit" name="cancelar" id="cancelar" value="Volver"  dir="<?php echo base_url(); ?>backend/reg_aula/listar_aulas"/>

                <?php echo form_close() ?> 
            </form>

        </fieldset>


    </section>     


    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
