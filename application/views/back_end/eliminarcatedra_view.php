<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>


    <section class="contenido">
        <script type="text/javascript">
    <!--
            function confirmation() {
                if (confirm("Realmente desea eliminar?"))
                {
                    return true;
                }
                return false;
            }
    //-->
        </script>
        <form id="act" name="eliminarcatedra" method="POST" action="<?php echo base_url() ?>backend/inscatedras_control/eliminarcatedra" onsubmit="return confirmation()">

            <fieldset>
                <h1>Eliminar Catedra</h1
                <label name="lbl_cat_denominacion">Nombre de Catedra: </label>
                <input type="text" name="cat_denominacion" placeholder="Nombre de catedra" required="" value='<?php echo set_value('cat_denominacion') ?>' />

                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

                <input type="submit" name="btneliminar" value="Eliminar" />
            </fieldset>
        </form>
    </section>
<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>