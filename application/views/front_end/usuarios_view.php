<section class="contenido">
        <form name="form_inicio"  action="<?= base_url(); ?>frontend/usuarios_control/logueo_very" method="POST" >
            <label for="Usuario">Usuario</label>
            <input type="text" name="usunombre" placeholder="Usuario" <br/>
            <label for="Contraseña">Contraseña</label>
            <input type="password" name="usupass"  placeholder="Password"/> <br/>
            <input type="submit"value="loguin"name="loguin"/>     

        </form>
   <br/>
        <?= validation_errors(); ?>


</section>