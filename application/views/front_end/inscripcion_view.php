<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.css"/>
<script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
<script src="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.jquery.min.js"></script>
<script>



    jQuery(document).ready(function() {
        jQuery(".chosen").chosen();
    });



</script>
<script Language="JavaScript">
    if (history.forward(-1)) {
        history.replace(history.forward(-1));
    }
</script>
<section class="contenido">
    <fieldset>
        <h1>Inscripción</h1>
        <?php echo form_open("frontend/registro_control/insertarinscri") ?>

        <label name="lbl_usu_nombre">Nombre/s y apellido/s: </label>
        <input type="text" name="usu_nombre" placeholder="Nombre" required="" value='<?php echo set_value('usu_nombre') ?>' />
        <label for="lbl_carrera">Carrera: </label>
        <select   class="chosen"   name="selCarreras"  id="chosen" data-placeholder="Seleccione la carrera..."  required="" style="width: 200px;"> 

            <?php
            foreach ($arrDatoscarreras as $i => $carrera)
                echo '<option values="', $i, '">', $carrera, '</option>';
            ?> </select><p></p>
        <label for="idturno">Turno:</label>
         <select   class="chosen"   name="idturno"  id="idturno" data-placeholder="Seleccione el Turno..."  required="" style="width: 200px;"> 
            <option value="" selected="selected">Seleccione un Turno</option>
            <option value="1" <?php echo set_select('idturno', '1'); ?>>Mañana</option>
            <option value="2" <?php echo set_select('idturno', '2'); ?>>Tarde</option>
            <option value="3" <?php echo set_select('idturno', '3'); ?>>Noche</option>
        </select> 
        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btnguardarplan" value="Inscribir" />

        <?php echo form_close() ?> 

    </fieldset>
</section>