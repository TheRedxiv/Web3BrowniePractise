<?php
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $sql = "SELECT * FROM evento WHERE cerrado = false";
    $consulta = $c->query($sql);
    $Nlineas = $consulta->num_rows;
    if ($Nlineas == "0" ){
        $salida = '{"salida" : 0}';
        }else{
        $salida = '[{"salida":1},';
        while ($linea = $consulta->fetch_assoc()){
            $salida.= json_encode($linea).",";
        }
        $salida = substr($salida,0,-1)."]";
    }
    echo $salida;

?>