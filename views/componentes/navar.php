<?php if(isset($_SESSION['administrador'])): ?>
    <!-- nabvar de administrador -->
    <nav class="navbar navbar-expand-lg bg-light" id="administrador">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=url('administrar');?>">Productos de belleza</a>
            <div class="mx-auto d-none d-lg-block">
                <img src="https://marketplace.canva.com/EAFlKyETj-A/2/0/1600w/canva-logo-circular-centro-de-belleza-ilustrativo-morado-PCIYPXZZrZI.jpg" 
                 alt="Logo" 
                 class="navbar-logo">
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <a class="nav-link" href="<?=url('inicio');?>">Vista previa</a>
                <a class="nav-link" href="<?=url('pedidos');?>">Pedidos</a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?=$_SESSION['administrador']['usuario_nombre']?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><button class="dropdown-item" onclick="cerrar_session('adm')" >Cerrar session</button></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav> 
<?php else: ?>
    <!-- navbar de Cliente -->
    <nav class="navbar navbar-expand-lg bg-light" id="cliente">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=url('inicio');?>">Productos de belleza</a>
            <div class="mx-auto d-none d-lg-block">
                <img src="https://marketplace.canva.com/EAFlKyETj-A/2/0/1600w/canva-logo-circular-centro-de-belleza-ilustrativo-morado-PCIYPXZZrZI.jpg" 
                 alt="Logo" 
                 class="navbar-logo">
            </div>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><button class="dropdown-item" id="todos" >Productos</button></li>
                            <li><button class="dropdown-item" id="manos" >Cuidado de manos</button></li>
                            <li><button class="dropdown-item" id="pies" >Cuidado de pies</button></li>
                            <li><button class="dropdown-item" id="rostro" >Cuidado de rostro</button></li>
                            <li><button class="dropdown-item" id="cabello" >Cuidado de cabello</button></li>
                        </ul>
                    </li>
                    
                    <?php if(isset($_SESSION['cliente'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?=$_SESSION['cliente']['cliente_nombre']?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><button class="dropdown-item" id="cerrar_session" onclick="cerrar_session('cliente')">Cerrar sesion</button></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <a class="nav-link ms-3" href="<?=url('iniciar_session');?>">Iniciar sesion</a>
                    <?php endif; ?>
                    
                </ul>
            </div>
        </div>
    </nav> 
<?php endif; ?>
