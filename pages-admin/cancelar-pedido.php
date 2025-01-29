<?php

require '../config/enlaces.php';

seguridad(true, 1, $rol ?? -1);

if(empty($_GET["id"])){
    header("Location: /error?error=Pedido no encontrado.");
    exit;
}

//Establecemos conexión
$con = conectar_db();

$pedido = $_GET["id"];

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
    <script type="module" src="/js/usuarios.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="d-flex">
        <section>
            <h1>Cancelar pedido <?= $pedido ?></h1>
        </section>
        <section class="deleteWrap">
            <p>¿Estás seguro de que deseas cancelar este pedido?</p>
            <p>Esta acción es irreversible y una vez que lo canceles se sumará el stock a los productos correspondientes.</p>
            <form id="deleteForm" mehotd="POST">
                <div class="d-flex mb15 space-between">
                    <a href="/controllers/pedidos/estado_pedido_controller.php?pedido=<?= $pedido ?>&estado=Cancelado" class="button submitDelete">Cancelar pedido</a>
                    <a href="/admin/pedidos" class="button cancelButton none-s">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>