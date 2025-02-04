<?php

require '../config/enlaces.php';

seguridad(true, 0, $rol ?? -1);

if(empty($_GET["id"])){
    header("Location: /error?error=Devolución no encontrado.");
    exit;
}

//Establecemos conexión
$con = conectar_db();

$devolucion = $_GET["id"];

//Vamos a llamar al controller 
require '../controllers/devoluciones/devoluciones_controllers.php';
//Vamos a preguntar si esta devolucion ya está cancelada
$check = devolucion_cancelada($con, $devolucion);
if($check){
    header("Location: /error?error=Esta devolución ya está cancelada.");
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
    <script type="module" src="/js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="d-flex">
        <section>
            <h1>Cancelar devolución <?= $devolucion ?></h1>
        </section>
        <section class="deleteWrap">
            <p>¿Estás seguro de que deseas cancelar este devolución?</p>
            <form id="deleteForm" mehotd="POST">
                <div class="d-flex mb15 space-between">
                    <a href="/controllers/devoluciones/estado_devolucion_controller.php?devolucion=<?= $devolucion ?>&estado=Cancelada" class="button submitDelete">Cancelar devolución</a>
                    <a href="/devoluciones" class="button cancelButton none-s">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>