<?php
session_start();
if ( ! isset($_SESSION['usuario'])){
    header("Location: http://127.0.0.1/team2gont/");
}
include("Utils.php");
include("var.inc.php");
if (isset($_GET["encuesta"])){
    $encuestaId = $_GET["encuesta"];
    $userId = sacaId($_SESSION["usuario"]);
    $c = new mysqli($host, $user, $pass, "t2gobc");
    $sql = "SELECT * FROM encuesta WHERE id = $encuestaId AND realiza = $userId";
    $consulta = $c->query($sql);
    $match = $consulta->num_rows;
    if (! $match > 0){
        echo "aqui no";
        //header("Location: http://127.0.0.1/team2gont/iniciaSesion.php");
    }
}else{
    echo "falta Get";
    //header("Location: http://127.0.0.1/team2gont/iniciaSesion.php");
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
            var organizacion = document.getElementById("organizacion").value
            var liderazgo = document.getElementById("liderazgo").value
            var iniciativa = document.getElementById("iniciativa").value
            var teamwork = document.getElementById("teamwork").value
            var texto = document.getElementById("extra").value
            <?php
            echo "var encuestaId = $encuestaId \n";
            echo "var userId = $userId \n";
            ?>
            ayax = new XMLHttpRequest();
            ayax.onload = function(){
                console.log(this.responseText)
                }
            ayax.open("POST", "http://127.0.0.1/team2gont/Brownie/scripts/rellenarEncuesta.php?")
            ayax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            ayax.send("userID="+userId+"&encuestaId="+encuestaId+"&organizacion="+organizacion+"&liderazgo="+liderazgo+"&iniciativa="+iniciativa+"&teamwork="+teamwork+"&texto="+texto);
        }
    </script>
</head>
<body>
<a href='http://127.0.0.1/team2gont/'>home</a>/<a href='http://127.0.0.1/team2gont/visualizarEncuestas.php'>encuestas</a>/encuesta <br>
    organizacion<input type="number" name="organizacion" id="organizacion"><br>
    liderazgo<input type="number" name="liderazgo" id="liderazgo"><br>
    iniciativa<input type="number" name="iniciativa" id="iniciativa"><br>
    teamwork<input type="number" name="teamwork" id="teamwork"><br>
    comentarios<textarea name="extra" id="extra" rows="4" cols="50"></textarea><br>
    <button onclick="enviar()">enviar encuesta</button>
</body>
</html>