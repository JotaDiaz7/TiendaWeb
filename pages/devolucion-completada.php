<?php
require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0, $rol ?? -1);

$devolucion = $_GET["id"];

//Llamamos al model de devoluciones
require '../models/devoluciones_models.php';
$model = new DevolucionesModel;
//Primero vamos a comprobar que el id de la devolución exista
$check = $model -> comprobarId($con, $devolucion);
if(empty($devolucion) || !$check){
    header("Location: /error?error=Devolución no encontrado.");
    exit;
}

$dates = $model->getDevolucion($con, $devolucion);

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
            <h1>Devolución completada</h1>
        </section>
        <section class="mainWrap">
            <h3>Hola, <span class="nombre"><?= $nombre ?></span></h3>
            <p class="none-s">Queremos darte las gracias de corazón por confiar en nosotros. Nos complace informarte que tu devolución del pedido <?= $dates['pedido'] ?> ha sido procesada con éxito.</p>
            <p>El reembolso correspondiente a tu pedido se realizará cuando el producto llegue a tienda y se compruebe que esté en buen estado, en breve recibirás un correo con todos los detalles. Agradecemos tu paciencia y esperamos verte pronto de nuevo en nuestra tienda.</p>
            <p>Mientras tanto, aquí tienes los detalles de tu devolución:</p>
            <ul>
                <li><strong>Número de devolución: </strong><?= $devolucion ?></li>
                <li><strong>Fecha: </strong><?= $dates['fecha'] ?></li>
                <li><strong>Total a devolver: </strong><?= $dates['importe'] ?>€</li>
                <li><strong>Dirección de recogida: </strong><?= $dates['direccion'] ?>, <?= $dates['ciudad'] ?>, <?= $dates['provincia'] ?></li>
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