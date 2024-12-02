<?php
session_start();
require_once '../config/conexion.php';

class Usuario extends Conexion {

    // public function obtener_usuarios() {
    //     $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuarios WHERE usuario_id != :id");
    //     $consulta->bindParam(':id',$_SESSION['usuario']['usuario_id']);
    //     $consulta->execute();
    //     $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //     $this->cerrar_conexion();
    //     echo json_encode($datos);
    // }

    public function crear_cuenta() {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if (empty($nombre) || empty($apellidos) || empty($telefono) || empty($direccion) ||
            empty($email) || empty($pass)) {
            echo json_encode([0,"Campos incompletos"]);
        } else if (is_numeric($nombre) || is_numeric($apellidos)) {
            echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
        } else {
            $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_clientes (cliente_nombre,cliente_apellidos,
                                                        cliente_telefono,cliente_direccion,cliente_email,cliente_pass) 
            VALUES(:nombre,:apellidos,:telefono,:direccion,:email,:pass)");
            
            $insercion->bindParam(':nombre',$nombre);
            $insercion->bindParam(':apellidos',$apellidos);
            $insercion->bindParam(':telefono',$telefono);
            $insercion->bindParam(':direccion',$direccion);
            $insercion->bindParam(':email',$email);
            $passw = password_hash($pass,PASSWORD_BCRYPT);
            $insercion->bindParam(':pass',$passw);
            $insercion->execute();
            $this->cerrar_conexion();

            if ($insercion) {
                echo json_encode([1,"Registro exitoso"]);
            } else {
                echo json_encode([0,"Registrado no exitoso"]);
            }
        }
    }

    // public function obtener_informacion() {
    //     $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuarios WHERE usuario_id = :usuario_id");
    //     $consulta->bindParam(':usuario_id',$_SESSION['usuario']['usuario_id']);
    //     $consulta->execute();
    //     $datos = $consulta->fetch(PDO::FETCH_ASSOC);
    //     $this->cerrar_conexion();
    //     echo json_encode($datos);
    // }

    // public function actualizar_informacion() {
    //     $nombre = $_POST['nombre'];
    //     $apellidos = $_POST['apellidos'];
    //     $usuario = $_POST['usuario'];
    //     $pass= $_POST['pass'];

    //     if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['usuario']) || empty($_POST['pass'])) {
    //         echo json_encode([0,"Campos incompletos"]);
    //     } else if(is_numeric($nombre) || is_numeric($apellidos)) {
    //         echo json_encode([0,"No puedes ingresar numeros en nombre y apellidos"]);
    //     } else {
    //         $actualizacion = $this->obtener_conexion()->prepare("UPDATE t_usuarios 
    //         SET usuario_nombre = :nombre, usuario_apellidos = :apellidos, usuario_usuario = :usuario, usuario_pass = :pass  
    //         WHERE usuario_id = :id");
            
    //         $actualizacion->bindParam(':nombre',$nombre);
    //         $actualizacion->bindParam(':apellidos',$apellidos);
    //         $actualizacion->bindParam(':usuario',$usuario);
    //         $passw = password_hash($pass,PASSWORD_BCRYPT);
    //         $actualizacion->bindParam(':pass',$passw);
    //         $actualizacion->bindParam(':id',$_SESSION['usuario']['usuario_id']);
    //         $actualizacion->execute();
    //         $this->cerrar_conexion();
    //         echo json_encode([1,"Actualizacion correcta","Tu session se cerrara para que ingreses de nuevo tus datos"]);
            
    //     }
    // }
    
    // public function eliminar_usuario() {
    //     $id = $_POST['id_usuario'];

    //     $eliminar = $this->obtener_conexion()->prepare("DELETE FROM t_usuarios WHERE usuario_id = :id");
    //     $eliminar->bindParam(':id',$id);
    //     $eliminar->execute();
    //     $this->cerrar_conexion();
    //     if ($eliminar) {
    //         echo json_encode([1,'Usuario eliminado correctamente']);
    //     } else {
    //         echo json_encode([0,'Error al eliminar']);
    //     }
    // }
}

$consulta = new Usuario();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>