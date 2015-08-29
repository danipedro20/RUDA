<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <h1>Seleccionar Catedra </h1>
        <form action="<?php echo base_url(); ?>backend/profesor_control/listatareas" method="post">
            <label name="lbl_idcatedra">Catedra:</label>
            <select name='selcatedra' id='selcatedra' style="width: 300px;"><?php foreach ($arrDatos as $catedra) : ?>
                    <option value="<?php echo $catedra->idcatedra ?>"><?php echo $catedra->cat_denominacion ?>
                    </option><?php endforeach; ?>
            </select>
          <input type="hidden" id="selaula2" name="selaula2"  value='<?php echo  $b = $this->input->post('selaula');?>' /><br>  

            <label name="lbl_ver">Ver:</label>
            <SELECT  name='ver_rango' id='ver_rango' style='width: 200px;'><OPTION VALUE='1'>Activa</OPTION><OPTION VALUE='2'>Pendientes</OPTION><OPTION VALUE='3'>Todas</OPTION></SELECT>
            <input type="submit" name="btnguardarplan" value="Ir a Tareas" />



        </form>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>