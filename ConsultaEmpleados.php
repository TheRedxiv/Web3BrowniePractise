<?php
function ConsultaEmpleados(){
    include("var.inc.php");
    $c = new mysqli($host, $user, $pass, "t2gobc");
    $b = new mysqli($host, $user, $pass, "blockchaint");
    $i = 0;
    $sqlb = "SELECT * from empleado";
    $userAdd = array();
    $consulta = $c->query($sqlb);
    while ($linea = $consulta->fetch_assoc()){
        $userAdd[$i]["user"] = $linea["nombre"];
        $userAdd[$i]["id"] = $linea["id"];
        $i++;
    }
    return $userAdd;
}

include("var.inc.php");
$c = new mysqli($host, $user, $pass, $db);
$sql = "SELECT nombre FROM nombre WHERE id = 1";
$consulta = $c->query($sqlb);
$salida = $consulta->fetch_assoc()["nombre"];
echo "Buenas $salida";

?>