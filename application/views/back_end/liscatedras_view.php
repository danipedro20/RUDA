<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>

<section class="contenido">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/back_end/css/table.css"/>
    <h2> Lista de catedras</h2>
    <?php
    $a = $this->session->userdata('id');

    $consulta = $this->db->query("select catedras.cat_denominacion,catedras.cat_diascatedra from usu_cate left join
catedras on usu_cate.idcatedra=catedras.idcatedra join usuarios on
usu_cate.idusuario=usuarios.idusuario where usu_cate.idusuario='$a'");
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
    $this->table->set_heading('Catedra', 'Dia de catedra');
    echo $this->table->generate($consulta);
    ?>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>