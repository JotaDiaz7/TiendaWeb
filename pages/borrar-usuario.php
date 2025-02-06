<?php

require '../config/enlaces.php';

seguridad(true, 0, $rol ?? -1);

//Establecemos conexión
$con = conectar_db();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Language" content="es">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/borrar-usuario.css">
    <link rel="stylesheet" href="../styles/fonts.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/borrar-usuario.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main class="d-flex">
        <section>
            <h1>Borrar cuenta</h1>
        </section>
        <section class="deleteWrap">
            <p>¿Estás seguro de que deseas eliminar tu cuenta?</p>
            <p>No queremos que te vayas. Si estás experimentando algún problema con la web o tienes alguna otra incidencia, no dudes en ponerte en <a href="">contacto</a> con nosotros.</p>
            <p>Si aún así deseas continuar, por favor confirma que deseas eliminar tu cuenta.</p>
            <form id="deleteForm" mehotd="POST">
                <div class="d-flex mb15 space-between">
                    <input type="submit" id="submit" class="button submitDelete" value="Borrar cuenta">
                    <a href="/" class="button cancelButton none-s">Cancelar</a>
                </div>
                <div class="mb15">
                    <input id="checkbox" type="checkbox" name="checkbox">
                    <label for="checkbox">Confirmo que deseo eliminar mi cuenta</label>
                </div>
                <div class="none-xmd d-flex">
                    <a href="/cuenta" class="button cancelButton">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/carrito.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>