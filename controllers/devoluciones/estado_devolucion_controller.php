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
$estado = htmlspecialchars(trim($_GET["estado"]));

//Actualizamos los datos
$model->cambiarEstado($con, $devolucion, $estado);

if ($estado == "Cancelada") {
    //Incluímos el modelo de Producto para las ventas y el modelo Prod_nums para el stock
    require '../../models/productos_models.php';
    $modelP = new ProductosModel;
    require '../../models/prod_nums_models.php';
    $modelPN = new ProdNumsModel;

    //Obtenemos todos los productos que se han hecho en esta devolución
    $dates = $model->productosDevolucion($con, $devolucion);

    //Ahora vamos a recorrerlo
    foreach ($dates as $item) {
        //Le bajamos el stock
        $modelPN->disminuirStock($con, $item["id"], $item["talla"], $item["cantidad"]);
        //Le aumentamos las ventas
        $modelP->aumentarVentas($con, $item["id"], $item["cantidad"]);
    }
}

// Cerrar la conexión
$con = null;

header("Location: /devolucion/" . $devolucion);
exit;
