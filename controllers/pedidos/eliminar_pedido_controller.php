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

//Eliminamos el pedido
$model->eliminarPedido($con, $pedido);

// Cerrar la conexión
$con = null;

header("Location: /admin/pedidos");
exit;