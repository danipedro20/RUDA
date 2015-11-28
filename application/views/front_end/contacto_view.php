<section class="contenido" >
  
    
    
        
			<?php echo validation_errors(); ?>        
        
        	<fieldset>
            	<h1>Formulario de contacto</h1>
                
                <form action="" method="post">
                	<label for="f_nombre">Nombre</label>
                    <input type="text" name="nombre" id="f_nombre" value="<?php echo set_value('nombre'); ?>" />
                    <br/>
                    <label for="f_email">Email</label>
                    <input type="text" name="email" id="f_email" value="<?php echo set_value('email'); ?>" />
                    <br/>
                    <label for="f_texto">Texto</label>
                    <textarea name="texto" id="f_texto"><?php echo set_value('texto'); ?></textarea>
                    <br/>
                    <label for="f_enviar"></label>
                    <input type="submit" id="f_enviar" />
                </form>
            </fieldset>






       



</section>