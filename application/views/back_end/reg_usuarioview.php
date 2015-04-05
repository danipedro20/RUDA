<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>

<<<<<<< HEAD
=======
=======
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
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

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

<<<<<<< HEAD
=======
=======
>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
