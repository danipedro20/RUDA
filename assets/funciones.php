<?php

define("cServidor", "localhost");
define("cUsuario", "root");
define("cPass", "");
define("cBd", "ruda");

$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);
$consulta = "select plan_estudios.pla_denominacion,catedras.cat_denominacion from cate_plan inner join catedras on
cate_plan.idcatedra=catedras.idcatedra inner join plan_estudios on
cate_plan.idplan=plan_estudios.idplan";
$registro = mysqli_query($conexion, $consulta);

//guardamos en un array multidimensional todos los datos de la consulta
$i = 0;
$tabla = "";

while ($row = mysqli_fetch_array($registro)) {
    $tabla.='{"pla_denominacion":"' . $row['pla_denominacion'] . '","cat_denominacion":"' . $row['cat_denominacion'] . '"},';
    $i++;
}
$tabla = substr($tabla, 0, strlen($tabla) - 1);

echo '{"data":[' . $tabla . ']}';
?>