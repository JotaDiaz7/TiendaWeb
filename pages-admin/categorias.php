<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

$urlA = '/admin/categorias';
$numItemsPag = 8; //Limitamos los elementos que queremos que aparezcan

//Obtenemos el número total de elementos
$totalItems = contarCat($con);

require '../config/orderBuscarPag.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/categorias.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Lista de categorías</h1>
        </section>
        <section>
            <div class="d-flex space-between">
                <a href="/admin/registro-categoria" class="button">Añadir categoría</a>
                <form method="get">
                    <input type="text" name="buscar" class="inputForm" placeholder="Producto">
                    <input type="submit" class="button" value="Buscar">
                </form>
            </div>
            <table>
                <thead>
                    <th>Categoría</th>
                    <th>Padre</th>
                    <th class="borrar">Estado</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>

                    <?php
                    if (isset($buscar)) {
                        buscar_categoria($con, $buscar);
                    } else {
                        listar_categorias($con, $inicio, $numItemsPag, $pagina);
                    }

                    ?>
                </tbody>
            </table>
        </section>
        <?php include "../templates/paginacion.php" ?>
        <section>
            <a href="/admin/administracion">Voler al panel de control</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>