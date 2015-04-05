<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>
     
<section class="contenido">
    <h1>Seleccionar Catedra </h1>
        <form action="<?php echo base_url(); ?>backend/alumnos_control/successalumnoslis" method="post">
            <label name="lbl_idcatedra">Catedra:</label>
              <select   class="chosen"   name="SEL"  id="chosen" data-placeholder="Seleccione el catedra..."  required="" style="width: 200px;"> 

                <?php
                foreach ($arrDatoscate as $i => $cate)
                    echo '<option values="', $i, '">', $cate, '</option>';
                ?> 

            </select>
           
            <input type="submit" name="btnguardarplan" value="Ir a Tareas" />



        </form>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>