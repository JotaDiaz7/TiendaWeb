<?php
require '../config/enlaces.php';

seguridad(false, 0, $rol ?? -1);

//Establecemos conexión
$con = conectar_db();

//Vamos a llamar al controller para obtener los datos del productos y su view
require '../controllers/productos/productos_controllers.php';

if (empty($_GET["id"]) || empty($_GET["nombre"])) {
    header("Location: /");
    exit;
}

require '../config/carrito.php';

$idProd = $_GET["id"];
$talla = isset($_GET["talla"]) && !empty($_GET["talla"]) ? $_GET["talla"] : 0;

//Vamos a ver si la categoría padre de este producto es Calzado
require '../models/categorias_models.php';
$model = new CategoriasModel;
$calzado = $model->esCalzado($con, $idProd);

//Vamos a obtener el stock de este producto
require '../models/prod_nums_models.php';
$model = new ProdNumsModel;
$stock = $model->getStock($con, $idProd);
//Vamos a comprobar si la talla pasada por url existe
$check = $model->comprobarTalla($con, $idProd, $talla);

if (!$check) {
    header("Location: /");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/producto.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/producto.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main>
        <section id="productWrap" class="d-flex">
            <?php plantilla_producto($con, $idProd, $calzado, $stock, $talla) ?>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>