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
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Catedra</th>
                        <th>Editar</th>
                        <th>Eliminar</th>


                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($lista as $i) : ?>
                        <tr>
                            <td><?php echo $i->cat_denominacion; ?></td>
                            <td><?= anchor(base_url() . 'backend/inscatedras_control/editar_catedra/' . $i->idcatedra, 'Editar') ?></td>
                            <td><a href="<?php echo base_url() . 'backend/inscatedras_control/eliminarcatedra/' . $i->idcatedra ?>" onclick="return confirm('¿Estás seguro que desea eliminar esta Cátedra?')">Eliminar</a></td> 
                        <?php endforeach; ?></tr>
                </tbody>

            </table>
        <button><a href="<?php echo base_url() ?>backend/inscatedras_control/reporte_catedras"  target="_blank">Generar Reporte</a></button>
        <?php else : ?>
            <h1>No hay Cátedras</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

