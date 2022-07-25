<?php
session_start();
if ( ! isset($_SESSION['usuario'])){
    header("Location: http://127.0.0.1/team2gont/");
}
include("Utils.php");
$userId = sacaId($_SESSION["usuario"]);
$balance = sacaBalance(sacaAddress(sacaId($_SESSION["usuario"])));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function canjear(productoId){
            var dia = document.getElementById("dia"+productoId).value
            var ayax = new XMLHttpRequest();
            ayax.onload = function(){
                console.log(this.responseText)
                document.getElementById("diap"+productoId).style = "visibility: hidden"
                document.getElementById("dia"+productoId).style = "visibility: hidden"
                document.getElementById("diab"+productoId).style = "visibility: hidden"
            }
            ayax.open("POST", "http://127.0.0.1/team2gont/cerrarDia.php?")
            ayax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            ayax.send("id="+productoId+"&dia="+dia);            
        }
    </script>
</head>
<body>
    <a href="http://127.0.0.1/team2gont/">home</a>/CanjeaDias<br>
    <?php
    include ("var.inc.php");
    $c = new mysqli($host, $user,$pass, "t2gobc");
    $sql = "SELECT * FROM adquiere_productos WHERE producto_id= 1 AND empleado_id = $userId AND canjeado = 0";
    $consulta = $c->query($sql);
    $i = 1;
    while ($linea = $consulta->fetch_assoc()){
        echo "<p id='diap".$linea["id"]."'>canjear dia $i</p>\n";
        echo "    <input type='date' id='dia".$linea["id"]."'>\n";
        echo "    <button id='diab".$linea["id"]."' onclick='canjear(".$linea["id"].")'>canjea</button><br>\n";
    }
    ?>
</body>
</html>