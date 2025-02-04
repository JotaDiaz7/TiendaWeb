<?php
//Vamos a capturar si se hubiera seleccionado un orden
$order = "";
$url ="";
if (isset($_GET["order"]) && ($_GET["order"] == "ASC" || $_GET["order"] == "DESC")) {
    $order = $_GET["order"];
    $url = "&order=".$order;
}

if (isset($_GET["buscar"]) && !empty($_GET["buscar"])) {
    $buscar = $_GET["buscar"];
} else {
    //Y si no se ha realizado ninguna búsqueda
    //Vamos a obtener el resto de datos de los artículos mediante el gestor con paginación

    //inicializamos la página y el inicio para el límite de SQL
    $pagina = 1;
    $inicio = 0;
    //examino la página a mostrar y la muestro si existe
    if (isset($_GET["pagina"])) {
        $pagina = $_GET["pagina"];
        $inicio = ($pagina - 1) * $numItemsPag;
    }
}