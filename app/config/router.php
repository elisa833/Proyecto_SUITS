<?php
    if (isset($_REQUEST['vista'])) {
        $vistaLogin = $_REQUEST['vista'];
    }else {
        $vistaLogin = "inicio";
    }
    switch ($vistaLogin) {
        case "inicio":{
            require_once './views/home.php';
            break;
        }
        case "iniciar_session":{
            require_once './views/login_usuario.php';
            break;
        }
        case "crear_cuenta":{
            require_once './views/crear_cuenta.php';
            break;
        }
        case "administrador":{
            require_once './views/login.php';
            break;
        }
        case "administrar":{
            require_once './views/administrar.php';
            break;
        }
        case "productos":{
            require_once './views/productos.php';
            break;
        }
        case "pedidos":{
            require_once './views/pedidos.php';
            break;
        }
        default:{
            require_once './views/error404.php';
        }
        break;
    }
?>