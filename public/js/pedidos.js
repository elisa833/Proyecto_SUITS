let tabla;

const obtener_datos = () => {
    let data = new FormData();
    data.append('metodo', 'obtener_pedidos');
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
                    { data: 'producto_nombre'}, 
                    { data: 'producto_precio', render: function(data) {return `$${data}`;}}, 
                    { data: 'pedido_cantidad'}, 
                    { data: 'cliente_nombre' }, 
                    { data: 'cliente_apellidos' }, 
                    { data: 'cliente_telefono'}, 
                    { data: 'cliente_direccion'},
                    {data: 'pedido_id',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning me-3 producto-entregado"
                                    data-id="${data}" 
                                >
                                    pedido entregado
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

const producto_entregado = (id) => {
    let data = new FormData();
    data.append("id",id);
    data.append("metodo","producto_entregado");
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

document.getElementById('myTable').addEventListener('click', (e) => {
    const botonEntregado = e.target.closest('.producto-entregado');
    if (botonEntregado) {
        Swal.fire({
            icon: "warning",
            text: "Estas seguro de que este producto fue entregado?",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar"
          }).then((result) => {
            if (result.isConfirmed) {
                producto_entregado(botonEntregado.dataset.id);
            }
        });
    }
});