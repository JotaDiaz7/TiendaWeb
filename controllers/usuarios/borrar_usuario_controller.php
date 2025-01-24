<?php
session_start();

//Vamos a comprobar que hayn confirmado el checkbox
if (empty($_POST["checkbox"])) {
    echo json_encode("empty");
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$model = new UsuariosModel;

//Obtenemos el id
$usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"]);
$id = $usuario[0];

//Ahora vamos a comprobar que un administrador no intenta borrarse a sí mismo
$rol = $usuario[1];
if ($rol == 2) {
    echo json_encode("admin");
    exit;
}

//Actualizamos los datos
$result = $model->estadoUsuario($con, $id, 0);

// Cerrar la conexión
$con = null;

if ($result) {
    echo json_encode("ok");

    $_SESSION = array();
    session_destroy();
    if (isset($_COOKIE)) {
        setcookie("usuario", '', time() - 3600, '/');
    }
} else {
    echo json_encode("error");
}
exit;