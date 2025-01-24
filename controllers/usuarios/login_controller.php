<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["email"]) && empty($_POST["email"])) || (isset($_POST["password"]) && empty($_POST["password"]))) {
    echo json_encode("empty");
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Atrapamos el valor de los campos del formulario
$password = htmlspecialchars(trim($_POST["password"]));
$email = htmlspecialchars(trim($_POST["email"]));

//Incluímos el modelo de usuario
require '../../models/usuarios_models.php';

$model = new UsuariosModel;

//Hacemos login con el email y contraseña introducido
$result = $model->login($con, $email, $password);

if ($result) {
    //Comprobamos si quieren guardar sus datos en cookies
    if (!empty($_POST["remember"])) {
        //La cookie tendrá una duración de 30 días a partir del momento en que se establece
        setcookie("usuario", json_encode($result), time() + 30 * 24 * 60 * 60, '/');
    }

    require '../carrito/login_carrito_controller.php';

    echo json_encode("ok");
} else {
    echo json_encode("error");
}

// Cerrar la conexión
$con = null;

exit;