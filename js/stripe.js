const stripe = Stripe("pk_test_51Qmx4qPYM431A8f0dXzWjNUrEvefSXXOXFaJW7MZiO7xymNttYz7Et22XNWX4thyqeV38ovCF0Tv32gun8x9eM6b007cNwGIym");
const elements = stripe.elements();
const cardElement = elements.create("card");
cardElement.mount("#card-element");

document.getElementById("purchase").addEventListener("submit", async (event) => {
    event.preventDefault();

    const response = await fetch("/crear-intento-pago", { method: "POST" });
    const { client_secret } = await response.json();

    const { error } = await stripe.confirmCardPayment(client_secret, {
        payment_method: {
            card: cardElement,
        },
    });

    if (error) {
        console.error(error.message);
    } else {
        alert("Pago exitoso");
    }
});