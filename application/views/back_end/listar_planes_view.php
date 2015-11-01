
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
     
        <?php if (!empty($arrDatosplaca)) : ?>


            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><h2 style="float: center;">Lista de Planes y Catedras</h2><span style="float: right;">Filtrar<input id="filtro" type="text" title="Reconoce Mayúsculas" data-content="Ej.: Juan, juan, JUAN..."></span></div>

                <div class="panel-content">

                    <table id="paginar" table border="1" cellpadding="2" cellspacing="1" WIDTH="100%">

                        <thead><tr><th>Plan de Estudio</th><th>Catedra</th><th>Dias Catedra</th><th>Editar</th><th>Eliminar</th>

                            </tr></thead>
                        <tbody id="filtrar">
                            <?php foreach ($arrDatosplaca as $placa) : ?>
                                <tr>

                                    <td><?php echo $placa->pla_denominacion; ?></td>
                                    <td><?php echo $placa->cat_denominacion; ?></td>
                                       <td><?php echo $placa->diascatedra; ?></td>
                                    <td><?= anchor(base_url() . 'backend/planestudio_control/editar_catedras_planes/' . $placa->idcatedra . '/' . $placa->idplan, 'Editar') ?></td>
                                    <td><a href="<?php echo base_url() . 'backend/planestudio_control/eliminarasignacion/' . $placa->idcatedra.'/'.$placa->idplan?>" onclick="return confirm('¿Estás seguro que desea eliminar esta Asignación?')">Eliminar</a></td>
                                <?php endforeach; ?></tr>
                        </tbody>                      

                    </table>
                </div>
            </div>

            <?php else : ?>
                <h1>No hay Planes</h1>
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
            var rowsShown = 25;
            var rowsTotal = $('#paginar tbody tr').length;
            var numPages = rowsTotal / rowsShown;
            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append('<a href="#" rel="' + i + '">' + pageNum + '</a> ');
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