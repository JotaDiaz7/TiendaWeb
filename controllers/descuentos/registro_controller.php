<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["descuento"]) && empty($_POST["descuento"]))
|| (isset($_POST["importe"]) && empty($_POST["importe"]))
|| (isset($_POST["fechaFin"]) && empty($_POST["fechaFin"]))
|| (isset($_POST["fechaInicio"]) && empty($_POST["fechaInicio"]))) {
    echo json_encode("empty");
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de descuento
require '../../models/descuentos_models.php';
$model = new DescuentosModel;

//Atrapamos el nombre del descuento
$descuento = htmlspecialchars(trim($_POST["descuento"]));

//Vamos a comprobar que no exista ya ese descuento
$check = $model -> comprobarDescuento($con, $descuento);

if($check) {
    echo json_encode("existe");
    exit;
}

//Atrapamos y comprobamos el importe
$importe = filter_var($_POST["importe"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
validarPrecio($importe);

//Atrapamos el resto de valores de los campos del formulario
$tipo = htmlspecialchars(trim($_POST["tipo"]));
$fechaInicio = $_POST["fechaInicio"];
$fechaFin = $_POST["fechaFin"];

if($fechaInicio > $fechaFin){
    echo json_encode("fecha");
    exit;
}

//Registramos a la categoría
$model -> registro($con, $descuento, $importe, $tipo, $fechaInicio, $fechaFin);

// Cerrar la conexión
$con = null; 

echo json_encode("ok");
exit;