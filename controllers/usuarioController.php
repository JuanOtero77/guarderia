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
           $msj = "ocurrio un error al guardar usuario"; 
        }
       //redireccionamos a la pagina agregar con el mensaje de error
       $_SESSION["usuario.find"] = NULL;
       header("Location: ../view/usuarios/buscar.php?msj=$msj");
       exit; 
         }
    }
    //------------------------------------
}

//inicimos el procesamiento de la accion
usuarioController::ejecutarAccion();