const agregar_cliente = () => {
    let data = new FormData(document.getElementById('formulario'));
    data.append('metodo','crear_cuenta');
    fetch("app/controller/usuario.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {        
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
            window.location = 'iniciar_session';
        } else if(respuesta[0] == 0) {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
}

document.getElementById('btn-registrar').addEventListener('click',() => {
    agregar_cliente();
});