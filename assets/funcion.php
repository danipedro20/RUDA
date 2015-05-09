<?php

define("cServidor", "localhost");
define("cUsuario", "root");
define("cPass", "");
define("cBd", "ruda");

$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);
$consulta = "select aulas.aul_denominacion,carreras.car_denominacion,plan_estudios.pla_denominacion,turnos.tur_denominacion
from aulas inner join carreras on aulas.id_carrera=carreras.id_carrera
inner join plan_estudios on aulas.idplan=plan_estudios.idplan
 join turnos on aulas.idturno=turnos.idturno
" ;
$registro = mysqli_query($conexion, $consulta);

//guardamos en un array multidimensional todos los datos de la consulta
$i = 0;
$tabla = "";

while ($row = mysqli_fetch_array($registro)) {
    $tabla.='{"aul_denominacion":"' . $row['aul_denominacion'] . '","car_denominacion":"' . $row['car_denominacion'] . '","pla_denominacion":"' . $row['pla_denominacion'] . '","tur_denominacion":"' . $row['tur_denominacion'] . '"},';
    $i++;
}
$tabla = substr($tabla, 0, strlen($tabla) - 1);

echo '{"data":[' . $tabla . ']}';
?>