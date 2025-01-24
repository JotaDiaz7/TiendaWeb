<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

$urlA = '/admin/productos';
$numItemsPag = 6; //Limitamos los elementos que queremos que aparezcan

//Vamos a llamar al controller para obtener los datos de los productos y su view
require  '../controllers/productos/productos_controllers.php';
//Obtenemos el número total de elementos
$totalItems = contar($con);

require '../config/orderBuscarPag.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/usuarios.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/usuarios.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Lista de productos</h1>
        </section>
        <section>
            <div class="filtro d-flex space-between align-center">
                <div class="d-flex align-center">
                    <p>Ordenar por nombre: </p>
                    <a href="?order=ASC" class="button">A-Z</a>
                    <a href="?order=DESC" class="button">Z-A</a>
                </div>
                <a href="/admin/registro-productos" class="button">Registrar producto</a>
                <form method="get">
                    <input type="text" name="buscar" class="inputForm" placeholder="Producto">
                    <input type="submit" class="button" value="Buscar">
                </form>
            </div>
            <table>
                <thead>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Ventas</th>
                    <th class="editar">Editar</th>
                    <th class="stock">Stock</th>
                    <th class="borrar">Estado</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($buscar)) {
                        buscar_producto($con, $buscar);
                    } else {
                        listar_productos($con, $order);
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php include "../templates/paginacion.php" ?>
        <section>
            <a href="/admin/administracion">Volver al panel de control</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>