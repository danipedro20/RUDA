<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script Language="JavaScript">
    if (history.forward(-1)) {
        history.replace(history.forward(-1));
    }
</script>
<section class="contenido">
    <fieldset>
        <script>
            function justNumbers(e)
            {
                var keynum = window.event ? window.event.keyCode : e.which;
                if ((keynum == 8) || (keynum == 46))
                    return true;

                return /\d/.test(String.fromCharCode(keynum));
            }
        </script>

        <h1>Editar Perfil</h1>
        <?php
        if ($this->session->userdata('perfil') == 1) {
            echo form_open("backend/adhome/editar ");
        } elseif ($this->session->userdata('perfil') == 2) {
            echo form_open("backend/profesor_control/editar ");
        } elseif ($this->session->userdata('perfil') == 3) {
            echo form_open("backend/alumnos_control/editar ");
        }
        ?>
        <label name="lbl_usu_nombre">Nombre/s y Apellido/s: </label>
        <input type="text" name="usu_nombre" placeholder="Nombre" required=""  maxlength="30" value='<?php echo $this->session->userdata('nombre'); ?>' /><p></p>
        <label name="lbl_usu_direccion">Dirección: </label>
        <input type="text" name="usu_direccion" placeholder="Dirección"  maxlength="100"required="" value='<?php echo $this->session->userdata('direccion'); ?>' /><p></p>
        <label name="lbl_usu_telefono">Teléfono: </label>
        <input type="text" name="usu_telefono" placeholder="Teléfono"  maxlength="10" required="" onkeypress="return justNumbers(event);"value='<?php echo $this->session->userdata('telefono'); ?>' /><p></p>
        <label name="lbl_usu_email">Email: </label>
        <input type="email" name="usu_email" placeholder="Email" required=""  maxlength="30" value='<?php echo $this->session->userdata('email'); ?>' />
        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btnguardarplan" value="Guardar Cambios" />

        <?php echo form_close() ?> 

    </fieldset>
</section>