import { alert, setData } from "./utils.js";

let importe = parseFloat(document.getElementById("pricePurchase").value)
let checkbox = document.getElementById("checkbox")
let form = document.getElementById("purchase")
let usuario = document.getElementById("usuario").value

paypal.Buttons({
    style: {
        layout: 'vertical',
        color: 'gold',
        shape: 'pill',
        label: 'paypal'
    },

    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: importe
                },
                custom_id: usuario
            }]
        });
    },

    onInit(data, actions) {
        actions.disable();

        checkbox.addEventListener("change", function (event) {
            if (event.target.checked) {
                actions.enable();
            } else {
                actions.disable();
            }
        });
    },

    onClick() {
        if (!checkbox.checked) {
            alert("error", "Por favor, acepte nuestros términos y condiciones.");
        }
    },

    onApprove: function (data, actions) {
        if (actions.order && typeof actions.order.capture === "function") {
            return actions.order.capture().then(async function (details) {
                let dates = await setData("/controllers/pedidos/registro_controller.php", form);
                window.location.href = '/compra/' + dates;
            });
        } else {
            console.error("Order capture method not available.");
        }
    },

    onCancel: function () {
        window.location.href = "/error?error=Parece que tu compra ha sido cancelada. Si no has cancelado tú el proceso, por favor, inténtelo más tarde o póngase en contacto con nosotros.";
    }


}).render('#paypalWrap');