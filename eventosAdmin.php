<?php
    session_start();
    include ("esAdmin.php");
    if ( ! isset($_SESSION['usuario'])){
        header("Location: http://127.0.0.1/team2gont/iniciaSesion.php");
    }
    if (! esAdmin($_SESSION['usuario'])){
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
        function entrar(codigo){
            window.location.replace('http://127.0.0.1/team2gont/eventoAdmin.php?codigo='+codigo);
        }
    </script>
</head>
<body>
<a href="http://127.0.0.1/team2gont/">home</a>/Admin
    <h1>eventos</h1>
    <div id="entrada"></div>
</body>
<script>
    window.onload = function(){
        var ayax = new XMLHttpRequest();
        ayax.onload = function(){
            var argonauta = JSON.parse(this.responseText)
            if (argonauta.salida == 0){
                document.getElementById("entrada").innerHTML+= "<h3> Lo sentimos, ahora mismo no hay ningun evento abierto, disculpen las molestias</h3>"
            }else{
                for (let i = 1 ; i < argonauta.length ; i++ ){
                    document.getElementById("entrada").innerHTML+= "<h1>evento"+argonauta[i].codigo+"</h1>"
                    document.getElementById("entrada").innerHTML+= "<p> evento de tal fecha : "+argonauta[i].fecha+"</p>"
                    document.getElementById("entrada").innerHTML+= "<form method='GET' action=http://127.0.0.1/team2gont/eventoAdmin.php?'><input type='hidden' name='codigo' value='"+argonauta[i].codigo+"''><input type='submit' value='eventos'>"
                }
            }

        }
        ayax.open("GET", "http://127.0.0.1/team2gont/repasoEventos.php");
        ayax.send();
    }
</script>
</html>