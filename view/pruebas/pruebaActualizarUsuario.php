<?php
include_once "../models/usuario.php";

$id = 1;

try{
    $u = usuario::find($id);
    echo "DATOS ACTUALES DEL USUARIO<br>";
    echo "---------------------<br>";
    echo "<b>ID:</b> $u->id<br>";
    echo "<b>NOMBRE:</b> $u->nombre<br>";
    echo "<b>CORREO:</b> $u->correo<br>";
    echo "<b>CLAVE:</b> $u->clave<br>";
    echo "<b>ROL:</b> $u->rol<br>";
    echo "<br>";

    echo "CAMBIANDO LA CLAVE Y EL CORREO...<br>";

    $u->clave = "123456";
    $u->correo = "correoxyz@gmail.com";
    $u->save();

    echo "<br>";
    echo "DATOS CAMBIADO DEL USUARIO ACTUAL<br>";
    echo "---------------------<br>";
    echo "<b>ID:</b> $u->id<br>";
    echo "<b>NOMBRE:</b> $u->nombre<br>";
    echo "<b>CORREO:</b> $u->correo<br>";
    echo "<b>CLAVE:</b> $u->clave<br>";
    echo "<b>ROL:</b> $u->rol<br>";
    echo "<br>";
}
catch(Exception $error){
    echo $error->getMessage();
}