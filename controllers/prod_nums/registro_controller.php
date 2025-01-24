<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["talla"]) && empty($_POST["talla"]))
    || (isset($_POST["stock"]) && empty($_POST["stock"]))
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
require '../../models/prod_nums_models.php';
$model = new ProdNumsModel;

//Comprobamos la talla
$talla = isset($_POST["talla"]) ? filter_var($_POST["talla"],FILTER_SANITIZE_NUMBER_INT) : filter_var($_POST["tallaC"], FILTER_SANITIZE_NUMBER_INT);
validarNum($talla, "talla");

//Comprobamos el stock
$stock = htmlspecialchars(trim($_POST["stock"]));
validarNum($stock, "stock");

$id = htmlspecialchars(trim($_POST["id"]));

//Antes de registrar la talla comprobamos si existe
$check = $model->comprobarTalla($con, $id, $talla);

if ($check) { //Si existe le sumamos el stock
    $model->updateStock($con, $id, $talla, $stock);
} else { //Si no existe
    //Registramos el stock y la talla
    $model->registro($con, $id, $talla, $stock);
}

// Cerrar la conexión
$con = null;

echo json_encode("ok");
exit;
