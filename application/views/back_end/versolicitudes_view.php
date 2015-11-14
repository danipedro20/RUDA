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
        <?php if (!empty($generatetabla)) : ?>
        <h1>Lista de Solicitudes</h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Aula</th>
                        <th>Turno</th>
                        <th>Verificar</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($generatetabla as $soli) :
                        ?>

                        <tr>

                            <td><?php echo $soli->ins_nombre; ?></td>
                            <td><?php echo $soli->car_denominacion; ?></td>
                            <td><?php echo $soli->aul_denominacion; ?></td>
                             <?php if ($soli->ins_turno == 'M') { ?>
                            <td><?php echo'Manaña' ?></td>
                        <?php } elseif ($soli->ins_turno == 'T') { ?>
                            <td><?php echo'Tarde' ?></td>
                        <?php } elseif ($soli->ins_turno == 'N') { ?>
                              <td><?php echo'Noche' ?></td>
                               <?php } ?>
                            <td><?= anchor(base_url() . 'frontend/solicitud_control/verificarsolicitud/' . $soli->idinscripcion, 'Verificar') ?></td>
                        <?php endforeach; ?></tr>
                </tbody>

            </table>
        <?php else : ?>
            <h1>No hay Solicitudes</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

