<?php
session_start();
if ( ! isset($_SESSION['usuario'])){
    header("Location: http://127.0.0.1/team2gont/");
}
include("./Brownie/scripts/Utils.php");
include("esAdmin.php");
$nombre = $_SESSION["usuario"];
$userId = sacaId($_SESSION["usuario"]);
$direccion = sacaAddress(sacaId($_SESSION["usuario"]));
$balance = sacaBalance($direccion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function comprar(productoId,userId,precio){
                var ayax = new XMLHttpRequest();
                ayax.onload = function(){
                    console.log(this.responseText)
                    if (this.responseText == "N"){
                        window.alert("No se pudo realizar la compra");
                    }else{
                        document.getElementById("salida").innerHTML= "Has comprado 1 dia"
                        actualizaBalance()
                        setTimeout(() => {document.getElementById("salida").innerHTML= ""; }, 5000)
                    }
                }
                ayax.open("POST", "http://127.0.0.1/team2gont/Brownie/scripts/compra.php?")
                ayax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
                ayax.send("producto="+productoId+"&user="+userId+"&precio="+precio);
        }
        function cambiaPrecio(id){
            var inputId = "id"+id;
            var precio = document.getElementById(inputId).value
            var ayax = new XMLHttpRequest();
                ayax.onload = function(){
                    console.log(this.responseText)
                    document.location.reload(true)
                }
                ayax.open("POST", "http://127.0.0.1/team2gont/cambiaPrecio.php?")
                ayax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
                ayax.send("precio="+precio+"&id="+id);
        }
    </script>
</head>
<body>
    <a href="http://127.0.0.1/team2gont/">home</a>/Market<br>
    <h1>Productos</h1>
    <p id="user"></p>
    <p id="salida"> </p>
    <?php
    include ("var.inc.php");
    $c = new mysqli($host, $user, $pass, "t2gobc");
    $sql = "SELECT * FROM productos";
    $consulta = $c->query($sql);
    while ($linea = $consulta->fetch_assoc()){
        echo "<p>".$linea["nombre"]." precio ".$linea["precio"]." T2GO<p>\n";
        echo "<button onclick='comprar(".$linea["id"].",".$userId.",".$linea["precio"].")'>comprar</button>\n";
    }
    if (esAdmin($_SESSION["usuario"])){
        echo "<h1>cambiar precio</h1>";
        $consulta = $c->query($sql);
        while ($linea = $consulta->fetch_assoc()){
            echo "<p>".$linea["nombre"]." precio ".$linea["precio"]." T2GO<p>\n";
            echo '<input type="number" value='.$linea["precio"].' name="" id="id'.$linea["id"].'">';
            echo "<button onclick='cambiaPrecio(".$linea["id"].")'>cambiar</button>\n";
        }
    }
    ?>
    <div id= "VendeTokens">
        <p>En venta</p> <br>
        <div id="en_venta"></div>
        <input type="number" id="TokensVenta">:
        <button onclick="vendeTokens()">Vende</button>
    </div>
</body>
<script>
    <?php
    echo "var nombre = '$nombre' \n";
    $address = sacaAddress(sacaId($nombre));
    echo "var direccion = '$direccion' \n"
    ?>
    window.onload = inicio()


    function inicio(){
        actualizaBalance()
        enVenta()
    }

    function actualizaBalance(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            console.log(this.responseText)
            document.getElementById("user").innerHTML= "Bienvenido "+nombre+" tienes "+this.responseText+" Tokens"
        };
        xmlhttp.open("GET", "http://127.0.0.1/team2gont/Brownie/scripts/balance.php?direccion="+direccion, true);
        xmlhttp.send();
    }

    function enVenta(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            console.log(this.responseText)
            argonauta=JSON.parse(this.responseText)
            console.log(argonauta)
            for (let i = 0 ; i < argonauta.length; i++){
                document.getElementById("en_venta").innerHTML+=
            }
        };
        xmlhttp.open("GET", "http://127.0.0.1/team2gont/Brownie/scripts/enVenta.php?", true);
        xmlhttp.send();
    }

    function vendeTokens(){
        var Tokens = document.getElementById("TokensVenta").value
        var ayax = new XMLHttpRequest();
                ayax.onload = function(){
                    console.log(this.responseText)
                }
                ayax.open("POST", "http://127.0.0.1/team2gont/Brownie/scripts/vendeTokens.php?");
                ayax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                ayax.send("tokens="+Tokens+"&direccion="+direccion);
    }
    </script>

</html>