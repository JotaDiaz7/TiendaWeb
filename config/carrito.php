<?php
//Nos creamos este archivo para llamarlo en todas las páginas donde se tenga que mostrar el carrito

if (isset($_SESSION["usuario"]) || isset($_COOKIE["usuario"])) {
    //Vamos a comprobar si el usuario tiene guardado algún producto en la bbdd
    $_SESSION["carrito"] = productos_usuario($con, $id);
}

$carrito = $_SESSION["carrito"] ?? [];