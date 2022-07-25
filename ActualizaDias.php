<?php
    $data = file_get_contents('php://input');
    echo $data;
    $data = json_decode( $data, true );
    var_dump($data);
    $tipo = $data["tipo"];
    $fin = $data["fin"];
    if ($tipo == "diario"){
        $lunes = $data["lunes"];
        $martes = $data["martes"];
        $miercoles = $data["miercoles"];
        $jueves = $data["jueves"];
        $Viernes = $data["Viernes"];
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,$bd);
        $sql = "TRUNCATE puntualidad";
        $c->query($sql);
        $sql = "TRUNCATE puntualidad_dias";
        $c->query($sql);
        $sql = "INSERT INTO puntualidad_dias VALUES ($lunes,$martes,$miercoles,$jueves,$Viernes)";
        $c->query($sql);
        $sql = "INSERT INTO puntualidad VALUES ('diario', $fin)";
        echo $sql;
        $c->query($sql);
    }else{
        $periodo = $data["periodo"];
        $numero = $data["numero"];
        $recompensa = $data["recompensa"];
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,$bd);
        $sql = "TRUNCATE puntualidad";
        $c->query($sql);
        $sql = "TRUNCATE puntualidad_periodo";
        $c->query($sql);
        $sql = "INSERT INTO puntualidad_periodo VALUES ('$periodo',$numero,$recompensa)";
        $c->query($sql);
        $sql = "INSERT INTO  puntualidad VALUES ('periodo', $fin)";
        $c->query($sql);
    }
?>