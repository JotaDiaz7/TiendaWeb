<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de carrito
require '../../models/carrito_models.php';
$model = new CarritoModel;

//Vamos a comprobar si ya existe la variable global carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

//Atrapamos los valores del producto
$id = htmlspecialchars(trim($_POST["id"]));
$talla = filter_var($_POST["talla"], FILTER_SANITIZE_NUMBER_INT);

//Vamos a obtener el stock de este producto según la talla
require '../prod_nums/prod_nums_controller.php';

$stock = obtener_stock_talla($con, $id, $talla);

//Ahora vamos a comprobar si ya existe el producto en el carrito
$encontrado = false;
$sumar = false;

foreach ($_SESSION['carrito'] as &$item) {
    if ($item['producto'] === $id && $item['talla'] === $talla) {
        if ($item['cantidad'] < $stock) { //Mientras la cantidad sea menor al stock
            $item['cantidad'] += 1; // Incrementamos la cantidad
            $sumar = true;
        }
        $encontrado = true;
        break;
    }
}

unset($item); //Eliminamos el anterior item para poder aumentar la cantidad

//Vamos a comprobar si existe un usuario logueado
$usuario = null;

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
} elseif (isset($_COOKIE["usuario"])) {
    $usuario = json_decode($_COOKIE["usuario"], true);
}

if ($encontrado) {
    //Si ha encontrado el producto y además, está logueado el usuario lo va a actualizar en la bbdd
    //Y si también, la cantidad no supera al stock del producto
    if ($usuario != null && $sumar) $model->aumentarCantidad($con, $usuario[0], $id, $talla, 1);
} else {
    $_SESSION['carrito'][] = [ //En caso de que no exista nos creamos nuestro producto en la variable global
        'producto' => $id,
        'talla' => $talla,
        'cantidad' => 1
    ];

    //Y si el usuario está logueado lo registramos en la base de datos
    if ($usuario != null) $model->registro($con, $usuario[0], $id, $talla, 1);
}

// Cerrar la conexión
$con = null;

echo json_encode($usuario);
exit;
