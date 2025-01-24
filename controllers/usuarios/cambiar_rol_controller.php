<?php
session_start();

if ((!isset($_GET["id"]) || empty($_GET["id"])) && (!isset($_GET["rol"]) || empty($_GET["rol"]))) {
    echo json_encode("empty");
    exit;
}

//Vamos a comprobar que el administrador no intente cambiarse su propio rol
$usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
$id = $usuario[0];

if ($_GET["id"] == $id) {
    echo json_encode("admin");
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$model = new UsuariosModel;

//Atrapamos el id y el rol que hemos pasado por GET
$id = htmlspecialchars(trim($_GET["id"]));
$rol = htmlspecialchars(trim($_GET["rol"]));

//Actualizamos los datos
$result = $model->cambiarRol($con, $id, $rol);

// Cerrar la conexión
$con = null;

if (!$result) {
    echo json_encode("error");
} else {
    echo json_encode($result);
}
exit;
