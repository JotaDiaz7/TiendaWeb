<?php

require './config/seguridad.php';
require './config/config.php';
require './config/utils.php';
require './controllers/categorias/categorias_controller.php';
require './controllers/carrito/carrito_controller.php';
require './controllers/descuentos/descuentos_controller.php';

//Establecemos conexión
$con = conectar_db();

seguridad(false, 0, $roll ?? -1);

require './config/carrito.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="icon" href="./media/favicon.png">
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "./templates/header.php" ?>
    <main>
        <div id="mainBanner">
            <img src="./media/banner.jpg" alt="">
        </div>
        <section id="novedades" class="container">
        </section>
    </main>
    <?php include "./templates/menuMain.php" ?>
    <?php include "./templates/carrito.php" ?>
    <?php include "./templates/footer.php" ?>
</body>

</html>