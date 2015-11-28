<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">

        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.css"/>
        <script src='<?php echo base_url() ?>/assets/autocompletado/jquery.js'></script>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>/assets/calendario/datapicker.js"></script>

        <script type="text/javascript">

            $(document).ready(function() {
                //utilizamos el evento keyup para coger la información
                //cada vez que se pulsa alguna tecla con el foco en el buscador
                $(".autocompletar").keyup(function() {

                    //en info tenemos lo que vamos escribiendo en el buscador
                    var info = $(this).val();
                    //hacemos la petición al método autocompletar del controlador autocompletado
                    //pasando la variable info
                    $.post('<?php echo base_url(); ?>backend/baneo_control/autocompletar', {info: info}, function(data) {

                        //si autocompletado nos devuelve algo
                        if (data != '')
                        {

                            //en el div con clase contenedor mostramos la info
                            $(".contenedo").html(data);

                        } else {

                            $(".contenedo").html('');

                        }
                    })

                })
                //buscamos el elemento pulsado con live y mostramos un alert
                $(".contenedo").find("a").live('click', function(e)
                {
                    e.preventDefault();
                    $("input[name=usuario]").val($(this).text());
                    $('.contenedo p').hide();
                });

            })
        </script>
        <style type="text/css">

            .wrapper{
                margin: auto;
                width: 500px;	 		
            }
            .autocompletar{
                border-radius: 5px;
                padding: 7px 2px;
                width: 300px;
                margin-bottom: 20px;
            }
            .contenedo p{
                font-size: 14px;
                background-color: #ca5d36;
                background-image: linear-gradient(90deg, transparent 50%, rgba(255,255,255,.5) 50%);
                background-size: 203px 203px;
                color: #fff;
                padding: 3px 2px;
                border: 1px solid #000;
                max-width: 300px;
                margin-top: -14px;
            }
            .contenedo p a{
                color: #fff;
                text-decoration: none;				
            }
        </style>
    </head>

    <fieldset>
        <h1>Suspención de Cuenta</h1>
        <form action="<?php echo base_url(); ?>backend/baneo_control/inserbaneo" method="post"  >


            <label name="lbl_bamotivo">Motivo de Suspención:</label>
            <input  type="text" name="bamotivo" id="bamotivo" cols="35" rows="10"  placeholder="Motivo de suspención"  maxlength="45" required="" value='<?php echo set_value('bamotivo') ?>'>
            <label name="lbl_usu_correo">Correo del Usuario:</label>
            <div class="wrapper">
                <input type="text" name="usuario" id="usuario" maxlength="30" onpaste="return false" class="autocompletar" placeholder="Escribe el correo" />
                <div class="contenedo"></div>
            </div>

            <label name="fecha">Fecha de fin de la Suspención:</label>
            <input type="text" id="fecha" required="" name="fecha"  placeholder="Fecha Fin de suspención" value='<?php echo set_value('bafechafin') ?>' />



            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'>      <?php
            if (isset($error)) {
                echo $error;
            }
            ?></font>

            <input type="submit" name="btnguardarplan" value="Guardar" />


        </form>

    </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
