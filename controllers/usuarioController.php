<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."pagos/models/usuario.php";

class usuarioController{

    //------------------------------------
    public static function ejecutarAccion(){
        //Recuperamos el campo accion (boton guardar)
        $accion = @$_REQUEST["accion"];
        //validamos si la accion es guardar
        switch($accion){
            case "guardar":
                //invocamos al metodo guardar
                usuarioController::guardar();
                break;
            case "buscar":
                //invocamos al metodo buscar
                usuarioController::buscar();
                break;
            case "editar":
                //invocamos al metodo editar
                usuarioController::editar();
                break;
            case "eliminar":
                usuarioController::eliminar();
                break;
            case "todo":
                //invocamos al metodo editar
                usuarioController::listarTodo();
                break;
            default:
            //sino es la accion correcta, mandamos error
            header("Location: ../view/error.php?msj=Accion no permitida");
            exit;
        }
    }
    //------------------------------------
    public static function guardar(){
        //recuperar los campos enviador por el formulario
        $id = @$_REQUEST["id"];
        $clave = @$_REQUEST["pass"];
        $nombre = @$_REQUEST["nombre"];
        $correo = @$_REQUEST["correo"];
        $rol = @$_REQUEST["rol"];
        //crear instancia
        $u = new usuario();
        //poner los campos
        $u->id = $id;
        $u->clave = $clave;
        $u->nombre = $nombre;
        $u->correo = $correo;
        $u->rol = $rol;
        //Intentar guardar el usuario en la bd
        try{
            //guardar el usuario
            $u->save();
            //contar los usuarios guardados
            $total = @usuario::count();
            $msj = "usuario guardado, total: $total";
            //redireccionar a la pagina guardar enviandole un mensaje
            header("Location: ../view/usuarios/agregar.php?msj=$msj");
            exit;
        }
        //capturar algun posible error
        catch(Exception $error){
            //verificar si el error es de clave primaria duplicada
            if(strstr($error->getMessage(), "Duplicate")){
                $msj = "El usuario con id: $id ya existe";
            }
            else{
                //otro mensaje sino es error por usuario duplicado
                $msj = "ocurrio un error al guardar usuario";
            }
            //redireccionamos a la pagina agregar con el mensaje de error
            header("Location: ../view/usuarios/agregar.php?msj=$msj");
            exit;
        }
    }
    //------------------------------------
    public static function buscar(){
        //recuperar los campos enviado por el formulario
        $id = @$_REQUEST["id"];
    
        //intentar guardar el usuario en la bd
        try{
        //buscamos usuario    
        $u = usuario::find($id);

        //colocamos el usuario en la sesion
        $_SESSION["usuario.find"] = serialize($u);
        $msj = "usuario encontrado";

        //redireccionar a la pagina guardar envidandole un mensaje
        header("Location: ../view/usuarios/buscar.php?msj=$msj");
        exit;
    }
    //capturar algun error
    catch(Exception $error){
        //verificar si el error es de clave primaria
        if(strstr($error->getMessage(), $id)){
            $msj = "El usuario con id: $id no existe";
        }
        else{
           //otro mensaje sino es error por usuario duplicado
           $msj = "ocurrio un error al buscar usuario"; 
        }
       //redireccionamos a la pagina agregar con el mensaje de error
       $_SESSION["usuario.find"] = NULL;
       header("Location: ../view/usuarios/buscar.php?msj=$msj");
       exit; 
         }
    }
    //------------------------------------
    public static function editar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener el usuario
        $u = @$_SESSION["usuario.find"]; 

        //Convertir a objeto
        $u = unserialize($u); 

        if ($u->id != $id) {
            $msg = "El id no corresponde al usuario consultado"; 
            header("Location: ../view/usuarios/buscar.php?msg=$msg");
        }

        //Nuevos campos en el formulari
        $clave = @$_REQUEST["pass"]; 
        $nombre = @$_REQUEST["nombre"]; 
        $correo = @$_REQUEST["correo"];
        $rol = @$_REQUEST["rol"];

        //Lo colocamos en el usuario consultado
        $u->clave = $clave;
        $u->nombre = $nombre;  
        $u->correo = $correo;
        $u->rol = $rol; 

        try { 
            //Guardar la sucursal con los datos actualizados 
            $u->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["usuario.find"] = serialize($u); 
            $msg = "usuario editado"; 

            header("Location: ../view/usuarios/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El usuario no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar el usuario";
            }

            $_SESSION["usuario.find"] = NULL;
            header("Location: ../view/usuarios/buscar.php?msg=$msg");
            exit;
        }
    }
    //------------------------------------
    public static function eliminar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal  guardado en sesion 
        $u = @$_SESSION["usuario.find"]; 

        //Convertir a objeto
        $u = unserialize($u); 

        if ($u->id != $id) {
            $msg = "El id no corresponde al usuario consultado"; 
            header("Location: ../view/usuarios/buscar.php?msg=$msg");
        }

        try {
            $u->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $u = @$_SESSION["usuario.find"] = null; 
            $total = @usuario::count();
            $msg = "Usuario eliminado, Total: $total"; 

            header("Location: ../view/usuarios/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El usuario no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar el usuario";
            }

            $_SESSION["usuario.find"] = NULL;
            header("Location: ../view/usuarios/buscar.php?msg=$msg");
            exit;
        }

    }
    //------------------------------------
    public static function listarTodo(){
        try{
            //obtenemos usuarios
            $usuarios = usuario::all();
            if ($usuarios == null){
                $_SESSION["usuarios.all"] = null;
                $msj = "total usuarios: 0";
            } else{
                $total = count($usuarios);
                //serializar la lista de usuarios
                $usuarios = serialize($usuarios);
                //colocamos la lista en sesion para recuperalra en la pag de reportes
                $_SESSION["usuarios.all"] = $usuarios;
            }
            //redireccionamos hacia reportes
            $msj = "total usuarios: $total";
            header("Location: ../view/usuarios/listarTodo.php?msj=$msj");
        } catch (Exception $error){
            $_SESSION["usuarios.all"] = null;
            header("Location: ../view/usuarios/listarTodo.php?msj=total usaurios: 0");
        }
    }
}

//inicimos el procesamiento de la accion
usuarioController::ejecutarAccion();