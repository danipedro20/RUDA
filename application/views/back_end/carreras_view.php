<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">

<script type="text/javascript" src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //comprobamos si el usuario existe en la base de datos
        $('#car_denominacion').focusout(function() {
            if ($("#car_denominacion").val().length < 2)
            {

            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>backend/carreras_control/comprobar_carrera_ajax",
                    data: "car_denominacion=" + $('#car_denominacion').val(),
                    beforeSend: function() {
                        $('#msgUsuario').html('<span>Verificando...</span>');
                    },
                    success: function(respuesta) {
                        if (respuesta == '<div style="display:none">1</div>')
                            $('#msgUsuario').html("<span style='color:#0f0'>Nombre de Carrera disponible</span>");
                        else
                            $('#msgUsuario').html('<span style="color:#f00">Este Carrera ya esta en los registros</span>');
                    }

                });
                return false;
            }
        });
    });
</script>
        <fieldset>
            <h1>Crear Carreras</h1>
            <?php echo form_open("backend/carreras_control/insercarreras") ?>

            <label name="lbl_car_denominacion">Nombre de la Carrera: </label>
            <input type="text" name="car_denominacion" id="car_denominacion" placeholder="Nombre de la carrera" required="" value='<?php echo set_value('car_denominacion') ?>' />
            <input type="hidden"  id="dircarr" name="dircarr"  value= <?php echo $_SERVER['HTTP_REFERER']; ?>  />

            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btnguardar" value="Guardar" />

            <?php echo form_close() ?> 

        </fieldset>
    </section>
<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>