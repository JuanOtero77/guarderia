<?php
//mensaje enviado por el controlador
$msj = @$_REQUEST["msj"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <center>
        <h1>AGREGAR ASUARIO</h1>
        <hr>
        <!-- EL FORMULARIO HTML -->
        <form action="../../controllers/usuarioController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right">ID:</th>
                    <td><input type="number" id="id" name="id" required placeholder="Digita el id"></td>
                </tr>
                <tr>
                    <th style="text-align: right">CLAVE:</th>
                    <td><input type="password" id="pass" name="pass" required placeholder="Digita la clave"></td>
                </tr>
                <tr>
                    <th style="text-align: right">NOMBRE:</th>
                    <td><input type="text" id="nombre" name="nombre" required placeholder="Digita el nombre"></td>
                </tr>
                <tr>
                    <th style="text-align: right">CORREO:</th>
                    <td><input type="email" id="correo" name="correo" required placeholder="Digita el correo"></td>
                </tr>
                <tr>
                    <th style="text-align: right">ROL:</th>
                    <td><input type="text" id="rol" name="rol" required placeholder="Digita el rol"></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right">
                        <input type="reset" id="limpiar" value="Limpiar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" id="accion" name="accion" value="guardar">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Mostramos el mensaje enviado por el controlador-->
        <span style="color: red;"><?= ($msj != NULL || isset($msj)) ? $msj : "" ?></span>
    </center>    
</body>

</html>