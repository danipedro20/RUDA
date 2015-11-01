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
<!--
        <script>



            jQuery(document).ready(function() {
                jQuery(".chosen").chosen();
            });



        </script>-->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#plan").change(function() {
                    $("#plan option:selected").each(function() {
                        plan = $('#plan').val();
                        $.post("<?php echo base_url() ?>backend/planestudio_control/llenar", {
                            plan: plan
                        }, function(data) {
                            $("#catedra").html(data);
                        });
                    });
                })
            });
        </script>

        <fieldset>
            <h1>Agregar Cátedras al Plan de Estudio</h1>
            <form action="<?php echo base_url(); ?>backend/planestudio_control/plan_estudio" method="post">

                <label name="lbl_idplan">Nombre del Plan:</label><p></p>
                <select   name="plan"  id="plan" data-placeholder="Seleccione el Plan..."  required="" style="width: 350px;"> 
                     <option value="0">Seleccione un Plan 
                    <?php foreach ($arrDatosplan as $i) : ?>
                        <option value="<?php echo $i->idplan ?>"><?php echo $i->pla_denominacion ?>
                        </option><?php endforeach; ?>
                </select>
                <a href="<?php echo base_url() ?>backend/insplan_control/planestudio">Insertar un Nuevo Plan</a>
                <p></p> 
                <label name="lbl_idcatedra">Catedras:</label>
                <select   name="catedra" id="catedra" data-placeholder="Seleccione Catedras..." required=" " style="width: 350px;" >

                </select>
                <a href="<?php echo base_url() ?>backend/inscatedras_control/catedra">Insertar una Nueva Catedra</a>
                <input type="submit" name="btnguardarplan" value="Guardar" />



            </form>

        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
