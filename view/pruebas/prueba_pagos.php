<?php
include_once "../models/usuario.php";
include_once "../models/pago.php";

$p = new pago();
$p->fecha = "2024-03-24";
$p->monto = 26000;
$p->id_usuario = "2";
try{
    $p->save();
    $total = @pago::count();
    echo "pagos guardados";
    echo "total: $total";
}
catch(Exception $error){
    $msj = $error->getMessage();
    if(strstr($msj, "Duplicate")){
        echo "el pago ya existe";
    }
}