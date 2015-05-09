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
            
            $sql = $this->db->query("select sol_visto from solicitud where sol_visto='0';");
            $cont = 0;

                if ($sql->num_rows() > 0) {
                    foreach ($sql->result() as $que) {

                            $cont = $cont + 1;
                            ?>

                            <?php
                        }
                    }
            
            ?>
            <h1> Sección en Construcción </h1>
            <h3 ALIGN = CENTER > Bienvenido:  <?php echo $this->session->userdata('nombre'); ?> </h3>
            <h3 ALIGN = CENTER > Perfil:  <?php echo $this->session->userdata('perfil'); ?> </h3>
            <h3 ALIGN = CENTER > id:  <?php echo $this->session->userdata('id'); ?> </h3>

            <?php
            if ($cont > 0) {
                ?>
                <div id="mini-notification">


                    <p><?php echo 'Tienes' . " " . $cont . " " . 'Solicitud/es de Suscripcion a aula/s ' ?></p>

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