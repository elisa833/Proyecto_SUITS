<?php
require_once '../config/conexion.php';
session_start();

class Login extends Conexion {
    public function logear_usuario() {
        if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
    
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
    
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuarios WHERE usuario_usuario = :usuario");
            $consulta->bindParam(':usuario',$usuario);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            if ($datos) {
                if (password_verify($pass,$datos['usuario_pass'])) {
                    $_SESSION['administrador'] = $datos;
                    echo json_encode([1,"Datos de acceso correctos"]);
                } else {
                        echo json_encode([0,"Error en credenciales de acceso"]);
                    }
            } else {
                echo json_encode([0,"Informacion no localizada"]);
            }
        } else {
            echo json_encode([0,"Tienes que llenar los datos en el formulario"]);
        }
    }
    public function logear_cliente() {
        if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
    
            $email = $_POST['email'];
            $pass = $_POST['pass'];
    
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_clientes WHERE cliente_email = :email");
            $consulta->bindParam(':email',$email);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            if ($datos) {
                if (password_verify($pass,$datos['cliente_pass'])) {
                    $_SESSION['cliente'] = $datos;
                    echo json_encode([1,"Datos de acceso correctos"]);
                } else {
                        echo json_encode([0,"Error en credenciales de acceso"]);
                    }
            } else {
                echo json_encode([0,"Informacion no localizada"]);
            }
        } else {
            echo json_encode([0,"Tienes que llenar los datos en el formulario"]);
        }
    }
}

$consulta = new Login();
$metodo = $_POST['metodo'];
$consulta->$metodo();

?>