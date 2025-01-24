import { alert, setData, menuMov, blackGround, cardShop } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    estadoUsuario()
    menuMov()
    blackGround()
    cardShop()
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