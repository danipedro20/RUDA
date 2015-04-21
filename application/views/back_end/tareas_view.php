<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if($this->session->userdata('nombre')){
?>
  
    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.css"/>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
        <script src="<?php echo base_url() ?>/assets/front_end/jquery-ui/jquery-ui.js"></script>
        <script>
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'yy/mm/dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);
            $(function() {
                $("#fecha").datepicker();
            });
        </script>

        <fieldset>
            <h1>Crear tarea</h1>
            <form action="<?php echo base_url(); ?>backend/profesor_control/insertarea" method="post" enctype="multipart/form-data" >

                <label name="lbl_tar_descripcion">Descripción de la Tarea:</label>
                <textarea name="tar_descripcion" id="tar_descripcion" cols="35" rows="10" required="" value='<?php echo set_value('tar_descripcion') ?>'></textarea>
                <label name="lbl_idcatedra">Catedra:</label>
                <select  required="" name="selCatedras" value='<?php echo set_value($i) ?>' >
                    <?php
                    foreach ($arrDatos as $i => $catedra)
                        echo '<option values="', $i, '">', $catedra, '</option>';
                    ?> 
                </select>  

                <label name="fecha">Fecha de entrega:</label>
                <input type="text" id="fecha" required="" name="fecha"  placeholder="Fecha de entrega" value='<?php echo set_value('tar_fecha entrega') ?>' />

                <label name="lbl_puntostarea">Puntos de la Tarea: </label>
                <input type="text" name="tar_puntostarea" placeholder="Puntos de la tarea" required="" value='<?php echo set_value('tar_puntostarea') ?>' />
                <label for="userfile">Archivo Adjunto:</label>
                <input type="file" name="userfile"  id="userfile" required=""/>
                
                <input type="hidden" id="aula" name="aula"  value='<?php echo $_POST['selAula']?>' />

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

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
