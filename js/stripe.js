import { alert } from "./utils.js"

const stripe = Stripe("pk_test_51QmwdFBGL99kE3BPGkJJqbykDklAxKJv9FCxgemrxZYy5kAVMRjgc4wiDIX1ZPdMkK6MMBo5dPLiIhmrolUVssm600RmBXYZpx");

document.getElementById("purchase").addEventListener("submit", async (event) => {
    event.preventDefault();

    const checkbox = document.getElementById("checkbox");
    if (checkbox.checked) {

        let form = document.getElementById("purchase");
        let formData = new FormData(form);

        fetch('/controllers/pedidos/stripe_controller.php', { 
            method: 'POST',
            body: formData 
        }) 
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .catch(error => {
                console.error('Error:', error);
            });

    } else {
        alert("error", "Por favor, acepte nuestros términos y condiciones.");
    }
});



