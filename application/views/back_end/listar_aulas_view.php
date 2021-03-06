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
        <h4> <?php if(isset($error)) echo '<font color="red" style=" font-size: 30px; ">'.$error.'</font>';?></h4>
           <h1>Lista de Aulas</h1>
            
            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Aula</th>
                        <th>Carrera</th>
                        <th>Plan de Estudio</th>
                        <th>Turno</th>
                         <th>Editar</th>
                        <th>Eliminar</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($lista as $lis) : ?>
                        <tr>

                            <td><?php echo $lis->aul_denominacion; ?></td>
                            <td><?php echo $lis->car_denominacion; ?></td>
                            <td><?php echo $lis->pla_denominacion; ?></td>
                             <?php if ($lis->idturno == 'M') { ?>
                            <td><?php echo'Manaña' ?></td>
                        <?php } elseif ($lis->idturno == 'T') { ?>
                            <td><?php echo'Tarde' ?></td>
                        <?php } elseif ($lis->idturno == 'N') { ?>
                              <td><?php echo'Noche' ?></td>
                               <?php } ?>
                            <td><?= anchor(base_url() . 'backend/reg_aula/editaraula/' . $lis->idaula, 'Editar') ?></td>
                            <td><a href="<?php echo base_url() . 'backend/reg_aula/eliminar_aula/' . $lis->idaula ?>" onclick="return confirm('¿Estás seguro que desea eliminar esta Aula?')">Eliminar</a></td>
                        <?php endforeach; ?></tr>
                </tbody>

            </table>
          <div id="boton1">
               <a href="<?php echo base_url() ?>backend/reg_aula/reporte_aulas"  target="_blank">Generar Reporte</a>
                
            </div>
      
         <?php else : ?>
                <h1>No hay Aulas</h1>
            <?php endif; ?>
            


    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

