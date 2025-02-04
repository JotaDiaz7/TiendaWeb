<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 2, $rol ?? -1);


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
            <h1>Informes</h1>
        </section>
        <section class="mainWrap">
            <div>
                <h3>Usuarios</h3>
                <ul>
                    <li><a href="/admin/informe?titulo=Usuarios activos&tipo=1&informe=1">Usuarios activos</a></li>
                    <li><a href="/admin/informe?titulo=Usuarios inactivos&tipo=1&informe=2">Usuarios inactivos</a></li>
                    <li><a href="/admin/informe?titulo=Usuarios antigüedad&tipo=1&informe=3">Antigüedad</a></li>
                </ul>
            </div>
            <div>
                <h3>Productos</h3>
                <ul>
                    <li><a href="/admin/informe?titulo=Productos activos&tipo=2&informe=1">Productos activos</a></li>
                    <li><a href="/admin/informe?titulo=Productos inactivos&tipo=2&informe=2">Productos inactivos</a></li>
                    <li><a href="/admin/informe?titulo=Productos antigüedad&tipo=2&informe=3">Antigüedad</a></li>
                    <li><a href="/admin/informe?titulo=Productos ventas&tipo=2&informe=4">Ventas</a></li>
                </ul>
            </div>
            <div>
                <h3>Pedidos</h3>
                <ul>
                    <li><a href="/admin/informe?titulo=Pedidos estado&tipo=3&informe=1">Filtrar por estado</a></li>
                    <li><a href="/admin/informe?titulo=Pedidos fecha&tipo=3&informe=2">Filtrar por fecha</a></li>
                </ul>
            </div>
            <div>
                <h3>Devoluciones</h3>
                <ul>
                    <li><a href="">Filtrar por estado</a></li>
                    <li><a href="">Filtrar por fecha</a></li>
                </ul>
            </div>
            <div>
                <h3>Ventas</h3>
                <ul>
                    <li><a href="">Filtrar por fecha</a></li>
                </ul>
            </div>
        </section>
        <section>
            <a href="/admin/administracion">Volver al panel de control</a>
        </section>
    </main>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>