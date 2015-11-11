
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">


        <script src="<?php echo base_url() ?>/assets/tabla/jquery.js"></script>
        <script src="<?php echo base_url() ?>/assets/tabla/data_table.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/tabla/data_table.css"/>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable({
                    "scrollX": true
                });
            });
        </script>
        <STYLE type="text/css">
            div.dataTables_wrapper {
                width: 800px;
                margin: 0 auto;
            }
        </style>
        <form  action="<?php echo base_url(); ?>backend/profesor_control/editar_puntaje" method="post">

            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Número de cedula</th>
                        <th>Tarea Denominación</th>
                        <th>Puntos Asignados</th>
                        <th>Puntos Logrados</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($lista as $i) : ?>
                        <tr>

                            <td><?php echo $i->usu_nombre; ?></td>
                            <td><?php echo $i->usu_nrocedula; ?></td>
                            <td><input type="text" name="tar_denominacion[]" id="tar_denominacion" value='<?php echo $i->tar_descripcion; ?>' style="width: 180px;" readonly=""/> </td>
                            <td><input type="text" name="tar_puntostarea[]" id="tar_puntostarea" value='<?php echo $i->puntos_asignados; ?>' style="width: 90px;" readonly="" /></td>
                            <td><input type="text" name="tar_puntoslogrados[]" id="tar_puntoslogrados" maxlength="2" value='<?php echo $i->puntos_logrados; ?>' style="width: 90px;" /></td>
                    <input type="hidden" name="id[]" id="id" value='<?php echo $i->id; ?>'/>


                <?php endforeach; ?>
            </tr>
                </tbody>

            </table>
            <input type="submit" name="guardar" id="guardar" value="Guardar Cambios"/>
        </form>

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
