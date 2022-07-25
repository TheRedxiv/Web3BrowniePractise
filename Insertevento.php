<?php
$data = file_get_contents('php://input');
//echo $data;
$data = json_decode( $data, true );
//var_dump($data);
include("var.inc.php");
$c = new mysqli($host, $user, $pass, "t2gobc");
$sql = "INSERT INTO evento VALUES (".$data[0].", '".$data[1]."', 0 ,'".$data[2]." ' , ".$data[3].")";
$c->query($sql);
if ($c->affected_rows == 1){
    echo "Y";
}else{
    echo "N";
}
?>