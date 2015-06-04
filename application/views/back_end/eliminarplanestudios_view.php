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
        <form id="act" name="eliminarplan" method="POST" action="<?php echo base_url() ?>backend/insplan_control/eliminar_planestudio" onsubmit="return confirmation()">

            <fieldset>
                <h1>Eliminar Plan de Estudios</h1>
                <label name="lbl_pla_denominacion">Nombre del Plan de estudios: </label>
                <input type="text" name="pla_denominacion" placeholder="Nombre del Plan de Estudios" required="" value='<?php echo set_value('pla_denominacion') ?>' />

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