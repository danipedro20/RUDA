<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
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

        <fieldset>
            <?php
            $z = $this->session->userdata('id');
            $sql = $this->db->query("select catedras.idcatedra,aulas.idaula
from aulas as au left join carreras on au.id_carrera=carreras.id_carrera
 join cate_plan on au.idplan=cate_plan.idplan
join catedras on cate_plan.idcatedra=catedras.idcatedra  join usu_au on
usu_au.idaula=au.idaula join aulas on usu_au.idaula=aulas.idaula  where idusuario='$z'");
            $cont = 0;
            foreach ($sql->result() as $fila) {
                $g = $fila->idcatedra;
                $p=$fila->idaula;
                $this->db->where('idcatedra', $g)
                        ->where('idaula', $p)
                        ->from('tareas');
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $que) {

                        $hoy = date('d-m-Y');
                        $fechahoy = date("Y-m-d", strtotime($hoy));

                        if ($que->tar_fechaentrega >= $fechahoy and $que->tar_fechaasignacion <= $fechahoy) {

                            $cont = $cont + 1;
                            ?>

                            <?php
                        }
                    }
                }
            }
            ?>
            <h1> Sección en Construcción </h1>
            <h3 ALIGN = CENTER > Bienvenido:  <?php echo $this->session->userdata('nombre'); ?> </h3>
            <h3 ALIGN = CENTER > Perfil:  <?php echo $this->session->userdata('perfil'); ?> </h3>
            <h3 ALIGN = CENTER > id:  <?php echo $z; ?> </h3>

            <?php
            if ($cont > 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes' . " " . $cont . " " . 'tarea/as ' ?></p>

                </div>
                <?php
            }
            ?>

        </fieldset>
    </section>

    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>



