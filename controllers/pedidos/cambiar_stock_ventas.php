<?php

//Incluímos el modelo de Producto para las ventas y el modelo Prod_nums para el stock
require '../../models/productos_models.php';
$modelP = new ProductosModel;
require '../../models/prod_nums_models.php';
$modelPN = new ProdNumsModel;

//Obtenemos todos los productos que se han hecho en este pedido
$dates = $model -> productosPedido($con, $pedido);

//Ahora vamos a recorrerlo
foreach ($dates as $item) {
    //Le aumentamos el stock
    $modelPN->updateStock($con, $item["id"], $item["talla"], $item["cantidad"]);
    //Le bajamos las ventas
    $modelP->disminuirVentas($con, $item["id"], $item["cantidad"]);
}