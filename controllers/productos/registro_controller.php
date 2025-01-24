<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["nombre"]) && empty($_POST["nombre"]))
    || (isset($_POST["precio"]) && empty($_POST["precio"]))
    || (isset($_POST["descripcion"]) && empty($_POST["descripcion"]))
) {
    echo json_encode("empty");
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de productos
require '../../models/productos_models.php';
$model = new ProductosModel;

//Comprobamos el nombre
$nombre = htmlspecialchars(trim($_POST["nombre"]));
validarTexto($nombre, "nombre");

//Creamos id, comprobando que no exista
$found = true;

while ($found) {
    $id = crearIdProducto($nombre);
    $check = $model->comprobarId($con, $id);

    if (!$check) {
        $found = false;
    }
}

//Comprobamos precio
$precio = filter_var($_POST["precio"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
validarPrecio($precio);

//Vamos a crear la fecha de registro
$fechaReg = date('Y-m-d');

//Hacemos comprobación de las imágenes
require './img_controller.php';

//Atrapamos el resto de campos
$categoria = htmlspecialchars(trim($_POST["categoria"]));
$descripcion = htmlspecialchars(trim($_POST["descripcion"]));

//Registramos el producto
$model->registro($con, $id, $img1, $img2, $img3, $img4, $categoria, $nombre, $precio, $descripcion, $fechaReg);

// Cerrar la conexión
$con = null;

//Por último, enviamos las imágenes a la carpeta del servidor 
$ruta = "../../media/productos/";

foreach ($imgs as $img) {
    $name = $img['tmp_name'];
    $nameFile = $img['name'];
    if (!empty($name)) {
        move_uploaded_file($name, $ruta.$nameFile);
    }
}

echo json_encode("ok");
exit;