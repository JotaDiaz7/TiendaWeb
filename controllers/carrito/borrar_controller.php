<?php
session_start();

//Atrapamos el id y el rol que hemos pasado por GET
$producto = htmlspecialchars(trim($_GET["producto"]));
$talla = filter_var($_GET["talla"], FILTER_SANITIZE_NUMBER_INT);

//Vamos a eliminar el producto de la variable global carrito
foreach ($_SESSION['carrito'] as $index => $item) {
    if ($item['producto'] === $producto && $item['talla'] === $talla) {
        // Eliminamos el producto del carrito usando el índice
        unset($_SESSION['carrito'][$index]);
        break;
    }
}

// Reindexamos el carrito para evitar problemas con índices numéricos
$_SESSION['carrito'] = array_values($_SESSION['carrito']);

//Por otra parte, si se ha iniciado sesión, lo vamos a borrar de la bbdd
if (isset($_SESSION["usuario"]) || isset($_COOKIE["usuario"])) {
    //Incluímos la configuración a la base de datos
    require '../../config/config.php';
    //Establecemos conexión
    $con = conectar_db();

    //Incluímos el modelo de carrito
    require '../../models/carrito_models.php';
    $model = new CarritoModel;

    $usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
    $id = $usuario[0];

    //Actualizamos los datos
    $model->eliminarProducto($con, $id, $producto, $talla);

    // Cerrar la conexión
    $con = null;
}

echo json_encode("ok");
exit;