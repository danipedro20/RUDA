<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>
  
<section class="contenido">


    <fieldset>
        <h1>Editar Catedra</h1>
        <?php echo form_open("backend/inscatedras_control/editarcatedra") ?>

        <label name="lbl_cat_denominacion">Nombre Actual de Catedra: </label>
        <input type="text" name="cate_denominacion" placeholder="Nombre Actual de catedra" required="" value='<?php echo set_value('cate_denominacion') ?>' />
         <label name="lbl_cat_denominacion">Nombre Nuevo de Catedra: </label>
        <input type="text" name="nvo_cat_denominacion" placeholder="Nombre Nuevo de catedra" required="" value='<?php echo set_value('nvo_cat_denominacion') ?>' />
        <label name="lbl_cat_denominacion">Dia de Catedra: </label>
        <input type="text" name="cat_diascatedra" placeholder="Dias de catedra" required="" value='<?php echo set_value('cat_diascatedra') ?>' />
         
        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

        <input type="submit" name="btneliminar" value="Editar" />

        <?php echo form_close() ?> 

    </fieldset>
</section>
<?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>