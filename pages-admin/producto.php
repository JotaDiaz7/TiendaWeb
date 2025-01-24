<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

//Vamos a llamar al controller para obtener los datos del productos y su view
require '../controllers/productos/productos_controllers.php';

if (empty($_GET["id"])) {
    header("/");
    exit;
} else {
    $id = $_GET["id"];
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/registro-admin.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/registro-admin.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Producto <strong><?= $id ?></strong></h1>
        </section>
        <section class="mainWrap d-flex">
            <div id="wrapDates">
                <?php consultar_producto($con, $id) ?>
            </div>
        </section>
        <section>
            <a id="delete" href="/admin/productos">Ver todos los productos</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>