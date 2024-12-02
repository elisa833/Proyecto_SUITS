<?php
if (!isset($_SESSION['administrador'])) {
    header("location:administrador");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?=CSS."table.css";?>">
    <link rel="stylesheet" href="<?=CSS."administrar.css"?>">
    <title>Administracion de usuarios</title>
</head>
<body>

    <div class="container_fluid d-flex justify-content-between flex-wrap mt-4 p-3" id="contenedor-tabla">
        <div class="contenedor-formulario">
            <form id="formulario">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="url" name="url" placeholder="name@example.com">
                    <label for="url">Url de la imagen</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="name@example.com">
                    <label for="nombre">Nombre del producto</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="precio" name="precio" placeholder="name@example.com">
                    <label for="precio">Precio del producto</label>
                </div>
                <select class="form-select mb-3" aria-label="Default select example" id="categoria" name="categoria">
                    <option selected>Categoria</option>
                    <option value="manos">Cuidado de manos</option>
                    <option value="pies">Cuidado de pies</option>
                    <option value="rostro">Cuidado de rostro</option>
                    <option value="cabello">Cuidado de cabello</option>
                </select>
            </form>
            <button type="button" class="btn btn-outline-secondary w-100" id="btn-producto" data-btn="agregar">Agregar Nuevo Producto</button>
        </div>
        <div class="contenedor-datos">
            <table id="myTable" class="table table-dark table-striped p-5">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">categoria</th> 
                        <th scope="col">Acciones</th> 
                    </tr>
                </thead>
                <tbody id="tabla_libros">
                </tbody>
            </table>
        </div>
    </div>  

    <script src="<?=JS."jquery.js"?>"></script>
    <script src="<?=JS."table.js"?>"></script>
    <script src="<?=JS."administrar.js"?>"></script>
</body>
</html>