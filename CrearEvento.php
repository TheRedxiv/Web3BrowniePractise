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
    <title>CrearEvento</title>
    <script>
        function crear(){
            var jaison = "["
            jaison += document.getElementById('codigo').value+","
            jaison += '"'+document.getElementById('fecha').value+'",'
            jaison += '"'+document.getElementById('descripcion').value+'",'
            jaison += document.getElementById('valor').value+"]"
            //console.log(jaison)
            var ayax = new XMLHttpRequest()
            ayax.onload = function(){
                if(this.responseText == "Y"){
                    window.alert("Evento insertado")

                }else{
                    window.alert("Evento ya existente")
                }
            }
            ayax.open("POST", "http://127.0.0.1/team2gont/Insertevento.php")
            ayax.setRequestHeader("Content-Type", "application/json");
            ayax.send(jaison)
        }
    </script>
</head>
<body>
    <p>home</p>
    codigo <input type="number" name="codigo" id="codigo"><br>
    fecha <input type="date" name="fecha" id="fecha"><br>
    descripcion <input type="text" name="descripcion" id="descripcion"><br>
    valor <input type="number" name="valor" id="valor"><br>
    <button onclick="crear()">crear</button>
</body>
</html>