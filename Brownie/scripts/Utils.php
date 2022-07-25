<?php
    function sacaId($nombre){
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,"t2gobc");
        $sql = "SELECT id FROM empleado WHERE nombre = '$nombre'";
        $consulta = $c->query($sql);
        $id = $consulta->fetch_assoc()["id"];
        return $id;
    }
    function sacaAddress($id){
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,"t2gobc");
        $sql = "SELECT BCaddress FROM empleado WHERE id = $id";
        $consulta = $c->query($sql);
        $address = $consulta->fetch_assoc()["BCaddress"];
        return $address;
    }
    function sacaBalance($address){
        if ($file = fopen("./temp.py","w")){
            fwrite($file, "cuenta='".$address."'\n");
        }
        return shell_exec('brownie run ./Balance.py --network ganache-local');
    }
    function puntosMes($id){
        $mes = $mes = date("Y-m");
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,"t2gobc");
        $sql = "SELECT puntos FROM puntos_mes WHERE empleado_id = '$id'";
        echo $sql;
        $consulta = $c->query($sql);
        $puntos = $consulta->fetch_assoc()["puntos"];
        return $puntos;
    }
    function sumarPuntos($id, $puntos){
        $mes = date("Y-m");
        $balance = puntosMes($id);
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,"t2gobc");
        $balanceFinal = $balance + $puntos;
        $sql = "UPDATE puntos_mes SET puntos = $balanceFinal WHERE empleado_id = $id AND mes = '$mes'";
        echo $sql;
        $c->query($sql);
    }
    function restaPuntos($address, $puntos){
        $mes = date("Y-m");
        $balance = puntosMes($id);
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,"t2gobc");
        $balanceFinal = $balance + $puntos;
        $sql = "UPDATE puntos_mes SET puntos = $balanceFinal WHERE empleado_id = $id AND nes = '$mes'";
        echo $sql;
        $c->query($sql);
    }
?>
