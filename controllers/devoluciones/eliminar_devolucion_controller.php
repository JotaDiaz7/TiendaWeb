<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de devolución
require '../../models/devoluciones_models.php';
$model = new DevolucionesModel;

//Atrapamos los datos pasados por GET
$devolucion = htmlspecialchars(trim($_GET["devolucion"]));

//Eliminamos la devolucion
$model->eliminarDevolucion($con, $devolucion);

// Cerrar la conexión
$con = null;

header("Location: /admin/devoluciones");
exit;