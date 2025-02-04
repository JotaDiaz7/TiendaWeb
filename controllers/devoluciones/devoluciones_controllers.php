<?php

function consultar_productos_devolucion($con, $pedido)
{
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $lineas = $model->productosDevueltos($con, $pedido);
    return $lineas;
}

function obtener_productos_devolver($con, $pedido)
{
    //Primero vamos a ver si ya se ha devuelto algún producto de este pedido
    require_once __DIR__ . '/../../controllers/pedidos/pedidos_controllers.php';
    $productosPedido = consultar_productos_pedido($con, $pedido);
    //Ahora vamos a comprobar si alguno de estos productos ya se ha devuelto y en caso de que no, los ponemos para devolver
    $productosDevueltos = consultar_productos_devolucion($con, $pedido);
    require 'productos_sesion_devolucion.php';
    
    global $precioProductos;
    include '../views/productos_devolver.php';
}

function consultar_devolucion($con, $id)
{
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $dates = $model -> getDevolucion($con, $id);
    $lineas = $model -> productosDevolucion($con, $id);
    include '../views/data_devolucion.php';
}

function contarD($con, $usuario)
{
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $num = $model -> contar($con, $usuario);
    return $num;
}

function listar_devoluciones($con, $order, $usuario, $rol, $inicio, $num)
{
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $dates = $model -> listarDevoluciones($con, $order, $inicio, $num, $usuario);
    include '../views/tabla_devoluciones.php';
}

function consultar_estado_devolucion($con, $devolucion, $rol){
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $dates = $model -> getDevolucion($con, $devolucion);
    include '../views/estado_devolucion.php';
}

function buscar_devolucion($con, $buscar, $rol)
{
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $dates = $model -> buscarDevolucion($con, $buscar);
    include '../views/tabla_devoluciones.php';
}

function devolucion_cancelada($con, $devolucion){
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $dates = $model -> getDevolucion($con, $devolucion);
    return $dates["estado"] == "Cancelada" ? true : false;
}

function comprobar_id_devolucion($con, $devolucion){
    require_once '../models/devoluciones_models.php';
    $model = new DevolucionesModel;
    $dates = $model -> comprobarId($con, $devolucion);
    return $dates;
}