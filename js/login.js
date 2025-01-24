import { alert, setData, showPassword, menuMov, blackGround } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    loginRegisterDisplay()
    register()
    login()
    showPassword()
    menuMov()
    blackGround()
});

function register() {
    let submit = document.getElementById("submitReg")
    let form = document.getElementById("registerForm")

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
        } else if (dates == "password") {
            alert("error", "La contraseña debe tener al menos 8 caracteres.")
        } else if (dates == "checkbox") {
            alert("error", "Por favor, acepta los términos y condiciones.")
        } else if (dates == "ok") {
            window.location.href = "/"
        }
    }
}

function login() {
    let submit = document.getElementById("submitLogin")
    let form = document.getElementById("loginForm")

    submit.onclick = async e => {
        e.preventDefault()

        let dates = await setData("/controllers/usuarios/login_controller.php", form);

        if (dates == "empty") {
            alert("error", "Por favor, complete todos los campos del formulario.")
        } else if (dates == "error") {
            alert("error", "Email o contraseña incorrecta.")
        } else if (dates == "ok") {
            window.location.href = "/"
        }
    };
}

function loginRegisterDisplay() {
    let anclaLogin = document.getElementById("anclaLogin")
    let anclaRegister = document.getElementById("anclaRegister")
    let loginWrap = document.getElementById("loginWrap")
    let registerWrap = document.getElementById("registerWrap")

    if (anclaLogin) {
        anclaLogin.onclick = () => {
            loginWrap.classList.remove("none-md")
            registerWrap.classList.add("none-md")
        }
    }

    if (anclaRegister) {
        anclaRegister.onclick = () => {
            registerWrap.classList.remove("none-md")
            loginWrap.classList.add("none-md")
        }
    }
}