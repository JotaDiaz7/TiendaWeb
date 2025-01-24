<?php
function productos_usuario($con, $usuario)
{
    require_once __DIR__ . '/../../models/carrito_models.php';

    $model = new CarritoModel;
    $dates = $model->productosUsuario($con, $usuario);

    return $dates;
}

function productos_sesion($con, $productos){
    $carrito = $productos;
    require_once __DIR__ . '/../../models/productos_models.php';
    include __DIR__ . '/../../views/data_carrito.php';
}
