<?php

require '../config/enlaces.php';

seguridad(true, 0, $rol ?? -1);

if(empty($_GET["id"])){
    header("Location: /error?error=Pedido no encontrado.");
    exit;
}

//Establecemos conexión
$con = conectar_db();

$pedido = $_GET["id"];

//Vamos a llamar al controller 
require '../controllers/pedidos/pedidos_controllers.php';
//Vamos a preguntar si este pedido ya está cancelado
$check = pedido_cancelado($con, $pedido);
if($check){
    header("Location: /error?error=Este pedido ya está cancelado.");
    exit;
}

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
            <form id="deleteForm" mehotd="POST">
                <div class="d-flex mb15 space-between">
                    <a href="/controllers/pedidos/estado_pedido_controller.php?pedido=<?= $pedido ?>&estado=Cancelado&usuario=<?= $rol ?>" class="button submitDelete">Cancelar pedido</a>
                    <a href="/pedidos" class="button cancelButton none-s">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>