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
            $hoy = date('d-m-Y');
            $fechahoy = date("Y-m-d", strtotime($hoy));
            $sql = $this->db->query("select ins_visto from inscripcion where ins_visto='0';");
            $cont = 0;
  $evento = 0;
            if ($sql->num_rows() > 0) {
                foreach ($sql->result() as $que) {

                    $cont = $cont + 1;
                    ?>

                    <?php
                }
            }

            $query = $this->db->query("select evento from tcalendario where (fecha='" . $fechahoy . "' and idusuario='" . $this->session->userdata('id') . "' and prioridad=1)  or ( fecha='" . $fechahoy . "' and prioridad= 3)");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $que) {

                    $evento = $evento + 1;
                    ?>

                    <?php
                }
            }
            ?>
            <h1> Bienvenido !!! </h1>
            <h3 ALIGN = CENTER > Usuario: <?php echo $this->session->userdata('nombre'); ?> </h3>
            <h3 ALIGN = CENTER > Perfil:  <?php echo $this->session->userdata('perfil'); ?> </h3>
            <h3 ALIGN = CENTER > id:  <?php echo $this->session->userdata('id'); ?> </h3>

            <?php
            if ($cont > 0 and $evento > 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes' . " " . $cont . " " . 'Solicitud/es de suscripcion a aula/s  y ' . " " . $evento . " " . ' evento/s hoy ' ?></p>

                </div>
                <?php
            }    elseif ($cont == 0 and $evento > 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes'. " " . $evento . " " . ' evento/s hoy ' ?></p>

                </div>
                <?php
            }elseif ($cont > 0 and $evento == 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes' . " " . $cont . " " . 'Solicitud/es de suscripcion a aula/s' ?></p>

                </div>
                <?php
            }
            ?>

        </fieldset>
    </section>

    <?php
} else
    redirect("<?php echo base_url() ?>/frontend/usuarios_control/logueo/");
?>