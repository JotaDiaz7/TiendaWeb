<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 2, $rol ?? -1);

//Vamos a llamar al controller para obtener los datos del usuario y su view
require '../controllers/usuarios/usuarios_controllers.php';

if (empty($_GET["id"])) {
    header("/");
    exit;
} else {
    $idUsuario = $_GET["id"];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/perfil.css">
    <link rel="stylesheet" href="/styles/fonts.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="/js/cuenta.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Usuario <strong><?= $idUsuario ?></strong></h1>
        </section>
        <section class="mainWrapPerfil d-flex">
            <div id="wrapDatesUser">
                <?php consultar_usuario($con, $idUsuario) ?>
            </div>
        </section>
        <section>
            <a id="delete" href="/admin/usuarios">Ver todos los usuarios</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>