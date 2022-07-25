<?php
    include("var.inc.php");
    include("Utils.php");
    var_dump($_POST);
    $direccion = $_POST["direccion"];
    $tokens = $_POST["tokens"];
    if ($file = fopen("./temp.py","w")){
        fwrite($file, "cuenta='".$direccion."'\n");
        fwrite($file, "cantidad='".$tokens."'\n");
    }
    shell_exec('brownie run .\vendeTokens.py --network ganache-local');
?>