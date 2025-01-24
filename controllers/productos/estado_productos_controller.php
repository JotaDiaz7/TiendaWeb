<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de producto
require '../../models/productos_models.php';
$model = new ProductosModel;

//Obtenemos el id
$id = htmlspecialchars(trim($_GET["id"]));

//Obtenemos el estado al que vamos a cambiar
$estado = htmlspecialchars(trim($_GET["estado"]));

//Actualizamos los datos
$model->estadoProducto($con, $id, $estado);

// Cerrar la conexión
$con = null;

header("Location: /admin/productos");
exit;