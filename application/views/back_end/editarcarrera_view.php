<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
  

    <section class="contenido">
          <script>
        $(document).ready(function() {

            $("input[type=submit]").click(function() {
                var accion = $(this).attr('dir');
                $('form').attr('action', accion);
                $('form').submit();
            });

        });
    </script>


        <fieldset>
            <form method="post">
                <h1>Editar Carrera</h1>


                <label name="lbl_car_denominacion">Nombre: </label>
                <input type="text" name="car_denominacion" placeholder="Nombre Actual de la carrera" required="" value='<?php echo $carrera->car_denominacion; ?>' />
                <input type="hidden" name="id_carrera" id="id_carrera" required="" value='<?php echo $carrera->id_carrera; ?>' />

                <!-- este input lo usaremos como referencia para la validacion -->
                <input type="hidden" name="grabar" value="si" />

                <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <input type="submit" name="guardarcambios" id="guardarcambios" value="Guardar Cambios"  dir="<?php echo base_url(); ?>backend/carreras_control/editar_carrera/"/>

                <input type="submit" name="cancelar" id="cancelar" value="Cancelar"  dir="<?php echo base_url(); ?>backend/carreras_control/vercarreras/" />


            </form> 

        </fieldset>
    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));