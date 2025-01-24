<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

if (empty($_GET["id"])) {
    header("/");
    exit;
} else {
    $descuento = $_GET["id"];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/perfil.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/registro-admin.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section class="md30">
            <h1>Descuento <span><?= $descuento ?></span></h1>
        </section>
        <section class="mainWrap d-flex">
            <div id="wrapDates">
                <?php consultar_descuento($con, $descuento) ?>
            </div>
        </section>
        <section>
            <a href="/admin/descuentos">Ver todos los descuentos</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>