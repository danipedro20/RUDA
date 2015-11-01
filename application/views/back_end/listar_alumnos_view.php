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
            $a = $this->input->post('catedra');
            $b = $this->input->post('aula');

            $consulta = $this->db->query("select alumno.idusuario,alumno.usu_nombre, alumno.usu_nrocedula,catedras.cat_denominacion,au.idaula,au.aul_denominacion
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  
join usu_au on usu_au.idaula=au.idaula   
join usuarios as alumno on usu_au.idusuario=alumno.idusuario
join usu_cate on usu_cate.idcatedra=catedras.idcatedra  
join usuarios as profesor on usu_cate.idusuario=profesor.idusuario
join catedras as cate on usu_cate.idcatedra=cate.idcatedra 
where catedras.idcatedra='$a' and au.idaula='$b';");
            $filas = $consulta->num_rows();
            ?>
            <?php if (empty($asistencias)) : ?>
                <?php if (!empty($arrDatosalum)) : ?>


                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><h2 style="float: center;"> <?php echo $nombre->cat_denominacion; ?> <br>Lista de Alumnos<br> Fecha: <?php echo $hoy = date('d/m/Y'); ?>  </h2><span style="float: right;">Filtrar<input id="filtro" type="text" title="Reconoce Mayúsculas" data-content="Ej.: Juan, juan, JUAN..."></span></div>

                        <div class="panel-content">

                            <table id="paginar"  table border="1" cellpadding="2" cellspacing="1" WIDTH="100%">

                                <thead><tr><th>Nombre</th><th>Numero de cedula</th><th>Estado</th><th>Justificacion</th>

                                    </tr></thead>
                                <tbody id="filtrar">
                                    <?php foreach ($arrDatosalum as $alumno) : ?>
                                        <tr>

                                            <td><input type="hidden" name="idusuario[]" id="usu_nombre" value='<?php echo $alumno->idusuario; ?>'/><?php echo $alumno->usu_nombre; ?></td>
                                            <td><?php echo $alumno->usu_nrocedula; ?></td>
                                            <td> <select name="estado[]" id="estado" style="width: 160px;">
                                                    <option value="A">AUSENTE</option>
                                                    <option value="P">PRESENTE</option>
                                                </select></td>
                                            <td><input type="text" name="justificacion[]" id="justificacion" value="" style="width: 200px;"/></td>
                                    <input type="hidden" name="catedra[]" id="catedra" value='<?php echo $nombre->idcatedra; ?>'/>
                                    <input type="hidden" name="aula[]" id="aula" value='<?php echo $alumno->idaula; ?>'/>
                                <?php endforeach; ?></tr>
                                </tbody>                      

                            </table>

                        </div>
                        <input type="submit" name="guardar" id="guardar" value="Guardar Lista" dir="<?php echo base_url(); ?>backend/profesor_control/guardar_lista"/>
                    </div>

                </form>
            <?php else : ?>
                <h1>No hay alumnos</h1>
            <?php endif; ?>
        <?php else : ?>
            <h1>Ya se registraron las asistencias de esta cátedra el dia de hoy</h1>
            <p  ALIGN=CENTER><?= anchor(base_url() . 'backend/profesor_control/editar_lista_alumnos/' . $asistencias->idcatedra . '/' . $asistencias->idaula . '/' . $asistencias->asi_fecha, 'Editar Lista') ?></p>
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