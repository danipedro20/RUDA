<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
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
        <h2>AULA</h2>
        <?php echo form_open("backend/reg_aula/inseraula") ?>
        <label for="lbl_aulanombre">Nombre: </label>
        <input type="text" name="aul_denominacion" id="inp_nombreaula" placeholder="Nombre del Aula" required=""  value='<?php echo set_value('aul_denominacion') ?>'/>

        <label for="lbl_plazaDisponible">Plaza Disponible: </label>
        <input type="text" name="aul_plazadisponible" id="inp_plazadisponible" placeholder="Ingrese los lugares Disponibles" required="required" value='<?php echo set_value('aul_plazadisponible') ?>'/>

        <label for="lbl_plazahabilitada">Plaza Habilitadas: </label>
        <input type="text" name="aul_plazahabilitada" id="inp_plazahabilitada" placeholder="Ingrese los lugares habilitados" required="required" value='<?php echo set_value('aul_plazahabilitada') ?>'/>

        <label for="lbl_carrera">Carrera: </label>
       <select   class="chosen"   name="selCarreras"  id="chosen" data-placeholder="Seleccione el Plan..."  required="" style="width: 200px;"> 
            
            <?php
            foreach ($arrDatoscarreras as $i => $carrera)
                echo '<option values="', $i, '">', $carrera, '</option>';
            ?> 
       </select>  <p></p>
        <label for="lbl_plan">Plan de Estudio: </label>
            <select   class="chosen"   name="selplanes"  id="chosen" data-placeholder="Seleccione el Plan..."  required="" style="width: 200px;"> 
          
            <?php
            foreach ($arrDatosplanes as $i => $plan)
                echo '<option values="', $i, '">', $plan, '</option>';
            ?> 
        </select>   <p></p>
              <label name="lbl_alunmos">alunmos:</label>
               <p></p>
            <select class="chosen" name="chosen[]" data-placeholder="Seleccione Alunmos..." required=" " style="width: 200px;" multiple="true">
              
                <?php
                foreach ($arrDatosalumnos as $i => $alumno)
                    echo '<option values="', $i, '">', $alumno, '</option>';
                ?> 
            </select>
        <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
        <!-- este input lo usaremos como referencia para la validacion -->
        <input type="hidden" name="grabar" value="si" />

        <input type="submit" value="Guardar"  />
        <?php echo form_close() ?> 

    </fieldset>

</form>

</section>     


   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
<<<<<<< HEAD
=======
=======
<section class="contenido">
   
    <form action="reg_aula.php" method="post" id="frmAula">
        <h2>AULA</h2>
        <fieldset>
            <label for="lbl_aulanombre">Nombre: </label>
            <input type="text" name="inp_nombreaula" id="inp_nombreaula" placeholder="Nombre del Aula" required="" />

            <label for="lbl_plazaDisponible">Plaza Disponible: </label>
            <input type="number" name="inp_plazadisponible" id="inp_plazadisponible" placeholder="Ingrese un Numero" required="required"/>

            <label for="lbl_plazahabilitada">Plaza Disponible: </label>
            <input type="number" name="inp_plazahabilitada" id="inp_plazahabilitada" placeholder="Ingrese un Numero" required="required"/>

            <label for="lbl_carrera">Carrera: </label>
            <select>
                <option value="html">HTML</option>
                <option value="css">CSS</option>
                <option value="js">JavaScript</option>
                <option value="php">PHP</option>
            </select>
            
            <label for="lbl_plan">Plan de Estudio: </label>
            <select>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <input type="submit" value="Guardar" />

        </fieldset>

    </form>
       
  </section>     


>>>>>>> 587a410884994d81ace192363fd4848d379c6813
>>>>>>> 9b7466f99ed7079b09a3a81382941caba8394de9
