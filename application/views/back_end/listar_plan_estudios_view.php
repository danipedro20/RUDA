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
                       <th>Plan de Estudio</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Editar</th>
                                <th>Eliminar</th>


                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($plan as $i) : ?>
                                <tr>

                                    <td><?php echo $i->pla_denominacion; ?></td>
                                     <td><?php 
                                            $fechainicio=$i->pla_fechainicio; 
                                             echo date("d-m-Y", strtotime($fechainicio) );
                                            ?>
                                     </td>
                                      <td><?php 
                                      $fechafin= $i->pla_fechafin; 
                                      
                                      echo date("d-m-Y", strtotime($fechafin) );
                                      
                                      ?>
                                     

                                      
                                      
                                      </td>
                                    <td><?= anchor(base_url() . 'backend/insplan_control/editar_plan_estudio/' . $i->idplan, 'Editar') ?></td>
                                    <td><a href="<?php echo base_url() . 'backend/insplan_control/eliminar_planestudio/' . $i->idplan?>" onclick="return confirm('¿Estás seguro que desea eliminar este Plan?')">Eliminar</a></td>
                                <?php endforeach; ?></tr>
                </tbody>

            </table>
        <button><a href="<?php echo base_url() ?>backend/insplan_control/reporte_planes"  target="_blank">Generar Reporte</a></button>
        <?php else : ?>
            <h1>No hay Planes</h1>
        <?php endif; ?>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

     