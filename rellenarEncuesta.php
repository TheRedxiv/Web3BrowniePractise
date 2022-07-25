<?php
var_dump($_POST);
$organizacion = $_POST["organizacion"];
$liderazgo = $_POST["liderazgo"];
$iniciativa = $_POST["iniciativa"];
$teamwork = $_POST["teamwork"];
$texto = $_POST["texto"];
$userId = $_POST["userID"];
$encuestaId = $_POST["encuestaId"];
$media = ($organizacion+$liderazgo+$iniciativa+$teamwork)/4;
$fecha = date("Y-m-d");
echo "$media/$userId/$encuestaId///$fecha";
include("var.inc.php");
$c = new mysqli($host, $user, $pass, "t2gobc");
$sql = "UPDATE encuesta SET organizacion = $organizacion, liderazgo = $liderazgo, iniciativa = $iniciativa, teamwork = $teamwork, Comentarios = '$texto', Abierto = 0, fecha = '$fecha' WHERE id = $encuestaId";
echo $sql;
$c->query($sql);
if ($media >= 8 ){
    include ("Utils.php");
    $sql = "SELECT recibe FROM encuesta WHERE id = $encuestaId";
    $consulta = $c->query($sql);
    $recibeId= $consulta->fetch_assoc()["recibe"];
    sumarPuntos(sacaAddress($recibeId),2);
}

?>