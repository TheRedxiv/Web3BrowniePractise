<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("var.inc.php");
    $c = new mysqli($host,$user,$pass,$bd);
    $sql = "SELECT * FROM puntualidad";
    $consulta = $c->query($sql);
    $linea = $consulta->fetch_assoc();
    $tipo = $linea["tipo"];
    $fin = $linea["fin"];
    $salida = "";
    //echo $tipo;
    //echo $fin;
    if ($fin != ""){
        $salida = "Hasta el dia $fin.";
    }
    if ($tipo == "diario"){
        $salida .= "en el sistema Team2Block sera recompensado segun la siguiente estructura semanal";
        echo "<p>".$salida."</p>";
        $sql = "SELECT * FROM puntualidad_dias";
        $consulta = $c->query($sql);
        $linea = $consulta->fetch_assoc();
        $lunes = $linea["lunes"];
        $martes = $linea["martes"];
        $miercoles = $linea["miercoles"];
        $jueves = $linea["jueves"];
        $Viernes = $linea["Viernes"];
        echo "<table>\n";
        echo "<tr>\n";
        echo "<th>\n";
        echo "Lunes";
        echo "</th>\n";
        echo "<th>\n";
        echo "Martes";
        echo "</th>\n";
        echo "<th>\n";
        echo "Miercoles";
        echo "</th>\n";
        echo "<th>\n";
        echo "Jueves";
        echo "</th>\n";
        echo "<th>\n";
        echo "Viernes";
        echo "</th>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<th>\n";
        echo "$lunes";
        echo "</th>\n";
        echo "<th>\n";
        echo "$martes";
        echo "</th>\n";
        echo "<th>\n";
        echo "$miercoles";
        echo "</th>\n";
        echo "<th>\n";
        echo "$jueves";
        echo "</th>\n";
        echo "<th>\n";
        echo "$Viernes";
        echo "</th>\n";
        echo "</tr>\n";
        echo "</table>\n";
    }
    if ($tipo == "periodo"){
        $sql = "SELECT * FROM puntualidad_periodo";
        $consulta = $c->query($sql);
        $linea = $consulta->fetch_assoc();
        $periodo = $linea["periodo"];
        $numero = $linea["numero"];
        $recompensa = $linea["recompensa"];
        if ($periodo == "MES"){
            $periodo = "mes/es";
        }
        if ($periodo == "SEM"){
            $periodo = "semana/s";
        }
        if ($periodo == "ANIO"){
            $periodo = "año/s";
        }
        $salida .= "En el sistema Team2Block sera recompensado cada $numero $periodo con la recomensa de $recompensa tokens";
        echo "<p>".$salida."</p>";
    };
    $sql = "SELECT * FROM puntualidad_bonus";
    $consulta = $c->query($sql);
    $linea = $consulta->fetch_assoc();
    $activo = $linea["activo"];
    if ($activo == 1){
        $periodo = $linea["tipo"];
        if ($periodo == "MES"){
            $periodo = "mes";
        }
        if ($periodo == "SEM"){
            $periodo = "semana";
        }
        if ($periodo == "ANIO"){
            $periodo = "año";
        }
        $recompensa = $linea["recompensa"];
        echo "Hay bonus, Por cada $periodo consecutivo seras bonificado con $recompensa tokens";
    }
    ?>
</body>
    <script>
        function tipoPuntualidad(){

        }
        var salida = "Hasta el "+""+"cada dia que te conectes recibiras las siguientes recompensas dependiendo de la siguiente tabla"
        var salida2= "Ademas recibireis el bonus de tokens si se realiza una racha "
    </script>
</html>