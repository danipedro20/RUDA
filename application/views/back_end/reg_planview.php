<section class="contenido">

<form action="<?php echo base_url(); ?> /backend/reg_plan/insertar_plan" method="post">
        
    <h2>Plan de Estudio</h2>
    
    <fieldset>
            
            <label for="lbl_plannombre">Nombre del Plan: </label>
            <input type="text" name="inp_nombreplan" placeholder="Nombre del Plan de Estudio" required="" />

            <input type="submit" value="Guardar" />

        </fieldset>
</form>

</section>

