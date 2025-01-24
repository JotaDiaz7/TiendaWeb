<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["password"]) && empty($_POST["password"])) || 
(isset($_POST["passwordRepeat"]) && empty($_POST["passwordRepeat"]))) {
    echo json_encode("empty");
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$model = new UsuariosModel;

//Validamos la contraseña
$password = htmlspecialchars(trim($_POST["password"]));
validarPassword($password);

//Ahora vamos a comprobar que ambas contraseñas sean iguales
$passwordRepeat = htmlspecialchars(trim($_POST["passwordRepeat"]));

if($password !== $passwordRepeat){
    echo json_encode("passNoRepeat");
    exit;
}

//Vamos a encriptar la contraseña
$passwordEnc = password_hash($password, PASSWORD_DEFAULT);

//Obtenemos el id
$usuario = $_SESSION["usuario"] ?? json_decode($_COOKIE["usuario"]);
$id = $usuario[0];

//Cambiamos la contraseña
$result = $model->cambiarPassword($con, $id, $passwordEnc);

// Cerrar la conexión
$con = null;

if ($result) {
    echo json_encode("ok");
} else {
    echo json_encode("error");
}
exit;