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
            <h1>Registrar descuento</h1>
        </section>
        <section class="mainWrap d-flex">
            <div id="wrapDates">
                <form id="registerDesc" method="post" class="formMain d-flex space-between align-center">
                    <div class="rowForm d-flex">
                        <label for="descuento">Descuento*</label>
                        <input type="text" id="descuento" name="descuento" maxlength="100" class="inputForm">
                    </div>
                    <div class="rowForm d-flex">
                        <label for="importe">Importe*</label>
                        <input type="number" id="importe" name="importe" class="inputForm">
                    </div>
                    <div class="rowForm d-flex">
                        <label for="tipo">Tipo*</label>
                        <select name="tipo" id="tipo" class="inputForm">
                            <option value="e">€</option>
                            <option value="%">%</option>
                        </select>
                    </div>
                    <div class="rowForm d-flex">
                        <label for="fechaInicio">Fecha inicio*</label>
                        <input type="date" id="fechaInicio" name="fechaInicio" class="inputForm">
                    </div>
                    <div class="rowForm d-flex">
                        <label for="fechaFin">Fecha fin*</label>
                        <input type="date" id="fechaFin" name="fechaFin" class="inputForm">
                    </div>
                    <div class="rowSubmit d-flex space-end">
                        <input type="submit" name="submit" id="submitDesc" value="Registrar" class="button">
                    </div>
                </form>
            </div>
        </section>
        <section>
            <a href="/admin/descuentos">Ver todos los descuentos</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>