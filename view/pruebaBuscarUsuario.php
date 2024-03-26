<?php
include_once "../models/usuario.php";

$id = 1;

try{
    $u = usuario::find($id);
    echo "<b>ID:</b> $u->id<br>";
    echo "<b>NOMBRE:</b> $u->nombre<br>";
    echo "<b>CORREO:</b> $u->correo<br>";
    echo "<b>CLAVE:</b> $u->clave<br>";
    echo "<b>ROL:</b> $u->rol<br>";

    $pagos = $u->pagos;
    $numero_pagos = count($pagos);
    echo "<br>";
    echo "PAGOS: $numero_pagos<br>";
    $suma_total_pagos = 0;
    foreach($pagos as $i => $p){
        echo "---------------------<br>";
        echo "PAGO #".($i + 1)."<br>";
        echo "---------------------<br>";
        echo "<b>ID:</b> $p->id<br>";
        echo "<b>FECHA:</b> $p->fecha<br>";
        echo "<b>MONTO:</b> $p->monto<br>";
        $suma_total_pagos += $p->monto; 
    }
    echo "<h3><b>TOTAL GASTOS: $</b> $suma_total_pagos";
}
catch(Exception $error){
    echo $error->getMessage();
}