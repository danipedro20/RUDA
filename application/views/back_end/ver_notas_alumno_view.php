
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
            <h1> <?php echo $nombre->cat_denominacion; ?></h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Parcial</th>
                        <th>Recuperatorio</th>
                        <th>Primer Ordinario</th>
                        <th>Segundo Ordinario</th>
                        <th>Nota Ordinario</th>
                        <th>Complementario</th>
                        <th>Nota Complementario</th>
                        <th>Mesa Especial</th>
                        <th>Nota Mesa Especial</th>




                    </tr>

                </thead>

                <tbody>
                    <?php
                    foreach ($lista as $i) :
                        ?>
                        <tr>
                            <?php if (!empty($i->parcial)) { ?>
                                <td><?php echo $i->parcial; ?></td> 
                            <?php } else { ?>
                                <td><?php echo 'Sin Puntos'; ?></td> 
                            <?php } if (!empty($i->recuperatorio)) { ?>
                                <td><?php echo $i->recuperatorio; ?></td> 
                            <?php } else { ?>
                                <td><?php echo 'Sin Puntos'; ?></td> 
                            <?php }if (!empty($i->primer_ordinario)) { ?>
                                <td><?php echo $i->primer_ordinario; ?></td> 
                            <?php } else { ?>
                                <td><?php echo 'Sin Puntos'; ?></td> 
                            <?php }if (!empty($i->segundo_ordinario)) { ?>
                                <td><?php echo $i->segundo_ordinario; ?></td> 
                            <?php } else { ?>
                                <td><?php echo 'Sin Puntos'; ?></td> 
                            <?php } ?>
                            <?php
                            if ($i->parcial >= $i->recuperatorio) {
                                $puntos_parcial = $i->parcial;
                            } else {
                                $puntos_parcial = $i->recuperatorio;
                            }
                            if ($i->primer_ordinario >= $i->segundo_ordinario) {
                                $puntos_ordinario = $i->primer_ordinario;
                            } else {
                                $puntos_ordinario = $i->segundo_ordinario;
                            }
                            $nota_ordinario = $puntos_parcial + $puntos_ordinario;
                            if ((((empty($i->parcial)) ) and ((empty($i->recuperatorio)) )) or (((empty($i->primer_ordinario)) ) and ((empty($i->segundo_ordinario)) ))) {
                                ?>
                                <td><?php echo 'Sin Nota' ?></td> 
                                <?php
                            } else {
                                switch ($nota_ordinario) {
                                    case $nota_ordinario >= 0 and $nota_ordinario <= 59:
                                        ?>
                                        <td><?php echo 'Nota 1' ?></td> 
                                        <?php
                                        break;
                                    case $nota_ordinario >= 60 and $nota_ordinario <= 69:
                                        ?>
                                        <td><?php echo 'Nota 2' ?></td> 
                                        <?php
                                        break;

                                    case $nota_ordinario >= 70 and $nota_ordinario <= 79:
                                        ?>
                                        <td><?php echo 'Nota 3' ?></td> 
                                        <?php
                                        break;
                                    case $nota_ordinario >= 80 and $nota_ordinario <= 89:
                                        ?>
                                        <td><?php echo 'NOta 4' ?></td> 
                                        <?php
                                        break;
                                    case $nota_ordinario >= 90 and $nota_ordinario <= 100:
                                        ?>
                                        <td><?php echo 'Nota 5' ?></td> 
                                        <?php
                                        break;
                                }
                            }
                            ?>
                            <?php if (!empty($i->complementario)) { ?>
                                <td><?php echo $i->complementario; ?></td> 
                                <?php
                                switch ($i->complementario) {
                                    case $i->complementario >= 0 and $i->complementario <= 59:
                                        ?>
                                        <td><?php echo 'Nota 1' ?></td> 
                                        <?php
                                        break;
                                    case $i->complementario >= 60 and $i->complementario <= 69:
                                        ?>
                                        <td><?php echo 'Nota 2' ?></td> 
                                        <?php
                                        break;

                                    case $i->complementario >= 70 and $i->complementario <= 79:
                                        ?>
                                        <td><?php echo 'Nota 3' ?></td> 
                                        <?php
                                        break;
                                    case $i->complementario >= 80 and $i->complementario <= 89:
                                        ?>
                                        <td><?php echo 'NOta 4' ?></td> 
                                        <?php
                                        break;
                                    case $i->complementario >= 90 and $i->complementario <= 100:
                                        ?>
                                        <td><?php echo 'Nota 5' ?></td> 
                                        <?php
                                        break;
                                }
                            } else {
                                ?>
                                <td><?php echo 'Sin Puntos'; ?></td>
                                <td><?php echo 'Sin Nota'; ?></td> 
                            <?php }
                            ?>
                            <?php if (!empty($i->mesa_especial)) { ?>
                                <td><?php echo $i->mesa_especial; ?></td> 
                                <?php
                                switch ($i->mesa_especial) {
                                    case $i->mesa_especial >= 0 and $i->mesa_especial <= 59:
                                        ?>
                                        <td><?php echo 'Nota 1' ?></td> 
                                        <?php
                                        break;
                                    case $i->mesa_especial >= 60 and $i->mesa_especial <= 69:
                                        ?>
                                        <td><?php echo 'Nota 2' ?></td> 
                                        <?php
                                        break;

                                    case $i->mesa_especial >= 70 and $i->mesa_especial <= 79:
                                        ?>
                                        <td><?php echo 'Nota 3' ?></td> 
                                        <?php
                                        break;
                                    case $i->mesa_especial >= 80 and $i->mesa_especial <= 89:
                                        ?>
                                        <td><?php echo 'Nota 4' ?></td> 
                                        <?php
                                        break;
                                    case $i->mesa_especial >= 90 and $i->mesa_especial <= 100:
                                        ?>
                                        <td><?php echo 'Nota 5' ?></td> 
                                        <?php
                                        break;
                                }
                            } else {
                                ?>
                                <td><?php echo 'Sin Puntos'; ?></td>
                                <td><?php echo 'Sin Nota'; ?></td> 
                            <?php }
                            ?>

                        <?php endforeach;
                        ?>
                    </tr>

                </tbody>
            </table>

            <?php
        else :
            ?>
            <h1>No hay Notas</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>


