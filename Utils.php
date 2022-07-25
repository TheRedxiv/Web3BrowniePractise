<?php
    function sacaNombre($id){
        include("var.inc.php");
        $c = new mysqli($host,$user,$pass,"t2gobc");
        $sql = "SELECT nombre FROM empleado WHERE id = '$id'";
        $consulta = $c->query($sql);
        $nombre = $consulta->fetch_assoc()["nombre"];
        return $nombre;
    }
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
        include("var.inc.php");
        $b = new mysqli($host,$user,$pass,"blockchaint");
        $sql = "SELECT balance FROM user WHERE address = '$address'";
        $consulta = $b->query($sql);
        $address = $consulta->fetch_assoc()["balance"];
        return $address;
    }
    function sumarPuntos($address, $puntos){
        $balance = sacaBalance($address);
        include("var.inc.php");
        $b = new mysqli($host,$user,$pass,"blockchaint");
        $balanceFinal = $balance + $puntos;
        $sql = "UPDATE user SET balance = $balanceFinal WHERE address = '$address'";
        echo $sql;
        $b->query($sql);
    }
    function restaPuntos($address, $puntos){
        $balance = sacaBalance($address);
        include("var.inc.php");
        $b = new mysqli($host,$user,$pass,"blockchaint");
        $balanceFinal = $balance - $puntos;
        $sql = "UPDATE user SET balance = $balanceFinal WHERE address = '$address'";
        echo $sql;
        $b->query($sql);
    }
    function leaderBoard(){
        $mes = date("Y-m");
        include("var.inc.php");
        $c = new mysqli($host, $user, $pass, "t2gobc");
        $sql = "SELECT empleado_id, puntos FROM puntos_mes WHERE mes = '$mes' ORDER BY puntos desc LIMIT 3";
        $consulta = $c->query($sql);
        $userAdd = array();
        $i = 0;
        while ($linea = $consulta->fetch_assoc()){
            $userAdd[$i]["balance"] = $linea["puntos"] ;
            $userAdd[$i]["user"] = sacaNombre($linea["empleado_id"]);
            $userAdd[$i]["id"] = $linea["empleado_id"];
            $i++;
        }
        return $userAdd;
    }
    function tipoPuntualidad(){
        include("var.inc.php");
        $c = new mysqli($host, $user, $pass, "t2gobc");
        $sql = "SELECT * from puntualidad";
        $consulta = $c->query($sql);
        $salida = $consulta->fetch_assoc()["tipo"];
        return $salida;
    }
    function tipoPeriodo(){
        include("var.inc.php");
        $c = new mysqli($host, $user, $pass, "t2gobc");
        $sql = "SELECT * from puntualidad_periodo";
        $consulta = $c->query($sql);
        $salida = $consulta->fetch_assoc()["periodo"];
        return $salida;
    }
?>
