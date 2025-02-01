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

//Ahora vamos a comprobar el producto en la variable global
$restar = false;

foreach ($_SESSION['devolucion'] as &$item) {
    if ($item['id'] === $producto && $item['talla'] === $talla) {
        if ($item['cantidad'] > 0) {//Mientras la cantidad no sea menor a 1
            $item['cantidad'] -= 1; // Disminuimos la cantidad
            $restar = true;
        }
        break;
    }
}

unset($item); //Eliminamos el anterior item para poder disminuir la cantidad

header("Location: /checkout-devolucion/".$pedido);
exit;