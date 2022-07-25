<?php
$precio = $_POST["precio"];
$id = $_POST["id"];
include("var.inc.php");
$c= new mysqli($host,$user,$pass,$bd);
$sql = "UPDATE productos set precio = $precio where id= $id ";
$c->query($sql)
?>