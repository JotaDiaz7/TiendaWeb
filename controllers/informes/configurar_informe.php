<?php

//Vamos a comprobar que los campos requerido existan
if((!isset($_GET["titulo"]) || empty($_GET["titulo"]))
|| (!isset($_GET["tipo"]) || empty($_GET["tipo"]))
|| (!isset($_GET["informe"]) || empty($_GET["informe"]))){
    header("Location: /error?error=Informe no enconrtado");
    exit;
}

//Atrapamos los datos pasados por get
$titulo = $_GET["titulo"];
$tipo = $_GET["tipo"];
$informe = $_GET["informe"];
$dato = $_GET["dato"] ?? "";
$datoUrl = !empty($dato) ? "&dato=" . $dato : "";
$fecha_inicio = $_GET['fecha_inicio'] ?? '';
$fecha_fin = $_GET['fecha_fin'] ?? '';

//Vamos a llamar al controller de informes
require '../controllers/informes/informes_controllers.php';

$urlA = "/admin/informe";
//Vamos a construir la url para los filtros
$urlF = "&titulo=" . $titulo . "&tipo=" . $tipo . "&informe=" . $informe;
//Vamos a construir la url para la paginación
if (!empty($fecha_inicio) && !empty($fecha_fin)) { //Si han pasado fechas por la url
    $url = "&titulo=" . $titulo . "&tipo=" . $tipo . "&informe=" . $informe . "&fecha_inicio=" . $fecha_inicio . "&fecha_fin=" . $fecha_fin;
} else {
    $url = "&titulo=" . $titulo . "&tipo=" . $tipo . "&informe=" . $informe . $datoUrl;
}

$numItemsPag = 10; //Limitamos los elementos que queremos que aparezcan

//Obtenemos el número total de elementos
$totalItems = contar($con, $tipo, $informe, $dato, $fecha_inicio, $fecha_fin);

//inicializamos la página y el inicio para el límite de SQL
$pagina = 1;
$inicio = 0;
//examino la página a mostrar y la muestro si existe
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
    $inicio = ($pagina - 1) * $numItemsPag;
}