const cerrar_session = (login) => {
    fetch("app/controller/cerrar_sesion.php")
    .then(respuesta => respuesta.json())
    .then(async (respuesta) => {
        await Swal.fire({icon: "success",title:`${respuesta[1]}`});
        if (login == 'cliente') {
            window.location = "inicio";
        }else if(login == 'adm') {
            window.location = "administrador";
        }
    });
}
