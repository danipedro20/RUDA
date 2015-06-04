<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">


        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.css"/>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.jquery.min.js"></script>
        <script>



            jQuery(document).ready(function() {
                jQuery(".chosen").chosen();
            });



        </script>
        <fieldset>
            <h2> Editar Aula</h2>
            <?php echo form_open("backend/reg_aula/editar_aula") ?>
            <label for="lbl_aulanombre">Nombre Actual: </label>
            <input type="text" name="aul_denominacion" id="inp_nombreaula" placeholder="Nombre del Aula" required=""  value='<?php echo set_value('aul_denominacion') ?>'/>
             <label for="lbl_aulanombre">Nombre Nuevo: </label>
            <input type="text" name="nvo_aul_denominacion" id="inp_nombreaula" placeholder="Nombre del Aula" required=""  value='<?php echo set_value('nvo_aul_denominacion') ?>'/>

            <label for="lbl_plazahabilitada">Plaza Habilitadas: </label>
            <input type="text" name="aul_plazahabilitada" id="inp_plazahabilitada" placeholder="Ingrese los lugares habilitados" required="required" value='<?php echo set_value('aul_plazahabilitada') ?>'/>

            <label for="lbl_carrera">Carrera: </label>
            <select   class="chosen"   name="selCarreras"  id="chosen" data-placeholder="Seleccione el Plan..."  required="" style="width: 200px;"> 

                <?php
                foreach ($arrDatoscarreras as $i => $carrera)
                    echo '<option values="', $i, '">', $carrera, '</option>';
                ?> 
            </select>   <a href="<?php echo base_url() ?>backend/carreras_control/carreras/">Insertar una nueva carrera</a>
            <p></p><p></p>
            <label for="lbl_plan">Plan de Estudio: </label>
            <select   class="chosen"   name="selplanes"  id="chosen" data-placeholder="Seleccione el Plan..."  required="" style="width: 200px;"> 

                <?php
                foreach ($arrDatosplanes as $i => $plan)
                    echo '<option values="', $i, '">', $plan, '</option>';
                ?> 
            </select>   <a href="<?php echo base_url() ?>backend/insplan_control/planestudio/">Insertar un Nuevo Plan</a>
            <p></p><p></p>
            <label for="idturno">Turno:</label>
            <select    name="idturno"  id="idturno" placeholder="Seleccione el Turno..."  required="" > 
                <option value="" selected="selected">Seleccione un Turno</option>
                <option value="1" <?php echo set_select('idturno', '1'); ?>>Mañana</option>
                <option value="2" <?php echo set_select('idturno', '2'); ?>>Tarde</option>
                <option value="3" <?php echo set_select('idturno', '3'); ?>>Noche</option>
            </select> 


            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <input type="submit" value="Guardar Cambios"  />
            <?php echo form_close() ?> 

        </fieldset>

    </form>

    </section>     


<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
