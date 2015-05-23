
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">
        <?php
     
        $d = $this->session->userdata('nombre');
        $this->db->where('usu_nombre', $d)
                ->from('inscripciones');
        $query = $this->db->get();
        $query = $query->row();
        $j = $query->ins_fechainscripcion;
        $z = $query->id_carrera;

        $this->db->where('id_carrera', $z)
                ->from('carreras');
        $query = $this->db->get();
        $query = $query->row();
        $k = $query->car_denominacion;
        
        $this->db->select('idturno')
                ->where('usu_nombre', $d);
        $query = $this->db->get('inscripciones');
        $row = $query->row_array();
        $turno = $row['idturno'];
        
        $this->db->select('tur_denominacion')
                ->where('idturno', $turno);
        $query = $this->db->get('turnos');
        $row = $query->row_array();
        $turnodeno = $row['tur_denominacion'];
        ?>

        <h2 ALIGN = CENTER> Perfil del Usuario </h2>
        <h4 ALIGN = Left >Nombre de Usuario:  <?php echo $this->session->userdata('nombre'); ?> </h4>
        <h4 ALIGN = Left >Número de C.I:  <?php echo $this->session->userdata('cedula'); ?> </h4>
        <h4 ALIGN = Left >Direccion:  <?php echo $this->session->userdata('direccion'); ?> </h4>
        <h4 ALIGN = Left >Correo:  <?php echo $this->session->userdata('email'); ?> </h4>
        <h4 ALIGN = Left >Número de Teléfono:  <?php echo $this->session->userdata('telefono'); ?> </h4>
        <h4 ALIGN = Left >Turno:  <?php echo $turnodeno; ?> </h4>
        <h4 ALIGN = Left >Fecha de Inscripción:  <?php echo $j; ?> </h5>
            <h4 ALIGN = Left >Carrera:  <?php echo $k; ?> </h4>
            <h4 ALIGN = left ><a href="<?php echo base_url() ?>backend/alumnos_control/editarperfil/" >Editar Perfil</a></h4>


    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
