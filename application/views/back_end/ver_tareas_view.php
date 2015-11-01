<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">



        <h1>Seleccionar Datos </h1>
        <form action="<?php echo base_url(); ?>backend/profesor_control/listatareas" method="post">
            <label name="lbl_idcatedra">Seleccione el aula:</label>
            <select name='aula' id='aula'>
                <option value="">Seleccione un Aula
                    <?php foreach ($arrDatos as $i) : ?>
                    <option value="<?php echo $i->idaula ?>"><?php echo $i->aul_denominacion ?>
                    </option><?php endforeach; ?>
            </select>


            <label name="lbl_idcatedra">Catedra:</label>
            <select name='catedra' id='catedra' style="width: 300px;">
            </select>
            <input type="hidden" id="selaula2" name="selaula2"  value='<?php echo $b = $this->input->post('selaula'); ?>' /><br>  

            <label name="lbl_ver">Ver:</label>
            <SELECT  name='ver_rango' id='ver_rango' style='width: 200px;'><OPTION VALUE='1'>Activa</OPTION><OPTION VALUE='2'>Pendientes</OPTION><OPTION VALUE='3'>Todas</OPTION></SELECT>
            <input type="submit" name="btnguardarplan" value="Ir a Tareas" />



        </form>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#aula").change(function() {
                    $("#aula option:selected").each(function() {
                        aula = $('#aula').val();
                        $.post("<?php echo base_url() ?>backend/profesor_control/llenar", {
                            aula: aula
                        }, function(data) {
                            $("#catedra").html(data);
                        });
                    });
                })
            });
        </script>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>