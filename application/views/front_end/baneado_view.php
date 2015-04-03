<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<meta http-equiv="Expires" content="0" /> 
<meta http-equiv="Pragma" content="no-cache" />
<script Language="JavaScript">
    if (history.forward(-1)) {
        history.replace(history.forward(-1));
    }
</script>
<section class="contenido">
    <h1>Cuenta Desabilitada temporalmente</h1>
    <h2> <?php echo 'Motivo de la suspencion: ' . " " . $this->session->userdata('motivo') . " " ?> </h2>
    <h2> <?php echo 'Fecha de inicio: ' . " " . $this->session->userdata('fechai') . " " ?> </h2>
    <h2> <?php echo 'fecha  fin: ' . " " . $this->session->userdata('fechaf') . " " ?> </h2>
</section>
