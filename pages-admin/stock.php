<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

//Vamos a llamar al controller para obtener los datos de stock del productos y su view
require '../controllers/prod_nums/prod_nums_controller.php';

if (empty($_GET["id"])) {
    header("/");
    exit;
} else {
    $id = $_GET["id"];
}

//Vamos a ver si la categoría padre de este producto es Calzado
require '../models/categorias_models.php';
$model = new CategoriasModel;
$calzado = $model->esCalzado($con, $id);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/registro-stock.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/registro-stock.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Producto <strong><?= $id ?></strong></h1>
        </section>
        <section class="mainWrap">
            <form id="formStock" method="POST" class="itemsCenter">
                <div class="d-flex inputWrapStock">
                    <input type="hidden" id="id" name="id" class="hidden" value="<?= $id ?>">
                    <?php if ($calzado) { ?>
                        <input type="number" id="talla" name="talla" class="inputForm inputStock" placeholder="talla">
                    <?php } else { ?>
                        <input type="hidden" id="talla" name="tallaC" value="0">
                    <?php } ?>
                    <input type="number" id="stock" name="stock" class="inputForm inputStock" placeholder="stock">
                </div>
                <div>
                    <input type="submit" id="submit" value="Guardar" class="button">
                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <?php if ($calzado) { ?>
                            <th>Talla</th>
                            <th>Stock</th>
                            <th>Borrar</th>
                        <?php } else { ?>
                            <th>Stock</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php listar_stock($con, $id, $calzado) ?>
                </tbody>
            </table>
        </section>
        <section>
            <a id="delete" href="/admin/productos">Ver todos los productos</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>