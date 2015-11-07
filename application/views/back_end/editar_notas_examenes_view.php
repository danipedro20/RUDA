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
        <h1><?php echo $nombre->cat_denominacion; ?></h1>
        <h2><?php
            if ($idtipo == 1) {
                echo'Proceso';
            } elseif ($idtipo == 2) {
                echo 'Parcial';
            } elseif ($idtipo == 3) {
                echo 'Recuperatorio';
            } elseif ($idtipo == 4) {
                echo 'Primer Ordinario';
            } elseif ($idtipo == 5) {
                echo 'Segundo Ordinario';
            } elseif ($idtipo == 6) {
                echo 'Complementario';
            } elseif ($idtipo == 7) {
                echo 'Extraordinario';
            } elseif ($idtipo == 8) {
                echo 'Mesa Especial';
            }
            ?></h2>
        <?php if (!empty($lista)) : ?>
            <form method="post" action="<?php echo base_url(); ?>backend/profesor_control/editar_nota_examen">
                <table id="example" class="display nowrap" cellspacing="0" width="100%">
                    <thead>


                        <tr>
                            <th>Alumno</th>
                            <th>Número C.I</th>
                            <th>Total de Puntos</th>
                            <th>Puntos Logrados</th>



                        </tr>




                    </thead>

                    <tbody>
                        <?php foreach ($lista as $i) : ?>
                            <tr>
                                <td><input type="hidden" name="id[]" id="id" value='<?php echo $i->id; ?>'/><?php echo $i->usu_nombre; ?> </td>
                                <td> <?php echo $i->usu_nrocedula; ?></td>
                                <?php if ($idtipo == 1 or $idtipo == 2 or $idtipo == 3) { ?> 
                                    <td><input type="text" name="puntos[]" id="total" value="40" readonly="" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 4 or $idtipo == 5) { ?> 
                                    <td><input type="text" name="puntos[]" id="total" value="60"  readonly="" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 6 or $idtipo == 7 or $idtipo == 8) { ?>
                                    <td><input type="text" name="puntos[]" id="total" value="100" readonly="" style="width: 90px;" /></td>
                                <?php } ?>
                                <?php if ($idtipo == 1) { ?> 
                                    <td><input type="text" name="logrados[]" id="total" value=" <?php echo $i->proceso ?> "style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 2) { ?> 
                                    <td><input type="text" name="logrados[]" id="total" value=" <?php echo $i->parcial ?>" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 3) { ?>
                                    <td><input type="text" name="logrados[]" id="total" value="<?php echo $i->recuperatorio ?>" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 4) { ?>
                                    <td><input type="text" name="logrados[]" id="total" value="<?php echo $i->primer_ordinario ?>" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 5) { ?>
                                    <td><input type="text" name="logrados[]" id="total" value="<?php echo $i->segundo_ordinario ?>" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 6) { ?>
                                    <td><input type="text" name="logrados[]" id="total" value="<?php echo $i->complementario ?>" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 7) { ?>
                                    <td><input type="text" name="logrados[]" id="total" value="<?php echo $i->extraordinario ?>" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 8) { ?>
                                    <td><input type="text" name="logrados[]" id="total" value="<?php echo $i->mesa_especial ?>" style="width: 90px;" /></td>
                                <?php } ?>
                        <input type="hidden" name="idusuario[]" id="idusuario" value='<?php echo $i->idusuario; ?>'/>
                        <input type="hidden" name="idcatedra[]" id="idcatedra" value='<?php echo $i->idcatedra; ?>'/>
                        <input type="hidden" name="idplan[]" id="idplan" value='<?php echo $i->idplan; ?>'/>
                        <input type="hidden" name="idtipo[]" id="idtipo" value='<?php echo $idtipo; ?>'/>

                    <?php endforeach; ?></tr>
                    </tbody>

                </table>
                <input type="submit" name="guardar" id="guardar" value="Editar Notas"/>
            <?php else : ?>
                <h1>No hay Cátedras</h1>
            <?php endif; ?>
        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>