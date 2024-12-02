<?php
session_start();
require_once '../config/conexion.php';

class Home extends Conexion {
    public function obtener_datos() {
        $categoria = $_POST['categoria'];
        if ($categoria == 'todos') {
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_productos");
        }else {
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_productos WHERE producto_categoria = :categoria");
            $consulta->bindParam(':categoria',$categoria);
        }
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }
    
    public function agregar_producto() {
        if (isset($_POST['url']) && !empty($_POST['url']) && 
            isset($_POST['nombre']) && !empty($_POST['nombre']) && 
            isset($_POST['precio']) && !empty($_POST['precio']) && 
            isset($_POST['categoria']) && !empty($_POST['categoria']))  {
            
            $urlImg = $_POST['url'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];

            if(!is_numeric($precio)){
                echo json_encode([0,"Ingresa solo numeros en el precio"]);
            } else {
                $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_productos (producto_url,producto_nombre,
                                                        producto_precio,producto_categoria) 
                VALUES(:urlImg,:nombre,:precio,:categoria)");
                
                $insercion->bindParam(':urlImg',$urlImg);
                $insercion->bindParam(':nombre',$nombre);
                $insercion->bindParam(':precio',$precio);
                $insercion->bindParam(':categoria',$categoria);
                $insercion->execute();
                $this->cerrar_conexion();

                if ($insercion) {
                    echo json_encode([1,"Producto registrado"]);
                } else {
                    echo json_encode([0,"Producto NO registrado"]);
                }
            }

        } else {
            echo json_encode([0,"No puedes dejar campos vacios"]);
        }
    }

    public function editar_producto() {
        $id = $_POST['id'];
        $urlImg = $_POST['url'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];

        if (empty($_POST['url']) || empty($_POST['nombre']) || empty($_POST['precio']) || empty($_POST['categoria']))  {
                echo json_encode([0,"Campos incompletos"]);
        } else if(!is_numeric($precio)){
            echo json_encode([0,"Ingresa solo numeros en el precio"]);
        } else {
            $actualizacion = $this->obtener_conexion()->prepare("UPDATE t_productos
            SET producto_url = :urlImg, producto_nombre = :nombre, producto_precio = :precio, producto_categoria = :categoria 
            WHERE producto_id = :id");
            
            $actualizacion->bindParam(':urlImg',$urlImg);
            $actualizacion->bindParam(':nombre',$nombre);
            $actualizacion->bindParam(':precio',$precio);
            $actualizacion->bindParam(':categoria',$categoria);
            $actualizacion->bindParam(':id',$id);
            $actualizacion->execute();
            $this->cerrar_conexion();
            echo json_encode([1,"Producto actualizado"]);
        }
    }

    public function eliminar_producto() {
        $id = $_POST['id'];

        $eliminar = $this->obtener_conexion()->prepare("DELETE FROM t_productos WHERE producto_id = :id");
        $eliminar->bindParam(':id',$id);
        $eliminar->execute();
        $this->cerrar_conexion();
        if ($eliminar) {
            echo json_encode([1,'Producto eliminado']);
        } else {
            echo json_encode([0,'Error al eliminar el Producto']);
        }
    }

    public function comprar_producto() {
        $id_cliente = $_SESSION['cliente']['cliente_id'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        if(empty($cantidad)){
            echo json_encode([0,"Ingresa la cantidad que quieres comprar"]);
        } else if($cantidad <= 0){
            echo json_encode([0,"Ingresa numeros positivos en cantidad"]);
        } else {
            $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_pedidos (pedido_cantidad,id_cliente,id_producto)
                                VALUES(:cantidad,:id_cliente,:id_producto)");
            
            $insercion->bindParam(':cantidad',$cantidad);
            $insercion->bindParam(':id_cliente',$id_cliente);
            $insercion->bindParam(':id_producto',$id_producto);
            $insercion->execute();
            $this->cerrar_conexion();

            if ($insercion) {
                echo json_encode([1,"Producto Comprado"]);
            } else {
                echo json_encode([0,"Producto NO registrado"]);
            }
        }
    }

    public function obtener_pedidos() {
        $consulta = $this->obtener_conexion()->prepare("SELECT 
            pr.producto_url,
            pr.producto_nombre,
            pr.producto_precio,
            p.pedido_cantidad,

            c.cliente_nombre,
            c.cliente_apellidos,
            c.cliente_telefono,
            c.cliente_direccion,
            
            p.pedido_id,
            pr.producto_id,
            c.cliente_id
        FROM 
            t_pedidos p
        INNER JOIN 
            t_clientes c ON p.id_cliente = c.cliente_id
        INNER JOIN 
            t_productos pr ON p.id_producto = pr.producto_id;");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function producto_entregado() {
        $id = $_POST['id'];
        
        $eliminar = $this->obtener_conexion()->prepare("DELETE FROM t_pedidos WHERE pedido_id = :id");
        $eliminar->bindParam(':id',$id);
        $eliminar->execute();
        $this->cerrar_conexion();
        if ($eliminar) {
            echo json_encode([1,'Producto entregado']);
        } else {
            echo json_encode([0,'Error al entregar el Producto']);
        }
    }
}

$consulta = new Home();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>