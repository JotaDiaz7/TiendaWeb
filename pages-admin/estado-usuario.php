<?php

require '../config/enlaces.php';

seguridad(true, 2, $rol ?? -1);

if(empty($_GET["id"])){
    header("Location: /");
    exit;
}

//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../models/usuarios_models.php';
$model = new UsuariosModel;

$idUsuario = $_GET["id"];

//Obtenemos los datos del usuario para ver si está activo o no
$usuario = $model->getUsuario($con, $idUsuario);

$estado = $usuario["activo"] == 0 ? 1 : 0;
$estadoText = $usuario["activo"] == 0 ? "Activar" : "Desactivar";

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
            <h1><?= $estadoText ?> usuario <?= $idUsuario ?></h1>
        </section>
        <section class="deleteWrap">
            <p>¿Estás seguro de que deseas <span><?= $estadoText ?></span> a este usuario?</p>
            <p>Recuerda que un administrador no puede modificar su propio estado.</p>
            <form id="deleteForm" mehotd="POST">
                <div class="d-flex mb15 space-between">
                    <a href="/controllers/usuarios/estado_usuario_controller.php?id=<?= $idUsuario ?>&estado=<?= $estado ?>" class="button submitDelete"><?= $estadoText ?> cuenta</a>
                    <a href="/admin/usuarios" class="button cancelButton none-s">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <?php include "../templates/alert.php" ?>
    <?php include "../templates/menuMain.php" ?>
    <?php include "../templates/footer.php" ?>
</body>

</html>