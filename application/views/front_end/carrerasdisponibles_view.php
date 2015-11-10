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
                width: 70%;
                margin: 0 auto;
            }
        </style>
        <?php if (!empty($arrDatoscarreras)) : ?>
        <h2 style="float: center;">Lista de Carreras (Para suscribirse, debe hacer click sobre la Carrera)</h2>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                     <th>Carreras</th>

                    </tr>

                </thead>

                <tbody>
                   <?php foreach ($arrDatoscarreras as $lis) : ?>
                                <tr>

                                    <td><h3 style="float:center;"><?= anchor(base_url().'frontend/suscripcion_control/suscripcionaulas/'.$lis->id_carrera,$lis->car_denominacion)?></h3></td>
                                <?php endforeach; ?></tr>
                </tbody>

            </table>
        <?php else : ?>
            <h1>No hay Carreras</h1>
        <?php endif; ?>
    </section>





