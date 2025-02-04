<?php
require '../../config/stripe/vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51QmwdFBGL99kE3BPLdWZaAaVmBhnto9zdbil6H6lfGPzxkYQi1QWeQZNsdux3ywujYDAl4hKRjRCQoaziGtdQ54S00wCfrqFTO');

// Capturar los datos
$importe = filter_var($_POST["importe"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$usuarioId = htmlspecialchars(trim($_POST["usuario"]));

try {
    // Crear el PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $importe * 100,  // Monto en centavos
        'currency' => 'eur',
        'metadata' => ['usuario_id' => $usuarioId]
    ]);

    // Devolver el client_secret
    echo json_encode(['client_secret' => $paymentIntent->client_secret]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
