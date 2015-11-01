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
<script type="text/javascript" src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //comprobamos si el usuario existe en la base de datos
        $('#username').focusout(function() {
            if ($("#username").val().length < 2)
            {

            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>frontend/solicitud_control/comprobar_usuario_ajax",
                    data: "username=" + $('#username').val(),
                    beforeSend: function() {
                        $('#msgUsuario').html('<span>Verificando...</span>');
                    },
                    success: function(respuesta) {
                        if (respuesta == '<div style="display:none">1</div>')
                            $('#msgUsuario').html("<span style='color:#0f0'>Usuario disponible</span>");
                        else
                            $('#msgUsuario').html('<span style="color:#f00">Este Usuario ya esta siendo utilizado</span>');
                    }

                });
                return false;
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $('#email').focusout( function(){
        if( $("#email").val() == "" || !emailreg.test($("#email").val()) )
        {
            $('#msgEmail').html("<span style='color:#f00'>Ingrese un email correcto</span>");
        }else{
            $.ajax({
                type: "POST",
               url: "<?php echo base_url() ?>frontend/solicitud_control/comprobar_email_ajax",
                data: "email="+$('#email').val(),
                beforeSend: function(){
                    $('#msgEmail').html('Verificando...');
                },
                success: function( respuesta ){
                    if(respuesta == '<div style="display:none">1</div>')
                        $('#msgEmail').html("<span style='color:#0f0'>Email disponible</span>");
                    else
                        $('#msgEmail').html("<span style='color:#f00'> ESte Email Ya ESta siendo utilizado</span>");
                }
            });
            return false;
        }
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //comprobamos si el usuario existe en la base de datos
        $('#usu_nrocedula').focusout(function() {
            if ($("#usu_nrocedula").val().length < 2)
            {

            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>frontend/solicitud_control/comprobar_cedula_ajax",
                    data: "usu_nrocedula=" + $('#usu_nrocedula').val(),
                    beforeSend: function() {
                        $('#msgCedula').html('<span>Verificando...</span>');
                    },
                    success: function(respuesta) {
                        if (respuesta == '<div style="display:none">1</div>')
                            $('#msgCedula').html("<span style='color:#0f0'>Numero de Cedula Sin Coincidencias</span>");
                        else
                            $('#msgCedula').html('<span style="color:#f00">Este Numero de Cedula ya esta en Nuestros Registros</span>');
                    }

                });
                return false;
            }
        });
    });
</script>

<section class="contenido">
    <fieldset>
        <h1>Complete el Formulario de Inscripción</h1>
        <?php // if ($_SERVER['HTTP_REFERER'] != base_url('/frontend/registro_control/inscripcion')) { ?>
            <!--<h3 ALIGN = CENTER>Si aun no estas inscripto, Inscribete <a href = "<?php echo base_url() ?>frontend/registro_control/inscripcion">Aqui</a></h3>-->
        <?php // } ?>
        <?php echo form_open("frontend/solicitud_control/insertsolicitud")
        ?>
        <span id="msgUsuario"></span>
        <label name="lbl_usu_nombre">Nombre/s y Apellido/s: </label>
        <input type="text" name="username" id="username" placeholder="Nombre" required="" value='<?php echo set_value('username') ?>' /><br>
        <span id="msgCedula"></span>
        <label name="lbl_usu_nrocedula">Número de C.I: </label>
        <input type="text" name="usu_nrocedula" id="usu_nrocedula" placeholder="Número de C.I" required="" value='<?php echo set_value('usu_nrocedula') ?>' /><br>
        <label name="lbl_usu_direccion">Dirección: </label>
        <input type="text" name="usu_direccion" placeholder="Dirección" required="" value='<?php echo set_value('usu_direccion') ?>' /><br>
        <label name="lbl_usu_telefono">Teléfono: </label>
        <input type="text" name="usu_telefono" placeholder="Teléfono" required="" value='<?php echo set_value('usu_telefono') ?>' /><br>
        <span id="msgEmail"></span>
        <label name="lbl_usu_email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Email" required="" value='<?php echo set_value('email') ?>' /><br> 
        <label name="lbl_usu_pass">Contraseña: </label>
        <input type="password" name="usu_pass" placeholder="Contraseña" required="" value='<?php echo set_value('usu_pass') ?>' /><br>

        <label name="lbl_pregunta">Pregunta Secreta: </label>
        <input type="text" name="pregunta" placeholder="Pregunta Secreta" required="" value='<?php echo set_value('pregunta') ?>' /><br>
        <label name="respuesta">Respuesta Secreta: </label>
        <input type="password" name="respuesta" placeholder="Respuesta Secreta" required="" value='<?php echo set_value('respuesta') ?>' /> <br> 

        <input type="hidden" id="idcarrera" name="idcarrera"  value='<?php echo $idcarrera; ?>' /><br>
        <input type="hidden" id="idaula" name="idaula"  value='<?php echo $idaula; ?>' /><br>
         <input type="hidden" id="idplan" name="idplan"  value='<?php echo $idplan; ?>' /><br>

        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btnguardarplan" value="Enviar Solicitud" />

        <?php echo form_close() ?> 

    </fieldset>
</section>