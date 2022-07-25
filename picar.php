<?php
if (isset($_POST["nombre"])){
    //echo "Y"; //ELIMINAR AL FINAL
    include("var.inc.php");
    $c = new mysqli($host, $user, $pass, "t2goBC");
    $nombre = $_POST["nombre"];
    $sacaid = $c->query("SELECT id FROM empleado WHERE nombre = '$nombre'");
    $id = $sacaid->fetch_assoc()["id"];
    $timestamp = $_POST["timestamp"];
    $time = substr($timestamp, -8);
    $date = substr($timestamp, 0,10);
    $sql = "INSERT INTO se_conecta VALUES ($id, '$date', '$time')";
    $consulta = $c->query($sql);
    if ($c->affected_rows == 1 ){
        echo "Y";
    }
}

?>