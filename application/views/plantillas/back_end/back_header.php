<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="0" /> 
        <meta http-equiv="Pragma" content="no-cache" />
        <title><?php echo $titulo ?></title>
        <link href="<?php echo base_url() ?>/assets/back_end/css/backestilos.css" rel="stylesheet" type="text/css">
        <script Language="JavaScript">
            if (history.forward(-1)) {
                history.replace(history.forward(-1));
            }
        </script>

    <html>
        <head>
          
            <title><?php echo $titulo ?></title>
            <link href="<?php echo base_url(); ?>/assets/back_end/css/backestilos.css" rel="stylesheet" type="text/css">

        </head>
        <body>
            <header>
                <section class="contenedor">

                    <h1><a href="<?php echo base_url() ?>">RUDA</a></h1>
                    <p>Sistema de Gestión de Aula</p>
            </header>
            <nav>
                <section class="contenedor">
                    <ul>
                                <li><a href="<?php echo base_url(); ?>backend/adhome/index2">Inicio</a></li>

                                <li><a href="#">Carreras</a></li>
                                <li><a href="#">Aulas</a></li>
                                <li><a href="#">Profesores</a></li>
                                <li><a href="#">Tareas</a></li>

                                <li><a href="<?php echo base_url() ?>frontend/usuarios_control/cerrar">Cerrar Sesión</a></li>
                            </ul>


                      

                </section>
            </nav>
            <section class="contenedor">
