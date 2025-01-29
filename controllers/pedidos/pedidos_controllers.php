<?php
function buscar_pedido($con, $buscar)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    //$pedidos = $model -> buscarpedido($con, $buscar);
    include '../views/tabla_pedidos.php';
}

function consultar_pedido($con, $id)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $dates = $model -> getpedido($con, $id);
    include '../views/data_pedido.php';
}

function listar_pedidos($con, $order, $inicio, $num)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $pedidos = $model -> listarPedidos($con, $order, $inicio, $num);
    include '../views/tabla_pedidos.php';
}

function contar($con)
{
    require_once '../models/pedidos_models.php';
    $model = new PedidosModel;
    $num = $model -> contar($con);
    return $num;
}