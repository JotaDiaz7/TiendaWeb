<?php
session_start();

//Atrapamos los parámetros pasados por get
$img = $_GET["img"];
$id = $_GET["id"];
$nombre = $_GET["nombre"];

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de productos
require '../../models/productos_models.php';
$model = new ProductosModel;

// Ruta completa del archivo en el servidor
$ruta = "../../media/productos/".$nombre;

// Verificamos si el archivo existe antes de intentar eliminarlo
if (file_exists($ruta)) {
    // Eliminamos el archivo del servidor
    if (unlink($ruta)) {
        //Llamamos a la función para eliminar la url de la imagen de la base de datos
        $model->borrarImg($con, $img, $id);
    }
}

// Cerrar la conexión
$con = null;

header("Location: /admin/producto/".$id);
exit;