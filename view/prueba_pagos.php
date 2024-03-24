<?php
include_once "../models/usuario.php";
include_once "../models/pago.php";

$p = new pago();
$p->fecha = "2024-03-23";
$p->monto = 25000;
$p->id_usuario = "1";
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