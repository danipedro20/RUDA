<?php

define("cServidor", "localhost");
define("cUsuario", "root");
define("cPass", "");
define("cBd", "ruda");

$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);
$consulta = "select catedras.cat_denominacion, usuarios.usu_nombre from usu_cate inner join catedras on
usu_cate.idcatedra=catedras.idcatedra inner join usuarios on
usu_cate.idusuario=usuarios.idusuario";
$registro = mysqli_query($conexion, $consulta);

//guardamos en un array multidimensional todos los datos de la consulta
$i = 0;
$tabla = "";

while ($row = mysqli_fetch_array($registro)) {
    $tabla.='{"cat_denominacion":"' . $row['cat_denominacion'] . '","usu_nombre":"' . $row['usu_nombre'] . '"},';
    $i++;
}
$tabla = substr($tabla, 0, strlen($tabla) - 1);

echo '{"data":[' . $tabla . ']}';
?>