<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de pedidos
require '../../models/pedidos_models.php';
$model = new PedidosModel;

//Atrapamos los datos pasados por GET
$pedido = htmlspecialchars(trim($_GET["pedido"]));
$estado = htmlspecialchars(trim($_GET["estado"]));
$rol = filter_var($_GET["usuario"], FILTER_SANITIZE_NUMBER_INT);

//Actualizamos los datos
$model->cambiarEstado($con, $pedido, $estado);

if ($estado == "Cancelado") {
    //Modificamos el stock y las ventas
    require './cambiar_stock_ventas.php';
}

// Cerrar la conexión
$con = null;

if ($rol == 0) {
    header("Location: /pedido/" . $pedido);
} else {
    header("Location: /admin/pedido/" . $pedido);
}
exit;
