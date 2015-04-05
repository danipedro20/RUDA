<?php

define("cServidor", "localhost");
define("cUsuario", "root");
define("cPass", "");
define("cBd", "ruda");

$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);
$consulta = "select aulas.aul_denominacion,carreras.car_denominacion,catedras.cat_denominacion
from aulas inner join carreras on aulas.id_carrera=carreras.id_carrera
inner join cate_plan on aulas.idplan=cate_plan.idplan
inner join catedras on cate_plan.idcatedra=catedras.idcatedra 
" ;
$registro = mysqli_query($conexion, $consulta);

//guardamos en un array multidimensional todos los datos de la consulta
$i = 0;
$tabla = "";

while ($row = mysqli_fetch_array($registro)) {
    $tabla.='{"aul_denominacion":"' . $row['aul_denominacion'] . '","car_denominacion":"' . $row['car_denominacion'] . '","cat_denominacion":"' . $row['cat_denominacion'] . '"},';
    $i++;
}
$tabla = substr($tabla, 0, strlen($tabla) - 1);

echo '{"data":[' . $tabla . ']}';
?>