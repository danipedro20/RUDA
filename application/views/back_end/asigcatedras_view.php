<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
   <?php if($this->session->userdata('nombre')){
?>
  
<section class="contenido">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.css"/>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/choosen/chosen.jquery.min.js"></script>


    <script>



        jQuery(document).ready(function() {
            jQuery(".chosen").chosen();
        });



    </script>
<fieldset>
        <h1>Asignar catedras a profesores</h1>
        <form action="<?php echo base_url(); ?>backend/asigcatedras_control/asignacion" method="post">

            <label name="lbl_profesor">Profesor:</label><p></p>
            <select   class="chosen"   name="SELprofe"  id="chosen" data-placeholder="Seleccione el Profesor..."  required="" style="width: 200px;"> 

                <?php
                foreach ($arrDatosprofe as $i => $profe)
                    echo '<option values="', $i, '">', $profe, '</option>';
                ?> 

            </select>
            <p></p> 
            <label name="lbl_idcatedra">Catedras:</label>
            <select class="chosen" name="chosen[]" data-placeholder="Seleccione Catedras..." required=" " style="width: 200px;" multiple="true">
                <?php
                foreach ($arrDatoscatedra as $i => $catedra)
                    echo '<option values="', $i, '">', $catedra, '</option>';
                ?> 
            </select>
            <a href="http://ruda.edu.py/backend/inscatedras_control/catedra">Insertar una Nueva Catedra</a>
            <input type="submit" name="btnguardarplan" value="Guardar" />



        </form>

    </fieldset>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>