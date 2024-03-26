<?php
include_once "../models/usuario.php";

$u = new usuario();
$u->id = 3;
$u->clave = "7892";
$u->nombre = "pep1ita";
$u->correo = "pepi3234ta32@gmail.com";
$u->rol = "tio";
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