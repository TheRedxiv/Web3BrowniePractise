<?php
    include("var.inc.php");
    $realiza = $_POST["realiza"];
    $recibe = $_POST["recibe"];
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $sql = "INSERT INTO encuesta (realiza, recibe) VALUES ($realiza, $recibe)";
    $c->query($sql);
    $lastId = $c->insert_id;
    echo $lastId;
?>