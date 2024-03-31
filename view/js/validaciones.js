function habilitarBotones(){
    //botones y campos
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");
    const campoClave = document.getElementById("pass");
    const campoNombre = document.getElementById("nombre");
    const campoCorreo = document.getElementById("correo");
    const campoRol = document.getElementById("rol");
    //El evento se activa cuando escriben en el campo
    campoNombre.addEventListener("input", () => { 
        if (campoNombre.value === "") {
            botonEditar.disabled = true; 
            botonEliminar.disable = true;
        } else {
            botonEditar.disabled = false; 
        }
    })

    //Solo lectura si el campo está vacío 
    if (campoNombre.value == "") {
        botonEditar.disabled = true; 
        botonEliminar.disabled = true; 
        campoNombre.setAttribute("readonly", true); 
        campoClave.setAttribute("readonly", true); 
        campoCorreo.setAttribute("readonly", true);
        campoRol.setAttribute("readonly", true);
    }

    else {
        botonEditar.disabled = false; 
        botonEliminar.disabled = false; 

        campoNombre.removeAttribute("readonly"); 
        campoClave.removeAttribute("readonly");  
        campoCorreo.removeAttribute("readonly");  
        campoRol.removeAttribute("readonly");
    }
}

function confirmarOperacion() {
    //Botones 
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    botonEditar.addEventListener("click", (event) => {
        mensaje = "¿Desea modificar los datos de este cliente?";
        return confirmar(mensaje, event);
    }); 

    botonEliminar.addEventListener("click", (event) => {
        mensaje = "Desea eliminar el cliente?";
        confirmar(mensaje, event); 
    })
}

function confirmar(mensaje, event) {

    //Mostrar una alerta de confirmación (SI/NO)
    const answer = confirm(mensaje); 

    //Si seleccionamos no, se cancela el envío del form 
    if (!answer) {
        event.preventDefault(); 
    }
}