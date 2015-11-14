
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>
    <section class="contenido">
        <?php
        $d = $this->session->userdata('id');
        $query = $this->db->query("select ca.car_denominacion,au.idturno from carreras as ca join aulas as au on "
                . "ca.id_carrera=au.id_carrera join usu_au as usau on usau.idaula=au.idaula"
                . " join usuarios as usu on usau.idusuario=usu.idusuario where usau.idusuario= $d");
        $fila=$query->row();
        ?>

        <h2 ALIGN = CENTER> Perfil <?php echo $this->session->userdata('nombre'); ?> </h2>
        <h4 ALIGN = center >Nombre de Usuario:  <?php echo $this->session->userdata('nombre'); ?> </h4>
        <h4 ALIGN = center >Número de C.I:  <?php echo $this->session->userdata('cedula'); ?> </h4>
        <h4 ALIGN = center >Direccion:  <?php echo $this->session->userdata('direccion'); ?> </h4>
        <h4 ALIGN = center >Correo:  <?php echo $this->session->userdata('email'); ?> </h4>
        <h4 ALIGN = center >Número de Teléfono:  <?php echo $this->session->userdata('telefono'); ?> </h4>
        <h4 ALIGN = center >Turno:  <?php echo $fila->idturno; ?> </h4>
            <h4 ALIGN = center >Carrera:  <?php echo $fila->car_denominacion; ?> </h4>
            <h4 ALIGN = left ><a href="<?php echo base_url() ?>backend/alumnos_control/editarperfil/" >Editar Perfil</a></h4>


    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
