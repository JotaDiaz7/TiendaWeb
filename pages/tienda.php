<?php
require '../config/enlaces.php';

seguridad(false, 0, $rol ?? -1);

//Establecemos conexión
$con = conectar_db();

if (empty($_GET['categoria'])) {
    header("Location: /");
    exit;
}

$categoriaId = $_GET['categoria'];
//Vamos a ver si la categoría existe
$categoria = checkCatNombre($con, $categoriaId);
if (!$categoria) {
    header("Location: /error/Lo sentimos, pero no hemos podido encontrar esa categoría");
    exit;
}

//Nos vamos a crear una variable para en caso de que haya paginación ponerlo como enlace
$urlA = '/tienda/' . $categoria;
$numItemsPag = 8; //Limitamos los elementos que queremos que aparezcan

require '../config/carrito.php';

require_once '../controllers/productos/productos_controllers.php';
//Obtenemos el número total de elementos
$totalItems = contar($con);

require_once '../config/orderBuscarPag.php';


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/tienda.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/general.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main>
        <section id="titleWrap">
            <h1><?= $categoria ?></h1>
        </section>
        <div class="filtro d-flex space-around align-center">
            <div class="d-flex align-center">
                <p>Ordenar por nombre: </p>
                <a href="?order=ASC" class="button">A-Z</a>
                <a href="?order=DESC" class="button">Z-A</a>
            </div>
            <form method="get">
                <input type="text" name="buscar" class="inputForm" placeholder="Producto">
                <input type="submit" class="button" value="Buscar">
            </form>
        </div>
        <section id="productsWrap" class="d-flex">
            <?php
            if (isset($buscar)) {
                buscar_productos_usuario($con, $buscar, $categoria);
            } else {
                listar_productos_categoria($con, $categoriaId, $order, $inicio, $numItemsPag);
            }
            ?>
        </section>
        <?php include "../templates/paginacion.php" ?>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>