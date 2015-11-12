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
        <?php if (!empty($lista)) : ?>
            <h1>Reportes de Tareas</h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Nro. de Tarea</th>
                        <th>Descripci&oacute;n</th>
                        <th>Fecha de Asignaci&oacute;n</th>
                        <th>Fecha de Entrega</th>
                        <th>Puntos de la Tarea</th>
                        <th>Catedra</th>
                        <th>Aula</th>
                        <th>Archivo</th>
                        <th>Creado por</th>
                        <th>Estado</th>

                    </tr>

                </thead>

                <tbody>
                    <?php
                    foreach ($lista as $i) :
                        $fecha_asig = $i->tar_fechaasignacion;
                        $fecha_entre = $i->tar_fechaentrega;
                        ?>
                        <tr>


                            <td><?php echo $i->idtarea; ?></td>
                            <td><?php echo $i->tar_descripcion; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($fecha_asig)); ?></td>
                            <td><?php echo date("d-m-Y", strtotime($fecha_entre)); ?></td>
                            <td><?php echo $i->tar_puntostarea; ?></td>
                            <td><?php echo $i->cat_denominacion; ?></td>
                            <td><?php echo $i->aul_denominacion; ?></td>
                            <?php if ($i->tar_nombrearchivo == 'NULL') { ?>
                                <td><?php echo 'Sin Archivo'; ?></td>
                            <?php } else { ?>
                                <td><?php echo $i->tar_nombrearchivo; ?></td>
                            <?php } ?>
                            <td><?php echo $i->usu_nombre; ?></td>
                            <td><?php echo $i->estado; ?></td>
                        <?php endforeach; ?></tr>
                </tbody>

            </table>





        <?php else : ?>
            <h1>No hay Tareas</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>