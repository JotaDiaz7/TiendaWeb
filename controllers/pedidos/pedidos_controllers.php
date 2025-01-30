<?php
function buscar_pedido($con, $buscar, $rol)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $dates = $model -> buscarPedido($con, $buscar);
    include '../views/tabla_pedidos.php';
}

function consultar_pedido($con, $id)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $dates = $model -> getPedido($con, $id);
    $lineas = $model -> productosPedido($con, $id);
    include '../views/data_pedido.php';
}

function listar_pedidos($con, $order, $usuario, $rol, $inicio, $num)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $dates = $model -> listarPedidos($con, $order, $inicio, $num, $usuario);
    include '../views/tabla_pedidos.php';
}

function contar($con, $usuario)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $num = $model -> contar($con, $usuario);
    return $num;
}

function consultar_estado($con, $pedido, $rol){
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $dates = $model -> getPedido($con, $pedido);
    include '../views/estado_pedido.php';
}

function pedido_cancelado($con, $pedido){
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $dates = $model -> getPedido($con, $pedido);
    return $dates["estado"] == "Cancelado" ? true : false;
}