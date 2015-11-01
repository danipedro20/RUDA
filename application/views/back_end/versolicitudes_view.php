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





        <?php if (!empty($generatetabla)) : ?>


            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><h2 style="float: center;">Lista de Solicitudes</h2><span style="float: right;">Filtrar<input id="filtro" type="text" title="Reconoce Mayúsculas" data-content="Ej.: Juan, juan, JUAN..."></span></div>

                <div class="panel-content">

                    <table id="paginar" table border="1" cellpadding="2" cellspacing="1" WIDTH="100%">

                        <thead><tr><th>Nombre</th><th>Carrera</th><th>Aula</th><th>Turno</th><th>Verificar</th>

                            </tr></thead>
                        <tbody id="filtrar">
                            <?php foreach ($generatetabla as $soli) : 
                       ?>
                           
                                <tr>

                                   <td><?php echo $soli->ins_nombre; ?></td><td><?php echo $soli->car_denominacion; ?></td><td><?php echo $soli->aul_denominacion; ?></td><td><?php echo $soli->ins_turno; ?></td><td><?= anchor(base_url().'frontend/solicitud_control/verificarsolicitud/'. $soli->idinscripcion,'Verificar') ?></td>
                                <?php endforeach; ?></tr>
                        </tbody>                      

                    </table>
                </div>

            <?php else : ?>
                <h1>No hay Solicitudes</h1>
            <?php endif; ?>
            <script>
                $("#filtro").keyup(function() {
                    var data = this.value.split(" ");
                    var jo = $("#filtrar").find("tr");
                    if (this.value == "") {
                        jo.show();
                        return;
                    }
                    jo.hide();

                    jo.filter(function(i, v) {
                        var $t = $(this);
                        for (var d = 0; d < data.length; ++d) {
                            if ($t.is(":contains('" + data[d] + "')")) {
                                return true;
                            }
                        }
                        return false;
                    })
                            .show();
                }).focus(function() {
                    this.value = "";
                    $(this).css({
                        "color": "black"
                    });
                    $(this).unbind('focus');
                }).css({
                    "color": "#C0C0C0"
                });
            </script>
            <script>
                $('#paginar').after('<div class="paging-nav" id="nav"></div>');
                var rowsShown = 20;
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
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>