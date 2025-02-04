import { alert, setData, menuMov } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    updatePerfil()
    menuMov()
    buttonsContainer()
    registro()
});

function buttonsContainer() {
    let carrito = document.getElementById("carrito")
    let personalInfo = document.getElementById("personalInfo")
    let purchase = document.getElementById("purchase")

    let buttonCarrito = document.getElementById("buttonCarrito")
    buttonCarrito.onclick = e => {
        e.preventDefault()

        let vacio = carritoVacio()

        if (vacio) {
            alert("error", "Por favor, seleccion algún producto a devolver.")
        } else {
            carrito.classList.add("hiddenContainer")
            personalInfo.classList.remove("hiddenContainer")
        }

    }

    let returnCarrito = document.getElementById("returnProductos")
    returnCarrito.onclick = e => {
        e.preventDefault()
        carrito.classList.remove("hiddenContainer")
        personalInfo.classList.add("hiddenContainer")
    }

    let returnPersonalInfo = document.getElementById("returnInfo")
    returnPersonalInfo.onclick = e => {
        e.preventDefault()
        personalInfo.classList.remove("hiddenContainer")
        purchase.classList.add("hiddenContainer")
    }
}

function carritoVacio() {
    const productosCant = document.querySelectorAll(".inputCantProd")
    let vacio = true
    let i = 0

    while (vacio && i < productosCant.length) { 
        let cantidad = productosCant[i].value 
        if (cantidad > 0) vacio = false
        i++
    }

    return vacio
}


function updatePerfil() {
    let submit = document.getElementById("submitUpdate")
    let form = document.getElementById("updateForm")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/usuarios/actualizar_usuario.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates.includes("campo")) {
                alert("error", dates)
            } else if (dates.includes("email")) {
                alert("error", dates)
            } else if (dates == "ExisteEmail") {
                alert("error", "Email ya registrado.")
            } else if (dates == "movil") {
                alert("error", "Introduce un número de móvil válido.")
            } else if (dates == "ok") {
                document.getElementById("personalInfo").classList.add("hiddenContainer")
                document.getElementById("purchase").classList.remove("hiddenContainer")
            }
        }
    }
}

function registro() {
    let submit = document.getElementById("buttonDevolucion")
    let form = document.getElementById("purchase")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/devoluciones/registro_controller.php", form);

            if(dates == "checkbox"){
                alert("error", "Por favor, acepte nuestros términos y condiciones.")
            }else{
                window.location.href = '/devolucion-completada/' + dates;
            }
        }
    }
}