import { menuMov, blackGround, cardShop, setData, alert } from "./utils.js"

document.addEventListener("DOMContentLoaded", function () {
    menuMov()
    blackGround()
    cardShop()
    addProductCar()
});

function addProductCar() {
    let submit = document.getElementById("submitProduct")
    let form = document.getElementById("productForm")

    if (submit) {
        submit.onclick = async e => {
            e.preventDefault()

            await setData("/controllers/carrito/registro_controller.php", form);

            let url = window.location.href

            if (url.includes("?")) url = url.split("?")[0]
            
            window.location.href = url + "?cart"
        }
    }
}