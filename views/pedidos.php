<?php
if (!isset($_SESSION['administrador'])) {
    header("location:administrador");
    exit();
}
?>
<head>
    <link rel="stylesheet" href="<?=CSS."table.css";?>">
    <link rel="stylesheet" href="<?=CSS."pedidos.css"?>">
    <title>Document</title>
</head>
<body>
    <h1 class="p-3">Pedidos</h1>
    <div class="container_fluid p-3">
        <table id="myTable" class="table table-dark table-striped p-5">
            <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Producto</th> 
                    <th scope="col">Precio</th> 
                    <th scope="col">Cantidad</th> 
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Dirrecion</th> 
                    <th scope="col">Acciones</th> 
                </tr>
            </thead>
            <tbody id="tabla_libros">
            </tbody>
        </table>
    </div>

    <script src="<?=JS."jquery.js"?>"></script>
    <script src="<?=JS."table.js"?>"></script>
    <script src="<?=JS."pedidos.js"?>"></script>
</body>
</html>