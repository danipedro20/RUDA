<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>

<section class="contenido">


    <fieldset>
        <h1>Crear Plan de Estudio</h1>
        <?php echo form_open("backend/insplan_control/inserplan") ?>

        <label name="lbl_pla_denominacion">Nombre del Plan de Estudio: </label>
        <input type="text" name="pla_denominacion" placeholder="Nombre del Plan de Estudio" required="" value='<?php echo set_value('pla_denominacion') ?>' />
     
         
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