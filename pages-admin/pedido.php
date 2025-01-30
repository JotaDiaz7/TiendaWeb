<?php
require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

//Vamos a llamar al controller para obtener los datos del pedido y su view
require '../controllers/pedidos/pedidos_controllers.php';

if (empty($_GET["id"])) {
    header("/error?error=Pedido no encontrado.");
    exit;
} 
    
$pedido = $_GET["id"];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/operacion.css">
    <link rel="icon" href="/media/favicon.PNG">
    <script type="module" src="/js/registro-admin.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <div class="d-flex titleWrap">
                <h1>Pedido <span class="idPedido"><?= $pedido ?></span></h1>
            </div>
            <?php consultar_estado($con, $pedido, $rol) ?>
        </section>
        <section class="mainWrap">
            <?php consultar_pedido($con, $pedido) ?>
        </section>
        <section>
            <a id="returnPedidos" href="/admin/pedidos">Ver todos los pedidos</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>