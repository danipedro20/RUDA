<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$dbhost = "localhost";
$dbname = "ruda";
$dbuser = "root";
$dbpass = "";
$tabla = "tcalendario";
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    die("<h1>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error . "</h1>");
}
;
?>

<?php if ($this->session->userdata('nombre')) {
    ?>

    <section class="contenido">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="PRAGMA" content="NO-CACHE">
            <meta http-equiv="EXPIRES" content="-1">


        </head>

        <div class="calendario_ajax">
            <div class="cal"></div><div id="mask"></div>

        </div>
        <script src="<?php echo base_url(); ?>assets/front_end/jquery/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/front_end/jquery/validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/front_end/jquery/mensajes.js"></script>  
        <link href="<?php echo base_url(); ?>assets/agenda/estilos.css" rel="stylesheet" type="text/css" >

        <script>
            function generar_calendario(mes, anio)
            {
                var agenda = $(".cal");
                agenda.html("<img src='<?php echo base_url(); ?>assets/agenda/images/loading.gif'>");
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>assets/agenda/agenda_admin.php",
                    cache: false,
                    data: {
                        mes: mes, anio: anio, accion: "generar_calendario"
                    }
                }).done(function(respuesta) {
                    agenda.html(respuesta);
                });
            }

            function formatDate(input) {
                var datePart = input.match(/\d+/g),
                        year = datePart[0].substring(2),
                        month = datePart[1], day = datePart[2];
                return day + '-' + month + '-' + year;
            }

            $(document).ready(function()
            {
                /* GENERAMOS CALENDARIO CON FECHA DE HOY */
                generar_calendario("<?php if (isset($_GET["mes"])) echo $_GET["mes"]; ?>", "<?php if (isset($_GET["anio"])) echo $_GET["anio"]; ?>");


                /* AGREGAR UN EVENTO */
                $(document).on("click", 'a.add', function(e)
                {
                    e.preventDefault();
                    var id = $(this).data('evento');
                    var prioridad = $(this).data('prioridad');
                    var aula = $(this).data('aula');
                    var fecha = $(this).attr('rel');


                    $('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='" + fecha + "'>Agregar un evento el " + formatDate(fecha) + "</h2><a href='#' class='close' rel='" + fecha + "'>&nbsp;</a><div id='respuesta_form'></div><form class='formeventos'><label name='evento_nombre'>Evento</label><input type='text' name='evento_titulo' id='evento_titulo' class='required'><label name='prioridad_nombre'>Prioridad</label><SELECT  name='prioridad' id='prioridad' style='width: 460px;'><OPTION VALUE='1'>Privada</OPTION><OPTION VALUE='2'>Publico</OPTION> class='required'></SELECT><br><label name='aula_nombre'>Aula</label><select name='aula' id='aula'><OPTION VALUE='1'>Todas</OPTION><?php foreach ($arrDatos as $dpto) : ?><option value=" +<?php echo $dpto->idaula
        ?> + "><?php echo $dpto->aul_denominacion ?></option><?php endforeach; ?></select><input type='button' name='Enviar' value='Guardar' class='enviar'><input type='hidden' name='evento_fecha' id='evento_fecha' value='" + fecha + "'><input type='hidden' name='usuario' id='usuario' value='" + '<?php echo $this->session->userdata('id') ?>' + "'></form></div>");
                });

                /* LISTAR EVENTOS DEL DIA */
                $(document).on("click", 'a.modal', function(e)
                {
                    e.preventDefault();
                    var fecha = $(this).attr('rel');
                    $('#mask').fadeIn(1000).html("<div id='nuevo_evento' class='window' rel='" + fecha + "'>Eventos del " + formatDate(fecha) + "</h2><a href='#' class='close' rel='" + fecha + "'>&nbsp;</a><div id='respuesta'></div><div id='respuesta_form'></div></div>");
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assets/agenda/agenda_admin.php",
                        cache: false,
                        data: {fecha: fecha, usuario: '<?php echo $this->session->userdata('id') ?>', accion: "listar_evento"}
                    }).done(function(respuesta)
                    {
                        $("#respuesta_form").html(respuesta);
                    });

                });

                $(document).on("click", '.close', function(e)
                {
                    e.preventDefault();
                    $('#mask').fadeOut();
                    setTimeout(function()
                    {
                        var fecha = $(".window").attr("rel");
                        var usuario = $("#usuario").val();
                        var fechacal = fecha.split("-");
                        generar_calendario(fechacal[1], fechacal[0]);
                    }, 500);
                });

                //guardar evento
                $(document).on("click", '.enviar', function(e)
                {
                    e.preventDefault();
                    if ($("#evento_titulo").valid() == true)
                    {
                        $("#respuesta_form").html("<img src='<?php echo base_url(); ?>assets/agenda/images/loading.gif'>");
                        var evento = $("#evento_titulo").val();
                        var prioridad = $("#prioridad").val();
                        var aula = $("#aula").val();
                        var fecha = $("#evento_fecha").val();
                        var usuario = $("#usuario").val();


                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url(); ?>assets/agenda/agenda_admin.php",
                            cache: false,
                            data: {evento: evento, prioridad: prioridad, usuario: usuario, aula: aula, fecha: fecha, accion: "guardar_evento"}
                        }).done(function(respuesta2)
                        {
                            $("#respuesta_form").html(respuesta2);
                            $(".formeventos,.close").hide();
                            setTimeout(function()
                            {
                                $('#mask').fadeOut('fast');
                                var fechacal = fecha.split("-");
                                generar_calendario(fechacal[1], fechacal[0]);
                            }, 3000);
                        });
                    }
                });

                //eliminar evento
                $(document).on("click", '.eliminar_evento', function(e)
                {
                    e.preventDefault();
                    var current_p = $(this);
                    $("#respuesta").html("<img src='<?php echo base_url(); ?>assets/agenda/images/loading.gif'>");
                    var id = $(this).attr("rel");
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assets/agenda/agenda_admin.php",
                        cache: false,
                        data: {id: id, usuario: '<?php echo $this->session->userdata('id') ?>', accion: "borrar_evento"}
                    }).done(function(respuesta2)
                    {
                        $("#respuesta").html(respuesta2);
                        current_p.parent("p").fadeOut();
                    });
                });

                $(document).on("click", ".anterior,.siguiente", function(e)
                {
                    e.preventDefault();
                    var datos = $(this).attr("rel");
                    var nueva_fecha = datos.split("-");
                    generar_calendario(nueva_fecha[1], nueva_fecha[0]);
                });

            });
        </script>

    </section>
    <?php
} else
    redirect(base_url('/frontend/usuarios_control/logueo/'));
?>
