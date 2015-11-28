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
                    $.post('<?php echo base_url(); ?>backend/reg_aula/autocompletar', {info: info}, function(data) {

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
                    $("input[name=selplan]").val($(this).text());
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
    

        <fieldset>
            <h2>Crear Aula</h2>
            <?php echo form_open("backend/reg_aula/inseraula") ?>
            <label for="lbl_aulanombre">Nombre: </label>
            <input type="text" name="aul_denominacion" id="inp_nombreaula" placeholder="Nombre del Aula" required=""  maxlength="30" value='<?php echo set_value('aul_denominacion') ?>'/>

            <label for="lbl_plazahabilitada">Plazas Habilitadas: </label>
            <input type="text" name="aul_plazahabilitada" id="inp_plazahabilitada" placeholder="Ingrese los lugares habilitados" required="required" value='<?php echo set_value('aul_plazahabilitada') ?>'/>
            <p></p>
            <label for="lbl_carrera">Carrera: </label>
            <select name='selcarrera' id='selcarrera'>

                <?php foreach ($arrDatoscarreras as $car) : ?>
                    <option value="<?php echo $car->id_carrera; ?>"><?php echo $car->car_denominacion; ?>

                    </option><?php endforeach; ?>
            </select>   <a href="<?php echo base_url() ?>backend/carreras_control/carreras/">Insertar carrera</a>

            <label for="lbl_plan">Plan de Estudio</label>
            <div class="wrapper">
                <input type="text" name="selplan" id="selplan" maxlength="50" required="" onpaste="return false" class="autocompletar" placeholder="Escribe el Plan" />
                <a href="<?php echo base_url() ?>backend/insplan_control/planestudio/">Insertar Plan</a>
                <div class="contenedo"></div>
            </div>



            <label for="idturno">Turno:</label>
            <select    name="idturno"  id="idturno" placeholder="Seleccione el Turno..."  required="" > 
                <option value="" selected="selected">Seleccione un Turno</option>
                <option value="M" <?php echo set_select('idturno', 'M'); ?>>MAÑANA</option>
                <option value="T" <?php echo set_select('idturno', 'T'); ?>>TARDE</option>
                <option value="N" <?php echo set_select('idturno', 'N'); ?>>NOCHE</option>
            </select> 


            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />

            <input type="submit" value="Guardar"  />
            <?php echo form_close() ?> 

        </fieldset>

    </form>

    </section>     


    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
