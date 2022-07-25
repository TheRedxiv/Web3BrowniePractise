<?php
    echo "llegue a compra.php";
    include("var.inc.php");
    include("Utils.php");
    $direccion =  sacaAddress($_POST["user"]);
    $productoId = $_POST["producto"];
    $userId = $_POST["user"];
    $precio= $_POST["precio"];
    if ($file = fopen("./temp.py","w")){
        fwrite($file, "cuenta='".$direccion."'\n");
    }
    //echo "Ejecuto script";
    $entrada = shell_exec('brownie run .\Balance.py --network ganache-local');
    //echo "balance sacado";
    $string = explode('...', $entrada);
    $balance = array_pop($string);
    if ($balance < $precio){
        echo "N";
    }else{
        if ($file = fopen("./temp.py","w")){
            fwrite($file, "cuenta='".$direccion."'\n");
            fwrite($file, "cantidad='".$precio."'\n");
        }
        shell_exec('brownie run .\compra.py --network ganache-local');
        echo "terminé";
        $c = new mysqli($host,$user,$pass,$bd);
        $sql = "INSERT INTO adquiere_productos VALUES (null, $productoId, $userId, 0)";
        $c->query($sql);
    }
        //var_dump($_POST);


    //$direccion = sacaAddress($userId);
    //$balance = sacaBalance($direccion);
    //$c = new mysqli($host, $user, $pass, "t2gobc");
    //$sql  = "SELECT precio FROM productos WHERE id = $productoId";
    //echo $sql;
    //$consulta = $c->query($sql);
    //$precio = $consulta->fetch_assoc()["precio"];
?>