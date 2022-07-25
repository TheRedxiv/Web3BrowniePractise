<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<a href="http://127.0.0.1/team2gont/">home</a>/Administrar incentivos<br>
    <button onclick="abrir()">puntualidad</button>
    <div id="Puntualidad" style="visibility : hidden">
        <table>
        <h3>Variable</h3>
            <?php
            include("Utils.php");
            if (tipoPuntualidad() == "diario"){
                echo "<input type='radio' id='diario' name='tipo' value='diario' checked>\n";
            }else{
                echo "<input type='radio' id='diario' name='tipo' value='diario'>\n";
            }
            ?>

            <tr>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
            <tr>
                <td ><input id="lunes" type="number" step="0.01"></td>
                <td ><input id="martes"" type="number" step="0.01"></td>
                <td ><input id="miercoles" type="number" step="0.01"></td>
                <td ><input id="jueves" type="number" step="0.01"></td>
                <td ><input id="Viernes" type="number" step="0.01"></td>
            </tr>
        </table>
        <h3>Fijo</h3>
        <?php
        if (tipoPuntualidad() == "periodo"){
            echo "<input type='radio' id='periodo' name='tipo' value='periodo' checked>\n";
        }else{
            echo "<input type='radio' id='periodo' name='tipo' value='periodo'>\n";
        }
        ?>
        <table>
            <tr>
                <th>tipo</th>
                <th>duracion</th>
                <th>recompensa</th>
            </tr>
            <tr>
                <td ><select name="tipo" id="tipo">
                    <?php
                    if (tipoPeriodo() == "SEM"){
                        echo '<option value="SEM" selected>semana</option>';
                    }else{
                        echo '<option value="SEM">semana</option>';
                    }
                    if (tipoPeriodo() == "MES"){
                        echo '<option value="MES" selected>mes</option>';
                    }else{
                        echo '<option value="MES">mes</option>';
                    }
                    if (tipoPeriodo() == "ANIO"){
                        echo '<option value="ANIO" selected>anual</option>';
                    }else{
                        echo '<option value="ANIO">anual</option>';
                    }
                    ?>
                </select></td>
                <td ><input id="duracion" type="number" step="0.01"></td>
                <td ><input id="recompensa" type="number" step="0.01"></td>
            </tr>
        </table>
        desde <input type="date" id="desde">
        finalizar <input type="checkbox" name="fin" id="fin"> <input type="date" id="Finalizar"><br>
        bonus <input type="checkbox" name="checkBonus" id="checkBonus"> <input type="number" id="bonus"> cada <select name="bonusTiempo" id="bonusTiempo">
        <option value="SEM">semana</option>
        <option value="MES">mes</option>
        <option value="ANIO">anual</option>
        </select>
        <button onclick="confirmarDias()">Confirmar</button>
    </div>
</body>
<script>
    function abrir(){
        actualizaDias()
        actualizaPeriodo()
        actualizaFin()
        actualizaBonus()
        var today = new Date();
        document.getElementById("desde").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
        console.log("hola")
        document.getElementById("Puntualidad").style.visibility = 'visible'
    }



    function confirmarDias(){
        console.log(document.querySelector("input[name=tipo]:checked").value)
        if(document.querySelector("input[name=tipo]:checked").value == "diario"){
            enviarDias()
        }
        if(document.querySelector("input[name=tipo]:checked").value == "periodo"){
            enviarPeriodos()
        }
        estableceBonus()
    }
    function actualizaDias(){
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            var argonauta = JSON.parse(this.responseText)
            document.getElementById("lunes").value = argonauta["lunes"]
            document.getElementById("martes").value = argonauta["martes"]
            document.getElementById("miercoles").value = argonauta["miercoles"]
            document.getElementById("jueves").value = argonauta["jueves"]
            document.getElementById("Viernes").value = argonauta["Viernes"]
        }
        ayax.open("GET", "http://127.0.0.1/team2gont/valordias.php");
        ayax.send();
    }

    function estableceBonus(){
        if (document.getElementById("checkBonus").checked){
            var activo = "1"
        }else{
            var activo = "0"
        }
        var valor = document.getElementById("bonus").value
        var bonusTiempo = document.getElementById("bonusTiempo").value
        var enviar = '{"bonusTiempo":"'+bonusTiempo+'", "valor":'+valor+', "activo":'+activo+'}'
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            console.log(this.responseText)
        }
        ayax.open("POST", "http://127.0.0.1/team2gont/ActualizaBonus.php");
        ayax.setRequestHeader("Content-Type", "application/json");
        ayax.send(enviar);
    }

    function actualizaPeriodo(){
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            var argonauta = JSON.parse(this.responseText)
            document.getElementById("duracion").value = argonauta["numero"]
            document.getElementById("recompensa").value = argonauta["recompensa"]
        }
        ayax.open("GET", "http://127.0.0.1/team2gont/valorPeriodos.php");
        ayax.send();
    }
    function actualizaFin(){
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            var argonauta = JSON.parse(this.responseText)
            console.log(argonauta)
            document.getElementById("Finalizar").value = argonauta["fin"]
            if (argonauta["fin"] != null){
                document.getElementById("fin").checked = true
            }
        }
        ayax.open("GET", "http://127.0.0.1/team2gont/valorFin.php");
        ayax.send();
    }
    function actualizaBonus(){
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            var argonauta = JSON.parse(this.responseText)
            if (argonauta["activo"] == 1){
                document.getElementById("checkBonus").checked = true
            }
            document.getElementById("bonus").value = argonauta["recompensa"]
            document.getElementById("bonusTiempo").value = argonauta["tipo"]
        }
        ayax.open("GET", "http://127.0.0.1/team2gont/valorBonus.php");
        ayax.send();
    }
    function enviarPeriodos(){
        if(document.getElementById("fin").checked){
            var fin = "'"+document.getElementById("Finalizar").value+"'"
        }else{
            var fin = "null"
        }
        let enviar = '{"fin":"'+fin+'","tipo":"periodo", "periodo":"'+document.getElementById("tipo").value+'", "numero":'+document.getElementById("duracion").value+',"recompensa":'+document.getElementById("recompensa").value+'}'
        console.log(enviar)
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            console.log(this.responseText)
        }
        ayax.open("POST", "http://127.0.0.1/team2gont/ActualizaDias.php");
        ayax.setRequestHeader("Content-Type", "application/json");
        ayax.send(enviar);
        document.getElementById("Puntualidad").style.visibility = 'hidden'
    }
    function enviarDias(){
        console.log(document.getElementById("fin").checked)
        if(document.getElementById("fin").checked){
            var fin = "'"+document.getElementById("Finalizar").value+"'"
        }else{
            var fin = "null"
        }
        console.log("ESTO ESTOY ENVIANDO CON FIN"+fin+" \n")
        enviar = '{"fin":"'+fin+'", "tipo":"diario", "lunes":'+document.getElementById("lunes").value+',"martes":'+document.getElementById("martes").value+',"miercoles":'+document.getElementById("miercoles").value+',"jueves":'+document.getElementById("jueves").value+',"Viernes":'+document.getElementById("Viernes").value+'}'
        console.log(enviar)
        var ayax = new XMLHttpRequest()
        ayax.onload = function(){
            console.log(this.responseText)
        }
        ayax.open("POST", "http://127.0.0.1/team2gont/ActualizaDias.php");
        ayax.setRequestHeader("Content-Type", "application/json");
        ayax.send(enviar);
        document.getElementById("Puntualidad").style.visibility = 'hidden'
    }
    </script>
</html>