<?php
$sinParsear = shell_exec('brownie run .\enVenta.py --network ganache-local');
$string = explode('...', $sinParsear);
$s = array_pop($string);
$mal = array("(",")","'");
$bien = array("[","]",'"');
$salida = str_replace($mal, $bien, $s);
echo $salida;
?>