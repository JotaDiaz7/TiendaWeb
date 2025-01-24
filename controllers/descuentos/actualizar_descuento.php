<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["nombre"]) && empty($_POST["nombre"])) || 
(isset($_POST["importe"]) && empty($_POST["importe"])) || 
(isset($_POST["tipo"]) && empty($_POST["tipo"])) || 
(isset($_POST["fechaInicio"]) && empty($_POST["fechaInicio"])) || 
(isset($_POST["fechaFin"]) && empty($_POST["fechaFin"]))) {
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

//Obtenemos el nombre
$nombre = htmlspecialchars(trim($_POST["nombre"]));

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

//Actualizamos los datos
$result = $model->actualizarDescuento($con, $nombre, $importe, $tipo, $fechaInicio, $fechaFin);

// Cerrar la conexión
$con = null;

if ($result) {
    echo json_encode("ok");
} else {
    echo json_encode("error");
}
exit;