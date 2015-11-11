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
        <script src="<?php echo base_url() ?>/assets/calendario/datapicker.js"></script>

        <fieldset>
            <h1>Suspención de Cuenta</h1>
            <form action="<?php echo base_url(); ?>backend/baneo_control/inserbaneo" method="post"  >


                <label name="lbl_bamotivo">Motivo de Suspención:</label>
                <input  type="text" name="bamotivo" id="bamotivo" cols="35" rows="10"  placeholder="Motivo de suspención"  maxlength="45" required="" value='<?php echo set_value('bamotivo') ?>'>
                <label name="lbl_usu_correo">Correo del Usuario:</label>
                <select name='idusuario' id='idusuario'>
             
                    <?php foreach ($arrDatosusuario as $i) : ?>
                    <option value="<?php echo $i->idusuario; ?>"><?php echo $i->usu_email; ?>

                    </option><?php endforeach; ?>
            </select>

                <label name="fecha">Fecha de fin de la Suspención:</label>
                <input type="text" id="fecha" required="" name="fecha"  placeholder="Fecha Fin de suspención" value='<?php echo set_value('bafechafin') ?>' />

             

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
