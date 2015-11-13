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
        <h1>Lista de Cátedras Asignadas</h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Aula</th>
                        <th>Plan de estudio</th>
                        <th>Catedra</th>
                        <th>Dias de Catedra</th>
                        <th>Parcial</th>
                        <th>Recuperatorio</th>
                        <th>Primer Ordinario</th>
                        <th>Segundo Orinario</th>
                        <th>Complementario</th>
                        <th>Extraordinario</th>
                        <th>Mesa Especial</th>
                        <th>Ver Notas</th>





                    </tr>

                </thead>

                <tbody>
                    <?php
                    foreach ($lista as $i) :
                        $consuta1 = $this->db->query("select * from notas_examenes where idcatedra='$i->idcatedra' and idplan='$i->idplan'");
                        $row = $consuta1->row();
                        ?>
                        <tr>

                            <td><?php echo $i->aul_denominacion; ?></td>
                            <td> <?php echo $i->pla_denominacion; ?></td>
                            <td><?php echo $i->cat_denominacion; ?> </td>
                            <td><?php echo $i->diascatedra; ?> </td>
                            <?php if ((!empty($row->parcial) or (!empty($row->recuperatorio)))) { ?>
                                <?php if (!empty($row->parcial)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/2"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/2"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->recuperatorio)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/3"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/3"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->primer_ordinario)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/4"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/4"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->segundo_ordinario)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/5"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/5"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->complementario)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/6"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/6"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->extraordinario)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/7"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/7"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->mesa_especial)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/8"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/8"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($lista)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/ver_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>">Ver Notas</a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <?php echo 'No Disponinle'; ?>
                                    </td>
                                <?php } ?>






                            <?php } else { ?>
                                <td> 
                                    <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/2"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                </td>

                                <td> 
                                    <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/3"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                </td>
                                <td>Favor cargue el Parcial o Recu.</td>
                                <td>Favor cargue el Parcial o Recu.</td>
                                <?php if (!empty($row->complementario)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/6"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/6"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($row->extraordinario)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/7"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/7"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?> <?php if (!empty($row->mesa_especial)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/editar_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/8"><img src="<?php echo base_url() ?>/assets/editar.jpg"></a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <a href="<?php echo base_url() ?>backend/profesor_control/notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>/<?php echo $i->idaula ?>/8"><img src="<?php echo base_url() ?>/assets/agregar.jpg"></a>

                                    </td>
                                <?php } ?>
                                <?php if (!empty($lista)) { ?>
                                    <td>                              
                                        <a href="<?php echo base_url() ?>backend/profesor_control/ver_notas_examenes/<?php echo $i->idplan ?>/<?php echo $i->idcatedra ?>">Ver Notas</a>
                                    </td>
                                <?php } else { ?>
                                    <td> 
                                        <?php echo 'No Disponinle'; ?>
                                    </td>
                                <?php } ?>



                            <?php } ?>

                        <?php endforeach; ?></tr>
                </tbody>

            </table>
        <?php else : ?>
            <h1>No hay Cátedras</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>