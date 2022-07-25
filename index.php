<?php
    session_start();
    if ( ! isset($_SESSION['usuario'])){
        header("Location: http://127.0.0.1/team2gont/iniciaSesion.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
    overflow: hidden;
    background-color: #333;
    }

    .topnav button {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    margin: 20px;
    border: 20px;
    display: inline-block;
    }

    .topnav button:hover {
    background-color: #ddd;
    color: black;
    }

    .topnav button.active {
    background-color: #04AA6D;
    color: white;
    }
    #r {
      position: fixed;
      top: 0;
      right: 0;
      width: 250px;
      height: 100%;
      padding: 10px;
    }
</style>
</head>
<body>
    <div id="topnar">
    <button>home</button>
    <button onclick="picar()">picar</button>
    <button>acogida</button>
    </div>
    <div id="r"> 
    <p id="user"></p>
    <p id= "salida"></p>
    </div>
    home/

    <form action="http://127.0.0.1/team2gont/Unirevento.php " style='display:none'>
        <p>acceder a eventos</p>
        <input type="submit" value="eventos">
    </form>
    <?php
    include("./Brownie/scripts/Utils.php");
    include("var.inc.php");
    include("esAdmin.php");
    $nombre = $_SESSION["usuario"];
    $id = sacaId($nombre);
    //echo "Nombre de usuario: " . $_SESSION["usuario"];
    //echo $_SESSION["usuario"];
    if (esAdmin($_SESSION["usuario"])){
        echo "<form action='http://127.0.0.1/team2gont/CreaEvento.html' style='display:none'>\n";
        echo    "<p>crear Evento</p>\n";
        echo    "<input type='submit' value='Crear Eventos'>\n";
        echo "</form>";

        echo "<form action='http://127.0.0.1/team2gont/eventosAdmin.php' style='display:none'>\n";
        echo    "<p>administrar eventos</p>\n";
        echo    "<input type='submit' value='Admin'>\n";
        echo "</form>";

        echo "<form action='http://127.0.0.1/team2gont/RequerirEncuesta.php' style='display:none'>\n";
        echo    "<p>Requerir Encuesta</p>\n";
        echo    "<input type='submit' value='ReqEncuesta'>\n";
        echo "</form>";
        echo "<form action='http://127.0.0.1/team2gont/AdminIncentivos.php'>\n";
        echo    "<p>Administrar Incentivos</p>\n";
        echo    "<input type='submit' value='Administración incentivos'>\n";
        echo "</form>";
        }
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $sql = "SELECT id FROM encuesta WHERE realiza = $id AND abierto = 1";
    $encuestas = $c->query($sql);
    if ($encuestas->num_rows > 0){
        echo "<form action='http://127.0.0.1/team2gont/visualizarEncuestas.php' style='display:none'>\n";
        echo    "<p>Encuestas a Realizar</p>\n";
        echo    "<input type='submit' value='Encuesta'>\n";
        echo "</form>";
    }
    ?>

    <form action="http://127.0.0.1/team2gont/LeerIncentivos.php">
        <p>Incentivos</p>
        <input type="submit" value="Incentivos">
    </form>
    <form action="http://127.0.0.1/team2gont/Market.php">
        <p>exchange</p>
        <input type="submit" value="Market">
    </form>

    <?php
    $sql = "SELECT * FROM adquiere_productos WHERE producto_id= 1 AND empleado_id = $id AND canjeado = 0";
    $consulta = $c->query($sql);
    if ($consulta->num_rows > 0){
        echo "<form action='http://127.0.0.1/team2gont/CanjeaDia.php'>\n";
        echo    "<p>Canjear Dias</p>\n";
        echo    "<input type='submit' value='CanjeaDias'>\n";
        echo "</form>";
    }
    ?>

    <form action="http://127.0.0.1/team2gont/LeaderBoard.php" style="display:none">
        <p>LeaderBoard</p>
        <input type="submit" value="LeaderBoard">
    </form>

    <form action="http://127.0.0.1/team2gont/iniciaSesion.php">
        <p>Cerrar sesion</p>
        <input type="hidden" name="CERRAR" value="1">
        <input type="submit" value="SALIR">
    </form>
</body>
<script>
    <?php
    echo "var nombre = '$nombre' \n";
    $address = sacaAddress(sacaId($nombre));
    echo "var direccion = '$address' \n"
    ?>
    window.onload = actualizaBalance()
    function actualizaBalance(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            console.log(this.responseText)
            document.getElementById("user").innerHTML= "Bienvenido "+nombre+" tienes "+this.responseText+" Tokens"
        };
        xmlhttp.open("GET", "http://127.0.0.1/team2gont/Brownie/scripts/balance.php?direccion="+direccion, true);
        xmlhttp.send();
    }
    function picar(){
            <?php
            echo "var nombre = '$nombre' \n";
            $address = sacaAddress(sacaId($nombre));
            echo "var direccion = '$address' \n";
            echo "var id =".sacaId($nombre);
            ?>
            //Establecemos el Timestamp actual en el formato de Mysql
            const weekday = ["Domingo","lunes","martes","miercoles","jueves","Viernes","Sabado"];
            const d = new Date();
            let day = weekday[d.getDay()];
            var timestamp = new Date().toISOString().split('T')[0] + ' ' +new Date().toTimeString().split(' ')[0];
            var ayax = new XMLHttpRequest()
                ayax.onload = function(){
                    console.log(this.responseText)
                if (this.responseText == "Y"){
                    window.alert("Picada correcta")
                    GanarPuntos(day, direccion)
                }else{
                    window.alert("Picada fallida")
                }
            }
            ayax.open("POST", "http://127.0.0.1/team2gont/picar.php")
            ayax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ayax.send("timestamp="+timestamp+"&nombre="+nombre)
        }
        function GanarPuntos(dia, address){
            var ayax = new XMLHttpRequest()
            ayax.onload= function(){
                let texto = this.responseText
                console.log(texto)
                let salida = texto.substring(texto.length - 20)
                document.getElementById("salida").innerHTML= salida
                actualizaBalance()
                setTimeout(() => {document.getElementById("salida").innerHTML= ""; }, 5000)

            }
            ayax.open("POST", "http://127.0.0.1/team2gont/Brownie/scripts/picar.php")
            ayax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ayax.send("dia="+dia+"&address="+address)
        }
    </script>
</html>
