<section class="contenido">
    <html>
        <header>
            <meta charset="utf-8"/>
            <title></title>
        </header>
        <body>
            <h1>Iniciar Sesion</h1>
            <form name="form_inicio" action="<?= base_url() . 'frontend/usuarios_control/inicio_very' ?>" method="POST">
                <label for="Usuario">Usuario</label>
                <input type="text" name="usunombre"/> <br/>
                <label for="Contraseña">Contraseña</label>
                <input type="password" name="usupass"/> <br/>
                <input type="submit"value="Entrar"name="submit_inicio"/>     
        </body>

        </form>
        <hr />
        <?= validation_errors(); ?>
    </html>
</section>