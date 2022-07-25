<?php
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,$bd);
    $data = file_get_contents('php://input');
    echo $data;
    $data = json_decode( $data, true );
    var_dump($data);
    $tipo = $data["bonusTiempo"];
    $recompensa = $data["valor"];
    $activo = $data["activo"];
    $sql = "TRUNCATE puntualidad_bonus";
    $c->query($sql);
    $sql = "INSERT INTO puntualidad_bonus VALUES('$tipo', $recompensa ,$activo)";
    $c->query($sql);
?>