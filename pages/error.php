<?php
require '../config/enlaces.php';

seguridad(false, 0, $roll ?? -1);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="icon" href="../media/favicon.PNG">
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main>
        <h1>Ups! Parece que ha habido un problema</h1>
    </main>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>