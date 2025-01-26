<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["nombre"]) && empty($_POST["nombre"])) || (isset($_POST["email"]) && empty($_POST["email"])) || (isset($_POST["password"]) && empty($_POST["password"]))) {
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

//Comprobamos el nombre
$nombre = htmlspecialchars(trim($_POST["nombre"]));
validarTexto($nombre, "nombre");

//Creamos id, comprobando que no exista
$found = true;

while ($found) {
    $id = crearIdUsuario($nombre);
    $check = $model -> comprobarId($con, $id);

    if(!$check) {
        $found = false;
    }
}

//Comprobamos email, su formato y que no exista ya
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
validarEmail($email);
$check = $model -> comprobarEmail($con, $email, $id);

if($check) {
    echo json_encode("ExisteEmail");
    exit;
}

//Vamos a crear la fecha de registro
$fechaReg = date('Y-m-d');

//Atrapamos el resto de valores de los campos del formulario
$password = htmlspecialchars(trim($_POST["password"]));
validarPassword($password);

//Comprobamos que hayan aceptado los términos y condiciones
if ( empty($_POST["checkboxR"])){
    echo json_encode("checkbox");
    exit;
}

//Vamos a encriptar la contraseña
$passwordEnc = password_hash($password, PASSWORD_DEFAULT);

//Registramos al cliente
$model -> registro($con, $id, $nombre, "", $email, $passwordEnc, $fechaReg, "", "", "", "");

//Hacemos login
$model -> login($con, $email, $password);

require '../carrito/login_carrito_controller.php';

// Cerrar la conexión
$con = null; 

echo json_encode("ok");
exit;