<?php
session_start();

//Vamos a comprobar que no hayan dejado ningún campo vacío
if ((isset($_POST["nombre"]) && empty($_POST["nombre"]))
    || (isset($_POST["precio"]) && empty($_POST["precio"]))
    || (isset($_POST["descripcion"]) && empty($_POST["descripcion"]))
) {
    echo json_encode("empty");
    exit;
}

//Vamos a comprobar que al menos se haya subido una foto
if (
    $_FILES['img1']['error'] == 4
    && $_FILES['img2']['error'] == 4
    && $_FILES['img3']['error'] == 4
    && $_FILES['img4']['error'] == 4
    && (isset($_POST["img1"]) && empty($_POST["img1"]))
    && (isset($_POST["img2"]) && empty($_POST["img2"]))
    && (isset($_POST["img3"]) && empty($_POST["img3"]))
    && (isset($_POST["img4"]) && empty($_POST["img4"]))
) {
    echo json_encode("emptyImg");
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

//Comprobamos precio
$precio = filter_var($_POST["precio"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
validarPrecio($precio);

//Hacemos comprobación de las imágenes
require './img_controller.php';

//Atrapamos el resto de campos
$id = htmlspecialchars(trim($_POST["id"]));
$categoria = htmlspecialchars(trim($_POST["categoria"]));
$descripcion = htmlspecialchars(trim($_POST["descripcion"]));
$descuento = htmlspecialchars(trim($_POST["descuento"]));
//Si no hemos puesto ningún descuento, vamos hacer que su valor sea null
$descuento = empty($descuento) ? null : $descuento;

//Actualizamos el producto
$model->updateProducto($con, $id, $img1, $img2, $img3, $img4, $categoria, $nombre, $precio, $descripcion, $descuento);

// Cerrar la conexión
$con = null;

//Por último, en caso de que se haya subido algún archivo nuevo
if (isset($_FILES)) {
    $ruta = "../../media/productos/";

    foreach ($imgs as $img) {
        $name = $img['tmp_name'];
        $nameFile = $img['name'];
        if (!empty($name)) {
            move_uploaded_file($name, $ruta . $nameFile);
        }
    }
}

echo json_encode("ok");
exit;