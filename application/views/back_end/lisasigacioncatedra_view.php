<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if($this->session->userdata('nombre')){
?>
  
<section class="contenido">
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/jquery.js"></script>
     <link rel="stylesheet" href="<?php echo base_url() ?>/assets/front_end/jquery/data-tables/css/jquery.dataTables.css"/>
    <script src="<?php echo base_url() ?>/assets/front_end/jquery/data-tables/js/jquery.dataTables.min.js"></script>
   
    <script>

        $(document).ready(function() {
            $('#example').dataTable({
                "ajax": "<?php echo base_url() ?>/assets/asignacioncatedras.php",
                "columns": [
                    {"data": "cat_denominacion"},
                    {"data": "usu_nombre"},
                   
                ]



            });
        });

    </script>
   
    
   
  
    <fieldset>
        <h1>Lista de Profesores con sus Catedras</h1>
       
                <table id="example" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            
                            <th>Catedra</th>
                            <th>Profesor</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>  
                </table>
        <a href="http://ruda.edu.py/backend/asigcatedras_control/asigcatedras">Asignar catedras a profesor</a>
     

    </fieldset>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
