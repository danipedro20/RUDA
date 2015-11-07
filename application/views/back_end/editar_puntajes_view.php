<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php
if ($this->session->userdata('nombre')) {
    ?>
    <script src="<?php echo base_url(); ?>assets/front_end/jquery/jquery.js"></script>

    <section class="contenido">

        <script>
            $(document).ready(function() {

                $("input[type=submit]").click(function() {
                    var accion = $(this).attr('dir');
                    $('form').attr('action', accion);
                    $('form').submit();
                });

            });
        </script>

        <form method="post">

            <?php
            $consulta = $this->db->query("select n.id,n.idusuario,usu.usu_nombre,usu.usu_nrocedula,ta.tar_descripcion,n.puntos_asignados,n.puntos_logrados,n.idtarea,n.idcatedra from notas_tarea as n
join usuarios as usu on usu.idusuario=n.idusuario 
join tareas as ta on n.idtarea=ta.idtarea
where ta.idtarea='$idtarea';");
            $filas = $consulta->num_rows();
            ?>
            <?php if (!empty($lista)) : ?>


                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><h2 style="float: center;">Lista de Alumnos<br> Fecha: <?php echo $hoy = date('d/m/Y'); ?>  </h2><span style="float: right;">Filtrar<input id="filtro" type="text" title="Reconoce Mayúsculas" data-content="Ej.: Juan, juan, JUAN..."></span></div>

                    <div class="panel-content">

                        <table id="paginar"  table border="1" cellpadding="5" cellspacing="1" WIDTH="70%">

                            <thead><tr>
                                    <th>Nombre</th>
                                    <th>Numero de cedula</th>
                                    <th>Tarea Denominacion</th>
                                    <th>Puntos Asignados</th>
                                    <th>Puntos Logrados</th>

                                </tr></thead>
                            <tbody id="filtrar">
                                <?php foreach ($lista as $i) : ?>
                                    <tr>

                                        <td><?php echo $i->usu_nombre; ?></td>
                                        <td><?php echo $i->usu_nrocedula; ?></td>
                                        <td><input type="text" name="tar_denominacion[]" id="tar_denominacion" value='<?php echo $i->tar_descripcion; ?>' style="width: 180px;" readonly=""/> </td>
                                        <td><input type="text" name="tar_puntostarea[]" id="tar_puntostarea" value='<?php echo $i->puntos_asignados; ?>' style="width: 90px;" readonly="" /></td>
                                        <td><input type="text" name="tar_puntoslogrados[]" id="tar_puntoslogrados" value='<?php echo $i->puntos_logrados; ?>' style="width: 90px;" /></td>
                                <input type="hidden" name="id[]" id="id" value='<?php echo $i->id; ?>'/>


                            <?php endforeach; ?></tr>
                            </tbody>                      

                        </table>

                    </div>
                    <input type="submit" name="guardar" id="guardar" value="Guardar Cambios" dir="<?php echo base_url(); ?>backend/profesor_control/editar_puntaje"/>
                </div>

            </form>
        <?php else : ?>
            <h1>No hay alumnos</h1>
        <?php endif; ?>


        <STYLE type="text/css">
            .paging-nav {
                text-align: right;
                padding-top: 2px;
                padding-bottom: 2px;
            }

            .paging-nav a {
                margin: auto 1px;
                text-decoration: none;
                display: inline-block;
                padding: 1px 7px;
                background:#337ab7;
                color: white;
                border-radius: 3px;
            }

            .paging-nav .active {
                background: black;
                font-weight: bold;
            }

            .paging-nav,
            #tableData {
                width: 400px;
                margin: 0 auto;
                font-family: Arial, sans-serif;
            }
        </style>
        <script>
            $('#paginar').after('<div class="paging-nav" id="nav"></div>');
            var rowsShown = <?php echo $filas; ?>;
            var rowsTotal = $('#paginar tbody tr').length;
            var numPages = rowsTotal / rowsShown;
            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append('<a href="#" rel="' + +'">' + pageNum + '</a> ');
            }
            $('#paginar tbody tr').hide();
            $('#paginar tbody tr').slice(0, rowsShown).show();
            $('#nav a:first').addClass('active');
            $('#nav a').bind('click', function() {

                $('#nav a').removeClass('active');
                $(this).addClass('active');
                var currPage = $(this).attr('rel');
                var startItem = currPage * rowsShown;
                var endItem = startItem + rowsShown;
                $('#paginar tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
                        css('display', 'table-row').animate({opacity: 1}, 300);
            });
        </script>
        <script src="<?php echo base_url(); ?>assets/table/filtro.js"></script>


    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
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
        <form  action="<?php echo base_url(); ?>backend/profesor_control/editar_puntaje" method="post">

            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Numero de cedula</th>
                        <th>Tarea Denominacion</th>
                        <th>Puntos Asignados</th>
                        <th>Puntos Logrados</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($lista as $i) : ?>
                        <tr>

                            <td><?php echo $i->usu_nombre; ?></td>
                            <td><?php echo $i->usu_nrocedula; ?></td>
                            <td><input type="text" name="tar_denominacion[]" id="tar_denominacion" value='<?php echo $i->tar_descripcion; ?>' style="width: 180px;" readonly=""/> </td>
                            <td><input type="text" name="tar_puntostarea[]" id="tar_puntostarea" value='<?php echo $i->puntos_asignados; ?>' style="width: 90px;" readonly="" /></td>
                            <td><input type="text" name="tar_puntoslogrados[]" id="tar_puntoslogrados" value='<?php echo $i->puntos_logrados; ?>' style="width: 90px;" /></td>
                    <input type="hidden" name="id[]" id="id" value='<?php echo $i->id; ?>'/>


                <?php endforeach; ?>
            </tr>
                </tbody>

            </table>
            <input type="submit" name="guardar" id="guardar" value="Guardar Cambios"/>
        </form>

    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
