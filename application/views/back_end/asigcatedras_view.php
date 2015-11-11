<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front_end/jquery/choosen/chosen.css"/>
        <script src="<?php echo base_url() ?>assets/front_end/jquery/jquery.js"></script>
        <script src="<?php echo base_url() ?>assets/front_end/jquery/choosen/chosen.jquery.min.js"></script>
    
        <script type="text/javascript">
            $(document).ready(function() {
                $("#profe").change(function() {
                    $("#profe option:selected").each(function() {
                        profe = $('#profe').val();
                        $.post("<?php echo base_url() ?>backend/asigcatedras_control/llenar", {
                            profe: profe
                        }, function(data) {
                            $("#catedra").html(data);
                        });
                    });
                })
            });
        </script>
        


        <fieldset>
            <h1>Asignar catedras a profesores</h1>
            <form action="<?php echo base_url(); ?>backend/asigcatedras_control/asignacion" method="post">


                <label name="lbl_profesor">Profesor:</label>
                <select  name="profe" id="profe" style="width: 300px;">
                    <option value="0">Selecione un Profesor</option>
                    <?php foreach ($arrDatosprofe as $profe) : ?>
                        <option value="<?php echo $profe->idusuario ?>"><?php echo $profe->usu_nombre ?>
                        </option><?php endforeach; ?>
                </select>
                <p></p> 
                <label name="lbl_idcatedra">Cátedras:</label>
                <select   name="catedra" id="catedra" data-placeholder="Seleccione Catedras..." required="" style="width: 350px;" >                        
                </select>
                <a href="<?php echo base_url() ?>backend/inscatedras_control/catedra">Insertar una Nueva Cátedra</a>
                <font color='red' style='font-weight: bold; font-size: 14px; text-decoration: underline'><?php echo validation_errors(); ?></font>
                <input type="hidden" name="grabar" value="si" />
                <input type="submit" name="btnguardarplan" value="Guardar" />



            </form>

        </fieldset>

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
