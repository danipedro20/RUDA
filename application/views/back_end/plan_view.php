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
            <h1>Agregar Cátedras al Plan de Estudio</h1>
            <form action="<?php echo base_url(); ?>backend/planestudio_control/plan_estudio" method="post">
                <label for="lbl_plan">Plan de Estudio</label>
                <div class="wrapper">
                    <input type="text" name="selplan" id="selplan" maxlength="50" required="" onpaste="return false" class="autocompletar" placeholder="Escribe el Plan" />
                    <a href="<?php echo base_url() ?>backend/insplan_control/planestudio/">Insertar Plan</a>
                    <div class="contenedo"></div>
                </div>




                <label name="lbl_idplan">Nombre de la Cátedra:</label><p></p>
                <select   name="catedra"  id="catedra" data-placeholder="Seleccione la Catedra..."  required="" style="width: 350px;"> 
                    <option value="0">Seleccione una Catedra 
                        <?php foreach ($arrDatoscate as $i) : ?>
                        <option value="<?php echo $i->idcatedra ?>"><?php echo $i->cat_denominacion ?>
                        </option><?php endforeach; ?>
                </select>
              <a href="<?php echo base_url() ?>backend/inscatedras_control/catedra">Insertar una Nueva Catedra</a>
              <p></p>
              <label for="lbl_dias">Dias de Catedra: </label>
            <input type="text" name="diascatedra" id="diascatedra" placeholder="Ingrese el Dia" required="required" value='<?php echo set_value('diascatedra') ?>'/>
                
                
                
                
                <input type="submit" name="btnguardarplan" value="Guardar" />



            </form>

        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
