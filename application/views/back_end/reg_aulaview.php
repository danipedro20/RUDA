<section class="contenido">
    <h2>Crear Aula</h2>
        <?php
//        Se inicializa el formulario para agregar un aula
        echo form_open('/admin/reg_aula');
        echo form_label('Nombre de Aula:', 'lblnomaula');
        echo form_input('aul_denominacion');echo '<br>';
        echo form_label('Plazas Disponibles:', 'lblplazasdisponibles');
        echo form_input('aulplazadisponible');echo '<br>';
        echo form_label('Plazas Habilitadas:', 'lblplazashabilitadas');
        echo form_input('aulplazahabilitada');echo '<br>';
        echo form_label('Carrera:', 'lblcarrera');
        echo form_input('aulcarrera');echo '<br>';
        echo form_label('Plan de Estudio:', 'lblplanestudio');
        echo form_input('aulplanestudio');echo '<br>';
        echo form_submit('botonSubmit', 'Guardar');
        echo form_close();
    ?>
</section>

