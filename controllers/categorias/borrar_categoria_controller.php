<?php
session_start();

if ((isset($_GET["categoria"]) && empty($_GET["categoria"]))) {
    header("Location: /");
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de categoria
require '../../models/categorias_models.php';
$model = new CategoriasModel;

$categoria = htmlspecialchars(trim($_GET["categoria"]));

//Actualizamos los datos
$result = $model->borrarCategoria($con, $categoria);

// Cerrar la conexión
$con = null;

if ($result) {
    header("Location: /admin/categorias");
}
exit;