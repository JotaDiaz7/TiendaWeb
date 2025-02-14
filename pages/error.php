<?php
require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(false, 0, $roll ?? -1);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/error.css">
    <link rel="icon" href="/media/favicon.PNG">
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main>
        <section>
            <h1>Ups! Parece que ha habido un problema</h1>
        </section>
        <section>
            <p><?php if(isset($_GET["error"])){ echo $_GET["error"];} ?></p>
        </section>
    </main>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>