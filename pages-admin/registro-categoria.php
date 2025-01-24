<?php

require '../config/enlaces.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1, $rol ?? -1);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/perfil.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/registro-admin.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section class="md30">
            <h1>Registrar categoría</h1>
        </section>
        <section class="mainWrap d-flex">
            <div id="wrapDates">
                <form id="registerCat" method="post" class="formMain d-flex space-between align-center">
                    <div class="rowForm d-flex">
                        <label for="categoria">Categoría</label>
                        <input type="text" name="categoria" id="categoria" maxlength="20" class="inputForm">
                    </div>
                    <div class="rowForm d-flex">
                        <label for="padre">Padre</label>
                        <select name="padre" id="padre" class="inputForm">
                            <option value="">Padre</option>
                            <?php opciones_categorias($con, "") ?>
                        </select>
                    </div>
                    <div class="rowSubmit d-flex space-end">
                        <input type="submit" name="submit" id="submitCat" value="Registrar" class="button">
                    </div>
                </form>
            </div>
        </section>
        <section>
            <a href="/admin/categorias">Ver todas las categorías</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>