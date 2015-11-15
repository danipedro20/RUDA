
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
                <li><a href="<?php echo base_url() ?>backend/alumnos_control/listar_plan_por_alumno">Cátedras/Notas</a></li>
                
                <li><a href="<?php echo base_url() ?>backend/alumnos_control/successalumnostareas">Tareas</a></li>
                <li><a href="<?php echo base_url() ?>backend/alumnos_control/agenda">Agenda</a></li>
            </ul>
        </li>

        <li class="has-sub"><a href="#">Reportes</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/alumnos_control/reporte_notas_alumno" target="_blank" >Notas Disponibles</a></li>
                <li><a href="<?php echo base_url() ?>backend/alumnos_control/reporte_asistencias_alumno" target="_blank" >Asistencias</a></li>
            </ul>
        </li>
        
    </ul>
</div>
