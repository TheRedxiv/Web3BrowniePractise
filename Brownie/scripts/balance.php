<?php
    if ($file = fopen("./temp.py","w")){
        fwrite($file, "cuenta='".$_GET["direccion"]."'\n");
    }
//echo "Ejecuto script";
$entrada = shell_exec('brownie run .\Balance.py --network ganache-local');
//echo "balance sacado";
$string = explode('...', $entrada);
$salida = array_pop($string);
echo $salida;
?>
