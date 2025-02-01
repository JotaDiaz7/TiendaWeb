<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Atrapamos el id y el rol que hemos pasado por GET
$pedido = htmlspecialchars(trim($_GET["pedido"]));
$producto = htmlspecialchars(trim($_GET["producto"]));
$talla = filter_var($_GET["talla"], FILTER_SANITIZE_NUMBER_INT);
$max = filter_var($_GET["max"], FILTER_SANITIZE_NUMBER_INT);

//Ahora vamos a comprobar el producto en la variable global
$sumar = false;

foreach ($_SESSION['devolucion'] as &$item) {
    if ($item['id'] === $producto && $item['talla'] === $talla) {
        if ($item['cantidad'] < $max) {//Mientras la cantidad sea menor al stock
            $item['cantidad'] += 1; // Incrementamos la cantidad
            $sumar = true;
        }
        break;
    }
}

unset($item); //Eliminamos el anterior item para poder aumentar la cantidad

header("Location: /checkout-devolucion/".$pedido);
exit;