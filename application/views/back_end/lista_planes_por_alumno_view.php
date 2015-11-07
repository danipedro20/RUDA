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
        <?php if (!empty($plan)) : ?>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Aula</th>
                        <th>Carrera</th>
                        <th>Catedra</th>
                        <th>Dias de Catedra</th>
                        <th>Profesor</th>
                         <th>Ver Nota</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($plan as $alumno) : ?>
                        <tr>

                            <td><?php echo $alumno->aul_denominacion; ?></td>
                            <td><?php echo $alumno->car_denominacion; ?></td>
                            <td><?php echo $alumno->cat_denominacion; ?> </td>
                            <td><?php echo $alumno->diascatedra; ?> </td>
                            <td>
                                <?php
                                if (empty($alumno->usu_nombre)) {
                                    echo 'No Asignado';
                                } else {
                                    echo $alumno->usu_nombre;
                                }
                                ?>
                            </td>
                              <td><?= anchor(base_url() . 'backend/alumnos_control/ver_nota/'.$alumno->idcatedra.'/'.$alumno->idplan, 'Ver Nota') ?></td>
                            
                            

                        <?php endforeach; ?></tr>
                </tbody>

            </table>
        <?php else : ?>
            <h1>No hay Plan</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
