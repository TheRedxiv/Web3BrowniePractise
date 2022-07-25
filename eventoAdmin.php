<?php
    session_start();
    include ("esAdmin.php");
    if ( ! isset($_SESSION['usuario'])){
        header("Location: http://127.0.0.1/team2gont/iniciaSesion.php");
    }
    if ( ! esAdmin($_SESSION['usuario'])){
        header("Location: http://127.0.0.1/team2gont/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function enviar(){
            var enviar = '[ {"evento":'+evento+'},'
            for (let i = 0; i < apuntados.length; i++){
                enviar += '{"id":'+apuntados[i]+',"participo":"'+document.getElementById(apuntados[i]).value+'"},'
            }
            enviar = enviar.slice(0,-1)+"]"
            var myjson = '{ "key" : "value", "key1" : "value1", "key2" : "value2" }'
            //console.log(enviar)
            var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
            xmlhttp.onload = function(){
                console.log(this.responseText)
                if (this.responseText == "false"){
                    window.alert("este evento ya esta cerrado")
                }
                //window.location.replace('http://127.0.0.1/team2gont/eventosAdmin.html');
            }
            xmlhttp.open("POST", "http://127.0.0.1/team2gont/Brownie/scripts/cerrarevento.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send(enviar);

        }
    </script>
</head>
<body>
    <?php
        $evento = $_GET["codigo"];
        echo "<a href='http://127.0.0.1/team2gont/'>home</a>/<a href='http://127.0.0.1/team2gont/eventosAdmin.php'>Admin</a>/evento$evento";
    ?>
    <table id="tabla">
        <tr>
            <th>Empleado</th>
            <th>participó<th>
        </tr>
        
    </table>
    <button onclick="enviar()">enviar</button>
</body>
<script>
    <?php
    $evento = $_GET["codigo"];
    echo "var evento=$evento \n";
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $Cnombres = $c->query("SELECT * FROM empleado");
    $nombres = "{";
    while ($lineaN = $Cnombres->fetch_assoc()){
        $nombres.= '"'.$lineaN["id"].'":'.json_encode($lineaN).",";
    }
    $nombres = substr($nombres,0,-1)."}";
    echo "var empleados = JSON.parse('$nombres')".";\n";
    $sql = "SELECT id_empleado FROM se_apunta WHERE codigo_evento = $evento";
    $consulta = $c->query($sql);
    $apuntados = "[";
    while ($linea = $consulta->fetch_assoc()){
        $apuntados.= ''.$linea["id_empleado"].',';
    }
    $apuntados = substr($apuntados,0,-1)."]";
    echo "var apuntados = $apuntados \n";
    ?>
    for (let i = 0; i < apuntados.length; i++){
        var linea = empleados[apuntados[i]]
        document.getElementById("tabla").innerHTML += '<tr>'+'<td>'+linea["nombre"]+'</td>'+'<td><select name="'+linea["id"]+' "id="'+linea["id"]+'"><option value="false" selected>NO</option> <option value="true">SI</option></select></tr>'
    }
    </script>
</html>