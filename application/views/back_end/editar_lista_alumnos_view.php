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



        <form method="post">

            <?php
            if (!empty($verificar->idcatedra)):
                $consulta = $this->db->query("select * from asistencias where idcatedra='$verificar->idcatedra' and idaula='$verificar->idaula' and asi_fecha='$verificar->asi_fecha' ");
                $filas = $consulta->num_rows();
                ?>
                <?php if (!empty($asistencias)) : ?>


                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><h2 style="float: center;"> <?php echo $verificar->cat_denominacion ?> <br>Lista de Alumnos<br> Fecha: <?php echo $hoy = date('d/m/Y'); ?>  </h2><span style="float: right;">Filtrar<input id="filtro" type="text" title="Reconoce Mayúsculas" data-content="Ej.: Juan, juan, JUAN..."></span></div>

                        <div class="panel-content">

                            <table id="paginar"  table border="1" cellpadding="2" cellspacing="1" WIDTH="100%">

                                <thead><tr><th>Nombre</th><th>Numero de cedula</th><th>Estado</th><th>Justificacion</th>

                                    </tr></thead>
                                <tbody id="filtrar">
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
                                            <td><input type="text" name="justificacion[]" id="justificacion" value="<?php echo $alumno->asi_justificacion; ?>" style="width: 200px;"/></td>
                                    <input type="hidden" name="catedra[]" id="catedra" value='<?php echo $alumno->idcatedra; ?>'/>
                                    <input type="hidden" name="aula[]" id="aula" value='<?php echo $alumno->idaula; ?>'/>
                                <?php endforeach; ?></tr>
                                </tbody>                      

                            </table>

                        </div>
                        <input type="submit" name="guardar" id="guardar" value="Guardar Edición" dir="<?php echo base_url(); ?>backend/profesor_control/editar_lista"/>
                    </div>

                </form>
            <?php else : ?>
                <h1>No hay alumnos</h1>
            <?php endif; ?>
        <?php else : ?>
            <h1>No hay Lista Disponible</h1>
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