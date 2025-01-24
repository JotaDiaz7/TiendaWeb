<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["nombre"]) && empty($_POST["nombre"])) 
|| (isset($_POST["apellidos"]) && empty($_POST["apellidos"])) 
|| (isset($_POST["email"]) && empty($_POST["email"])) 
|| (isset($_POST["movil"]) && empty($_POST["movil"])) 
|| (isset($_POST["direccion"]) && empty($_POST["direccion"])) 
|| (isset($_POST["ciudad"]) && empty($_POST["ciudad"])) 
|| (isset($_POST["provincia"]) && empty($_POST["provincia"])) 
|| (isset($_POST["password"]) && empty($_POST["password"]))) {
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

//Comprobamos los apellidos
$apellidos = htmlspecialchars(trim($_POST["apellidos"]));
validarTexto($apellidos, "apellidos");

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

//Comprobamos número de móvil
$movil = htmlspecialchars(trim($_POST["movil"]));
validarMovil($movil);

//Comprobamos la ciudad
$ciudad = htmlspecialchars(trim($_POST["ciudad"]));
validarTexto($ciudad, "ciudad");

//Comprobamos la provincia
$provincia = htmlspecialchars(trim($_POST["provincia"]));
validarTexto($provincia, "provincia");

//Atrapamos la dirección
$direccion = htmlspecialchars(trim($_POST["direccion"]));

//Atrapamos la contraseña y la validamos
$password = htmlspecialchars(trim($_POST["password"]));
validarPassword($password);

//Vamos a encriptar la contraseña
$passwordEnc = password_hash($password, PASSWORD_DEFAULT);

//Registramos al usuario
$model -> registro($con, $id, $nombre, $apellidos, $email, $passwordEnc, $fechaReg, $movil, $direccion, $ciudad, $provincia);

// Cerrar la conexión
$con = null; 

echo json_encode("ok");
exit;