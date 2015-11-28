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
           <script>
            function justNumbers(e)
            {
                var keynum = window.event ? window.event.keyCode : e.which;
                if ((keynum == 8) || (keynum == 46))
                    return true;

                return /\d/.test(String.fromCharCode(keynum));
            }
        </script>

       
        <?php if (!empty($lista)) : ?>
            <h1><?php echo $nombre->cat_denominacion; ?></h1>
            <h2><?php
                if ($idtipo == 2) {
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
            <a href="<?php echo base_url() ?>backend/profesor_control/listar_catedras_profesor">Volver</a>
            <form id='tabla' method="post" action="<?php echo base_url(); ?>backend/profesor_control/guardar_notas_examenes">
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
                                <?php if(!empty( $i->usu_nombre)){ ?>

                                <td><?php echo $i->usu_nombre; ?> </td>
                                <td> <?php echo $i->usu_nrocedula; ?></td>
                                <?php if ($idtipo == 1 or $idtipo == 2 or $idtipo == 3) { ?> 
                                    <td><input type="text" name="puntos[]" id="total" value="40" readonly="" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 4 or $idtipo == 5) { ?> 
                                    <td><input type="text" name="puntos[]" id="total" value="60"  readonly="" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 6 or $idtipo == 7 or $idtipo == 8) { ?>
                                    <td><input type="text" name="puntos[]" id="total" value="100" readonly="" style="width: 90px;" /></td>
                                <?php } ?>
                                        <?php if ($idtipo == 1 or $idtipo == 2 or $idtipo == 3) { ?> 
                                    <td><input type="text" name="logrados[]" id="logrados" maxlength="2"value="" onkeypress="return justNumbers(event);" style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 4 or $idtipo == 5) { ?> 
                                    <td><input type="text" name="logrados[]" id="logrados" value="" maxlength="2" onkeypress="return justNumbers(event);"style="width: 90px;" /></td>
                                <?php } elseif ($idtipo == 6 or $idtipo == 7 or $idtipo == 8) { ?>
                                    <td><input type="text" name="logrados[]" id="logrados" value="" maxlength="3"onkeypress="return justNumbers(event);" style="width: 90px;" /></td>
                                <?php } ?>

                               



                        <input type="hidden" name="idusuario[]" id="idusuario" value='<?php echo $i->idusuario; ?>'/>
                        <input type="hidden" name="idcatedra[]" id="idcatedra" value='<?php echo $i->idcatedra; ?>'/>
                         <input type="hidden" name="idaula[]" id="idcatedra" value='<?php echo $idaula; ?>'/>
                        <input type="hidden" name="idplan[]" id="idplan" value='<?php echo $i->idplan; ?>'/>
                        <input type="hidden" name="idtipo[]" id="idtipo" value='<?php echo $idtipo; ?>'/>
                        <input type="hidden" name="id[]" id="idtipo" value='<?php echo $id; ?>'/>
                                <?php }else{ echo 'No hay Alumnos';}?>
 <?php endforeach; ?></tr>
                    </tbody>

                </table>
                <input type="submit" name="guardar" id="guardar" value="Guardar Notas"/>
            <?php else : ?>
                <h1>No hay Alumnos</h1>
            <?php endif; ?>
        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>