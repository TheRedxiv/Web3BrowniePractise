<?php
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,$bd);
    $sql = "SELECT * FROM puntualidad";
    $consulta = $c->query($sql);
    $linea = $consulta->fetch_assoc();
    echo json_encode($linea);
?>