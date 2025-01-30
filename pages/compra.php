<?php
require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0, $rol ?? -1);

//Si existe el carrito
if (isset($_SESSION['carrito'])) {
    header("Location: /");
    exit;
}

$pedido = $_GET["id"];

//Llamamos al model de pedidos
require '../models/pedidos_models.php';
$model = new PedidosModel;
$dates = $model->getPedido($con, $pedido);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/compra.css">
    <link rel="icon" href="/media/favicon.PNG">
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="d-flex">
        <section>
            <h1>¡Gracias por tu compra!</h1>
        </section>
        <section class="mainWrap">
            <h3>Hola, <span class="nombre"><?= $nombre ?></span></h3>
            <p class="none-s">Queremos darte las gracias de corazón por confiar en nosotros y realizar tu compra. Estamos encantados de que hayas encontrado algo especial en nuestra tienda.</p>
            <p>Tu pedido ha sido recibido con mucho cariño y ya estamos preparando todo para que llegue a tus manos lo antes posible. Si lo necesitas, puedes descargar la factura desde tu perfil en la sección de pedidos.</p>
            <p>Mientras tanto, aquí tienes los detalles de tu pedido:</p>
            <ul>
                <li><strong>Número de pedido: </strong>#<?= $pedido ?></li>
                <li><strong>Fecha de compra: </strong><?= $dates['fecha'] ?></li>
                <li><strong>Total: </strong><?= $dates['importe'] ?>€</li>
                <li><strong>Dirección de envío: </strong><?= $dates['direccion'] ?>, <?= $dates['ciudad'] ?>, <?= $dates['provincia'] ?></li>
            </ul>
            <p>Si tienes alguna duda o necesitas ayuda, no dudes en <a href="#" class="anclaContacto">contactarnos</a>. Estamos aquí para asegurarnos de que tengas la mejor experiencia posible.</p>
            <p class="none-s">¡Esperamos que disfrutes mucho de tu compra! Y recuerda, si necesitas cualquier cosa, solo tienes que decirnos.</p>
            <p>¡Gracias de nuevo y que tengas un día maravilloso!</p>
            <p class="d-flex align-center">Equipo de <img width="100px" style="margin-left: 10px;" src="/media/titulo.PNG"></p>
        </section>
    </main>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>
</html>