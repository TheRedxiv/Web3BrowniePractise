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
        function crear(){
            var realiza = document.getElementById("realiza").value
            var recibe = document.getElementById("recibe").value
            var ayax = new XMLHttpRequest();
            ayax.onload = function(){
                window.alert("encuesta con id "+this.responseText+" preparada para rellenar")
            }
            ayax.open("POST", "http://127.0.0.1/team2gont/creaEncuesta.php?")
            ayax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            ayax.send("realiza="+realiza+"&recibe="+recibe);
        }
    </script>
    <?php
        include("ConsultaEmpleados.php");
        $empleados = ConsultaEmpleados();
        $entrada = "";
        for ($i = 0 ; $i < count($empleados); $i++){
            $entrada .= "<option value='".$empleados[$i]["id"]."'>".$empleados[$i]["user"]."</option>";
        }
    ?>

    

</head>
<body>
    <a href="http://127.0.0.1/team2gont/">home</a>/Crear ncuesta <br>
    
    Requerir encuesta sobre <select name="recibe" id="recibe">
    <option value="0">--Elige empleado--</option>
    <?php
        echo $entrada;
    ?>
    </select> </br>
    Quien hará la encuesta <select name="realiza" id="realiza">
    <option value="0">--Elige empleado--</option>
    <?php
        echo $entrada;
    ?>
    
    </select>
    <button onclick="crear()">Crear Encuesta</button>
</body>
</html>