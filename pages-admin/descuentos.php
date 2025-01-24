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
    <link rel="stylesheet" href="../styles/categorias.css">
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/general.js"></script>
    <title>La madriguera</title>
</head>

<body>
    <?php include "../templates/header.php" ?>
    <main class="itemsCenter">
        <section>
            <h1>Lista de descuentos</h1>
        </section>
        <section >
            <div class="d-flex space-end">
                <a href="/admin/registro-descuento"  class="button">Añadir descuento</a>
            </div>
            <table>
                <thead>
                    <th>Descuento</th>
                    <th>Importe</th>
                    <th>Tipo</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th class="editar">Editar</th>
                    <th class="borrar">Eliminar</th>
                </thead>
                <tbody>
                    <?php listar_descuentos($con, false) ?>
                </tbody>
            </table>
        </section>
        <section>
            <a href="/admin/administracion">Volver al panel de control</a>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>