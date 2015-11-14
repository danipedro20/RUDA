<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">

<!--
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.css"/>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.jquery.min.js"></script>
        <script>



            jQuery(document).ready(function() {
                jQuery(".chosen").chosen();
            });



        </script>-->
        <fieldset>
            <h2>Crear Aula</h2>
            <?php echo form_open("backend/reg_aula/inseraula") ?>
            <label for="lbl_aulanombre">Nombre: </label>
            <input type="text" name="aul_denominacion" id="inp_nombreaula" placeholder="Nombre del Aula" required=""  maxlength="30" value='<?php echo set_value('aul_denominacion') ?>'/>

            <label for="lbl_plazahabilitada">Plazas Habilitadas: </label>
            <input type="text" name="aul_plazahabilitada" id="inp_plazahabilitada" placeholder="Ingrese los lugares habilitados" required="required" value='<?php echo set_value('aul_plazahabilitada') ?>'/>
            <p></p>
            <label for="lbl_carrera">Carrera: </label>
             <select name='selcarrera' id='selcarrera'>
             
                    <?php foreach ($arrDatoscarreras as $car) : ?>
                    <option value="<?php echo $car->id_carrera; ?>"><?php echo $car->car_denominacion; ?>

                    </option><?php endforeach; ?>
            </select>   <a href="<?php echo base_url() ?>backend/carreras_control/carreras/">Insertar carrera</a>
            <p></p><p></p>
            <label for="lbl_plan">Plan de Estudio: </label>
            <select name='selplan' id='selplan'>
                    <?php foreach ($arrDatosplanes as $pla) : 
                       ?>
                
                    <option value="<?php echo $pla->idplan ?>"><?php echo $pla->pla_denominacion ?>
                    </option><?php endforeach; ?>    </select>   <a href="<?php echo base_url() ?>backend/insplan_control/planestudio/">Insertar Plan</a>
            <p></p><p></p>
            <label for="idturno">Turno:</label>
            <select    name="idturno"  id="idturno" placeholder="Seleccione el Turno..."  required="" > 
                <option value="" selected="selected">Seleccione un Turno</option>
                <option value="M" <?php echo set_select('idturno', 'M'); ?>>MAÑANA</option>
                <option value="T" <?php echo set_select('idturno', 'T'); ?>>TARDE</option>
                <option value="N" <?php echo set_select('idturno', 'N'); ?>>NOCHE</option>
            </select> 


            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <input type="submit" value="Guardar"  />
            <?php echo form_close() ?> 

        </fieldset>

    </form>

    </section>     


<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
