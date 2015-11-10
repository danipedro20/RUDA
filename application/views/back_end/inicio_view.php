
<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
date_default_timezone_set('America/Asuncion');
?>
<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <script src="<?php echo base_url() ?>/assets/noti/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>/assets/noti/miniNotification.js"></script>
        <script>
            $(function() {
                $('#mini-notification').miniNotification({closeButton: true, closeButtonText: '[Cerrar]', time: 2500, effect: 'fade'
                });
            });
        </script>
        <style type="text/css">
            #mini-notification {
                display: none;
                position: fixed;
                cursor: pointer;
                width: 25%;
                background: #f80;
                text-align: center;
                border-top: 2px solid #FFF;
                z-index:9999;
            }
        </style>

        <h1> Sección en Construcción </h1>
        <h3 ALIGN = CENTER > Bienvenido:  <?php echo $this->session->userdata('nombre'); ?> </h3>
        <h3 ALIGN = CENTER > Perfil:  <?php echo $this->session->userdata('perfil'); ?> </h3>
        <h3 ALIGN = CENTER > id:  <?php echo$this->session->userdata('id');
    ?> </h3>


        <?php
     
        $hoy = date('d-m-Y');
        $fechahoy = date("Y-m-d", strtotime($hoy));
        $j = $this->session->userdata('id');
        $query3 = $this->db->query("select DISTINCT  aulas.idaula from aulas join plan_estudios
on aulas.idplan=plan_estudios.idplan join cate_plan on
plan_estudios.idplan=cate_plan.idplan join catedras on cate_plan.idcatedra=catedras.idcatedra join
usu_cate on usu_cate.idcatedra=catedras.idcatedra join usuarios on usu_cate.idusuario=usuarios.idusuario where usuarios.idusuario='$j'");

   $cont = 0;

        foreach ($query3->result() as $fila) {
            $query = $this->db->query("select evento from tcalendario where (fecha='" . $fechahoy . "' and idusuario='" . $this->session->userdata('id') . "' and idaula='" . $fila->idaula . "' and prioridad=1)  or ( fecha='" . $fechahoy . "' and prioridad= 2  and idaula='". $fila->idaula ."')");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $que) {
                  $cont = $cont + 1;
                }
        }}
           
            if ($cont > 0) {
                ?>
                <div id="mini-notification">
                    <p><?php
                        
                            echo 'Tienes' . " " . $cont . " " . ' Acontencimiento/s en tu Agenda el dia de Hoy ';
                        
                        ?></p>

                </div>

        <?php }
     ?>


    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
