<?php
function buscar_producto($con, $buscar)
{
    require_once '../models/productos_models.php';
    $model = new ProductosModel;
    $dates = $model -> buscarProducto($con, $buscar);
    include '../views/tabla_productos.php';
}

function consultar_producto($con, $id)
{
    require_once '../models/productos_models.php';
    $model = new ProductosModel;
    $dates = $model -> getProducto($con, $id);
    include '../views/data_producto.php';
}

function plantilla_producto($con, $id, $esCalzado, $stockProd, $tallaProd){
    require_once '../models/productos_models.php';
    $model = new ProductosModel;
    $dates = $model -> getProducto($con, $id);
    $calzado = $esCalzado;
    $stocks = $stockProd;
    $talla = $tallaProd;
    include '../views/img_productos.php';
    include '../views/detalles_producto.php';
}

function listar_productos($con, $order, $inicio, $num)
{
    require_once '../models/productos_models.php';
    $model = new ProductosModel;
    $dates = $model -> listarProductos($con, $order, $inicio, $num);
    include '../views/tabla_productos.php';
}

function listar_productos_categoria($con, $categoria, $order, $inicio, $num)
{
    require_once '../models/productos_models.php';
    require '../controllers/prod_nums/prod_nums_controller.php';
    $model = new ProductosModel;
    $dates = $model -> getProductosCat($con, $categoria, $order, $inicio, $num);
    include '../views/producto_card.php';
}

function buscar_productos_usuario($con, $producto, $categoria)
{
    require_once '../models/productos_models.php';
    require '../controllers/prod_nums/prod_nums_controller.php';
    $model = new ProductosModel;
    $dates = $model -> buscarProductoUsuario($con, $producto,$categoria);
    include '../views/producto_card.php';
}

function contar($con, $categoria){
    require_once '../models/productos_models.php';
    $model = new ProductosModel;
    $num = $model -> contar($con, $categoria);
    return $num;
}