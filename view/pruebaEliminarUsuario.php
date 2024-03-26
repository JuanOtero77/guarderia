<?php
include_once "../models/usuario.php";

$id = 1;

try{
    $lista_objt_usuarios = usuario::all();
    $cuenta_usuarios = count($lista_objt_usuarios);
    echo "<h3><b>TOTAL USUARIOS: </b>$cuenta_usuarios</h3><br><br>";
    echo "REPORTE DE USUARIOS<br>";
    echo "---------------------<br>";

    foreach($lista_objt_usuarios as $i => $u){
        echo "USUARIO #" . ($i+1) . "<br>";
        echo "---------------------<br>";
        echo "<b>ID:</b> $u->id<br>";
        echo "<b>NOMBRE:</b> $u->nombre<br>";
        echo "<b>CORREO:</b> $u->correo<br>";
        echo "<b>CLAVE:</b> $u->clave<br>";
        echo "<b>ROL:</b> $u->rol<br>";
        echo "<br><br>";
    }

    echo "<h3>ELIMINAMOS EL USUARIO CON ID 3</H3><BR>";
    usuario::find(3)->delete();

    $lista_objt_usuarios = usuario::all();
    $cuenta_usuarios = count($lista_objt_usuarios);
    echo "<h3><b>TOTAL USUARIOS: </b>$cuenta_usuarios</h3><br><br>";
    echo "NUEVO REPORTE DE USUARIOS<br>";
    echo "=============================<br>";
    foreach($lista_objt_usuarios as $i => $u){
        echo "USUARIO #" . ($i+1) . "<br>";
        echo "---------------------<br>";
        echo "<b>ID:</b> $u->id<br>";
        echo "<b>NOMBRE:</b> $u->nombre<br>";
        echo "<b>CORREO:</b> $u->correo<br>";
        echo "<b>CLAVE:</b> $u->clave<br>";
        echo "<b>ROL:</b> $u->rol<br>";
        echo "<br><br>";
    }
}
catch(Exception $error){
    echo $error->getMessage();
}