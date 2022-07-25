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
    <title>LeaderBoard</title>
</head>
<body>
<a href="http://127.0.0.1/team2gont/">home</a>/LeaderBoard
    <table>
        <tr>
            <th>Empleado</th>
            <th>Puntos</th>
        </tr>
        <?php
        include ("Utils.php");
        $userBalance = leaderBoard();
        for ($i = 0 ; $i < count($userBalance); $i++){
            echo "<tr>";
            echo "<td>".$userBalance[$i]["user"]."</td>";
            echo "<td>".$userBalance[$i]["balance"]."</td>";
            echo "</tr>";
        }
        ?>
</body>
</html>