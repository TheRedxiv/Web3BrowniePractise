<?php
$data = file_get_contents('php://input');
//echo $data;
$data = json_decode( $data, true );
//var_dump($data);
include("var.inc.php");
include("Utils.php");
$c = new mysqli($host, $user, $pass, "t2gobc");

//consultamos si el evento esta cerrado o no
$Lineacerrado = $c->query("SELECT cerrado FROM evento WHERE codigo = ".$data[0]["evento"]);
$cerrado = $Lineacerrado->fetch_assoc()["cerrado"];

//Si esta cerrado no actualizamos
if ($cerrado == 1 ){
    echo "false";
}else{

    for ( $i = 1; $i < count($data); $i++){
        $sql = "UPDATE se_apunta SET asistencia = ".$data[$i]["participo"]."  WHERE id_empleado = ".$data[$i]["id"]." AND codigo_evento = ".$data[0]["evento"];
        echo $sql."\n";
        $c->query($sql);
    }
    //saco valor del evento
    $consultaValor = $c->query("SELECT valor FROM evento WHERE codigo = ".$data[0]["evento"]);
    $valor = $consultaValor->fetch_assoc()["valor"];
    //saco los asistentes confirmados
    $beneficiadosId = [];
    $beneficiados = [];
    $consultaBeneficiados = $c->query("SELECT BCaddress, id FROM empleado JOIN se_apunta ON se_apunta.id_empleado = empleado.id WHERE asistencia = true AND codigo_evento =".$data[0]["evento"]);
    while ($linea = $consultaBeneficiados->fetch_assoc()){
        array_push($beneficiados, $linea["BCaddress"] );
        array_push($beneficiadosId, $linea["id"] );
    }
    var_dump($beneficiados);

    //Cierro el evento
    $sql = "UPDATE evento SET cerrado = true WHERE codigo = ".$data[0]["evento"];
    $c->query($sql);

    //empezamos a asignar tokens
    $b = new mysqli($host, $user, $pass, "blockchaint");

    //Saco el valor de las carteras beneficiarias
    $balances = array();
    for ($i = 0; $i < count($beneficiados); $i++){
        if ($file = fopen("./temp.py","w")){
            fwrite($file, "cuenta='".$beneficiados[$i]."'\n");
            fwrite($file, "cantidad=".$valor);
        }
        echo shell_exec('brownie run ./canjeo.py --network ganache-local');
        echo "terminado";

    }
    for ($i = 0; $i < count($beneficiadosId); $i++){
        sumarPuntos($beneficiadosId[$i], $valor);
    }
}
//var_dump($balances[$beneficiados[0]]);

?>