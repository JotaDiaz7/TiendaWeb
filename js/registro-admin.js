import { alert, setData, menuMov, blackGround, showPassword } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    registerCategoria()
    menuMov()
    blackGround()
    registerProducto()
    imgInput()
    actualizarProducto()
    registerDescuento()
    actualizarDescuento()
    registerUsuario()
    showPassword()
})

function registerCategoria() {
    var submit = document.getElementById("submitCat")
    let form = document.getElementById("registerCat")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/categorias/registro_categoria_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates.includes("campo")) {
                alert("error", dates)
            } else if (dates == "existe") {
                alert("error", "Ya existe una categoría con ese nombre.")
            } else if (dates == "ok") {
                window.location.href = '/admin/categorias'
            }
        }
    }
}

function registerProducto() {
    var submit = document.getElementById("submit")
    let form = document.getElementById("register")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/productos/registro_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates.includes("campo")) {
                alert("error", dates)
            } else if (dates == "precio") {
                alert("error", "Formato de precio incorrecto.")
            } else if (dates == "emptyImg") {
                alert("error", "Por favor, adjunta aunque sea una imagen.")
            } else if (dates == "formatoImg") {
                alert("error", "Formato de imagen incorrecto. Formatos válidos: png, jpg, jpeg o gif")
            } else if (dates == "sizeImg") {
                alert("error", "El tamaño de la imagen no puede exceder de los 200kBytes")
            } else if (dates == "ok") {
                window.location.href = '/admin/productos'
            }
        }
    }
}

function registerDescuento() {
    var submit = document.getElementById("submitDesc")
    let form = document.getElementById("registerDesc")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/descuentos/registro_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates == "precio") {
                alert("error", "Formato de precio incorrecto.")
            } else if (dates == "fecha") {
                alert("error", "La fecha de inicio no puede ser mayor que la final.")
            } else if (dates == "existe") {
                alert("error", "Ya existe un descuento con ese nombre.")
            } else if (dates == "ok") {
                window.location.href = '/admin/descuentos'
            }
        }
    }
}

function registerUsuario() {
    var submit = document.getElementById("submitUsuario")
    let form = document.getElementById("register")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/usuarios/crear_usuario_controller.php", form);

            if(dates == "empty"){
                alert("error", "Por favor, complete todos los campos del formulario.")
            }else if(dates.includes("campo")){
                alert("error", dates)
            }else if(dates.includes("email")){
                alert("error", dates)
            }else if(dates == "ExisteEmail"){
                alert("error", "Email ya registrado.")
            }else if(dates == "movil"){
                alert("error", "Introduce un número de móvil válido.")
            } else if (dates == "password") {
                alert("error", "La contraseña debe tener al menos 8 caracteres.")
            }else if(dates == "ok"){
                window.location.href = '/admin/usuarios'
            }
        }
    }
}

function imgInput() {
    let wraps = document.querySelectorAll(".imgWrap");

    wraps.forEach(div => {
        if (div) {
            div.querySelector(".imgProd").onclick = () => {
                let input = div.querySelector(".inputImg");

                if (!input.value) {
                    div.querySelector("input[type='file']").click();
                }
            }

            div.querySelector("input[type='file']").addEventListener("change", e => {
                let file = e.target.files[0]; 
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        div.querySelector(".imgProd").src = e.target.result;
                    }
                    reader.readAsDataURL(file); 
                }
            });

            if (div.querySelector("button")) {
                div.querySelector("button").onclick =  e =>  {
                    e.preventDefault();

                    div.querySelector(".inputImg").value = "";
                    div.querySelector(".imgProd").src = "";
                }
            }
        }
    });
}

function actualizarProducto() {
    let submit = document.getElementById("submitUpdate")
    let form = document.getElementById("update")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/productos/actualizar_producto.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates.includes("campo")) {
                alert("error", dates)
            } else if (dates == "precio") {
                alert("error", "Formato de precio incorrecto.")
            } else if (dates == "emptyImg") {
                alert("error", "Por favor, adjunta aunque sea una imagen.")
            } else if (dates == "formatoImg") {
                alert("error", "Formato de imagen incorrecto. Formatos válidos: png, jpg, jpeg o gif")
            } else if (dates == "sizeImg") {
                alert("error", "El tamaño de la imagen no puede exceder de los 200kBytes")
            } else if (dates == "ok") {
                alert("ok", "Producto actualizado correctamente")
            }
        }
    }
}

function actualizarDescuento() {
    let submit = document.getElementById("submitUpdateDesc")
    let form = document.getElementById("update")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/descuentos/actualizar_descuento.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates == "precio") {
                alert("error", "Formato de precio incorrecto.")
            } else if (dates == "fecha") {
                alert("error", "La fecha de inicio no puede ser mayor que la final.")
            } else if (dates == "ok") {
                alert("ok", "Descuento actualizado correctamente")
            }
        }
    }
}