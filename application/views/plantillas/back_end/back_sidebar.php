
</section>

<div id="menu">
    <ul>
        <li class="has-sub"><a href="#">Cuenta</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/adhome/verperfil">Perfil de Usuario</a></li>
                <li><a href="<?php echo base_url() ?>backend/verificacion_control/verificacionadmin">Cambiar contraseña</a></li>
                <li><a href="<?php echo base_url() ?>backend/baneo_control/baneo">Suspender Cuenta</a></li>
                <li><a href="<?php echo base_url() ?>backend/adhome/agenda">Agenda</a></li>
            </ul> 
        </li>
        
        <li class="has-sub"><a href="#">Usuarios</a>
            <ul>
                <li class="has-sub"><a title="" href="#">Alumnos</a>
                    <ul>
                        <li><a href="<?php echo base_url() ?>backend/adhome/mostrar_alumnos">Alumnos</a></li>
                    </ul>
                </li>
                <li class="has-sub"><a title="" href="#">Profesor</a>
                    <ul>
                        <li><a href="<?php echo base_url() ?>backend/adhome/listar_profesores">Listar Profesores</a></li>
                        <li><a href="<?php echo base_url() ?>backend/adhome/registrar_profesores">Registar Profesores</a></li>
                    </ul>    
                </li>
            </ul>
        </li>

<aside>
</ul>
<ul class="parent">
    <li><a class="desplegable" title="Cuenta">Cuenta</a>
        <ul class="subnavegador">
            <li><a href="<?php echo base_url()?>backend/adhome/verperfil">Perfil de Usuario</a></li>
            <li><a href="<?php echo base_url()?>backend/verificacion_control/verificacionadmin">Cambiar contraseña</a></li>
            <li><a href="<?php echo base_url()?>backend/baneo_control/baneo">Suspender Cuenta</a></li>
            <li><a href="<?php echo base_url()?>backend/adhome/agenda">Agenda</a></li>
        </ul> 
</ul>
<ul class="parent">
    <li><a class="desplegable" title="Editar Cuentas">Cuentas</a>
        <ul class="subnavegador">
            <li><a class="desplegable" title="Alumnos">Alumnos</a>
            <li><a href="<?php echo base_url()?>backend/adhome/mostrar_alumnos">Alumnos</a></li>

        </ul> 
        <ul class="subnavegador">
            <li><a class="desplegable" title="Profesores">Profesor</a>
            <li><a href="<?php echo base_url()?>backend/adhome/listar_profesores">Listar Profesores</a></li>
            <li><a href="<?php echo base_url()?>backend/adhome/registrar_profesores">Registar Profesores</a></li>


        <li class="has-sub"><a href="#">Aulas</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/reg_aula/listar_aulas">Ver Aulas</a></li>
                <li><a href="<?php echo base_url() ?>backend/reg_aula/nueva_aula">Crear Aula</a></li>
                <li><a href="<?php echo base_url() ?>frontend/solicitud_control/versolicitudes">Solicitudes</a></li>
            </ul>
        </li>
        <li class="has-sub"><a href="#">Catedras</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/inscatedras_control/catedra">Crear Catedras</a></li>
                <li><a href="<?php echo base_url() ?>backend/inscatedras_control/listar_catedras">Lista de  Catedras</a></li>
                <li><a href="<?php echo base_url() ?>backend/inscatedras_control/listar_catedras_profesores">Catedras/Profesores</a></li>
                <li><a href="<?php echo base_url() ?>backend/asigcatedras_control/asigcatedras">Asignar catedras a Profesores</a></li>
            </ul>
        </li>

         <li class="has-sub"><a href="#">Plan de Estudios</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/insplan_control/planestudio">Crear Plan de Estudio</a></li>
                <li><a href="<?php echo base_url() ?>backend/insplan_control/listar_plan_estudios">Listar Planes de Estudios</a></li>
                <li><a href="<?php echo base_url() ?>backend/planestudio_control/listar_catedras_planes">Plan de Estudios/Catedras</a></li>
                <li><a href="<?php echo base_url() ?>backend/planestudio_control/plan"> Agregar Catedras a Plan de Estudios</a></li>
            </ul>
        </li>


        <li class="has-sub"><a href="#">Carreras</a>
            <ul>
                <li><a href="<?php echo base_url() ?>backend/carreras_control/vercarreras">Ver Carreras</a></li>
                <li><a href="<?php echo base_url() ?>backend/carreras_control/carreras">Crear Carreras</a></li>
            </ul>
        </li>

<ul class="parent">
    <li><a class="desplegable" title="Aulas">Aulas</a>
        <ul class="subnavegador">
            <li><a href="<?php echo base_url()?>backend/reg_aula/listar_aulas">Ver Aulas</a></li>
            <li><a href="<?php echo base_url()?>backend/reg_aula/nueva_aula">Crear Aula</a></li>
            <li><a href="<?php echo base_url()?>frontend/solicitud_control/versolicitudes">Solicitudes</a></li>
        </ul> 
</ul>
<ul class="parent">
    <li><a class="desplegable" title="Catedras">Catedras</a>
        <ul class="subnavegador">
            <li><a href="<?php echo base_url()?>backend/inscatedras_control/catedra">Crear Catedras</a></li>
            <li><a href="<?php echo base_url()?>backend/inscatedras_control/listar_catedras">Lista de  Catedras</a></li>
            <li><a href="<?php echo base_url()?>backend/inscatedras_control/listar_catedras_profesores">Catedras/Profesores</a></li>
            <li><a href="<?php echo base_url()?>backend/asigcatedras_control/asigcatedras">Asignar catedras a Profesores</a></li>
        </ul> 
</ul>
<ul class="parent">
    <li><a class="desplegable" title="Plan_estudio">Plan de Estudios</a>
        <ul class="subnavegador">
            <li><a href="<?php echo base_url()?>backend/insplan_control/planestudio">Crear Plan de Estudio</a></li>
            <li><a href="<?php echo base_url()?>backend/insplan_control/listar_plan_estudios">Listar Planes de Estudios</a></li>
            <li><a href="<?php echo base_url()?>backend/planestudio_control/listar_catedras_planes">Plan de Estudios/Catedras</a></li>
            <li><a href="<?php echo base_url()?>backend/planestudio_control/plan"> Agregar Catedras a Plan de Estudios</a></li>
        </ul> 
</ul>
<ul class="parent">
    <li><a class="desplegable" title="Carreras">Carreras</a>
        <ul class="subnavegador">
            <li><a href="<?php echo base_url() ?>backend/carreras_control/vercarreras">Ver Carreras</a></li>
            <li><a href="<?php echo base_url() ?>backend/carreras_control/carreras">Crear Carreras</a></li>


    </ul>
</div>
