<?php
$dia = $_POST["dia"];
$direccion = $_POST["address"];
include("var.inc.php");
$c = new mysqli($host,$user,$pass,$bd);
$sql = "SELECT * FROM puntualidad";
$consulta = $c->query($sql);
$linea = $consulta->fetch_assoc();
$tipo = $linea["tipo"];
$fin = $linea["fin"];
var_dump($linea);
echo (is_null($fin) == 1);
if ($tipo == "diario"){
    if (is_null($fin) == 1 || strtotime($fin) > strtotime('now')){
        $sql = "SELECT $dia FROM puntualidad_dias";
        $consulta = $c->query($sql);
        $puntos = $consulta->fetch_assoc()[$dia];
        include ("Utils.php");
        if ($file = fopen("./temp.py","w")){
            fwrite($file, "cuenta='".$direccion."'\n");
            fwrite($file, "cantidad=".$puntos);
        }
        echo shell_exec('brownie run ./canjeo.py --network ganache-local');
        echo "has ganado $puntos puntos";
    }
}
?>