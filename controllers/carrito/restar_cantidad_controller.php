<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Atrapamos el id y el rol que hemos pasado por GET
$producto = htmlspecialchars(trim($_GET["producto"]));
$talla = filter_var($_GET["talla"], FILTER_SANITIZE_NUMBER_INT);

//Ahora vamos a comprobar el producto en la variable global
$restar = false;

foreach ($_SESSION['carrito'] as &$item) {
    if ($item['producto'] === $producto && $item['talla'] === $talla) {
        if ($item['cantidad'] > 1) {//Mientras la cantidad no sea menor a 1
            $item['cantidad'] -= 1; // Disminuimos la cantidad
            $restar = true;
        }
        break;
    }
}

unset($item); //Eliminamos el anterior item para poder disminuir la cantidad

//Por otra parte, si se ha iniciado sesión, lo vamos a borrar de la bbdd
if ((isset($_SESSION["usuario"]) || isset($_COOKIE["usuario"])) && $restar) {

    //Incluímos el modelo de carrito
    require '../../models/carrito_models.php';
    $model = new CarritoModel;

    $usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
    $id = $usuario[0];

    //Actualizamos los datos
    $model->disminuirCantidad($con, $id, $producto, $talla);

    // Cerrar la conexión
    $con = null;
}

echo json_encode("ok");
exit;