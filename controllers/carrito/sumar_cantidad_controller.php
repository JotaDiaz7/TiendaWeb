<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Atrapamos el id y el rol que hemos pasado por GET
$producto = htmlspecialchars(trim($_GET["producto"]));
$talla = filter_var($_GET["talla"], FILTER_SANITIZE_NUMBER_INT);

//Vamos a obtener el stock de este producto según la talla
require '../prod_nums/prod_nums_controller.php';

$stock = obtener_stock_talla($con, $producto, $talla);

//Ahora vamos a comprobar el producto en la variable global
$sumar = false;

foreach ($_SESSION['carrito'] as &$item) {
    if ($item['producto'] === $producto && $item['talla'] === $talla) {
        if ($item['cantidad'] < $stock) {//Mientras la cantidad sea menor al stock
            $item['cantidad'] += 1; // Incrementamos la cantidad
            $sumar = true;
        }
        break;
    }
}

unset($item); //Eliminamos el anterior item para poder aumentar la cantidad

//Por otra parte, si se ha iniciado sesión, lo vamos a borrar de la bbdd
if ((isset($_SESSION["usuario"]) || isset($_COOKIE["usuario"])) && $sumar) {

    //Incluímos el modelo de carrito
    require '../../models/carrito_models.php';
    $model = new CarritoModel;

    $usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
    $id = $usuario[0];

    //Actualizamos los datos
    $model->aumentarCantidad($con, $id, $producto, $talla, 1);

    // Cerrar la conexión
    $con = null;
}

echo json_encode("ok");
exit;