
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
        <?php if (!empty($arrDatostar)) : ?>
        <h1>Lista de Tareas</h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Descripción de la Tarea</th>
                        <th>Fecha de asignación</th>
                        <th>Fecha de Entrega</th>
                        <th>Puntos</th>
                        <th>Descarga</th>
                        <th>Comentarios</th>
                        <th>Puntos Logrados</th>

                    </tr>

                </thead>

                <tbody>
                    <?php
                    $a = $this->session->userdata('id');
                    foreach ($arrDatostar as $tarea) :
                        ?>

                        <tr>
                            <?php
                            $query = $this->db->query("select * from comments where idtarea='$tarea->idtarea';");
                            $consulta = $this->db->query("select * from notas_tarea where idtarea='$tarea->idtarea' and idusuario='$a';");
                            $row = $consulta->row();
                            ?>

                            <td><?php echo $tarea->tar_descripcion; ?></td>
                            <td><?php
                                $fechainicio = $tarea->tar_fechaasignacion;
                                echo date("d-m-Y", strtotime($fechainicio));
                                ?></td>
                            <td><?php
                                $fechafin = $tarea->tar_fechaentrega;
                                echo date("d-m-Y", strtotime($fechafin));
                                ?>
                            </td>
                            <td>

                                <?php echo $tarea->tar_puntostarea; ?>

                            </td>
                            <?php if ($tarea->tar_nombrearchivo == 'NULL') { ?>
                                <td><?php echo 'Sin Archivo'; ?></td>
                            <?php } else { ?>
                                <td><?= anchor(base_url() . 'backend/alumnos_control/descargar_archivo/' . $tarea->idtarea, 'Descargar Adjunto') ?></td>
                            <?php } ?>
                            <td><?= anchor(base_url() . 'backend/alumnos_control/ver_comentarios/' . $tarea->idtarea, 'Click para ver los Comentarios') ?><?php echo '(' . $query->num_rows() . ')' ?></td>

                            <?php if (empty($row->puntos_logrados)) { ?>
                                <td><?php echo 'Sin Correguir'; ?></td>
                            <?php } else { ?>
                                <td><?php echo ($row->puntos_logrados); ?></td>
                            <?php } ?>
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