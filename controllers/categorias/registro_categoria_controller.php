<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["categoria"]) && empty($_POST["categoria"]))) {
    echo json_encode("empty");
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de la categoría
require '../../models/categorias_models.php';
$model = new CategoriasModel;

//Comprobamos el nombre de la categoría
$categoria = htmlspecialchars(trim($_POST["categoria"]));
validarTexto($categoria, "categoria");

//Vamos a comprobar que no exista ya esa categoria
$check = $model -> comprobarCategoria($con, $categoria);

if($check) {
    echo json_encode("existe");
    exit;
}

//Atrapamos el resto de valores de los campos del formulario
$padre = !empty(trim($_POST["padre"])) ? htmlspecialchars(trim($_POST["padre"])) : null;

//Registramos a la categoría
$model -> registro($con, $categoria, $padre);

// Cerrar la conexión
$con = null; 

echo json_encode("ok");
exit;