<?php
    $codigo = $_POST["codigo"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];
    $valor = $_POST["valor"];
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $sql = "INSERT INTO evento (codigo, fecha, descripcion, valor) VALUES ($codigo, '$fecha', '$descripcion', $valor)";
    echo $sql;
    $c->query("$sql");
?>