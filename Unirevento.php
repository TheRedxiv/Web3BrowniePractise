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
    <title>evento</title>
    <script>
        function apuntarse(evento){
            //Establecemos el Timestamp actual en el formato de Mysql
            var ayax = new XMLHttpRequest()
                <?php
                    echo "var nombre = '".$_SESSION['usuario']."'\n"
                ?>
                ayax.onload = function(){
                    if (this.responseText == "Y"){
                        window.alert("Ha sido apuntado")
                    }else{
                        window.alert("No ha podido ser apuntado")
                    }
                }
                ayax.open("POST", "http://127.0.0.1/team2gont/evento.php")
                ayax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                ayax.send("evento="+evento+"&nombre="+nombre)
        }
    </script>
</head>
<body>
    <a href="http://127.0.0.1/team2gont/">home</a>/acceder
    <h1>EVENTOS</h1>
    <div id="eventos"></div>
</body>
<script>
    window.onload = function(){
        var ayax = new XMLHttpRequest();
        ayax.onload = function(){
            var argonauta = JSON.parse(this.responseText)
            if (argonauta.salida == 0){
                document.getElementById("eventos").innerHTML+= "<h3> Lo sentimos, ahora mismo no hay ningun evento abierto, disculpen las molestias</h3>"
            }else{
                for (let i = 1 ; i < argonauta.length ; i++ ){
                    document.getElementById("eventos").innerHTML+= "<h2>evento"+argonauta[i].codigo+"</h2>"
                    document.getElementById("eventos").innerHTML+= "<p> evento de tal fecha : "+argonauta[i].fecha+"</p>"
                    document.getElementById("eventos").innerHTML+= "<p>"+argonauta[i].descripcion+"</p>"
                    document.getElementById("eventos").innerHTML+= "<p><b>Recompensa ="+argonauta[i].valor+" <b><p>"
                    document.getElementById("eventos").innerHTML+= '<button onclick="apuntarse('+argonauta[i].codigo+')">apuntarse</button>'
                }
            }
        }
        ayax.open("GET", "http://127.0.0.1/team2gont/repasoEventos.php");
        ayax.send();
    }
</script>
</html>