<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <section class="contenido">
            <script type="text/javascript">
                <!--
                function confirmation() {
                    if (confirm("Realmente desea eliminar esta carreras y todos los elementos relacionados con la Carrera ?"))
                    {
                        return true;
                    }
                    return false;
                }
    //-->
            </script>

            <fieldset>
                <h1>Eliminar Carreras</h1>
                 <form id="act" name="eliminarcatedra" method="POST" action="<?php echo base_url() ?>backend/carreras_control/eliminar_carrera" onsubmit="return confirmation()">

                <label name="lbl_car_denominacion">Nombre Actual  de la Carrera: </label>
                <input type="text" name="car_denominacion" placeholder="Nombre  de la carrera" required="" value='<?php echo set_value('car_denominacion') ?>' />



                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

                <input type="submit" name="btnguardar" value="Eliminar" />

              
                 </form>
            </fieldset>
        </section>
        <?php
    } else
        redirect(base_url('/frontend/usuarios_control/logueo/'));