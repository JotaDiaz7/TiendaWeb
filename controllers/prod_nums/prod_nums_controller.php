<?php
function listar_stock($con, $producto, $esCalzado)
{
    require_once '../models/prod_nums_models.php';
    $model = new ProdNumsModel;
    $dates = $model -> getStock($con, $producto);
    $calzado = $esCalzado;
    include '../views/tabla_stock.php';
}

function obetener_min_talla($con, $producto)
{
    require_once __DIR__ .'/../../models/prod_nums_models.php';
    $model = new ProdNumsModel;
    $dates = $model -> getMinTalla($con, $producto);
    return $dates;
}

function obtener_stock_talla($con, $producto, $talla)
{
    require_once __DIR__ .'/../../models/prod_nums_models.php';
    $model = new ProdNumsModel;
    $dates = $model -> getStockTalla($con, $producto, $talla);
    return $dates;
}