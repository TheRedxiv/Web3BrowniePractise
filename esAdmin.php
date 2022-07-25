<?php
    function esAdmin($usuario){
        $host="localhost";
        $user="root";
        $pass="";
        $es = new mysqli($host,$user,$pass,"t2gobc");
        $sql = "SELECT admin FROM empleado WHERE nombre = '$usuario'";
        //echo $sql;
        $consulta = $es->query($sql);
        $admin = $consulta->fetch_assoc()["admin"];
        if ($admin==1){
            return true;
        }else{
            return false;
        }
    }
?>