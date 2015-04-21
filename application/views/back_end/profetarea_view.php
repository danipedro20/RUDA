<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">

        <fieldset>
            <h1>Crear tarea</h1>
            <form action="<?php echo base_url(); ?>backend/profesor_control/tareas" method="post" enctype="multipart/form-data" >



                <label name="lbl_idcatedra">Seleccione el aula:</label>
                <select  required="" name="selAula" value='<?php echo set_value($i) ?>' >
                    <?php
                    foreach ($arrDatos as $i => $aula)
                        echo '<option values="', $i, '">', $aula, '</option>';
                    ?> 
                </select>  


                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'>      <?php
                if (isset($error)) {
                    echo $error;
                }
                ?></font>

                <input type="submit" name="btnguardarplan" value="Ir a Tareas" />


            </form>

        </fieldset>
    </section>

<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
