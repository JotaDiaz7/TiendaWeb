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
    require __DIR__ . '/../../controllers/pedidos/pedidos_controllers.php';
    $productosPedido = consultar_productos_pedido($con, $pedido);
    //Ahora vamos a comprobar si alguno de estos productos ya se ha devuelto y en caso de que no, los ponemos para devolver
    $productosDevueltos = consultar_productos_devolucion($con, $pedido);
    require 'productos_sesion_devolucion.php';
    
    global $precioProductos;
    include '../views/productos_devolver.php';
}
