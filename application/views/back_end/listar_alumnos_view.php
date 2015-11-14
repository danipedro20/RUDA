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
        
        <form id='tabla' method="post" action="<?php echo base_url(); ?>backend/profesor_control/guardar_lista">
            <?php if (empty($asistencias)) : ?>
                <?php if (!empty($arrDatosalum)) : ?>
             <h1><?php echo $nombre->cat_denominacion; ?></h1>
                    <table id="example" class="display nowrap" cellspacing="0" width="100%">
                        <thead>

                            <tr>
                                <th>Nombre</th>
                                <th>Número de C.I</th>
                                <th>Estado</th>
                                <th>Justificación</th>

                            </tr>

                        </thead>

                        <tbody>
                            <?php foreach ($arrDatosalum as $alumno) : ?>
                                <tr>

                                    <td><input type="hidden" name="idusuario[]" id="usu_nombre" value='<?php echo $alumno->idusuario; ?>'/><?php echo $alumno->usu_nombre; ?></td>
                                    <td><?php echo $alumno->usu_nrocedula; ?></td>
                                    <td> <select name="estado[]" id="estado" style="width: 160px;">
                                            <option value="A">AUSENTE</option>
                                            <option value="P">PRESENTE</option>
                                        </select></td>
                                    <td><input type="text" name="justificacion[]"  maxlength="30"id="justificacion" value="" style="width: 200px;"/></td>
                            <input type="hidden" name="catedra[]" id="catedra" value='<?php echo $nombre->idcatedra; ?>'/>
                            <input type="hidden" name="aula[]" id="aula" value='<?php echo $alumno->idaula; ?>'/>
                        <?php endforeach; ?></tr>
                        </tbody>

                    </table>
                    <input type="submit" name="guardar" id="guardar" value="Guardar Lista"/>
                </form>
            <?php else : ?>
                <h1>No hay alumnos</h1>
            <?php endif; ?>
        <?php else : ?>
            <h1>Ya se registraron las asistencias de esta cátedra el dia de hoy</h1>
            <p  ALIGN=CENTER><?= anchor(base_url() . 'backend/profesor_control/editar_lista_alumnos/' . $asistencias->idcatedra . '/' . $asistencias->idaula . '/' . $asistencias->asi_fecha, 'Editar Lista') ?></p>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
