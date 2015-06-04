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
                "ajax": "<?php echo base_url() ?>/assets/funcioncarreras.php",
                "columns": [
                    {"data": "car_denominacion"},
                   
                ]



            });
        });

    </script>
   
    
   
  
    <fieldset>
        <h1>Lista de Carreras</h1>
       
                <table id="example" class="display" width="50%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>Carreras</th>
                         
                          
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>  
                </table>
        <a href="<?php echo base_url() ?>backend/carreras_control/carreras">Insertar  una Nueva Carrera</a>
        </form>

    </fieldset>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>