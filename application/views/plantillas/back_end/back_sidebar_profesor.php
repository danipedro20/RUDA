
<div id="menu">
    <ul>
        <li class="has-sub"><a href="#">Informaci&oacute;n General</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/alumnos_control/verperfil">Perfil de Usuario</a></li>
                <li><a href="<?php echo base_url() ?>backend/verificacion_control/verificacion">Cambiar contraseña</a></li>
            </ul> 
        </li>
        
        <li class="has-sub"><a href="#">Aulas</a>
            <ul>
                <li><a href="<?php echo base_url()?>backend/profesor_control/listar_catedras_profesor">Catedras/Notas</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/listaralumnos">Listar Alumnos</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/editar_listas_alumnos_con_rango">Editar listas de Alumnos</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/tareas">Crear Tareas</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/vertareas">Ver Tareas/Notas Tareas</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/agenda">Agenda</a></li>
            </ul>
        </li>

        <li class="has-sub"><a href="#">Reportes</a>
            <ul>
                <li><a href="<?php echo base_url()?>backend/profesor_control/reporte">Asistencias</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/tarea_reporte">Tareas</a></li>
                <li><a href="<?php echo base_url()?>backend/profesor_control/notas_reporte">Notas</a></li>
            </ul>
        </li>
        
    </ul>
</div>
