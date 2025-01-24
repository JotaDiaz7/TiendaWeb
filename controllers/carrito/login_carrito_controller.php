<?php 
//Este archivo es para comprobar si antes de loguearse se ha añadido algún producto al carrito, de esta forma se guardará automáticamente en la bbdd

if(isset($_SESSION["carrito"])){
    require '../../models/carrito_models.php';
    require '../prod_nums/prod_nums_controller.php';

    $model = new CarritoModel;

    $usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
    $usuario = $usuario[0];

    foreach ($_SESSION['carrito'] as &$item) {
        //Comprobamos si el producto ya existe en la bbdd y cuál es su cantidad
        $prodCar = $model -> getCantProd($con, $usuario, $item["producto"], $item["talla"]);

        if($prodCar){
            //Si ya existe el producto en el carrito, vamos a consultar el stock
            $stock = obtener_stock_talla($con, $item["producto"], $item["talla"]);

            if(($item["cantidad"] + $prodCar) <= $stock){//Si la suma del producto en el carrito con el de la bbdd es menor a la del stock
                $model->aumentarCantidad($con, $usuario, $item["producto"], $item["talla"], $item["cantidad"]);
            }else{//De lo contrario vamos a sumarle lo que quede de stock
                $model->cambiarCantidad($con, $usuario, $item["producto"], $item["talla"], $stock);
            }
        }else{
            $model->registro($con, $usuario, $item["producto"], $item["talla"], $item["cantidad"]);
        }
    }
}