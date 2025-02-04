<?php
require '../config/seguridad.php';
require '../config/config.php';

seguridad(true, 0, $rol ?? -1);

ob_start();

//Establecemos conexión
$con = conectar_db();

//Llamamos al modelo de pedido y de producto
require_once '../models/pedidos_models.php';
$model = new PedidosModel;

//Vamos a atrapar el id del pedido
$pedido = $_GET["id"];

//Comprobamos que exista
$check = $model->comprobarId($con, $pedido);

if (empty($pedido) || !$check) {
    header("Location: /error?error=Factura no disponible.");
    exit;
}

// //Obtenemos los datos
$dates = $model->getPedido($con, $pedido);
$lineas = $model->productosPedido($con, $pedido);

$date = date('Y-m-d'); //Fecha de emisión

$cartelPath = $_SERVER['DOCUMENT_ROOT'] . "/media/logo.PNG";
$cartelData = base64_encode(file_get_contents($cartelPath));
$cartelSrc = 'data:image/png;base64,' . $cartelData;

$maderaPath = $_SERVER['DOCUMENT_ROOT'] . "/media/madera.jpg";
$maderaData = base64_encode(file_get_contents($maderaPath));
$maderaSrc = 'data:image/jpg;base64,' . $maderaData;

$tituloPath = $_SERVER['DOCUMENT_ROOT'] . "/media/titulo.PNG";
$tituloData = base64_encode(file_get_contents($tituloPath));
$tituloSrc = 'data:image/jpg;base64,' . $tituloData;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La madriguera - factura</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .colorMain {
            color: #7c3030;
        }

        body {
            font-family: sans-serif;
            padding: 30px;
        }

        .cartel {
            height: 100px;
        }

        .cartel img {
            height: 100%;
            margin-left: 20%;
        }

        .datos {
            margin-top: 20px;
            margin-bottom: 45px;
        }

        .wrapFecha {
            width: 40%;
            float: left;
        }

        .wrapDatos {
            width: 50%;
            float: right;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .wrapDatos h2,
        .wrapFecha h2 {
            margin: 10px 0px;
            color: #7c3030;
            font-size: 1.6rem;
        }

        .fecha {
            font-size: 1.15rem;
            margin-bottom: 20px;
            display: block;
        }

        .wrapFecha p {
            font-size: 1.25rem;
            margin-bottom: 8px;
        }

        .wrapDatos {
            text-align: right;
        }

        .wrapDatos p {
            margin-bottom: 8px;
        }

        .tabla {
            width: 100%;
            height: 6px;
            border-radius: 5px;
            overflow: hidden;
        }

        .tabla img {
            width: 100%;
            height: 90%;
            object-fit: contain;
        }

        .productTable {
            width: 100%;
            margin: 20px 0px;
            border: none !important;
            min-height: 280px;
            border: 1px solid black;
        }

        th,
        td {
            border: none !important;

        }

        td {
            height: 50px;
            line-height: 25px;
            padding: 5px 0px;
            vertical-align: middle;
            /* Alinea verticalmente al centro */
        }

        .cantidad,
        .pUnitario,
        .iva,
        .pIva,
        .pTotal {
            text-align: center;
        }

        td img,
        td span {
            vertical-align: middle;
            /* Alinea verticalmente al centro */
        }

        td img {
            width: 40px !important;
        }

        .precio {
            margin-top: 50px;
            height: 170px;
        }

        .precio div {
            width: 55%;
            margin-left: 320px;
            margin-bottom: 10px;
        }

        .fr {
            float: right;
        }

        .total {
            margin-top: 20px;
            font-size: 1.3rem;
        }

        .footer {
            height: 90px;
            background: #c5bcb4;
            border-radius: 15px;
            padding: 20px 0px 0px 20px;
        }

        .footer div {
            color: #7c3030;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer div span {
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
        }

        .footer div img {
            display: inline-block;
            vertical-align: middle;
            width: 120px;
        }
    </style>
</head>

<body class="pdf-page">
    <div class="cartel">
        <img src="<?= $cartelSrc ?>">
    </div>
    <div class="datos clearfix">
        <div class="wrapFecha ">
            <h2>FECHA EMISIÓN</h2>
            <span class="fecha"><?= $date ?></span>
            <p><span class="colorMain">Factura pedido</span> <span><?= $pedido ?></span></p>
        </div>
        <div class="wrapDatos ">
            <h2 style="text-align:right;">DATOS EMPRESA</h2>
            <p>La madriguera</p>
            <p>74347567Z</p>
            <p>C/ Vicente Andrés Estellés nº30 </p>
            <p>03202, Elche, Alicante</p>
        </div>
    </div>
    <div class="tabla">
        <img src="<?= $maderaSrc ?>">
    </div>
    <div class="productos">
        <table class="productTable" border="1">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>P. unitario</th>
                    <th>IVA</th>
                    <th>P. + IVA</th>
                    <th>P. total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $precioTotal = 0;
                $tasaIVA = 21;
                foreach ($lineas as $item) {
                    $precioTotal += $item['precio'];

                    //Ahora vemos a cómo saldría el IVA
                    $precioIva = $item['precio'] / (1 + ($tasaIVA / 100));
                    $precioIva = rtrim(rtrim(number_format($precioIva, 2, '.', ''), '0'), '.');

                    $precioProductoTotal = $item['precio'] * $item['cantidad'];

                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/media/productos/" . $item["img1"];
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $imageSrc = 'data:image/png;base64,' . $imageData;
                ?>
                    <tr>
                        <td class="productInfo">
                            <img src="<?= $imageSrc ?>" style="width: 50px; height: auto;">
                            <span><?= $item["nombre"] ?> <?= $item['talla'] > 0 ? "- " . $item['talla'] : "" ?></span>
                        </td>
                        <td class="cantidad"><?= $item['cantidad'] ?></td>
                        <td class="pUnitario"><?= $precioIva ?>€</td>
                        <td class="iva">21%</td>
                        <td class="pIva"><?= $item['precio'] ?>€</td>
                        <td class="pTotal"><?= $precioProductoTotal ?>€</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="tabla">
        <img src="<?= $maderaSrc ?>">
    </div>
    <div class="precio clearfix">
        <div>
            <strong>Sub Total</strong>
            <span class="fr"><?= $precioTotal ?>€</span>
        </div>
        <div>
            <span>Gastos envío</span>
            <span class="fr"><?= $dates['importe'] < 150 ? "5€" : "0€" ?></span>
        </div>
        <div class="total">
            <strong>Total</strong>
            <strong class="fr"><?= $dates['importe'] ?>€</strong>
        </div>
    </div>
    <div class="footer">
        <div>
            ¡Muchas gracias por confiar en nosotros!
        </div>
        <div>
            <span>
                Equipo de
            </span>
            <img src="<?= $tituloSrc ?>">
        </div>
    </div>
</body>

</html>
<?php
// Cerrar la conexión
$con = null;

$html = ob_get_clean();

require '../config/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isFontSubsettingEnabled', true);
$options->set('isRemoteEnabled', true); // Habilitar contenido remoto (imágenes, fuentes, etc.)

// Crear instancia de Dompdf con opciones
$dompdf = new Dompdf($options);

// Cargar el contenido HTML
$dompdf->loadHtml($html);

// Configurar tamaño de papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream($pedido . ".pdf", array("Attachment" => false)); // Descargar: true; Ver en navegador: false
?>