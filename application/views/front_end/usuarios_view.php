<section class="contenido">

    
    <form name="form_inicio" action="<?= base_url() . 'frontend/usuarios_control/inicio_very' ?>" method="POST">
        <h2>Iniciar Sesion</h2>
        <label for="Usuario">Usuario</label>
        <input type="text" name="usunombre"/> <br/>
        <label for="Contraseña">Contraseña</label>
        <input type="password" name="usupass"/> <br/>
        <input type="submit"value="Entrar"name="submit_inicio"/>     

    </form>
   
    <?= validation_errors(); ?>

</section>