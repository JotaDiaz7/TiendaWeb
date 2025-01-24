<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de categoria
require '../../models/categorias_models.php';
$model = new CategoriasModel;

//Obtenemos la categoria
$categoria = htmlspecialchars(trim($_GET["categoria"]));

//Obtenemos el estado al que vamos a cambiar
$estado = htmlspecialchars(trim($_GET["estado"]));

//Obtenemos la página para que nos redirija
$pagina = $_GET["pagina"];

//Actualizamos los datos
$result = $model->estadoCategoria($con, $categoria, $estado);

// Cerrar la conexión
$con = null;

if ($result) {
    header("Location: /admin/categorias?pagina=".$pagina);
}
exit;