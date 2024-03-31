<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."pagos/models/usuario.php";
$msj = @$_REQUEST["msj"];
$u = @$_SESSION["usuario.all"];
$u = unserialize($u);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EJEMPLO DE CRUD PHP ORM ACTIVERECORD</title>
    <link rel="stylesheet" href="../css/estilos.css">
    </link>
</head>

<body>
    <center>
        <h1>REPORTE USUARIOS</h1>
        <hr>
        <?php
        //si la lista es nula o vacia
        if(count($u) <= 0){
        ?>
           <span style="color: #900D40; background-color: #FAD7CE;">
                No existen usuarios registrados
            </span>
        <?php
        } else{
        ?>
            <fieldset style="width: 70%;">
              <legend>Informacion usuario: </legend>
              <table>
                <tr>
                    <th>#</th>
                    <th>CLAVE</th>
                    <th>NOMBRE</th>
                    <th>CORREO</th>
                    <th>ROL</th>
                </tr>
                <?php
                $c = usuario::find('all');
                foreach ($c as $i => $cliente){
                ?>
                    <tr style="text-align: left;">
                        <td><?=($i+1) ?></td>
                        <td><?=($cliente->id)?></td>
                        <td><?=($cliente->nombre)?></td>
                        <td><a href="mailto:<?= $cliente->correo?>"><?= $cliente->correo?></a></td>
                        <td><?=($cliente->rol)?></td>
                    </tr>
                <?php      
                }
                ?>
              </table>  
        </fieldset>
        <?php    
        }
        ?>
        <!-- Mostramos el mensaje enviado por el controlador-->
        <span style="color: red;"><?= ($msj != NULL || isset($msj)) ? $msj : "" ?></span>
    </center>
</body>
</html>