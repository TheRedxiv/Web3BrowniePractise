<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="GET">
        Usuario<input type="text" name="user" id=""><br>
        Contraseña<input type="text" name="pass" id=""><br>
        <input type="submit" value="Conectarse">
    </form>
    <form action="load-1754685188.us-east-1.elb.amazonaws.com/registra.php" method="get">
        <input type="submit" value="">
    </form>
</body>
</html>
<?php
session_start();
session_unset();
if (isset($_GET['user']) && isset($_GET['pass']) && ! isset($_SESSION["usuario"])){
    $usuario = $_GET["user"];
    $contrasena = $_GET["pass"];
    $sql = "SELECT nombre FROM empleado WHERE nombre = '$usuario' AND pass = '$contrasena'";
    //echo $sql;
    //echo $usuario;
    include("var.inc.php");

    $c = new mysqli($host,$user,$pass,"t2gobc");
    $consulta = $c->query($sql);
    if ($consulta->num_rows == 1){
        echo "sesion iniciada";
        $_SESSION["usuario"]= $usuario;
        header('Location: index.php');
    }else{
        echo "<p style='color:red' >Sesion no iniciada";
    }
}
if(isset($_SESSION["usuario"])){
    header('Location: index.php');
}
?>