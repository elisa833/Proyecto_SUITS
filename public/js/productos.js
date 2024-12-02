let id_producto;

const inicio_session = () => document.getElementById('cliente').value;

const obtener_datos = (categoria) => {
    let data = new FormData();
    data.append('metodo', 'obtener_datos');
    data.append('categoria', categoria);
    
    fetch("app/controller/productos.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        document.getElementById('titulo').textContent = (categoria != 'todos') ? `Cuidado de ${categoria}` : categoria;
        let contenido = ``;
        respuesta.map(producto => {
            contenido+= `
            <div class="card mb-5 me-4" style="width: 18%;">
                <div class="overflow-hidden p-5" style="height: 300px;">
                <img src="${producto['producto_url']}" class="card-img-top" alt="imagen_${respuesta['producto_nombre']}">
                </div>
                <div class="card-body">
                    <p class="card-text">${producto['producto_nombre']}</p>
                    <p class="card-text">$${producto['producto_precio']}</p>  
            `;
            if (inicio_session() == 'cliente') {
                contenido+=`
                    <button type="button" class="btn btn-info comprar"
                            data-bs-toggle="modal" data-bs-target="#modalComprar"
                            data-id="${producto['producto_id']}"
                            data-url="${producto['producto_url']}"
                            data-nombre="${producto['producto_nombre']}"
                            data-precio="${producto['producto_precio']}"
                    >
                        Comprar
                    </button>
                `;
            }
            contenido+=`
                </div>
            </div>
            `;

        });
        document.getElementById('contenido').innerHTML = contenido;
    });
};

const comprar_producto = () => {
    let data = new FormData();
    data.append('id_producto',id_producto);
    data.append('cantidad',document.getElementById('cantidad').value);
    data.append('metodo','comprar_producto');
    fetch("app/controller/productos.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {        
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
        } else if(respuesta[0] == 0) {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
}

document.addEventListener('DOMContentLoaded', () => {
    obtener_datos('todos');
});

document.getElementById('todos').addEventListener('click',() => {
    obtener_datos('todos');
});
document.getElementById('manos').addEventListener('click',() => {
    obtener_datos('manos');
});
document.getElementById('pies').addEventListener('click',() => {
    obtener_datos('pies');
});
document.getElementById('rostro').addEventListener('click',() => {
    obtener_datos('rostro');
});
document.getElementById('cabello').addEventListener('click',() => {
    obtener_datos('cabello');
});

document.getElementById('comprar').addEventListener('click', () => {
    comprar_producto();
});

document.getElementById('contenido').addEventListener('click', (e) => {
    const botonComprar = e.target.closest('.comprar');
    if (botonComprar) {
        id_producto = botonComprar.dataset.id;
        document.getElementById('img-producto').src = botonComprar.dataset.url;
        document.getElementById('nombre').textContent = botonComprar.dataset.nombre;
        document.getElementById('precio').textContent = botonComprar.dataset.precio;
    }
});
