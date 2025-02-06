<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 2, $rol ?? -1);

require '../controllers/informes/configurar_informe.php';

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
            obtener_datos_informe($con, $tipo, $informe, $inicio, $numItemsPag, $dato, $fecha_inicio, $fecha_fin)
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