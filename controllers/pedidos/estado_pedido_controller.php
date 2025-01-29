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

//Actualizamos los datos
$model->cambiarEstado($con, $pedido, $estado);

// Cerrar la conexión
$con = null;

header("Location: /admin/pedido/".$pedido);
exit;