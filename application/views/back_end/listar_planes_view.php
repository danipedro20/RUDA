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
        <?php if (!empty($arrDatosplaca)) : ?>
        <h1>Lista de Planes/Cátedras</h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Plan de Estudio</th>
                        <th>Cátedra</th>
                        <th>Días Catedra</th>
                        <th>Editar</th>
                        <th>Eliminar</th>


                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($arrDatosplaca as $placa) : ?>
                                <tr>

                                    <td><?php echo $placa->pla_denominacion; ?></td>
                                    <td><?php echo $placa->cat_denominacion; ?></td>
                                    <td><?php echo $placa->diascatedra; ?></td>
                                    <td><?= anchor(base_url() . 'backend/planestudio_control/editar_catedras_planes/' . $placa->idcatedra . '/' . $placa->idplan, 'Editar') ?></td>
                                    <td><a href="<?php echo base_url() . 'backend/planestudio_control/eliminarasignacion/' . $placa->idcatedra . '/' . $placa->idplan ?>" onclick="return confirm('¿Estás seguro que desea eliminar esta Asignación?')">Eliminar</a></td>
                                <?php endforeach; ?></tr>
                </tbody>

            </table>
            <div id="boton1">
<a href="<?php echo base_url() ?>backend/planestudio_control/reporte_plan_catedra"  target="_blank">Generar Reporte</a>
                
            </div>
     
        <?php else : ?>
            <h1>No hay Asignaciones</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

