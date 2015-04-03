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
                "ajax": "<?php echo base_url() ?>/assets/funcion.php",
                "columns": [
                    {"data": "aul_denominacion"},
                    {"data": "car_denominacion"},
                     {"data": "cat_denominacion"},
                   
                   
                ]



            });
        });

    </script>
   
    
   
  
    <fieldset>
        <h1>Lista de Aulas</h1>
       
                <table id="example" class="display" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aula</th>
                             <th>Carrera</th>
                            <th>Catedra</th>
                          
                          
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>  
                </table>
        <a href="http://ruda.edu.py/backend/reg_aula/nueva_aula">Insertar una Nueva Aula</a>
        </form>

    </fieldset>
</section>

   <?php }else 
      redirect(base_url('/frontend/usuarios_control/logueo/'));
?>

