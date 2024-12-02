<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?=CSS."home.css"?>">
    <title>Incio</title>
</head>
<body>
    <input type="text" id="cliente" value="<?=(isset($_SESSION['cliente']) ? 'cliente' : '' ) ?>" hidden>
    <h1 class="text-center mb-4" id="titulo">Todos</h1>
    <?php if(!isset($_SESSION['cliente'])): ?>
    <h5 class="ms-5">Inicia sesion para comprar nuestros productos</h5>
    <?php endif ?>
    
    <div class="container_fluid d-flex justify-content-start flex-wrap p-5" id="contenido">    
    </div>    
    
    <!-- Modal -->
    <div class="modal fade" id="modalComprar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            <div class="col-6">
                <div>
                    <img src="" alt="" id="img-producto" style="width: 200px;">
                </div>
                <div>
                    <p class="fs-2"><span id="nombre"></span></p>
                    <p>Precio: $<span id="precio"></span></p>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" disabled
                        value="<?=$_SESSION['cliente']['cliente_nombre']?>">
                    <label for="url">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" disabled
                        value="<?=$_SESSION['cliente']['cliente_apellidos']?>">
                    <label for="url">Apellidos</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="" disabled
                        value="<?=$_SESSION['cliente']['cliente_telefono']?>">
                    <label for="url">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="" disabled
                        value="<?=$_SESSION['cliente']['cliente_direccion']?>">
                    <label for="url">Direccion</label>
                </div>
                <div class="mb-3 d-flex">
                    <label for="cantidad" class="form-label me-3">Cantidad</label>
                    <input type="number" class="form-control w-25" id="cantidad" placeholder="" value="1">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="comprar">Comprar</button>
        </div>
        </div>
    </div>
    </div>

    <script src="<?=JS."productos.js"?>"></script>
</body>
</html>