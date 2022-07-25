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
</head>
<body>
<a href="http://127.0.0.1/team2gont/">home</a>/encuestas
    <?php
    include("Utils.php");
    include("var.inc.php");
    $nombre = $_SESSION['usuario'];
    $id = sacaId($nombre);
    $c = new mysqli($host,$user,$pass,"t2gobc");
    $sql = "SELECT id FROM encuesta WHERE REALIZA = $id AND abierto = 1";
    $consulta = $c->query($sql);
    while ($linea = $consulta->fetch_assoc()){
        echo "<form method='GET' action=http://127.0.0.1/team2gont/realizaEncuesta.php?'>";
        echo "<p>Resolver encuesta ".$linea["id"]." </p>";
        echo "<input type='hidden' name='encuesta' value='".$linea["id"]."'>";
        echo "<input type='submit'>";
        echo "</form>";
    }
    ?>
</body>
</html>