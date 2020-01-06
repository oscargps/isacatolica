<?php

$linea = 0;
//Abrimos nuestro archivo
$fp = fopen("estudiante.csv", "r");
//Lo recorremos
while ($data = fgetcsv ($fp, 1000, " ")) {
    $num = count ($data);
    print "";
    echo $data[0].' -> '.$data[1];
    }
//Cerramos el archivo
fclose($fp);

?>