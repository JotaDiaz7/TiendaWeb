import { menuMov, blackGround, cardShop } from "./utils.js"

document.addEventListener("DOMContentLoaded", function(){
    menuMov()
    blackGround()
    cardShop()
    carrusel()
});

function carrusel() {
    const carrusels = document.querySelectorAll(".productosCarrusel")
    carrusels.forEach(carrusel => {
        $(carrusel).draggable({
            axis: "x"
        });
    })

}