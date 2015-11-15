<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="0" /> 
        <meta http-equiv="Pragma" content="no-cache" />
        <title><?php echo $titulo ?></title>
        <link rel="shortcut icon" href="<?php echo base_url()?>/assets/back_end/img/favicon.ico">
        <link rel="icon" type="image/gif" href="<?php echo base_url()?>/assets/back_end/img/animated_favicon1.gif">
        <link href="<?php echo base_url() ?>/assets/back_end/css/backestilos.css" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
        <script Language="JavaScript">
            if (history.forward(-1)) {
                history.replace(history.forward(-1));
            }
        </script>

        <script type="text/javascript">
            $(document).ready(function() { // Script del Navegador
                $("ul.subnavegador").not('.selected').hide();
                $("a.desplegable").click(function(e) {
                    var desplegable = $(this).parent().find("ul.subnavegador");
                    $('.desplegable').parent().find("ul.subnavegador").not(desplegable).slideUp('slow');
                    desplegable.slideToggle('slow');
                    e.preventDefault();
                })
            });
        </script>


    </head>
    <body>

        <header>
            <section class="contenedor">
                 <a href="<?php echo base_url()?>backend/home/index"> <img id='logoruda' src='<?php echo base_url()?>/assets/back_end/img/logoRuda.png'/> </a>

            </section>
        </header>
        <nav>
            <section class="contenedor">


                <ul>
                    <li><a href="<?php echo base_url() ?>frontend/usuarios_control/sitioprofesor">Inicio</a></li>
                    <li><a href="<?php echo base_url()?>backend/profesor_control/listaralumnos">Asistencias</a></li>
                    <li><a href="<?php echo base_url()?>backend/profesor_control/listar_catedras_profesor">C&aacute;tedras</a></li>
                    <li><a href="<?php echo base_url()?>backend/profesor_control/listaralumnos">Alumnos</a></li>
                    <li><a href="<?php echo base_url()?>backend/profesor_control/tareas">Tareas</a></li>
                    <li><a href="<?php echo base_url() ?>frontend/usuarios_control/cerrar">Cerrar Sesión</a></li>
                </ul>

            </section>
        </nav>

        <section class="contenedor">
