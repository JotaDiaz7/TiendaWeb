<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0, $rol ?? -1);

$urlA = '/pedidos';
$numItemsPag = 10; //Limitamos los elementos que queremos que aparezcan

//Vamos a llamar al controller para obtener los datos de los pedidos y su view
require  '../controllers/pedidos/pedidos_controllers.php';
//Obtenemos el número total de elementos
$totalItems = contarP($con, $id);

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
    <script type="module" src="../js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Lista de pedidos</h1>
        </section>
        <section>
            <div class="filtro d-flex space-between align-center">
                <div class="d-flex align-center">
                    <p>Ordenar por fecha: </p>
                    <a href="?order=ASC" class="button">Antiguos</a>
                    <a href="?order=DESC" class="button">Recientes</a>
                </div>
                <form method="get">
                    <input type="text" name="buscar" class="inputForm" placeholder="Pedido">
                    <input type="submit" class="button" value="Buscar">
                </form>
            </div>
            <table>
                <thead>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th class="editar">Ver</th>
                    <th class="borrar">Acción</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($buscar)) {
                        buscar_pedido($con, $buscar, $rol);
                    } else {
                        listar_pedidos($con, $order, $id,$rol, $inicio, $numItemsPag);
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php include "../templates/paginacion.php" ?>
        <section>
            <a href="/cuenta">Volver a mi cuenta</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
    <?php include "../templates/carrito.php" ?>
</body>

</html>