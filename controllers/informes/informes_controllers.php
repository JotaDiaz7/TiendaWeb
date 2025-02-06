<?php

function obtener_datos_informe($con, $tipo, $informe, $inicio, $num, $dato, $fecha_inicio, $fecha_fin){
    require_once '../models/informes_models.php';
    $model = new InformesModel;

    //Si es el primer informe son para los activos, si es el segundo es para los inactivos
    if($informe == 1){
        $activo = 1;
    }else if($informe == 2){
        $activo = 0;
    }else{
        $activo = "";//De lo contrario queremos todos los datos
    }

    //Si los productos el informe es el 4 hace referencia a las ventas
    $filtroProd = $tipo == 2 && $informe == 4 ? "ventas" : "";

    //Vamos a ver qué tipo de datos queremos usuario 1, producto 2, pedido 3, devolución 4 o venta 5
    switch($tipo){
        case 1:
            $dates = $model ->usuarios($con, $activo, $inicio, $num, $dato);
            include '../views/tabla_informe_usuarios.php';
        break;
        case 2:
            $dates = $model ->productos($con, $activo, $inicio, $num, $dato, $filtroProd);
            include '../views/tabla_informe_productos.php';
        break;
        case 3:
            $dates = $model ->pedidos($con, $dato, $inicio, $num, $fecha_inicio, $fecha_fin);
            include '../views/tabla_informe_pedidos.php';
        break;
        case 4:
            $dates = $model ->devoluciones($con, $dato, $inicio, $num, $fecha_inicio, $fecha_fin);
            include '../views/tabla_informe_devoluciones.php';
        break;
        case 5:
            $dates = $model ->ganancias($con,$fecha_inicio, $fecha_fin);
            include '../views/tabla_informe_ganancias.php';
        break;
    }
}

function contar($con, $tipo, $informe, $dato, $fecha_inicio, $fecha_fin): int{
    require_once '../models/informes_models.php';
    $model = new InformesModel;
    if($tipo != 5){//En el informe de ganancias no queremos que se haga la consulta
        $num = $model -> contar($con, $tipo, $informe, $dato, $fecha_inicio, $fecha_fin);
    }
    return $num ?? 0;
}

