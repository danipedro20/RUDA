<section class="contenido">

<!--<form action="/backend/reg_plan/insertarplan" method="POST">-->
        
    <fieldset>
        <h2>Plan de Estudio</h2>
        <?php echo form_open("backend/reg_plan/insertarplan") ?>
            
            <label name="lbl_plannombre">Nombre del Plan: </label>
            <input type="text" name="inp_nombreplan" placeholder="Nombre del Plan de Estudio" required="" value='<?php echo set_value('inp_nombreplan') ?>' />
            
            <!-- este input lo usaremos como referencia para la validacion -->
            <input type="hidden" name="grabar" value="si" />
            
            <!--            En esta linea estamos configurando como se va a mostrar el error si algo no esta bien-->
            <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>

            <input type="submit" name="btnguardarplan" value="Guardar" />
            
           <?php echo form_close() ?> 

    </fieldset>
<!--</form>-->

</section>

