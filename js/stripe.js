import { alert, setData } from "./utils.js"

const stripe = Stripe("pk_test_51Qmx4qPYM431A8f0dXzWjNUrEvefSXXOXFaJW7MZiO7xymNttYz7Et22XNWX4thyqeV38ovCF0Tv32gun8x9eM6b007cNwGIym");
const elements = stripe.elements();
const cardElement = elements.create("card");
cardElement.mount("#card-element");

document.getElementById("purchase").addEventListener("submit", async (event) => {
    event.preventDefault();

    const checkbox = document.getElementById("checkbox");
    if (checkbox.checked) {
        let form = document.getElementById("purchase");
        let formData = new FormData(form);

        const response = await fetch("/controllers/pedidos/stripe_controller.php", {
            method: "POST", 
            body: formData
        });

        const data = await response.json();

        async function dataBD() {
            let dates = await setData("/controllers/pedidos/registro_controller.php", form);
            window.location.href = '/compra/' + dates;
        }

        const { error, paymentIntent } = await stripe.confirmCardPayment(data.client_secret, {
            payment_method: {
                card: cardElement,
            }
        });

        if (data.client_secret) {
            dataBD()
        }
    } else {
        alert("error", "Por favor, acepte nuestros términos y condiciones.");
    }
});



