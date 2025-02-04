<?php
require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0, $rol ?? -1);

//Vamos a llamar al controller para asegurarnos de que el pedido exista
require '../controllers/pedidos/pedidos_controllers.php';

$pedido = $_GET["id"];

$check = comprobar_id($con, $pedido);

if (empty($pedido) || !$check) {
    header("Location: /error?error=Pedido no encontrado.");
    exit;
} 

require '../controllers/usuarios/usuarios_controllers.php';
require '../controllers/devoluciones/devoluciones_controllers.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/checkout.css">
    <link rel="icon" href="/media/favicon.PNG">
    <script type="module" src="/js/checkout-devolucion.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <div id="datesWrap">
                <h2>1. Productos a devolver</h2>
                <div id="carrito" class="container ">
                <?php
                //Vamos a obtener todos los productos que estén para devolver
                obtener_productos_devolver($con, $pedido); 
                ?>
                    <div class="buttonWrap ">
                        <button id="buttonCarrito" class="button">Continuar</button>
                    </div>
                </div>
                <h2>2. Información de la devolución</h2>
                <div id="personalInfo" class="container hiddenContainer">
                    <?php checkout_usuario($con, $id); ?>
                </div>
                <h2>3. Confirmar</h2>
                <form id="purchase" class="container hiddenContainer" method="POST">
                    <div class="rowSubmit">
                        <button id="returnInfo" class="anteriorButton button">Inf. devolución</button>
                    </div>
                    <div class="rowImport d-flex space-between">
                        <label for="pricePurchase">Importe a devolver</label>
                        <div class="d-flex space-end">
                            <input type="text" name="importe" id="pricePurchase" readonly class="mainPrice" value="<?= $precioProductos ?>">
                            €
                        </div>
                    </div>
                    <div class="checkboxWrap">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label for="checkbox">He leído y acepto el <a href="#">Aviso Legal y Cookies</a>, la <a href="#">Política de Privacidad</a> y <a href="#">Envíos y Devoluciones</a>.</label>
                    </div>
                    <input type="hidden" name="pedido" id="pedido" value="<?= $pedido ?>">
                    <input type="hidden" name="usuario" id="usuario" value="<?= $id ?>">
                    <div id="devolucionWrap" class="buttonDevolucion">
                        <div id="card-element"></div>
                        <button id="buttonDevolucion" class="buttonDevolucion itemsCenter">
                            Crear devolución
                        </button>
                    </div>
                </form>
            </div>
            <aside id="resumeWrap" class="none-md">
                <div class="purchaseDates d-flex">
                    <span>Productos:</span>
                    <span id="priceProducts" class="mainPrice"><?= $precioProductos ?>€</span>
                </div>
                <div class="purchaseDates d-flex">
                    <h5>Importe a devolver:</h5>
                    <h5 id="totalImport" class="mainPrice"><?= $precioProductos ?>€</h5>
                </div>
                <p class="ivaInfo">*Los gastos de portes corren a cargo de la tienda.</p>
            </aside>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>