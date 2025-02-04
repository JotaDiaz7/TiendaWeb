<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 2, $rol ?? -1);

//Atrapamos los datos pasados por get
$titulo = $_GET["titulo"];
$tipo = $_GET["tipo"];
$informe = $_GET["informe"];
$dato = isset($_GET["dato"]) ? $_GET["dato"] : "";
$datoUrl = !empty($dato) ? "&dato=".$dato : "";

//Vamos a llamar al controller de informes
require '../controllers/informes/informes_controllers.php';

$urlA = "/admin/informe" ;
//Vamos a construir la url para los filtros
$urlF = "&titulo=" . $titulo . "&tipo=" . $tipo . "&informe=" . $informe;
//Vamos a construir la url para la paginación
$url = "&titulo=" . $titulo . "&tipo=" . $tipo . "&informe=" . $informe . $datoUrl;

$numItemsPag = 10; //Limitamos los elementos que queremos que aparezcan

//Obtenemos el número total de elementos
$totalItems = contar($con, $tipo, $informe, $dato);

//inicializamos la página y el inicio para el límite de SQL
$pagina = 1;
$inicio = 0;
//examino la página a mostrar y la muestro si existe
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
    $inicio = ($pagina - 1) * $numItemsPag;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/informes.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1><?= $titulo ?></h1>
        </section>
        <section class="tableWrap">
            <?php 
            include '../views/inputs_informes.php';
            obtener_datos_informe($con, $tipo, $informe, $inicio, $numItemsPag, $dato) 
            ?>
        </section>
        <?php include '../templates/paginacion.php' ?>
        <section>
            <a href="/admin/informes">Ver todos los informes</a>
        </section>
    </main>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>