<?php

require './config/enlaces.php';
require './controllers/carrusels/carrusels_controller.php';

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
    <link rel="icon" href="./media/favicon.PNG">
    <script type="module" src="/js/index.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "./templates/header.php" ?>
    <main>
        <div id="mainBanner">
            <img src="./media/banner.jpg" alt="">
        </div>
        <?php crear_carrusel($con, "Novedades", 1, 10) ?>
        <?php crear_carrusel($con, "Top ventas", 3, 4) ?>
        <?php crear_carrusel($con, "Descuentos", 4, 10) ?>
    </main>
    <?php include "./templates/menuMain.php" ?>
    <?php include "./templates/carrito.php" ?>
    <?php include "./templates/footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
</body>

</html>