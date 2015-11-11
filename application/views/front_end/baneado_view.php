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
    <?php
    $fecha_inicio = $this->session->userdata('fechai');
    $fecha_fin = $this->session->userdata('fechaf');
    $segundos = strtotime($fecha_fin) - strtotime($fecha_inicio);
    $diferencia_dias=intval($segundos/60/60/24);
    ?> 

    <h2> <?php echo 'Motivo de la suspención: ' . " " . $this->session->userdata('motivo') . " " ?> </h2>
    <h2> <?php echo 'Fecha de inicio: ' . " " . (date("d-m-Y", strtotime($fecha_inicio))) . " " ?> </h2>
    <h2> <?php echo 'fecha  fin: ' . " " . (date("d-m-Y", strtotime($fecha_fin))) . " " ?> </h2>
    <h2> <?php echo 'Dias de suspención: ' . " " . $diferencia_dias . " " ?> </h2>
</section>
