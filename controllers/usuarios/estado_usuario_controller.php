<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$model = new UsuariosModel;

//Obtenemos el id
$id = htmlspecialchars(trim($_GET["id"]));

//Ahora vamos a comprobar que un administrador no intenta borrarse a sí mismo
$usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"], true);
$idAdmin = $usuario[0];

if ($idAdmin == $id) {
    header("Location: /admin/usuarios");
    exit;
}

//Obtenemos el estado al que vamos a cambiar
$estado = htmlspecialchars(trim($_GET["estado"]));

//Actualizamos los datos
$model->estadoUsuario($con, $id, $estado);

// Cerrar la conexión
$con = null;


header("Location: /admin/usuarios");
exit;