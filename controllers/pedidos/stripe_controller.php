<?php
session_start();
require '../../config/stripe/vendor/autoload.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

\Stripe\Stripe::setApiKey('sk_test_51QmwdFBGL99kE3BPLdWZaAaVmBhnto9zdbil6H6lfGPzxkYQi1QWeQZNsdux3ywujYDAl4hKRjRCQoaziGtdQ54S00wCfrqFTO');
header('Content-Type: application/json');

// Capturar los datos
$importe = filter_var($_POST["importe"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$usuarioId = htmlspecialchars(trim($_POST["usuario"]));
$metodo = htmlspecialchars(trim($_POST["metodoPago"]));

//Incluímos el modelo de Producto y Descuento para saber si el producto en el momento de registrarse tenía algún descuento
require '../../config/utils.php';
require '../../models/productos_models.php';
$modelP = new ProductosModel;
require '../../models/descuentos_models.php';
$modelD = new DescuentosModel;

try {

    $YOUR_DOMAIN = 'http://lamadriguera.great-site.net'; // Asegúrate de que este dominio sea correcto
    $precioTotal = 0;
    $productos = [];  
    $productosCompra = [];  
    
    // Comprobamos si el total del pedido tiene que hacer envíos
    foreach ($_SESSION["carrito"] as $item) {
        // Calculamos el precio final del producto
        $producto = $modelP->getProducto($con, $item["producto"]);
        $precio = $producto["precio"];
        $datesDesc = $modelD->getDescuentoProducto($con, $item["producto"]);
        $precio = !empty($datesDesc) ? calcular_descuento($datesDesc, $precio) : $precio;
    
        // Guardamos la información del producto
        $productos[] = [
            'nombre' => $producto['nombre'],
            'precio' => $precio,
            'cantidad' => $item['cantidad']
        ];
    
        // Sumamos el precio al total
        $precioTotal += $precio * $item['cantidad'];
    }
    
    // Si el total es menor a 150, agregamos el costo de los portes
    if($precioTotal < 150) {
        $productos[] = [
            'nombre' => "Portes",
            'precio' => 5, 
            'cantidad' => 1
        ];
        $precioTotal += 5;  
    }
    
    // Convertimos los productos a formato compatible con Stripe
    foreach ($productos as $item) {
        $productosCompra[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $item['nombre'],  
                ],
                'unit_amount' => $item['precio'] * 100,  
            ],
            'quantity' => $item['cantidad'],
        ];
    }

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $productosCompra,
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/controllers/pedidos/registro_controller.php?usuario=' . $usuarioId . '&metodoPago=' . $metodo . '&importe=' . $importe,
        'cancel_url' => $YOUR_DOMAIN. '/error?error=No se ha podido completar la compra.'
    ]);

    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
