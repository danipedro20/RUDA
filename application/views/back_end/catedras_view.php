<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>
  
<section class="contenido">


    <fieldset>
        <h1>Crear Catedra</h1>
        <?php echo form_open("backend/inscatedras_control/insercatedra") ?>

        <label name="lbl_cat_denominacion">Nombre de Catedra: </label>
        <input type="text" name="cat_denominacion" placeholder="Nombre de catedra" required="" value='<?php echo set_value('cat_denominacion') ?>' />
        <label name="lbl_cat_diascatedra">Dias de catedra </label>
        <input type="text" name="cat_diascatedra" placeholder="Dia de Catedra" required="" value='<?php echo set_value('cat_diascatedra') ?>' />
         
        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btnguardar" value="Guardar" />

        <?php echo form_close() ?> 

    </fieldset>
</section>
<?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>