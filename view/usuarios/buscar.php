<?php
//obtenemos el mensaje enviado por el controlador
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "pagos/models/usuario.php";

$msj = @$_REQUEST["msj"];
$u = @$_SESSION["usuario.find"];
$u = ($u !== NULL) ? unserialize($u) : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EJEMPLO DE CRUD PHP ORM ACTIVERECORD</title>
</head>

<body>
    <center>
        <h1>BUSCAR USUARIOS</h1>
        <hr>
        <!-- EL FORMULARIO HTML -->
        <form action="../../controllers/usuarioController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right">ID:</th>
                    <td>
                        <input type="number" id="id" name="id" value="<?= @$u->id ?>" required placeholder="Digita el id">
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right">CLAVE:</th>
                    <td>
                        <input type="password" id="pass" name="pass" readonly value="<?= @$u->clave ?>">
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right">NOMBRE:</th>
                    <td>
                        <input type="text" id="nombre" name="nombre" readonly value="<?= @$u->nombre ?>">
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right">CORREO:</th>
                    <td>
                        <input type="email" id="correo" name="correo" readonly value="<?= @$u->correo ?>">
                    </td>
                </tr>
                <tr>
                    <th style="text-align: right">ROL:</th>
                    <td>
                        <input type="text" id="rol" name="rol" readonly value="<?= @$u->rol ?>">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">
                        <input type="reset" id="limpiar" value="Limpiar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="accion" name="accion" value="Buscar">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Mostramos el mensaje enviado por el controlador-->
        <span style="color: red;"><?= ($msj != NULL || isset($msj)) ? $msj : "" ?></span>
    </center>    
</body>

</html>