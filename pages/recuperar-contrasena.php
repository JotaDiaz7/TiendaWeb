<?php

require '../config/enlaces.php';


seguridad(false, 0, $rol ?? -1);

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
    <link rel="icon" href="../media/favicon.PNG">
    <script type="module" src="../js/borrar-usuario.js"></script>
    <title>La madriguera</title>
</head>

<body class="<?php if (isset($_GET["cart"])) { ?>overflow<?php } ?>">
    <?php include "../templates/header.php" ?>
    <main class="d-flex">
        <section>
            <h1>Recuperar contraseña</h1>
        </section>
        <section class="firstWrap">
            <p>No te preocupes, introduce la dirección de correo electrónico que utilizaste para registrarte, tu nombre y tus apellidos.</p>
            <form id="update" mehotd="POST" class="itemsCenter">
                <div class="rowForm d-flex">
                    <label for="email">Correo</label>
                    <input id="email" type="email" name="email" class="inputForm" placeholder="hola@mundo.es">
                </div>
                <div class="rowForm d-flex">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" class="inputForm" placeholder="John">
                </div>
                <div class="rowForm d-flex">
                    <label for="apellidos">Apellidos</label>
                    <input id="apellidos" type="text" name="apellidos" class="inputForm" placeholder="Doe">
                </div>
                <div class="rowForm">
                    <input id="submit" type="submit" class="button submitChange" value="Comprobar">
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