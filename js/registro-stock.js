import { alert, setData, menuMov, blackGround } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    menuMov()
    blackGround()
    registerStock()
})

function registerStock() {
    var submit = document.getElementById("submit")
    let form = document.getElementById("formStock")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            let dates = await setData("/controllers/prod_nums/registro_controller.php", form);

            if (dates == "empty") {
                alert("error", "Por favor, complete todos los campos del formulario.")
            } else if (dates.includes("Formato")) {
                alert("error", dates)
            } else if (dates == "ok") {
                window.location.reload()
            }
        }
    }
}