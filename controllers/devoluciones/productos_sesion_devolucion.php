<?php

//Primero vamos a comprobar que los preductos que ya hay en la variable global pertenezcan a este pedido
if (isset($_SESSION["devolucion"])) {
    foreach ($_SESSION["devolucion"] as $item) { //Recorremos los productos del pedido
        if ($pedido != $item["pedido"]) {//Si hay algún producto que no es de este pedido vamos a eliminar la variable
            unset($_SESSION["devolucion"]);
            break;
        }
    }
}

if (!isset($_SESSION["devolucion"])) {//En el caso de que no exista devolución o que lo hayamos eliminado
    $_SESSION["devolucion"] = [];
    $cantidad_max = 0;
    foreach ($productosPedido as $item) { //Recorremos los productos del pedido
        $cantidad_max = $item['cantidad'];

        // Comprobamos si el producto ya ha sido devuelto
        $devuelto = false;
        foreach ($productosDevueltos as $devueltoItem) {
            if ($devueltoItem['id'] == $item['id'] && $devueltoItem['talla'] == $item['talla']) { //Si encuentra el producto
                if ($devueltoItem['cantidad'] < $item['cantidad']) { //Y aun no está devuelta toda la cantidad de ese producto
                    //Vamos a calcular la cantidad máxima que se puede devolver
                    $cantidad_max = $item['cantidad'] - $devueltoItem['cantidad'];
                } else {
                    $devuelto = true; //Ponemos true si ya se ha devuelto alguno
                    break;
                }
            }
        }

        if (!$devuelto) {
            $_SESSION["devolucion"][] = [ //En caso de que no exista nos creamos nuestro producto en la variable global
                'pedido' => $pedido,
                'id' => $item['id'],
                'talla' => $item['talla'],
                'precio' => $item['precio'],
                'cantidad' => 0,
                'cantidad_max' => $cantidad_max
            ];
        }
    }
}
