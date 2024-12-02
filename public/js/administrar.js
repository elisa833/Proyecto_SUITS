let tabla,id_producto;

const obtener_datos = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos');
    data.append('categoria', 'todos');
    fetch("app/controller/productos.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (tabla) {
            tabla.clear().rows.add(respuesta).draw(); 
        } else {
            tabla = $('#myTable').DataTable({
                data: respuesta, 
                columns: [
                    { data: 'producto_url',
                        render: function(data, type, row) {
                            return `
                                <img src="${data}" alt="img_${data}" style="width: 50px; height: 70px;">
                            `;
                        }
                     }, 
                    { data: 'producto_nombre' }, 
                    { data: 'producto_precio' }, 
                    { data: 'producto_categoria', 
                        render: function(data, type, row) {
                            return `Cuidado de ${data}`;
                        }
                     }, 
                    {
                        data: 'producto_id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning me-3 editar-producto"
                                    data-id="${data}" 
                                    data-url="${row.producto_url}" 
                                    data-nombre="${row.producto_nombre}" 
                                    data-precio="${row.producto_precio}"   
                                    data-categoria='${row.producto_categoria}'   
                                >
                                    Editar
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger eliminar-producto"
                                    data-id="${data}"
                                >
                                    Eliminar
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            `;
                        }
                    } 
                ],
                "pageLength": 4,
                language: { url: "./public/json/lenguaje.json" }
            });
        }
    });
};

const agregar_producto = () => {
    let data = new FormData(document.getElementById('formulario'));
    data.append('metodo','agregar_producto');
    fetch("app/controller/productos.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {        
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            document.getElementById('url').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('precio').value = '';
            obtener_datos();
        } else if(respuesta[0] == 0) {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
}

const editar_producto = () => {
    let data = new FormData(document.getElementById('formulario'));
    data.append('metodo','editar_producto');
    data.append('id',id_producto);
    fetch("app/controller/productos.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {        
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            document.getElementById('url').value = '';
            document.getElementById('nombre').value = '';
            document.getElementById('precio').value = '';
            document.getElementById('btn-producto').dataset.btn = 'agregar';
            document.getElementById('btn-producto').textContent = 'Agregar Producto';
            obtener_datos();
        } else if(respuesta[0] == 0) {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
}

const eliminar_producto = (id) => {
    let data = new FormData();
    data.append("id",id);
    data.append("metodo","eliminar_producto");
    fetch("./app/controller/productos.php",{
        method:"POST",
        body:data
    }).then(respuesta => respuesta.json())
    .then(async respuesta => { 
        if(respuesta[0] == 1){
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            obtener_datos();
        }else if(respuesta[0] == 0){
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
    }
});
}

document.addEventListener('DOMContentLoaded', () => {
    obtener_datos();
});

document.getElementById('btn-producto').addEventListener('click',() => {
    if (document.getElementById('btn-producto').dataset.btn == "agregar") {
        agregar_producto();
    } else {
        editar_producto();
    }
});

document.getElementById('myTable').addEventListener('click', (e) => {
    const botonEditar = e.target.closest('.editar-producto');
    const botonEliminar = e.target.closest('.eliminar-producto');
    if (botonEditar) {
        id_producto = botonEditar.dataset.id;
        document.getElementById('url').value = botonEditar.dataset.url;
        document.getElementById('nombre').value = botonEditar.dataset.nombre;
        document.getElementById('precio').value = botonEditar.dataset.precio;
        document.getElementById('categoria').value = botonEditar.dataset.categoria;
        document.getElementById('btn-producto').dataset.btn = 'editar';
        document.getElementById('btn-producto').textContent = 'Editar Producto';
    }
    if (botonEliminar) {
        Swal.fire({
            icon: "warning",
            text: "Quieres eliminar este Producto?",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar"
          }).then((result) => {
            if (result.isConfirmed) {
                eliminar_producto(botonEliminar.dataset.id);
            }
        });
    }
});