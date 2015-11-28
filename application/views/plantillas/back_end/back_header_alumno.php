<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="0" /> 
        <meta http-equiv="Pragma" content="no-cache" />
        <title><?php echo $titulo ?></title>
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/back_end/img/favicon.ico">
        <link rel="icon" type="image/gif" href="<?php echo base_url()?>assets/back_end/img/animated_favicon1.gif">
        <link href="<?php echo base_url() ?>assets/back_end/css/backestilos.css" rel="stylesheet" type="text/css">
        <script Language="JavaScript">
            if (history.forward(-1)) {
                history.replace(history.forward(-1));
            }
        </script>
        <script src="<?php echo base_url() ?>assets/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/miniNotification.js"></script>
        <script type="text/javascript">
            $('#notification').miniNotification();
        </script>
        <style type="text/css">
            #notification {
                display: none;
                position: fixed;
                cursor: pointer;
                width: 100%;
                background: #EFEFEF;
                text-align: center;
                border-top: 2px solid #FFF;
                z-index:9999;
            }
        </style>


    </head>
    <body>
        <header>
            <section class="contenedor">
                <a href="<?php echo base_url()?>backend/home/index"> <img id='logoruda' src='<?php echo base_url()?>assets/back_end/img/logoRuda.png'/> </a>

            </section>
        </header>
        <nav>
            <section class="contenedor">
                <ul>
                    <li><a href="<?php echo base_url() ?>frontend/usuarios_control/sitioalumno">Inicio</a></li>
                    <li><a href="<?php echo base_url() ?>backend/alumnos_control/reporte_asistencias_alumno" target="_blank" >Asistencias</a></li>
                    <!-- <li><a href="#">Materias</a></li> -->
                    <li><a href="<?php echo base_url() ?>backend/alumnos_control/agenda">Agenda</a></li>
                    <li><a href="<?php echo base_url() ?>backend/alumnos_control/successalumnostareas">Tareas</a></li>
                    <li><a href="<?php echo base_url() ?>frontend/usuarios_control/cerrar">Cerrar Sesi&oacute;n</a></li>
                </ul>
            </section>
        </nav>
        <section class="contenedor">
