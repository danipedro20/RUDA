<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>

<section class="contenido">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
    
    <h2> <?php echo 'Lista de alumnos de la catedra'." ".$_POST['catedras']." " ?> </h2>
    <?php
     
    $a = $_POST['catedras'];

    $consulta = $this->db->query("select alumno.usu_nombre, alumno.usu_nrocedula
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
 join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  join usu_au on
usu_au.idaula=au.idaula  join usuarios as alumno on usu_au.idusuario=alumno.idusuario
join usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios as profesor on usu_cate.idusuario=profesor.idusuario
 join catedras as cate on usu_cate.idcatedra=cate.idcatedra where catedras.cat_denominacion='$a';");
    $tmpl = array(
        'table_open' => '<table border="1" cellpadding="4" cellspacing="10">',
        'heading_row_start' => '<tr>',
        'heading_row_end' => '</tr>',
        'heading_cell_start' => '<th>',
        'heading_cell_end' => '</th>',
        'row_start' => '<tr>',
        'row_end' => '</tr>',
        'cell_start' => '<td>',
        'cell_end' => '</td>',
        'row_alt_start' => '<tr>',
        'row_alt_end' => '</tr>',
        'cell_alt_start' => '<td>',
        'cell_alt_end' => '</td>',
        'table_close' => '</table>'
    );

    $this->table->set_template($tmpl);
    $this->table->set_heading('Alumno', 'Numero de C.I');
    echo $this->table->generate($consulta);
    ?>
</section>
   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>