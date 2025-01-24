<?php

require '../config/enlaces.php';

seguridad(true, 1, $rol ?? -1);

if(empty($_GET["id"])){
    header("Location: /");
    exit;
}

//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de producto
require '../models/productos_models.php';
$model = new ProductosModel;

$id = $_GET["id"];

//Obtenemos los datos del producto para ver si está activo o no
$producto = $model->getProducto($con, $id);

$estado = $producto["activo"] == 0 ? 1 : 0;
$estadoText = $producto["activo"] == 0 ? "Activar" : "Desactivar";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="es">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/borrar-usuario.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="d-flex">
        <section>
            <h1><?= $estadoText ?> producto <?= $id ?></h1>
        </section>
        <section class="deleteWrap">
            <p>¿Estás seguro de que deseas <span><?= $estadoText ?></span> este producto?</p>
            <form id="deleteForm" mehotd="POST">
                <div class="d-flex mb15 space-between">
                    <a href="/controllers/productos/estado_productos_controller.php?id=<?= $id ?>&estado=<?= $estado ?>" class="button submitDelete"><?= $estadoText ?> producto</a>
                    <a href="/admin/productos" class="button cancelButton none-s">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>