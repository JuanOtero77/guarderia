<?php
include_once "../models/usuario.php";

$u = new usuario();
$u->clave = "1234";
$u->nombre = "pepito";
$u->correo = "pepito23@gmail.com";
$u->rol = "admin";
try{
    $u->save();
    $total = @usuario::count();
    echo "usuarios guardados";
    echo "total: $total";
}
catch(Exception $error){
    $msj = $error->getMessage();
    if(strstr($msj, "Duplicate")){
        echo "el usuario ya existe";
    }
}