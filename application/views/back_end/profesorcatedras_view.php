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
            <select    name="catedras"  data-placeholder="Seleccione el catedra..."  required=""> 

                <?php
                foreach ($arrDatosc as $i => $cate)
                    echo '<option values="', $i, '">', $cate, '</option>';
                ?> 

            </select>
            <p></p><p></p>
            <label name="lbl_idcatedra">Seleccione el aula:</label>
            <select  required="" name="selAula" value='<?php echo set_value($i) ?>' >
                <?php
                foreach ($arrDatos as $i => $aula)
                    echo '<option values="', $i, '">', $aula, '</option>';
                ?> 
            </select>  


            <input type="submit" name="btn" value="Ir a lista" />



        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>