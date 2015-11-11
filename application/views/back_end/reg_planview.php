<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>

<section class="contenido">

<!--<form action="/backend/reg_plan/insertarplan" method="POST">-->
        
    <fieldset>
        <h2>Plan de Estudio</h2>
        <?php echo form_open("backend/reg_plan/insertarplan") ?>
            
            <label name="lbl_plannombre">Nombre del Plan: </label>
            <input type="text" name="inp_nombreplan" placeholder="Nombre del Plan de Estudio"  maxlength="30" required="" value='<?php echo set_value('inp_nombreplan') ?>' />
            
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />
            
            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btnguardarplan" value="Guardar" />
            
           <?php echo form_close() ?> 

    </fieldset>
<!--</form>-->

</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

