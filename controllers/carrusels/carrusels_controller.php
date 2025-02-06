<?php

//Tipos de carrusel
//1. Crea novedades
//2. Crea por categoría pasada por título
//3. Crea por más vendidos
//4. Crea por productos con descuentos

function crear_carrusel($con, $titulo, $tipo, $numProd)
{
    require_once './models/productos_models.php';
    require_once './controllers/prod_nums/prod_nums_controller.php';
    $model = new ProductosModel;
    $dates = [];

    switch ($tipo) {
        case 1:
            $dates = $model->novedades($con, $numProd);
            break;
        case 3:
            $dates = $model->topVentas($con, $numProd);
            break;
        case 4:
            $dates = $model->descuentos($con, $numProd);
            break;
    }

    if (!empty($dates)) include './views/carrusel_productos.php';
}
