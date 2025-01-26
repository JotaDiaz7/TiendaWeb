<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';
$model = new UsuariosModel;

//Primero comprobamos si es el primer o segundo bloque
if (isset($_POST["email"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"])) {
    //Vamos a comprobar que todos los campos estén completados
    if ((isset($_POST["email"]) && empty($_POST["email"])) ||
        (isset($_POST["nombre"]) && empty($_POST["nombre"]))
    ) {
        echo json_encode("empty");
        exit;
    }

    //Atrapamos los campos
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $apellidos = htmlspecialchars(trim($_POST["apellidos"]));

    $id = $model->recuperarPassword($con, $email, $nombre, $apellidos);

    if ($id) {
        echo json_encode($id);
    } else {
        echo json_encode("errorU");
    }
} else {
    //Vamos a comprobar que todos los campos estén completados
    if ((isset($_POST["password"]) && empty($_POST["password"])) ||
        (isset($_POST["passwordRepeat"]) && empty($_POST["passwordRepeat"]))
    ) {
        echo json_encode("empty");
        exit;
    }

    //Vamos a incluir el archivo que contiene el resto de funciones de validación
    require '../../config/utils.php';

    //Validamos la contraseña
    $password = htmlspecialchars(trim($_POST["password"]));
    validarPassword($password);

    //Ahora vamos a comprobar que ambas contraseñas sean iguales
    $passwordRepeat = htmlspecialchars(trim($_POST["passwordRepeat"]));

    if ($password !== $passwordRepeat) {
        echo json_encode("passNoRepeat");
        exit;
    }

    //Vamos a encriptar la contraseña
    $passwordEnc = password_hash($password, PASSWORD_DEFAULT);

    //Obtenemos el id
    $id = $_POST["userId"];

    //Cambiamos la contraseña
    $result = $model->cambiarPassword($con, $id, $passwordEnc);

    echo json_encode("ok");
}

// Cerrar la conexión
$con = null;
exit;
