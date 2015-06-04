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
        <h1>Editar asignacion de catedras a profesores</h1>
        <form action="<?php echo base_url(); ?>backend/asigcatedras_control/editar_asigcatedra" method="post">

            <label name="lbl_profesor">Profesor:</label><p></p>
            <select   class="chosen"   name="SELprofe"  id="chosen" data-placeholder="Seleccione el Profesor..."  required="" style="width: 200px;"> 

                <?php
                foreach ($arrDatosprofe as $i => $profe)
                    echo '<option values="', $i, '">', $profe, '</option>';
                ?> 

            </select>
            <p></p> 
            <label name="lbl_idcatedra">Catedra Actual :</label>
            <select class="chosen" name="cat_denominacion_vieja" data-placeholder="Seleccione Catedras..." required=" " style="width: 200px;">
                <?php
                foreach ($arrDatoscatedra as $i => $catedra)
                    echo '<option values="', $i, '">', $catedra, '</option>';
                ?> 
            </select>
            <p></p>
             <label name="lbl_idcatedra">Catedra Nueva:</label>
             <select class="chosen" name="cat_denominacion_nueva" data-placeholder="Seleccione Catedras..." required=" " style="width: 200px;">
                <?php
                foreach ($arrDatoscatedra as $i => $catedra)
                    echo '<option values="', $i, '">', $catedra, '</option>';
                ?> 
            </select>
            <a href="<?php echo base_url() ?>backend/inscatedras_control/catedra">Insertar una Nueva Catedra</a>
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
              <input type="hidden" name="grabar" value="si" />
            <input type="submit" name="btnguardarplan" value="Guardar" />



        </form>

    </fieldset>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>