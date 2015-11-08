<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script Language="JavaScript">
    if (history.forward(-1)) {
        history.replace(history.forward(-1));
    }
</script>


<section class="contenido">
    <fieldset>
        <h1>Formulario de Recuperacion</h1>
        <?php // if ($_SERVER['HTTP_REFERER'] != base_url('/frontend/registro_control/inscripcion')) { ?>
            <!--<h3 ALIGN = CENTER>Si aun no estas inscripto, Inscribete <a href = "<?php echo base_url() ?>frontend/registro_control/inscripcion">Aqui</a></h3>-->
        <?php // } ?>
        <?php echo form_open("backend/profesor_control/guardar_recuperacion")
        ?>
        <input type="hidden" name="idusuario" id="idusuario" placeholder="Email" required="" value='<?php echo $idusuario?>' /><br> 
        <label name="pregunta">Pregunta Secreta: </label>
        <select name='pregunta' id='pregunta'>
            <option value="Cual es tu heroe Favorito">Cual es tu heroe Favorito</option>
            <option value="El nombre de tu perro">El nombre de tu perro</option>
            <option value="El Apelllido de Soltera de tu madre">El Apelllido de Soltera de tu madre</option>
        </select>

        <label name="respuesta">Respuesta Secreta: </label>
        <input type="password" name="respuesta" placeholder="Respuesta Secreta" required="" value='<?php echo set_value('respuesta') ?>' /> <br> 

        <input type="hidden" id="idcarrera" name="idcarrera"  value='<?php echo $idcarrera; ?>' /><br>
        <input type="hidden" id="idaula" name="idaula"  value='<?php echo $idaula; ?>' /><br>
        <input type="hidden" id="idplan" name="idplan"  value='<?php echo $idplan; ?>' /><br>

        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btnguardarplan" value="Guardar" />

        <?php echo form_close() ?> 

    </fieldset>
</section>