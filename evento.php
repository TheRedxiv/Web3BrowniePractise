<?php
    include("var.inc.php");
    $evento= $_POST["evento"];
    $nombre= $_POST["nombre"];
    $c = new mysqli($host, $user, $pass, "t2gobc");
    $sacaid = $c->query("SELECT id FROM empleado WHERE nombre = '$nombre'");
    $id = $sacaid->fetch_assoc()["id"];
    $sql = "INSERT INTO se_apunta VALUES ( $evento, '$id', null)";
    $c->query($sql);
    if ($c->affected_rows == 1 ){
        echo "Y";
    }    
?>