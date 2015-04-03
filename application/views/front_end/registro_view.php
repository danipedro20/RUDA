<<<<<<< HEAD
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
        <h1>Registrarse</h1>
        <?php echo form_open("frontend/registro_control/insertarregi") ?>

        <label name="lbl_usu_nombre">Nombre: </label>
        <input type="text" name="usu_nombre" placeholder="Nombre" required="" value='<?php echo set_value('usu_nombre') ?>' />
        <label name="lbl_usu_nrocedula">Número de C.I: </label>
        <input type="text" name="usu_nrocedula" placeholder="Número de C.I" required="" value='<?php echo set_value('usu_nrocedula') ?>' />
        <label name="lbl_usu_direccion">Dirección: </label>
        <input type="text" name="usu_direccion" placeholder="Dirección" required="" value='<?php echo set_value('usu_direccion') ?>' />
        <label name="lbl_usu_telefono">Teléfono: </label>
        <input type="text" name="usu_telefono" placeholder="Teléfono" required="" value='<?php echo set_value('usu_telefono') ?>' />
        <label name="lbl_usu_email">Email: </label>
        <input type="email" name="usu_email" placeholder="Email" required="" value='<?php echo set_value('usu_email') ?>' />
        <label name="lbl_usu_pass">Contraseña: </label>
         <input type="password" name="usu_pass" placeholder="Contraseña" required="" value='<?php echo set_value('usu_password') ?>' />
         <label for="idturno">Turno:</label>
         <select name="idturno" id="idturno" required="">
            <option value="" selected="selected">Seleccione un Turno</option>
            <option value="1" <?php echo set_select('idturno','1');?>>Mañana</option>
            <option value="2" <?php echo set_select('idturno','2');?>>Tarde</option>
            <option value="3" <?php echo set_select('idturno','3');?>>Noche</option>
        </select> 
        <label name="lbl_pregunta">Pregunta Secreta: </label>
        <input type="text" name="pregunta" placeholder="Pregunta Secreta" required="" value='<?php echo set_value('pregunta') ?>' />
        <label name="respuesta">Respuesta Secreta: </label>
        <input type="text" name="respuesta" placeholder="Respuesta Secreta" required="" value='<?php echo set_value('respuesta') ?>' />             
        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btnguardarplan" value="Guardar" />

        <?php echo form_close() ?> 

    </fieldset>
=======
<section class="contenido">

    <h1>Registrarse</h1>
    <?php if ($mensaje): ?>
        <h2><?= $mensaje ?>
        <?php endif; ?>
        <form name="form_registro" action="<?= base_url() . 'frontend/registro_control/registro_very' ?>" method="POST">
            <label for="usunombre">Nombre:</label>
            <input type="text" name="usunombre" value=" <?= @set_value('usunombre') ?>"/> <br/>

            <label for="usucedula">C.I. Nro.:</label>
            <input type="text" name="usunrocedula" value=" <?= @set_value('usunrocedula') ?>"/> <br/>

            <label for="usudireccion">Direccion:</label>
            <input type="text" name="usudireccion" value=" <?= @set_value('usudireccion') ?>"/> <br/>

            <label for="usutelefono">Telefono:</label>
            <input type="text" name="usutelefono" value=" <?= @set_value('usutelefono') ?>"/> <br/>
            <!--
                    <label for="usuemail">Email:</label>
                    <input type="email" name="usuemail"/> <br/>
            
                    <label for="usuperfil">Perfil:</label>
                    <select name="usuperfil"> 
                        <option value="alumno">Alumno</option>
                        <option value="profesor">Profesor</option>
                        <option value="admin">Administrador</option>
                    </select> <br/>
            
                    <label for="usuturno">Turno:</label>
                    <select name="usuturno"> 
                        <option value="Manana">Mañana</option>
                        <option value="tarde">Tarde</option>
                        <option value="noche">Noche</option>
            
                    </select><br/>-->
            <label for="usuemail">Email:</label>
            <input type="email" name="usuemail" value=" <?= @set_value('usuemail') ?>"/> <br/>

            <!--        <label for="usuperfil">Perfil:</label>
                    <select name="idperfil"> 
                        <option value=" //">Alumno</option>
                        <option value=" //">Profesor</option>
                        <option value=" //>">Administrador</option>
                    </select> <br/>
            
                    <label for="usuturno">Turno:</label>
                    <select name="idturno"> 
                        <option value="1">Mañana</option>
                        <option value="2">Tarde</option>
                        <option value="3">Noche</option>
            
                    </select><br/>-->

            <label for="Contraseña">Contraseña</label>
            <input type="pass" name="usupassword" value=" <?= @set_value('usupassword') ?>"/> <br/>


            <input type="submit" value="Registrame" name="submit_registro"/>     
        </form>
        <br/>
        <?= validation_errors(); ?>
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
</section>