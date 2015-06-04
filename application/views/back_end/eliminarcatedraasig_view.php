<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
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
        <script type="text/javascript">
            <!--
          function confirmation() {
                if (confirm("Realmente desea eliminar?"))
                {
                    return true;
                }
                return false;
            }
    //-->
        </script>
        <fieldset>
            <form id="act" name="eliminarcatedra" method="POST" action="<?php echo base_url() ?>backend/asigcatedras_control/eliminar_catedras" onsubmit="return confirmation()">

                <h1>Eliminar Asignación de  catedras a profesores</h1>

                <label name="lbl_profesor">Profesor:</label><p></p>
                <select   class="chosen"   name="SELprofe"  id="chosen" data-placeholder="Seleccione el Profesor..."  required="" style="width: 200px;"> 

                    <?php
                    foreach ($arrDatosprofe as $i => $profe)
                        echo '<option values="', $i, '">', $profe, '</option>';
                    ?> 

                </select>
                <p></p> 
                <label name="lbl_idcatedra">Catedra:</label>
                <select class="chosen" name="cat_denominacion" data-placeholder="Seleccione Catedra..." required=" " style="width: 200px;">
                    <?php
                    foreach ($arrDatoscatedra as $i => $catedra)
                        echo '<option values="', $i, '">', $catedra, '</option>';
                    ?> 
                </select>
                <font color='red' style='font-weight: bold; font-size: 10px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <input type="hidden" name="grabar" value="si" />
                <input type="submit" name="btnguardarplan" value="Eliminar" />



            </form>

        </fieldset>
    </section>

<?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>