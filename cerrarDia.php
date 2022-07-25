<?php
    var_dump($_POST);
    $id = $_POST['id'];
    $dia = $_POST['dia'];
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $sql = "INSERT INTO dia_canjeado VALUES ($id, '$dia')";
    echo $sql;
    $c->query($sql);
    $sql = "UPDATE adquiere_productos SET canjeado = 1 WHERE id =  $id";
    $c->query($sql);
?>