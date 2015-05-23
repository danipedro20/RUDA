<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
        <section class="contenido">
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
            <form id="act" name="eliminarcatedra" method="POST" action="<?php echo base_url() ?>backend/reg_aula/eliminar_aula" onsubmit="return confirmation()">

                <fieldset>
                    <h2>AULA Eliminar</h2>
                    <label for="lbl_aulanombre">Nombre: </label>
                    <input type="text" name="aul_denominacion" id="inp_nombreaula" placeholder="Nombre del Aula" required=""  value='<?php echo set_value('aul_denominacion') ?>'/>

                  
                    <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                    <!-- este input lo usaremos como referencia para la validacion -->
                    <input type="hidden" name="grabar" value="si" />

                    <input type="submit" value="Eliminar"  />
                    <?php echo form_close() ?> 

                </fieldset>

            </form>

        </section>     


        <?php
    } else
        redirect(base_url('/frontend/usuarios_control/logueo/'));
    ?>
