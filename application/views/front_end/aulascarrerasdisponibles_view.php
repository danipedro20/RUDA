  <?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
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
    <?php if (!empty($listaaulas)) : ?>
        <h2 style="float: center;">Lista de Aulas (Click Sobre el Aula)</h2>
        <table id="example" class="display nowrap" cellspacing="0" width="100%">
            <thead>

                <tr>
                    <th>Aula</th>
                    <th>Plan de Estudio</th>
                    <th>Plazas Disponibles</th>
                    <th>Turno</th>

                </tr>

            </thead>

            <tbody>
                <?php foreach ($listaaulas as $lis) : ?>
                    <tr>

                        <td><?= anchor(base_url() . 'frontend/solicitud_control/solicitudregistro/' . $lis->idaula . '/' . $id . '/' . $lis->idplan, $lis->aul_denominacion) ?></td>
                        <td><?php echo $lis->pla_denominacion; ?></td>
                        <td><?php echo $lis->aul_plazasdisponibles; ?></td>
                        <?php if ($lis->idturno == 'M') { ?>
                            <td><?php echo'Manaña' ?></td>
                        <?php } elseif ($lis->idturno == 'T') { ?>
                            <td><?php echo'Tarde' ?></td>
                        <?php } elseif ($lis->idturno == 'N') { ?>
                              <td><?php echo'Noche' ?></td>
                        <?php }endforeach; ?></tr>
            </tbody>

        </table>
    <?php else : ?>
        <h1>No hay Aulas</h1>
    <?php endif; ?>
</section>




