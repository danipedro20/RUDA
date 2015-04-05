<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>

<?php if($this->session->userdata('nombre')){
?>
   
<section class="contenido">
    
    <h2>Se ha insertado con Exito!!!</h2>
    <P ALIGN=CENTER><a href="<?php echo base_url() ?>backend/carreras_control/carreras">Insertar otra Carrera</a></p>
</section>
 <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
