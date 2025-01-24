<?php
function listar_descuentos($con, $options)
{
    require_once '../models/descuentos_models.php';
    $model = new DescuentosModel;
    $dates = $model -> listarDescuentos($con);
    if(!$options){
        include '../views/tabla_descuentos.php';
    }else{
        include '../views/options_descuentos.php';
    }
}

function consultar_descuento($con, $descuento)
{
    require_once '../models/descuentos_models.php';
    $model = new DescuentosModel;
    $dates = $model -> getDescuento($con, $descuento);
    include '../views/data_descuento.php';
}

function consultar_precio($con, $producto, $precioProd, $carrito)
{
    require_once __DIR__ .'/../../models/descuentos_models.php';
    require_once __DIR__ .'/../../config/utils.php';
    $model = new DescuentosModel;
    $datesDesc = $model -> getDescuentoProducto($con, $producto);
    $precio = $precioProd;
    if($carrito){
        return calcular_descuento($datesDesc, $precio);
    }else{
        include __DIR__ .'/../../views/precio.php';
    }
}