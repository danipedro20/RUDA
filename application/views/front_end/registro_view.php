<section class="contenido">

<<<<<<< HEAD
    <form>
        <h2>Registrarse</h2>
        
        <label for="usunombre">Nombre:</label>
        <input type="text" name="usunombre"/> <br/>
=======
    <h1>Registrarse</h1>
    <?php if (isset($data)): ?>
        <h2>$data</h2>
    <?php endif; ?>
    <form name="form_registro" action="<?= base_url() . 'frontend/registro_control/registro_very' ?>" method="POST">
        <label for="usunombre"><?= @set_value('usunombre') ?>":</label>
        <input type="text" name="usunombre" value=" <?= @set_value('usunombre') ?>"/> <br/>
>>>>>>> 19def7aa8f496f7c0917d653a2c931e3eb2389a9

        <label for="usucedula">C.I. Nro.:</label>
        <input type="text" name="usunrocedula" value=" <?= @set_value('usunrocedula') ?>"/> <br/>

        <label for="usudireccion">Direccion:</label>
        <input type="text" name="usudireccion" value=" <?= @set_value('usudireccion') ?>"/> <br/>

        <label for="usutelefono">Telefono:</label>
        <input type="text" name="usutelefono" value=" <?= @set_value('usutelefono') ?>"/> <br/>

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
        <input type="text" name="usupassword" value=" <?= @set_value('usupassword') ?>"/> <br/>

        <input type="submit" value="Registrame" name="submit_registro"/>     
    </form>
    <br/>
    <?= validation_errors(); ?>
</section>