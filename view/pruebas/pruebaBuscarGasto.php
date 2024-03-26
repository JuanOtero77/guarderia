<?php
include_once "../models/usuario.php";
include_once "../models/pago.php";

$id = 1;

try{
    $p = pago::find($id);
    echo "<b>ID:</b> $p->id<br>";
    echo "<b>FECHA:</b> $p->fecha<br>";
    echo "<b>MONTO:</b> $p->monto<br>";
    $u = $p->usuario;
    echo "<br>";
    echo "---------------------<br>";
    echo "USUARIO <br>";
    echo "---------------------<br>";
    echo "<b>ID: </b> $u->id<br>";
    echo "<b>NOMBRE: </b> $u->nombre<br>";
    echo "<b>CORREO: </b> $u->correo<br>";
    echo "<b>CLAVE: </b> $u->clave<br>";
    echo "<b>ROL: </b> $u->rol<br>";
} catch(Exception $error){
    echo $error->getMessage();
}
