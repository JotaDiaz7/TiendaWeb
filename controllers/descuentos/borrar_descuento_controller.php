<?php
session_start();

if ((isset($_GET["descuento"]) && empty($_GET["descuento"]))) {
    header("Location: /");
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de descuento
require '../../models/descuentos_models.php';
$model = new DescuentosModel;

$descuento = htmlspecialchars(trim($_GET["descuento"]));

//Eliminamos el descuento del producto
$model -> borrarDescuentoProducto($con, $descuento);

//Borramos el descuento
$model->borrarDescuento($con, $descuento);

// Cerrar la conexión
$con = null;

header("Location: /admin/descuentos");
exit;