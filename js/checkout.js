import { alert, setData, showPassword, menuMov, blackGround, cardShop } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    updatePerfil()
    showPassword()
    menuMov()
    blackGround()
    cardShop()
    buttonsContainer()
    loginRegisterDisplay()
    register()
    login()
    prueba()
});

function buttonsContainer() {
    let carrito = document.getElementById("carrito")
    let personalInfo = document.getElementById("personalInfo")
    let payments = document.getElementById("payments")
    let purchase = document.getElementById("purchase")

    let buttonCarrito = document.getElementById("buttonCarrito")
    buttonCarrito.onclick = e => {
        e.preventDefault()
        carrito.classList.add("hiddenContainer")
        personalInfo.classList.remove("hiddenContainer")
    }

    let returnCarrito = document.getElementById("returnProductos")
    returnCarrito.onclick = e => {
        e.preventDefault()
        carrito.classList.remove("hiddenContainer")
        personalInfo.classList.add("hiddenContainer")
    }

    let returnPersonalInfo = document.getElementById("returnPersonalInfo")
    returnPersonalInfo.onclick = e => {
        e.preventDefault()
        personalInfo.classList.remove("hiddenContainer")
        payments.classList.add("hiddenContainer")
    }

    let submitPayment = document.getElementById("submitPayment")
    submitPayment.onclick = e => {
        e.preventDefault()
        let check = butonsPago()

        if (!check) {
            alert("error", "Por favor, seleccione un método de pago.")
        } else {
            payments.classList.add("hiddenContainer")
            purchase.classList.remove("hiddenContainer")
        }
    }

    let returnPayment = document.getElementById("returnPayment")
    returnPayment.onclick = e => {
        e.preventDefault()

        purchase.classList.add("hiddenContainer")
        payments.classList.remove("hiddenContainer")
    }
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
                document.getElementById("payments").classList.remove("hiddenContainer")
            }
        }
    }
}

function loginRegisterDisplay() {
    let anclaLogin = document.getElementById("anclaLogin");
    let anclaRegister = document.getElementById("anclaRegister");
    let loginWrap = document.getElementById("loginWrap");
    let registerWrap = document.getElementById("registerWrap");

    if (anclaLogin) {
        anclaLogin.onclick = () => {
            loginWrap.classList.remove("d-none");
            registerWrap.classList.add("d-none");
        }
    }

    if (anclaRegister) {
        anclaRegister.onclick = () => {
            registerWrap.classList.remove("d-none");
            loginWrap.classList.add("d-none");
        }
    }
}

function register() {
    let submit = document.getElementById("submitReg")
    let form = document.getElementById("registerForm")

    if (submit) {
        submit.onclick = async e => {

            e.preventDefault()

            let dates = await setData("/controllers/usuarios/registro_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates.includes("campo")) {
                alert("error", dates)
            } else if (dates.includes("email")) {
                alert("error", dates)
            } else if (dates == "ExisteEmail") {
                alert("error", "Email ya registrado.")
            } else if (dates == "movil") {
                alert("error", "Formato de móvil incorrecto.")
            } else if (dates == "password") {
                alert("error", "La contraseña debe tener al menos 8 caracteres.")
            } else if (dates == "checkbox") {
                alert("error", "Por favor, acepta los términos y condiciones.")
            } else if (dates == "ok") {
                window.location.reload()
            }
        }

    }
}

function login() {
    let submit = document.getElementById("submitLogin")
    let form = document.getElementById("loginForm")

    if (submit) {
        submit.onclick = async e => {

            e.preventDefault()

            let dates = await setData("/controllers/usuarios/login_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates == "error") {
                alert("error", "Email o contraseña incorrecta.")
            } else if (dates == "ok") {
                window.location.reload()
            }
        }

    };
}

function butonsPago() {
    const radios = document.querySelectorAll("input[type=radio")
    const buttonWraps = document.querySelectorAll(".buttonPayWrap")
    let check = false;

    radios.forEach(input => {
        if (input.checked) {
            check = true;
            document.getElementById("metodoPago").value = input.id

            buttonWraps.forEach(wrap => {
                let name = wrap.getAttribute("name")
                if(input.id == name){
                    wrap.classList.remove("d-none")
                }else{
                    wrap.classList.add("d-none")
                }
            })
        }
    })
    return check
}

function prueba(){
    let submit = document.getElementById("prueba")
    let form = document.getElementById("purchase")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/pedidos/registro_controller.php", form);
            window.location.href = '/compra/'+dates;
        }
    }
}