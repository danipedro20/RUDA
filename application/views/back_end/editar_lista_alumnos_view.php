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
       <form  action="<?php echo base_url(); ?>backend/profesor_control/editar_lista" method="post">
           <h1>Editar Lista de:<?php echo $nombre->cat_denominacion; ?></h1>
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Numero de cedula</th>
                        <th>Estado</th>
                        <th>Justificación</th>

                    </tr>

                </thead>

                <tbody>
    <?php foreach ($asistencias as $alumno) : ?>
                        <tr>

                            <td><input type="hidden" name="idusuario[]" id="usu_nombre" value='<?php echo $alumno->idusuario; ?>'/><?php echo $alumno->usu_nombre; ?></td>
                            <td><?php echo $alumno->usu_nrocedula; ?></td>
                            <td> <select name="estado[]" id="estado" style="width: 160px;">
        <?php if ($alumno->asi_estado == "A") { ?>
                                        <option value="A">AUSENTE</option>
                                        <option value="P">PRESENTE</option>

        <?php } elseif ($alumno->asi_estado == "P") { ?>
                                        <option value="P">PRESENTE</option>
                                        <option value="A">AUSENTE</option>

        <?php } ?>
                                </select></td>
                            <td><input type="text" name="justificacion[]" id="justificacion" maxlength="30" value="<?php echo $alumno->asi_justificacion; ?>" style="width: 200px;"/></td>
                    <input type="hidden" name="catedra[]" id="catedra" value='<?php echo $alumno->idcatedra; ?>'/>
                    <input type="hidden" name="aula[]" id="aula" value='<?php echo $alumno->idaula; ?>'/>
                    <input type="hidden" name="fecha[]" id="fecha" value='<?php echo $alumno->asi_fecha; ?>'/>
    <?php endforeach; ?></tr>
                </tbody>

            </table>
          <input type="submit" name="guardar" id="guardar" value="Guardar Edición" value=""/>
        </form>

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
