<?php
if (isset($_SESSION['cliente'])) {
    header("location:inicio");
    exit();
}
?>
<head>
    <link rel="stylesheet" href="<?=CSS."crear_cuenta.css"?>">
    <title>Crear cuenta</title>
</head>
<body>
    <div class="container">
        <form class="mt-5" id="formulario">
            <div class="etiqueta form-floating mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="name@example.com">
                <label for="url">Nombre</label>
            </div>
            <div class="etiqueta form-floating mb-3">
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="name@example.com">
                <label for="url">Apellidos</label>
            </div>
            <div class="etiqueta form-floating mb-3">
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="name@example.com">
                <label for="url">Telefono</label>
            </div>
            <div class="etiqueta form-floating mb-3">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="name@example.com">
                <label for="url">Dirrecion</label>
            </div>
            <div class="etiqueta form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="url">Correo electronico</label>
            </div>
            <div class="etiqueta form-floating mb-3">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="name@example.com">
                <label for="url">Contraseña</label>
            </div>
            <button type="button" class="btn btn-secundary" id="btn-registrar">Registrarse</button>
        </form>
    </div>

    <script src="<?=JS."crear_cuenta.js"?>"></script>
</body>
</html>