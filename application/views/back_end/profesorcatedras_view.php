<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <h1>Listar Alumnos </h1>
        <form action="<?php echo base_url(); ?>backend/profesor_control/lista" method="post">
            <label name="lbl_idcatedra">Catedra:</label>
            <select name='catedras' id='catedras'><?php foreach ($arrDatosc as $catedra) : ?>
                    <option value="<?php echo $catedra->idcatedra ?>"><?php echo $catedra->cat_denominacion ?>
                    </option><?php endforeach; ?>
            </select>
            <p></p><p></p>
            <label name="lbl_idcatedra">Seleccione el aula:</label>
            <select name='selaula' id='selaula'><?php foreach ($arrDatos as $catedra) : ?>
                    <option value="<?php echo $catedra->idaula ?>"><?php echo $catedra->aul_denominacion ?>
                    </option><?php endforeach; ?>
            </select>


            <input type="submit" name="btn" value="Ir a lista" />



        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>