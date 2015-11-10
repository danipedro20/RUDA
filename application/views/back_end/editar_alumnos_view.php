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
        <?php if (!empty($alumnos)) : ?>
         <h1>Lista de Alumnos</h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Aula</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <tr>

                            <td><?= anchor(base_url() . 'backend/adhome/editar_alumnos/' . $alumno->idusuario, $alumno->usu_nombre) ?></td>
                            <td><?php echo $alumno->car_denominacion; ?></td><td><?php echo $alumno->aul_denominacion; ?></td>
                        <?php endforeach; ?></tr>
                </tbody>

            </table>
            <div id="boton1">
              <a href="<?php echo base_url() ?>backend/adhome/reporte_alumnos"  target="_blank">Generar Reporte</a>
                
            </div>
          
        <?php else : ?>
            <h1>No hay Alumnos</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

