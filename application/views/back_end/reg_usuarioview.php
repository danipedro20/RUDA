<section class="contenido">

       
   <fieldset>
    <?php if (isset($data)): ?>
        
       <h2>$data</h2>
    
    <?php endif; ?>
    
       <form name="frmregistrousuario" action="" method="POST" id="frmUsuario">
        
        <h2>Registrarse</h2>
        
        <label for="usunombre">Nombre:</label>
        <input type="text" name="usunombre" value=" <?= @set_value('usunombre') ?>"/> <br/>

        <label for="usucedula">C.I. Nro.:</label>
        <input type="text" name="usunrocedula" value=" <?= @set_value('usunrocedula') ?>"/> <br/>

        <label for="usudireccion">Direccion:</label>
        <input type="text" name="usudireccion" value=" <?= @set_value('usudireccion') ?>"/> <br/>

        <label for="usutelefono">Telefono:</label>
        <input type="text" name="usutelefono" value=" <?= @set_value('usutelefono') ?>"/> <br/>

        <label for="usuemail">Email:</label>
        <input type="email" name="usuemail" value=" <?= @set_value('usuemail') ?>"/> <br/>

        <label for="Contraseña">Contraseña</label>
        <input type="password" name="usupassword" value=" <?= @set_value('usupassword') ?>"/> <br/>

        <input type="submit" value="Registrame" name="submit_registro"/> 
        
    </form>
    <br/>
    <?= validation_errors(); ?>

        </fieldset>

</section>

