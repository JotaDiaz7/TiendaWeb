import { alert, setData, menuMov, blackGround, cardShop, showPassword } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    estadoUsuario()
    menuMov()
    blackGround()
    cardShop()
    recuperarPassword()
    showPassword()
});

function estadoUsuario() {
    var submit = document.getElementById("submit")
    let form = document.getElementById("deleteForm")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/usuarios/borrar_usuario_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, confirma que quieres eliminar tu cuenta.")
            } else if (dates == "admin") {
                alert("error", "Un administrador no puede eliminar su cuenta.")
            } else if (dates == "ok") {
                window.location.href = "/"
            }
        }
    }
}

function recuperarPassword() {
    const forms = document.querySelectorAll(".update")

    forms.forEach(form => {
        let submit = form.querySelector(".submitChange")

        if (submit) {
            submit.onclick = async e => {
                e.preventDefault()

                let dates = await setData("/controllers/usuarios/recuperar_password.php", form);

                if (dates == "empty") {
                    alert("error", "Por favor, complete todos los campos del formulario.")
                } else if (dates == "errorU") {
                    alert("error", "Error, por favor comprueba los datos e inténtalo de nuevo.")
                } else if (dates == "password") {
                    alert("error", "La contraseña debe tener al menos 8 caracteres.")
                } else if (dates == "passNoRepeat") {
                    alert("error", "Ambas contraseñas deben ser iguales.")
                } else if (dates == "ok") {
                    document.getElementById("password").value = ""
                    document.getElementById("passwordRepeat").value = ""
                    alert("ok", "Contraseña actualizada correctamente.")
                } else {
                    document.getElementById("firstWrap").classList.add("d-none")
                    document.getElementById("secondWrap").classList.remove("d-none")
                    document.getElementById("userId").value = dates
                }
            }
        }
    })


}