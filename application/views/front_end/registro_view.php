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
</section>